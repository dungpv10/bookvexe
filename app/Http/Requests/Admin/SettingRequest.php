<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => 'required|max:100',
            'logo_img' => 'mimes:jpg,jpeg,png|nullable',
            'favicon_img' => 'mimes:jpg,jpeg,png|nullable',
            'smtp_host' => 'required|max:255',
            'smtp_username' => 'required|max:255',
            'smtp_password' => 'required|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required'

        ];
    }
}
