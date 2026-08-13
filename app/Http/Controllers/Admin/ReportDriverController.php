<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\RatingAnalyticsService;
use App\Support\Admin\RatingReportFilters;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportDriverController extends Controller
{
    public function __invoke(Request $request, RatingAnalyticsService $analytics): View
    {
        $filters = RatingReportFilters::fromRequest($request);

        return view('admin.reports.drivers', [
            'filters' => $filters,
            'branches' => $analytics->branches(),
            'data' => $analytics->driverReport($filters),
        ]);
    }
}