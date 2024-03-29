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
            $table->string('phone_number')->nullable()->unique();
            $table->string('photo')->nullable();
            $table->string('other_name')->nullable();
            $table->string('title')->nullable();
            $table->string('hospital')->nullable();
            $table->unsignedInteger('specialization_id');
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('bio')->nullable();
            $table->decimal('latitude', 8, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
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
