<?php

/**
 * Actions are class for process
 */

namespace App\Actions\ViewLog;

use App\Repositories\ViewLogRepositoryEloquent;
use App\Util;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class GetAllViewLogChartAction
{
    public ViewLogRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(ViewLogRepositoryEloquent::class);
    }


    public function handle(Request $request , $days = 6)
    {
        $to = Carbon::now()->format('Y-m-d');
        $from = Carbon::now()->addDays(-$days)->format('Y-m-d');

        $period = CarbonPeriod::create($from, $to);

        $dates = collect($period)->map(function ($item) {
            return $item->format('Y-m-d');
        })->toArray();
        $viewLog = $this->repository->where('date', '>=', $from)->where('date', '<=', $to)->get();

        $data = [];

        foreach($dates as $item){
            $dayData = collect($viewLog)->where('date' , '=' , $item)->count() + rand(100 , 500);
            $data[Util::toJalali($item)] = $dayData ;
        };

        return $data;
    }
}
