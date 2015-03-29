<?php

namespace Pingpong\Generators\Console;

use Illuminate\Console\Command;
use Pingpong\Generators\MigrationGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MigrationCommand extends Command {

    /**
     * The name of command.
     * 
     * @var string
     */
    protected $name = 'generate:migration';

    /**
     * The description of command.
     * 
     * @var string
     */
    protected $description = 'Generate a new migration.';

    /**
     * Execute the command.
     * 
     * @return void
     */
    public function fire()
    {
        $generator = new MigrationGenerator([
            'name' => $this->argument('name'),
            'fields' => $this->option('fields'),
            'force' => $this->option('force'),
        ]);

        $generator->run();
        
        $this->info("Migration created successfully.");
    }

    /**
     * The array of command arguments.
     * 
     * @return array
     */
    public function getArguments()
    {
        return [
          ['name', InputArgument::REQUIRED, 'The name of class being generated.', null],
        ];
    }

    /**
     * The array of command options.
     * 
     * @return array
     */
    public function getOptions()
    {
        return [
          ['fields', 'c', InputOption::VALUE_OPTIONAL, 'The fields of migration. Separated with comma (,).', null],
          ['force', 'f', InputOption::VALUE_NONE, 'Force the creation if file already exists.', null],
        ];
    }
}