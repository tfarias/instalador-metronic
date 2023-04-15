<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use App\Models\Rota;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        // Aqui definimos o que cada grupo pode fazer dependendo das permissões de cada um
        if (!app()->runningInConsole()) {
            $rotas = $this->buscarRotas();
            foreach ($rotas as $rota) {

                Gate::define($rota->slug, function ($usuario) use ($rota) {
                    // Se algum dos grupos de acesso do usuário contem um grupo que é super admin
                    // liberamos a rota para ele sem perguntar mais nada
                    $superAdmin = session()->has('super_admin') ? session('super_admin') : $usuario->super_admin;

                    if ($superAdmin) {
                        return true;
                    }

                    if ($rota->acesso_liberado == "S") {
                        return true;
                    }

                    // Caso contrário, iremos verificar se em algum grupo a rota está definida como permitida
                    // Se tiver pelo menos um grupo dizendo que é permitida, este ganha.
                    return $usuario->temPermissao($rota);
                });
            }
        }
    }

    /**
     * Retorna todas as rotas do site.
     *
     * @return Collection
     */
    private function buscarRotas()
    {
        return Cache::rememberForever('rotas', function () {
            return Rota::with('grupos')->get();
        });
    }
}
