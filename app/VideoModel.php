<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoModel extends Model
{
    protected $table = "video";//
    protected $fillable=[
        'id','name','description','video_url'
    ];

}
