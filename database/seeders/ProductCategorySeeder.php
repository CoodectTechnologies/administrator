<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Maquillajes',
            'Fragancias',
            'Cuidado de la piel',
            'Antitraspirantes',
            'Higiene intima',
        ];
        foreach($categories as $category){
            ProductCategory::create([
                'name' => $category
            ]);
        }        
    }
}
