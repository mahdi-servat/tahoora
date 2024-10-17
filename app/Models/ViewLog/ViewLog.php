<?php

namespace App\Models\ViewLog;

use App\Models\Country\Country;
use App\Models\Device\Device;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent',
        'browser',
        'device_id',
        'ip',
        'country_id',
        'date',
    ];


    public function country(): HasOne
    {
        return $this->hasOne(Country::class , 'id' , 'country_id');
    }

    public function device(): HasOne
    {
        return $this->hasOne(Device::class , 'id' , 'device_id');
    }
}
