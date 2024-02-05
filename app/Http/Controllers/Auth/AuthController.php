<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;


class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    /*public function create_default()
    {
        $i = User::Create([
            'username'=>'Admin',
            'password'=>'Admin'
        ]);
        return json_encode($i);
    }*/

    public function login(Request $request)
    {
        $request->validate([
            'username'=> 'required',
            'password'=>'required'
        ]);
        $data = $request->only('username','password');
        if(Auth::attempt($data))
        {
            toastr()->success('Login success!');
            return redirect(route('dashboard.index'));
        }
        return redirect(route('auth.index'));
        
    }

    public function logout(Request $request) : RedirectResponse {

        Session::flush();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('auth.login'));
    }
}
