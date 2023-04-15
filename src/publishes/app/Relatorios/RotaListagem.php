<?php

namespace App\Relatorios;

use App\Models\Rota;

class RotaListagem extends RelatorioBase
{

    /**
     * Título do relatório.
     *
     * @var string
     */
    protected $titulo = 'Lista de Rotas';

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
    protected $view = 'rota.imprimir';

    /**
     * Gera os dados.
     *
     * @param array $filtros
     * @param bool $paginar
     *
     * @return mixed
     */
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

    public function gerar($filtros, $paginar = true)
    {
        $dados = Rota::orderBy('id', 'ASC');

        if (!empty($filtros["id"])) { $dados->where("id", "LIKE", "%" . $filtros["id"] . "%"); }if (!empty($filtros["id_tipo_rota"])) { $dados->where("id_tipo_rota", "LIKE", "%" . $filtros["id_tipo_rota"] . "%"); }if (!empty($filtros["descricao"])) { $dados->where("descricao", "LIKE", "%" . $filtros["descricao"] . "%"); }if (!empty($filtros["slug"])) { $dados->where("slug", "LIKE", "%" . $filtros["slug"] . "%"); }if (!empty($filtros["created_at"])) { $dados->where("created_at", "LIKE", "%" . $filtros["created_at"] . "%"); }if (!empty($filtros["updated_at"])) { $dados->where("updated_at", "LIKE", "%" . $filtros["updated_at"] . "%"); }if (!empty($filtros["deleted_at"])) { $dados->where("deleted_at", "LIKE", "%" . $filtros["deleted_at"] . "%"); }

        if ($paginar) {
            return $dados->paginate($this->porPagina);
        }

        return $dados->get();
    }
}