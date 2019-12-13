<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
       protected $table = 'articles';
        protected $fillable = ['title', 'body'];
  
//    protected $fillable = ['title', 'body'];
     // 「１対１」→ メソッド名は単数形
  Public function profile()
  {
    // Profileモデルのデータを引っ張てくる
    return $this->hasOne('App\Profile');
  }
}
