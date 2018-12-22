<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Advantages;
use App\Models\Article;
use App\Models\Banner;
use App\Models\Building;
use App\Models\Review;
use App\Models\Stock;

Auth::routes();
Route::get(
    'setlocale/{lang}',
    function ($lang) {

        $referer = Redirect::back()->getTargetUrl(); //URL предыдущей страницы
        $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

        //разбиваем на массив по разделителю
        $segments = explode('/', $parse_url);

        //Если URL (где нажали на переключение языка) содержал корректную метку языка
        if (in_array($segments[1], App\Http\Middleware\Locale::$languages)) {

            unset($segments[1]); //удаляем метку
        }

        //Добавляем метку языка в URL (если выбран не язык по-умолчанию)
        if ($lang != App\Http\Middleware\Locale::$mainLanguage) {
            array_splice($segments, 1, 0, $lang);
        }

        //формируем полный URL
        $url = Request::root() . implode("/", $segments);

        //если были еще GET-параметры - добавляем их
        if (parse_url($referer, PHP_URL_QUERY)) {
            $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
        }

        return redirect($url); //Перенаправляем назад на ту же страницу

    }
)->name('setlocale');


//Front Side Site
Route::group(
    [
        'prefix' => App\Http\Middleware\Locale::getLocale()
        /*, 'middleware' => 'reconstr'*/
    ],
    function () {

        foreach (\App\Models\StaticPages::wherePublished(1)->get() as $page) {
            /** @var \App\Models\StaticPages $page */
            Route::get(
                '/' . $page->slug,
                function () use ($page) {
                    $include = [];
                    switch ($page->id) {
                        case 1:
                            return redirect()->route('home');
                            break;
                        case 5:
                            $stocks = Stock::query()->whereActive(1)->orderBy('priority')->paginate(6);
                            $include = ['stocks' => $stocks];
                            break;
                        case 6:
                            $newss = Article::query()->whereActive(1)->orderBy('priority')->paginate(6);
                            $include = ['newss' => $newss];
                            break;
                    }

                    return view('front.pages.' . ($page->template ?? $page->id))->with(
                        array_merge(['model' => $page], $include)
                    );
                }
            )->name($page->slug)->middleware('tech');
        }
        Route::get('/', 'Site\SiteController@index')->name('home');
        Route::get('/stock/{stockslug}', 'Site\SiteController@stockPage')->name('stock-page');
        Route::get('/news/{articleslug}', 'Site\SiteController@newsPage')->name('news-page');

        Route::post('/send-mail', 'Site\MailController@footerMail')->name('footer.send');
        Route::post('/send-contact', 'Site\MailController@contactMail')->name('footer.contact');
        Route::post('/send-request', 'Site\MailController@contactMail')->name('header.request');
        Route::post('/send-main', 'Site\MailController@mainMail')->name('main-mail');
        Route::get('/technical', 'Site\TechController@index')->name('tech');

        Route::group(
            [
                'prefix'     => 'admin',
                'middleware' => 'auth',
            ],
            function () {
                Route::view('/', 'admin.dashboard')->name('admin');

                Route::resource('pages', 'Admin\StaticPagesController');
                Route::resource('reviews', 'Admin\ReviewsController');
                Route::resource('advantage', 'Admin\AdvantagesController');
                Route::resource('menus', 'Admin\MenuController');
                Route::resource('banners', 'Admin\BannersController');
                Route::resource('tariffs', 'Admin\TariffsController');
                Route::resource('services', 'Admin\ServicesController');
                Route::resource('categorys', 'Admin\CategoryController');
                Route::resource('questions', 'Admin\QuestionsController');
                Route::resource('stocks', 'Admin\StocksController');
                Route::resource('articles', 'Admin\NewsController');
                Route::resource('buildings', 'Admin\BuildingsController');
                Route::resource('users', 'Admin\UsersController')->except('show');
                Route::resource('callbacks', 'Admin\CallbacksController')->only('edit', 'update', 'index');
                Route::resource('buttons', 'Admin\ButtonsController')->only('edit', 'update', 'index');
                Route::resource('technical', 'Admin\TechnicalController')->only('edit', 'update', 'index');
                Route::resource('partition', 'Admin\PartitionController')->except('delete', 'show');
                Route::resource('channel', 'Admin\ChannelController')->except('delete', 'show');

                Route::post('buildings-csv', 'Admin\BuildingsController@parseCSV')->name('buildings.parseCSV');

                Route::post('/pages/switch-pub/{page}', 'Admin\StaticPagesController@switchPub')->name('pages.switchPub');
                Route::post('/reviews/switch-pub/{review}', 'Admin\ReviewsController@switchPub')->name('reviews.switchPub');
                Route::post('/advantages/switch-pub/{advantage}', 'Admin\AdvantagesController@switchPub')->name('advantages.switchPub');
                Route::any('/banners/switch-pub/{banner}', 'Admin\BannersController@switchPub')->name('banners.switchPub');
                Route::any('/stocks/switch-pub/{stock}', 'Admin\StocksController@switchPub')->name('stocks.switchPub');

            }
        );


        Route::get('/translations/{groupKey?}', '\Barryvdh\TranslationManager\Controller@getIndex')->name('admin.translations');
        Route::get('/translations/view/{groupKey?}', '\Barryvdh\TranslationManager\Controller@getView');
        Route::get('/translations/add/{groupKey}', '\Barryvdh\TranslationManager\Controller@postAdd');
        Route::get('/translations/edit/{groupKey}', '\Barryvdh\TranslationManager\Controller@postEdit');
        Route::get('/translations/delete/{groupKey}/{translationKey}', '\Barryvdh\TranslationManager\Controller@postDelete');

        Route::post('/objects/{offset?}/{limit?}', 'Site\MapController@getBuildings')->name('get.buildings.ajax');
    }
);
Route::get(
    '/objects_{lang}.js',
    function ($lang) {
        $strings = Cache::remember(
            'objects_' . $lang . '.js',
            1,
            function () use ($lang) {
                $strings = Cache::remember(
                    'objects_' . $lang . '.js',
                    60,
                    function () use ($lang) {
                        app()->setLocale($lang);

                        $string = Building::query()->get()->map(
                            function ($mod) {
                                /** @var Building $mod */
                                $mod->load('lang');
                                $point = $mod->points[0];
                                $build = [
                                    round($point['pointX'], 6),
                                    round($point['pointY'], 6),
                                    $mod->name
                                ];
                                return $build;
                            });
                        return $string->toJson(JSON_UNESCAPED_UNICODE);
                    }
                );

                header('Content-Type: text/javascript');
                echo('window.addressPoints = ' . $strings . ';');
                exit();
            });
    }
)->name('assets.objects');