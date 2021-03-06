<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotiMenuController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function read(Request $req){
    if($req->filled('nid')){

      $nitody = $req->user()->notifications->where('id', $req->nid)->first();
      if($nitody){
        $nitody->markAsRead();
        return redirect($this->getUrl($nitody));
      }

      // notification not found. most likely not belong to current user
      return redirect(route('staff'));

    } else {
      // no type. just redirect to home page
      return redirect(route('staff'));
    }
  }

  private function getUrl($notifyobject){

    $data = $notifyobject->data;
    if($data['param'] == ''){
      $param = [];
    } else {
      $param = [$data['param'] => $data['id']];
    }
    return route($data['route_name'], $param);
  }
}
