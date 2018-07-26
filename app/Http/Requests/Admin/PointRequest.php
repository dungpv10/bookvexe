<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PointRequest extends FormRequest
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
            'point_type_id' => 'required|integer',
            'route_id' => 'required',
            'drop_time' => 'required|max:255',
            'landmark' => 'required|max:255',
            'address' => 'required|max:255',
        ];
    }
}
