<?php

namespace App\Exceptions\Handler;

use App\Response;
use ErrorException;

class ExceptionHandler
{


    public function __construct()
    {
        set_exception_handler([$this, 'handle']);
        set_error_handler([$this, 'handle_error']);
    }


    public function handle($exception)
    {
        (new Response)->returnException($exception);
    }


    public function handle_error($severity, $message, $file, $line)
    {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }


}
