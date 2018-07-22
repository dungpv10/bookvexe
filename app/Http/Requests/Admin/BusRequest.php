<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BusRequest extends FormRequest
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
            'bus_name' => 'required|max:255|min:2',
            'bus_type_id' => 'required',
            'start_point' => 'required|max:255',
            'start_time' => 'required|max:255',
            'amenities' => 'nullable|max:255',
            'bus_reg_number' => 'required|max:255',
            'number_seats' => 'required|integer',
            'end_point' => 'required|max:255',
            'end_time' => 'required|max:255',
            'image_bus[]' => 'mimes:jpeg,jpg,png | max:1000',
        ];
    }
}
