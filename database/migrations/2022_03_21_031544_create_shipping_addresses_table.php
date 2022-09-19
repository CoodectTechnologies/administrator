<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('set null');
            $table->string('municipality');
            $table->string('colony');
            $table->string('zip_code');
            $table->text('street');
            $table->string('street_number_int');
            $table->string('street_number_ext')->nullable();
            $table->text('street_between')->nullable();
            $table->text('street_references')->nullable();
            $table->string('company')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->double('default')->nullable()->default(false);
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
        Schema::dropIfExists('shipping_addresses');
    }
}
