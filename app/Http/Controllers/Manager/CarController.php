<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->paginate(10);
        return view('manager.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('manager.cars.form', ['car' => new Car()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'nullable|integer|min:1900|max:'.(date('Y') + 2),
            'transmission' => 'nullable|string|max:100',
            'fuel_type' => 'nullable|string|max:100',
            'image_url' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'status' => 'required|in:available,reserved,sold',
        ]);

        Car::create($validated);

        return redirect()->route('manager.cars.index')->with('success', 'Mobil berhasil ditambahkan ke showroom!');
    }

    public function edit(Car $car)
    {
        return view('manager.cars.form', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'year' => 'nullable|integer|min:1900|max:'.(date('Y') + 2),
            'transmission' => 'nullable|string|max:100',
            'fuel_type' => 'nullable|string|max:100',
            'image_url' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'status' => 'required|in:available,reserved,sold',
        ]);

        $car->update($validated);

        return redirect()->route('manager.cars.index')->with('success', 'Data mobil berhasil diperbarui!');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('manager.cars.index')->with('success', 'Mobil telah dihapus dari showroom.');
    }
}
