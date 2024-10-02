<?php

namespace Dietrichxx\CrudKit\Helpers;

use Illuminate\Support\Str;

class NamingTransformer
{
    /**
     * @param string $modelName
     * @return string[]
     */
    public function getArrayFileNames(string $modelName): array
    {
        return [
            'model' => $modelName,
            'request' => $modelName.'Request',
            'controller' => $modelName.'Controller',
            'migration' => 'create_'. $this->normalizeName($modelName, '_') .'_table',
        ];
    }

    /**
     * @param string $modelName
     * @return string
     */
    public function getTemplateDirectoryName(string $modelName): string
    {
        return $this->normalizeName($modelName, '-');
    }

    /**
     * @param string $modelName
     * @param string $separator
     * @return string
     */
    protected function normalizeName(string $modelName, string $separator): string
    {
        $transformedName = preg_replace('/([A-Z])/', "$separator$1", $modelName);

        if (strpos($transformedName, $separator) === 0) {
            $transformedName = substr($transformedName, 1);
        }

        return Str::plural(strtolower($transformedName));
    }
}
