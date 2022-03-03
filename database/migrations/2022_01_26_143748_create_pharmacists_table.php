<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacists', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('phone_number')->nullable()->unique();
            $table->tinyInteger('status')->default(1);
            $table->string('address')->nullable();
            $table->string('alt_address')->nullable();
            $table->decimal('latitude', 8, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->string('logo')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
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
        Schema::dropIfExists('pharmacists');
    }
}
