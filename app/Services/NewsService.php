<?php

namespace App\Services;

use App\Contracts\NewsServiceInterface;
use App\Models\Attachment;
use App\Models\News;
use Illuminate\Support\Facades\File;

class NewsService implements NewsServiceInterface
{
    function create($event_id, $title, $image, $description, $date)
    {
        try {
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function changeSort($id, $secondID)
    {
        try {
            $update = Attachment::where('id', $id)->first();
            $update->update(['sort' => $secondID]);
            return $update;
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

    function find(int $id)
    {
        try {
            return News::find($id);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

}
