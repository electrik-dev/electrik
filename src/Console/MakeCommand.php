<?php

namespace Electrik\Console;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;

class MakeCommand extends GeneratorCommand {
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'electrik:name {name} {--without-model=true} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Electrik component with optional model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Electrik component';


	protected $stubsPath =  __DIR__ . '/../../stubs/';

    protected function configure() {

        $this->setAliases([
            'make:electrik',
        ]);

        parent::configure();
    }


    /**
     * Execute the console command.
     *
     * @return bool|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle(): null|bool|FileNotFoundException {

        $name = $this->getNameInput();
        $name = str_replace('\\', '/', $name);
        $modelName = $this->option('model') ?: Str::studly(class_basename($name));

        // Create Livewire component
        parent::handle();

        $this->createComponentController($name);
        $this->createView($name);
        $this->info("Livewire component $name created successfully.");

        // Create Model if not excluded
        if (!$this->option('without-model')) {
            $this->call('make:model', ['name' => $modelName]);
            $this->info("Model $modelName created successfully.");
        }

        return Command::SUCCESS;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string {
        return $this->stubsPath . 'components/component.php.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string {
        return $rootNamespace . '\Livewire';
    }

    protected function createComponentController($componentName) {

		// Get the fully qualified class name (FQN)
        $class = $this->qualifyClass($componentName);

        // get the destination path, based on the default namespace
        $path = $this->getPath($class);

        $content = file_get_contents($path);

        // Update the file content with additional data (regular expressions)

        $content = str_replace(
            ['{{ namespace }}', '{{ className }}'],
            [$class, class_basename($componentName)],
            $content
        );


        file_put_contents($path, $content);
    }


    /**
     * Create a view file for the component.
     *
     * @param  string  $name
     * @return void
     */
    protected function createView($name): void {
        $viewPath = resource_path('views/livewire/' . str_replace('\\', '/', $name) . '.blade.php');
        $stub = file_get_contents($this->stubsPath . 'resources/views/view.blade.php.stub');

        if (!file_exists($dir = dirname($viewPath))) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($viewPath, $stub);
    }

    /**
     * Get the full namespace for a given class, without the class name.
     *
     * @param $class
     * @return string
     */
    protected function qualifyNamespace($class): string {
        return trim(implode('\\', array_slice(explode('\\', $class), 0, -1)), '\\');
    }

}
