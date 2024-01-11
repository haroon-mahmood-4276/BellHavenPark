<?php

namespace App\Http\Controllers;

use App\Services\BookingTaxes\BookingTaxInterface;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $bookingTaxInterface;

    public function __construct(BookingTaxInterface $bookingTaxInterface)
    {
        $this->bookingTaxInterface = $bookingTaxInterface;
    }
    
    public function index(Request $request)
    {
        try {

            $taxes = $this->bookingTaxInterface->get();

            return view('settings.pages.' . $request->tab, ['tab' => $request->tab, 'taxes' => $taxes]);
        } catch (Exception $ex) {
            abort(404, 'Page not found!');
        }
    }

    public function update(Request $request)
    {
        try {
            $inputs = $request->except(['_token', '_method', 'tab']);
            settings_update(array_keys($inputs), array_values($inputs));

            session()->flash('toaster_success', 'Settings Updated!');
            return redirect()->route('settings.index', ['tab' => $request->tab]);
        } catch (Exception $ex) {
            abort(404, 'Page not found!');
        }
    }
}
