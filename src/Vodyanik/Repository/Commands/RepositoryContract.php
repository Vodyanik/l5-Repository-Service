<?php

namespace Vodyanik\Repository\Commands;

use Illuminate\Console\GeneratorCommand;

class RepositoryContract extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:repository-contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository contract';

    /**
     * @var string
     */
    protected $type = 'Repository Contract';

    /**
     * @return bool|null|void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        parent::handle();
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
        return __DIR__ . '/Stubs/repository-contract.stub';
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Contracts\Repositories';
    }

    /**
     * @param string $name
     * @return mixed|string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $replace = $this->buildRepositoryContractReplacements();

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * @return array
     */
    protected function buildRepositoryContractReplacements()
    {
        $name = $this->argument('name');

        return [
            'DummyName' => $name
        ];
    }
}
