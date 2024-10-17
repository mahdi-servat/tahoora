<?php

namespace App\Repositories;

use App\Models\Attachment\Attachment;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class AttachmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AttachmentRepositoryEloquent extends BaseRepository implements AttachmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Attachment::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
