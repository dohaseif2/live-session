<?php

namespace App\Providers;

use App\Services\Contracts\ZoomServiceInterface;
use App\Services\ZoomService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ZoomServiceInterface::class, ZoomService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
