<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->paginate(10);

        return view('manager.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('manager.cars.form', ['car' => new Car]);
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
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'description' => 'nullable|string',
            'status' => 'required|in:available,reserved,sold',
            'color_names' => 'nullable|array',
            'color_names.*' => 'nullable|string|max:100',
            'color_hexes' => 'nullable|array',
            'color_hexes.*' => 'nullable|string|max:30',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $uploadDir = public_path('uploads/cars');
            if (! file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $validated['image_url'] = asset('uploads/cars/'.$filename);
        }

        // Process Color Palette Variants
        $colors = [];
        if (! empty($request->color_names) && ! empty($request->color_hexes)) {
            foreach ($request->color_names as $index => $name) {
                $hex = $request->color_hexes[$index] ?? '#111827';
                if (! empty(trim($name))) {
                    $colors[] = [
                        'name' => trim($name),
                        'hex' => trim($hex),
                    ];
                }
            }
        }

        $specs = [
            'colors' => $colors,
            'Warna' => ! empty($colors) ? implode(', ', array_column($colors, 'name')) : 'Standard Color',
        ];
        $validated['specs'] = $specs;

        unset($validated['image_file'], $validated['color_names'], $validated['color_hexes']);

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
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'description' => 'nullable|string',
            'status' => 'required|in:available,reserved,sold',
            'color_names' => 'nullable|array',
            'color_names.*' => 'nullable|string|max:100',
            'color_hexes' => 'nullable|array',
            'color_hexes.*' => 'nullable|string|max:30',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $uploadDir = public_path('uploads/cars');
            if (! file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $validated['image_url'] = asset('uploads/cars/'.$filename);
        }

        // Process Color Palette Variants
        $colors = [];
        if (! empty($request->color_names) && ! empty($request->color_hexes)) {
            foreach ($request->color_names as $index => $name) {
                $hex = $request->color_hexes[$index] ?? '#111827';
                if (! empty(trim($name))) {
                    $colors[] = [
                        'name' => trim($name),
                        'hex' => trim($hex),
                    ];
                }
            }
        }

        $specs = $car->specs ?? [];
        if (! is_array($specs)) {
            $specs = [];
        }
        $specs['colors'] = $colors;
        $specs['Warna'] = ! empty($colors) ? implode(', ', array_column($colors, 'name')) : 'Standard Color';
        $validated['specs'] = $specs;

        unset($validated['image_file'], $validated['color_names'], $validated['color_hexes']);

        $car->update($validated);

        return redirect()->route('manager.cars.index')->with('success', 'Data mobil berhasil diperbarui!');
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('manager.cars.index')->with('success', 'Mobil telah dihapus dari showroom.');
    }

    public function toggleStatus(Request $request, Car $car)
    {
        $request->validate([
            'status' => 'required|in:available,reserved,sold',
        ]);

        $car->update(['status' => $request->status]);

        $statusLabel = strtoupper($request->status);

        return redirect()->route('manager.cars.index')->with('success', "Status mobil {$car->name} diubah menjadi {$statusLabel}.");
    }
}
