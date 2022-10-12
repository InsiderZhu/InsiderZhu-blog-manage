<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'blog_article';
//主键
    protected $primaryKey = 'art_id';
//关闭自动维护时间
    public $timestamps = false;
    protected $guarded = [];
    

}
