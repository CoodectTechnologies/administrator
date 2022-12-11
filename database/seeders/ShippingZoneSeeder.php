<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingZone;
use App\Models\State;
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
        $country = Country::where('name', 'México')->first();
        if($country):
            $shippingZones = [
                [
                    'country_id' => $country->id,
                    'name' => 'ZMG - Zapopan.',
                    'zip_codes' => '45010...45245',
                    'price' => 90,
                ],
                [
                    'country_id' => $country->id,
                    'name' => 'ZMG - Guadalajara.',
                    'zip_codes' => '44100...44987',
                    'price' => 95,
                ]
            ];
            foreach($shippingZones as $shippingZone):
                $state = State::where('name', 'Jalisco')->whereRelation('country', 'id', $country->id)->first();
                if($state):
                    $zone = ShippingZone::create($shippingZone);
                    $zone->states()->attach([
                        'state_id' => $state->id
                    ]);
                endif;
            endforeach;
        endif;
    }
}
