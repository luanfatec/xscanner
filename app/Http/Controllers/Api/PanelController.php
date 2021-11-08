<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\XScanHistoryPort;
use App\Models\XScanHosts;
use App\Models\XScanPort;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    public function get_count(Request $request)
    {
        return response()->json([
            "host" => XScanHosts::where('id_user', auth()->id())->get()->count(),
            "port" => XScanPort::where('id_user', auth()->id())->get()->count(),
            "history" => XScanHistoryPort::where('id_user', auth()->id())->get()->count()
        ]);
    }
}
