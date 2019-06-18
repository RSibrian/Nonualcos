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
    public static function kilometraje($value)
    {
        return number_format($value, 0, '.', ',');
    }
  public static function humanReadableSize(int $sizeInBytes): string
  {
      $units = ['B', 'KB', 'MB', 'GB', 'TB'];

      if ($sizeInBytes === 0) {
          return '0 '.$units[1];
      }
      for ($i = 0; $sizeInBytes > 1024; ++$i) {
          $sizeInBytes /= 1024;
      }

      return round($sizeInBytes, 2).' '.$units[$i];
  }
  public static function getDate($date_modify)
    {
        return Carbon::createFromTimeStamp($date_modify)->formatLocalized('%d-%m-%Y %H:%M');
    }
}
