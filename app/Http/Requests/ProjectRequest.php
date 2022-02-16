<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'author' => 'required|string|min:3|max:50',
            'categories' => 'nullable|string',
            'release_date' => 'required|date:Y-m-d',
            'update_date' => 'nullable|date:Y-m-d',

            'image_small' => 'nullable|string',
            'image_medium' => 'nullable|string',
            'image_large' => 'nullable|string',

            'project_url' => 'nullable|string',
            'project_version' => 'nullable|string',
            'description' => 'nullable|string',
            'visible' => 'nullable|in:yes,1,true,on'
        ];
    }
}
