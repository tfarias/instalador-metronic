<?php

namespace Tfarias\InstaladorTfarias\Commands;

use Tfarias\InstaladorTfarias\Services\Crud\CriaForms;
use Tfarias\InstaladorTfarias\Services\Crud\CriaModel;
use Tfarias\InstaladorTfarias\Services\Crud\CriarController;
use Tfarias\InstaladorTfarias\Services\Crud\CriaRepository;
//use Tfarias\InstaladorTfarias\Services\Crud\CriaRequest;
use Tfarias\InstaladorTfarias\Services\Crud\CriarRelatorio;
use Tfarias\InstaladorTfarias\Services\Crud\CriaViews;
use Tfarias\InstaladorTfarias\Services\Crud\CriarCriteria;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateCrud extends Command
{

    protected $signature = 'create-metronic';

    protected $description = 'Cria um crud completo baseado no template metronic. por Tiago F. S.';

    /**
     * @var CriaViews
     */
    private $criaViews;

    /**
     * @var CriaModel
     */
    private $criaModel;

    /**
     * @var CriaForms
     */
    private $criaForms;

    /**
     * @var CriaRepository
     */
    private $criaRepository;

    /**
     * @var CriarController
     */
    private $criarController;

    /**
     * @var CriarCriteria
     */
    private $criarCriteria;

    public function __construct(
        CriaViews $criaViews,
        CriaModel $criaModel,
        CriaForms $criaForms,
        CriaRepository $criaRepository,
        CriarController $criarController,
        CriarCriteria $criarCriteria
    ) {
        parent::__construct();

        $this->criaViews = $criaViews;
        $this->criaModel = $criaModel;
        $this->criaForms = $criaForms;
        $this->criaRepository = $criaRepository;
        $this->criarController = $criarController;
        $this->criarCriteria = $criarCriteria;
    }

    public function handle()
    {

        while (true) {
            $tabela = $this->ask("Qual a tabela?");
            $titulo = $this->ask("Qual o Titulo da view?");
            $tipo_rota= $this->ask("Qual o tipo de rota?");
            $uuid= $this->ask("Vai usar uuid? (y,n) default n");
            $routeAs = $tabela;

            $uuid = empty($uuid) ? 'n': $uuid;

            echo "\n\n";
            echo "##############################################################\n";
            echo "####################### Conferir dados #######################\n";
            echo "##############################################################\n";
            echo "\n\n";
            echo "Tabela --------------------" . $tabela . "\n";
            echo "Titulo CRUD ---------------" . $titulo . "\n";
            echo "Titulo Rota ---------------" . $tipo_rota . "\n";
            echo "Alias (as) Rota -----------" . $routeAs . "\n";
            echo "Usar uuid -----------------" . $uuid . "\n";


            echo "\n\n";

            $confirma = $this->ask("Confirma os dados abaixo (y/n)?");

            if (strtolower($confirma) != "y") {
                echo "\n\n";
                echo "##############################################################\n";
                echo "################## Reiniciando processo ######################\n";
                echo "##############################################################\n";
                echo "\n\n";
            } else {
                echo "\n\n";
                echo "GERANDO INFORMACOES.....................\n";
                break;
            }
        }



        try {
            // Primeira coisa que fazemos é criar as views
            $this->criaViews->criar($tabela, $titulo, $routeAs);

             // Agora vamos criar o model
            $this->criaModel->criar($tabela,$uuid);

            $this->criaForms->criar($tabela);

            $this->criaRepository->criar($titulo, $tabela);

            $this->criarController->criar($tabela, $titulo, $routeAs,$tipo_rota);
            // Agora o controller
            // E por ultimo criamos o arquivo que é responsavel pelo Relatório (pela listagem dos registros na tabela)
            $this->criarCriteria->criar($titulo, $tabela);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
