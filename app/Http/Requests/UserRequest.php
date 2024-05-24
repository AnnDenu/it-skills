<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|max:255',
            'avatar'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:6',
            'role'=> 'required|in:admin,user',
        ];
    }
}
