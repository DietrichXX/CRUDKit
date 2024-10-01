<?php

namespace Dietrichxx\CrudKit\Services\StubGenerators;

class ControllerStubGenerator extends AbstractStubGenerator
{
    public function __construct(array $defaultNamespaces)
    {
        parent::__construct($defaultNamespaces);
    }

    public function generate(array $fileNames, array $directoryPaths): string
    {
        $stub = $this->getStub('crud-controller');

        $controller = $fileNames['controller'];
        $namespace = $this->getNamespace($directoryPaths['controller_path'], 'controller');

        $parentClass = class_basename(config('crudkit.parents.controller'));

        $request = $fileNames['request'];
        $requestNamespace = $this->getUseNamespace($directoryPaths['request_path'], 'request', $request);
        $requestVariable = lcfirst($fileNames['request']);

        $model = $fileNames['model'];
        $modelNamespace = $this->getUseNamespace($directoryPaths['model_path'], 'model', $model);
        $modelVariable = lcfirst($fileNames['model']);

        return str_replace(
                ['{{ class }}', '{{ namespace }}', '{{ parentClass }}',
                '{{ request }}', '{{ requestNamespace }}', '{{ requestVariable }}',
                '{{ model }}', '{{ modelNamespace }}', '{{ modelVariable }}'],
                [$controller, $namespace, $parentClass,
                $request, $requestNamespace, $requestVariable,
                $model, $modelNamespace, $modelVariable],
            $stub);
    }
}
