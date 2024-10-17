<?php

namespace App\Repositories;

use App\Models\Page\Page;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class PageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PageRepositoryEloquent extends BaseRepository implements PageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Page::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
