<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class FailedCreateException extends Exception
{
    protected $code=Response::HTTP_EXPECTATION_FAILED;
    protected $message='Failed Create Resource';
}
