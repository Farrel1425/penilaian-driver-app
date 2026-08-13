<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\RatingAnalyticsService;
use App\Support\Admin\RatingReportFilters;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MonitoringController extends Controller
{
    public function __invoke(Request $request, RatingAnalyticsService $analytics): View
    {
        $filters = RatingReportFilters::fromRequest($request);

        return view('admin.monitoring.index', [
            'filters' => $filters,
            'branches' => $analytics->branches(),
            'ratings' => $analytics->monitoring($filters)['ratings'],
            'analytics' => $analytics,
        ]);
    }
}