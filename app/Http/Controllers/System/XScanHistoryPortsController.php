<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\XScanHistoryPort;
use Illuminate\Http\Request;

class XScanHistoryPortsController extends Controller
{
    public function historypage()
    {
        $history = XScanHistoryPort::where("id_user", auth()->id())->orderByDesc('created_at')->paginate(11);
        return view('System.history.index')->with([
            "title" => "History",
            "history" => $history
        ]);
    }
}
