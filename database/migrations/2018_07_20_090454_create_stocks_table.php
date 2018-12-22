<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'stocks',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('image')->nullable();
                $table->string('slug')->nullable();
                $table->timestamp('date_in')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->boolean('active')->default(0);

                $table->timestamps();
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
        Schema::dropIfExists('stocks');
    }
}
