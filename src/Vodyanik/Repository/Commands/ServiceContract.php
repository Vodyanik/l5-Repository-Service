<?php

namespace Vodyanik\Repository\Commands;

use Illuminate\Console\GeneratorCommand;

class ServiceContract extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:service-contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service contract';

    /**
     * @var string
     */
    protected $type = 'Service Contract';

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
        return parent::getNameInput() . 'Service';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/Stubs/service-contract.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Contracts\Services';
    }

    protected function buildClass($name)
    {
        $replace = $this->buildParentReplacements();

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function buildParentReplacements()
    {
        $name = $this->argument('name');

        return [
            'DummyName' => $name
        ];
    }
}
