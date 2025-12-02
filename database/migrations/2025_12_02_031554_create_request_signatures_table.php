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
        Schema::create('request_signatures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('request_form_id');
            $table->enum('role', ['requested', 'approved', 'executed', 'acknowledged']);
            $table->string('name')->nullable();
            $table->string('position')->nullable();
            $table->date('date')->nullable();
            $table->string('signature_path')->nullable();
            $table->timestamps();

            $table->foreign('request_form_id')
                  ->references('id')->on('request_forms')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('request_signatures');
    }
};