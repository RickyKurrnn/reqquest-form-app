<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestFormController extends Controller
{
    /**
     * Halaman form (Add New Form Request)
     * NOTE: kita pakai view('form') -> resources/views/form.blade.php
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Simpan data dari form ke session (demo)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'request_type'         => 'nullable|string',
            'document_number'      => 'nullable|string',
            'application_name'     => 'nullable|string',
            'request_date'         => 'nullable|string',
            'existing_condition'   => 'nullable|string',
            'expectations'         => 'nullable|string',
            'requested_by_name'    => 'nullable|string',
            'requested_by_position'=> 'nullable|string',
            'notes'                => 'nullable|string',
        ]);

        // ambil array saat ini dari session
        $rows = session('requests_demo', []);

        $newNo = count($rows) + 1;
        $rows[] = [
            'no' => $newNo,
            'requestDate' => $data['request_date'] ?? '',
            'taskReceived' => $data['request_type'] ?? '',
            'application' => $data['application_name'] ?? '',
            'fileName' => '-', // demo placeholder
            'fileUrl' => '#',
            'task' => '',
            'requestor' => $data['requested_by_name'] ?? '',
            'approvedBy' => '',
            'executedBy' => '',
            'acknowledgedBy' => '',
            'status' => 'Pending',
            'notes' => $data['notes'] ?? '',
        ];

        session(['requests_demo' => $rows]);

        return redirect()->back()->with('success', 'Request saved (demo).');
    }

    /**
     * API: kembalikan JSON dari session
     */
    public function index()
    {
        $rows = session('requests_demo', []);
        return response()->json($rows);
    }
}
