<?php

namespace App\Contracts;

use App\Enums\CategoryTypeEnum;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface CourseServiceInterface
{
    function create(string $title, int $categoryId, $image = null, int $studyTime = 0, int $price = 0, bool $hasCertificate = false, array $sections = [], array $tags = []): Course;

    function update(int $id, string $title, int $categoryId, $image = null, int $studyTime = 0, int $price = 0, bool $hasCertificate = false, array $sections = [], array $tags = []): Course;

    function find(int $id): Course;

    function delete(int $id): bool|null;

    function index(Request $request): LengthAwarePaginator;

    function coursesOfCategory(int $categoryId): LengthAwarePaginator;
}
