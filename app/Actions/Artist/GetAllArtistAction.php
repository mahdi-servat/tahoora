<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Artist;

use App\Repositories\ArtistRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllArtistAction
{
	public ArtistRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(ArtistRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
        if ($paginate){
            return $this->repository->paginate();
        }else{
            return $this->repository->get();
        }
	}
}
