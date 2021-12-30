<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class generateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generateData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generar comando para ejecutar las migraciones , factory y los seeders';

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
        \Artisan::call('migrate --seed');
        $this->description;
    }
}
