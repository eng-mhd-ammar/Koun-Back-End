<?php

namespace App\Http\Exceptions;

use Exception;
use Throwable;
use Modules\Core\Utilities\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\Core\Exceptions\BaseException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ExceptionsHandler
{
    public function __invoke(Exception|Throwable $e)
    {
        $error = $e->getMessage();
        $statusCode = $e->getCode() == 0 ? Response::HTTP_NOT_FOUND : $e->getCode();

        switch (true) {
            case (($e instanceof NotFoundHttpException && str($e->getMessage())->contains('لا يوجد نتائج.')) || $e instanceof ModelNotFoundException):
                $model = class_basename($e->getPrevious()->getModel());
                $error = "$model Was Not Found.";
                break;

            case $e instanceof ValidationException:
                return (new Response())->errors(
                    messages: collect($e->errors())->map(fn ($error) => $error[0])->toArray(),
                    code: Response::HTTP_UNPROCESSABLE_ENTITY
                );
                break;


            case $e instanceof AuthenticationException:
                $error = 'الرجاء تسجيل الدخول والمحاولة مرة أخرى.';
                $statusCode = Response::HTTP_UNAUTHORIZED;
                break;

            case $e instanceof QueryException:
                $error = 'Database Error Occurred.';
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                break;

            case $e instanceof AccessDeniedHttpException:
                $statusCode = Response::HTTP_UNAUTHORIZED;
                break;

            case $e instanceof LockTimeoutException:
                $error = "حدث خطأ ما، الرجاء إعادة المحاولة لاحقاً.";
                $statusCode = Response::HTTP_LOCKED;
                break;

            case $e instanceof BaseException:
                $error = $e->getMessage();
                $statusCode = $e->getCode();
                break;

            default:
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                break;
        }

        return (new Response())->error(message: $error, code: $statusCode);
    }
}
