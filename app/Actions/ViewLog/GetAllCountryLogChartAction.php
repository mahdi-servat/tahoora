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
use Illuminate\Support\Facades\DB;

class GetAllCountryLogChartAction
{
    public ViewLogRepositoryEloquent $repository;


    public function __construct()
    {
        $this->repository = App::make(ViewLogRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        return DB::select('select countries.id , countries.code, countries.title,
                   (select count(*) from view_logs where country_id = countries.id) as countt
            from countries
            WHERE EXISTS(SELECT * FROM view_logs where country_id = countries.id)
            order by countt DESC
            limit 3');

    }
}
