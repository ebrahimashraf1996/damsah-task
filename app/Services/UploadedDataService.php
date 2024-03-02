<?php

namespace App\Services;

use App\Http\Resources\UserApp\PostedDataResource;
use App\Models\PostedData;
use App\Traits\ApiResponseTrait;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;

class UploadedDataService
{

    use ApiResponseTrait;

    Public function getData()
    {
        $data = PostedData::selection()->get();
        $data = PostedDataResource::collection($data);
        return $this->success_response_with_data($data, 'List of Uploaded Data');

    }

}
