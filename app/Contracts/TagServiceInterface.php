<?php

namespace App\Contracts;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface TagServiceInterface
{
    function create(string $title): Tag;

    function update(int $id, string $title): Tag;

    function find(int $id): Tag;

    function findOrCreate(string $title): Tag;

    function delete(int $id): bool|null;

    function index(Request $request): LengthAwarePaginator;

    function all(Request $request);
}
