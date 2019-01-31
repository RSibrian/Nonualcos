<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Instituciones extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //
    protected $table = 'instituciones';
    protected $fillable = ['nombreInstitucion','direccionInstitucion','telefonoInstitucion' ];
}
