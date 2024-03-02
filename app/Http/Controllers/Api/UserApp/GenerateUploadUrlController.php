<?php

namespace App\Http\Controllers\Api\UserApp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserApp\GenerateUrlRequest;
use App\Models\PostedData;
use App\Services\GenerateUrlService;
use App\Services\MediaStoreService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * @group PostData Apis
 *
 * Generate Uploading Url
 *
 * If everything is okay, you'll get a 200 Success response With a Url to Upload With it.
 *
 * Otherwise, the request will fail with a 500 error, and a response Error Message.
 *
 */
class GenerateUploadUrlController extends Controller
{
    use ApiResponseTrait;
    private $url_generator;
    private $media_store;

    public function __construct()
    {
        $this->url_generator = new GenerateUrlService();
        $this->media_store = new MediaStoreService();
    }

    /**
     * Generate Uploading Url
     * @header Content-Type application/json
     * @header Accept application/json
     * @header x-api-key Secret-Api-key
     * @bodyParam file_name string. Example: image.png
     * @response 500 {"code": 500,"success": true,"message": "Some Error Happened .. Please Contact With Developer", "data": "https://***.s3.us-east-2.amazonaws.com/image.png?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=*************&X-Amz-Date=*********&X-Amz-SignedHeaders=****&X-Amz-Expires=**&X-Amz-Signature=*******"}
     * @response 200 {"code": 200,"success": true, "message": "Use This Url to Upload Your File"}
     * @param GenerateUrlRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function __invoke(GenerateUrlRequest $request)
    {

        // Create DB Row (Needed to Relate Media with it)
        $posted_data = $this->media_store->createItem();

        // Create Path to File on S3 Bucket
        $path = $this->url_generator->createPath($posted_data->id, $request->validated()['file_name']);

        // The Url Will be Expired after the period below
        $expiry = '+10 minutes';

        // This Url Needed to upload the file (Note: The Method Must be of type "PUT")
        // The API Form Data Must be of Type "Binary"
        $url = $this->url_generator->generateUrl($path, $expiry);

        // Relate Media with The DB Row that We Created Before
        $store_media_result = $posted_data->storeFile($path, $posted_data);

        // Handel Result if Success Case or Error Case
        if ($store_media_result == true && filter_var($url, FILTER_VALIDATE_URL) !== false) {
            return $this->success_response_with_data($url, 'Use This Url to Upload Your File');
        } else {
            return $this->error_response('Some Error Happened .. Please Contact With Developer', 500);
        }
    }
}
