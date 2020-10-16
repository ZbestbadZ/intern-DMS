<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserManagementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|min:3',
            'username'=>'required|max:50|min:3',
            'email' =>'required|max:50|unique:users',
            'password' => 'required|min:3|max:50|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:3|max:50',
            'sex' => 'required',
            'birthday' => 'required|date|before:now|after:-50 years',
            'about' => 'required|max:100|min:3',
            'about_title' => 'required|max:100|min:3',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string',
            'height' => 'nullable',
            'job' => 'nullable',
            'figure' => 'nullable',
            'anual_income' => 'nullable',
            'matching_expect' => 'nullable',
            'holiday'=> 'nullable',
            'aca_background' => 'nullable',
            'housemate' => 'nullable',
            'birthplace' => 'nullable',
            'hobby' => 'nullable'
        ];

    }

    public function messages()
    {
        return [
            'birthday.date' => 'Birthday must be date',
            'password.same' => 'Password must be the same at password confirm',
            'password.required_with' => 'Password must be the same at password confirm'
        ];
    }

}
