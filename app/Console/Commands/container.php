<?php

namespace App\Console\Commands;


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

        $cm = ' make:controller web/' . $name . '/' . $name;
        Artisan::call($cm . 'Controller --resource');
        $cm1 = 'make:form Http/Controllers/web/'.$name.'/'.$name.'Form';
        Artisan::call($cm1);
        Artisan::call('make:model ' . $name . '/' . $name);
        Artisan::call('make:repository ' . $name);


        Artisan::call('make:request ' . $name.'/Web/'.'GetAll'.$name.'Request');
        Artisan::call('make:request ' . $name.'/Web/'.'Create'.$name.'Request');
        Artisan::call('make:request ' . $name.'/Web/'.'Delete'.$name.'Request');
        Artisan::call('make:request ' . $name.'/Web/'.'Edit'.$name.'Request');
        Artisan::call('make:request ' . $name.'/Web/'.'Find'.$name.'Request');
        Artisan::call('make:request ' . $name.'/Web/'.'Update'.$name.'Request');
        Artisan::call('make:request ' . $name.'/Web/'.'Delete'.$name.'Request');
        Artisan::call('make:request ' . $name.'/Web/'.'Store'.$name.'Request');


        sleep(7);

        Generator::run($name);

        $this->info('container generated was successfully');

        return 0;
    }
}
