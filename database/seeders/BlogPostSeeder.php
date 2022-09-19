<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = [
            'name' => 'Titulo de prueba',
            'fragment' => 'lorem',
            'body' => 'lorem',
            'status' => true
        ];
        $post = BlogPost::create($post);
        $post->image()->create([
            'url' => 'https://brandbean.mx/storage/blogs/OiZDqcqhdWzQ35Q1nJvpow9ZIWsR4pQlbC6tHY42.jpg'
        ]);
        $post->comments()->create([
            'name' => 'Rigoberto',
            'body' => 'OLLAA',
        ]);
        $post->comments()->create([
            'name' => 'Rigoberto2',
            'body' => 'ola soy el comentario más',
        ]);
    }
}
