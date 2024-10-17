<?php

namespace App\Repositories;

use App\Models\Category\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
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
        'parent_id' => '=',
        'category_type_id' => '=',
        'title' => 'like',
    ];

}
