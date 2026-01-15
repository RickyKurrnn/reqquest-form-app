<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('request_forms', function (Blueprint $table) {

            // Kolom ID Otomatis
            $table->bigIncrements('id');

            // --- FORM MAIN FIELDS ---
            $table->string('request_type');
            $table->string('document_number');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->string('application_name');
            $table->date('request_date');
            $table->text('existing_condition')->nullable();
            $table->text('expectations')->nullable();
            $table->string('type');
            $table->text('notes')->nullable();

            // --- APPROVAL FIELDS DITAMBAHKAN DI SINI ---

            // Requested By
            $table->string('requested_by_name')->nullable();
            $table->string('requested_by_position')->nullable();
            // Disarankan: $table->date('requested_at')->nullable();

            // Approved By
            $table->string('approved_by_name')->nullable();
            $table->string('approved_by_position')->nullable();
            // Disarankan: $table->date('approved_at')->nullable();

            // Executed By
            $table->string('executed_by_name')->nullable();
            $table->string('executed_by_position')->nullable();
            // Disarankan: $table->date('executed_at')->nullable();

            // Acknowledged By
            $table->string('acknowledged_by_name')->nullable();
            $table->string('acknowledged_by_position')->nullable();
            // Disarankan: $table->date('acknowledged_at')->nullable();

            // ================================================================
            // tambahin ini
            // ================================================================
            $table->date('requested_at')->nullable();
            $table->string('requested_by_signature_path')->nullable();

            $table->date('approved_at')->nullable();
            $table->string('approved_by_signature_path')->nullable();

            $table->date('executed_at')->nullable();
            $table->string('executed_by_signature_path')->nullable();

            $table->date('acknowledged_at')->nullable();
            $table->string('acknowledged_by_signature_path')->nullable();

            $table->string('attachment_path')->nullable();
            //=================================================================

            // STATUS
            $table->enum('status', ['Show', 'Hide']);

            // Timestamps standar Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('request_forms');
    }
};
