<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Imports\MembersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Topic;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Pagination\Paginator;

class MemberController extends Controller
{
    public function index(Request $request)
        {
        //$members = Member::whereNull('deleted_at')->get();
            //$members = Member::all();
           
           $members = Member::orderBy('id', 'desc')
    ->select('id', 'name', 'username', 'mobile', 'email', 'cader', 'designation', 'batch', 'Service','status','sector');
     if ($request->filled('search')) {
        $search = $request->search;
        $members->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('username', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('mobile', 'like', "%{$search}%");
        });
    }
   $members = $members->paginate(10); // har page me 20 records
 Paginator::useBootstrap();
            return view('admin.members.index', compact('members'));
        }

    public function create()
        {
            return view('admin.members.create');
        }

    public function store(Request $request)
        {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:members',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'required|string|min:8|confirmed',
            'cader' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'batch' => 'required|integer',
            'sector' => 'nullable|string',
            'service' => 'nullable|string',
        ]);
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // Create a new member
        Member::create([
            'name' => $request->name,
            'username' => $request->username,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cader' => $request->cader,
            'designation' => $request->designation,
            'batch' => $request->batch,
            'sector' => $request->sector,
            'Service' => $request->service,
        ]);
       return redirect()->route('members.index')->with('success', 'Member added successfully.');
        }

    public function edit(Member $member)
        {
            return view('admin.members.edit', compact('member'));
        }

    public function update(Request $request, Member $member)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:members,username,' . $member->id,
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $member->id,
            'password' => 'nullable|string|min:8',
            'password_confirmation' => 'required_with:password|same:password',
            'cader' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'batch' => 'required|integer',
            'sector' => 'nullable|string',
            'service' => 'nullable|string',
        ]);
        //  if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $member->name = $request->name;
        $member->mobile = $request->mobile;
        $member->email = $request->email;
        if ($request->filled('password')) {
            $member->password = Hash::make($request->password);
        }
        $member->cader = $request->cader;
        $member->designation = $request->designation;
        $member->batch = $request->batch;
        $member->username = $request->username;
        $member->Service = $request->service;
        $member->sector = $request->sector;
        $member->save();
       return redirect()->route('members.index')->with('success', 'Member updated successfully.');

    }

   public function destroy(Member $member)
    {
        if ($member->status == 1) {
            return redirect()->route('members.index')
                            ->with('error', 'Cannot delete an active member. Please deactivate it first.');
        }
        $member->delete();
        return redirect()->route('members.index')
                        ->with('success', 'Member deleted successfully.');
    }

    //member bulk upload
    public function bulk_upload_members(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:3072',
        ]);

         $import = new MembersImport();

        try {
        Excel::import($import, $request->file('file'));

        if (!empty($import->failures)) {
            return back()->with([
                'failures' => $import->failures
            ]);
        }

       return redirect()->route('members.index')->with('success', 'Members uploaded successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

   public function bulk_upload_form()
        {
            return view('admin.members.bulk_upload');
        }

     public function toggleStatus(Request $request)
    {
        $member = Member::findOrFail($request->id);
        $member->status = $request->status;
        $member->save();
        return response()->json(['message' => 'Status updated successfully.']);

    }


}
