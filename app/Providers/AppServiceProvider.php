<?php

namespace App\Providers;

use App\Button;
use App\Models\Menu;
use App\Models\Partition;
use App\Models\StaticPages;
use App\Models\Technical;
use DB;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Lang;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(
            BuildingMenu::class,
            function (BuildingMenu $event) {
                $event->menu->add('MAIN NAVIGATION');
                $event->menu->add(
                    [
                        'text' => Lang::get('menu.menu'),
                        'url'  => route('menus.index'),
                        'icon' => 'laptop',
                    ]
                );
                $event->menu->add(
                    [
                        'text'    => Lang::get('menu.pages'),
                        //                        'url'  => 'admin/pages',
                        'icon'    => 'table',
                        'submenu' => StaticPages::orderBy('id','asc')->get()->map(
                        /**
                         * @param StaticPages $model
                         *
                         * @return array
                         */
                            function ($model) {
                                $arr = [
                                    'text' => $model->name,
                                    'url'  => route('pages.edit', $model->id),
                                    'icon' => 'file-text',
                                ];

                                return $arr;
                            }
                        )->toArray(),
                    ]
                );
                /*$event->menu->add(
                    [
                        'text'    => Lang::get('menu.main'),
                        'icon'    => 'clone',
                        'submenu' => [
                            [
                                'text' => Lang::get('menu.reviews'),
                                'url'  => route('reviews.index'),
                                'icon' => 'tasks',
                            ],
                            [
                                'text' => Lang::get('menu.advantages'),
                                'url'  => route('advantage.index', ['visible' => 'in_main']),
                                'icon' => 'tasks',
                            ],
                            [
                                'text' => Lang::get('menu.banners'),
                                'url'  => route('banners.index'),
                                'icon' => 'tasks',
                            ],
                        ],
                    ]
                );*/
                /*$event->menu->add(
                    [
                        'text'    => Lang::get('menu.internet'),
                        'icon'    => 'clone',
                        'submenu' => [
                            [
                                'text' => Lang::get('menu.tariffs'),
                                'url'  => route('tariffs.index'),
                                'icon' => 'tasks',
                            ],
                            [
                                'text' => Lang::get('menu.advantages'),
                                'url'  => route('advantage.index',['visible' => 'in_internet']),
                                'icon' => 'tasks',
                            ],
                            [
                                'text' => Lang::get('menu.services'),
                                'url'  => route('services.index'),
                                'icon' => 'tasks',
                            ],
                        ],
                    ]
                );*/
                $event->menu->add(
                    [
                        'text' => Lang::get('admins.stocks'),
                        'icon' => 'gavel',
                        'url'  => route('stocks.index'),

                    ]
                );
                $event->menu->add(
                    [
                        'text' => ucfirst(Lang::get('admins.newss')),
                        'icon' => 'th',
                        'url'  => route('articles.index'),

                    ]
                );
                $event->menu->add(
                    [
                        'text' => ucfirst(Lang::get('admins.users')),
                        'icon' => 'users',
                        'url'  => route('users.index'),

                    ]
                );
                $event->menu->add(
                    [
                        'text' => ucfirst(Lang::get('admins.callbacks')),
                        'icon' => 'mail-reply-all',
                        'url'  => route('callbacks.index'),

                    ]
                );
                $event->menu->add(
                    [
                        'text' => ucfirst(Lang::get('admins.translations')),
                        'icon' => 'wheelchair',
                        'url'  => route('admin.translations'),

                    ]
                );

                $event->menu->add(
                    [
                        'text' => ucfirst(Lang::get('admins.buttons')),
                        'icon' => 'sign-in',
                        'url'  => route('buttons.index'),

                    ]
                );

                $event->menu->add(
                    [
                        'text' => ucfirst(Lang::get('admins.technical')),
                        'icon' => 'cogs',
                        'url'  => route('technical.index'),

                    ]
                );

            }
        );

        View::composer(array('front.header'), function ($view) {
            $view->with('menus', Menu::getActive())
                 ->with('login_block', Button::getLoginBlock());
        });

        View::composer(array('front.foot'), function ($view) {
            $view->with('technical', Technical::getEngineering())
            ;
        });


        View::composer(array('front.pages.televidenie'), function ($view) {
            $view->with('partitions', Partition::getAllowed());
        });

        Schema::defaultStringLength(191);
        DB::listen(
            function ($query) {

//            dump($query->sql);
//                echo '<h1>'.$query->sql.'</h1>';

            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
