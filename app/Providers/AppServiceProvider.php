<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GalleryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Repositories\Interfaces\GalleryRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\ScrollerRepositoryInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use App\Repositories\Interfaces\SliderRepositoryInterface;
use App\Repositories\Interfaces\VideoRepositoryInterface;
use App\Repositories\Interfaces\WebSettingRepositoryInterface;
use App\Repositories\LinkRepository;
use App\Repositories\MenuRepository;
use App\Repositories\PageRepository;
use App\Repositories\PostRepository;
use App\Repositories\ScrollerRepository;
use App\Repositories\ServiceRepository;
use App\Repositories\SliderRepository;
use App\Repositories\VideoRepository;
use App\Repositories\WebSettingRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(EloquentRepositoryInterface::class,BaseRepository::class);
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);
        $this->app->bind(LinkRepositoryInterface::class,LinkRepository::class);
        $this->app->bind(PageRepositoryInterface::class,PageRepository::class);
        $this->app->bind(VideoRepositoryInterface::class,VideoRepository::class);
        $this->app->bind(WebSettingRepositoryInterface::class,WebSettingRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class,ServiceRepository::class);
        $this->app->bind(ScrollerRepositoryInterface::class,ScrollerRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class,GalleryRepository::class);
        $this->app->bind(ImageRepositoryInterface::class,ImageRepository::class);
        $this->app->bind(MenuRepositoryInterface::class,MenuRepository::class);
        $this->app->bind(SliderRepositoryInterface::class,SliderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
