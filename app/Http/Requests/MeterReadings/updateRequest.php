<?php

namespace App\Http\Requests\MeterReadings;

use App\Models\MeterReading;
use App\Services\MeterReadings\MeterReadingInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class updateRequest extends FormRequest
{
    private $meterReadingInterface;

    public function __construct(MeterReadingInterface $meterReadingInterface)
    {
        $this->meterReadingInterface = $meterReadingInterface;
    }

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
        $rules = (new MeterReading())->rules;
        unset($rules['cabin_id']);
        return $rules;
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                $previousReading = $this->meterReadingInterface->previousReading($this->cabin_id, $this->meter_type);
                if ($previousReading && $this->reading < $previousReading->reading) {
                    $validator->errors()->add(
                        'reading',
                        'The reading shouln\'t be less than previous reading'
                    );
                }
            }
        ];
    }
}
