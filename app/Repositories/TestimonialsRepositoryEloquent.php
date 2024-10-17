<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TestimonialsRepository;
use App\Entities\Testimonials;
use App\Validators\TestimonialsValidator;

/**
 * Class TestimonialsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TestimonialsRepositoryEloquent extends BaseRepository implements TestimonialsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Testimonials::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
