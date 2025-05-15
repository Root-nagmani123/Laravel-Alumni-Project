<?php

namespace App\Imports;
use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class MembersImport implements ToModel, WithHeadingRow, SkipsOnFailure
{

    public function model(array $row)
    {
        // Check for duplicates
        if (Member::where('mobile', $row['mobile'])->orWhere('email', $row['email'])->exists()) {
            return null;
        }
        return new Member([
            'name' => $row['name'],
            'mobile' => $row['mobile'],
            'email' => $row['email'],
            'cader' => $row['cader'],
            'designation' => $row['designation'],

        ]);
    }

    public function onFailure(Failure ...$failures)
    {
        // Handle failures
    }
}
