<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Attachment;

use App\Models\Attachment\AttachmentType;
use App\Repositories\AttachmentRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UpdateAttachmentAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(AttachmentRepositoryEloquent::class);
	}


	public function handle(Request $request , $id)
	{
        $data = $request->only([
            'title',
            'sort',
            'attachment_type_id',
            'description',
        ]);

        $data['title2'] = str_replace(' ', '', $data['title']);

        if ($request->has('file')) {
            $attachmentType = AttachmentType::find($data['attachment_type_id']);
            $file = $request->file;
            $type = $file->getMimeType();
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Attachments/'.$attachmentType->path_url, $fileName, 'uploads');
            $data['mime_type'] = $type;
            $data['path'] = 'uploads/' . $path;
        }

        return $this->repository->update($data , $id);
	}
}
