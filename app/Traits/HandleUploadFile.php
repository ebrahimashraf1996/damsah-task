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

    public function storeFiles(array $files, $model) : bool
    {
        if (count($files) > 0) {
            $result = true;
            foreach ($files as $key => $file) {

                $path = $file->store('uploads');
                $path = config('filesystems.disks.s3.url') . $path ;


                $data['model_type'] = $model->getMorphClass();
                $data['model_id'] = $model->id;
                $data['collection_name'] = $this->getTable();
                $data['file_name'] = $file->hashName();
                $data['file_path'] = $path;
                $data['mime_type'] = $file->getClientMimeType();
                $data['disk'] = 's3';
                $data['size'] = $file->getSize();
                $data['created_at'] = date(now());
                $data['updated_at'] = date(now());

                $check = DB::table('file_media')->insert($data);

                if(!$check) {
                    $result = false;
                }
            }

        } else {
            $result = false;
        }
        return $result;
    }


}
