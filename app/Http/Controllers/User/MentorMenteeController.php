<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;
use App\Services\GroupService;
use Illuminate\Http\RedirectResponse;
use App\Models\Member;
use Illuminate\Support\Facades\DB;


class MentorMenteeController extends Controller
{
    public function index()
    {
$user_id = auth()->guard('user')->user()->id;    
$members = DB::table('members')
->select('Service', DB::raw('COUNT(*) as count'))
->groupBy('Service') 
->get();

 $mentee_requests = DB::table('mentee_requests')
        ->join('members', 'mentee_requests.mentor', '=', 'members.id')
        ->where('mentee_requests.mentees_ids', $user_id)
        ->select('mentee_requests.id as request_id', 'members.name','members.cader as cadre', 'members.batch', 'members.sector','mentee_requests.status')
        ->get();

    $mentor_requests = DB::table('mentor_requests')
        ->join('members', 'mentor_requests.mentees', '=', 'members.id')
        ->where('mentor_requests.Mentor_ids', $user_id)
        ->select('mentor_requests.id as request_id', 'members.name', 'members.cader as cadre', 'members.batch', 'members.sector','mentor_requests.status')
        ->get();

         $mentor_connections = DB::table('mentee_requests')
        ->join('members', 'mentee_requests.mentees_ids', '=', 'members.id')
        ->where('mentee_requests.mentor', $user_id)
        ->select('mentee_requests.id as request_id', 'members.name', 'members.cader as cadre', 'members.batch', 'members.sector','mentee_requests.status')
        ->get();

    $mentee_connections = DB::table('mentor_requests')
        ->join('members', 'mentor_requests.Mentor_ids', '=', 'members.id')
        ->where('mentor_requests.mentees', $user_id)
        ->select('mentor_requests.id as request_id', 'members.name', 'members.cader as cadre', 'members.batch', 'members.sector','mentor_requests.status')
        ->get();



        // print_r($members);die;
        return view('user.mentor_mentee', compact('members', 'mentee_requests', 'mentor_requests', 'mentor_connections', 'mentee_connections'));
    }
    function getYears(Request $request) {
        $service = $request->input('service'); 
         $years = Member::where('service', $service)
    ->whereNotNull('batch')
    ->where('batch', '!=', 'NA')
    ->distinct()
    ->pluck('batch');

return response()->json($years);

            }
            public function getCadres(Request $request)
            {
            $service = $request->input('service');
            $year = $request->input('year'); // batch year

            $query = Member::query();

            if (!empty($service)) {
                $query->where('service', $service);
            }

            if (!empty($year)) {
                $query->whereIn('batch', $year);
            }

            $cadres = $query->whereNotNull('cader')
                ->where('cader', '!=', 'NA')
                ->distinct()
                ->pluck('cader');

            return response()->json($cadres);
            }
                public function getSectors(Request $request)
                {
                $service = $request->input('service');
                $year = $request->input('year'); // batch
                $cadre = $request->input('cadre');

                $query = Member::query();

                if (!empty($service)) {
                    $query->where('service', $service);
                }

                if (!empty($year)) {
                    $query->whereIn('batch', $year);
                }

                if (!empty($cadre)) {
                    $query->whereIn('cader', $cadre);
                }

                $sectors = $query->whereNotNull('sector')
                    ->where('sector', '!=', 'NA')
                    ->distinct()
                    ->pluck('sector');

                return response()->json($sectors);
                }
   public function getMentees(Request $request)
{
$service = $request->input('service');
$year = $request->input('year'); // batch
$cadre = $request->input('cadre');
$sector = $request->input('sector');
$dataId = $request->input('dataId');
if($dataId == 'want_become_mentor'){
   $data_get = DB::table('mentor_requests')
    ->select('Mentor_ids')
    ->whereIn('status', [1, 2])
    ->where('mentees', auth()->guard('user')->user()->id)
    ->get();

    $already_mentees = DB::table('mentor_requests')
    ->select('mentees')
    ->whereIn('status', [1, 2, 3])
    ->where('Mentor_ids', auth()->guard('user')->user()->id)
    ->get();
}
if($dataId == 'want_become_mentee'){
   $data_get = DB::table('mentee_requests')
    ->select('mentees_ids')
    ->whereIn('status', [1, 2])
    ->where('mentor', auth()->guard('user')->user()->id)
    ->get();
}
$query = Member::query();
$query->select('id', 'name');


if (!empty($service)) {
    $query->where('service', $service);
}

if (!empty($year)) {
    $query->whereIn('batch', $year);
}

if (!empty($cadre)) {
    $query->whereIn('cader', $cadre);
}

if (!empty($sector)) {
    $query->whereIn('sector', $sector);
}
if (isset($dataId) && !empty($dataId)) {
    if($dataId == 'want_become_mentor'){
        $query->whereNotIn('id', $already_mentees->pluck('mentees')->toArray());
        $query->whereNotIn('id', $data_get->pluck('Mentor_ids')->toArray());
    }
    if($dataId == 'want_become_mentee'){
        $query->whereNotIn('id', $data_get->pluck('mentees_ids')->toArray());
    }
    
}

$mentees = $query->whereNotNull('name')
    ->where('name', '!=', 'NA')
    ->where('status' , 1) 
    ->orderBy('name')
    ->get();

return response()->json($mentees);
}
function want_become_mentor(Request $request)  {
    // print_r($request->all());die;
   $request->validate([
'service' => 'required',
'year' => 'required',
'cadre' => 'required',
'sector' => 'required',
'mentees' => 'required|array',
]);
foreach ($request->input('mentees') as $menteeId) {
    // Validate each mentee ID
    DB::table('mentor_requests')->insert([
    'service'      => $request->input('service'),
    'batch'        => json_encode($request->input('year')),
    'cadre'        => json_encode($request->input('cadre')),
    'sector'       => json_encode($request->input('sector')),
    'Mentor_ids'  => $menteeId, // assuming mentee_id is the ID of the mentee
    'mentees'       =>  $user = auth()->guard('user')->user()->id, // assuming the logged-in user is the mentor
    'status'       => 2, // default status
    'created_at'   => now(),
    'updated_at'   => now(),
]);
}

return redirect()->back()->with('success', 'Your request to become a mentor has been submitted successfully.');
}

function want_become_mentee(Request $request)  {
    // print_r($request->all());die;
   $request->validate([
       'service' => 'required',
       'year' => 'required',
       'cadre' => 'required',
       'sector' => 'required',
       'mentees' => 'required|array',
   ]);

   foreach ($request->input('mentees') as $menteeId) {
       // Validate each mentee ID
       DB::table('mentee_requests')->insert([
           'service'      => $request->input('service'),
           'batch'        => json_encode($request->input('year')),
           'cadre'        => json_encode($request->input('cadre')),
           'sector'       => json_encode($request->input('sector')),
           'mentees_ids'   => $menteeId, // assuming mentee_id is the ID of the mentee
           'mentor'     =>  $user = auth()->guard('user')->user()->id, // assuming the logged-in user is the mentee
           'status'       => 2, // default status
           'created_at'   => now(),
           'updated_at'   => now(),
       ]);
   }

   return redirect()->back()->with('success', 'Your request to become a mentee has been submitted successfully.');
}
function updateRequest(Request $request) : \Illuminate\Http\RedirectResponse {
  
    $table = $request->type === 'mentor' ? 'mentor_requests' : 'mentee_requests';

    DB::table($table)
        ->where('id', $request->id)
        ->update(['status' => $request->status]);
if ($request->status == 1) {
    $message = $request->type === 'mentor' ? 'You are now a mentor.' : 'You are now a mentee.';
}else if($request->status == 3){
    $message = $request->type === 'mentor' ? 'Your mentor request has been rejected.' : 'Your mentee request has been rejected.';
}

    return back()->with('success', 'Request ' . $message . ' successfully.');
}
}