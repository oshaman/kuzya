<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'menus',
            function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('menu_name')->nullable();
                $table->string('slug')->unique();
                $table->string('menu_link')->nullable();
                $table->unsignedInteger('static_id')->nullable();

                $table->foreign('static_id')->references('id')->on('static_pages')->onDelete('set null');

                $table->unsignedInteger('parent_id')->nullable();
                $table->foreign('parent_id')->references('id')->on('menus')->onDelete('set null');
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
        Schema::dropIfExists('menus');
    }
}
