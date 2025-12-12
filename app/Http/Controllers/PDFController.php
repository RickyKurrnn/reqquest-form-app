<?php

namespace App\Http\Controllers;
use App\Models\RequestForm;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function exportPDF()
    {
        $id = 1;
        $form = RequestForm::with('signatures')->findOrFail($id);

        $pdf = PDF::loadView('pdf.laporan', [
            'form' => $form,
            'signatures' => $form->signatures
        ]);

        // return $pdf->download('laporan.pdf');
        return $pdf->stream('laporan.pdf');
    }
}
