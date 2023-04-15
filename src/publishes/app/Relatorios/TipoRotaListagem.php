<?php

namespace App\Relatorios;

use App\Models\TipoRota;

class TipoRotaListagem extends RelatorioBase
{

    /**
     * Título do relatório.
     *
     * @var string
     */
    protected $titulo = 'Lista de Tipo de Rota';

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
    protected $view = 'tipo_rota.imprimir';

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
        $dados = TipoRota::orderBy('id', 'ASC');

        if (!empty($filtros["id"])) { $dados->where("id", "LIKE", "%" . $filtros["id"] . "%"); }if (!empty($filtros["descricao"])) { $dados->where("descricao", "LIKE", "%" . $filtros["descricao"] . "%"); }if (!empty($filtros["icone"])) { $dados->where("icone", "LIKE", "%" . $filtros["icone"] . "%"); }if (!empty($filtros["created_at"])) { $dados->where("created_at", "LIKE", "%" . $filtros["created_at"] . "%"); }if (!empty($filtros["modified_at"])) { $dados->where("modified_at", "LIKE", "%" . $filtros["modified_at"] . "%"); }if (!empty($filtros["deleted_at"])) { $dados->where("deleted_at", "LIKE", "%" . $filtros["deleted_at"] . "%"); }

        if ($paginar) {
            return $dados->paginate($this->porPagina);
        }

        return $dados->get();
    }
}