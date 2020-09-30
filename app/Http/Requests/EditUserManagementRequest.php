<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserManagementRequest extends FormRequest
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
            'email' =>'required|max:50|email',
            'password' => 'required|min:3|max:100|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:3|max:100',
            'sex' => 'required',
            'birthday' => 'required|date',
            'about' => 'required|max:100|min:3',
            'about_title' => 'required|max:100|min:3',
            'phone' => 'nullable|numeric',
            'address' => 'nullable|string',
            'height' => 'nullable|integer',
            'job' => 'nullable|integer',
            'figure' => 'nullable|integer',
            'anual_income' => 'nullable|integer',
            'matching_expect' => 'nullable|integer',
            'holiday'=> 'nullable|integer',
            'aca_background' => 'nullable|integer',
            'housemate' => 'nullable|integer',
            'birthplace' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'birthday.date' => 'Birthday must be date',
            'password.same' => 'Password must be the same at password confirm',
        ];
    }
}
