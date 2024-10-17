<?php

namespace App\Repositories;

use App\Models\Comment\Comment;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
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
        'name' => 'like',
        'status.id' => '=',
    ];


}
