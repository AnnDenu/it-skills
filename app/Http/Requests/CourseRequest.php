<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            "description"=> "required|max:255",
            "image"=> "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "category_id"=> "required",
            "user_id"=> "required",
        ];
    }
}
