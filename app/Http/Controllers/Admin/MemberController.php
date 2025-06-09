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


class MemberController extends Controller
{
    public function index()
    {
        //$members = Member::all(); // get all members
        //$members = Member::whereNull('deleted_at')->get();
        $members = Member::all();
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
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'password' => 'required|string|min:8|confirmed',
            'cader' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'batch' => 'required|integer',
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
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cader' => $request->cader,
            'designation' => $request->designation,
            'batch' => $request->batch,
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
            'mobile' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $member->id,
            'password' => 'nullable|string|min:8|confirmed',
            'cader' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'batch' => 'nullable|integer',
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
        $member->save();
       return redirect()->route('members.index')->with('success', 'Member updated successfully.');

    }
  /*  public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }*/

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
    public function bulk_upload_members_362025(Request $request)
    {
        // Validatin request
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:3072',
        ]);
        // Import the data
        Excel::import(new MembersImport, $request->file('file'));
       return redirect()->route('members.index')->with('success', 'Members uploaded successfully!');
    }

   public function bulk_upload_members(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls,csv|max:3072',
    ]);

    try {
        Excel::import(new MembersImport, $request->file('file'));
        return redirect()->route('members.index')->with('success', 'Members uploaded successfully!');
    } catch (ValidationException $e) {
        return back()->with(['failures' => $e->failures()]);
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
