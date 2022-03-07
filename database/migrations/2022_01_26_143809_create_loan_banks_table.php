<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_banks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('phone_number')->nullable()->unique();
            $table->string('loan_bank_name')->nullable();
            $table->string('loan_account_number')->nullable();
            $table->string('photo')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('loan_banks');
    }
}
