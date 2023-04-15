<?php

namespace App\Relatorios;

use App\Models\SisUsuario;

class SisUsuarioListagem extends RelatorioBase
{

    /**
     * Título do relatório.
     *
     * @var string
     */
    protected $titulo = 'Lista de Usuarios';

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
    protected $view = 'sis_usuario.imprimir';

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
        $dados = SisUsuario::orderBy('id', 'ASC');

        if (!empty($filtros["id"])) {
            $dados->where("id", "=", $filtros["id"] );
        }
        if (!empty($filtros["nome"])) {
            $dados->where("nome", "LIKE", "%" . $filtros["nome"] . "%");
        }
        if (!empty($filtros["cpf"])) {
            $dados->where("cpf", "LIKE", "%" . $filtros["cpf"] . "%");
        }
        if (!empty($filtros["email"])) {
            $dados->where("email", "LIKE", "%" . $filtros["email"] . "%");
        }
        if (!empty($filtros["telefone"])) {
            $dados->where("telefone", "LIKE", "%" . $filtros["telefone"] . "%");
        }
        if (!empty($filtros["id_tipo_usuario"])) {
            $dados->where("id_tipo_usuario", "=", $filtros["id_tipo_usuario"] );
        }
        if (!empty($filtros["api_token"])) {
            $dados->where("api_token", "LIKE", "%" . $filtros["api_token"] . "%");
        }

        if ($paginar) {
            return $dados->paginate($this->porPagina);
        }

        return $dados->get();
    }
}