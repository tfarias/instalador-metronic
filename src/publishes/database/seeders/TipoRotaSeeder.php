<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use LaravelMetronic\Models\TipoRota;

class TipoRotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            'Dashboard',
            'Auxiliares',
            'Cadastros',
            'Permissoes',
            'Usuário',
            'Tipo de usuário',
            'Sistema'
        ];

        foreach ($tipos as $descricao)
        {
            $dados = ['descricao' => $descricao,'icone'=>'icone'];
            $achou = TipoRota::where('descricao', $descricao)->first();
            if (!$achou)
            {
                TipoRota::create($dados);
            } else
            {
                $achou->update($dados);
            }
        }
    }
}
