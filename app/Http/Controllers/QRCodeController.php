<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function index() 
    {
        $link = "/item/2";

        return view('barcode', [
            'link' => $link
        ]);
    }
}