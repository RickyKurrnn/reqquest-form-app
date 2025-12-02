<?php

namespace App\Http\Controllers;

use App\Models\RequestForm;          // <--- BARIS INI DITAMBAHKAN
use App\Models\RequestSignature;      // <--- BARIS INI DITAMBAHKAN
use Illuminate\Http\Request;

class RequestFormController extends Controller
{
    public function create()
    {
        return view('request_form.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $data = $request->validate([
            'request_type' => 'required',
            'application_name' => 'required',
            'request_date' => 'required|date',
            'existing_condition' => 'nullable',
            'expectations' => 'nullable',
            'type' => 'required',
            'notes' => 'nullable',
            
            'signatures.*.role' => 'required',
            'signatures.*.name' => 'nullable',
            'signatures.*.position' => 'nullable',
            'signatures.*.date' => 'nullable|date',
            'signatures.*.file' => 'nullable|file'
        ]);

        // Insert main form
        $form = RequestForm::create($data);

        // Process signatures
        if ($request->has('signatures')) {
            foreach ($request->signatures as $sig) {

                $path = null;
                if (isset($sig['file'])) {
                    $path = $sig['file']->store('signatures', 'public');
                }

                RequestSignature::create([
                    'request_form_id' => $form->id,
                    'role' => $sig['role'],
                    'name' => $sig['name'],
                    'position' => $sig['position'],
                    'date' => $sig['date'],
                    'signature_path' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}

