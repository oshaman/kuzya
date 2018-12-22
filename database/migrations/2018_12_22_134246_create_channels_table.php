<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');

            $table->string('image')->nullable();
            $table->boolean('active')->index()->default(false)->index();
            $table->unsignedTinyInteger('priority')->nullable()->default(null)->index();

            $table->unsignedInteger('partition_id')->nullable()->default(null);
            $table->foreign('partition_id')->references('id')->on('partitions')->onDelete('set null');

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
        Schema::dropIfExists('channels');
    }
}
