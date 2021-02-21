<?php

namespace TeamPro\TranslateScanner;
use Illuminate\Support\ServiceProvider;
use TeamPro\TranslateScanner\Commands\TranslationScanner;

class TranslateScannerServiceProvider extends ServiceProvider{

    public function boot(){

        if ($this->app->runningInConsole()) {
            $this->commands([
                TranslationScanner::class,
            ]);
        }

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'translation'); // if you created translation.blade.php
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/translation.php', 'translation');

        $this->publishes(
            [
                __DIR__.'/views' => base_path('resources/views'),
            ]);

        $this->publishes(
            [
                __DIR__.'/database/migrations' => database_path('migrations'),
            ], 'migrations');

        $this->publishes(
            [
                __DIR__.'/Http/Controllers' => base_path('app/Http/Controllers'),
            ]);

        $this->publishes(
            [
                __DIR__.'/config/translation.php' => config_path('translation.php')
            ], 'config');
    }

    // public function register(){
    //     $this->app->make('TeamPro\TranslateScanner\Http\Contollers\TranslateController');
    // }

}

?>
