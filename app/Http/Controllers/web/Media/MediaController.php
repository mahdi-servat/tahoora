<?php

namespace App\Http\Controllers\web\Media;

use App\Actions\Attachment\CreateAttachmentAction;
use App\Actions\Media\CreateMediaAction;
use App\Actions\Media\DeleteMediaAction;
use App\Actions\Media\FindMediaAction;
use App\Actions\Media\GetAllMediaAction;
use App\Actions\Media\UpdateMediaAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\Web\CreateMediaRequest;
use App\Http\Requests\Media\Web\DeleteMediaRequest;
use App\Http\Requests\Media\Web\FindMediaRequest;
use App\Http\Requests\Media\Web\GetAllMediaRequest;
use App\Http\Requests\Media\Web\StoreMediaRequest;
use App\Http\Requests\Media\Web\UpdateMediaRequest;
use App\Models\Attachment\Attachment;
use App\Models\Attachment\ModelAttachment;
use App\Models\Media\Media;
use App\Models\News\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class MediaController extends AutoWebController
{
    public function getClass(): array
    {
        return [
            'indexRequest' => GetAllMediaRequest::class,
            'createRequest' => CreateMediaRequest::class,
            'editRequest' => FindMediaRequest::class,
            'storeRequest' => StoreMediaRequest::class,
            'updateRequest' => UpdateMediaRequest::class,
            'deleteRequest' => DeleteMediaRequest::class,
            'indexAction' => GetAllMediaAction::class,
            'createAction' => CreateMediaAction::class,
            'deleteAction' => DeleteMediaAction::class,
            'findAction' => FindMediaAction::class,
            'updateAction' => UpdateMediaAction::class,
            'form' => MediaForm::class,
            'viewPath' => 'admin.layouts.media',
            'routePrefix' => 'media',
            'list_title' => 'رسانه',
            'add_title' => 'رسانه',
        ];
    }


    public function uploadFile(Request $request)
    {
        $attachmentRequest = Request::create('test', 'post', [
            'file' => $request->upload,
            'title' => "بارگذاری شده در رسانه",
        ]);
        $file = app(CreateAttachmentAction::class)->handle($attachmentRequest);

        $data = [
            'id' => $file->id,
            'url' => env('APP_URL') . '/' . $file->path
        ];
        return json_encode($data);
    }

    public function getAttachmentRow(Request $request)
    {
        $count = intval($request->count) + 1 ;
        return view('admin.layouts.media.attachment-row' , ['count' => $count]);
    }

}
