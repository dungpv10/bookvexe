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
        $routeName = $this->route()->getName();

        $rules = [
            'bus_name' => 'required|max:255|min:2',
            'bus_type_id' => 'required',
            'start_point' => 'required|max:255',
            'start_time' => 'required|max:255',
            'amenities' => 'nullable|max:255',
            'bus_reg_number' => 'required|max:255|unique:buses,bus_reg_number',
            'number_seats' => 'required|integer',
            'end_point' => 'required|max:255',
            'end_time' => 'required|max:255',
            'image_bus[]' => 'mimes:jpeg,jpg,png | max:1000',
        ];
        if ($routeName == 'bus.update.bus') {

            $busId = $this->route('id');
            $rules = array_merge($rules, [
                'bus_reg_number' => 'required|unique:buses,bus_reg_number,' . $busId
            ]);
        }


        return $rules;
    }
}
