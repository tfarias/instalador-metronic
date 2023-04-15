<?php

namespace LaravelMetronic\Forms;

use Bootstrapper\Facades\Icon;
use Kris\LaravelFormBuilder\Form;

class AuxTipoUsuarioForm extends Form
{
    public function buildForm()
    {

        $this->add("descricao", "text", [
            "rules" => "required",
            "label"=> "Descrição"
        ]);
        $this
            ->add('submit', 'submit', ['label' =>  Icon::create('pencil').' Salvar','attr'=>['class'=>'btn btn-primary text-center']])
            ->add('clear', 'reset', ['label' => Icon::create('refresh').' Limpar','attr'=>['class'=>'btn btn-danger text-center']]);
    }
}
