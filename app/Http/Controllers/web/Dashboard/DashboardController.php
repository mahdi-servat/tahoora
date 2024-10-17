<?php

namespace App\Http\Controllers\web\Dashboard;

use App\Actions\ViewLog\GetAllCountryLogChartAction;
use App\Actions\ViewLog\GetAllViewLogChartAction;
use App\Http\Controllers\Controller;
use App\Models\ViewLog\ViewLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = app(GetAllViewLogChartAction::class)->handle($request , 6);
        $country = app(GetAllCountryLogChartAction::class)->handle($request);
        return view('admin.layouts.dashboard' , compact('data','country'));
    }


    public function insight(Request $request)
    {
        $data = app(GetAllViewLogChartAction::class)->handle($request , 15);

        $country = [
          ['id' => 1 , 'code' => 'IR' , 'title' => 'Iran' , 'countt' => 100],
          ['id' => 2 , 'code' => 'DK' , 'title' => 'Denmark', 'countt' => 80],
          ['id' => 3 , 'code' => 'DJ' , 'title' => 'Djibouti', 'countt' => 65],
        ];
        $country = json_decode(json_encode($country));

        $countryTotalCount = 0;

        foreach ($country as $item){
            $countryTotalCount = $countryTotalCount + intval($item->countt) ;
        }
        $view_logs = ViewLog::orderBy('created_at' , 'desc')->limit(10)->get();

        return view('admin.layouts.insight' , compact('data','country' , 'view_logs' , 'countryTotalCount'));
    }


}
