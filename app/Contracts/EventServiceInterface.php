<?php

namespace App\Contracts;

use App\Models\Event;
use Illuminate\Http\Request;

interface EventServiceInterface
{
    function firstCreate(): Event;

    function baseInfo(int $id, string $title, string $subTitle, string $description, array $categories, $poster, $startDate, $stopDate): Event;

    function changeStatus(int $id, string $typeEnum): Event;

    function calender(int $id, array $calenders): Event;

    function organ($id, string $type, $organ_id, $title, $logo, $certificate): Event;

    function video($id, $video, $title, $subTitle, $poster): Event;

    function image($id, $image, $title): Event;

    function tag($id, $title): Event;

    function winners($event_id, $description, $winners);

    function news($event_id, $title, $image, $description, $status, $id, $date);

    function find(int $id): Event;
    function frontFind(int $id): Event;

    function delete(int $id): bool|null;

    function index(Request $request);

    function all(Request $request);

}
