<?php

namespace App\Providers;

use App\Contracts\AttachmentServiceInterface;
use App\Contracts\AuthenticationServiceInterface;
use App\Contracts\CategoryServiceInterface;
use App\Contracts\CourseServiceInterface;
use App\Contracts\EventServiceInterface;
use App\Contracts\FormServiceInterface;
use App\Contracts\LessonServiceInterface;
use App\Contracts\NewsServiceInterface;
use App\Contracts\SectionServiceInterface;
use App\Contracts\TagServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\WebinarServiceInterface;
use App\Contracts\WishlistServiceInterface;
use App\Services\AttachmentService;
use App\Services\AuthenticationService;
use App\Services\CategoryService;
use App\Services\CourseService;
use App\Services\EventService;
use App\Services\FormService;
use App\Services\LessonService;
use App\Services\NewsService;
use App\Services\SectionService;
use App\Services\TagService;
use App\Services\UserService;
use App\Services\WebinarService;
use App\Services\WishlistService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AttachmentServiceInterface::class, AttachmentService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(CourseServiceInterface::class, CourseService::class);
        $this->app->bind(SectionServiceInterface::class, SectionService::class);
        $this->app->bind(LessonServiceInterface::class, LessonService::class);
        $this->app->bind(EventServiceInterface::class, EventService::class);
        $this->app->bind(NewsServiceInterface::class, NewsService::class);
        $this->app->bind(TagServiceInterface::class, TagService::class);
        $this->app->bind(WebinarServiceInterface::class, WebinarService::class);
        $this->app->bind(FormServiceInterface::class, FormService::class);
        $this->app->bind(WishlistServiceInterface::class, WishlistService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
