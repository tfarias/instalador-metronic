<?php

namespace App\Repositories;

use App\Models\SisUsuario;

/**
 * Class SisUsuarioRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SisUsuarioRepositoryEloquent extends BaseRepository implements SisUsuarioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SisUsuario::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
