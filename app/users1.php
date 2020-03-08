<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class users1 extends Model
{
    protected $table='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','enable_question','enable_article'
    ];


    public static function getAdminEmail(){
        $query = DB::table('users')
            ->where('name','=','admin')
            ->get();
        static::test_PHP($query[0]->email);
        return $query[0]->email;
    }
    public static function test_PHP($variable)
    {
        echo '<script>';
        echo 'console.log(' . json_encode($variable) . ')';
        echo '</script>';
    }
}
