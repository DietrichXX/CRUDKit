<?php

namespace Dietrichxx\CrudKit\Exceptions;

use Dietrichxx\CrudKit\Interfaces\CRUDKitExceptionInterface;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e)
    {
        $this->renderable(function (CRUDKitExceptionInterface $exception) {
            $output = app('console')->output;
            $output->writeln('<fg=red>' . $exception->getMessage() . '</>');
        });
    }
}
