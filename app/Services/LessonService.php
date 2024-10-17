<?php

namespace App\Services;

use App\Classes\Util;
use App\Contracts\AttachmentServiceInterface;
use App\Contracts\LessonServiceInterface;
use App\Contracts\SectionServiceInterface;
use App\Enums\AttachmentLinkTypeEnum;
use App\Enums\AttachmentTypeEnum;
use App\Enums\LessonTypeEnum;
use App\Exceptions\NotFoundResourceException;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class LessonService implements LessonServiceInterface
{

    function create(string $title, int $courseId, string $type = LessonTypeEnum::sesson, int $parentId = null, int $sort = 0, array $sections = []): Lesson
    {
        \DB::beginTransaction();
        try {
            Lesson::where([['sort', '>=', $sort], ['type', $type], ['course_id', $courseId],['parent_id',$parentId]])->update(array(
                'sort' => DB::raw('sort + 1')
            ));
            $lesson = Lesson::create([
                'title' => $title,
                'course_id' => $courseId,
                'type' => $type,
                'parent_id' => $parentId,
                'sort' => $sort,
            ]);
            if (count($sections) > 0) {
                foreach ($sections as $section) {
                    app(SectionServiceInterface::class)->create($section['title'], Lesson::class, $lesson->id, $section['description'], $section['sort'], $section['file']);
                }
            }
            \DB::commit();
            return $lesson;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function update(int $id, string $title, int $courseId, string $type = LessonTypeEnum::sesson, int $parentId = null, int $sort = 0, array $sections = []): Lesson
    {
        \DB::beginTransaction();
        try {
            $lesson = $this->find($id);
            $lesson->update([
                'title' => $title,
                'course_id' => $courseId,
                'type' => $type,
                'parent_id' => $parentId,
//                'sort' => $sort,
            ]);
//            if (count($sections) > 0) {
//                foreach ($sections as $section) {
//                    app(SectionServiceInterface::class)->create($section['title'], Course::class, $course->id, $section['description'], $section['sort'], $section['file']);
//                }
//            }
            \DB::commit();
            return $lesson->refresh();
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function find(int $id): Lesson
    {
        $lesson = Lesson::find($id);
        if ($lesson) {
            return $lesson;
        } else {
            throw new NotFoundResourceException();
        }
    }

    function delete(int $id): bool|null
    {
        try {
            return Lesson::find($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function index(Request $request): LengthAwarePaginator
    {
        return Lesson::orderBy('sort')->paginate();
    }

    function seasonsOfCourses(int $courseId): Collection
    {
        return Lesson::where([['course_id', $courseId],['type',LessonTypeEnum::sesson]])->orderBy('sort')->get();
    }

    function lessonsOfSeason(int $seasonId): Collection
    {
        return Lesson::where([['parent_id', $seasonId],['type',LessonTypeEnum::lesson]])->orderBy('sort')->get();
    }

    function lessonsOfCourse(int $courseId): Collection
    {
        return Lesson::where([['course_id', $courseId],['type',LessonTypeEnum::lesson]])->orderBy('sort')->get();
    }
}
