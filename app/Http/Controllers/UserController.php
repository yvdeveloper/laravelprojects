<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }
    public function verify_user()
    {
        return redirect(route('dashboard.index'));
    }
}
