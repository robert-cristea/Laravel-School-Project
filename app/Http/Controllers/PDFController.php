<?php
namespace App\Http\Controllers;

use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        $data = [
            'title' => 'First PDF for Coding Driver',
            'heading' => 'Hello from Coding Driver',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
        ];

        $pdf = PDF::loadView('generate_pdf', $data);

        return $pdf->download('codingdriver.pdf');
    }
}
