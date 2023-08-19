<?php

namespace App\Http\Requests\CabinAssets;

use App\Models\CabinAsset;
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
        $rules = (new CabinAsset())->rules;
        $rules['slug'] .= ', ' . $this->id;
        return $rules;
    }
}
