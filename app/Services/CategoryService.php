<?php

namespace App\Services;

use App\Contracts\CategoryServiceInterface;
use App\Enums\CategoryTypeEnum;
use App\Exceptions\NotFoundResourceException;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService implements CategoryServiceInterface
{
    function create(string $title, int $parentId = null, string $type, string $description = null): Category
    {
        \DB::beginTransaction();
        try {
            $parentsId = null;
            if (!empty($parentId)) {
                $parent = $this->find($parentId);
                $parentsId = !empty($parent->parents_id) ? $parent->parents_id . ',' . $parent->id . ',' : ',' . $parent->id . ',';
            }
            $category = Category::create([
                'title' => $title,
                'type' => $type,
                'parent_id' => $parentId,
                'parents_id' => $parentsId,
                'description' => $description
            ]);
            \DB::commit();
            return $category;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function update(int $id, string $title, int $parentId = null, string $type = CategoryTypeEnum::course, string $description = null): Category
    {
        \DB::beginTransaction();
        try {
            $parentsId = null;
            if (!empty($parentId)) {
                $parent = $this->find($parentId);
                $parentsId = !empty($parent->parents_id) ? $parent->parents_id . ',' . $parent->id . ',' : ',' . $parent->id . ',';
            }
            $category = $this->find($id);
            $category->update([
                'title' => $title,
                'type' => $type,
                'parent_id' => $parentId,
                'parents_id' => $parentsId,
                'description' => $description
            ]);
            \DB::commit();
            return $category->refresh();
        } catch (\Exception $exception) {
            \DB::beginTransaction();
            throw $exception;
        }
    }

    function find(int $id): Category
    {
        $section = Category::find($id);
        if ($section) {
            return $section;
        } else {
            throw new NotFoundResourceException();
        }
    }

    function delete(int $id): bool|null
    {
        try {
            return Category::find($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function index(Request $request): LengthAwarePaginator
    {
        return Category::paginate();
    }

    function all(Request $request): Collection
    {
       return Category::all();
    }

    function allParents(): Collection
    {
        return Category::whereNull('parent_id')->get();
    }
}
