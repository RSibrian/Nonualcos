<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper
{
  //regresa una fecha en formato d/m/Y
  public static function fecha($date)
  {
    return Carbon::parse($date)->format('d/m/Y');
  }
  public static function cadena($value)
  {
    $value=mb_convert_encoding(mb_convert_case($value, MB_CASE_TITLE), "UTF-8");
    return ucwords(strtolower($value));
  }

  public static function dinero($value)
  {
    return number_format($value, 2, '.', ',');
  }
}
