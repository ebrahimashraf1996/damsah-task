<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

trait HandleUploadFile
{

    /**
     * Undocumented function.
     *
     * @param UploadedFile|null $image
     * @return bool
     */

    public function storeFile($path, $model): bool
    {

        $result = true;

        $full_path = env('AWS_URL'). $path;

        $exploded_for_name = explode('/', $path);
        $name = end($exploded_for_name);

        $exploded_for_mime = explode('.', $path);
        $mime_type = end($exploded_for_mime);

        $data['model_type'] = $model->getMorphClass();
        $data['model_id'] = $model->id;
        $data['collection_name'] = $this->getTable();
        $data['file_name'] = $name;
        $data['file_path'] = $full_path;
        $data['mime_type'] = $mime_type;
        $data['created_at'] = date(now());
        $data['updated_at'] = date(now());

        $check = DB::table('file_media')->insert($data);

        if (!$check) {
            $result = false;
        }

        return $result;
    }


}
