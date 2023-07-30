<?php

namespace App\Http\Controllers;

use App\Services\Settings\SettingInterface;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingInterface;

    public function __construct(SettingInterface $settingInterface)
    {
        $this->settingInterface = $settingInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            return view('settings.pages.' . $request->tab, ['tab' => $request->tab]);
        } catch (Exception $ex) {
            abort(404, 'Page not found!');
        }
    }
}
