<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoHtmlOrScript;

class SafeContentRequest extends FormRequest
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
            'content' => ['required', 'string', 'max:5000', new NoHtmlOrScript()],
            'comment' => ['required', 'string', 'max:1000', new NoHtmlOrScript()],
            'title' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
            'description' => ['nullable', 'string', 'max:5000', new NoHtmlOrScript()],
            'subject' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
            'message' => ['required', 'string', 'max:1000', new NoHtmlOrScript()],
            'modalContent' => ['nullable', 'string', 'max:5000', new NoHtmlOrScript()],
            'userSubject' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
            'userMessage' => ['required', 'string', 'max:1000', new NoHtmlOrScript()],
            'forum_name' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
            'forum_description' => ['nullable', 'string', 'max:5000', new NoHtmlOrScript()],
            'typeSelect' => ['required', 'string', 'max:255', new NoHtmlOrScript()],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'content.required' => 'Content is required.',
            'content.max' => 'Content cannot exceed 5000 characters.',
            'comment.required' => 'Comment is required.',
            'comment.max' => 'Comment cannot exceed 1000 characters.',
            'title.required' => 'Title is required.',
            'title.max' => 'Title cannot exceed 255 characters.',
            'description.max' => 'Description cannot exceed 5000 characters.',
            'subject.required' => 'Subject is required.',
            'subject.max' => 'Subject cannot exceed 255 characters.',
            'message.required' => 'Message is required.',
            'message.max' => 'Message cannot exceed 1000 characters.',
            'modalContent.max' => 'Content cannot exceed 5000 characters.',
            'userSubject.required' => 'Subject is required.',
            'userSubject.max' => 'Subject cannot exceed 255 characters.',
            'userMessage.required' => 'Message is required.',
            'userMessage.max' => 'Message cannot exceed 1000 characters.',
            'forum_name.required' => 'Forum name is required.',
            'forum_name.max' => 'Forum name cannot exceed 255 characters.',
            'forum_description.max' => 'Forum description cannot exceed 5000 characters.',
            'typeSelect.required' => 'Type selection is required.',
            'typeSelect.max' => 'Type selection cannot exceed 255 characters.',
        ];
    }
}
