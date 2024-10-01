<?php

namespace Dietrichxx\CrudKit\Services;

use Dietrichxx\CrudKit\Exceptions\ClassExistsException;
use Dietrichxx\CrudKit\Exceptions\TemplateFolderExistsException;
use Dietrichxx\CrudKit\Helpers\NamingTransformer;

class CRUDService
{
    protected object $classInitializer;
    protected object $templateInitializer;
    protected object $namingTransformer;

    /**
     * @param ClassInitializer $classInitializer
     * @param TemplateInitializer $templateInitializer
     * @param NamingTransformer $namingTransformer
     */
    public function __construct(ClassInitializer $classInitializer, TemplateInitializer $templateInitializer, NamingTransformer $namingTransformer)
    {
        $this->classInitializer = $classInitializer;
        $this->templateInitializer = $templateInitializer;
        $this->namingTransformer = $namingTransformer;
    }

    /**
     * @param string $modelName
     * @param array $directoryPaths
     * @return void
     * @throws TemplateFolderExistsException
     * @throws ClassExistsException
     */
    public function initStructure(string $modelName, array $directoryPaths): void
    {
        $fileNames = $this->namingTransformer->getArrayFileNames($modelName);
        $this->classInitializer->init($fileNames, $directoryPaths);

        $directoryName = $this->namingTransformer->getTemplateDirectoryName($modelName);
        $this->templateInitializer->init($directoryName, $directoryPaths['templates_path']);
    }

}
