<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\RotaRepository;
use App\Repositories\RotaRepositoryEloquent;
use App\Repositories\SisUsuarioRepository;
use App\Repositories\SisUsuarioRepositoryEloquent;
use App\Repositories\AuxTipoUsuarioRepository;
use App\Repositories\AuxTipoUsuarioRepositoryEloquent;
use App\Repositories\TipoRotaRepository;
use App\Repositories\TipoRotaRepositoryEloquent;

//[uses]

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TipoRotaRepository::class, TipoRotaRepositoryEloquent::class);
        $this->app->bind(RotaRepository::class, RotaRepositoryEloquent::class);
        $this->app->bind(SisUsuarioRepository::class, SisUsuarioRepositoryEloquent::class);
        $this->app->bind(AuxTipoUsuarioRepository::class, AuxTipoUsuarioRepositoryEloquent::class);
        //[repository]
    }
}
