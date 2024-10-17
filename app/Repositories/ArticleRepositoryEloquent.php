<?php

namespace App\Repositories;

use App\Models\Article\Article;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class ArticleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ArticleRepositoryEloquent extends BaseRepository implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
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
