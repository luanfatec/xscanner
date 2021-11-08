<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class XScanProfileController extends Controller
{
    public function profilepage()
    {
        return view('System.profile.index')->with([
            "title" => "Profile"
        ]);
    }
}
