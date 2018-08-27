<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
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
            'agent_name' => 'required|min:2|max:200',
            'agent_address' => 'required|min:2|max:200',
            'agent_license' => 'required|min:2|max:200',
            'agent_representation' => 'required|min:2|max:200',
            'logo_file' => 'required|mimes:jpeg,jpg,png',
            'agent_email' => 'required|email|min:2|max:200',
            'agent_website' => 'required|min:2|max:200|url',
        ];
    }
}
