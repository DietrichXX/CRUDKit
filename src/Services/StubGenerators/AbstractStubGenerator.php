<?php

namespace Dietrichxx\CrudKit\Services\StubGenerators;

use Illuminate\Support\Facades\File;

abstract class AbstractStubGenerator
{
    protected array $defaultNamespaces;

    /**
     * @param array $defaultNamespaces
     */
    public function __construct(array $defaultNamespaces)
    {
        $this->defaultNamespaces = $defaultNamespaces;
    }

    protected function getNamespace(string $path, string $type): string
    {
        $defaultNamespace = $this->defaultNamespaces[$type];
        if($path === '/'){
            return $defaultNamespace;
        }else{
            $classNamespace = $this->convertPathToNamespace($path);
            return $defaultNamespace.$classNamespace;
        }
    }

    protected function getUseNamespace(string $path, string $type, string $name): string
    {
        $defaultNamespace = $this->defaultNamespaces[$type];
        if($path === '/'){
            return $defaultNamespace.'\\'.$name;
        }else{
            $classNamespace = $this->convertPathToNamespace($path);
            return $defaultNamespace.$classNamespace.'\\'.$name;
        }
    }

    /**
     * @param $path
     * @return string
     */
    protected function convertPathToNamespace($path): string
    {
        return str_replace('/', '\\', $path);
    }

    /**
     * @param string $stubName
     * @return string
     */
    protected function getStub(string $stubName): string
    {
        return File::get(__DIR__."/../../resources/stubs/$stubName.stub");
    }
}
