<?php

namespace App\Contracts;

use App\Models\Webinar;

interface WebinarServiceInterface
{
    function create($event_id, $title, $sub_title, $webinar_poster, $day, $start_date, $end_date, $description, $link): Webinar;

    function update($id, $title, $sub_title, $webinar_poster, $day, $start_date, $end_date, $description, $link): Webinar;

    function find(int $id): Webinar;
    function delete(int $id): bool|null;

}
