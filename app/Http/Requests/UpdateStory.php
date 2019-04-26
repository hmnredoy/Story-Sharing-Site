<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStory extends FormRequest
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
            'story_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'story_tags' => 'regex: /^[a-zA-Z0-9,-]*$/'
        ];
    }
}
