<?php

namespace App\Services;

use App\Http\Resources\UserApp\PostedDataResource;
use App\Models\PostedData;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;

class PostedDataService
{

    use ApiResponseTrait;

    Public function getData()
    {
        $data = PostedData::selection()->get();
        $data = PostedDataResource::collection($data);
        return $this->success_response_with_data($data, 'List of Uploaded Data');

    }

    public function store($data)
    {
        try {
            DB::beginTransaction();

            // Create DB Row (Needed to Relate Media with it)
            $posted_data = new PostedData();
            $posted_data->save();

            // Set Time Limit for Request to Avoid Request Time out
            set_time_limit(1200);

            // Store Media into S3 Bucket && Relate Media with The DB Row that We Created Before
            $posted_data->storeFiles($data, $posted_data);

            DB::commit();
            return $this->success_response('Uploaded Successfully');

        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->error_response('Uploading Failed', 500);
        }

    }
}
