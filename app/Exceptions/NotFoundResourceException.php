<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class NotFoundResourceException extends Exception
{
    protected $code=Response::HTTP_NOT_FOUND;
    protected $message='Resource Not Found';
}
