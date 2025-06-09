<?php
namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Validation\ValidationException;

class MembersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithEvents
{
    use SkipsFailures;

    public function model(array $row)
    {

        return new Member([
            'name' => $row['name'],
            'mobile' => $row['mobile'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']), // Add password hash
            'cader' => $row['cader'], // Fix: You had 'cader' in model but 'cadre' in rule
            'designation' => $row['designation'],
            'batch' => $row['batch'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required|string|max:255',
            '*.mobile' => 'required|string|max:20',
            '*.email' => 'required|email|unique:members,email',
            '*.password' => 'required|string|min:8',
            '*.password_confirmation' => 'required|string|same:password',
            '*.cader' => 'required|string|max:255',
            '*.designation' => 'required|string|max:255',
            '*.batch' => 'required|integer',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute must be a valid email address.',
            'unique' => 'The :attribute has already been taken.',
            'same' => 'The :attribute must match the password field.',
        ];
    }


    public static function beforeImport(BeforeImport $event)
    {
        $sheet = $event->getReader()->getSheetIterator()->current();
        $heading = $sheet->toArray()[0]; // get first row (headers)

        $missingHeaders = [];
        $required = (new self())->requiredHeaders;

        foreach ($required as $header) {
            if (!in_array(strtolower(trim($header)), array_map('strtolower', $heading))) {
                $missingHeaders[] = $header;
            }
        }

        if (!empty($missingHeaders)) {
            throw ValidationException::withMessages([
                'file' => ['Missing required columns: ' . implode(', ', $missingHeaders)],
            ]);
        }
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => [self::class, 'beforeImport'],
        ];
    }


    public function onFailure(Failure ...$failures)
    {
        // You can log or store $failures if needed
        foreach ($failures as $failure) {
        // Log the failure or handle it as needed
        \Log::error('Row ' . $failure->row() . ': ' . implode(', ', $failure->errors()));
       }
    }
}
