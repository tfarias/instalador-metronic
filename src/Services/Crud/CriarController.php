<?php

namespace Tfarias\InstaladorTfarias\Services\Crud;

use File;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Route;

class CriarController
{

    protected $template = __DIR__.'/CreateCrud/controller.txt';
    protected $modelo_web = __DIR__.'/CreateCrud/web.txt';
    protected $modelo_menu = __DIR__.'/CreateCrud/menu.txt';
    protected $web = 'routes/web.php';
    protected $menu = 'resources/views/partials/metronic/menu.blade.php';
    protected $templateRotas = __DIR__.'/CreateCrud/rotas.json';
    protected $web_modelo = __DIR__.'/CreateCrud/web_modelo.txt';

    /**
     * Cria o model do CRUD.
     *
     * @param string $tabela
     * @param string $titulo
     * @param string $routeAs
     */
    public function criar($tabela, $titulo, $routeAs, $titulo_rota)
    {
        $this->schema = new Schema($tabela);
        // Nome da classe em CamelCase
        $classe = ucfirst(Str::camel($tabela));

        $controller = File::get($this->template);
        $controller = str_replace('[{tabela}]', $tabela, $controller);
        $controller = str_replace('[{var}]', $tabela, $controller);
        $controller = str_replace('[{tabela_model}]', $classe, $controller);
        $controller = str_replace('[{titulo}]', $titulo, $controller);
        $controller = str_replace('[{namespace}]', Container::getInstance()->getNamespace(), $controller);
        File::put(base_path('app/Http/Controllers/' . $classe . 'Controller.php'), $controller);


        $this->atualizarRotas($routeAs, $classe);
        $this->atualizarMenu($titulo, $routeAs);
        $this->atualizarJsonRotas($titulo, $routeAs, $titulo_rota);
    }

    /**
     * Atualiza o arquivo web.php com as novas ações.
     *
     * @param $titulo
     * @param $routeAs
     */
    public function atualizarRotas($routeAs, $classe)
    {
        if (!Route::has($routeAs . '.index')) {
            $web_modelo = File::get($this->web_modelo);
            
            $web_atual = File::get(base_path('routes/web.php'));
            if ((strpos($web_atual, '//[rota]') === false)) {
                File::put(base_path('routes/web.php'), $web_modelo);
            }

            $web = File::get(base_path($this->web));
            $modelo = File::get($this->modelo_web);
            $modelo = str_replace('[{prefix}]', $routeAs, $modelo);
            $modelo = str_replace('[{classe}]', $classe, $modelo);
            $web = str_replace('//[rota]', $modelo, $web);
            File::put(base_path('routes/web.php'), $web);
        }
    }
    /**
     * Atualiza o arquivo menu.blade.php com as novas ações.
     *
     * @param $titulo
     * @param $routeAs
     */
    public function atualizarMenu($titulo, $routeAs)
    {
        if (!Route::has($routeAs . '.index')) {
            $menu = File::get(base_path($this->menu));
            $modelo = File::get($this->modelo_menu);
            $modelo = str_replace('[{route_as}]', $routeAs, $modelo);
            $modelo = str_replace('[{titulo}]', $titulo, $modelo);
            $web = str_replace('{{--menu--}}', $modelo, $menu);
            File::put(resource_path('views/partials/metronic/menu.blade.php'), $web);
        }
    }

    public function atualizarJsonRotas($titulo, $routeAs, $titulo_rota)
    {
        if (!Route::has($routeAs . '.index')) {
            $json = \Illuminate\Support\Facades\File::get(base_path('database/seeders/data/permissoes.json'));
            $rotas = json_decode($json, true);
            $modelo = File::get($this->templateRotas);
            $modelo = str_replace('[{titulo_rota}]', $titulo_rota, $modelo);
            $modelo = str_replace('[{titulo}]', $titulo, $modelo);
            $modelo = str_replace('[{route_as}]', $routeAs, $modelo);
            $modelo = json_decode($modelo);
            $rotas = array_merge($rotas, $modelo);
            File::put(base_path('database/seeders/data/permissoes.json'), json_encode($rotas, JSON_UNESCAPED_UNICODE));
        }

        Artisan::call('db:seed --class=TipoRotaSeeder');
        Artisan::call('db:seed --class=RotaSeeder');
    }

}
