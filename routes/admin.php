<?php

use App\Http\Controllers\web\Article\ArticleController;
use App\Http\Controllers\web\Artist\ArtistController;
use App\Http\Controllers\web\Category\CategoryController;
use App\Http\Controllers\web\Comment\CommentController;
use App\Http\Controllers\web\Dashboard\DashboardController;
use App\Http\Controllers\web\Event\EventController;
use App\Http\Controllers\web\Footer\FooterController;
use App\Http\Controllers\web\Language\LanguageController;
use App\Http\Controllers\web\Media\MediaController;
use App\Http\Controllers\web\Menu\MenuController;
use App\Http\Controllers\web\Museum\MuseumController;
use App\Http\Controllers\web\News\NewsController;
use App\Http\Controllers\web\Page\PageController;
use App\Http\Controllers\web\PageSetting\PageSettingController;
use App\Http\Controllers\web\PageSetting\PageSettingDataController;
use App\Http\Controllers\web\Program\ProgramController;
use App\Http\Controllers\web\Role\RoleController;
use App\Http\Controllers\web\Slider\SliderController;
use App\Http\Controllers\web\SocialMedia\SocialMediaController;
use App\Http\Controllers\web\Testimonials\TestimonialsController;
use App\Http\Controllers\web\User\UserController;
use Illuminate\Support\Facades\Route;
use Mmwdali\ContainerBuilder\Generator;

Route::prefix('/admin')->middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/insight', [DashboardController::class, 'insight'])->name('admin.insight');


    Route::controller(TestimonialsController::class)->prefix('testimonial')->group(function () {
        Route::get('', 'index')->name('testimonial.index');
        Route::get('/create', 'create')->name('testimonial.create');
        Route::post('/store', 'store')->name('testimonial.store');
        Route::get('/edit/{id}', 'edit')->name('testimonial.edit');
        Route::post('/update/{id}', 'update')->name('testimonial.update');
        Route::get('/delete/{id}', 'destroy')->name('testimonial.destroy');
    });
    Route::controller(LanguageController::class)->prefix('languages')->group(function () {
        Route::get('', 'index')->name('languages.index');
        Route::get('/create', 'create')->name('languages.create');
        Route::post('/store', 'store')->name('languages.store');
        Route::get('/edit/{id}', 'edit')->name('languages.edit');
        Route::post('/update/{id}', 'update')->name('languages.update');
        Route::get('/delete/{id}', 'destroy')->name('languages.destroy');
    });

    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('', 'index')->name('category.index');
        Route::get('/create', 'create')->name('category.create');
        Route::post('/store', 'store')->name('category.store');
        Route::get('/edit/{id}', 'edit')->name('category.edit');
        Route::post('/update/{id}', 'update')->name('category.update');
        Route::get('/delete/{id}', 'destroy')->name('category.destroy');
    });


    Route::controller(NewsController::class)->prefix('news')->group(function () {
        Route::get('', 'index')->name('news.index');
        Route::get('/create', 'create')->name('news.create');
        Route::post('/store', 'store')->name('news.store');
        Route::get('/edit/{id}', 'edit')->name('news.edit');
        Route::post('/update/{id}', 'update')->name('news.update');
        Route::get('/delete/{id}', 'destroy')->name('news.destroy');
        Route::post('/upload-thump', 'uploadThump')->name('news.uploadThump');
        Route::get('/getPastDataFa', 'getPastDataFa')->name('news.getPastDataFa');
        Route::get('/getPastDataEn', 'getPastDataEn')->name('news.getPastDataEn');
        Route::get('/getPastDataAr', 'getPastDataAr')->name('news.getPastDataAr');

    });

    Route::controller(MediaController::class)->prefix('media')->group(function () {
        Route::get('', 'index')->name('media.index');
        Route::get('/create', 'create')->name('media.create');
        Route::get('/getAttachmentRow', 'getAttachmentRow')->name('media.getAttachmentRow');
        Route::post('/uploadFile', 'uploadFile')->name('media.uploadFile');
        Route::post('/store', 'store')->name('media.store');
        Route::get('/edit/{id}', 'edit')->name('media.edit');
        Route::post('/update/{id}', 'update')->name('media.update');
        Route::get('/delete/{id}', 'destroy')->name('media.destroy');
    });

    Route::controller(ArticleController::class)->prefix('article')->group(function () {
        Route::get('', 'index')->name('article.index');
        Route::get('/create', 'create')->name('article.create');
        Route::post('/store', 'store')->name('article.store');
        Route::get('/edit/{id}', 'edit')->name('article.edit');
        Route::post('/update/{id}', 'update')->name('article.update');
        Route::get('/delete/{id}', 'destroy')->name('article.destroy');
    });

    Route::controller(PageController::class)->prefix('page')->group(function () {
        Route::get('', 'index')->name('page.index');
        Route::get('/create', 'create')->name('page.create');
        Route::post('/store', 'store')->name('page.store');
        Route::get('/edit/{id}', 'edit')->name('page.edit');
        Route::post('/update/{id}', 'update')->name('page.update');
        Route::get('/delete/{id}', 'destroy')->name('page.destroy');
    });


    Route::controller(MenuController::class)->prefix('menu')->group(function () {
        Route::get('', 'index')->name('menu.index');
        Route::get('/create', 'create')->name('menu.create');
        Route::post('/store', 'store')->name('menu.store');
        Route::get('/edit/{id}', 'edit')->name('menu.edit');
        Route::post('/update/{id}', 'update')->name('menu.update');
        Route::get('/delete/{id}', 'destroy')->name('menu.destroy');
    });
    Route::controller(FooterController::class)->prefix('footer')->group(function () {
        Route::get('', 'index')->name('footer.index');
        Route::get('/create', 'create')->name('footer.create');
        Route::post('/store', 'store')->name('footer.store');
        Route::get('/edit/{id}', 'edit')->name('footer.edit');
        Route::post('/update/{id}', 'update')->name('footer.update');
        Route::get('/delete/{id}', 'destroy')->name('footer.destroy');
    });

    Route::controller(SocialMediaController::class)->prefix('socialMedia')->group(function () {
        Route::get('/chooseLanguage', 'chooseLanguage')->name('socialMedia.chooseLanguage');
        Route::get('/{key}/index', 'index')->name('socialMedia.index');
        Route::get('/{key}/{id}/edit', 'edit')->name('socialMedia.edit');
        Route::post('/{key}/{id}/update', 'update')->name('socialMedia.update');
    });

    Route::controller(PageSettingController::class)->prefix('pageSetting')->group(function () {
        Route::get('', 'index')->name('pageSetting.index');
        Route::get('/create', 'create')->name('pageSetting.create');
        Route::post('/store', 'store')->name('pageSetting.store');
        Route::get('/edit/{id}', 'edit')->name('pageSetting.edit');
        Route::post('/update/{id}', 'update')->name('pageSetting.update');
        Route::get('/delete/{id}', 'destroy')->name('pageSetting.destroy');
    });

    Route::controller(PageSettingDataController::class)->prefix('pageSettingData')->group(function () {
        Route::get('/chooseLanguage', 'chooseLanguage')->name('pageSettingData.chooseLanguage');
        Route::get('/{key}/index', 'index')->name('pageSettingData.index');
        Route::post('/{key}/update', 'update')->name('pageSettingData.update');
    });

    Route::controller(ArtistController::class)->prefix('artist')->group(function () {
        Route::get('', 'index')->name('artist.index');
        Route::get('/create', 'create')->name('artist.create');
        Route::post('/store', 'store')->name('artist.store');
        Route::post('/uploadFile', 'uploadFile')->name('artist.uploadFile');
        Route::get('/getAttachmentRow', 'getAttachmentRow')->name('artist.getAttachmentRow');
        Route::get('/edit/{id}', 'edit')->name('artist.edit');
        Route::post('/update/{id}', 'update')->name('artist.update');
        Route::get('/delete/{id}', 'destroy')->name('artist.destroy');
    });

    Route::controller(MuseumController::class)->prefix('service')->group(function () {
        Route::get('', 'index')->name('museum.index');
        Route::get('/create', 'create')->name('museum.create');
        Route::post('/store', 'store')->name('museum.store');
        Route::get('/edit/{id}', 'edit')->name('museum.edit');
        Route::get('/find/{id}', 'find')->name('museum.find');
        Route::post('/update/{id}', 'update')->name('museum.update');
        Route::get('/delete/{id}', 'destroy')->name('museum.destroy');
    });
    Route::controller(ProgramController::class)->prefix('program')->group(function () {
        Route::get('', 'index')->name('program.index');
        Route::get('/create', 'create')->name('program.create');
        Route::post('/store', 'store')->name('program.store');
        Route::get('/edit/{id}', 'edit')->name('program.edit');
        Route::post('/update/{id}', 'update')->name('program.update');
        Route::get('/delete/{id}', 'destroy')->name('program.destroy');
    });


    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('', 'index')->name('user.index');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/edit/{id}', 'edit')->name('user.edit');
        Route::post('/update/{id}', 'update')->name('user.update');
        Route::get('/delete/{id}', 'destroy')->name('user.destroy');

        Route::get('/profile', 'profileShow')->name('user.profile.show');
        Route::post('/profile/update', 'profileUpdate')->name('user.profile.update');

    });

    Route::controller(RoleController::class)->prefix('role')->group(function () {
        Route::get('', 'index')->name('role.index');
        Route::get('/create', 'create')->name('role.create');
        Route::post('/store', 'store')->name('role.store');
        Route::get('/edit/{id}', 'edit')->name('role.edit');
        Route::post('/update/{id}', 'update')->name('role.update');
        Route::get('/delete/{id}', 'destroy')->name('role.destroy');
    });

    Route::controller(EventController::class)->prefix('event')->group(function () {
        Route::get('', 'index')->name('event.index');
        Route::get('/create', 'create')->name('event.create');
        Route::post('/store', 'store')->name('event.store');
        Route::get('/edit/{id}', 'edit')->name('event.edit');
        Route::post('/update/{id}', 'update')->name('event.update');
        Route::get('/delete/{id}', 'destroy')->name('event.destroy');
    });

    Route::controller(CommentController::class)->prefix('comment')->group(function () {
        Route::get('', 'index')->name('comment.index');
        Route::get('/edit/{id}', 'edit')->name('comment.edit');
        Route::post('/update/{id}', 'update')->name('comment.update');
    });

    Route::controller(SliderController::class)->prefix('slider')->group(function () {
        Route::get('', 'index')->name('slider.index');
        Route::get('/create', 'create')->name('slider.create');
        Route::post('/store', 'store')->name('slider.store');
        Route::get('/edit/{id}', 'edit')->name('slider.edit');
        Route::post('/update/{id}', 'update')->name('slider.update');
        Route::get('/delete/{id}', 'destroy')->name('slider.destroy');

    });
});
