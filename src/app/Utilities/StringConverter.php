<?php

namespace App\Utilities;

class StringConverter
{
  public static function camelToSnake($input)
  {
    if (!ctype_lower($input)) {
      $input = preg_replace('/(.)(?=[A-Z])/u', '$1_', $input);
      $input = strtolower($input);
    }
    return $input;
  }
}
