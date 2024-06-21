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
        if ($request->has('report_date_range') && !is_null($request->report_date_range) && !empty($request->report_date_range)) {
            $dates = explode('~', $request->report_date_range);
            $data = [
                'report_from' => Carbon::parse(trim($dates[0]))->startOfDay()->timestamp,
                'report_to' => Carbon::parse(trim(isset($dates[1]) ? $dates[1] : $dates[0]))->endOfDay()->timestamp,
                'showDataTable' => true
            ];
        } else {
            $data = [
                'report_from' => now()->startOfDay()->timestamp,
                'report_to' => now()->endOfDay()->timestamp,
                'showDataTable' => false
            ];
        }

        if (request()->ajax()) {
            return $dataTable->with($data)->ajax();
        }

        return $dataTable->with($data)->render('reports.daily', $data);
        // return browserhsotpdf()->view('reports.reports.daily')->format(Format::A4)->save('invoice.pdf');
    }
}
