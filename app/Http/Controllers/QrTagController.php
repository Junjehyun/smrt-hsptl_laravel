<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrTagController extends Controller
{
    //
    public function QrPageIndex() {
        return view('smart.qr-tag');
    }
}
