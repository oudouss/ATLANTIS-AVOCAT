<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SiteInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:install {--force : Do not ask for user confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install setup data for the Application';

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
            if ($this->confirm('This will delete ALL your current data and install the default setup data. Are you sure?')) {
                $this->proceed();
            }
        }
    }


    protected function proceed(){

        $this->info('Publishing site assets and config files');

        try {
            File::deleteDirectory(public_path('storage'));

        } catch (\Exception $e) {
            $this->error('storage symlink directory NOT deleted.');
        }

        
        
        File::copyDirectory(public_path('img/siteimages/settings'), storage_path('app/settings'));
        File::copyDirectory(public_path('img/siteimages/users'), storage_path('app/users'));
        
        $this->callSilent('storage:link');

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

        $this->info('site assets, database, and config files installed successfully');
    }
}
