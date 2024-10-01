<?php

namespace Dietrichxx\CrudKit\Services;

use Dietrichxx\CrudKit\Exceptions\TemplateFolderExistsException;
use Dietrichxx\CrudKit\Helpers\NamingTransformer;
use Illuminate\Support\Facades\File;

class TemplateInitializer
{
    protected object $namingTransformer;

    /**
     * @param NamingTransformer $namingTransformer
     */
    public function __construct(NamingTransformer $namingTransformer)
    {
        $this->namingTransformer = $namingTransformer;
    }

    /**
     * @param string $directoryName
     * @param string $templatePath
     * @return void
     * @throws TemplateFolderExistsException
     */
    public function init(string $directoryName, string $templatePath): void
    {
        $directoryPath = $this->createDirectoryPath($templatePath, $directoryName);

        File::makeDirectory($directoryPath, 0777, true);

        $this->copyTemplatesInDirectory($directoryPath);
    }

    /**
     * @param $directoryPath
     * @return void
     */
    protected function copyTemplatesInDirectory($directoryPath): void
    {
        $packageTemplatesPath = __DIR__.'/../resources/views';

        $files = File::files($packageTemplatesPath);

        foreach ($files as $file) {
            File::copy($file->getRealPath(), $directoryPath . '/' . $file->getFilename());
        }
    }

    /**
     * @param string$templatePath
     * @param string $directoryName
     * @return string
     * @throws TemplateFolderExistsException
     */
    protected function createDirectoryPath(string $templatePath, string $directoryName): string
    {
        $directoryPath = resource_path('views' . $templatePath .'/'. $directoryName);

        if (File::exists($directoryPath)) {
            throw new TemplateFolderExistsException($directoryPath);
        }
        return $directoryPath;
    }
}
