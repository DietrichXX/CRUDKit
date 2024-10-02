<?php

namespace Dietrichxx\CrudKit\Services\StubGenerators;

class ModelStubGenerator extends AbstractStubGenerator
{
    public function __construct(array $defaultNamespaces)
    {
        parent::__construct($defaultNamespaces);
    }

    public function generate(string $modelName, string $modelPath): string
    {
        $namespace = $this->getNamespace($modelPath, 'model');
        $stub = $this->getStub('crud-model');
        return str_replace( ['{{ class }}', '{{ namespace }}'], [$modelName, $namespace], $stub);
    }
}
