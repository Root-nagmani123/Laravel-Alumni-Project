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
            $row = array_change_key_case($row->toArray(), CASE_LOWER);

            //  Skip empty rows
            if (empty(array_filter($row))) {
                continue;
            }

            //  Validate header once
            if (!$this->headerValidated) {
                $headers = array_keys($row);
                $missingHeaders = array_diff($this->requiredHeaders, $headers);

                if (!empty($missingHeaders)) {
                    throw ValidationException::withMessages([
                        'file' => ['Missing required columns: ' . implode(', ', $missingHeaders)],
                    ]);
                }

                $this->headerValidated = true;
            }

            $rowNumber = $index + 2; // Row in Excel (starts at 2 due to heading)

            // Validate data
            $validator = Validator::make($row, [
                'name' => 'required|string|max:255',
                'mobile' => ['required', 'integer', 'regex:/^[0-9]{10,20}$/'],
                'email' => 'required|email|unique:members,email',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|same:password',
                'cader' => 'required|string|max:255',
                'designation' => 'required|string|max:255',
                'batch' => 'required|numeric',

            ], $this->validationMessages());

            if ($validator->fails()) {
                $this->addFailure($rowNumber, $validator->errors()->all());
                continue;
            }

            // Save member
            Member::create([
                'name' => $row['name'],
                'mobile' => $row['mobile'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'cader' => $row['cader'],
                'designation' => $row['designation'],
                'batch' => is_numeric($row['batch']) ? (int) $row['batch'] : $row['batch'],
            ]);
        }

        // Save failures to session if any
        if (!empty($this->failures)) {
            session()->flash('failures', $this->failures);
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
            'regex' => 'The :attribute format is invalid.',
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
