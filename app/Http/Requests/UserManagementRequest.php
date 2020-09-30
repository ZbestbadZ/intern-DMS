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
            'password' => 'required|min:3|max:50',
            'sex' => 'boolean',
            'birthday' => 'date',
        ];

    }

    public function messages()
    {
        return [
            'birthday.date' => 'Birthday must be date',
        ];
    }

}
