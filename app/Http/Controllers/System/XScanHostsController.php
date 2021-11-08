<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\XScanHosts;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class XScanHostsController extends Controller
{

    public function hostspage()
    {
        $hosts = XScanHosts::where("id_user", auth()->id())->select(["id","dshost", "dsname"])->orderByDesc('created_at')->paginate(11);
        return view('System.hosts.index')->with([
            "title" => "Hosts",
            "hosts" => $hosts
        ]);
    }
}
