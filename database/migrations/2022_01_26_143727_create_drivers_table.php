<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('phone_number')->nullable()->unique();
            $table->string('photo')->nullable();
            $table->string('national_id')->nullable();
            $table->string('driver_license')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('ambulance_type')->nullable();
            $table->string('car_model')->nullable();
            $table->string('car_name')->nullable();
            $table->string('ambulance_service_name')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('address')->nullable();
            $table->decimal('latitude', 8, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
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
        Schema::dropIfExists('drivers');
    }
}
