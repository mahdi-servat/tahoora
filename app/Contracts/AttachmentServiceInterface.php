<?php

namespace App\Contracts;

use App\Enums\AttachmentLinkTypeEnum;
use App\Enums\AttachmentTypeEnum;
use App\Models\Attachment;

interface AttachmentServiceInterface
{
    function changeSort($attachments_sorts);

    function create($file, string $title, string $modelType, int $modelId, string $typeEnum, string $linkTypeEnum): Attachment;

    function createWithThumb($file, $thumb, string $title, string $subTitle, string $modelType, int $modelId, string $typeEnum, string $linkTypeEnum): Attachment;

    function multiCreate(array $attachments, string $modelType, int $modelId);

    function delete(int $id): bool|null;

    function deleteByModel(string $modelType, int $modelId, string|null $type = null): bool|null;
}
