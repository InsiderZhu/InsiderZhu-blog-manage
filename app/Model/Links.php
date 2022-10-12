<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    
        //访问数据表
    protected $table = 'links';
//主键
    protected $primaryKey = 'link_id';
//关闭自动维护时间
    public $timestamps = false;
    
    protected $guarded = [];
}
