<?php

namespace App\Http\Controllers\Api\UserApp;

use App\Http\Controllers\Controller;
use App\Services\UploadedDataService;
use Illuminate\Http\Request;
/**
 * @group PostData Apis
 *
 * Get All Posted Data
 *
 * Get a List of Posted items With Files.
 *
 */
class GetPostedDataController extends Controller
{
    private $posted_data;

    public function __construct()
    {
        $this->posted_data = new UploadedDataService();
    }

    /**
     * Get Posted Data
     * @header Content-Type application/json
     * @header Accept application/json
     * @header x-api-key Secret-Api-key
     * @response 200  {"code": 200,"success": true,"message": "List of Uploaded Data","data": [{"id": 44,"media": [{"id": 4,"file_path": "https://*****.s3.eu-north-1.amazonaws.com/uploads/V0I7fyD6z965Ryl3aI09I4o0Ojbm6vcufOHLYZuO.png","mime_type": "image/png"}]},{"id": 45,"media": [{"id": 5,"file_path": "https://*****.s3.eu-north-1.amazonaws.com/uploads/5bWyorRtyCg2nX1OfHCUgMFBBXZPg85YdiWqkh2V.png","mime_type": "image/png" },{"id": 6,"file_path": "https://*****.s3.eu-north-1.amazonaws.com/uploads/a6Q4Le7IpZeUJcsmfeaXoanmHqFoztq9Mu4YF9dp.png","mime_type": "image/png"}]}]}
     *
     */
    public function __invoke()
    {
        return $this->posted_data->getData();
    }
}
