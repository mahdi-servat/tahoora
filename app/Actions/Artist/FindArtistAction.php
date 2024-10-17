<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Artist;

use App\Repositories\ArtistRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FindArtistAction
{
	public ArtistRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(ArtistRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        return $this->repository->find($request->id)->load('socialMedia' , 'tags' , 'attachments');
	}
}
