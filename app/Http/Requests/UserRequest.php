<?php

namespace App\Http\Requests;

use App\Enums\MariageStatusEnum;
use App\Enums\SpiritualStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'province_id' =>                'required|exists:provinces,id',
            'district_id' =>                'required|exists:districts,id',
            'church_id' =>                  'required|exists:churches,id',
            'cell_id' =>                    'required|exists:cells,id',
            'spiritual_status' =>           ['required', Rule::in(array_values(SpiritualStatusEnum::constants()->toArray()))],

            'first_name' =>                  'required|min:3',
            'last_name' =>                  'required|min:3',
            'nickname' =>                   'required|min:2',
            'gender' =>                     ['required', Rule::in(['male', 'female'])],
            'birthday' =>                   'required|date',
            'idcard' =>                     'required|alpha_num|digits:13|unique:users',
            'race' =>                       'required',
            'nationality' =>                'required',

            'email' =>                      'required|email|unique:users',
            'mobile_number' =>              'required|alpha_num|digits:10',

             'marital_status' =>            ['required', Rule::in(array_values(MariageStatusEnum::constants()->toArray()))],

            'emergency_name' =>            'required|min:3',
            'emergency_relationship' =>    'required',
            'emergency_mobile_number' =>   'required|alpha_num|digits:10'
        ];

         $rules += $this->addressValidation('original_address');

         //If the users checked that they live the as same address, we no longer have to require the current address.
         if(!$this->request->has('same_address')) {
             $rules += $this->addressValidation('current_address');
         }

         $rules += $this->addressValidation('emergency_address');

        return $rules;
    }

    private function addressValidation($name) {
        return [
            $name . '_province_id' => 'required|exists:provinces,id',
            $name . '_district_id' => 'required|exists:districts,id',
            $name . '_sub_district_id' => 'required|exists:sub_districts,id',
            $name . '_detail' => 'required|min:10',
            $name . '_postcode' => 'required|alpha_num|digits:5',
        ];
    }
}
