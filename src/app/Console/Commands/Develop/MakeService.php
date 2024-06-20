<?php

namespace App\Console\Commands\Develop;

use Illuminate\Console\Command;
use App\Utilities\DirectoryManipulator;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service file';
    protected $directoryManipulator;

    /**
     * Create a new command instance.
     *
     * @param DirectoryManipulator $directoryManipulator
     * @return void
     */
    public function __construct(DirectoryManipulator $directoryManipulator)
    {
        parent::__construct();
        $this->directoryManipulator = $directoryManipulator;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name') . 'Service';

        // Extract directory and file name
        $pathParts = explode('/', $name);
        $fileName = array_pop($pathParts);
        $directory = app_path('Services/' . implode('/', $pathParts));

        $this->directoryManipulator->makeDirectory($directory);

        $path = $directory . '/' . $fileName . '.php';
        if (!$this->directoryManipulator->makeFile($path))
        {
            $this->error("{$name} is already exists");
            return 1;
        }

        $stub = file_get_contents(__DIR__ . '/../../stubs/service.stub');

        $this->directoryManipulator->putContentToFile($path, $this->replaceNamespace($stub, $fileName, implode('\\', $pathParts)));

        $this->info("Service {$name} created successfully.");

        return 0; 
    }


    /**
     * namespace,
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceNamespace(&$stub, $fileName, $namespace)
    {
        $stub = str_replace('{{ namespace }}', 'App\Services' . ($namespace?'\\' . $namespace: ''), $stub);
        return str_replace('{{ class }}', $fileName, $stub);
    }

}
