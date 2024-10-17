<?php

namespace App\Services;

use App\Classes\Util;
use App\Contracts\TagServiceInterface;
use App\Exceptions\NotFoundResourceException;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TagService implements TagServiceInterface
{
    function create(string $title): Tag
    {
        try {
            return Tag::create([
                'title' => $title,
                'title2' => Util::textSimplization($title),
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function update(int $id, string $title): Tag
    {
        try {
            $tag = $this->find($id);
            $tag->update([
                'title' => $title,
                'title2' => Util::textSimplization($title),
            ]);
            return $tag;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function find(int $id): Tag
    {
        $tag = Tag::find($id);
        if ($tag) {
            return $tag;
        } else {
            throw new NotFoundResourceException();
        }
    }

    function delete(int $id): bool|null
    {
        try {
            return Tag::find($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function index(Request $request): LengthAwarePaginator
    {
        return Tag::paginate();
    }

    function findOrCreate(string $title): Tag
    {
        $tag = Tag::where('title2', Util::textSimplization($title))->first();
        if ($tag) {
            return $tag;
        }
        return $this->create($title);
    }

    function all(Request $request)
    {
        return Tag::all();
    }
}
