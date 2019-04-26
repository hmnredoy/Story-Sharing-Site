<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfile extends FormRequest
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
        'name' => 'regex: /[a-zA-Z]/',
        'dob' => 'date',
        'email' => ['required', 'string', 'email', 'max:255',
            Rule::unique('users')->ignore($this->id),
        ],
        'phone' => 'numeric|digits:11',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        //'password' => 'string|min:6|required_if:old_password,',
        
        ];
    }
}
