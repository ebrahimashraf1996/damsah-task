<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiSetting
{
    use ApiResponseTrait;

    public $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {


        $api_key = $request->header('x-api-key');
        if($api_key == '27338041-0ea1-4502-a06e-893ec748ae9e') {
            return $next($request);
        } else {
            return $this->error_response('Un-Authorized Access', 403);
        }
    }

}
