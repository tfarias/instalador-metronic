<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\AuxTipoUsuario;
use App\Models\Rota;

class TipoUsuarioController extends Controller
{

    private $listagem;

    /**
     * Exibe a tela para gerenciar as permissões de todos os grupos de acesso do sistema.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gerenciarPermissoes()
    {
        $grupos = AuxTipoUsuario::with('rotas')
            ->where('super_admin', 'N')
            ->orderBy('descricao', 'ASC')
            ->get();

        $rotas = Rota::with('Tipo_rota')->where('acesso_liberado', 'N')->where('desenv', 'N')->get();
        $rotas = $rotas->groupBy('Tipo_rota.descricao')->sortBy(function ($items, $key) {
            return $key;
        });

        return view('tipo_usuario.gerenciar_permissoes', compact('grupos', 'rotas'));
    }

    /**
     * Salva as permissões gerenciadas para cada tipo.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvarPermissoes()
    {
        $grupo = AuxTipoUsuario::find(request('id_tipo_usuario'));
        $rotas = request('rotas');
        $grupo->rotas()->sync($rotas);
        Cache::forget('rotas');

        // Nao estou tratando erros, eu sei
        return response()->json(true);
    }

    /**
     * Carrega as permissoes de um tipo de usuario.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function carregarPermissoes()
    {
        $id = request('id');
        $grupo = AuxTipoUsuario::with('rotas')->find($id);
        return response()->json($grupo->rotas);
    }


}
