<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Passenger\StoreRatingRequest;
use App\Models\Driver;
use App\Models\Question;
use App\Models\Rating;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PassengerFlowController extends Controller
{
    public function vehicle(string $vehicleToken): View
    {
        return view('passenger.vehicle', ['vehicle' => $this->activeVehicle($vehicleToken)]);
    }

    public function drivers(string $vehicleToken): View
    {
        $vehicle = $this->activeVehicle($vehicleToken);
        $drivers = Driver::query()
            ->where('branch_id', $vehicle->branch_id)
            ->active()
            ->orderBy('full_name')
            ->get();

        return view('passenger.drivers', compact('vehicle', 'drivers'));
    }

    public function driver(string $vehicleToken, Driver $driver): View
    {
        $vehicle = $this->activeVehicle($vehicleToken);
        $this->ensureSelectableDriver($vehicle, $driver);

        return view('passenger.driver-detail', compact('vehicle', 'driver'));
    }

    public function assessment(string $vehicleToken, Driver $driver): View
    {
        $vehicle = $this->activeVehicle($vehicleToken);
        $this->ensureSelectableDriver($vehicle, $driver);

        $questions = Question::query()
            ->with('options')
            ->active()
            ->ordered()
            ->get()
            ->groupBy('target_type');

        return view('passenger.assessment', compact('vehicle', 'driver', 'questions'));
    }

    public function submit(StoreRatingRequest $request, string $vehicleToken, Driver $driver): RedirectResponse
    {
        $vehicle = $this->activeVehicle($vehicleToken);
        $this->ensureSelectableDriver($vehicle, $driver);
        $questions = Question::query()->with('options')->active()->ordered()->get();
        $answers = $request->validatedAnswers($questions);

        $rating = DB::transaction(function () use ($vehicle, $driver, $answers): Rating {
            $rating = Rating::query()->create([
                'branch_id' => $vehicle->branch_id,
                'vehicle_id' => $vehicle->id,
                'driver_id' => $driver->id,
                'submitted_at' => now(),
            ]);

            foreach ($answers as $answer) {
                $rating->answers()->create($answer);
            }

            return $rating;
        });

        return redirect()->route('passenger.rating.success', [$vehicle->qr_token, $rating]);
    }

    public function success(string $vehicleToken, Rating $rating): View
    {
        $vehicle = $this->activeVehicle($vehicleToken);

        abort_unless($rating->vehicle_id === $vehicle->id, 404);

        return view('passenger.success', compact('vehicle', 'rating'));
    }

    private function activeVehicle(string $vehicleToken): Vehicle
    {
        $vehicle = Vehicle::query()->with('branch')->where('qr_token', $vehicleToken)->firstOrFail();

        if ($vehicle->status !== Vehicle::STATUS_ACTIVE) {
            throw new HttpException(403, 'Kendaraan tidak aktif.');
        }

        return $vehicle;
    }

    private function ensureSelectableDriver(Vehicle $vehicle, Driver $driver): void
    {
        abort_unless($driver->status === Driver::STATUS_ACTIVE, 404);
        abort_unless($driver->branch_id === $vehicle->branch_id, 404);
    }
}