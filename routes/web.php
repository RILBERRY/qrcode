<?php

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Route;
use Dompdf\Options;
use Dompdf\Dompdf;
// use PDF;
// use Knp\Snappy\Pdf;

// use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data = ["ސުޓާރޓު ކުރެވިއްޖެ!", "working?"];
    $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
    $snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', '/tmp/bill-123.pdf');

    // return View('inv', ['data'=>$data]);
    // $pdf = PDF::loadView('inv', ['data'=>$data]);
    // return $pdf->download('test.pdf');

});

Route::get('/pdf', function () {
    $message = "working?";
    $pdf = FacadePdf::loadView('inv',['message'=>$message]);
    return $pdf->stream('test.pdf');
    
    // return view('welcome');
});
Route::get('/qr',function(){
    // return QrCode::generate('Make me into a QrCode!');
    return view('qr');
});
Route::get('/qrcode', 'App\Http\Controllers\QRCodeController@index')->name('home.index');
Route::get('/pdfp', function () {
    // $options = new Options();
    // $options->set('defaultFont', 'DhivehiFont');

    $dompdf = new Dompdf();


    // $dompdf->loadHtml('');
    $dompdf->loadHtml("
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='main.css'>
        <title>docment</title>
        <style>
        .description{
                font-family: 'DhivehiFont';
                direction: rtl;
                unicode-bidi: bidi-override;
            }
        </style>
    </head>
    <body>
    <div class='control-body'>
    <div class='description'>ފެށިއްޖެ </div> <div>Started</div>

    </body>
    </html>
");

    // (Optional) Setup the paper size and orientation
    // $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
    // return $pdf->stream('test.pdf');
    
    // return view('welcome');
});
