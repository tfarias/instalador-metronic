<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use LaravelMetronic\Models\TipoRota;
use LaravelMetronic\Models\Rota;

class RotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = \Illuminate\Support\Facades\File::get(base_path('database/seeders/data/permissoes.json'));
        $permissoes = json_decode($json, true);
        \Illuminate\Support\Facades\Cache::forget('rotas');

        foreach ($permissoes as $permissao)
        {
            $tipo = TipoRota::where('descricao', $permissao['tipo'])->first();
            if (!$tipo)
            {
                dd('O tipo da rota (' . $permissao['tipo'] . ') não existe no banco.');
            }

            $permissao['id_tipo_rota'] = $tipo->id;
            unset($permissao['tipo']);
            $achou = Rota::where('slug', $permissao['slug'])->first();
            if (!$achou)
            {
                Rota::create($permissao);
            } else
            {
                $achou->update($permissao);
            }
        }
    }
}
