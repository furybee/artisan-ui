<?php

namespace FuryBee\ArtisanUi;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use FuryBee\ArtisanUi\Concerns\ConfiguresArtisanUi;

class ArtisanUiServiceProvider extends ServiceProvider
{
    use ConfiguresArtisanUi;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middlewareGroup('artisan-ui', config('artisan-ui.middleware', []));

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'artisan-ui');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/artisan-ui.php' => config_path('artisan-ui.php'),
            ], 'artisan-ui-config');

            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/artisan-ui'),
            ], 'artisan-ui-assets');

            $this->publishes([
                __DIR__ . '/../stubs/ArtisanUiServiceProvider.stub' => app_path('Providers/ArtisanUiServiceProvider.php'),
            ], 'artisan-ui-provider');

            $this->commands([
                Console\InstallCommand::class,
                Console\PublishCommand::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/artisan-ui.php', 'artisan-ui');

        $this->ensureArtisanUiIsConfigured();
    }
}
