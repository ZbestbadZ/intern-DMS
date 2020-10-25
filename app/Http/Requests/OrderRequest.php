<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'cus_name' => 'required|max:50|min:3|string',
            'cus_phone' => 'required|numeric',
            'cus_address' => 'required|max:100|string',
            'products' => 'required',
        ];
    }
}
