<?php

namespace App\Http\Requests\PaymentMethods;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;

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
        $rules = (new PaymentMethod())->rules;
        $rules['slug'] .= ', ' . $this->id;
        return $rules;
    }
}
