<?php

namespace Database\Seeders;

use App\Models\ShippingZone;
use Illuminate\Database\Seeder;

class ShippingZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shippingZones = [
            [
                'name' => 'ZMG - Zapopan.',
                'zip_codes' => '45010...45245',
                'price' => 90,
            ],
            [
                'name' => 'ZMG - Guadalajara.',
                'zip_codes' => '44100...44987',
                'price' => 95,
            ]
        ];

        foreach($shippingZones as $shippingZone){
            $zone = ShippingZone::create($shippingZone);
            $zone->states()->attach([
                'state_id' => 15 //Jalisco
            ]);
        }
    }
}
