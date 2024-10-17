<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Reserve;

class ReserveRepositoryEloquent extends BaseRepository implements ReserveRepository
{
    public function model()
    {
        return Reserve::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
