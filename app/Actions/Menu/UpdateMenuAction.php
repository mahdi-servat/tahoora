<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Menu;

use App\Repositories\MenuRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateMenuAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(MenuRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $data = $request->only([
            'language_id',
            'title',
            'url',
            'parent_id',
            'status_id',
            'sort',
        ]);

        if (!empty($data['parent_id'])) {
            $parent = $this->repository->find($data['parent_id']);
            $data['parents_id'] = $parent->parents_id . $data['parent_id'] . ',';
        }

        return $this->repository->update($data , $request->id);
	}
}
