<?php

namespace Tfarias\InstaladorTfarias\Helpers;

class THelper
{
  public static function has_permission($rotas){
    foreach ($rotas as $rota)
    {
        if (\Illuminate\Support\Facades\Gate::check($rota))
        {
            return true;
        }
    }

    return false;
  }
}