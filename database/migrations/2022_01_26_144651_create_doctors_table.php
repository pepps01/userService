<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('phone_number')->nullable()->unique();
            $table->string('photo')->nullable();
            $table->string('other_name')->nullable();
            $table->string('title')->nullable();
            $table->string('hospital')->nullable();
            $table->string('specialization')->nullable();
            $table->string('gender')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->boolean('is_profile_verified')->default(0);
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
        Schema::dropIfExists('doctors');
    }
}
