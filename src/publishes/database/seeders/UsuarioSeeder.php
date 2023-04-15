<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use LaravelMetronic\Models\SisUsuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            'nome'                 => 'Administrador',
            'password'             => '123',
            'email'                => 'tfariasg3@gmail.com',
            'telefone'             => '67999859197',
            'id_tipo_usuario' => '1'
        ];

        $usuario = SisUsuario::where('email', $dados['email'])->first();
        if (!$usuario)
        {
            SisUsuario::create($dados);
        } else
        {
            $usuario->update($dados);
        }
    }
}
