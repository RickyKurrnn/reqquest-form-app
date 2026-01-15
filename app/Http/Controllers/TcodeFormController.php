<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TcodeForm;
use App\Models\TcodeSignature;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TcodeFormController extends Controller
{
    public function viewCreate()
    {
        return view('tcode_form.create');
    }

    public function store(Request $request)
    {
        // ================= VALIDATION =================
        $validated = $request->validate([
            // MAIN FORM
            'document_number'       => 'required|string|max:255',
            'request_date'          => 'required|date',
            'name'                  => 'required|string|max:255',
            'company'               => 'required|string|max:255',
            'employee_id'           => 'required|string|max:255',
            'position'              => 'required|string|max:255',
            'sap_username'          => 'required|string|max:255',
            'division'              => 'required|string|max:255',
            'department'            => 'required|string|max:255',
            'email'                 => 'required|email',
            'sap_module'            => 'required|in:FI,CO,PM,MM,PS',
            'client'                => 'required|string|max:255',
            'request_description'   => 'required|string',
            'authorization_added'   => 'nullable|date',

            // ATTACHMENT
            'attachment_path'       => 'nullable|file|max:5120',

            // SIGNATURES
            'signatures.*.name'     => 'nullable|string|max:255',
            'signatures.*.file'     => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::transaction(function () use ($request, $validated) {

            // ================= INSERT TCODE FORM =================
            $form = TcodeForm::create([
                'created_by'          => Auth::id(),
                'document_number'     => $validated['document_number'],
                'request_date'        => $validated['request_date'],
                'name'                => $validated['name'],
                'company'             => $validated['company'],
                'employee_id'         => $validated['employee_id'],
                'position'            => $validated['position'],
                'sap_username'        => $validated['sap_username'],
                'division'            => $validated['division'],
                'department'          => $validated['department'],
                'email'               => $validated['email'],
                'sap_module'          => $validated['sap_module'],
                'client'              => $validated['client'],
                'request_description' => $validated['request_description'],
                'authorization_added' => $validated['authorization_added'] ?? null,
                'attachment_path'     => $request->hasFile('attachment_path')
                    ? $request->file('attachment_path')->store('attachments/tcode', 'public')
                    : null,
                'status'              => 'Show',
                'requested_by'    => $request->input('signatures.requested.name'),
                'approved_by'     => $request->input('signatures.approved.name'),
                'added_by'        => $request->input('signatures.added.name'),
                'acknowledged_by' => $request->input('signatures.acknowledged.name'),
            ]);

            // ================= INSERT SIGNATURES =================
            if ($request->has('signatures')) {
                foreach ($request->signatures as $role => $signature) {

                    // skip kalau kosong semua
                    if (empty($signature['name']) && empty($signature['file'])) {
                        continue;
                    }

                    $signaturePath = null;
                    if (isset($signature['file'])) {
                        $signaturePath = $signature['file']
                            ->store("signatures/tcode/{$role}", 'public');
                    }

                    TcodeSignature::create([
                        'tcode_form_id' => $form->id,
                        'role'          => $role,
                        'name'          => $signature['name'] ?? null,
                        'signature_path'=> $signaturePath,
                    ]);
                }
            }
        });

        return redirect()->back()->with('success', 'TCode Form successfully saved');
    }

    public function getData()
    {
        try {

            $moduleMap = [
                'FI' => 'Finance Accounting (FI)',
                'CO' => 'Controlling (CO)',
                'PM' => 'Plant Maintenance (PM)',
                'MM' => 'Material Management (MM)',
                'PS' => 'Project System (PS)',
            ];
            $forms = TcodeForm::where('created_by', auth()->id())
                ->where('status', 'Show')
                ->orderBy('request_date', 'desc')
                ->get();

            $data = [];
            $no = 1;

            foreach ($forms as $form) {
                $data[] = [
                    $no++,
                    $form->request_date
                        ? Carbon::parse($form->request_date)->format('d-m-Y')
                        : '-',
                    $form->document_number ?? '-',
                    $form->name ?? '-',
                    $form->company ?? '-',
                    $form->sap_username ?? '-',
                    $moduleMap[$form->sap_module] ?? $form->sap_module ?? '-',
                    $form->client ?? '-',
                    '<button class="btn btn-primary btn-sm me-1" onclick="modalShow(this)" data-id="'.$form->id.'">
                        <i class="fa fa-eye"></i>
                    </button>

                    <button class="btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$form->id.'">
                        <i class="fa fa-trash"></i>
                    </button>
                    ',
                ];
            }

            return response()->json([
                'draw' => 1,
                'recordsTotal' => count($data),
                'recordsFiltered' => count($data),
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function searchDataForm(Request $request)
    {
        try {

            $moduleMap = [
                'FI' => 'Finance Accounting (FI)',
                'CO' => 'Controlling (CO)',
                'PM' => 'Plant Maintenance (PM)',
                'MM' => 'Material Management (MM)',
                'PS' => 'Project System (PS)',
            ];

            $query = TcodeForm::where('created_by', auth()->id())
                ->where('status', 'Show');


            if ($request->filled('request_date')) {
                $query->whereDate('request_date', $request->request_date);
            }

            if ($request->filled('document_number')) {
                $query->where('document_number', 'like', '%' . $request->document_number . '%');
            }

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('sap_module')) {
                $query->where('sap_module', $request->sap_module);
            }

            $forms = $query->orderBy('request_date', 'desc')->get();

            $data = [];
            $no = 1;

            foreach ($forms as $form) {
                $data[] = [
                    $no++,
                    $form->request_date
                        ? Carbon::parse($form->request_date)->format('d-m-Y')
                        : '-',
                    $form->document_number ?? '-',
                    $form->name ?? '-',
                    $form->company ?? '-',
                    $form->sap_username ?? '-',
                    $moduleMap[$form->sap_module] ?? $form->sap_module ?? '-',
                    $form->client ?? '-',
                    '<button class="btn btn-primary btn-sm me-1" onclick="modalShow(this)" data-id="'.$form->id.'">
                        <i class="fa fa-eye"></i>
                    </button>

                    <button class="btn btn-danger btn-sm" onclick="deleteData(this)" data-id="'.$form->id.'">
                        <i class="fa fa-trash"></i>
                    </button>
                    ',
                    ];
            }

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => count($data),
                'recordsFiltered' => count($data),
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function detailForm($id)
    {
        $data = TcodeForm::findOrFail($id);

        return response()->json([
            // Document & Employee Info
            'document_number' => $data->document_number,
            'request_date' => $data->request_date,
            'name' => $data->name,
            'company' => $data->company,
            'employee_id' => $data->employee_id,
            'sap_username' => $data->sap_username,
            'division' => $data->division,
            'department' => $data->department,
            'email' => $data->email,
            'sap_module' => $data->sap_module,
            'client' => $data->client,
            'authorization_added' => $data->authorization_added,
            'request_description' => $data->request_description,

            // Approval Info (cuma nama)
            'requested_by' => $data->requested_by,
            'approved_by' => $data->approved_by,
            'added_by' => $data->added_by,
            'acknowledged_by' => $data->acknowledged_by,
        ]);
    }

    public function updateForm(Request $request, $id)
    {
        TcodeForm::where('id', $id)->update([
            'document_number' => $request->document_number,
            'request_date' => $request->request_date,
            'name' => $request->name,
            'company' => $request->company,
            'employee_id' => $request->employee_id,
            'sap_username' => $request->sap_username,
            'division' => $request->division,
            'department' => $request->department,
            'email' => $request->email,
            'sap_module' => $request->sap_module,
            'client' => $request->client,
            'authorization_added' => $request->authorization_added,
            'request_description' => $request->request_description,
        ]);

        return response()->json(['success' => true]);
    }

    public function softDelete(Request $request, $id)
    {
        TcodeForm::where('id', $id)->update([
            'status' => 'Hide'
        ]);

        return response()->json(['success' => true]);
    }

    public function viewList()
    {
        return view('tcode_form.list');
    }

}
