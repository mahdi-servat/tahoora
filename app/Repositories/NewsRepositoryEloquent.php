<?php

namespace App\Repositories;

use App\Models\News\News;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class NewsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NewsRepositoryEloquent extends BaseRepository implements NewsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return News::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public $fieldSearchable = [
        'language_id' => '=',
        'status_id' => '=',
        'title' => 'like',
        'title2' => 'like',
        'category.category.id' => '=',
    ];
}
