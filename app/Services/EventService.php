<?php

namespace App\Services;

use App\Classes\Util;
use App\Contracts\AttachmentServiceInterface;
use App\Contracts\EventServiceInterface;
use App\Contracts\TagServiceInterface;
use App\Enums\AttachmentLinkTypeEnum;
use App\Enums\AttachmentTypeEnum;
use App\Enums\CalenderEnum;
use App\Enums\EventStatusEnum;
use App\Enums\NewsStatusEnum;
use App\Enums\OrganizationStatusEnum;
use App\Enums\RegisteredUsersEnum;
use App\Exceptions\NotFoundResourceException;
use App\Models\Calender;
use App\Models\Event;
use App\Models\EventWinners;
use App\Models\News;
use App\Models\Organization;
use App\Models\OrganizationEvents;
use App\Models\RegisterUsers;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class EventService implements EventServiceInterface
{
    function firstCreate(): Event
    {
        \DB::beginTransaction();
        try {
            $event = Event::create(['creator_id' => Auth::id(), 'type' => EventStatusEnum::active]);
            \DB::commit();
            return $event;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function baseInfo(int $id, string $title, $subTitle, $description, array $categories, $poster, $startDate, $stopDate): Event
    {
        \DB::beginTransaction();
        try {
            if (empty($description))
                return throw new \Exception('فیلد توضحیات الزامیست ');
            $event = $this->find($id);
            $event->update([
                'title' => $title,
                'sub_title' => $subTitle,
                'description' => $description,
                'creator_id' => Auth::id(),
            ]);
            $event->createCategories($categories);
            if ($startDate < $stopDate) {
                Calender::updateOrCreate(['event_id' => $event->id, 'type' => CalenderEnum::exactStart, 'title' => 'startDateOfEvent_' . $event->title], ['sub_title' => Util::toGregorian($startDate)]);
                Calender::updateOrCreate(['event_id' => $event->id, 'type' => CalenderEnum::exactStop, 'title' => 'stopDateOfEvent_' . $event->title], ['sub_title' => Util::toGregorian($stopDate)]);
            } else {
                throw new \Exception('تاریخ رویداد را بررسی نمایید.');
            }
            if (!empty($poster) && $poster instanceof UploadedFile) {
                app(AttachmentServiceInterface::class)->deleteByModel(get_class($event), $id, AttachmentTypeEnum::poster);
                app(AttachmentServiceInterface::class)->create($poster, $title, Event::class, $event->id, AttachmentTypeEnum::poster, AttachmentLinkTypeEnum::link);
            }
            \DB::commit();
            return $event->refresh();
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function calender(int $id, array $calenders): Event
    {
        try {
            $event = $this->find($id);
            $event->createCalenders($calenders, $id);
            return $event;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function organ($id, string $type, $organ_id, $title, $logo, $certificate): Event
    {
        try {
            if ($type == 'delete') {
                $organEvent = OrganizationEvents::find($organ_id);
                $event = $this->find($organEvent->event_id);
                if (!empty($organEvent->certificate))
                    app(AttachmentServiceInterface::class)->delete($organEvent->certificate->id);
                $organEvent->delete();
                return $event;
            }
            $event = $this->find($id);
            if (empty($organ_id)) {
                $organ = Organization::updateOrCreate(['type' => OrganizationStatusEnum::active],
                    ['title' => $title, 'type' => OrganizationStatusEnum::waiting]);
                $organ_id = $organ->id;
            }
            if (!empty($organ) || !empty($organ_id)) {
                $organEvent = OrganizationEvents::create([
                    'event_id' => $id,
                    'organization_id' => $organ_id,
                    'type' => $type
                ]);
            }
            if (!empty($logo) && empty($organ->logo) && $logo instanceof UploadedFile) {
                app(AttachmentServiceInterface::class)->create($logo, $title, Organization::class, $organ_id, AttachmentTypeEnum::logo, AttachmentLinkTypeEnum::link);
            }
            if (!empty($certificate) && empty($organEvent->certificate) && $certificate instanceof UploadedFile) {
                app(AttachmentServiceInterface::class)->create($certificate, $title . '_certificate', OrganizationEvents::class, $organEvent->id, AttachmentTypeEnum::certificate, AttachmentLinkTypeEnum::link);
            }
            return $event;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function video($id, $video, $title, $subTitle, $poster): Event
    {
        try {
            $event = $this->find($id);
            if (!empty($video) && $video instanceof UploadedFile) {
                app(AttachmentServiceInterface::class)->createWithThumb($video, $poster, $title, $subTitle, Event::class, $event->id, AttachmentTypeEnum::videoGallery, AttachmentLinkTypeEnum::link);
            }
            return $event;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function image($id, $image, $title): Event
    {
        try {
            $event = $this->find($id);
            if (!empty($image) && $image instanceof UploadedFile) {
                app(AttachmentServiceInterface::class)->create($image, $title, Event::class, $event->id, AttachmentTypeEnum::imageGallery, AttachmentLinkTypeEnum::link);
            }
            return $event;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function tag($id, $title): Event
    {
        try {
            $event = $this->find($id);
            $event->createTag(app(TagServiceInterface::class)->findOrCreate($title)->id);
            return $event;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function winners($event_id, $description, $winners)
    {
        try {
            $event = $this->find($event_id);
            if ($event->type != EventStatusEnum::active)
                return throw new \Exception('وضعیت رویداد مناسب انتخاب برندگان نیست.');

            $eventWinner = EventWinners::updateOrCreate(['event_id' => $event_id], ['description' => $description]);
            foreach ($winners as $winner) {
                RegisterUsers::updateOrCreate(
                    ['model_type' => 'App\Models\EventWinners', 'model_id' => $eventWinner->id, 'user_id' => $winner['user_id'], 'type' => RegisteredUsersEnum::grade],
                    ['grade' => $winner['grade'], 'description' => $winner['description']]);
            }
            return $eventWinner;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function news($event_id, $title, $image, $description, $status, $id, $date)
    {
        try {
            if ($status == 'delete')
                $data = News::where('id', $id)->delete();
            if ($status == 'update') {
                $data = News::where('id', $id)->update([
                    'title' => $title, 'description' => $description, 'date' => Util::toGregorian($date)
                ]);

                if (!empty($image) && $image instanceof UploadedFile) {
                    app(AttachmentServiceInterface::class)->deleteByModel(News::class, $id, AttachmentTypeEnum::thumbnail);
                    app(AttachmentServiceInterface::class)->create($image, $title, News::class, $id, AttachmentTypeEnum::thumbnail, AttachmentLinkTypeEnum::link);
                }
            }
            if ($status == NewsStatusEnum::deactive)
                $data = News::where('id', $id)->update(['status' => NewsStatusEnum::deactive]);
            if ($status == NewsStatusEnum::active) {
                if (!empty($id))
                    $data = News::updateOrCreate(
                        ['id' => $id,],
                        ['title' => $title, 'description' => $description, 'status' => $status, 'date' => Util::toGregorian($date)]
                    ); else
                    $data = News::updateOrCreate(
                        ['event_id' => $event_id, 'title' => $title],
                        ['description' => $description, 'status' => $status, 'date' => Util::toGregorian($date)]
                    );

                if (!empty($image) && $image instanceof UploadedFile) {
                    app(AttachmentServiceInterface::class)->deleteByModel(News::class, $data->id, AttachmentTypeEnum::thumbnail);
                    app(AttachmentServiceInterface::class)->create($image, $title, News::class, $data->id, AttachmentTypeEnum::thumbnail, AttachmentLinkTypeEnum::link);
                }
            }
            return $data;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function find(int $id): Event
    {
        $event = Event::find($id);
        if ($event) {
            if ($event->creator_id != Auth::id())
                return throw new UnauthorizedException('unauthorized');
            return $event;
        } else {
            throw new NotFoundResourceException();
        }
    }

    function frontFind(int $id): Event
    {
        $event = Event::find($id);
        if ($event)
            return $event;
        else
            throw new NotFoundResourceException();

    }

    function delete(int $id): bool|null
    {
        try {
            return Event::find($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function index(Request $request)
    {
        $user = Auth::user();
        return $user->events;
    }

    function all(Request $request)
    {
        $events = Event::where('type', EventStatusEnum::active)->get();
        return $events;
    }

    function changeStatus(int $id, string $typeEnum): Event
    {
        try {
            $event = $this->find($id);
            $event->update([
                'type' => $typeEnum,
            ]);
            return $event;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

}
