<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SiteInstallAuto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:installAuto {--force : Do not ask for user confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install default setup data for Automatisation Modules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->option('force')) {
            $this->proceed();
        } else {
            if ($this->confirm('This will install the default setup data for Automatisation Modules. Are you sure?')) {
                $this->proceed();
            }
        }
    }

    protected function proceed()
    {

        $this->info('Installing the default setup data for Automatisation Modules..');

        try {

        $this->call('db:seed', [
            '--class' => 'StadeNamesTableSeeder',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'ProceduresTableSeeder',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'LawsuitModelsTableSeeder',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'ModelStadesTableSeeder',
            '--force' => true,
        ]);

        $this->info('The default setup data for Automatisation Modules installed successfully! Cheers!');
        
        } catch (\Exception $e) {
            $this->error('Your tables are NOT seeded correctly!');
        }

    }
}
