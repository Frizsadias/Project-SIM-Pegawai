<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('pdf_file')) {
            $pdf = $request->file('pdf_file');
            $pdfPath = $pdf->store('pdfs', 'public'); // Store the PDF in the "storage/app/public/pdfs" directory
            // You can also store the file path in the database if needed
            return "Unggah PDF berhasil!";
        }
        return "Tidak ada file PDF yang diunggah.";
    }
}