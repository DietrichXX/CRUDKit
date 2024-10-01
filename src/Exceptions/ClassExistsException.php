<?php

namespace Dietrichxx\CrudKit\Exceptions;

use Dietrichxx\CrudKit\Interfaces\CRUDKitExceptionInterface;
use Exception;

class ClassExistsException extends Exception implements CRUDKitExceptionInterface
{
    public function __construct(string $className, string $fullPath)
    {
        parent::__construct("Класс $className уже существует в $fullPath");
    }
}
