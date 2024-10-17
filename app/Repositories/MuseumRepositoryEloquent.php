<?php

namespace App\Repositories;

use App\Models\Museum\Museum;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class MuseumRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MuseumRepositoryEloquent extends BaseRepository implements MuseumRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Museum::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
