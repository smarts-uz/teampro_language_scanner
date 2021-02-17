<?php

namespace TeamPro\TranslateScanner;
use Illuminate\Support\ServiceProvider;

class TranslateScannerServiceProvider extends ServiceProvider{

    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'translation'); // if you created translation.blade.php
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/translation.php', 'translation');
        $this->publishes([__DIR__ . '/config/translation.php' => config_path('translation.php')]);
    }

    public function register(){

    }

}

?>
