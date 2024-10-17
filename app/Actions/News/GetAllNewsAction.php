<?php

/**
 * Actions are class for process
 */

namespace App\Actions\News;

use App\Models\News\News;
use App\Repositories\NewsRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllNewsAction
{
    public NewsRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(NewsRepositoryEloquent::class);
    }


    public function handle(Request $request, $paginate = true)
    {
        if (!empty($request->orderBy) && !empty($request->sortedBy)) {
            return $this->repository->orderBy('date', 'desc')->orderBy('created_at' , 'desc')->paginate();
        } else {
            return $this->repository->orderBy('date', 'desc')->orderBy('created_at' , 'desc')->paginate();
        }
    }

}
