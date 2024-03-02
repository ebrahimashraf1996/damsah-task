<?php

namespace App\Http\Controllers\Api\UserApp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserApp\GenerateUrlRequest;
use App\Http\Requests\Api\UserApp\PostDataRequest;
use App\Services\GenerateUrlService;
use App\Services\PostedDataService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;




class GenerateUploadUrlController extends Controller
{
    private $url_generator;

    public function __construct()
    {
        $this->url_generator = new GenerateUrlService();
    }


    public function __invoke(GenerateUrlRequest $request)
    {
        $expiry = '+10 minutes'; // Adjust the expiration time as needed

        return $this->url_generator->generateUrl($request->validated(), $expiry);
    }
}
