<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'first_name' => 'required|string|between:3,50',
            'last_name' => 'required|string|between:3,50',
            'email' => 'nullable|email',
            'dob' => 'nullable|date',
            'phone' => 'nullable|string|digits_between:1,20',
            'address' => 'nullable|string',
            'telephone' => 'nullable|string|digits_between:1,20',
            'id_details' => 'nullable|string',
            'id_address' => 'nullable|string',
            'comments' => 'nullable|string',
            'id_type' => 'nullable',
            'referenced_by' => 'nullable|between:1,255',
            'tenants' => 'nullable|array',
            'tenants.*.tenant_name' => 'required|string|between:1,50',
            'tenants.*.tenant_phone' => 'nullable|string|digits_between:1,20',
            'tenants.*.tenant_dob' => 'nullable|date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tenants.*.tenant_name.required' => 'Tenant name is required',
            'tenants.*.tenant_name.string' => 'Tenant name must be a string',
            'tenants.*.tenant_name.between' => 'Tenant name must be between :min and :max characters',
            'tenants.*.tenant_phone.required' => 'Tenant phone is required',
            'tenants.*.tenant_phone.string' => 'Tenant name phone be a string',
            'tenants.*.tenant_phone.digits_between' => 'Tenant phone must be between :min and :max digits',
            'tenants.*.tenant_phone.dob' => 'Tenant dob must be valid date',
        ];
    }
}
