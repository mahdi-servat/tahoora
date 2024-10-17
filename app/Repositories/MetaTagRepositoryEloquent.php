<?php

namespace App\Repositories;

use App\Models\MetaTag\MetaTag;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class MetaTagRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MetaTagRepositoryEloquent extends BaseRepository implements MetaTagRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MetaTag::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
