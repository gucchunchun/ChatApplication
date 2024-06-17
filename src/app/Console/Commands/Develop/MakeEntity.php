<?php

namespace App\Console\Commands\Develop;

use Illuminate\Console\Command;
use App\Utilities\DirectoryManipulator;

class MakeEntity extends Command
{
    protected $signature = 'make:entity {name}';
    protected $description = 'Create a new entity file';
    protected $directoryManipulator;

    /**
     * Create a new command instance.
     *
     * @param MakeDirectory $directoryManipulator
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
        $name = $this->argument('name') . 'Entity';

        // Extract directory and file name
        $pathParts = explode('/', $name);
        $fileName = array_pop($pathParts);
        $directory = app_path('Entities/' . implode('/', $pathParts));

        $this->directoryManipulator->makeDirectory($directory);

        $path = $directory . '/' . $fileName . '.php';
        if (!$this->directoryManipulator->makeFile($path))
        {
            $this->error("{$name} is already exists");
            return 1;
        }

        $stub = file_get_contents(__DIR__ . '/../../stubs/entity.stub');

        $this->directoryManipulator->putContentToFile($path, $this->replaceNamespace($stub, $name));

        $this->info("Entity {$name} created successfully.");

        return 0; 
    }


    /**
     * namespace,
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace('{{ namespace }}', 'App\Entities', $stub);
        return str_replace('{{ class }}', $name, $stub);
    }

}
