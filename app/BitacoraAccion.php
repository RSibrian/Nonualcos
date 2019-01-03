<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
class BitacoraAccion extends Model
{
  protected $table = 'bitacora_accions';
  protected $fillable = ['accion','registroAntes','registroDespues','idUser'  ];

  public static function crearBitacora($accion,$antes,$despues){
          BitacoraAccion::create([
            'accion'=>$accion,
            'registroAntes'=>$antes,
            'registroDespues'=>$despues,
            'idUser'=>Auth::user()->id,
        ]);
      }
      public function usuario()
      {
          return $this->belongsTo(User::class,'idUser');
      }
}
