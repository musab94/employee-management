<?php

namespace App\Http\Requests;

use App\Services\Traits\ResponseCodeTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class StoreEmpolyeeRequest extends FormRequest
{
    use ResponseCodeTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $id = $this->route('id');
        return [
            'employee_details' => [
                'required',
                'array'
            ],
            'employee_details.department_id' => [
                'required',
                'exists:App\Models\Department,id'
            ],
            'employee_details.first_name' => [
                'required'
            ],
            'employee_details.last_name' => [
                'required'
            ],
            'employee_details.email' => [
                'required',
                Rule::unique('App\Models\Employee', 'email')->ignore($id)
            ],
            'employee_details.dob' => [
                'required',
                'date_format:Y-m-d'
            ],
            'contact_details' => [
                'required',
                'array'
            ],
            'contact_details.*.phone_number' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10'
            ],
            'address_details' => [
                'required',
                'array'
            ],
            'address_details.*.address_line_1' => [
                'required'
            ],
            'address_details.*.address_line_2' => [
                'sometimes',
                'required'
            ],
            'address_details.*.city' => [
                'required'
            ],
            'address_details.*.state' => [
                'required'
            ],
            'address_details.*.country' => [
                'required'
            ],
            'address_details.*.postal_code' => [
                'required',
                'max:6',
                'min:6'
            ],
            'address_details.*.type' => [
                'required',
                Rule::in(['permanent','current'])
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = self::getResponseCode(101);
        $response['data'] = $validator->errors();
        throw new HttpResponseException(response()->json($response));
    }
}
