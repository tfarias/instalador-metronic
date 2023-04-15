<?php
namespace Tfarias\InstaladorTfarias;

use Illuminate\Support\ServiceProvider;
use Tfarias\InstaladorTfarias\Commands\CreateCrud;
use Tfarias\InstaladorTfarias\Commands\CreateModel;
use Tfarias\InstaladorTfarias\Commands\NameApp;


class TfariasInstaladorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/publishes' => base_path('/')
        ]);

    }
    public function register()
    {
        $this->commands([
            CreateCrud::class,
            CreateModel::class,
            NameApp::class
        ]);
    }
}
