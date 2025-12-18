<?php

namespace App\Http\Controllers;

use App\Models\RequestForm;
use App\Models\RequestSignature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Jika nanti perlu transaction
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;


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

    public function viewList()
    {
        return view('request_form.list');
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
        // VALIDASI INPUT
        $validatedData = $request->validate([
            // --- Kolom Utama ---
            'request_type' => 'required',
            'application_name' => 'required',
            'request_date' => 'required|date',
            'current_condition' => 'nullable',
            'expectations' => 'nullable',
            'type' => 'required',
            'notes' => 'nullable',
            'attachment' => 'nullable|file|max:5000',

            // Requested By
            'req_name' => 'nullable|string|max:255',
            'req_position' => 'nullable|string|max:255',
            'req_date' => 'nullable|date',
            'req_signature' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',

            // Approved By
            'app_name' => 'nullable|string|max:255',
            'app_position' => 'nullable|string|max:255',
            'app_date' => 'nullable|date',
            'app_signature' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',

            // Executed By
            'exe_name' => 'nullable|string|max:255',
            'exe_position' => 'nullable|string|max:255',
            'exe_date' => 'nullable|date',
            'exe_signature' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',

            // Acknowledged By
            'ack_name' => 'nullable|string|max:255',
            'ack_position' => 'nullable|string|max:255',
            'ack_date' => 'nullable|date',
            'ack_signature' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        // insert ke tabel request_forms
        $form = RequestForm::create([
            'request_type' => $validatedData['request_type'],
            'application_name' => $validatedData['application_name'],
            'request_date' => $validatedData['request_date'],
            'existing_condition' => $validatedData['current_condition'] ?? null,
            'expectations' => $validatedData['expectations'] ?? null,
            'type' => $validatedData['type'],
            'notes' => $validatedData['notes'] ?? null,

            'requested_by_name' => $validatedData['req_name'] ?? null,
            'requested_by_position' => $validatedData['req_position'] ?? null,
            'requested_at' => $validatedData['req_date'] ?? null,
            'requested_by_signature_path' => "-",

            'approved_by_name' => $validatedData['app_name'] ?? null,
            'approved_by_position' => $validatedData['app_position'] ?? null,
            'approved_at' => $validatedData['app_date'] ?? null,
            'approved_by_signature_path' => "-",

            'executed_by_name' => $validatedData['exe_name'] ?? null,
            'executed_by_position' => $validatedData['exe_position'] ?? null,
            'executed_at' => $validatedData['exe_date'] ?? null,
            'executed_by_signature_path' => "-",

            'acknowledged_by_name' => $validatedData['ack_name'] ?? null,
            'acknowledged_by_position' => $validatedData['ack_position'] ?? null,
            'acknowledged_at' => $validatedData['ack_date'] ?? null,
            'acknowledged_by_signature_path' => "-",

            // Attachment
            'attachment_path' => $request->hasFile('attachment')
                ? $request->file('attachment')->store('attachments', 'public')
                : null
        ]);

        // bikin list role
        $roles = [
            'requested' => ['name' => 'req_name', 'pos' => 'req_position', 'date' => 'req_date', 'sign' => 'req_signature'],
            'approved'  => ['name' => 'app_name', 'pos' => 'app_position', 'date' => 'app_date', 'sign' => 'app_signature'],
            'executed'  => ['name' => 'exe_name', 'pos' => 'exe_position', 'date' => 'exe_date', 'sign' => 'exe_signature'],
            'acknowledged' => ['name' => 'ack_name', 'pos' => 'ack_position', 'date' => 'ack_date', 'sign' => 'ack_signature'],
        ];

        // insert multiple data ke request_signatures
        foreach ($roles as $role => $field) {
            if ($validatedData[$field['name']] || $validatedData[$field['pos']] || $validatedData[$field['date']] || $request->hasFile($field['sign'])) {

                $signaturePath = null;
                if ($request->hasFile($field['sign'])) {
                    $signaturePath = $request->file($field['sign'])->store("signatures/$role", 'public');
                }

                RequestSignature::create([
                    'request_form_id' => $form->id,
                    'role' => $role,
                    'name' => $validatedData[$field['name']],
                    'position' => $validatedData[$field['pos']],
                    'date' => $validatedData[$field['date']],
                    'signature_path' => $signaturePath,
                ]);
            }
        }

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

    public function getData()
    {
        try{

            $dataForm = RequestForm::orderBy('request_date', 'desc')->get();

            $data = array();

            $no = 1;

            foreach($dataForm as $form){
                $row = array();
                $row[] = $no++;
                $row[] = $form->request_date? Carbon::parse($form->request_date)->locale('id')->translatedFormat('d F Y'): '-';
                $row[] = $form->task_received ?? '-';
                $row[] = $form->application_name ?? '-';
                $row[] = $form->task ?? '-';
                $row[] = $form->requested_by_name ?? '-';
                $row[] = $form->approved_by_name ?? '-';
                $row[] = $form->executed_by_name ?? '-';
                $row[] = $form->acknowledged_by_name ?? '-';
                $row[] = $form->type ?? '-';
                $row[] = '<a href="' . route('form.export.new', $form->id) . '"class="btn btn-success">Export PDF</a>';
                $data[] = $row;
            }

            return response()->json([
                "sql" => $dataForm,
                "draw" => -1,
                "recordsTotal" => count($data),
                "recordsFiltered" => count($data),
                "data" => $data
            ]);

        } catch (Exception $ex){
            return response()->json([
                'code' => $ex->getCode(),
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function searchDataForm(Request $request)
    {
        try {

            $query = RequestForm::query();

            // FILTERS
            if ($request->filled('request_date')) {
                $query->whereDate('request_date', $request->request_date);
            }

            if ($request->filled('application')) {
                $query->where('application_name', 'like', '%' . $request->application . '%');
            }

            if ($request->filled('requestor')) {
                $query->where('requested_by_name', 'like', '%' . $request->requestor . '%');
            }

            if ($request->filled('status')) {
                $query->where('type', 'like', '%' . $request->status . '%');
            }

            $dataForm = $query
                ->orderBy('request_date', 'desc')
                ->get();

            // FORMAT FOR DATATABLES
            $data = array();
            $no = 1;

            foreach ($dataForm as $form) {
                $row = [];
                $row[] = $no++;
                $row[] = $form->request_date? Carbon::parse($form->request_date)->locale('id')->translatedFormat('d F Y'): '-';
                $row[] = $form->task_received ?? '-';
                $row[] = $form->application_name ?? '-';
                $row[] = $form->task ?? '-';
                $row[] = $form->requested_by_name ?? '-';
                $row[] = $form->approved_by_name ?? '-';
                $row[] = $form->executed_by_name ?? '-';
                $row[] = $form->acknowledged_by_name ?? '-';
                $row[] = $form->type ?? '-';
                $row[] = '<a href="' . route('form.export.new', $form->id) . '" class="btn btn-success btn-sm">
                            Export PDF
                        </a>';

                $data[] = $row;
            }

            return response()->json([
                "draw" => intval($request->draw),
                "recordsTotal" => $dataForm->count(),
                "recordsFiltered" => $dataForm->count(),
                "data" => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
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

    public function exportFormPDF($id)
    {
        // $id = 1;
        $form = RequestForm::with('signatures')->findOrFail($id);

        $pdf = PDF::loadView('request_form.formpdf', [
            'form' => $form,
            'signatures' => $form->signatures
        ]);

        // return $pdf->download('laporan.pdf');
        return $pdf->stream('form.pdf');
    }

}
