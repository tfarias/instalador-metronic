<?php

namespace App\Relatorios;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use \PDF;
use Response;

class RelatorioBase
{

    private $view;
    private $titulo;
    private $porPagina;
    private $dados;
    private $relformato;
    private $filtros;

    /**
     * @param mixed $filtros
     */
    public function setFiltros($filtros)
    {
        $this->filtros = $filtros;
    }

    /**
     * @param mixed $relformato
     */
    public function setRelformato($relformato)
    {
        $this->relformato = $relformato;
    }

    /**
     * @param mixed $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @param mixed $porPagina
     */
    public function setPorPagina($porPagina)
    {
        $this->porPagina = $porPagina;
    }

    /**
     * @param mixed $dados
     */
    public function setDados($dados)
    {
        $this->dados = $dados;
    }


    /**
     * Exporta o relatório.
     *
     * @param $filtros
     *
     * @return mixed
     */
    public function gerar_relatorio($dados = null)
    {
        $dados = !empty($dados) ? $dados : $this->dados;
        $tipo = $this->relformato;
        $filtros = $this->filtros;
        $filtrosTexto = $this->aplicaFiltrosTexto($filtros);

        $conteudo = view($this->view)
            ->with('filtros', $filtros)
            ->with('filtrosTexto', $filtrosTexto)
            ->with('dados', $dados)
            ->with('titulo', $this->titulo)
            ->with('tipo', $tipo);

        $nomeArquivo = $this->gerarNomeArquivo();

        switch ($tipo) {
            case 'xls':
                $response = Response::make($conteudo, 200);
                $response->header('Content-Type', 'application/msexcel');
                $response->header('Content-disposition', "attachment; filename=$nomeArquivo.xls");
                break;
            case 'html':
                $response = $conteudo;
                break;
            case 'pdf':
                  $mpdf = new \Mpdf\Mpdf([
                    '',
                    'A4',
                    '',
                    '',
                    15,
                    15,
                    30,
                    15,
                ]);
                $mpdf->simpleTables = true;
                $mpdf->useSubstitutions = true;
                $mpdf->use_kwt = true;
                $mpdf->WriteHTML($conteudo);

                return $mpdf->Output("$nomeArquivo.pdf", 'D');
                break;
        }

        return $response;
    }

    public function aplicaFiltrosTexto($filtros)
    {
        $filtrosTexto = [];
        if (!empty($filtros['data'])) {
            $filtrosTexto[] = 'Data: ' . $filtros['data'];
        }

        if (!empty($filtros['data_inicial'])) {
            $filtrosTexto[] = 'Data inicial: ' . $filtros['data_inicial'];
        }

        if (!empty($filtros['data_final'])) {
            $filtrosTexto[] = 'Data final: ' . $filtros['data_final'];
        }

        return $filtrosTexto;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Gera o nome do arquivo a ser feito download pelo usuário.
     *
     * @return string
     */
    private function gerarNomeArquivo()
    {
        $titulo = Str::ascii($this->titulo);
        $titulo = Str::slug($titulo) . '_' . date('d-m-Y');

        return "$titulo";
    }

    /**
     * Pagina o resultado de uma query feita no banco.
     *
     * @param int $pagina
     * @param mixed $dados
     *
     * @return Collection
     */
    protected function paginar($pagina, $dados)
    {
        $offSet = ($pagina * $this->porPagina) - $this->porPagina;
        $itemsPaginaAtual = array_slice($dados->toArray(), $offSet, $this->porPagina, true);
        $dados = new LengthAwarePaginator($itemsPaginaAtual, count($dados), $this->porPagina, $pagina, ['path' => '?']);

        return $dados;
    }

}