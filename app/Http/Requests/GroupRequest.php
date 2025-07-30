<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'user_id' => 'required|array|min:1',
            'user_id.*' => 'exists:members,id',
            'status' => 'nullable|in:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ' Group Name is required.',
            'user_id.required' => 'At least one user is required.',
            'user_id.*.exists' => 'One or more selected users do not exist.',
            'status.in' => 'Invalid status value.',
        ];
    }
}
