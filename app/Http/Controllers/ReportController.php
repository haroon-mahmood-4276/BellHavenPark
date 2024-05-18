<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\LaravelPdf\Enums\Format;

class ReportController extends Controller
{
    public function daily()
    {
        return browserhsotpdf()->view('reports.reports.daily')->format(Format::A4)->save('invoice.pdf');
    }
}
