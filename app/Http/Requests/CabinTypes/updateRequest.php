<?php

namespace App\Http\Requests\CabinTypes;

use App\Models\CabinType;
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
        $rules = (new CabinType())->rules;
        $rules['slug'] .= ', ' . $this->id;
        return $rules;
    }
}
