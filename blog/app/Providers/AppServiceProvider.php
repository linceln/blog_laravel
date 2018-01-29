<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // 设置时间语言格式为中文

        \Carbon\Carbon::setLocale('zh');

        // View Composer 为所有 sidebar 传输数据 archives

        view()->composer('layouts.sidebar', function($view){

            $view->with('archives', \App\Post::archives());

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
