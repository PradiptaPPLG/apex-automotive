<?php

namespace App\Http\Controllers;

use App\Models\CustomerVehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GarageController extends Controller
{
    /**
     * Store a newly registered vehicle into the user's garage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'brand' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'year' => ['nullable', 'integer', 'min:1980', 'max:' . (date('Y') + 1)],
            'color' => ['nullable', 'string', 'max:60'],
            'license_plate' => ['nullable', 'string', 'max:20'],
            'vin' => ['nullable', 'string', 'max:50'],
            'mileage_km' => ['nullable', 'integer', 'min:0'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        auth()->user()->customerVehicles()->create($request->only([
            'brand', 'model', 'year', 'color',
            'license_plate', 'vin', 'mileage_km', 'notes',
        ]));

        return redirect()->route('service.create')
            ->with('success', 'Kendaraan berhasil didaftarkan ke My Garage!');
    }

    /**
     * Remove a vehicle from the user's garage.
     */
    public function destroy(CustomerVehicle $vehicle): RedirectResponse
    {
        abort_if($vehicle->user_id !== auth()->id(), 403);

        $vehicle->delete();

        return back()->with('success', 'Kendaraan berhasil dihapus dari garage.');
    }
}
