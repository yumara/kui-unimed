<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->string('user_id', 36);
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->string('place_birth',64)->nullable();
            $table->date('date_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('city',64)->nullable();
            $table->string('country',64)->nullable();
            $table->string('zipcode',10)->nullable();
            $table->string('citizenship',64)->nullable();
            $table->string('occupation',64)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('passport_id', 36)->nullable();
            $table->string('study_program',64)->nullable();
            $table->text('file_pasfoto')->nullable();
            $table->timestamps();
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};
