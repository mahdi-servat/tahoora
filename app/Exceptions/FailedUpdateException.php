<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class FailedUpdateException extends Exception
{
    protected $code=Response::HTTP_EXPECTATION_FAILED;
    protected $message='Failed Update Resource';
}
