<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmin extends FormRequest
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
           // 'email' => 'bail|required|email|unique:users,email,'.$user->id,
            'email' => 'bail|required|email|unique:users',
            'password' => 'required|min:6|'
        ];
    }

    // public function messages()
    // {
    //     return [
          
    //         'brand.required' => 'The name of your business is required',
    //         'phone.required' => 'The mobile number is required',
    //         'phone.unique' => 'The mobile number is already registered',
    //         'email.required' => 'The email address is required',
    //         'email.email' => 'Please enter a valid email address',
    //         'email.unique' => 'The email ID you entered already exist',    
    //         'description.required' => 'A short description of your business is required',  
    //         'countries.required' => 'Please select the country',
    //         'cities.required' => 'Please select the city',
           
    //     ];
    // }
}
