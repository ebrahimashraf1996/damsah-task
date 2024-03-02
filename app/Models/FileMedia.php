<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileMedia extends Model
{
    use HasFactory;

    protected $table = "file_media";

    public $fillable = [
        'model_type',
        'model_id',
        'collection_name',
        'file_name',
        'file_path',
        'mime_type',
        'disk',
        'size'
    ];

    public function postedData()
    {
        return $this->belongsTo(PostedData::class, 'model_id');
    }
}
