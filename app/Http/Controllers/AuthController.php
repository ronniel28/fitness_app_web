<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Helpers\Helper;

class AuthController extends Controller
{
    public function __construct() 
    {
        $this->helper = new Helper();
    }

    public function apiRegister(Request $request)
    {
        return dd($request);

    }


    public function apiLogin(Request $request)
    {
        $authenticate = $this->helper->FitnessAppApiCall('post', 'login', [
            'email' => $request->email ,
            'password' => $request->password
        ]);

        if($authenticate['success'])
        {
            $request->session()->put('userToken',$authenticate['data']['token']);
            $request->session()->put('authenticated',true);

            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login');
        }
       
        // return json_encode($authenticate);
    }

    public function login()
    {
        return view('auth.login');
    }
       
    public function register()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        $authenticate = $this->helper->FitnessAppApiCall('post', 'logout', [], true);
        $request->session()->forget('authenticated');
        $request->session()->forget('userToken');
        return redirect()->route('dashboard');
    }
}
