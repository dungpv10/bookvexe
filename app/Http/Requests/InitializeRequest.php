<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InitializeRequest extends FormRequest
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
            'initialize_name' => 'required|min:3|max:255',
            'number_customer' => 'required|integer',
            'driver_id' => 'required',
            'car_accessory_id' => 'required',
            'start_time' => 'required|date',
            'bus_id' => 'required'
        ];
    }
}
