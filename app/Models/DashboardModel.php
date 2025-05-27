<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DashboardModel
{
    public function totalcount($table)
    {
        return DB::table($table)->count();
    }

    public function getAlltopic()
    {
        return DB::table('topic')->get(); 
    }
}
