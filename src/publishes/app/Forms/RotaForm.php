<?php

namespace LaravelMetronic\Forms;

use Kris\LaravelFormBuilder\Form;

class RotaForm extends Form
{
    public function buildForm()
    {
        $this->add("id_tipo_rota", "entity", [
            "class" => \LaravelMetronic\Models\TipoRota::class,
            "property" => "id_tipo_rota",
            "rules" => "required|integer|exists:tipo_rota,id"
        ]);
        $this->add("descricao", "text", [
            "rules" => "required"
        ]);
        $this->add("slug", "text", [
            "rules" => "required"
        ]);
        $this->add("deleted_at", "text", [
            "rules" => "nullable"
        ]);
        $this
            ->add('submit', 'submit', ['label' => 'Salvar'])
            ->add('clear', 'reset', ['label' => 'Limpar']);
    }
}
