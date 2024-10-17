<?php

namespace App\Repositories;

use App\Models\Program\Program;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProgramRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProgramRepositoryEloquent extends BaseRepository implements ProgramRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Program::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
