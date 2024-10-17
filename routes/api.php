<?php

use App\Http\Controllers\Api\Article\ArticleController;
use App\Http\Controllers\Api\Artist\ArtistController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Comment\CommentController;
use App\Http\Controllers\Api\Event\EventController;
use App\Http\Controllers\Api\Footer\FooterController;
use App\Http\Controllers\Api\Language\LanguageController;
use App\Http\Controllers\Api\Media\MediaController;
use App\Http\Controllers\Api\Menu\MenuController;
use App\Http\Controllers\Api\Museum\MuseumController;
use App\Http\Controllers\Api\News\NewsController;
use App\Http\Controllers\Api\Page\PageController;
use App\Http\Controllers\Api\Program\ProgramController;
use App\Http\Controllers\Api\Reserve\ReserveController;
use App\Http\Controllers\Api\Testimonials\TestimonialsController;
use App\Http\Controllers\web\ContactUs\ContactUsController;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------–------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('/v1')->group(function () {


    Route::prefix('authentication')->group(function () {
        Route::post('/verification', [AuthenticationController::class, 'sendVerificationCode']);
        Route::post('/', [AuthenticationController::class, 'authentication']);
        Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return new UserResource($request->user());
        });
    });

    Route::get('/run-migrations', function () {
        Artisan::call('migrate');
        return Artisan::output();
    });
    Route::get('/run-refresh/{migrationName}', function (Request $request) {
        Artisan::call('migrate:refresh  --path=database/migrations/' . $request->migrationName);
        return Artisan::output();
    });
    Route::get('/rollback', function () {
        Artisan::call('migrate:rollback');
        return Artisan::output();
    });
    Route::controller(ReserveController::class)->prefix('reserve')->group(function () {
        Route::get('getReserve', 'getReserve');
        Route::post('postReserve', 'postReserve');
        Route::get('/{id}/find', 'find')->name('api.reserve.find');
    });
    Route::controller(TestimonialsController::class)->prefix('testimonials')->group(function () {
        Route::get('/', 'index')->name('api.testimonials.index');
    });

    Route::controller(ContactUsController::class)->prefix('contact')->group(function () {
        Route::post('store', 'postContact');
        Route::get('/{id}/find', 'find');
    });


    Route::controller(NewsController::class)->prefix('news')->group(function () {
        Route::get('', 'index')->name('api.news.index');
        Route::get('/{id}/find', 'find')->name('api.news.find');
    });

    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('', 'index')->name('api.category.index');
        Route::get('/types', 'getAllType')->name('api.category.getAllType');
        Route::get('/{id}/find', 'find')->name('api.category.find');
    });

    Route::controller(LanguageController::class)->prefix('language')->group(function () {
        Route::get('', 'index')->name('api.language.index');
        Route::get('/{id}/find', 'find')->name('api.language.find');
        Route::get('/{key}/findByKey', 'findByKey')->name('api.language.findByKey');
        Route::get('/{key}/getPageSetting', 'getPageSettingAsKeyValue')->name('api.language.getPageSetting');
    });

    Route::controller(MediaController::class)->prefix('media')->group(function () {
        Route::get('', 'index')->name('api.media.index');
        Route::get('/{id}/find', 'find')->name('api.media.find');
    });

    Route::controller(ArticleController::class)->prefix('article')->group(function () {
        Route::get('', 'index')->name('api.article.index');
        Route::get('/{id}/find', 'find')->name('api.article.find');
    });

    Route::controller(PageController::class)->prefix('page')->group(function () {
        Route::get('', 'index')->name('api.page.index');
        Route::get('/{url}/find', 'find')->name('api.page.find');
    });



    Route::controller(MenuController::class)->prefix('menu')->group(function () {
        Route::get('', 'index')->name('api.menu.index');
        Route::get('/{id}/find', 'find')->name('api.menu.find');
    });

    Route::controller(FooterController::class)->prefix('footer')->group(function () {
        Route::get('', 'index')->name('api.footer.index');
        Route::get('/{id}/find', 'find')->name('api.footer.find');
    });

    Route::controller(ArtistController::class)->prefix('artist')->group(function () {
        Route::get('', 'index')->name('api.artist.index');
        Route::get('/{id}/find', 'find')->name('api.artist.find');
    });

    Route::controller(MuseumController::class)->prefix('museum')->group(function () {
        Route::get('', 'index')->name('api.museum.index');
        Route::get('/{id}/find', 'find')->name('api.museum.find');
    });

    Route::controller(ProgramController::class)->prefix('program')->group(function () {
        Route::get('', 'index')->name('api.program.index');
        Route::get('/{id}/find', 'find')->name('api.program.find');
    });

    Route::controller(EventController::class)->prefix('event')->group(function () {
        Route::get('', 'index')->name('api.event.index');
        Route::get('/{id}/find', 'find')->name('api.event.find');
    });
    Route::controller(CommentController::class)->prefix('comment')->group(function () {
        Route::get('/create', 'create')->name('api.comment.create');
        Route::post('/store', 'store')->name('api.comment.store');
    });

});
