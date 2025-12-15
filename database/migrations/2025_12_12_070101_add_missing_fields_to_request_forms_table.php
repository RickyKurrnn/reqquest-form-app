<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToRequestFormsTable extends Migration
{
    public function up()
    {
        Schema::table('request_forms', function (Blueprint $table) {
            // Tanggal / waktu persetujuan/permintaan/eksekusi/acknowledge
            if (!Schema::hasColumn('request_forms', 'requested_at')) {
                $table->timestamp('requested_at')->nullable()->after('requested_by_position');
            }
            if (!Schema::hasColumn('request_forms', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('approved_by_position');
            }
            if (!Schema::hasColumn('request_forms', 'executed_at')) {
                $table->timestamp('executed_at')->nullable()->after('executed_by_position');
            }
            if (!Schema::hasColumn('request_forms', 'acknowledged_at')) {
                $table->timestamp('acknowledged_at')->nullable()->after('acknowledged_by_position');
            }

            // Path / lokasi file tanda tangan dan attachment (string, nullable)
            if (!Schema::hasColumn('request_forms', 'requested_by_signature_path')) {
                $table->string('requested_by_signature_path')->nullable()->after('requested_at');
            }
            if (!Schema::hasColumn('request_forms', 'approved_by_signature_path')) {
                $table->string('approved_by_signature_path')->nullable()->after('approved_at');
            }
            if (!Schema::hasColumn('request_forms', 'executed_by_signature_path')) {
                $table->string('executed_by_signature_path')->nullable()->after('executed_at');
            }
            if (!Schema::hasColumn('request_forms', 'acknowledged_by_signature_path')) {
                $table->string('acknowledged_by_signature_path')->nullable()->after('acknowledged_at');
            }

            if (!Schema::hasColumn('request_forms', 'attachment_path')) {
                $table->string('attachment_path')->nullable()->after('acknowledged_by_signature_path');
            }
        });
    }

    public function down()
    {
        Schema::table('request_forms', function (Blueprint $table) {
            $cols = [
                'requested_at','approved_at','executed_at','acknowledged_at',
                'requested_by_signature_path','approved_by_signature_path',
                'executed_by_signature_path','acknowledged_by_signature_path',
                'attachment_path'
            ];
            foreach ($cols as $c) {
                if (Schema::hasColumn('request_forms', $c)) {
                    $table->dropColumn($c);
                }
            }
        });
    }
}
