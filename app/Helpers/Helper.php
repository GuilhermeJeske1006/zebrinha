<?php

namespace App\Helpers;
use GuzzleHttp\Client;

class Helper
{

  

    // Helper para converter qualquer string em somente números
  public static function somente_numeros(String $telefone)
  {
    return preg_replace("/[^0-9]/", "", $telefone);
  }

  public static function  format_cpf($value) {
    $cpf = preg_replace('/[^0-9]/', '', $value);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
    $cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    return $cpf;
}



    
    public static function format_val($val, $decimals = 2)
    {
      $val = number_format($val, $decimals, ',', '.');
      return $val;
    }

    
  }
  