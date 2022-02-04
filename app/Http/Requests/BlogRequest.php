<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|min:5|max:255'
            'title' => 'required|min:10|max:255',
            'slug' => 'nullable',
            'description' => 'required|max:255',
            'image' => 'required',
            'blog_category_id' => 'required',
            // 'blog_tag_id' => 'nullable',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'Blog Title',
            'slug' => 'Blog Slug',
            'description' => 'Blog Description',
            'image' => 'Blog Image',
            'blog_category_id' => 'Blog Category',
            // 'blog_tag_id' => 'Blog Tag',
            'created_by' => 'Blog Created date',
            'updated_by' => 'Blog Updated date',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
