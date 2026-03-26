<?php

namespace Modules\Auth\Exceptions;

use Modules\Core\Exceptions\BaseException;
use Modules\Core\Utilities\Response;

class UserException extends BaseException
{
    public static function alreadyPhoneTaken()
    {
        throw new self('This phone has been already taken', Response::HTTP_FORBIDDEN);
    }
}
