<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class googleAds extends Model
{
    protected $table="google_ads";
    protected $fillable=[
        'id', 'ads_name','ads_type','ads_google','status','updated_at'
    ];
}
