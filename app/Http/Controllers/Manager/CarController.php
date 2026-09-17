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
        $brandImages = array_map('basename', glob(public_path('images/brand/*.*')));

        return view('manager.cars.form', ['car' => new Car, 'brandImages' => $brandImages]);
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
            'variant_types' => 'nullable|array',
            'variant_types.*' => 'nullable|string|in:color,bodykit,primer',
            'variant_names' => 'nullable|array',
            'variant_names.*' => 'nullable|string|max:100',
            'variant_hexes' => 'nullable|array',
            'variant_hexes.*' => 'nullable|string|max:30',
            'variant_stocks' => 'nullable|array',
            'variant_stocks.*' => 'nullable|integer|min:0',
            'variant_images_upload' => 'nullable|array',
            'variant_images_upload.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'variant_images_existing' => 'nullable|array',
            'variant_images_existing.*' => 'nullable|string|max:1000',
            'primary_color_name' => 'nullable|string|max:100',
            'primary_color_hex' => 'nullable|string|max:30',
            'primary_stock' => 'nullable|integer|min:0',
            'desc_title' => 'nullable|string|max:255',
            'desc_subtitle' => 'nullable|string|max:255',
            'desc_intro' => 'nullable|string',
            'desc_history' => 'nullable|string',
            'spec_keys' => 'nullable|array',
            'spec_vals' => 'nullable|array',
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

        if ($request->has('specs_json') && !empty($request->specs_json)) {
            $specsData = json_decode($request->specs_json, true);
            if (is_array($specsData)) {
                $request->merge([
                    'spec_keys' => array_column($specsData, 'key'),
                    'spec_vals' => array_column($specsData, 'val'),
                    'spec_icons' => array_column($specsData, 'icon'),
                ]);
            }
        }

        $specs = [];
        if ($request->has('spec_keys') && $request->has('spec_vals')) {
            foreach ($request->spec_keys as $idx => $key) {
                if (! empty(trim($key))) {
                    $k = trim($key);
                    while (array_key_exists($k, $specs)) {
                        $k .= ' '; // Append space to make key unique
                    }
                    $specs[$k] = [
                        'val' => trim($request->spec_vals[$idx] ?? ''),
                        'icon' => trim($request->spec_icons[$idx] ?? 'fa-circle-info')
                    ];
                }
            }
        }
        $validated['specs'] = $specs;

        $descData = [
            'title' => $request->desc_title ?? '',
            'subtitle' => $request->desc_subtitle ?? '',
            'intro' => $request->desc_intro ?? '',
            'history' => $request->desc_history ?? '',
        ];
        $validated['description'] = json_encode($descData);

        unset(
            $validated['image_file'],
            $validated['variant_types'],
            $validated['variant_names'],
            $validated['variant_hexes'],
            $validated['variant_stocks'],
            $validated['variant_images_upload'],
            $validated['variant_images_existing'],
            $validated['primary_color_name'],
            $validated['primary_color_hex'],
            $validated['primary_stock'],
            $validated['desc_title'],
            $validated['desc_subtitle'],
            $validated['desc_intro'],
            $validated['desc_history'],
            $validated['spec_keys'],
            $validated['spec_vals']
        );

        $car = Car::create($validated);

        if (! empty($request->primary_color_name)) {
            $car->variants()->create([
                'type' => 'primer',
                'name' => trim($request->primary_color_name),
                'hex' => trim($request->primary_color_hex ?? '#dc2626'),
                'stock' => (int) ($request->primary_stock ?? 0),
                'image_url' => $car->image_url,
            ]);
        }

        if (! empty($request->variant_names)) {
            foreach ($request->variant_names as $index => $name) {
                if (empty(trim($name))) {
                    continue;
                }

                $type = $request->variant_types[$index] ?? 'color';
                $hex = $request->variant_hexes[$index] ?? '#111827';
                $stock = $request->variant_stocks[$index] ?? 0;
                $imageUrl = $request->variant_images_existing[$index] ?? null;

                if ($request->hasFile("variant_images_upload.$index")) {
                    $file = $request->file("variant_images_upload.$index");
                    $uploadDir = public_path('uploads/variants');
                    if (! file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                    $file->move($uploadDir, $filename);
                    $imageUrl = asset('uploads/variants/'.$filename);
                }

                $car->variants()->create([
                    'type' => $type,
                    'name' => trim($name),
                    'hex' => trim($hex),
                    'stock' => (int) $stock,
                    'image_url' => $imageUrl,
                ]);
            }
        }

        $car->update(['specs' => $specs]);

        return redirect()->route('manager.cars.index')->with('success', 'Mobil berhasil ditambahkan ke showroom!');
    }

    public function edit(Car $car)
    {
        $brandImages = array_map('basename', glob(public_path('images/brand/*.*')));

        return view('manager.cars.form', compact('car', 'brandImages'));
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
            'variant_types' => 'nullable|array',
            'variant_types.*' => 'nullable|string|in:color,bodykit,primer',
            'variant_names' => 'nullable|array',
            'variant_names.*' => 'nullable|string|max:100',
            'variant_hexes' => 'nullable|array',
            'variant_hexes.*' => 'nullable|string|max:30',
            'variant_stocks' => 'nullable|array',
            'variant_stocks.*' => 'nullable|integer|min:0',
            'variant_images_upload' => 'nullable|array',
            'variant_images_upload.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
            'variant_images_existing' => 'nullable|array',
            'variant_images_existing.*' => 'nullable|string|max:1000',
            'primary_color_name' => 'nullable|string|max:100',
            'primary_color_hex' => 'nullable|string|max:30',
            'primary_stock' => 'nullable|integer|min:0',
            'desc_title' => 'nullable|string|max:255',
            'desc_subtitle' => 'nullable|string|max:255',
            'desc_intro' => 'nullable|string',
            'desc_history' => 'nullable|string',
            'spec_keys' => 'nullable|array',
            'spec_vals' => 'nullable|array',
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

        $specs = [];
        \Log::info('--- UPDATE REQUEST PAYLOAD ---');
        \Log::info('spec_keys:', $request->spec_keys ?? ['MISSING']);
        \Log::info('spec_vals:', $request->spec_vals ?? ['MISSING']);
        
        if ($request->has('specs_json') && !empty($request->specs_json)) {
            $specsData = json_decode($request->specs_json, true);
            if (is_array($specsData)) {
                $request->merge([
                    'spec_keys' => array_column($specsData, 'key'),
                    'spec_vals' => array_column($specsData, 'val'),
                    'spec_icons' => array_column($specsData, 'icon'),
                ]);
            }
        }

        if ($request->has('spec_keys') && $request->has('spec_vals')) {
            foreach ($request->spec_keys as $idx => $key) {
                if (! empty(trim($key))) {
                    $k = trim($key);
                    while (array_key_exists($k, $specs)) {
                        $k .= ' '; // Append space to make key unique
                    }
                    $specs[$k] = [
                        'val' => trim($request->spec_vals[$idx] ?? ''),
                        'icon' => trim($request->spec_icons[$idx] ?? 'fa-circle-info')
                    ];
                }
            }
        }
        $validated['specs'] = $specs;

        $descData = [
            'title' => $request->desc_title ?? '',
            'subtitle' => $request->desc_subtitle ?? '',
            'intro' => $request->desc_intro ?? '',
            'history' => $request->desc_history ?? '',
        ];
        $validated['description'] = json_encode($descData);

        // Delete old variants
        $car->variants()->delete();

        if (! empty($request->primary_color_name)) {
            $car->variants()->create([
                'type' => 'primer',
                'name' => trim($request->primary_color_name),
                'hex' => trim($request->primary_color_hex ?? '#dc2626'),
                'stock' => (int) ($request->primary_stock ?? 0),
                'image_url' => $validated['image_url'] ?? $car->image_url,
            ]);
        }

        if (! empty($request->variant_names)) {
            foreach ($request->variant_names as $index => $name) {
                if (empty(trim($name))) {
                    continue;
                }

                $type = $request->variant_types[$index] ?? 'color';
                $hex = $request->variant_hexes[$index] ?? '#111827';
                $stock = $request->variant_stocks[$index] ?? 0;
                $imageUrl = $request->variant_images_existing[$index] ?? null;

                if ($request->hasFile("variant_images_upload.$index")) {
                    $file = $request->file("variant_images_upload.$index");
                    $uploadDir = public_path('uploads/variants');
                    if (! file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }
                    $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                    $file->move($uploadDir, $filename);
                    $imageUrl = asset('uploads/variants/'.$filename);
                }

                $car->variants()->create([
                    'type' => $type,
                    'name' => trim($name),
                    'hex' => trim($hex),
                    'stock' => (int) $stock,
                    'image_url' => $imageUrl,
                ]);
            }
        }

        unset(
            $validated['image_file'],
            $validated['variant_types'],
            $validated['variant_names'],
            $validated['variant_hexes'],
            $validated['variant_stocks'],
            $validated['variant_images_upload'],
            $validated['variant_images_existing'],
            $validated['primary_color_name'],
            $validated['primary_color_hex'],
            $validated['primary_stock'],
            $validated['desc_title'],
            $validated['desc_subtitle'],
            $validated['desc_intro'],
            $validated['desc_history'],
            $validated['spec_keys'],
            $validated['spec_vals']
        );

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
