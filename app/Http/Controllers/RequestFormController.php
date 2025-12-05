<?php

namespace App\Http\Controllers;

use App\Models\RequestForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Diperlukan jika ingin menggunakan Transaction

class RequestFormController extends Controller
{
    public function create()
    {
        return view('request_form.create');
    }

    public function store(Request $request)
    {
        // 1. VALIDASI DATA DARI VIEW
        $validatedData = $request->validate([
            // --- Kolom Utama Form ---
            'request_type' => 'required',
            'application_name' => 'required',
            'request_date' => 'required|date',
            'current_condition' => 'nullable', // Nama field di View
            'expectations' => 'nullable',
            'type' => 'required',
            'notes' => 'nullable',
            'document_number' => 'nullable', // Dari View
            'attachment' => 'nullable|file|max:5000',

            // --- Kolom Persetujuan (Sesuai dengan nama input di create.blade.php) ---
            // Requested By (req_)
            'req_name' => 'nullable|string|max:255',
            'req_position' => 'nullable|string|max:255',
            'req_date' => 'nullable|date',
            'req_signature' => 'nullable|file|mimes:jpeg,png,jpg|max:2048', 

            // Approved By (app_)
            'app_name' => 'nullable|string|max:255',
            'app_position' => 'nullable|string|max:255',
            'app_date' => 'nullable|date',
            'app_signature' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',

            // Executed By (exe_)
            'exe_name' => 'nullable|string|max:255',
            'exe_position' => 'nullable|string|max:255',
            'exe_date' => 'nullable|date',
            'exe_signature' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',

            // Acknowledged By (ack_)
            'ack_name' => 'nullable|string|max:255',
            'ack_position' => 'nullable|string|max:255',
            'ack_date' => 'nullable|date',
            'ack_signature' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // --- 2. PROSES MAPPING, UPLOAD, DAN PENYIMPANAN ---
        
        // Siapkan array data yang akan disimpan ke tabel request_forms
        $formDataToSave = [
            // Mapping Kolom Utama
            'request_type' => $validatedData['request_type'],
            'application_name' => $validatedData['application_name'],
            'request_date' => $validatedData['request_date'],
            'existing_condition' => $validatedData['current_condition'] ?? null, // Mapping 'current_condition' (View) ke 'existing_condition' (DB)
            'expectations' => $validatedData['expectations'],
            'type' => $validatedData['type'],
            'notes' => $validatedData['notes'],
            // ID (Document Number) diabaikan karena auto increment
            
            // Mapping Kolom Persetujuan (View Name -> DB Column Name)
            'requested_by_name' => $validatedData['req_name'] ?? null,
            'requested_by_position' => $validatedData['req_position'] ?? null,

            'approved_by_name' => $validatedData['app_name'] ?? null,
            'approved_by_position' => $validatedData['app_position'] ?? null,

            'executed_by_name' => $validatedData['exe_name'] ?? null,
            'executed_by_position' => $validatedData['exe_position'] ?? null,

            'acknowledged_by_name' => $validatedData['ack_name'] ?? null,
            'acknowledged_by_position' => $validatedData['ack_position'] ?? null,
        ];
        
        // Helper untuk memproses upload file dan menyimpan path ke array
        $processUpload = function (string $fileKey, string $pathKey, string $storageFolder) use ($request, &$formDataToSave) {
            if ($request->hasFile($fileKey)) {
                $formDataToSave[$pathKey] = $request->file($fileKey)->store($storageFolder, 'public');
            }
        };

        // Proses Tanda Tangan dan Attachment
        $processUpload('req_signature', 'requested_by_signature_path', 'signatures/requested');
        $processUpload('app_signature', 'approved_by_signature_path', 'signatures/approved');
        $processUpload('exe_signature', 'executed_by_signature_path', 'signatures/executed');
        $processUpload('ack_signature', 'acknowledged_by_signature_path', 'signatures/acknowledged');
        $processUpload('attachment', 'attachment_path', 'attachments'); // Asumsi kolom attachment_path di DB

        // Mapping Kolom Tanggal (Jika ada)
        // Jika Anda memiliki kolom requested_at, approved_at, dll. di DB:
        // $formDataToSave['requested_at'] = $validatedData['req_date'] ?? null;
        // $formDataToSave['approved_at'] = $validatedData['app_date'] ?? null;
        // $formDataToSave['executed_at'] = $validatedData['exe_date'] ?? null;
        // $formDataToSave['acknowledged_at'] = $validatedData['ack_date'] ?? null;

        // 3. INSERT KE DATABASE
        // Catatan: Pastikan semua kunci di $formDataToSave ada di $fillable Model RequestForm
        $form = RequestForm::create($formDataToSave);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}