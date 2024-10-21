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
        Schema::create('ibma', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 36);
            $table->string('no_surat', 36)->nullable();
            $table->string('study_program',64);
            $table->date('date_start');
            $table->date('date_end');
            $table->boolean('sponsor')->default(false);
            $table->enum('status', ['Mengupload File', 'Dalam Pemeriksaan', 'Diterima', 'Ditolak'])->default("Mengupload File");
            $table->text('file_passport')->nullable();
            $table->text('file_sk_sehat')->nullable();
            $table->text('file_soc')->nullable();
            $table->text('file_sofs')->nullable();
            $table->text('file_ijazah_transkrip')->nullable();
            $table->boolean('resend')->default(false);
            $table->text('reason_reject')->nullable();
            $table->string('admin_id', 36)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate();
            $table->foreign('admin_id')->references('id')->on('users')->cascadeOnUpdate();
        });
        Schema::create('ibma_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ibma_id');
            $table->enum('status', ['Mengajukan', 'Memperbaiki Pengajuan', 'Diterima', 'Ditolak']);
            $table->text('desc');
            $table->timestamp('created_at');
            $table->enum('created_by',['USER','ADMIN']);
            $table->string('user_id', 36);
            $table->foreign('ibma_id')->references('id')->on('ibma')->cascadeOnUpdate();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate();
        });
        Schema::create('ibma_sponsor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ibma_id');
            $table->string('name',64);
            $table->enum('type', ['Beasiswa', 'Sponsor']);
            $table->text('file_sponsor');
            $table->timestamps();
            $table->foreign('ibma_id')->references('id')->on('ibma')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ibma_sponsor', function (Blueprint $table) {
            $table->dropForeign('ibma_id');
        });
        Schema::table('ibma_log', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'ibma_id']);
        });
        Schema::dropIfExists('ibma_sponsor');
        Schema::dropIfExists('ibma_log');
        Schema::table('ibma', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'admin_id']);
        });
        Schema::dropIfExists('ibma');
    }
};
