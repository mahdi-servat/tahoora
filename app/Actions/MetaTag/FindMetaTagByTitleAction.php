<?php

/**
 * Actions are class for process
 */

namespace App\Actions\MetaTag;

use App\Repositories\MetaTagRepositoryEloquent;
use Illuminate\Support\Facades\App;

class FindMetaTagByTitleAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(MetaTagRepositoryEloquent::class);
	}


	public function handle($title)
	{
        $_title = str_replace(" " , "" , $title);

        return $this->repository->where('title2' , $_title)->first();
	}
}
