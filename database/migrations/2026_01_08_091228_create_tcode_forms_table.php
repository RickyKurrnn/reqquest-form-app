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
        Schema::create('tcode_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            // MAIN DATA
            $table->date('request_date');
            $table->string('document_number');
            $table->string('name');
            $table->string('company');
            $table->string('employee_id');
            $table->string('position');
            $table->string('sap_username');
            $table->string('division');
            $table->string('department');
            $table->string('email');

            // ENUM SAP MODULE
            $table->enum('sap_module', ['FI', 'CO', 'PM', 'MM', 'PS']);

            $table->string('client');
            $table->text('request_description');

            // APPROVAL DATES
            $table->date('authorization_added')->nullable();

            // NAMES
            $table->string('requested_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('added_by')->nullable();
            $table->string('acknowledged_by')->nullable();

            // ATTACHMENT
            $table->string('attachment_path')->nullable();

            // STATUS
            $table->enum('status', ['Show', 'Hide']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tcode_forms');
    }
};
