<?php

namespace App\Repositories;

use App\Models\Menu\Menu;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;


/**
 * Class MenuRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
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
        'parent_id' => '=',
    ];
}
