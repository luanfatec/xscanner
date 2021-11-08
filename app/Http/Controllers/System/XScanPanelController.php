<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class XScanPanelController extends Controller
{
    public function homepanel()
    {
        return view('System.panel.index')->with([
            "title" => "Painel",
        ]);
    }
}
