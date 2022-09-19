<?php

namespace App\Http\Requests\Issues;

use Illuminate\Foundation\Http\FormRequest;

class IssueUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'slug' => 'required',

            'categories' => 'required',
            'categories.*.id' => 'required',
            'categories.*.category_id' => 'required',

            'sub_categories' => 'required',
            'sub_categories.*.id' => 'required',
            'sub_categories.*.sub_category_id' => 'required',

            'images' => 'required',
            'images.*.id' => 'required',
            'images.*.size' => 'required',
            'images.*.path' => 'required',
            'images.*.name' => 'required',
            'images.*.extension' => 'required'
        ];
    }
}
