<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Artist;

use App\Repositories\ArtistRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DeleteArtistAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(ArtistRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
	}
}
