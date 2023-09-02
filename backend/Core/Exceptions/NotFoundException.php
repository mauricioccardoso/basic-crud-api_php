<?php

namespace App\Core\Exceptions;

class NotFoundException extends AppError
{
    protected $message = 'Page not found';
    protected $code = 404;
}