<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\XScanHistoryPort;
use Illuminate\Http\Request;

class XScanHistoryPortsController extends Controller
{
    public function get_history_ports(Request $request)
    {
        return response()->json(XScanHistoryPort::where('id_user', auth()->id())->orderByDesc('created_at')->get());
    }

    public function get_history_panel(Request $request)
    {
        return response()->json(XScanHistoryPort::where('id_user', auth()->id())->orderByDesc('created_at')->limit(6)->get());
    }

    public function get_one_history_port(Request $request)
    {
        return response()->json(XScanHistoryPort::where('id', $request->idhistory)->get(["host", "onoroff", "port", "temp_history", "created_at", "description"])->first());
    }
}
