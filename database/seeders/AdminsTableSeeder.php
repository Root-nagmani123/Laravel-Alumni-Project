<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
		DB::table('admins')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password123'), // use bcrypt
                'mobile' => '1234567890',
                'isAdmin' => '1',
                'isStatus' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more admins here if needed
        ]);
    }
    
}
