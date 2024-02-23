<?php

namespace App\Http\Controllers\Api\UserApp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserApp\PostDataRequest;
use App\Services\PostedDataService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * @group PostData Apis
 *
 * PostData
 *
 * Store Data into S3 and Relate it with Model Called PostData. If everything is okay, you'll get a 200 OK response.
 *
 * Otherwise, the request will fail with a 500 error, and a response Error Message.
 *
*/

class PostDataController extends Controller
{
    private $posted_data;

    public function __construct()
    {
        $this->posted_data = new PostedDataService();
    }
    /**
     * Post Data into S3
     * @header Content-Type application/json
     * @header Accept application/json
     * @header x-api-key Secret-Api-key
     * @bodyParam files list required Minimum 1 item. Example: files[0] image.png / files[1] video.mp4 / files[2] Doc.pdf
     * @response 500 {"code": 500,"success": true,"message": "Uploading Failed"}
     * @response 200 {"code": 200,"success": true, "message": "Uploaded Successfully"}
     */

    public function __invoke(PostDataRequest $request)
    {
        return $this->posted_data->store($request->file('files'));
    }
}
