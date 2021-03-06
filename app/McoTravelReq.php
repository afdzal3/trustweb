<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class McoTravelReq extends Model
{
  public function requestor(){
    return $this->belongsTo(User::class, 'requestor_id');
  }

  public function approver(){
    return $this->belongsTo(User::class, 'approver_id');
  }
}
