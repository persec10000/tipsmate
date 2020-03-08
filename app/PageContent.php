<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $table = "page_content";  //
    protected $fillable = [
        'id', 'page_title', 'meta_tags', 'keywords', 'page_content', 'updated_at', 'created_at', 'page_sc_name'
    ];

}
