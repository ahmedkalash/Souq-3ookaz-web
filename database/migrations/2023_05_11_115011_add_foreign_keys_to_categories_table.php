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
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign(['parent_id'], 'categories_categories_id_fk')->references(['id'])->on('categories')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign(['poster_id'], 'categories_images_id_fk')->references(['id'])->on('images')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign('categories_categories_id_fk');
            $table->dropForeign('categories_images_id_fk');
        });
    }
};
