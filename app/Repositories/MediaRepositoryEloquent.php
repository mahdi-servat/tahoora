<?php

namespace App\Repositories;

use App\Models\Media\Media;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class MediaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MediaRepositoryEloquent extends BaseRepository implements MediaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Media::class;
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
        'status_id' => '=',

    ];
}
