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
            ['name' => 'Web - Inicio'],
            ['name' => 'Web - Nosotros'],
            ['name' => 'Web - Servicios'],
            ['name' => 'Web - Portafolio'],
            ['name' => 'Web - Team'],
            ['name' => 'Web - Blog'],
            ['name' => 'Web - Videos'],
            ['name' => 'Web - Galeria'],
            ['name' => 'Web - Contacto'],
            //Ecommerce
            ['name' => 'Ecommerce - Inicio'],
            ['name' => 'Ecommerce - Nosotros'],
            ['name' => 'Ecommerce - Servicios'],
            ['name' => 'Ecommerce - Portafolio'],
            ['name' => 'Ecommerce - Team'],
            ['name' => 'Ecommerce - Blog'],
            ['name' => 'Ecommerce - Videos'],
            ['name' => 'Ecommerce - Galeria'],
            ['name' => 'Ecommerce - Contacto'],
        ];
        ModuleWeb::insert($moduleWebs);
    }
}
