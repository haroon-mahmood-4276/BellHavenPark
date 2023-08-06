<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index(Request $request)
    {
        try {
            return view('settings.pages.' . $request->tab, ['tab' => $request->tab]);
        } catch (Exception $ex) {
            abort(404, 'Page not found!');
        }
    }

    public function update(Request $request)
    {
        try {
            $inputs = $request->except(['_token', '_method', 'tab']);
            settings_update(array_keys($inputs), array_values($inputs));

            return redirect()->route('settings.index', ['tab' => $request->tab]);
        } catch (Exception $ex) {
            abort(404, 'Page not found!');
        }
    }
}
