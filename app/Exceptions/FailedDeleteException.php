<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class FailedDeleteException extends Exception
{
    protected $code=Response::HTTP_EXPECTATION_FAILED;
    protected $message='Failed Delete Resource';
}
