<?php

namespace App\Models\ViewLog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewPathLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'view_log_id',
        'path',
    ];

    public function viewLog(): HasOne
    {
        return $this->hasOne(ViewLog::class, 'id', 'view_log_id');
    }
}
