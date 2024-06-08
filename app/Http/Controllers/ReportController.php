<?php

namespace App\Http\Controllers;

use App\DataTables\ReportsDataTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Enums\Format;

class ReportController extends Controller
{
    public function daily(Request $request, ReportsDataTable $dataTable)
    {
        if ($request->has('booking_date_range') && !is_null($request->booking_date_range) && !empty($request->booking_date_range)) {
            $dates = explode('-', $request->booking_date_range);
            $data = [
                'booking_from' => Carbon::parse(trim($dates[0])),
                'booking_to' => Carbon::parse(trim(isset($dates[1]) ? $dates[1] : $dates[0])),
                'showDataTable' => true
            ];
        } else {
            $data = [
                'booking_from' => now(),
                'booking_to' => now(),
                'showDataTable' => false
            ];
        }

        if (request()->ajax()) {
            return $dataTable->ajax();
        }

        return $dataTable->render('reports.daily', $data);
        return view('reports.daily');
        return browserhsotpdf()->view('reports.reports.daily')->format(Format::A4)->save('invoice.pdf');
    }
}
