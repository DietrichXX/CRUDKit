<?php

namespace Dietrichxx\CrudKit\Exceptions;

use Dietrichxx\CrudKit\Interfaces\CRUDKitExceptionInterface;
use Exception;

class TemplateFolderExistsException extends Exception implements CRUDKitExceptionInterface
{
    public function __construct($directoryPath)
    {
        parent::__construct("Папка для шаблонов '{$directoryPath}' уже существует.");
    }
}
