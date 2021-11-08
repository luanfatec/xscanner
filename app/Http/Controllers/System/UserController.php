<?php

namespace App\Http\Controllers\System;

use App\Helpers\MessagesContol;
use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\JWTGuard;

class UserController extends Controller
{
    public function login()
    {
        if (Auth::check())
        {
            return redirect()->route('system.home');
        }

        return view('System.login.index')->with([ "title" => "Login" ]);
    }

    public function auther(Request $request)
    {

        if (in_array('', $request->only('email', 'password')))
        {
            return redirect()->back()->with([
                "message" => "Erro ao tentar realizar login, verifique os campos e tente novamente."
            ]);
        }

        $credential = array( "email" => $request->email, "password" => $request->password );

        if(!filter_var($credential["email"], FILTER_VALIDATE_EMAIL))
        {
            return redirect()->back()->with([
                "message" => "E-mail não é válido."
            ]);
        }

        // Login API
        if (Auth::attempt($credential))
        {
            $client = new Client();

            $res = $client->request('POST', route('api.login'), [
                'form_params' => [
                    'email' => $request->email,
                    'password' => $request->password,
                ]
            ]);


            if ($res->getStatusCode() == 200) { // 200 OK
                $response_data = $res->getBody()->getContents();
                setcookie("jwt_token", base64_encode($response_data));
                return redirect()->route('system.home');
            } else {
                Auth::logout();
                $request->session()->regenerate();
                setcookie("jwt_token",false);
                return redirect()->route('system.login.page');
            }

        } else {
            return redirect()->route('system.login.page');
        }
    }

    public function save_user(Request $request)
    {
        if ($request->action == "update")
        {
            if (in_array('', $request->only('email', 'password', 'name')))
            {
                return redirect()->back()->with([
                    "message" => "Erro ao tentar realizar a atualização do seu cadastro, verifique os campos e tente novamente."
                ]);
            }

            $credential = array( "email" => $request->email, "password" => bcrypt($request->password), "name" => $request->name);

            if(!filter_var($credential["email"], FILTER_VALIDATE_EMAIL))
            {
                return redirect()->back()->with([
                    "message" => "E-mail não é válido."
                ]);
            }

            if (User::where('id', auth()->id())->update($credential))
            {
                return redirect()->back()->with([
                    "message" => "Dados atualizados com sucesso!"
                ]);
            } else {
                return redirect()->back()->with([
                    "message" => "Dados não atualizados!"
                ]);
            }

        } elseif ($request->action == "delete") {
            if (User::where('id',  auth()->id())->delete())
            {
                Auth::logout();
                $request->session()->regenerate();
                setcookie("jwt_token",false);
                return redirect()->route('system.login.page');
            }
        } else {
            return redirect()->back()->with([
                "message" => "Não foi possível realziar essa operação no momento!"
            ]);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        setcookie("jwt_token",false);
        return redirect()->route('system.login.page');
    }
}
