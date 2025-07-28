<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'user_id'     => 'required|array',// one user alredy accept 
            'user_id.*'   => 'integer|exists:members,id',
            'type'         => 'required|string|in:like,comment,add,topic,broadcast,event',
            'message'      => 'required|string',
            'from_user_id' => 'nullable|integer|exists:members,id',
            'source_id'    => 'nullable|integer',// post_id, forum_id, topic_id, broadcast_id, event_id
            'source_type'  => 'nullable|string'// post, forum, forum, broadcast, event
            //
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'The user ID field is required.',
            'user_id.array' => 'The user ID must be an array.',
            'user_id.exists' => 'The user ID must be valid.',
            'type.required' => 'The type field is required.',
            'type.string' => 'The type must be a string.',
            'type.in' => 'The type must be one of the following: like, comment, add, topic, broadcast, event.',
            'message.required' => 'The message field is required.',
            'message.string' => 'The message must be a string.',
            'from_user_id.integer' => 'The from user ID must be an integer.',
            'from_user_id.exists' => 'The from user ID must be valid.',
            'source_id.integer' => 'The source ID must be an integer.',
            'source_type.string' => 'The source type must be a string.',
        ];
    }
}
