<?php

namespace App\Api\V1\Controllers\Tribe;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
   public function getDetail(Request $req){
      return $req->user();
    }

    public function validateToken(Request $req){    
      $user = $req->user();
      //$token = $user->createToken('tribe')->accessToken;
      // $token = $user->createToken('trUSt')->accessToken;
      // $token = $user->tokens();
      //$token = Auth::user()->token();
     
       return $req;
    }



}
