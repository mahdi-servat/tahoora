<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Attachment;

use App\Models\Attachment\AttachmentType;
use App\Models\Country\Country;
use App\Models\Nomination\Nomination;
use App\Models\Nomination\NominationCategory;
use App\Models\Nomination\NominationUser;
use App\Repositories\AttachmentRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateAttachmentAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(AttachmentRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $request->only([
            'title',
            'sort',
            'attachment_type_id',
            'description',
        ]);

        $data['title2'] = str_replace(' ', '', $data['title']);

        if ($request->has('file')) {
            $file = $request->file;
            $type = $file->getMimeType();
            if (!empty($type) && $type == 'video/mp4'){
                $attachmentType = AttachmentType::find(2);
            }else{
                $attachmentType = AttachmentType::find(1);
            }
            $data['attachment_type_id'] = $attachmentType->id ;
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Attachments'.$attachmentType->path_url, $fileName, 'uploads');
            $data['mime_type'] = $type;
            $data['path'] = 'uploads/' . $path;
        }

        return $this->repository->create($data);
    }
}
