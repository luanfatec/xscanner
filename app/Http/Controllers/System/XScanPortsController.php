<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\XScanPort;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class XScanPortsController extends Controller
{
    public function portspage()
    {
        $ports = XScanPort::where("id_user", auth()->id())->select(["host", "id", "name"])->orderByDesc('lastscan')->paginate(11);
        return view('System.ports.index')->with([
            "title" => "Ports",
            "ports" => $ports
        ]);
    }
}
