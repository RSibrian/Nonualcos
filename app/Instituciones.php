<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituciones extends Model
{
    //
    protected $table = 'instituciones';
    protected $fillable = ['nombreInstitucion','direccionInstitucion','telefonoInstitucion' ];
}
