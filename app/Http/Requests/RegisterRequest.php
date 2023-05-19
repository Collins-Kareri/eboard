<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'=>['required','email','unique:users'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'job_title'=>['required'],
            'phone_number'=>['required'],
            'password'=>['required',Password::min(8)->mixedCase()->numbers()->symbols()->letters()]
        ];
    }
}