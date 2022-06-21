<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'post_id'=>['required','exists:posts,id'],
            'title'=>['required','string','max:255','min:3'],
            'description'=>['required','string','max:255'],
            'body'=>['required','string'],
            'category_id'=>['required','integer','exists:categories,id'],
            'tag_ids'=>['required','array'],
            'tag_ids.*'=>['integer','exists:tags,id']
        ];
    }
}
