<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;
use App\Models\RequestSignature;
use App\Models\TcodeForm;
use App\Models\TcodeSignature;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function exportTcodePDF($id)
    {
        // $id = 1;
        $form = TcodeForm::with('signatures')->findOrFail($id);

        $pdf = PDF::loadView('pdf.tcode', [
            'form' => $form,
            'signatures' => $form->signatures
        ]);

        // return $pdf->download('laporan.pdf');
        return $pdf->stream('form.pdf');
    }

    public function exportCrPDF()
    {
        $id = 1;
        $form = RequestForm::with('signatures')->findOrFail($id);

        $pdf = PDF::loadView('pdf.cr', [
            'form' => $form,
            'signatures' => $form->signatures
        ]);

        // return $pdf->download('laporan.pdf');
        return $pdf->stream('form.pdf');
    }

    public function exportTransportPDF()
    {
        $id = 1;
        $form = RequestForm::with('signatures')->findOrFail($id);

        $pdf = PDF::loadView('pdf.transport', [
            'form' => $form,
            'signatures' => $form->signatures
        ]);

        // return $pdf->download('laporan.pdf');
        return $pdf->stream('form.pdf');
    }

    public function exportFunctionalPDF()
    {
        $id = 1;
        $form = RequestForm::with('signatures')->findOrFail($id);

        $pdf = PDF::loadView('pdf.functional', [
            'form' => $form,
            'signatures' => $form->signatures
        ])
        ->setPaper('A4', 'landscape')
        ->setOption([
            'isPhpEnabled' => true
        ]);

        return $pdf->stream('form.pdf');

    }

}
