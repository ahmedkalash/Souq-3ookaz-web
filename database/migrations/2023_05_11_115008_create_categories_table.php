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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name_en', 50)->unique('categories_name_en');
            $table->unsignedBigInteger('poster_id')->nullable()->index('categories_images_id_fk');
            $table->string('name_ar', 50)->unique('categories_name_ar');
            $table->string('slug', 100)->unique('categories_slug');
            $table->unsignedBigInteger('parent_id')->nullable()->index('categories_categories_id_fk');
            $table->string('icon_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
