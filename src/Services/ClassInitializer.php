<?php

namespace Dietrichxx\CrudKit\Services;

use Dietrichxx\CrudKit\Exceptions\ClassExistsException;
use Dietrichxx\CrudKit\Helpers\NamingTransformer;
use Dietrichxx\CrudKit\Services\StubGenerators\ControllerStubGenerator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class ClassInitializer
{
    protected object $controllerStubGenerator;
    protected object $namingTransformer;
    protected array $defaultPaths;

    public function __construct(ControllerStubGenerator $controllerStubGenerator, NamingTransformer $namingTransformer, array $defaultPaths){
        $this->controllerStubGenerator = $controllerStubGenerator;
        $this->namingTransformer = $namingTransformer;
        $this->defaultPaths = $defaultPaths;
    }

    /**
     * @throws ClassExistsException
     */
    public function init(array $fileNames, array $directoryPaths): void
    {
        $this->makeModel($fileNames['model'], $directoryPaths['model_path']);
        $this->makeRequest($fileNames['request'], $directoryPaths['request_path']);
        $this->makeController($fileNames, $directoryPaths);
        $this->makeMigration($fileNames['migration']);
    }

    /**
     * @param string $modelName
     * @param string $modelPath
     * @return void
     * @throws ClassExistsException
     */
    protected function makeModel(string $modelName, string $modelPath): void
    {
        $defaultPath = $this->defaultPaths['model'];
        $fullPath = app_path("{$defaultPath}{$modelPath}/{$modelName}.php");

        $this->checkClassExists($modelName, $fullPath);

        Artisan::call("make:model {$modelPath}/{$modelName}");
    }

    /**
     * @param string $requestName
     * @param string $requestPath
     * @return void
     * @throws ClassExistsException
     */
    protected function makeRequest(string $requestName, string $requestPath): void
    {
        $defaultPath = $this->defaultPaths['request'];

        $fullPath = app_path("{$defaultPath}{$requestPath}/{$requestName}.php");
        $this->checkClassExists($requestName, $fullPath);

        Artisan::call("make:request {$requestPath}/{$requestName}");
    }

    /**
     * @param array $fileNames
     * @param array $directoryPaths
     * @return void
     * @throws ClassExistsException
     */
    protected function makeController(array $fileNames, array $directoryPaths): void
    {
        $defaultPath = $this->defaultPaths['controller'];
        $controllerPath = $directoryPaths['controller_path'];
        $controllerName = $fileNames['controller'];

        $fullPath = app_path("{$defaultPath}{$controllerPath}/{$controllerName}.php");
        $this->checkClassExists($controllerName, $fullPath);
        $this->makeDirectoryOnPath($fullPath);

        $content = $this->controllerStubGenerator->generate($fileNames, $directoryPaths);

        File::put($fullPath, $content);
    }

    /**
     * @param string $migrationName
     * @return void
     */
    protected function makeMigration(string $migrationName): void
    {
        Artisan::call("make:migration {$migrationName}");
    }

    /**
     * @param string $className
     * @param string $fullPath
     * @return void
     * @throws ClassExistsException
     */
    protected function checkClassExists(string $className, string $fullPath): void
    {
        if (File::exists($fullPath)) {
            throw new ClassExistsException($className, $fullPath);
        }
    }

    /**
     * @param string $fullPath
     * @return void
     */
    protected function makeDirectoryOnPath(string $fullPath): void
    {
        $directory = dirname($fullPath);
        File::makeDirectory($directory, 0777, true, true);
    }
}
