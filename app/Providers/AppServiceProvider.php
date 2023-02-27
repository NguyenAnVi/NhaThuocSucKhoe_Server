<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // switch (strtoupper(PHP_OS)) {
        //     case 'WINNT':
        //         # code...
        //         error_log('Trying to start MySQL service on Windows');
        //         try {
        //             system('cmd /c net start mysql');
        //         } catch (\Throwable $th) {
        //             error_log('Can not start mysql with Window');
        //         }
        //         break;
        //     case 'LINUX':
        //         # code...
        //         error_log('Detect Linux OS - cannot start MYSQL Server autom');
        //         break;

        //     default:
        //         # code...
        //         break;
        // }
        
        
        Paginator::defaultView('partials/pagination');
 
        Paginator::defaultSimpleView('partials/simple-pagination');

        view()->composer('user.partials.lang', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        }); 
    }
}
