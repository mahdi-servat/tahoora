<?php

namespace Mmwdali\ContainerBuilder\commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Mmwdali\ContainerBuilder\Generator;

class container extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:container';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate new container';

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
        $name = $this->ask('What is your Container name?');

        $cm = ' make:controller ' . $name . '/' . $name;
        Artisan::call($cm . 'Controller --resource');
        Artisan::call('make:model ' . $name . '/' . $name);
        Artisan::call('make:repository ' . $name);

        sleep(7);
        Generator::run($name);

        $this->info('container generated was successfully');

        return 0;
    }
}
