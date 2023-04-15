<?php

namespace App\Relatorios;

use App\Models\AuxTipoUsuario;

class AuxTipoUsuarioListagem extends RelatorioBase
{

    /**
     * Título do relatório.
     *
     * @var string
     */
    protected $titulo = 'Lista de Tipo de Usuarios';

    /**
     * Quantidade de itens por página.
     *
     * @var int
     */
    protected $porPagina = 10;

    /**
     * A view utilizada para impressão deste relatório.
     *
     * @var string
     */
    protected $view = 'aux_tipo_usuario.imprimir';

    public function exportar($filtros){
        $this->setTitulo($this->titulo);
        $dados = $this->gerar($filtros, false);
        $this->setDados($dados);
        $this->setView($this->view);
        $this->setPorPagina($this->porPagina);
        $this->setRelformato($filtros['relformato']);
        $this->setFiltros($filtros);
        return $this->gerar_relatorio();
    }
    /**
     * Gera os dados.
     *
     * @param array $filtros
     * @param bool $paginar
     *
     * @return mixed
     */
    public function gerar($filtros, $paginar = true)
    {
        $dados = AuxTipoUsuario::orderBy('descricao', 'ASC');

        if (!empty($filtros["id"])) {
            $dados->where("id", "=", $filtros["id"]);
        }
        if (!empty($filtros["descricao"])) {
            $dados->where("descricao", "LIKE", "%" . $filtros["descricao"] . "%");
        }

        if ($paginar) {
            return $dados->paginate($this->porPagina);
        }

        return $dados->get();
    }
}