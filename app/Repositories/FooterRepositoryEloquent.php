<?php

namespace App\Repositories;

use App\Models\Footer\Footer;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class FooterRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FooterRepositoryEloquent extends BaseRepository implements FooterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Footer::class;
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
        'title' => 'like',
        'sort' => 'like',
        'parent_id' => 'like',
    ];
}
