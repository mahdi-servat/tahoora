<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Footer;

use App\Repositories\FooterRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateFooterAction
{
	public FooterRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(FooterRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $data = $request->only([
            'language_id',
            'title',
            'url',
            'sort',
            'status_id',
            'parent_id',
        ]);
        if (!empty($request->parent_id)){
            $parent = $this->repository->find($data['parent_id']);
            if (!empty($parent->parent_id)){
                throw new \Exception('فقط یک پدر میتواند داشته باشد');
            }
        }
        return $this->repository->create($data);
    }
}
