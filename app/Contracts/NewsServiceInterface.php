<?php

namespace App\Contracts;

interface NewsServiceInterface
{
    function changeSort($id, $secondID);

    function create($event_id, $title, $image, $description, $date);

    function delete(int $id): bool|null;

    function find(int $id);

}
