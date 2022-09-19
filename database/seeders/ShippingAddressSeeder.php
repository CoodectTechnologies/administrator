<?php

namespace Database\Seeders;

use App\Models\ShippingAddress;
use Illuminate\Database\Seeder;

class ShippingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shippingAddress = [
            'user_id' => 1,
            'state_id' => '15',
            'municipality' => 'Zapopan',
            'colony' => 'Jardines del valle',
            'zip_code' => '45120',
            'street' => 'Calzada federalistas',
            'street_number_int' => '1721',
            'street_number_ext' => '320',
            'name' => 'Rigoberto Villa',
            'phone' => '3231153678',
            'email' => 'coodect.manager@gmail.com',
            'default' => true
        ];
        ShippingAddress::create($shippingAddress);
    }
}
