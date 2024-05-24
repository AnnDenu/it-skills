<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'content'=>'required|max:255',
            'course_id'=>'required',
            'creator'=>'required',
            'editor'=>'required',
        ];
    }
}
