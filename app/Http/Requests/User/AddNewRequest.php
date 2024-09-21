<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddNewRequest extends FormRequest
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
            'userName'=>'required|max:255',
            'roleId'=>'required|max:2',
            'contactNumber'=>'required|unique:users,contact_no',
            'employee_id'=>'required|string|max:12|unique:users,employee_id',
            'EmailAddress'=>'required|unique:users,email',
            'password'=>'required',
            'designation'=>'required|string|max:50',
        ];
    }
}
