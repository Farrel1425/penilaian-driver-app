<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleRequest;
use App\Models\Branch;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        $vehicles = Vehicle::query()
            ->with('branch')
            ->withCount('ratings')
            ->when($request->string('search')->toString(), function ($query, string $search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('police_number', 'like', "%{$search}%")
                        ->orWhere('brand', 'like', "%{$search}%")
                        ->orWhere('model', 'like', "%{$search}%")
                        ->orWhere('color', 'like', "%{$search}%");
                });
            })
            ->when($request->integer('branch_id'), fn ($query, int $branchId) => $query->where('branch_id', $branchId))
            ->when($request->string('status')->toString(), fn ($query, string $status) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.vehicles.index', ['vehicles' => $vehicles, 'branches' => Branch::query()->orderBy('name')->get()]);
    }

    public function create(): View
    {
        return view('admin.vehicles.create', ['vehicle' => new Vehicle(), 'branches' => Branch::query()->orderBy('name')->get()]);
    }

    public function store(VehicleRequest $request): RedirectResponse
    {
        $vehicle = Vehicle::query()->create($request->validated() + ['qr_token' => Str::random(40)]);

        return redirect()->route('admin.vehicles.show', $vehicle)->with('status', 'Kendaraan berhasil dibuat.');
    }

    public function show(Vehicle $vehicle): View
    {
        $vehicle->load('branch')->loadCount('ratings');

        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle): View
    {
        return view('admin.vehicles.edit', ['vehicle' => $vehicle, 'branches' => Branch::query()->orderBy('name')->get()]);
    }

    public function update(VehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $vehicle->update($request->validated());

        return redirect()->route('admin.vehicles.show', $vehicle)->with('status', 'Kendaraan berhasil diperbarui.');
    }

    public function regenerateQrToken(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->update(['qr_token' => Str::random(40)]);

        return back()->with('status', 'QR token kendaraan berhasil diperbarui.');
    }

    public function toggleStatus(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->update(['status' => $vehicle->status === Vehicle::STATUS_ACTIVE ? Vehicle::STATUS_INACTIVE : Vehicle::STATUS_ACTIVE]);

        return back()->with('status', 'Status kendaraan berhasil diperbarui.');
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        if ($vehicle->ratings()->exists()) {
            $vehicle->update(['status' => Vehicle::STATUS_INACTIVE]);

            return back()->with('status', 'Kendaraan sudah memiliki rating, jadi dinonaktifkan.');
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('status', 'Kendaraan berhasil dihapus.');
    }
}