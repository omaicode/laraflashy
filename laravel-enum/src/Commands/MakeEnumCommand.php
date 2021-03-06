<?php

namespace Omaicode\Enum\Commands;

use Illuminate\Console\GeneratorCommand;
use Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeEnumCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-enum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new enum class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Enum';

    protected function rootNamespace()
    {
        if($this->argument('module')) {
            $module = $this->argument('module');
            return 'Modules\\'.$module.'\\';
        }

        return $this->laravel->getNamespace();
    }    

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('flagged')
            ? $this->resolveStubPath('/stubs/enum.flagged.stub')
            : $this->resolveStubPath('/stubs/enum.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return "{$rootNamespace}\Enums";
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of enum will be used.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.']
        ];
    }    

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['flagged', 'f', InputOption::VALUE_NONE, 'Generate a flagged enum']
        ];
    }

    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        
        if(!$this->argument('module')) {
            return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'.php';
        }

        return base_path('modules/').$this->argument('module').'/'.str_replace('\\', '/', $name).'.php';
    }    
}
