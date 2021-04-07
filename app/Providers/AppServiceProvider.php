<?php

namespace App\Providers;

use App\Http\Resources\FileResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\ServiceProvider;

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
        UserResource::withoutWrapping();
        PostResource::withoutWrapping();
        FileResource::withoutWrapping();
        TagResource::withoutWrapping();
    }
}
