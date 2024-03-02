<?php

namespace App\Services;

use App\Models\PostedData;
use App\Traits\ApiResponseTrait;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\DB;

class MediaStoreService
{

    public function createItem() {
        $posted_data = new PostedData();
        $posted_data->save();
        return $posted_data;
    }

}
