<?php

namespace App\Http\Requests;

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
          "cat_id" => "required",
          "blog_title" => ($this->method() == "PUT") ? "required" : "required|unique:blogs",
          "blog_content" => "required",
          "blog_image_poster" => ($this->method() == "PUT") ? "max:5240|mimes:jpeg,bmp,png" : "required|max:5240|mimes:jpeg,bmp,png",
          "blog_pdf_file_embed" => ($this->method() == "PUT") ? "max:5240|mimes:pdf" : "max:5240|mimes:pdf",
          "blog_meta_desc" => "required|max:300",
          "blog_meta_key" => "required",
      ];
    }
}
