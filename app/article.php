<?php
namespace App;

use App\Services\Markdowner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class article extends Model
{
    protected $table='article';

    protected $fillable = [
        'title',
        'category',
        'post_image',
        'content_html'
    ];
    protected $created_at=false;
    protected $updated_at = false;

}
