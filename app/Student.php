<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
     //AdminとUserテーブルとのリレーション （従テーブル側）
     public function Student() {
        return $this->belongsTo('App\Http\Controllers\Admin\HomeController');
        return $this->belongsTo('App\Http\Controllers\User\HomeController');
    }
}
