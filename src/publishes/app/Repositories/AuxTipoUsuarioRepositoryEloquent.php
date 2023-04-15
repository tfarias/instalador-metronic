<?php

namespace App\Repositories;
use App\Models\AuxTipoUsuario;
/**
 * Class AuxTipoUsuarioRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AuxTipoUsuarioRepositoryEloquent extends BaseRepository  implements AuxTipoUsuarioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AuxTipoUsuario::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
