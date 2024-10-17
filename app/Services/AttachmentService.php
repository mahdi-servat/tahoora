<?php

namespace App\Services;

use App\Classes\Util;
use App\Contracts\AttachmentServiceInterface;
use App\Enums\AttachmentTypeEnum;
use App\Models\Attachment;
use Illuminate\Support\Facades\File;
use Morilog\Jalali\Jalalian;

class AttachmentService implements AttachmentServiceInterface
{

    function changeSort($attachments_sorts)
    {
        try {
            foreach ($attachments_sorts as $key => $item)
                $update = Attachment::where('id', $item['id'])->update(['sort' => $key]);
            return $update;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function create($file, string $title, string $modelType, int $modelId, string $typeEnum, string $linkTypeEnum): Attachment
    {
        try {
            $sort = 0;
            if ($typeEnum == AttachmentTypeEnum::imageGallery)
                $sort = Util::getModelType($modelType)::find($modelId)->images->count() + 1;
            if ($typeEnum == AttachmentTypeEnum::attachment)
                $sort = Util::getModelType($modelType)::find($modelId)->attachment->count() + 1;
            $path = file_store($file, 'attachment/' . Jalalian::now()->getYear() . '/' . Jalalian::now()->getMonth() . '/' . $typeEnum);
            $data = Attachment::create([
                'title' => $title,
                'model_type' => Util::getModelType($modelType),
                'model_id' => $modelId,
                'type' => $typeEnum,
                'link_type' => $linkTypeEnum,
                'path' => $path,
                'sort' => $sort,
            ]);
            return $data;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function createWithThumb($file, $thumb, string $title, string $subTitle, string $modelType, int $modelId, string $typeEnum, string $linkTypeEnum): Attachment
    {
        try {
            $sort = $modelType::find($modelId)->video->count() + 1;
            $path = file_store($file, 'attachment/' . Jalalian::now()->getYear() . '/' . Jalalian::now()->getMonth() . '/' . $typeEnum);
            $thumbPath = file_store($thumb, 'attachment/' . Jalalian::now()->getYear() . '/' . Jalalian::now()->getMonth() . '/' . $typeEnum);
            $data = Attachment::create([
                'title' => $title . '___' . $subTitle,
                'thumbnail_path' => $thumbPath,
                'path' => $path,
                'model_type' => $modelType,
                'model_id' => $modelId,
                'type' => $typeEnum,
                'link_type' => $linkTypeEnum,
                'sort' => $sort,
            ]);
            return $data;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function multiCreate(array $attachments, string $modelType, int $modelId)
    {
        try {
            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    $this->create($attachment['file'], $attachment['title'], $modelType, $modelId, $attachment['type'], $attachment['link_type']);
                }
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function delete(int $id): bool|null
    {
        try {
            $file = Attachment::find($id);
            if (File::exists($file->path))
                File::delete($file->path);
            return $file->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function deleteByModel(string $modelType, int $modelId, string|null $type = null): bool|null
    {
        try {
            if (!empty($type)) {
                $file = Attachment::where([['model_type', $modelType], ['model_id', $modelId], ['type', $type]]);
                foreach ($file->get() as $item)
                    if (File::exists($item->path))
                        File::delete($item->path);
                return $file->delete();
            } else {
                $file = Attachment::where([['model_type', $modelType], ['model_id', $modelId]]);
                foreach ($file->get() as $item)
                    if (File::exists($item->path))
                        File::delete($item->path);
                return $file->delete();
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
