<?php

namespace LaravelMetronic\Events;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Cache;

class UsuarioEventHandler
{

    /**
     * Quando o usuário realizar login no sistema.
     *
     * @param Login $evento
     */
    public function onLogin($evento)
    {
        // Logo na tela de login, já vamos verificar se o usuário é super admin
        // assim diminuimos o número de queries por página e melhoramos o sistema.
        $usuario = $evento->user;
       
        $superAdmin = $usuario->super_admin;
        session(['super_admin' => $superAdmin]);

    }

    /**
     * Quando o usuário realizar logout no sistema.
     *
     * @param Logout $evento
     */
    public function onLogout($evento)
    {
        Cache::forget('rotas');
        session()->forget('super_admin');
    }

}