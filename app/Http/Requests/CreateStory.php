<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStory extends FormRequest
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
            'story_image' => 'bail|required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'story_caption' => 'required',
            'story_title' => 'required',
            'story_section' => 'required',
            'story_body' => 'required',
            'tags' => 'required|regex: /^[a-zA-Z0-9,-]*$/'

        ];
    }
}
