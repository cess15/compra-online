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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('per_name')->nullable();
            $table->string('per_second_name')->nullable();
            $table->string('per_lastname')->nullable();
            $table->string('per_second_lastname')->nullable();
            $table->string('pers_full_name')->nullable();
            $table->string('pers_identification')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->on('users')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
