<?php

namespace App\Contracts;

use App\Classes\NotificationData;
use Illuminate\Contracts\Queue\ShouldQueue;

interface NotificationInterface
{
    public function send(): void;
}
