<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"=> "required|max:255",
            "content"=> "required|max:255",
            'document' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:2048',
            "type_of_activity"=> "required|max:255",
            "chapter_id"=> "required",
        ];
    }
}
