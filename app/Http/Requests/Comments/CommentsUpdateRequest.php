<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class CommentsUpdateRequest extends FormRequest
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
            'issue_id' => 'required',
            'body' => 'required',

            'images' => 'required',
            'images.*.id' => 'required',
            'images.*.size' => 'required',
            'images.*.path' => 'required',
            'images.*.name' => 'required',
            'images.*.extension' => 'required'
        ];
    }
}
