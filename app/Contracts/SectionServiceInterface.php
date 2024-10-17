<?php

namespace App\Contracts;

use App\Models\Section;
use Illuminate\Support\Collection;

interface SectionServiceInterface
{
    function create($description, string $type, string $modelType, int $modelId);

    function update(int $id, $description);

    function find(int $id): Section;

    function delete(int $id): bool|null;

    function index(string $modelType, int $modelId): Collection;

}
