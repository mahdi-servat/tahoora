<?php

namespace App\Repositories;

use App\Models\PageSetting\PageSetting;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class PageSettingRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PageSettingRepositoryEloquent extends BaseRepository implements PageSettingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PageSetting::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
