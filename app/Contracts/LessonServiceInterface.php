<?php

namespace App\Contracts;

use App\Enums\CategoryTypeEnum;
use App\Enums\LessonTypeEnum;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface LessonServiceInterface
{
    function create(string $title, int $courseId, string $type = LessonTypeEnum::sesson, int $parentId = null, int $sort = 0, array $sections = []): Lesson;

    function update(int $id, string $title, int $courseId, string $type = LessonTypeEnum::sesson, int $parentId = null, int $sort = 0, array $sections = []): Lesson;

    function find(int $id): Lesson;

    function delete(int $id): bool|null;

    function index(Request $request): LengthAwarePaginator;

    function seasonsOfCourses(int $courseId): Collection;

    function lessonsOfSeason(int $seasonId): Collection;

    function lessonsOfCourse(int $courseId): Collection;
}
