<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
/*   public function tipoUsuatios()
    {
        return $this->hasMany(TipoUsuario::class);
    }*/
    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'idEmpleado');
    }

    public function bitacoraUsuario()
    {
      return $this->hasMany(BitacoraUsuario::class);
    }
}
