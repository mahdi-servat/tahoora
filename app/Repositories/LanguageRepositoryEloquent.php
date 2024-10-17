<?php

namespace App\Repositories;

use App\Models\Language\Language;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LanguageRepository;

/**
 * Class LanguageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LanguageRepositoryEloquent extends BaseRepository implements LanguageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Language::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
