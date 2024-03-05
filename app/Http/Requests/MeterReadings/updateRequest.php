<?php

namespace App\Http\Requests\MeterReadings;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return ;
    }

    // /**
    //  * Get the error messages for the defined validation rules.
    //  *
    //  * @return array
    //  */
    // public function messages()
    // {
    //     return (new Customer())->rulesMessages;
    // }

    // /**
    //  * Get custom attributes for validator errors.
    //  *
    //  * @return array
    //  */
    // public function attributes()
    // {
    //     return (new Customer())->rulesAttributes;
    // }
}
