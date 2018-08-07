<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:6|max:255',
            'username' => 'required|min:6|max:255|unique:users',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:5|max:255',
            'role_id' => 'required'
        ];
        $routeName = $this->route()->getName();

        if($routeName == 'users.update') {
            $id = $this->get('id');
            $rules = array_merge($rules, [
                'username' => 'required|min:6|max:255|unique:users,' . $id,
                'email' => 'required|unique:users|email|min:5|max:255,' . $id
            ]);
        }

        return $rules;
    }
}
