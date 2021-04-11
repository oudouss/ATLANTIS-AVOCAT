<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SiteInstallCloud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:installCloud {--force : Do not ask for user confirmation} {--auto : Install default setup data for Automatisation & Auto Billing Modules}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Cloud setup data for the Application';

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
            if ($this->option('auto')) {
                $this->call('site:installAuto', [
                    '--force' => true,
                ]);
                $this->call('site:installAutoBilling', [
                    '--force' => true,
                ]);
            }
        } else {
            if ($this->confirm('This will delete ALL your current data and install the default setup data. Are you sure?')) {
                $this->proceed();
                if ($this->option('auto')) {
                    $this->call('site:installAuto', [
                        '--force' => true,
                    ]);
                    $this->call('site:installAutoBilling', [
                        '--force' => true,
                    ]);
                }
            }
        }
    }


    protected function proceed(){   

        $this->info('Migrating the database tables');

        try {
            $this->call('migrate:fresh', [
                '--seed' => true,
                '--force' => true,
            ]);
        } catch (\Exception $e) {
            $this->error('Your tables are NOT seeded correctly.');
        }
        $this->info('Seeding data in the database tables');

        $this->call('db:seed', [
            '--class' => 'VoyagerDatabaseSeeder',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'DataTypesTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'DataRowsTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'MenuItemsTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'RolesTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'PermissionsTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'PermissionRoleTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'UsersTableSeederCustom',
            '--force' => true,
        ]);

        $this->call('db:seed', [
            '--class' => 'SettingsTableSeederCustom',
            '--force' => true,
        ]);

        $this->info('cloud storage configured and site installed successfully!!');
    }
}