<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'name' => 'bail|required|regex: /[a-zA-Z]/',
            'dob' => 'bail|required|date',
            'email' => 'bail|required|email|unique:users',
            'phone' => 'bail|required|numeric|digits:11',
            'gender' => 'bail|required',
            'image' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'password' => 'required|min:6|'
        ];
    }
}
