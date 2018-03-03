<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Redis;

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
            $archives = Post::archivesCached();
            $tags = Tag::tagsCached();
        
            $view->with(compact('archives', 'tags'));
        });

        view()->composer('layouts.nav', function($view){
            $view->with('visits', Redis::get('visits'));
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
