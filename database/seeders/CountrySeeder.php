<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'id' => '1', 
                'name' => 'México'                
            ],
            [
                'id' => '2', 
                'name' => 'United States',
                'status' => false,
            ]            
        ];
        foreach($countries as $country):
            Country::create($country);
        endforeach;
    }
}
