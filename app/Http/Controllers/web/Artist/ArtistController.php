<?php

namespace App\Http\Controllers\web\Artist;

use App\Actions\Artist\CreateArtistAction;
use App\Actions\Artist\DeleteArtistAction;
use App\Actions\Artist\FindArtistAction;
use App\Actions\Artist\GetAllArtistAction;
use App\Actions\Artist\UpdateArtistAction;
use App\Actions\Attachment\CreateAttachmentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\Web\CreateArtistRequest;
use App\Http\Requests\Artist\Web\DeleteArtistRequest;
use App\Http\Requests\Artist\Web\FindArtistRequest;
use App\Http\Requests\Artist\Web\GetAllArtistRequest;
use App\Http\Requests\Artist\Web\StoreArtistRequest;
use App\Http\Requests\Artist\Web\UpdateArtistRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class ArtistController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllArtistRequest::class ,
            'createRequest' => CreateArtistRequest::class ,
            'editRequest' => FindArtistRequest::class ,
            'storeRequest' => StoreArtistRequest::class ,
            'updateRequest' => UpdateArtistRequest::class ,
            'deleteRequest' => DeleteArtistRequest::class ,
            'indexAction' => GetAllArtistAction::class ,
            'createAction' => CreateArtistAction::class ,
            'deleteAction' => DeleteArtistAction::class,
            'findAction' => FindArtistAction::class,
            'updateAction' => UpdateArtistAction::class,
            'form' => ArtistForm::class,
            'viewPath' => 'admin.layouts.artist',
            'routePrefix' => 'artist',
            'list_title' => 'پزشکان',
            'add_title' => 'پزشک',
        ];
    }

    public function uploadFile(Request $request)
    {
        $attachmentRequest = Request::create('test', 'post', [
            'file' => $request->upload,
            'title' => "بارگذاری شده در پزشکان",
        ]);
        $file = app(CreateAttachmentAction::class)->handle($attachmentRequest);

        $data = [
            'id' => $file->id,
            'url' => env('APP_URL') . '/' . $file->path
        ];
        return json_encode($data);
    }

    public function getAttachmentRow(Request $request): View
    {
        $count = intval($request->count) + 1 ;

        return view('admin.layouts.artist.attachment-row' , ['count' => $count]);
    }
}
