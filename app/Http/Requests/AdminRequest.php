<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
          "name" => "required",
          "email" => ($this->method() == "PUT") ? "required|string" : "required|email|unique:admins",
          'password' => ($this->method() == "PUT") ? "" : 'required|confirmed|min:6',
          'admin_image' => ($this->method() == "PUT") ? "" : 'required',
        ];
    }
}
