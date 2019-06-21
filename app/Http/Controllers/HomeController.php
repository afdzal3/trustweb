<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    function playground(){
      return version('v1')->route('api.home', [], false);
    }

    function welcome(){
      return view('welcome');
    }

    public function listAdmins(){
      $adminlist = User::where('role', '<=', 2)->get();
      return view('adminlist', ['admins' => $adminlist]);
    }

    public function postreg(Request $req){
      return view('auth.verify', ['id' => $req->id]);
    }

    public function resend(Request $req){
      $user = User::findOrFail($req->id);
      \Mail::to($user->email)->send(new VerifyMail($user));
      return view('auth.verify', ['id' => $req->id, 'resend' => true]);
    }
}
