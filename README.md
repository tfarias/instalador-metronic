## Instalador de codigos laravel Baseado no template Metronic

## Método de utilização

- Para utilizar o repository deve adicionar no composer.json o repository

- exempo

````bash
  "require-dev": {
      "tfarias/instalador-tfarias": "dev-master"
   }
   
  "repositories": [
        {
            "url": "https://tfariasg3@bitbucket.org/tfarias-ses/instalador-ses.git",
            "type": "git"
        }
    ]
````
-  E executar o comando
````bash
composer update --prefer-source
````

## \* Para o funcionamento correto execute o comando abaixo

```bash
 $ php artisan vendor:publish --force
```

- escolhe o repositorio e depois

```bash
 $ php artisan name:app LaravelMetronic
```
  ###* Caso o mesmo apresente erro pode executar o comando esses comandos abaixo
```bash
   $ php artisan name:app App
   $ php artisan name:app LaravelMetronic
```

 ### Ajustes obrigatórios
- editar o arquivo app/Providers/RouteServiceProvider.php
  - antes
    ```
        protected $namespace = 'App\Http\Controllers';
    ```
  - depois
    ```
        protected $namespace = 'LaravelMetronic\\Http\\Controllers';
    ```
    
-  adicionar no app/Http/Kernel.php
   dentro dos $routeMiddleware

    ```
    'has-permission' => HasPermission::class,
    ```
- e no arquivo config/app.php adicionar o provider
    
    ```
     LaravelMetronic\Providers\RepositoryServiceProvider::class,
    ```

- No arquivo config/filesystems.php editar o trexo 
- de
    ```
    'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
    ```
- para 
  ```
    'local' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
        ],
  ```
  
- E executar o comando (para funcionamento correto do filesystem): 
  ```
  $ php artisan storage:link
  ```
  
- altera o model de usuario no arquivo config/auth.php

```bash
'model' => LaravelMetronic\Models\SisUsuario::class,
```
 - e por fim
```bash
   $ php artisan migrate --seed
```


## \*atenção

para executar os comando primeiro você deve fazer e rodar suas migrations
após isso:

$ php artisan create-metronic

apos o publish essas chaves serão encontradas no projeto.

## Filtros

```bash
#
 Para os campos que deseja ter os filtros basta adicionar um comment na migration

exemplo

   Schema::create('tipo', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('descricao')->comment('filter');
            $table->timestamps();
      });

      na migration acima a coluna descricao vai constar nos filtros
```


# \* Elas não devem ser removidas.

```bash
# routes/web.php
//[rota]

# resouces/views/partials/metronic/menu.blade.php
{{--menu--}}

# app/Providers/RepositoryServiceProvider.php
#  //[uses]

# //[repository]

```
