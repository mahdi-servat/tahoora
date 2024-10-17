<?php

namespace App\Repositories;

use App\Models\Event\Event;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class EventRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EventRepositoryEloquent extends BaseRepository implements EventRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Event::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
