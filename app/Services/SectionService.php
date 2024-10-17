<?php

namespace App\Services;

use App\Classes\Util;
use App\Contracts\SectionServiceInterface;
use App\Enums\SectionTypeEnum;
use App\Exceptions\NotFoundResourceException;
use App\Models\Section;
use Illuminate\Support\Collection;

class SectionService implements SectionServiceInterface
{
    function create($description, string $type, string $modelType, int $modelId)
    {
        \DB::beginTransaction();
        try {
            $section = null;
            if (strlen($description) > 20 || $type == SectionTypeEnum::pivot)
                $section = Section::create([
                    'model_type' => Util::getModelType($modelType),
                    'model_id' => $modelId,
                    'type' => $type,
                    'title' => $modelType . '_' . $modelId . '_' . $type,
                    'description' => $description,]);
            \DB::commit();
            return $section;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function update(int $id, $description)
    {
        \DB::beginTransaction();
        try {
            $section = $this->find($id);
            if (strlen($description) < 20 && $section->type != SectionTypeEnum::pivot)
                return $this->delete($id);
            $section->update([
                'description' => $description,
            ]);
            \DB::commit();
            return $section;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function find(int $id): Section
    {
        $section = Section::find($id);
        if ($section) {
            return $section;
        } else {
            throw new NotFoundResourceException();
        }
    }

    function delete(int $id): bool|null
    {
        try {
            return Section::find($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function index(string $modelType, int $modelId): Collection
    {
        return Section::where([['model_type', Util::getModelType($modelType)], ['model_id', $modelId]])->orderBy('sort')->get();
    }

}
