<?php

namespace App\Repositories;

use App\Models\ViewLog\ViewLog;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class ViewLogRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ViewLogRepositoryEloquent extends BaseRepository implements ViewLogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ViewLog::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
