<?php

use Illuminate\Support\Facades\DB;


if (!function_exists('MentorList')) {
    function MentorList()
    {
        $user_id = auth()->guard('user')->user()->id;

    $mentor_connections = DB::table('mentor_requests')
        ->join('members', 'mentor_requests.Mentor_ids', '=', 'members.id')
        ->where('mentor_requests.mentees', $user_id)
        ->select('mentor_requests.id as request_id', 'members.name', 'members.cader as cadre', 'members.batch', 'members.sector','mentor_requests.status')
        ->get();

    return $mentor_connections;
    }
}
if (!function_exists('menteeList')) {
    function menteeList()
    {
       $user_id = auth()->guard('user')->user()->id;    

         $mentee_connections = DB::table('mentee_requests')
        ->join('members', 'mentee_requests.mentees_ids', '=', 'members.id')
        ->where('mentee_requests.mentor', $user_id)
        ->select('mentee_requests.id as request_id', 'members.name', 'members.cader as cadre', 'members.batch', 'members.sector','mentee_requests.status')
        ->get();

    return $mentee_connections;
    }

}