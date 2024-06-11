<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    /**
     * Smart Hospital メイン画面
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('smart.index');
    }
}
