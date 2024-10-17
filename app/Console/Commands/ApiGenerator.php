<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ApiGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate new api component';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('What is your Container name?');

        $cm = ' make:controller Api/' . $name . '/' . $name;
        Artisan::call($cm . 'Controller ');
        Artisan::call('make:resource ' . $name . '/'.$name.'Resource');
        Artisan::call('make:resource ' . $name . '/'.$name.'Collection');


        Artisan::call('make:request ' . $name.'/Api/'.'GetAll'.$name.'Request');
//        Artisan::call('make:request ' . $name.'/Api/'.'Create'.$name.'Request');
//        Artisan::call('make:request ' . $name.'/Api/'.'Delete'.$name.'Request');
//        Artisan::call('make:request ' . $name.'/Api/'.'Edit'.$name.'Request');
        Artisan::call('make:request ' . $name.'/Api/'.'Find'.$name.'Request');
//        Artisan::call('make:request ' . $name.'/Api/'.'Update'.$name.'Request');
//        Artisan::call('make:request ' . $name.'/Api/'.'Delete'.$name.'Request');
//        Artisan::call('make:request ' . $name.'/Api/'.'Store'.$name.'Request');

        $this->info('api generated was successfully');

        return 0;
    }
}
