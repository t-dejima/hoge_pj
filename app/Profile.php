<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['article_id', 'etc'];
    
    // 「１対１」→ メソッド名は単数形
  Public function article()
  {
    // Articleモデルのデータを引っ張てくる
    return $this->hasOne('App\Article');
  }
    
}

