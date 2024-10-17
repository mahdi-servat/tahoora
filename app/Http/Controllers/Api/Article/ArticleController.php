<?php

namespace App\Http\Controllers\Api\Article;

use App\Actions\Article\FindArticleAction;
use App\Actions\Article\GetAllArticleAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleCollection;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $data = app(GetAllArticleAction::class)->handle($request);

        return new ArticleCollection($data);
    }

    public function find(Request $request)
    {
        $request->content_type = "api";

        $data = app(FindArticleAction::class)->handle($request);

        $related = $data->relatedItems();

        $data = (new ArticleResource($data))->resolve();
        $data['related'] = (new ArticleCollection($related))->resolve()['data'];

        return $data;
    }
}
