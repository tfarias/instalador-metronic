<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Bootstrapper\Interfaces\TableInterface;

class TipoRota extends BaseModel implements TableInterface
{
    use SoftDeletes;
    protected $fillable = ['descricao', 'icone'];

    protected $table = 'tipo_rota';
    protected $dates = ['deleted_at'];


    public function getTableHeaders()
    {
        return ['Descrição', 'Icone'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {


            case "Descrição":
                return $this->descricao;

            case "Icone":
                return $this->icone;


        }
    }


    /**
     * Tipo_rota possui Rotas
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function Rotas()
    {
        return $this->hasMany(\App\Models\Rota::class, 'id_tipo_rota', 'id');
    }
}
