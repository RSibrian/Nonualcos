<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitacoraUsuario extends Model
{
    //
    public function user()
    {
      $this->belongTo(User::class);
    }
}
