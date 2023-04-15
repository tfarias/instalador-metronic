<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Bootstrapper\Interfaces\TableInterface;

class AuxTipoUsuario extends BaseModel implements TableInterface
{
    protected $fillable = ['descricao'];

    protected $table = 'aux_tipo_usuario';


    public function getTableHeaders()
    {
        return ['Descrição'];
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
        }
    }


    
    /**
     * Aux_tipo_usuario possui Sis_usuarios
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function Sis_usuarios()
    {
        return $this->hasMany(\App\Models\SisUsuario::class, 'id_tipo_usuario', 'id');
    }


    public function rotas()
    {
        return $this->belongsToMany(Rota::class, 'rl_rota_tipo_usuario', 'id_tipo_usuario', 'id_rota');
    }
}
