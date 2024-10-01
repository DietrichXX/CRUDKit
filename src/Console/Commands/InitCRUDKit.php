<?php

namespace Dietrichxx\CrudKit\Console\Commands;

use Dietrichxx\CrudKit\Services\CRUDService;
use Illuminate\Console\Command;

class InitCRUDKit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:crudkit {modelName} {--optional-path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a starter kit of classes for CRUD';

    protected object $crudService;

    public function __construct(CRUDService $crudService){
        $this->crudService = $crudService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $modelName = $this->argument('modelName');

        if ($this->option('optional-path')) {
            $modelPath = $this->ask('Введите путь для модели', config('crudkit.base_path.model_base_path'));
            $controllerPath = $this->ask('Введите путь для контроллера', config('crudkit.base_path.controller_base_path'));
            $requestPath = $this->ask('Введите путь для реквестов', config('crudkit.base_path.request_base_path'));
            $templatePath = $this->ask('Введите путь для шаблонов', config('crudkit.base_path.templates_base_path'));
        } else {
            $modelPath = config('crudkit.base_path.model_base_path');
            $controllerPath = config('crudkit.base_path.controller_base_path');
            $requestPath = config('crudkit.base_path.request_base_path');
            $templatePath = config('crudkit.base_path.templates_base_path');
        }

        $directoryPaths = [
            'model_path'      => $modelPath,
            'controller_path' => $controllerPath,
            'request_path'    => $requestPath,
            'templates_path'  => $templatePath,
        ];

        $this->crudService->initStructure($modelName, $directoryPaths);

        $this->output->writeln('<bg=green>                                     </>');
        $this->output->writeln('<bg=green;fg=white>   Набор для CRUD успешно создан     </>');
        $this->output->writeln('<bg=green>                                     </>');
    }
}
