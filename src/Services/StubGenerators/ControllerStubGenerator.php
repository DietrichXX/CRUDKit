<?php

namespace Dietrichxx\CrudKit\Services\StubGenerators;

use Illuminate\Support\Str;

class ControllerStubGenerator extends AbstractStubGenerator
{
    public function __construct(array $defaultNamespaces)
    {
        parent::__construct($defaultNamespaces);
    }

    /**
     * @param array $fileNames
     * @param array $directoryPaths
     * @return string
     */
    public function generate(array $fileNames, array $directoryPaths): string
    {
        $controller = $fileNames['controller'];
        $namespace = $this->getNamespace($directoryPaths['controller_path'], 'controller');

        $parentClass = class_basename(config('crudkit.parents.controller'));
        $parentNamespace = config('crudkit.parents.controller');

        $request = $fileNames['request'];
        $requestNamespace = $this->getUseNamespace($directoryPaths['request_path'], 'request', $request);
        $requestVariable = lcfirst($fileNames['request']);

        $model = $fileNames['model'];
        $modelNamespace = $this->getUseNamespace($directoryPaths['model_path'], 'model', $model);
        $modelVariable = lcfirst($fileNames['model']);

        $stub = $this->selectStub($namespace, $parentNamespace);

        return str_replace(
                ['{{ class }}', '{{ namespace }}', '{{ parentClass }}',
                '{{ request }}', '{{ requestNamespace }}', '{{ requestVariable }}',
                '{{ model }}', '{{ modelNamespace }}', '{{ modelVariable }}'],
                [$controller, $namespace, $parentClass,
                $request, $requestNamespace, $requestVariable,
                $model, $modelNamespace, $modelVariable],
            $stub);
    }

    /**
     * @param string $namespace
     * @param string $parentNamespace
     * @return string
     */
    protected function selectStub(string $namespace, string $parentNamespace): string
    {
        if ($namespace === Str::beforeLast($parentNamespace, '\\')) {
            return $this->getStub('crud-controller.same_namespace');
        } else {
            $stub = $this->getStub('crud-controller.different_namespace');
            return str_replace('{{ parentNamespace }}', $parentNamespace, $stub);
        }
    }
}
