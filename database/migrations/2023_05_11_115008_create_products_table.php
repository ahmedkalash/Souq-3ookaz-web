<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name_en', 50);
            $table->string('name_ar', 50);
            $table->decimal('price');
            $table->unsignedInteger('stock');
            $table->text('description');
            $table->string('brand');
            $table->enum('status', ['available', 'not available']);
            $table->unsignedBigInteger('category_id')->nullable()->index('products_category_id_foreign');
            $table->unsignedBigInteger('poster_id')->nullable()->index('products_images_id_fk');
            $table->string('slug', 100)->unique('products_slug');
            $table->text('long_description');
            $table->unsignedDecimal('average_rating', 3)->default(0);
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
};
