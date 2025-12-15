<?php

namespace App\Http\Controllers;

use App\Models\RequestForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Jika nanti perlu transaction
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;

class RequestFormController extends Controller
{
    /**
     * Display list of request forms.
     */
    public function index()
    {
        // Ambil semua record, urut berdasarkan request_date desc
        $forms = RequestForm::orderBy('request_date', 'desc')->get();

        // kembalikan view index (resources/views/request_form/index.blade.php)
        return view('request_form.index', compact('forms'));
    }

    /**
     * Show create form view.
     */
    public function create()
    {
        return view('request_form.create');
    }

    /**
     * Store new request form.
     */
    public function store(Request $request)
    {
        // 1. VALIDASI DATA DARI VIEW
        $validatedData = $request->validate([
            // --- Kolom Utama Form ---
            'request_type' => 'required|string|max:255',
            'application_name' => 'required|string|max:255',
            'request_date' => 'required|date',
            'current_condition' => 'nullable|string',
            'expectations' => 'nullable|string',
            'type' => 'nullable|string',
            'notes' => 'nullable|string',
            'document_number' => 'nullable|string', // Dari View
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
            'expectations' => $validatedData['expectations'] ?? null,
            'type' => $validatedData['type'] ?? null,
            'notes' => $validatedData['notes'] ?? null,
        ];

        // Mapping Kolom Persetujuan (View Name -> DB Column Name)
        $formDataToSave['requested_by_name'] = $validatedData['req_name'] ?? null;
        $formDataToSave['requested_by_position'] = $validatedData['req_position'] ?? null;

        $formDataToSave['approved_by_name'] = $validatedData['app_name'] ?? null;
        $formDataToSave['approved_by_position'] = $validatedData['app_position'] ?? null;

        $formDataToSave['executed_by_name'] = $validatedData['exe_name'] ?? null;
        $formDataToSave['executed_by_position'] = $validatedData['exe_position'] ?? null;

        $formDataToSave['acknowledged_by_name'] = $validatedData['ack_name'] ?? null;
        $formDataToSave['acknowledged_by_position'] = $validatedData['ack_position'] ?? null;

        // Helper untuk memproses upload file dan menyimpan path ke array
        $processUpload = function (string $fileKey, string $pathKey, string $storageFolder) use ($request, &$formDataToSave) {
            if ($request->hasFile($fileKey)) {
                // Simpan ke storage/app/public/<storageFolder>
                $formDataToSave[$pathKey] = $request->file($fileKey)->store($storageFolder, 'public');
            }
        };

        // Proses Tanda Tangan dan Attachment
        $processUpload('req_signature', 'requested_by_signature_path', 'signatures/requested');
        $processUpload('app_signature', 'approved_by_signature_path', 'signatures/approved');
        $processUpload('exe_signature', 'executed_by_signature_path', 'signatures/executed');
        $processUpload('ack_signature', 'acknowledged_by_signature_path', 'signatures/acknowledged');
        $processUpload('attachment', 'attachment_path', 'attachments');

        // Mapping tanggal jika kolom ada
        if (Schema::hasColumn('request_forms', 'requested_at')) {
            $formDataToSave['requested_at'] = $validatedData['req_date'] ?? null;
        }
        if (Schema::hasColumn('request_forms', 'approved_at')) {
            $formDataToSave['approved_at'] = $validatedData['app_date'] ?? null;
        }
        if (Schema::hasColumn('request_forms', 'executed_at')) {
            $formDataToSave['executed_at'] = $validatedData['exe_date'] ?? null;
        }
        if (Schema::hasColumn('request_forms', 'acknowledged_at')) {
            $formDataToSave['acknowledged_at'] = $validatedData['ack_date'] ?? null;
        }

        // (2) Pastikan 'type' tidak null (mencegah NOT NULL error)
        if (empty($formDataToSave['type'])) {
            $formDataToSave['type'] = $validatedData['type'] ?? 'Open';
        }

        // (3) Document number: jika DB punya kolom simpan, jika tidak, append ke notes
        if (!empty($validatedData['document_number'])) {
            if (Schema::hasColumn('request_forms', 'document_number')) {
                $formDataToSave['document_number'] = $validatedData['document_number'];
            } else {
                $existingNotes = $formDataToSave['notes'] ?? '';
                $formDataToSave['notes'] = trim($existingNotes . "\nDoc#: " . $validatedData['document_number']);
            }
        }

        // 3. INSERT KE DATABASE
        $form = RequestForm::create($formDataToSave);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Export all records to CSV (Excel-friendly).
     */
    public function exportCsv()
    {
        $filename = 'request_forms_' . now()->format('Ymd_His') . '.csv';
        $forms = RequestForm::orderBy('request_date', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = [
            'id','request_date','request_type','application_name','task','requested_by_name','approved_by_name',
            'executed_by_name','acknowledged_by_name','type','notes','attachment_path'
        ];

        $callback = function() use ($forms, $columns) {
            $fh = fopen('php://output', 'w');
            // optional BOM for Excel (Windows)
            fprintf($fh, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($fh, $columns);

            foreach ($forms as $f) {
                $row = [
                    $f->id,
                    $f->request_date,
                    $f->request_type,
                    $f->application_name,
                    $f->task ?? '',
                    $f->requested_by_name,
                    $f->approved_by_name,
                    $f->executed_by_name,
                    $f->acknowledged_by_name,
                    $f->type,
                    str_replace(["\r","\n"], ' ', $f->notes),
                    $f->attachment_path,
                ];
                fputcsv($fh, $row);
            }

            fclose($fh);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    /**
     * Print view for single request (printable / save as PDF).
     */
    public function print($id)
    {
        $form = RequestForm::findOrFail($id);
        return view('request_form.print', compact('form'));
    }

    /**
     * Optional: Export single request as real PDF (requires barryvdh/laravel-dompdf).
     * If package not available, redirect to print view instead.
     */
    public function exportPdf($id)
    {
        $form = RequestForm::findOrFail($id);

        // check if PDF class exists (barryvdh/laravel-dompdf)
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('request_form.print', compact('form'));
            return $pdf->download('request_form_' . $form->id . '.pdf');
        }

        // fallback: open print view (user can Save as PDF manually)
        return view('request_form.print', compact('form'));
    }
}
