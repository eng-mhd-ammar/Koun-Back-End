<?php

namespace Modules\Auth\Exceptions;

use Modules\Core\Exceptions\BaseException;
use Modules\Core\Utilities\Response;

class AuthException extends BaseException
{
    public static function invalidCredentials()
    {
        throw new self('Invalid Credentials Provided', Response::HTTP_NOT_FOUND);
    }
}
