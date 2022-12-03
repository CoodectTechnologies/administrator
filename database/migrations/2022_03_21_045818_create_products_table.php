<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //Foreign
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('product_gender_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('product_brand_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->foreignId('shipping_class_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');

            //General
            $table->string('name');
            $table->string('slug');
            $table->longText('detail');
            $table->longText('description')->nullable();
            $table->string('sku')->nullable();
            $table->integer('quantity')->nullable();
            $table->boolean('featured')->nullable()->default(false);
            $table->enum('status', ['Publicado', 'Borrador'])->default('Publicado');
            $table->string('iframe_url')->nullable();

            //Shipping
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->float('width')->nullable();
            $table->float('length')->nullable();

            //Metatags
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
