<?php

namespace Vodyanik\Repository\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class Service extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service';

    /**
     * @var string
     */
    protected $type = 'Service';

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

        $this->call('make:service-contract', [
            'name' => "{$repositoryContract}",
        ]);
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
        return __DIR__ . '/Stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Services';
    }

    protected function buildClass($name)
    {
        $replace = $this->buildServiceReplacements();

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function buildServiceReplacements()
    {
        $name = $this->argument('name');

        return [
            'DummyName' => $name
        ];
    }

    protected function getOptions()
    {
        return [
            ['contract', 'c', InputOption::VALUE_NONE, 'Create a new Service Contract']
        ];
    }
}
