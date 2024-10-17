<?php

namespace App\Repositories;

use App\Models\Artist\Artist;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class ArtistRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ArtistRepositoryEloquent extends BaseRepository implements ArtistRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Artist::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
