<?php

namespace App\Providers;

use App\Models\Advantages;
use App\Models\Banner;
use App\Models\Building;
use App\Models\Category;
use App\Models\Article;
use App\Models\Channel;
use App\Models\Partition;
use App\Models\Question;
use App\Models\Review;
use App\Models\Service;
use App\Models\StaticPages;
use App\Models\Stock;
use App\Models\Tariff;
use App\Models\Technical;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        Route::model('page', StaticPages::class);
        Route::model('review', Review::class);
        Route::model('building', Building::class);
        Route::model('advantage', Advantages::class);
        Route::model('banner', Banner::class);
        Route::model('tariff', Tariff::class);
        Route::model('service', Service::class);
        Route::model('category', Category::class);
        Route::model('question', Question::class);
        Route::model('stock', Stock::class);
        Route::model('article', Article::class);
        Route::model('technical', Technical::class);
        Route::model('partition', Partition::class);
        Route::model('channel', Channel::class);
        Route::bind(
            'stockslug',
            function ($val) {
                return Stock::where('slug', $val)->first();
            }
        );
        Route::bind(
            'articleslug',
            function ($val) {
                return Article::where('slug', $val)->first();
            }
        );

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
