<?php

namespace App\Services;

use App\Contracts\AttachmentServiceInterface;
use App\Contracts\CategoryServiceInterface;
use App\Contracts\CourseServiceInterface;
use App\Contracts\SectionServiceInterface;
use App\Enums\AttachmentLinkTypeEnum;
use App\Enums\AttachmentTypeEnum;
use App\Enums\CategoryTypeEnum;
use App\Exceptions\NotFoundResourceException;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseService implements CourseServiceInterface
{
    function create(string $title, int $categoryId, $image = null, int $studyTime = 0, int $price = 0, bool $hasCertificate = false, array $sections = [], array $tags = []): Course
    {
        \DB::beginTransaction();
        try {
            $course = Course::create([
                'title' => $title,
                'study_time' => $studyTime,
                'price' => $price,
                'has_certificate' => $hasCertificate,
            ]);
            $course->createCategory($categoryId);
            if ($image) {
                app(AttachmentServiceInterface::class)->create($image, $title, Course::class, $course->id, AttachmentTypeEnum::image, AttachmentLinkTypeEnum::link);
            }
            if (count($sections) > 0) {
                foreach ($sections as $section) {
                    app(SectionServiceInterface::class)->create($section['title'], Course::class, $course->id, $section['description'], $section['sort'], $section['file']);
                }
            }
            \DB::commit();
            return $course;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function update(int $id, string $title, int $categoryId, $image = null, int $studyTime = 0, int $price = 0, bool $hasCertificate = false, array $sections = [], array $tags = []): Course
    {
        \DB::beginTransaction();
        try {
            $course = $this->find($id);
            $course->update([
                'title' => $title,
                'study_time' => $studyTime,
                'price' => $price,
                'has_certificate' => $hasCertificate,
            ]);
            $course->createCategory($categoryId);
            if (!empty($image) && $image instanceof UploadedFile) {
                app(AttachmentServiceInterface::class)->deleteByModel(get_class($course),$id,AttachmentTypeEnum::image);
                app(AttachmentServiceInterface::class)->create($image, $title, Course::class, $course->id, AttachmentTypeEnum::image, AttachmentLinkTypeEnum::link);
            }
//            if (count($sections) > 0) {
//                foreach ($sections as $section) {
//                    app(SectionServiceInterface::class)->create($section['title'], Course::class, $course->id, $section['description'], $section['sort'], $section['file']);
//                }
//            }
            \DB::commit();
            return $course->refresh();
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function find(int $id): Course
    {
        $course = Course::find($id);
        if ($course) {
            return $course;
        } else {
            throw new NotFoundResourceException();
        }
    }

    function delete(int $id): bool|null
    {
        try {
            return Course::find($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function index(Request $request): LengthAwarePaginator
    {
        return Course::paginate();
    }

    function coursesOfCategory(int $categoryId): LengthAwarePaginator
    {
        return Course::whereHas('categories', function ($q) use ($categoryId) {
            $q->where('categories.id', $categoryId);
        })->paginate();
    }
}
