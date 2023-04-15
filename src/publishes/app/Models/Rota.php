<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Bootstrapper\Interfaces\TableInterface;

class Rota extends BaseModel implements TableInterface
{
    protected $fillable = ['id_tipo_rota', 'descricao', 'slug'];

    protected $table = 'rota';


    public function getTableHeaders()
    {
        return ['id_tipo_rota', 'descricao', 'slug'];
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


            case "id_tipo_rota":
                return $this->id_tipo_rota;

            case "descricao":
                return $this->descricao;

            case "slug":
                return $this->slug;
        }
    }


    /**
     * Rota possui Rl_permissao_tipo_usuarios
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function Rl_permissao_tipo_usuarios()
    {
        return $this->hasMany(\App\Models\RlPermissaoTipoUsuario::class, 'id_permissao', 'id');
    }

    /**
     * Rota pertence a Tipo_rota
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function Tipo_rota()
    {
        return $this->belongsTo(\App\Models\TipoRota::class, 'id_tipo_rota', 'id');
    }

    /**
     * Todos os tipos de usuários que tem essa permissão.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grupos()
    {
        return $this->belongsToMany(AuxTipoUsuario::class, 'rl_rota_tipo_usuario', 'id_rota', 'id_tipo_usuario');
    }

}
