<?php

namespace App\Actions\Reserve;

use App\Actions\Museum\FindMuseumAction;
use App\Models\Reserve\Reserve;
use App\Repositories\ReserveRepositoryEloquent;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateReserveAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(ReserveRepositoryEloquent::class);
    }

    public function handle(Request $request)
    {
        $user = auth('sanctum')->user();
        $reserve = Reserve::firstOrCreate([
            'user_id' => $user->id,
            'artist_id' => $request->artist_id ?? null,
            'museum_id' => $request->museum_id,
            'date' => $request->date,
        ]);
        $request->request->add(['id' => $request->museum_id]);
        $serviceName = app(FindMuseumAction::class)->handle($request)->title;
        $msg = 'رزرو - کلینیک طهورا' . '
        ' .
            'کاربر جدید درخواست نوبت ثبت نموده است.' . '
            ' .
            'نام: ' . $user->full_name . '
            ' .
            'شماره تماس: ' . $user->phone . '
            ' .
            'سرویس: ' . $serviceName . '
            ' .
            'تاریخ درخواست نوبت: ' . $request->date;
        $phone = 989331642162;

        if ($user->phone != '989331642162' && $user->phone != '989390380133')
            Util::ippanel($phone, $msg);

        return $reserve;
    }
}
