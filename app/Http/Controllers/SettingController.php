<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        if (!request()->ajax()) {
            return view('settings.index');
        } else {
            abort(403);
        }
    }

    public function update(Request $request)
    {
        if (!request()->ajax()) {

            $result = (new Setting())->updateAppSettings($request);

            if (is_a($result, 'Exception')) {
                return redirect()->route('settings.index')->withDanger('Data not saved. Error Code: ' . $result->getCode() . 'Error Message: ' . $result->getMessage());
            }
            return redirect()->route('settings.index')->withSuccess('Data updated.');
        } else {
            abort(403);
        }
    }
}
