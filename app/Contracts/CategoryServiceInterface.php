<?php

namespace App\Contracts;

use App\Enums\CategoryTypeEnum;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryServiceInterface
{
    function create(string $title, int $parentId = null, string $type , string $description = null): Category;

    function update(int $id, string $title, int $parentId = null, string $type = CategoryTypeEnum::course, string $description = null): Category;

    function find(int $id): Category;

    function delete(int $id): bool|null;

    function index(Request $request): LengthAwarePaginator;

    function all(Request $request): Collection;

    function allParents(): Collection;
}
