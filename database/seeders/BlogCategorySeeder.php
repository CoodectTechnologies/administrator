<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Éxito personal', 'Libros'];
        foreach($categories as $category){
            BlogCategory::create([
                'name' => $category
            ]);
        }
    }
}
