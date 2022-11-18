<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

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
            'Fashion' => [
                'Clothing' => [
                    'Clothing 1',
                    'Clothing 2' => [
                        'clothing 2.2'
                    ]
                ],
                'New arrivals',
                'Best Seller',

                'Trending'
            ],
            'Home and garden',
            'Electronics',
            'forniture',
            'Healthy and beauty',
            'Gift ideas',
            'Toy and games',
            'Cooking',
            'Smarth phones',
            'Cameras and photos',
            'Accesories'
        ];
        foreach($categories as $key => $value){
            if(is_array($value)):
                $this->mapCategory($key, $value);
            else:
                $this->createCategory($value);
            endif;
        }
    }
    private function mapCategory($categoryName, $array, $parentId = null){
        $category = $this->createCategory($categoryName, $parentId);
        foreach($array as $key => $value):
            if(is_array($value)):
                $this->mapCategory($key, $value, $category->id);
            else:
                $this->createCategory($value, $category->id);
            endif;
        endforeach;
    }
    private function createCategory($categoryName, $parentId = null){
        $category = ProductCategory::create([
            'name' => $categoryName,
            'parent_id' => $parentId
        ]);
        Log::alert(print_r(array(
            'name' => $category->name,
            'id' => $category->id,
            'parentId' => $category->parent_id
        ), true));
        return $category;
    }
}
