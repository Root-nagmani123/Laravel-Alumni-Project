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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Services\RecentActivityService;

class MemberController extends Controller
{
    protected $recentActivityService;

    public function __construct(RecentActivityService $recentActivityService)
    {
        $this->recentActivityService = $recentActivityService;
    }

    public function index(Request $request)
        {
        //$members = Member::whereNull('deleted_at')->get();
            //$members = Member::all();
            $members_service = Member::select('Service')
    ->where('status', 1)
    ->groupBy('Service')
    ->get();

         $members = Member::orderBy('id', 'desc')
    ->select('id', 'name', 'username', 'mobile', 'email', 'cader', 'designation', 'batch', 'Service','status','sector');

// Search filter
if ($request->filled('search')) { 
    $search = $request->search;
    $members->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('username', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%")
          ->orWhere('mobile', 'like', "%{$search}%");
    });
}

// Service filter (alag se apply karna hoga)
if ($request->filled('serviceFilter')) {
    $serviceFilter = $request->serviceFilter;
    $members->where('Service', $serviceFilter);
}

$members = $members->paginate(10); // har page me 10 records
Paginator::useBootstrap();

            return view('admin.members.index', compact('members', 'members_service'));
        }

    public function create()
        {
            $members = DB::table('members')
    ->select(
        DB::raw('TRIM(Service) as Service'),
          DB::raw('GROUP_CONCAT(DISTINCT TRIM(batch) ORDER BY batch ASC SEPARATOR ",") as batches'),
         DB::raw('GROUP_CONCAT(DISTINCT TRIM(cader) ORDER BY TRIM(cader) ASC SEPARATOR ",") as cader_list'),
        // DB::raw('GROUP_CONCAT(DISTINCT TRIM(sector) ORDER BY TRIM(sector) ASC SEPARATOR ",") as sector_list')
         DB::raw('YEAR(CURDATE()) as current_year')
    )
    // ->where('Service', '=', 'IAS')
    ->groupBy(DB::raw('TRIM(Service)'))
    ->orderBy('Service')
    ->get();
            return view('admin.members.create', compact('members'));
        }

    public function store(Request $request)
        {
        
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:members',
            'mobile' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            
            'cader' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'batch' => 'required',
            'sector' => 'nullable',
            'service' => 'nullable',
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Create a new member
      $data = [
    'name'        => $request->name,
    'username'    => $request->username,
    'mobile'      => $request->mobile,
    'email'       => $request->email,
    'cader'       => $request->cader,
    'designation' => $request->designation,
    'batch'       => $request->batch,
    'sector'      => $request->sector,
    'service'     => $request->service,
];
if ($request->hasFile('profile_pic')) {
        $file = $request->file('profile_pic');
        $path = $file->store('profile_pic', 'public'); 

        $data['profile_pic'] = $path;
    }
    
// Agar password filled hai to add karo
if ($request->filled('password')) {
    $data['password'] = Hash::make($request->password);
}

$member = Member::create($data);
        $this->recentActivityService->logActivity(
            'Member Added',
            'Member',
            auth()->guard('admin')->id(),
            'Added new member: ' . $member->name,
            1, // Assuming 1 represents admin
            $member->id
        );
       return redirect()->route('members.index')->with('success', 'Member added successfully.');
        }
public function edit($id)
{
    try {
        $decryptedId = decrypt($id); // 👈 id decrypt ki

        $member = Member::findOrFail($decryptedId);

        $members = DB::table('members')
            ->select(
                DB::raw('TRIM(Service) as Service'),
                DB::raw('GROUP_CONCAT(DISTINCT TRIM(batch) ORDER BY batch ASC SEPARATOR ",") as batches'),
                DB::raw('GROUP_CONCAT(DISTINCT TRIM(cader) ORDER BY TRIM(cader) ASC SEPARATOR ",") as cader_list'),
                // DB::raw('GROUP_CONCAT(DISTINCT TRIM(sector) ORDER BY TRIM(sector) ASC SEPARATOR ",") as sector_list')
            )
            // ->where('Service', '=', 'IAS')
            ->groupBy(DB::raw('TRIM(Service)'))
            ->orderBy('Service')
            ->get();

        return view('admin.members.edit', compact('member', 'members'));
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        abort(404); // agar id valid nhi hai
    }
}
    public function edit_bkp_s(Member $member)
        {
              $members = DB::table('members')
    ->select(
        DB::raw('TRIM(Service) as Service'),
          DB::raw('GROUP_CONCAT(DISTINCT TRIM(batch) ORDER BY batch ASC SEPARATOR ",") as batches'),
         DB::raw('GROUP_CONCAT(DISTINCT TRIM(cader) ORDER BY TRIM(cader) ASC SEPARATOR ",") as cader_list'),
        DB::raw('GROUP_CONCAT(DISTINCT TRIM(sector) ORDER BY TRIM(sector) ASC SEPARATOR ",") as sector_list')
    )
    ->where('Service', '=', 'IAS')
    ->groupBy(DB::raw('TRIM(Service)'))
    ->orderBy('Service')
    ->get();
            return view('admin.members.edit', compact('member', 'members'));
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
        $profile_path = '';
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $path = $file->store('profile_pic', 'public'); 

            $profile_path = $path;
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
        $member->profile_pic = $profile_path ? $profile_path : $member->profile_pic;
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
        $this->recentActivityService->logActivity(
            'Member Deleted',
            'Member',
            auth()->guard('admin')->id(),
            'Deleted member: ' . $member->name,
            1, // Assuming 1 represents admin
            $member->id
        );
        return redirect()->route('members.index')
                        ->with('success', 'Member deleted successfully.');
    }

    //member bulk upload
    public function bulk_upload_members(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:3072',
        ]);

        $import = new MembersImport();

        try {
            Excel::import($import, $request->file('file'));
        } catch (\Exception $e) {
            return back()->with('failures', [
                [
                    'row' => 'System',
                    'errors' => [$e->getMessage()],
                ]
            ]);
        }

        if (!empty($import->failures)) {
            return back()->with('failures', $import->failures);
        }

        $this->recentActivityService->logActivity(
            'Bulk Member Upload',
            'Member',
            auth()->guard('admin')->id(),
            'Uploaded members in bulk via file: ' . $request->file('file')->getClientOriginalName(),
            1, // Assuming 1 represents admin
            null
        );
        return redirect()->route('members.index')->with('success', 'Members uploaded successfully!');
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
        $this->recentActivityService->logActivity(
            'Member Status Toggled',
            'Member',
            auth()->guard('admin')->id(),
            'Toggled status for member: ' . $member->name . ' to ' . ($member->status ? 'Active' : 'Inactive'),
            1, // Assuming 1 represents admin
            $member->id
        );
        return response()->json(['message' => 'Status updated successfully.']);

    }
    public function getMembers()
{
    // Example: Fetch users from DB (adjust table/model as per your schema)
    $members = \App\Models\User::select('id', 'name')->get();

    return response()->json($members);
}

    function user_search(Request $request)
    {
        $query = $request->get('q');
        $users = Member::where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                    ->orWhere('username', 'like', "%{$query}%");
                })
                ->whereNotNull('username')
                ->limit(20)
                ->get(['id', 'name', 'username']);
        return response()->json($users);
    }

}
