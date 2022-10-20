<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Session;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
     public function showLoginForm()
    {
        if (Session()->get('status_login') == true) {
        return redirect('home');
        } 
        return view('auth.login');
    }
     function login(Request $request)
    {
        $this->validateLogin($request);
     
        $this->API="http://192.168.3.90/ecaimut_service_hris/api/applyform/login_sso";

        $formdata_olibs = array(
            'passwrd' => $request->password,
            'nama_login' => $request->username,
        );
        $username = $request->username;
        $password = $request->password;
        $json_olibs = json_encode($formdata_olibs);
        // $http_olibs = http_build_query($formdata_olibs);


        $ch_olibs = curl_init();
        curl_setopt($ch_olibs, CURLOPT_URL, $this->API);
        curl_setopt($ch_olibs, CURLOPT_POST, 'POST');
        curl_setopt($ch_olibs, CURLOPT_POSTFIELDS, $json_olibs);
        curl_setopt($ch_olibs, CURLOPT_ENCODING, '');
        curl_setopt($ch_olibs, CURLOPT_MAXREDIRS,10);        
        curl_setopt($ch_olibs, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch_olibs, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch_olibs, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
        curl_setopt($ch_olibs, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch_olibs, CURLOPT_USERPWD, $username.':'.$password);
        curl_setopt($ch_olibs, CURLOPT_HTTPHEADER, array(
            'Auth-Key: Dp6_@auth_K3Y_wK2WK',
            'Content-type: application/json',
            'Accept: application/json',
            "Cookie: laravel_session={$_COOKIE['laravel_session']}",
        ));

        $res_olibs = curl_exec($ch_olibs);
        curl_close($ch_olibs);
        $res = json_decode($res_olibs);        
        // var_dump($res);
        // // echo '<br><br>'. $res->data[0];
        if ($res->rcode == "00") {
            $request->session()->regenerate();
            Session::put('user', $res);            
            Session::put('status_login', true);            
            return redirect()->to('/');
        }
        Session::put('status_login', false);            
        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

}
