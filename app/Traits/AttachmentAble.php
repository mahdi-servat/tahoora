<?php

namespace App\Traits;

use App\Models\Attachment\Attachment;
use App\Models\Attachment\ModelAttachment;
use App\Models\Comment\Comment;
use App\Models\MetaTag\MetaTag;
use App\Models\MetaTag\ModelMetaTag;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait AttachmentAble
{

    public function attachments(): MorphToMany
    {
        return $this->morphToMany(Attachment::class, 'model', 'model_attachments')->orderBy('sort');
    }

    public function modelAttachments(): MorphMany
    {
        return $this->morphMany(ModelAttachment::class, 'model');
    }
}
