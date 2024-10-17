<?php

namespace App\Http\Controllers\Api\News;

use App\Actions\Attachment\CreateAttachmentAction;
use App\Actions\News\CreateNewsAction;
use App\Actions\News\DeleteNewsAction;
use App\Actions\News\FindNewsAction;
use App\Actions\News\GetAllNewsAction;
use App\Actions\News\UpdateNewsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateNewsRequest;
use App\Http\Requests\News\DeleteNewsRequest;
use App\Http\Requests\News\FindNewsRequest;
use App\Http\Requests\News\GetAllNewsRequest;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\News\NewsCollection;
use App\Http\Resources\News\NewsResource;
use Illuminate\Http\Request;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $data = app(GetAllNewsAction::class)->handle($request);

        return new NewsCollection($data);
    }

    public function find(Request $request)
    {
        $request->content_type = "api";
        $data = app(FindNewsAction::class)->handle($request);
        $related = $data->relatedItems();
        $data = (new NewsResource($data))->resolve();
        $data['related'] = (new NewsCollection($related))->resolve()['data'];

        return $data;
    }

}
