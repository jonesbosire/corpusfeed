<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            static $settings = null;
            if ($settings === null) {
                try {
                    $settings = Setting::all()->pluck('value', 'key')->toArray();
                } catch (\Exception $e) {
                    $settings = [];
                }
            }
            $view->with('settings', $settings);
        });
    }
}
