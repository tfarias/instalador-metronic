<?php

namespace App\Repositories;

use App\Models\Rota;

/**
 * Class RotaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RotaRepositoryEloquent extends BaseRepository implements RotaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rota::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
