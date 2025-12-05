<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestForm extends Model
{
    protected $fillable = [
        // --- KOLOM UTAMA ---
        'request_type',
        'application_name',
        'request_date',
        'existing_condition',
        'expectations',
        'type',
        'notes',
        
        // --- 1. REQUESTED BY ---
        'requested_by_name',
        'requested_by_position',
        'requested_at',                  // <--- BARU: Kolom untuk tanggal request
        'requested_by_signature_path',   // <--- BARU: Kolom untuk path file signature

        // --- 2. APPROVED BY ---
        'approved_by_name',
        'approved_by_position',
        'approved_at',                   // <--- BARU: Kolom untuk tanggal approved
        'approved_by_signature_path',    // <--- BARU: Kolom untuk path file signature

        // --- 3. EXECUTED BY ---
        'executed_by_name',
        'executed_by_position',
        'executed_at',                   // <--- BARU: Kolom untuk tanggal executed
        'executed_by_signature_path',    // <--- BARU: Kolom untuk path file signature

        // --- 4. ACKNOWLEDGED BY ---
        'acknowledged_by_name',
        'acknowledged_by_position',
        'acknowledged_at',               // <--- BARU: Kolom untuk tanggal acknowledged
        'acknowledged_by_signature_path',// <--- BARU: Kolom untuk path file signature
        
        // --- 5. KOLOM LAIN ---
        'attachment_path',               // <--- BARU: Kolom untuk path file attachment
    ];

    public function signatures()
    {
        // Catatan: Jika Anda tidak menggunakan Model RequestSignature, relasi ini bisa dihapus.
        // Jika Anda ingin mempertahankannya, biarkan saja.
        return $this->hasMany(RequestSignature::class);
    }
}