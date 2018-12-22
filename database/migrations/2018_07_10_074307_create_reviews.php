<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'reviews',
            function (Blueprint $table) {
                $table->increments('id');

//                $table->string('name')->nullable();
//                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->boolean('is_visible')->default(true);
                $table->unsignedInteger('user_id')->nullable();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

                $table->timestamp('review_data')->useCurrent();

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

        Schema::dropIfExists('reviews');

    }
}
