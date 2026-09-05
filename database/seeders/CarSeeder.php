<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'name' => 'M4 Competition Coupé',
                'brand' => 'BMW',
                'category' => 'Supercar',
                'price' => 2500000000,
                'year' => 2024,
                'transmission' => '8-Speed M Steptronic',
                'fuel_type' => '3.0L TwinPower Turbo I6',
                'image_url' => asset('images/brand/bmwm4competition_sao_paulo_yellow.png'),
                'description' => 'BMW M4 Competition Coupé dengan warna ikonik Sao Paulo Yellow.',
                'status' => 'available',
            ],
            [
                'name' => 'Revuelto Arancio Apodis',
                'brand' => 'Lamborghini',
                'category' => 'Hypercar',
                'price' => 18900000000,
                'year' => 2024,
                'transmission' => '8-Speed Dual-Clutch',
                'fuel_type' => '6.5L V12 Hybrid PHEV',
                'image_url' => asset('images/brand/lamborghini_revuelto_arancio_apodis.png'),
                'description' => 'Lamborghini Revuelto V12 High Performance Electrified Vehicle.',
                'status' => 'available',
            ],
            [
                'name' => 'Senna GTR Volcano',
                'brand' => 'McLaren',
                'category' => 'Hypercar',
                'price' => 28500000000,
                'year' => 2023,
                'transmission' => '7-Speed Seamless Shift',
                'fuel_type' => '4.0L Twin-Turbo V8',
                'image_url' => asset('images/brand/mclaren_senna_gtr_volcano_yellow.png'),
                'description' => 'McLaren Senna GTR edisi terbatas Volcano Yellow.',
                'status' => 'available',
            ],
            [
                'name' => '911 GT3 RS Ruby',
                'brand' => 'Porsche',
                'category' => 'Supercar',
                'price' => 11200000000,
                'year' => 2024,
                'transmission' => '7-Speed PDK',
                'fuel_type' => '4.0L Naturally Aspirated Boxer-6',
                'image_url' => asset('images/brand/porsche_rubystone_red.png'),
                'description' => 'Porsche 911 GT3 RS dengan balutan warna Rubystone Red.',
                'status' => 'available',
            ],
            [
                'name' => 'R8 V10 Performance',
                'brand' => 'Audi',
                'category' => 'Supercar',
                'price' => 7500000000,
                'year' => 2023,
                'transmission' => '7-Speed S Tronic',
                'fuel_type' => '5.2L FSI V10',
                'image_url' => asset('images/brand/audi_r8_tango_red_metallic.png'),
                'description' => 'Audi R8 V10 Performance Tango Red Metallic.',
                'status' => 'available',
            ],
            [
                'name' => 'Jesko Absolut',
                'brand' => 'Koenigsegg',
                'category' => 'Hypercar',
                'price' => 45000000000,
                'year' => 2024,
                'transmission' => '9-Speed LST',
                'fuel_type' => '5.0L Twin-Turbo V8',
                'image_url' => asset('images/brand/koeningseg_jesko_absolut_crystal_white.png'),
                'description' => 'Koenigsegg Jesko Absolut Crystal White.',
                'status' => 'available',
            ],
            [
                'name' => 'Chiron Pur Sport',
                'brand' => 'Bugatti',
                'category' => 'Hypercar',
                'price' => 65000000000,
                'year' => 2024,
                'transmission' => '7-Speed DSG',
                'fuel_type' => '8.0L Quad-Turbo W16',
                'image_url' => asset('images/brand/buggati_chiron_le_mans_blue.png'),
                'description' => 'Bugatti Chiron Pur Sport Le Mans Blue.',
                'status' => 'available',
            ],
            [
                'name' => 'Corvette Z06 C8.R',
                'brand' => 'Chevrolet',
                'category' => 'Supercar',
                'price' => 4800000000,
                'year' => 2023,
                'transmission' => '8-Speed Dual-Clutch',
                'fuel_type' => '5.5L LT6 Flat-Plane V8',
                'image_url' => asset('images/brand/chevrolet_corvette_c8_torch_red.png'),
                'description' => 'Chevrolet Corvette Z06 C8 Torch Red.',
                'status' => 'available',
            ],
            [
                'name' => 'Huayra BC Tempest',
                'brand' => 'Pagani',
                'category' => 'Hypercar',
                'price' => 42000000000,
                'year' => 2023,
                'transmission' => '7-Speed Xtrac Sequential',
                'fuel_type' => '6.0L Twin-Turbo V12 AMG',
                'image_url' => asset('images/brand/pagani_huayra_bc.png'),
                'description' => 'Pagani Huayra BC Carbon Edition.',
                'status' => 'available',
            ],
            [
                'name' => 'TSR-S Viola Parsifae',
                'brand' => 'Zenvo',
                'category' => 'Hypercar',
                'price' => 29000000000,
                'year' => 2024,
                'transmission' => '7-Speed Sequential Centripetal',
                'fuel_type' => '5.8L Twin-Centrifugal Supercharged V8',
                'image_url' => asset('images/brand/zenvo_tsr_s_viola_parsifae.png'),
                'description' => 'Zenvo TSR-S dengan active centripetal wing.',
                'status' => 'available',
            ],
        ];

        foreach ($cars as $car) {
            \App\Models\Car::updateOrCreate(['name' => $car['name']], $car);
        }
    }
}
