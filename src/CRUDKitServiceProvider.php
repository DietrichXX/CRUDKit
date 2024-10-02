<?php

namespace Dietrichxx\CrudKit;

use Dietrichxx\CrudKit\Console\Commands\InitCRUDKit;
use Dietrichxx\CrudKit\Exceptions\Handler;
use Dietrichxx\CrudKit\Helpers\NamingTransformer;
use Dietrichxx\CrudKit\Services\StubGenerators\ControllerStubGenerator;
use Dietrichxx\CrudKit\Services\ClassInitializer;
use Dietrichxx\CrudKit\Services\StubGenerators\ModelStubGenerator;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class CRUDKitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->commands([
            InitCRUDKit::class
        ]);

        $this->app->singleton(ExceptionHandler::class, Handler::class);

        $this->app->singleton(ClassInitializer::class, function ($app) {

            $defaultPaths = [
                'model' => 'Models',
                'controller' => 'Http/Controllers',
                'request' => 'Http/Requests'
            ];

            return new ClassInitializer(
                $app->make(ControllerStubGenerator::class),
                $app->make(ModelStubGenerator::class),
                $app->make(NamingTransformer::class),
                $defaultPaths
            );
        });

        $this->app->singleton(ControllerStubGenerator::class, function () {

            $defaultNamespace = [
                'controller' => app()->getNamespace() . "Http\Controllers",
                'model' => app()->getNamespace() . "Models",
                'request' => app()->getNamespace() . "Http\Requests",
            ];

            return new ControllerStubGenerator($defaultNamespace);
        });

        $this->app->singleton(ModelStubGenerator::class, function () {

            $defaultNamespace = [
                'controller' => app()->getNamespace() . "Http\Controllers",
                'model' => app()->getNamespace() . "Models",
                'request' => app()->getNamespace() . "Http\Requests",
            ];

            return new ModelStubGenerator($defaultNamespace);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/crudkit.php' => config_path('crudkit.php'),
        ], 'config');
    }
}
