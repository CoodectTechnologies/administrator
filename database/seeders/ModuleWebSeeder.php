<?php

namespace Database\Seeders;

use App\Models\ModuleWeb;
use Illuminate\Database\Seeder;

class ModuleWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleWebs = [
            //Web
            ['name' => 'Inicio'], //Id: 1
            ['name' => 'Nosotros'], //Id: 2
            ['name' => 'Servicios'], //Id: 3
            ['name' => 'Portafolio'], //Id: 4
            ['name' => 'Team'], //Id: 5
            ['name' => 'Blog'], //Id: 6
            ['name' => 'Videos'], //Id: 7
            ['name' => 'Videos'], //Id: 8
            ['name' => 'Contacto'], //Id: 9
            //Ecommerce
            ['name' => 'Ecommerce principal'], //Id: 10
            ['name' => 'Ecommerce secondario'], //Id: 11
        ];
        ModuleWeb::insert($moduleWebs);
    }
}
