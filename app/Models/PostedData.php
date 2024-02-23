<?php

namespace App\Models;

//use App\Traits\HandleUploadFile;
use App\Models\Traits\Scopes\PostedDataScope;
use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PostedData extends Model
{
    use HasFactory, HandleUploadFile, PostedDataScope;

    protected $table = "posted_data";

    protected $guarded = ['id'];

    public function media()
    {
        return $this->hasMany(FileMedia::class, 'model_id', 'id')->where('file_media.model_type', '=', $this->getMorphClass());
    }

}
