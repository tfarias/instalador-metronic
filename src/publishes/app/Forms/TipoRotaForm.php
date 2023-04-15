<?php

namespace LaravelMetronic\Forms;

use Kris\LaravelFormBuilder\Form;

class TipoRotaForm extends Form
{
    public function buildForm()
    {
        
    $this->add("descricao","text",[
    "rules" => "required"
    ]);
    $this->add("icone","text",[
    "rules" => "required"
    ]);
    $this->add("modified_at","text",[
    "rules" => "nullable"
    ]);
    $this->add("deleted_at","text",[
    "rules" => "nullable"
    ]);
        $this
            ->add('submit', 'submit', ['label' => 'Salvar'])
            ->add('clear', 'reset', ['label' => 'Limpar']);
    }
}
