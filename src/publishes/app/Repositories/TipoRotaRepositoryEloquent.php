<?php

namespace App\Repositories;

use App\Models\TipoRota;

/**
 * Class TipoRotaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TipoRotaRepositoryEloquent extends BaseRepository implements TipoRotaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoRota::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
