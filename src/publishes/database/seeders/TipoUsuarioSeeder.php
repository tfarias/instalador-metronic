<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use LaravelMetronic\Models\AuxTipoUsuario;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
                'id'          => '1',
                'descricao'   => 'Desenvolvedor',
                'super_admin' => 'S',
            ],
            [
                'id'          => '2',
                'descricao'   => 'Suporte',
                'super_admin' => 'N',
            ],

        ];

        foreach ($tipos as $dados)
        {
            $tipo = AuxTipoUsuario::find($dados['id']);
            if (!$tipo)
            {
                AuxTipoUsuario::create($dados);
            } else
            {
                $tipo->update($dados);
            }
        }
    }
}
