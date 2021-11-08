<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\XScanHosts;
use App\Models\XScanPort;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDO;
use PDOException;

class XScanPortsController extends Controller
{
    public function create_port_scan(Request $request)
    {
        if(XScanHosts::where("id", $request->host_id)->get(["dsactive"])->first()->dsactive)
        {
            return response()->json([
                "status" => "error",
                "message" => "Esse host está inativo. Não pode ser mais escaneado!"
            ]);
        }

        if(in_array('', $request->only("scann_name", "ports", "description", "type_scan")))
        {
            return response()->json([
                "status" => "error",
                "message" => "Erro ao tentar criar um Scan, por favor, verifique se todos campos foram preenchidos corretamente!"
            ]);
        }

        try{
            XScanPort::create([
                "id" => Str::uuid(),
                "id_host" => $request->host_id,
                "id_user" => auth()->id(),
                "host" => $request->host_target,
                "name" => $request->scann_name,
                "ports" => $request->ports,
                "descrition" => $request->description,
                "temp_history" => intval($request->history),
                "type_scan" => $request->type_scan,
                "lastscan" => date('Y-m-d H:i:s')
            ]);
            return response()->json([
                "message" => "Scan criado com sucesso!"
            ]);
        } catch (\PDOException $error){
            return response()->json([
                "status" => "error",
                "message" => $error->getMessage()
            ]);
        }

    }

    public function get_one_port(Request $request)
    {
        $port = XScanPort::where("id", $request->idport)->get(["id", "name", "host", "descrition", "lastscan", "is_scan", "ports", "temp_history", "type_scan"])->first();
        return response()->json($port);
    }

    public function delete_port_scan(Request $request)
    {
        try {
            if (!XScanPort::where("id", $request->idport)->where("id_user", auth()->id())->get(["is_scan"])->first()->is_scan)
            {
                return response()->json([
                    "status" => "error",
                    "message" => "O Scan não pode ser excluido devido estar pendente a execução!"
                ]);
            }

            if (XScanPort::where("id", $request->idport)->where("id_user", auth()->id())->delete())
            {
                return response()->json([
                    "message" => "Scan excluido com sucesso!"
                ]);
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "Não foi possível excluir o Scan no momento!"
                ]);
            }
        } catch (Exception $error) {
            return response()->json([
                "status" => "error",
                "message" => $error->getMessage()
            ]);
        }
    }
}
