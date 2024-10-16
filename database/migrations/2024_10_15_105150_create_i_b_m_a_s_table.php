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
            $table->enum('pembayaran', ['Mandiri', 'Sponsor', 'Beasiswa']);
            $table->text('sponsor')->nullable();
            $table->enum('status', ['Mengupload File', 'Memeriksa', 'Diterima', 'Ditolak']);
            $table->text('file_passport')->nullable();
            $table->text('file_pasfoto')->nullable();
            $table->text('file_sk_sehat')->nullable();
            $table->text('file_soc')->nullable();
            $table->text('file_sofs')->nullable();
            $table->text('file_ijazah_transkrip')->nullable();
            $table->text('file_sponsor')->nullable();
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibma_log');
        Schema::dropIfExists('ibma');
    }
};
