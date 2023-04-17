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
            $table->timestamps();
            $table->string('name_en',50);
            $table->string('name_ar',50);
            $table->decimal('price');
            $table->Integer('stock');
            $table->text('description' );
            $table->string('brand' );
            $table->string('status' );
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')
                ->on('categories')->cascadeOnUpdate();

            $table->unsignedBigInteger('poster_id');
            $table->foreign('poster_id')->references('id')
                ->on('images')->cascadeOnUpdate()->cascadeOnDelete();
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
