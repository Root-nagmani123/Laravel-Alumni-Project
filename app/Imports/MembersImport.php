<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembersImport implements ToCollection, WithHeadingRow
{
    public $failures = [];

    protected $requiredHeaders = [
        'name', 'mobile', 'email', 'password',
        'password_confirmation', 'cader', 'designation', 'batch'
    ];

    protected $headerValidated = false;

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $row = $row->toArray();
            dd($rows);
            // ✅ Check headers only once, on the first row
            if (!$this->headerValidated) {
                $headers = array_keys($row);
                $missingHeaders = array_diff(
                    array_map('strtolower', $this->requiredHeaders),
                    array_map('strtolower', $headers)
                );

                if (!empty($missingHeaders)) {
                    throw ValidationException::withMessages([
                        'file' => ['Missing required columns: ' . implode(', ', $missingHeaders)],
                    ]);
                }

                $this->headerValidated = true;
            }

            $rowNumber = $index + 2; // For Excel line number (after heading)

            $validator = Validator::make($row, [
                'name' => 'required|string|max:255',
                'mobile' => 'required|string|max:20',
                'email' => 'required|email|unique:members,email',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|same:password',
                'cader' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'batch' => 'required|integer',
            ], $this->validationMessages());

            if ($validator->fails()) {
                $this->addFailure($rowNumber, $validator->errors()->all());
                continue;
            }

            Member::create([
                'name' => $row['name'],
                'mobile' => $row['mobile'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'cader' => $row['cader'],
                'designation' => $row['designation'],
                'batch' => $row['batch'],
            ]);
        }

        if (!empty($this->failures)) {
            \Log::error('Import Failures', $this->failures);
        }
    }

    public function validationMessages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute must be a valid email address.',
            'unique' => 'The :attribute has already been taken.',
            'same' => 'The :attribute must match the password field.',
        ];
    }

    protected function addFailure($rowNumber, array $errors)
    {
        $this->failures[] = [
            'row' => $rowNumber,
            'errors' => $errors,
        ];
    }
}
