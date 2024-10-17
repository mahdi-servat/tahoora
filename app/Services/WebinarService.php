<?php

namespace App\Services;

use App\Classes\Util;
use App\Contracts\AttachmentServiceInterface;
use App\Contracts\WebinarServiceInterface;
use App\Enums\AttachmentLinkTypeEnum;
use App\Enums\AttachmentTypeEnum;
use App\Enums\StatusEnum;
use App\Exceptions\NotFoundResourceException;
use App\Models\Webinar;
use Illuminate\Http\UploadedFile;

class WebinarService implements WebinarServiceInterface
{
    function create($event_id, $title, $sub_title, $webinar_poster, $day, $start_date, $end_date, $description, $link): Webinar
    {
        \DB::beginTransaction();
        try {
            $webinar = Webinar::create([
                'event_id' => $event_id,
                'title' => $title,
                'sub_title' => $sub_title,
                'start_date' => Util::toGregorian($day . ' ' . $start_date, true),
                'end_date' => Util::toGregorian($day . ' ' . $end_date, true),
                'description' => $description,
                'type' => StatusEnum::waiting,
                'link' => $link,
            ]);
            if (!empty($webinar_poster) && $webinar_poster instanceof UploadedFile) {
                app(AttachmentServiceInterface::class)->create($webinar_poster, $title, Webinar::class, $webinar->id, AttachmentTypeEnum::poster, AttachmentLinkTypeEnum::link);
            }
            \DB::commit();
            return $webinar;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function update($id, $title, $sub_title, $webinar_poster, $day, $start_date, $end_date, $description, $link): Webinar
    {
        \DB::beginTransaction();
        try {
            $webinar = $this->find($id);

            $webinar->update([
                'title' => $title,
                'sub_title' => $sub_title,
                'start_date' => Util::toGregorian($day . ' ' . $start_date, true),
                'end_date' => Util::toGregorian($day . ' ' . $end_date, true),
                'description' => $description,
                'link' => $link,
                'type' => StatusEnum::waiting,
            ]);
            if (!empty($webinar_poster) && $webinar_poster instanceof UploadedFile) {
                app(AttachmentServiceInterface::class)->deleteByModel(Webinar::class, $id, AttachmentTypeEnum::poster);
                app(AttachmentServiceInterface::class)->create($webinar_poster, $title, Webinar::class, $id, AttachmentTypeEnum::poster, AttachmentLinkTypeEnum::link);
            }
            \DB::commit();
            return $webinar->refresh();
        } catch (\Exception $exception) {
            \DB::beginTransaction();
            throw $exception;
        }
    }

    function find(int $id): Webinar
    {
        $event = Webinar::find($id);
        if ($event) {
            return $event;
        } else {
            throw new NotFoundResourceException();
        }
    }

    function delete(int $id): bool|null
    {
        try {
            return Webinar::find($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
