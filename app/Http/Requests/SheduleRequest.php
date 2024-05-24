<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SheduleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "content"=> "required|max:255",
            "sunrise"=> "required|date_format:H:i",
            "date"=> "required|date_format:Y-m-d",
            "user_id"=>"required",
            "theme_id"=>"required",
        ];
    }
}
