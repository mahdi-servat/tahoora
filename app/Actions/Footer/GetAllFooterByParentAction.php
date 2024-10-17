<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Footer;

use App\Repositories\FooterRepositoryEloquent;
use App\Repositories\MenuRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class GetAllFooterByParentAction
{
	public FooterRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(FooterRepositoryEloquent::class);
	}


	public function handle(Request $request , $paginate = true)
	{
	    $data = [];
	    $parents = $this->repository->where('parent_id' , null)->orderBy('sort')->get();

	    $count = 0 ;
	    foreach($parents as $parent){
            if(!empty($parent->children)){
                $data[$count] = [
                    'id' => $parent->id,
                    'title' => $parent->title,
                    'url' => $parent->url,
                    'sort' => $parent->sort,
                    'children' => $this->getChild($parent->children)
                ];
            }else {
                $data[$count] = [
                    'id' => $parent->id,
                    'title' => $parent->title,
                    'url' => $parent->url,
                    'sort' => $parent->sort,
                ];
            }

            $count++;
        }

	    return $data;
	}

    public function getChild($children)
    {
        $data = [];

        $count = 0 ;
        foreach ($children as $child){
            if(!empty($child->children)){
                $data[$count] = [
                    'id' => $child->id,
                    'title' => $child->title,
                    'url' => $child->url,
                    'sort' => $child->sort,
                    'children' => $this->getChild($child->children) ,
                ];
            }else {
                $data[$count] = [
                    'id' => $child->id,
                    'title' => $child->title,
                    'url' => $child->url,
                    'sort' => $child->sort,
                ];
            }
            $count++;
        }
        return $data ;
    }
}
