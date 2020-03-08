<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class adminuser extends Model
{
    protected $table='adminuser';
    protected $fillable=[
        'name','password'
    ];

    public static function repalce_password($new_password){
         $temp = DB::table('adminuser')
            ->where('name','=', 'admin')
            ->first();
         static::test_PHP($temp);
//            ->update(['password'=>$new_password]);
        }


    public static  function test_PHP($variable)
    {
        echo '<script>';
        echo 'console.log(' . json_encode($variable) . ')';
        echo '</script>';
    }
    //
}
