<?php

namespace App\Models\Traits;

trait Mask
{
    public static function remove($valor, $outros = null)
    {
        $remover = [
            '.', ',', '/', '-', '(', ')', '[', ']', ' ', '+', '_',
        ];

        if (!is_null($outros)) {
            if (!is_array($outros)) {
                $outros = [$outros];
            }

            $remover = array_merge($remover, $outros);
        }

        return str_replace($remover, '', $valor);
    }
}

