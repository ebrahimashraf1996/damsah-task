<?php

namespace App\Services;

use App\Http\Resources\UserApp\PostedDataResource;
use App\Models\PostedData;
use App\Traits\ApiResponseTrait;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\DB;

class GenerateUrlService
{

    use ApiResponseTrait;

    public function generateUrl($data, $expiry)
    {
        $key = $data['file_name'];

        return $this->generate($key, $expiry);
    }

    protected function getConfig() {
        return [
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => '2006-03-01',
            'credentials' => new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'))
        ];
    }
    protected function getBucket() {
        return env('AWS_BUCKET');
    }

    protected function generate($key, $expiry) {

        $config = $this->getConfig();

        $bucket = $this->getBucket();

        $s3Client = new S3Client($config);

        $temporarySignedUrl = $s3Client->createPresignedRequest(
            $s3Client->getCommand('PutObject', [
                'Bucket' => $bucket,
                'Key' => $key,
            ]),
            $expiry
        )->withMethod('POST')->getUri()->__toString();
        return $temporarySignedUrl;
    }

}
