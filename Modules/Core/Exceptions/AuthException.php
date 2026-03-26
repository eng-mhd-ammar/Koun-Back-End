<?php

namespace Modules\Core\Exceptions;

use Modules\Core\Utilities\Response;

class AuthException extends BaseException
{
    public static function invalidCredentials()
    {
        throw new self('Invalid Credentials Provided', Response::HTTP_NOT_FOUND);
    }
    public static function accountHasBeenDeactivated()
    {
        throw new self('Account Has Been Deactivated, Please Contact Support', Response::HTTP_FORBIDDEN);
    }
    public static function invalidRefreshToken()
    {
        throw new self('Invalid Refresh Token Provided', Response::HTTP_FORBIDDEN);
    }
    public static function unverifiedAccount()
    {
        throw new self('Account Has Not Been Verified Yet, Please Verify Your Account First.', Response::HTTP_FORBIDDEN);
    }
    public static function unverifiedPhoneAccount()
    {
        throw new self('Account\'s phone Has Not Been Verified Yet, Please Verify Your Account First.', Response::HTTP_FORBIDDEN);
    }
    public static function unverifiedMailAccount()
    {
        throw new self('Account\'s email Has Not Been Verified Yet, Please Verify Your Account First.', Response::HTTP_FORBIDDEN);
    }
    public static function invalidOtpProvided()
    {
        throw new self('Wrong OTP Provided, Please Try Again.', Response::HTTP_BAD_REQUEST);
    }
    public static function otpTimeout()
    {
        throw new self('Otp could be expired, please request a new one', Response::HTTP_BAD_REQUEST);
    }
    public static function invalidOldPassword()
    {
        throw new self('Invalid Old Password', Response::HTTP_BAD_REQUEST);
    }
    public static function invalidNewPassword()
    {
        throw new self('New Password Must Be Different From Old Password', Response::HTTP_BAD_REQUEST);
    }
    public static function invalidTokenProvided()
    {
        throw new self('Invalid Token Type Provided', Response::HTTP_NOT_FOUND);
    }
    public static function notAnAdmin()
    {
        throw new self('Sorry You are not an admin.', Response::HTTP_BAD_REQUEST);
    }
}
