<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class FooterResourcesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        view()->composer('layout.footer', function ($view) {
            $files = Storage::disk('public')->files('brochures') ?? [];

            $resources = array_map(function ($file) {
                return [
                    'filename' => basename($file),
                    'url' => Storage::url($file),
                ];
            }, $files);

            $view->with('resources', $resources);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
