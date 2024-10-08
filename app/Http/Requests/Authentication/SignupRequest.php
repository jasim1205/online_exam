<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'FullName'=>'required|max:255',
            'contact_no'=>'required|unique:users,contact_no',
            'EmailAddress'=>'required|unique:users,email',
            'password'=>'required|min:8|confirmed',
            'gender.required' => 'Please select your gender.',
        ];
    }
    
}
