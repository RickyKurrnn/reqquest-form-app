<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() // Hapus : void
    {
        Schema::create('request_forms', function (Blueprint $table) {
            $table->bigIncrements('id'); // Document Number (Perubahan di sini)
            $table->string('request_type'); // Tambahan
            $table->string('application_name'); // Tambahan
            $table->date('request_date'); // Tambahan
            $table->text('existing_condition')->nullable(); // Tambahan
            $table->text('expectations')->nullable(); // Tambahan
            $table->string('type'); // Tambahan
            $table->text('notes')->nullable(); // Tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() // Hapus : void
    {
        Schema::dropIfExists('request_forms');
    }
};