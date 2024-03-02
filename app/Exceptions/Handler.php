<?php

namespace App\Exceptions;

use App\Traits\ApiHelperTrait;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiHelperTrait;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->renderable(function (NotFoundHttpException $e , Request $request) {
            if ($request->is('api/*')) {
                return $this->returnWrong('Object Not Found' , JsonResponse::HTTP_NOT_FOUND );
            }
        });

        $this->renderable(function(AuthorizationException  $e , Request $request) {
            if ($request->is('api/*')) {
                return $this->returnWrong('غير مصرح لك بالدخول', JsonResponse::HTTP_UNAUTHORIZED);
            }
        });

        $this->renderable(function(AuthenticationException  $e , Request $request) {
            if ($request->is('api/*')) {
                return $this->returnWrong('غير مصرح لك بالدخول', JsonResponse::HTTP_UNAUTHORIZED);
            }
        });

        $this->renderable(function(Throwable $e , Request $request) {
            if ($request->wantsJson()) {
                return $this->returnWrong($e->getMessage());
            }
        });

    }

}
