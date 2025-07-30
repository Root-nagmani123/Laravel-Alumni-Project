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
            'group_name' => 'required|string|max:255',
            'member_ids' => 'required|array|min:1',
            'member_ids.*' => 'exists:members,id',
            'status' => 'nullable|in:0,1'
        ];
    }

    public function messages(): array
    {
        return [
            'group_name.required' => 'Group Name is required.',
            'member_ids.required' => 'At least one member is required.',
            'member_ids.*.exists' => 'One or more selected members do not exist.',
            'status.in' => 'Invalid status value.',
        ];
    }
}
