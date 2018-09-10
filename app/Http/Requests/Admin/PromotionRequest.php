<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
        $rules =  [
            'code' => 'required|unique:promotions,code',
            'amount' => 'required|integer',
            'status' => 'required',
//            'agent_id' => 'required',
            'promotion_type' => 'required',
            'expiry_date' => 'required|date'
        ];

        $routeName = $this->route()->getName();

        if($routeName == 'promotions.update'){
            $promotionId = $this->route('promotion');

            $rules = array_replace($rules, [
               'code' => 'required|unique:promotions,code,' . $promotionId
            ]);
        }

        return $rules;
    }
}
