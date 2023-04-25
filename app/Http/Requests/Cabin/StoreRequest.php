<?php

namespace App\Http\Requests\Cabin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'cabin_type' => 'required',
            'cabin_status' => 'required',
            'name' => 'required|string|between:3,50',
            'long_term' => 'nullable',
            'electric_meter' => 'nullable',
        ];
    }
}
