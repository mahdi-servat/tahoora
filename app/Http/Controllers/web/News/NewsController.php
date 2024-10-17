<?php

namespace App\Http\Controllers\web\News;

use App\Actions\Attachment\CreateAttachmentAction;
use App\Actions\News\CreateNewsAction;
use App\Actions\News\DeleteNewsAction;
use App\Actions\News\FindNewsAction;
use App\Actions\News\GetAllNewsAction;
use App\Actions\News\UpdateNewsAction;
use App\Http\Requests\News\CreateNewsRequest;
use App\Http\Requests\News\DeleteNewsRequest;
use App\Http\Requests\News\FindNewsRequest;
use App\Http\Requests\News\GetAllNewsRequest;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class NewsController extends AutoWebController
{
    public function getClass(): array
    {
        return [
            'indexRequest' => GetAllNewsRequest::class,
            'createRequest' => CreateNewsRequest::class,
            'editRequest' => FindNewsRequest::class,
            'storeRequest' => StoreNewsRequest::class,
            'updateRequest' => UpdateNewsRequest::class,
            'deleteRequest' => DeleteNewsRequest::class,
            'indexAction' => GetAllNewsAction::class,
            'createAction' => CreateNewsAction::class,
            'deleteAction' => DeleteNewsAction::class,
            'findAction' => FindNewsAction::class,
            'updateAction' => UpdateNewsAction::class,
            'form' => NewsForm::class,
            'viewPath' => 'admin.layouts.news',
            'routePrefix' => 'news',
            'list_title' => 'اخبار',
            'add_title' => 'خبر',
        ];
    }


    public function uploadThump(Request $request)
    {
        $_request = Request::create('test', 'post', [
            'file' => $request->thump,
            'title' => null,
            'attachment_type_id' => 1
        ]);

        $file = app(CreateAttachmentAction::class)->handle($_request);

        return $file->path;
    }

    public function getPastDataFa(Request $request)
    {
        $data = Http::get('https://mstfdn.org/api/modular/v1/content-post-lists?type=news&limit=999&including[]=title&including[]=title2&including[]=text&including[]=published_at&including[]=image&locales[]=fa&sort=published_at');

        $items = $data->json()['results'];

        DB::beginTransaction();
        try {
            foreach ($items as $item){
                News::create([
                    'language_id' => 2 ,
                    'title' => @$item['title'] ,
                    'title2' => str_replace(' ' , '' , @$item['title']),
                    'content' => @$item['text'] ,
                    'status_id' => 1 ,
                    'user_id' => 1,
                    'date' => Carbon::parse($item['published_at'])->format('Y-m-d') ,
                    'thump' => !empty($item['image']['link']) ? str_replace('https://api.mstfdn.org/files' , 'uploads/pastAttachments' , $item['image']['link']) : 0
                ]);
            }
            DB::commit();
            return true;

        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function getPastDataEn(Request $request)
    {
        $data = Http::get('https://mstfdn.org/api/modular/v1/content-post-lists?type=news&limit=999&including[]=title&including[]=title2&including[]=text&including[]=published_at&including[]=image&locales[]=en&sort=published_at');

        $items = $data->json()['results'];

        DB::beginTransaction();
        try {
            foreach ($items as $item){
                News::create([
                    'language_id' => 3 ,
                    'title' => @$item['title'] ,
                    'title2' => str_replace(' ' , '' , @$item['title']),
                    'content' => @$item['text'] ,
                    'status_id' => 1 ,
                    'user_id' => 1,
                    'date' => Carbon::parse($item['published_at'])->format('Y-m-d') ,
                    'thump' => !empty($item['image']['link']) ? str_replace('https://api.mstfdn.org/files' , 'uploads/pastAttachments' , $item['image']['link']) : 0
                ]);
            }
            DB::commit();
            return true;

        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function getPastDataAr(Request $request)
    {
        $data = Http::get('https://mstfdn.org/api/modular/v1/content-post-lists?type=news&limit=999&including[]=title&including[]=title2&including[]=text&including[]=published_at&including[]=image&locales[]=ar&sort=published_at');

        $items = $data->json()['results'];

        DB::beginTransaction();
        try {
            foreach ($items as $item){
                News::create([
                    'language_id' => 4 ,
                    'title' => @$item['title'] ,
                    'title2' => str_replace(' ' , '' , @$item['title']),
                    'content' => @$item['text'] ,
                    'status_id' => 1 ,
                    'user_id' => 1,
                    'date' => Carbon::parse($item['published_at'])->format('Y-m-d') ,
                    'thump' => !empty($item['image']['link']) ? str_replace('https://api.mstfdn.org/files' , 'uploads/pastAttachments' , $item['image']['link']) : 0
                ]);
            }
            DB::commit();
            return true;

        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
