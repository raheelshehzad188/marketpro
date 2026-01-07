<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength(191);
    Paginator::useBootstrap();

    $currentDomain = request()->getHost();

    $domainConfig = collect(config('domains'))->firstWhere('domain', $currentDomain);
    
    // If no domain config found, use a default configuration
    if (!$domainConfig) {
        $domainConfig = [
            'domain' => $currentDomain,
            'shop_id' => 1, // Default shop ID
            'views' => [
                'home' => 'frontend.pages.home',
                'product_listing' => 'frontend.pages.product_listing',
            ],
            'settings' => [
                'site_name' => 'TM Racing',
                'theme_color' => 'blue',
            ],
        ];
    }

    // Share globally
    View::share('currentDomain', $currentDomain);
    View::share('domainConfig', $domainConfig); // Includes settings, views, etc.

    app()->singleton('currentDomain', function () use ($currentDomain) {
      return $currentDomain;
    });

    // Bind `domainConfig` to the service container
    app()->singleton('domainConfig', function () use ($domainConfig) {
      return $domainConfig;
    });

    // Optionally set a custom URL configuration per domain (e.g., asset or links)
   // URL::forceRootUrl(config('app.url')); // Optional based on your domain setup

    //When view::share
    // <h1>Welcome to {{ $domainConfig['settings']['site_name'] }}</h1>
    // <p>Theme color: {{ $domainConfig['settings']['theme_color'] }}</p>

    //In Controller:
    // $currentDomain = app('currentDomain'); // Access the bound domain
    //     $domainConfig = app('domainConfig');
    //     echo $domainConfig['view'];
    //     exit();

  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
