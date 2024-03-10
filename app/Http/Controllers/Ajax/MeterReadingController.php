<?php

namespace App\Http\Controllers\Ajax;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Models\Cabin;
use App\Services\MeterReadings\MeterReadingInterface;
use Exception;
use Illuminate\Http\Request;

class MeterReadingController extends Controller
{
    private $meterReadingInterface;

    public function __construct(MeterReadingInterface $meterReadingInterface)
    {
        $this->meterReadingInterface = $meterReadingInterface;
    }

    public function getPreviousReading(Request $request, Cabin $cabin)
    {
        abort_if(!request()->ajax(), 403);

        try {
            return apiSuccessResponse($this->meterReadingInterface->previousReading($cabin->id, $request->meter_type));
        } catch (GeneralException $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong! ' . $ex->getMessage());
        } catch (Exception $ex) {
            return redirect()->route('booking-sources.index')->withDanger('Something went wrong!');
        }
    }
}
