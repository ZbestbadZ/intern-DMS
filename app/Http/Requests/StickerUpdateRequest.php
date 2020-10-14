<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StickerUpdateRequest extends FormRequest
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
        $id = $this->id;
        return  [
            'name' => 'required|max:50|unique:items,name,'.$id,
            'image'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|max:2000000|min:100'
        ];
    }
    
}
