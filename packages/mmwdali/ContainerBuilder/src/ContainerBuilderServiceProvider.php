<?php

namespace Mmwdali\ContainerBuilder ;

use Illuminate\Support\ServiceProvider;

class ContainerBuilderServiceProvider extends ServiceProvider{

    public function register() {
        $this->app->bind('ContainerBuilder' , function(){
            return new Generator ;
        });
    }

    public function boot()
    {
//        if ($this->app->runningInConsole()) {
//            $this->commands([
//                container::class,
//            ]);
//        }
        $this->publishes([
            __DIR__.'/commands' => base_path('app/Console/Commands')
        ]);
//        $this->commands([container::class]);
    }
}
