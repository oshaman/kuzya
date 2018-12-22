<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
        /**
         * @param Blueprint $table
         */
            'static_pages',
            function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->boolean('published')->default(false);

                $table->string('slug');
                $table->string('template')->nullable();

                $table->string('name');
                $table->string('name_uk')->nullable();

                $table->text('content');
                $table->text('content_uk')->nullable();

//                $table->json('attr')->nullable();

                $table->unsignedInteger('seo_id_ru')->nullable();
                $table->foreign('seo_id_ru')
                    ->references('id')
                    ->on('seos')
                    ->onDelete('set null');

                $table->unsignedInteger('seo_id_uk')->nullable();
                $table->foreign('seo_id_uk')
                    ->references('id')
                    ->on('seos')
                    ->onDelete('set null');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_pages');
    }
}
