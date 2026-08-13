<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RatingEntryController extends Controller
{
    public function __invoke(string $vehicleToken): View
    {
        $vehicle = Vehicle::query()
            ->with('branch')
            ->where('qr_token', $vehicleToken)
            ->firstOrFail();

        if ($vehicle->status !== Vehicle::STATUS_ACTIVE) {
            throw new HttpException(403, 'Kendaraan tidak aktif.');
        }

        return view('passenger.rating-entry', compact('vehicle'));
    }
}