<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\XScanHosts;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class XScanHostsController extends Controller
{
    public function get_hosts(Request $request)
    {
        $hosts = XScanHosts::where("id_user", auth()->id())->orderByDesc('created_at')->get(["id","dshost", "dsname"]);
        return response()->json($hosts);
    }

    public function get_one_host(Request $request)
    {
        $host = XScanHosts::where("id", $request->idhost)->get(["id","dsactive", "dsname", "dshost", "created_at"])->first();
        return response()->json($host);
    }

    public function inactive_host(Request $request)
    {
        if (!XScanHosts::where("id", $request->idhost)->where("id_user", auth()->id())->get(["dsactive"])->first()->dsactive) {
            if (XScanHosts::where("id", $request->idhost)->where("id_user", auth()->id())->update(["dsactive" => 1]))
            {
                return response()->json([
                    "message" => "Máquina desativada com sucesso!"
                ]);
            } else
            {
                return response()->json([
                    "status" => "error",
                    "message" => "A máquina não pode ser desativada!",
                ]);
            }
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Essa máquina já está inativa!",
            ]);
        }

    }

    public function create_host(Request $request)
    {
        if(in_array('', $request->only("hname", "hhost")))
        {
            return response()->json([
                "status" => "error",
                "message" => "Erro ao tentar criar o Host, por favor, verifique se todos campos foram preenchidos corretamente!"
            ]);
        }

        try {
            XScanHosts::create([
                "id" => Str::uuid(),
                "dshost" => $request->hhost,
                "dsname" => $request->hname,
                "id_user" => auth()->id()
            ]);
            return response()->json([
                "message" => "Máquina criado com sucesso!"
            ]);
        } catch (\PDOException $error)
        {
            return response()->json([
                "status" => "error",
                "message" => $error->getMessage()
            ]);
        }
    }


    public function delete_host(Request $request)
    {
        if (XScanHosts::where("id", $request->idhost)->where("id_user", auth()->id())->get(["dsactive"])->first()->dsactive)
        {
            if (XScanHosts::where("id", $request->idhost)->where("id_user", auth()->id())->delete())
            {
                return response()->json([
                    "message" => "Máquina excluida com sucesso!"
                ]);
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "A máquina não pode ser excluida no momento!"
                ]);
            }
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Máquina não pode ser excluida devido estar ativa no momento. Desative e tente novamente!"
            ]);
        }
    }
}
