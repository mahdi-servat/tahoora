<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Menu;

use App\Repositories\MenuRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllMenuAction
{
    public MenuRepositoryEloquent $repository;
    public function __construct()
    {
        $this->repository = App::make(MenuRepositoryEloquent::class);
    }

    public function handle(Request $request , $paginate = true)
    {
        if ($paginate){
            return $this->repository->paginate();
        }else {
            return $this->repository->get();
        }
    }
}
