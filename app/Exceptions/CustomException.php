<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $dontreport=[
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,

    ];

}
