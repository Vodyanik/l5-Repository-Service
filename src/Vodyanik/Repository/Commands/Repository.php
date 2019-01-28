<?php

namespace Vodyanik\Repository\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class Repository extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    /**
     * @var string
     */
    protected $type = 'Repository';

    /**
     * @return bool|null|void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        parent::handle();

        if ($this->option('contract')) {
            $this->createRepositoryContract();
        }
    }

    protected function createRepositoryContract()
    {
        $repositoryContract = Str::studly(class_basename($this->argument('name')));

        $this->call('make:repository-contract', [
            'name' => $repositoryContract,
        ]);
    }

    /**
     * @return string
     */
    protected function getNameInput()
    {
        return parent::getNameInput() . 'Repository';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/Stubs/repository.stub';
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Repositories';
    }

    /**
     * @param string $name
     * @return mixed|string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $replace = $this->buildRepositoryReplacements();

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * @return array
     */
    protected function buildRepositoryReplacements()
    {
        $name = $this->argument('name');

        return [
            'DummyName' => $name
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['contract', 'c', InputOption::VALUE_NONE, 'Create a new Repository Contract']
        ];
    }
}
