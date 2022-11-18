<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'product_gender_id' => 1,
                'name' => 'BEYOND LIFT GEL FACIAL TENSOR Y REMODELADOR / 30ML',
                'detail' => 'Piel visiblemente más lisa, contorno redefinido. Evita flacidez, papada y arrugas.',
                'description' => 'Avanzada fórmula reafirmante que ayuda a realzar y dar sostén a la silueta del rostro, dando así a la piel un aspecto juvenil, fuerte y flexible. Su textura a base de silicones que brinda tersura inmediata. Sus ingredientes de un alto contenido de antioxidantes como mora acai (10 veces mas que las uvas) o Ubuntu Marula que ayudan a combatir el envejecimiento prematuro.',
                'quantity' =>  100,
                'price' => 200,
                'price_promotion' => 150,
                'status' => 'Publicado',
                'featured' => true,
            ],
            [
                'product_gender_id' => 1,
                'name' => 'MASCARILLA INTENSIVA PARA EL CABELLO / 200G',
                'detail' => 'Con Algas, Aceite de Argán y Macadamia. Repara tu cabello en tan solo 2 minutos.',
                'description' => 'Tratamiento con ingredientes naturales que se utiliza 1 ó 2 veces por semana para lograr un cabello sano, suave y libre de frizz.',
                'quantity' =>  100,
                'price' => 201,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'OLEO TRATAMIENTO PARA EL CABELLO 3 EN 1',
                'detail' => '3 BENEFICIOS REPARA el cabello dañado PROTEGE  de planchas y secadoras DA BRILLO sin ser graso',
                'description' => 'DESCRIPCIÓN DEL PRODUCTO INGREDIENTES CLAVE 3 ACEITES NATURALES ACEITE DE ARGÁN Regenera, natura, da brillo ACEITE DE MACADAMIA Elimina el «frizz», nature, revitaliza y sella las puntas ACEITE MONIO DE TAHITI Protege y nature al ser rico en aceites esenciales APLICACIÓN Aplique una porción suficiente del oleo que cubra el largo de su cabello, ya sea seco o húmedo concentrándolo en las puntas. Usar antes del peinado o estilizado.',
                'quantity' =>  100,
                'price' => 202,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'BEYOND LIFT GEL FACIAL TENSOR Y REMODELADOR / 30ML',
                'detail' => 'Piel visiblemente más lisa, contorno redefinido. Evita flacidez, papada y arrugas.',
                'description' => 'Avanzada fórmula reafirmante que ayuda a realzar y dar sostén a la silueta del rostro, dando así a la piel un aspecto juvenil, fuerte y flexible. Su textura a base de silicones que brinda tersura inmediata. Sus ingredientes de un alto contenido de antioxidantes como mora acai (10 veces mas que las uvas) o Ubuntu Marula que ayudan a combatir el envejecimiento prematuro.',
                'quantity' =>  100,
                'price' => 200,
                'price_promotion' => 150,
                'status' => 'Publicado',
                'featured' => true,
            ],
            [
                'product_gender_id' => 1,
                'name' => 'MASCARILLA INTENSIVA PARA EL CABELLO / 200G',
                'detail' => 'Con Algas, Aceite de Argán y Macadamia. Repara tu cabello en tan solo 2 minutos.',
                'description' => 'Tratamiento con ingredientes naturales que se utiliza 1 ó 2 veces por semana para lograr un cabello sano, suave y libre de frizz.',
                'quantity' =>  100,
                'price' => 201,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'OLEO TRATAMIENTO PARA EL CABELLO 3 EN 1',
                'detail' => '3 BENEFICIOS REPARA el cabello dañado PROTEGE  de planchas y secadoras DA BRILLO sin ser graso',
                'description' => 'DESCRIPCIÓN DEL PRODUCTO INGREDIENTES CLAVE 3 ACEITES NATURALES ACEITE DE ARGÁN Regenera, natura, da brillo ACEITE DE MACADAMIA Elimina el «frizz», nature, revitaliza y sella las puntas ACEITE MONIO DE TAHITI Protege y nature al ser rico en aceites esenciales APLICACIÓN Aplique una porción suficiente del oleo que cubra el largo de su cabello, ya sea seco o húmedo concentrándolo en las puntas. Usar antes del peinado o estilizado.',
                'quantity' =>  100,
                'price' => 202,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'BEYOND LIFT GEL FACIAL TENSOR Y REMODELADOR / 30ML',
                'detail' => 'Piel visiblemente más lisa, contorno redefinido. Evita flacidez, papada y arrugas.',
                'description' => 'Avanzada fórmula reafirmante que ayuda a realzar y dar sostén a la silueta del rostro, dando así a la piel un aspecto juvenil, fuerte y flexible. Su textura a base de silicones que brinda tersura inmediata. Sus ingredientes de un alto contenido de antioxidantes como mora acai (10 veces mas que las uvas) o Ubuntu Marula que ayudan a combatir el envejecimiento prematuro.',
                'quantity' =>  100,
                'price' => 200,
                'price_promotion' => 150,
                'status' => 'Publicado',
                'featured' => true,
            ],
            [
                'product_gender_id' => 1,
                'name' => 'MASCARILLA INTENSIVA PARA EL CABELLO / 200G',
                'detail' => 'Con Algas, Aceite de Argán y Macadamia. Repara tu cabello en tan solo 2 minutos.',
                'description' => 'Tratamiento con ingredientes naturales que se utiliza 1 ó 2 veces por semana para lograr un cabello sano, suave y libre de frizz.',
                'quantity' =>  100,
                'price' => 201,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'OLEO TRATAMIENTO PARA EL CABELLO 3 EN 1',
                'detail' => '3 BENEFICIOS REPARA el cabello dañado PROTEGE  de planchas y secadoras DA BRILLO sin ser graso',
                'description' => 'DESCRIPCIÓN DEL PRODUCTO INGREDIENTES CLAVE 3 ACEITES NATURALES ACEITE DE ARGÁN Regenera, natura, da brillo ACEITE DE MACADAMIA Elimina el «frizz», nature, revitaliza y sella las puntas ACEITE MONIO DE TAHITI Protege y nature al ser rico en aceites esenciales APLICACIÓN Aplique una porción suficiente del oleo que cubra el largo de su cabello, ya sea seco o húmedo concentrándolo en las puntas. Usar antes del peinado o estilizado.',
                'quantity' =>  100,
                'price' => 202,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'BEYOND LIFT GEL FACIAL TENSOR Y REMODELADOR / 30ML',
                'detail' => 'Piel visiblemente más lisa, contorno redefinido. Evita flacidez, papada y arrugas.',
                'description' => 'Avanzada fórmula reafirmante que ayuda a realzar y dar sostén a la silueta del rostro, dando así a la piel un aspecto juvenil, fuerte y flexible. Su textura a base de silicones que brinda tersura inmediata. Sus ingredientes de un alto contenido de antioxidantes como mora acai (10 veces mas que las uvas) o Ubuntu Marula que ayudan a combatir el envejecimiento prematuro.',
                'quantity' =>  100,
                'price' => 200,
                'price_promotion' => 150,
                'status' => 'Publicado',
                'featured' => true,
            ],
            [
                'product_gender_id' => 1,
                'name' => 'MASCARILLA INTENSIVA PARA EL CABELLO / 200G',
                'detail' => 'Con Algas, Aceite de Argán y Macadamia. Repara tu cabello en tan solo 2 minutos.',
                'description' => 'Tratamiento con ingredientes naturales que se utiliza 1 ó 2 veces por semana para lograr un cabello sano, suave y libre de frizz.',
                'quantity' =>  100,
                'price' => 201,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'OLEO TRATAMIENTO PARA EL CABELLO 3 EN 1',
                'detail' => '3 BENEFICIOS REPARA el cabello dañado PROTEGE  de planchas y secadoras DA BRILLO sin ser graso',
                'description' => 'DESCRIPCIÓN DEL PRODUCTO INGREDIENTES CLAVE 3 ACEITES NATURALES ACEITE DE ARGÁN Regenera, natura, da brillo ACEITE DE MACADAMIA Elimina el «frizz», nature, revitaliza y sella las puntas ACEITE MONIO DE TAHITI Protege y nature al ser rico en aceites esenciales APLICACIÓN Aplique una porción suficiente del oleo que cubra el largo de su cabello, ya sea seco o húmedo concentrándolo en las puntas. Usar antes del peinado o estilizado.',
                'quantity' =>  100,
                'price' => 202,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'BEYOND LIFT GEL FACIAL TENSOR Y REMODELADOR / 30ML',
                'detail' => 'Piel visiblemente más lisa, contorno redefinido. Evita flacidez, papada y arrugas.',
                'description' => 'Avanzada fórmula reafirmante que ayuda a realzar y dar sostén a la silueta del rostro, dando así a la piel un aspecto juvenil, fuerte y flexible. Su textura a base de silicones que brinda tersura inmediata. Sus ingredientes de un alto contenido de antioxidantes como mora acai (10 veces mas que las uvas) o Ubuntu Marula que ayudan a combatir el envejecimiento prematuro.',
                'quantity' =>  100,
                'price' => 200,
                'price_promotion' => 150,
                'status' => 'Publicado',
                'featured' => true,
            ],
            [
                'product_gender_id' => 1,
                'name' => 'MASCARILLA INTENSIVA PARA EL CABELLO / 200G',
                'detail' => 'Con Algas, Aceite de Argán y Macadamia. Repara tu cabello en tan solo 2 minutos.',
                'description' => 'Tratamiento con ingredientes naturales que se utiliza 1 ó 2 veces por semana para lograr un cabello sano, suave y libre de frizz.',
                'quantity' =>  100,
                'price' => 201,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'OLEO TRATAMIENTO PARA EL CABELLO 3 EN 1',
                'detail' => '3 BENEFICIOS REPARA el cabello dañado PROTEGE  de planchas y secadoras DA BRILLO sin ser graso',
                'description' => 'DESCRIPCIÓN DEL PRODUCTO INGREDIENTES CLAVE 3 ACEITES NATURALES ACEITE DE ARGÁN Regenera, natura, da brillo ACEITE DE MACADAMIA Elimina el «frizz», nature, revitaliza y sella las puntas ACEITE MONIO DE TAHITI Protege y nature al ser rico en aceites esenciales APLICACIÓN Aplique una porción suficiente del oleo que cubra el largo de su cabello, ya sea seco o húmedo concentrándolo en las puntas. Usar antes del peinado o estilizado.',
                'quantity' =>  100,
                'price' => 202,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'BEYOND LIFT GEL FACIAL TENSOR Y REMODELADOR / 30ML',
                'detail' => 'Piel visiblemente más lisa, contorno redefinido. Evita flacidez, papada y arrugas.',
                'description' => 'Avanzada fórmula reafirmante que ayuda a realzar y dar sostén a la silueta del rostro, dando así a la piel un aspecto juvenil, fuerte y flexible. Su textura a base de silicones que brinda tersura inmediata. Sus ingredientes de un alto contenido de antioxidantes como mora acai (10 veces mas que las uvas) o Ubuntu Marula que ayudan a combatir el envejecimiento prematuro.',
                'quantity' =>  100,
                'price' => 200,
                'price_promotion' => 150,
                'status' => 'Publicado',
                'featured' => true,
            ],
            [
                'product_gender_id' => 1,
                'name' => 'MASCARILLA INTENSIVA PARA EL CABELLO / 200G',
                'detail' => 'Con Algas, Aceite de Argán y Macadamia. Repara tu cabello en tan solo 2 minutos.',
                'description' => 'Tratamiento con ingredientes naturales que se utiliza 1 ó 2 veces por semana para lograr un cabello sano, suave y libre de frizz.',
                'quantity' =>  100,
                'price' => 201,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'OLEO TRATAMIENTO PARA EL CABELLO 3 EN 1',
                'detail' => '3 BENEFICIOS REPARA el cabello dañado PROTEGE  de planchas y secadoras DA BRILLO sin ser graso',
                'description' => 'DESCRIPCIÓN DEL PRODUCTO INGREDIENTES CLAVE 3 ACEITES NATURALES ACEITE DE ARGÁN Regenera, natura, da brillo ACEITE DE MACADAMIA Elimina el «frizz», nature, revitaliza y sella las puntas ACEITE MONIO DE TAHITI Protege y nature al ser rico en aceites esenciales APLICACIÓN Aplique una porción suficiente del oleo que cubra el largo de su cabello, ya sea seco o húmedo concentrándolo en las puntas. Usar antes del peinado o estilizado.',
                'quantity' =>  100,
                'price' => 202,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'BEYOND LIFT GEL FACIAL TENSOR Y REMODELADOR / 30ML',
                'detail' => 'Piel visiblemente más lisa, contorno redefinido. Evita flacidez, papada y arrugas.',
                'description' => 'Avanzada fórmula reafirmante que ayuda a realzar y dar sostén a la silueta del rostro, dando así a la piel un aspecto juvenil, fuerte y flexible. Su textura a base de silicones que brinda tersura inmediata. Sus ingredientes de un alto contenido de antioxidantes como mora acai (10 veces mas que las uvas) o Ubuntu Marula que ayudan a combatir el envejecimiento prematuro.',
                'quantity' =>  100,
                'price' => 200,
                'price_promotion' => 150,
                'status' => 'Publicado',
                'featured' => true,
            ],
            [
                'product_gender_id' => 1,
                'name' => 'MASCARILLA INTENSIVA PARA EL CABELLO / 200G',
                'detail' => 'Con Algas, Aceite de Argán y Macadamia. Repara tu cabello en tan solo 2 minutos.',
                'description' => 'Tratamiento con ingredientes naturales que se utiliza 1 ó 2 veces por semana para lograr un cabello sano, suave y libre de frizz.',
                'quantity' =>  100,
                'price' => 201,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'OLEO TRATAMIENTO PARA EL CABELLO 3 EN 1',
                'detail' => '3 BENEFICIOS REPARA el cabello dañado PROTEGE  de planchas y secadoras DA BRILLO sin ser graso',
                'description' => 'DESCRIPCIÓN DEL PRODUCTO INGREDIENTES CLAVE 3 ACEITES NATURALES ACEITE DE ARGÁN Regenera, natura, da brillo ACEITE DE MACADAMIA Elimina el «frizz», nature, revitaliza y sella las puntas ACEITE MONIO DE TAHITI Protege y nature al ser rico en aceites esenciales APLICACIÓN Aplique una porción suficiente del oleo que cubra el largo de su cabello, ya sea seco o húmedo concentrándolo en las puntas. Usar antes del peinado o estilizado.',
                'quantity' =>  100,
                'price' => 202,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'BEYOND LIFT GEL FACIAL TENSOR Y REMODELADOR / 30ML',
                'detail' => 'Piel visiblemente más lisa, contorno redefinido. Evita flacidez, papada y arrugas.',
                'description' => 'Avanzada fórmula reafirmante que ayuda a realzar y dar sostén a la silueta del rostro, dando así a la piel un aspecto juvenil, fuerte y flexible. Su textura a base de silicones que brinda tersura inmediata. Sus ingredientes de un alto contenido de antioxidantes como mora acai (10 veces mas que las uvas) o Ubuntu Marula que ayudan a combatir el envejecimiento prematuro.',
                'quantity' =>  100,
                'price' => 200,
                'price_promotion' => 150,
                'status' => 'Publicado',
                'featured' => true,
            ],
            [
                'product_gender_id' => 1,
                'name' => 'MASCARILLA INTENSIVA PARA EL CABELLO / 200G',
                'detail' => 'Con Algas, Aceite de Argán y Macadamia. Repara tu cabello en tan solo 2 minutos.',
                'description' => 'Tratamiento con ingredientes naturales que se utiliza 1 ó 2 veces por semana para lograr un cabello sano, suave y libre de frizz.',
                'quantity' =>  100,
                'price' => 201,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'OLEO TRATAMIENTO PARA EL CABELLO 3 EN 1',
                'detail' => '3 BENEFICIOS REPARA el cabello dañado PROTEGE  de planchas y secadoras DA BRILLO sin ser graso',
                'description' => 'DESCRIPCIÓN DEL PRODUCTO INGREDIENTES CLAVE 3 ACEITES NATURALES ACEITE DE ARGÁN Regenera, natura, da brillo ACEITE DE MACADAMIA Elimina el «frizz», nature, revitaliza y sella las puntas ACEITE MONIO DE TAHITI Protege y nature al ser rico en aceites esenciales APLICACIÓN Aplique una porción suficiente del oleo que cubra el largo de su cabello, ya sea seco o húmedo concentrándolo en las puntas. Usar antes del peinado o estilizado.',
                'quantity' =>  100,
                'price' => 202,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'BEYOND LIFT GEL FACIAL TENSOR Y REMODELADOR / 30ML',
                'detail' => 'Piel visiblemente más lisa, contorno redefinido. Evita flacidez, papada y arrugas.',
                'description' => 'Avanzada fórmula reafirmante que ayuda a realzar y dar sostén a la silueta del rostro, dando así a la piel un aspecto juvenil, fuerte y flexible. Su textura a base de silicones que brinda tersura inmediata. Sus ingredientes de un alto contenido de antioxidantes como mora acai (10 veces mas que las uvas) o Ubuntu Marula que ayudan a combatir el envejecimiento prematuro.',
                'quantity' =>  100,
                'price' => 200,
                'price_promotion' => 150,
                'status' => 'Publicado',
                'featured' => true,
            ],
            [
                'product_gender_id' => 1,
                'name' => 'MASCARILLA INTENSIVA PARA EL CABELLO / 200G',
                'detail' => 'Con Algas, Aceite de Argán y Macadamia. Repara tu cabello en tan solo 2 minutos.',
                'description' => 'Tratamiento con ingredientes naturales que se utiliza 1 ó 2 veces por semana para lograr un cabello sano, suave y libre de frizz.',
                'quantity' =>  100,
                'price' => 201,
                'status' => 'Publicado'
            ],
            [
                'product_gender_id' => 1,
                'name' => 'OLEO TRATAMIENTO PARA EL CABELLO 3 EN 1',
                'detail' => '3 BENEFICIOS REPARA el cabello dañado PROTEGE  de planchas y secadoras DA BRILLO sin ser graso',
                'description' => 'DESCRIPCIÓN DEL PRODUCTO INGREDIENTES CLAVE 3 ACEITES NATURALES ACEITE DE ARGÁN Regenera, natura, da brillo ACEITE DE MACADAMIA Elimina el «frizz», nature, revitaliza y sella las puntas ACEITE MONIO DE TAHITI Protege y nature al ser rico en aceites esenciales APLICACIÓN Aplique una porción suficiente del oleo que cubra el largo de su cabello, ya sea seco o húmedo concentrándolo en las puntas. Usar antes del peinado o estilizado.',
                'quantity' =>  100,
                'price' => 202,
                'status' => 'Publicado'
            ],
        ];
        $categoriesCount = ProductCategory::count();
        foreach($products as $product):
            //PRODUCT
            $product = Product::create($product);
            //IMAGEN
            $product->image()->create([
                'url' => 'https://source.unsplash.com/random',
                'main' =>true,
            ]);
            //CATEGORIES
            if($categoriesCount):
                $categoriesMerge = array_unique([rand(1, $categoriesCount), rand(1, $categoriesCount), rand(1, $categoriesCount)]);
                $product->productCategories()->sync($categoriesMerge);
            endif;
            //COLORES
            $color1 = $product->productColors()->create([
                'name' => 'Rojo',
            ]);
            $color2 = $product->productColors()->create([
                'name' => 'Azul',
            ]);
            //MEDIDAS
            $size1 = $product->productSizes()->create([
                'name' => 'Chico',
                'price' => 250,
            ]);
            $size2 = $product->productSizes()->create([
                'name' => 'Grande',
                'price' => 251,
            ]);
            //COLOR MEDIDAS
            $size1->productColors()->sync([$color1->id, $color2->id]); //Rojo, Azul
            $size2->productColors()->sync([$color2->id]); //Azul
            //COMENTARIOS
            $product->comments()->create([
                'user_id' => 1,
                'name' => 'Rigoberto',
                'body' => 'Esta perron el producto'
            ]);
            $product->comments()->create([
                'user_id' => 1,
                'name' => 'Rigoberto2',
                'body' => 'Esta perron el producto2'
            ]);
        endforeach;
    }
}
