<?php

namespace App\Http\Requests;

use App\Enums\MariageStatus;
use App\Enums\NamePrefix;
use App\Enums\SpiritualStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRequest extends FormRequest
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
            'shepard_id' =>                 'sometimes|nullable|exists:users,id',
            'spiritual_status' =>           ['required', new EnumValue(SpiritualStatus::class, false)],

            'name_prefix' =>                ['required', new EnumValue(NamePrefix::class, false)],
            'first_name' =>                  'required|min:3',
            'last_name' =>                  'required|min:3',
            'nickname' =>                   'required|min:2',
            'gender' =>                     ['required', Rule::in(['male', 'female'])],
            'profile_image' =>              'image|max:4096',
            'birthday' =>                   'required|date',
            'race' =>                       'required',
            'nationality' =>                'required',

            'mobile_number' =>              'required|alpha_num|digits:10',

            'marital_status' =>            ['required', new EnumValue(MariageStatus::class, false)],

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

        // Differentiate between POST AND PUT.
        switch ($this->getMethod())
        {
            // Handle create.
            case 'post':
            case 'POST':
                $rules += [
                    'idcard' => ['required', 'alpha_num', 'digits:13', 'unique:users'],
                    'email' =>  ['sometimes', 'nullable', 'email', 'unique:users']
                ];
                break;

            // Handle update.
            case 'put':
            case 'PUT':
                $rules += [
                    'idcard' => ['required', 'alpha_num', 'digits:13', Rule::unique('users')->ignore($this->route('member'))],
                    'email' =>  ['sometimes', 'nullable', 'email', Rule::unique('users')->ignore($this->route('member'))]
                ];
                break;
        }

        return $rules;
    }


    private function addressValidation($name) {
        return [
            $name . '_province_id' => 'required|exists:provinces,id',
            $name . '_district_id' => 'required|exists:districts,id',
            $name . '_sub_district_id' => 'required|exists:sub_districts,id',
            $name . '_detail' => 'required|min:5',
            $name . '_postcode' => 'required|alpha_num|digits:5',
        ];
    }
}
