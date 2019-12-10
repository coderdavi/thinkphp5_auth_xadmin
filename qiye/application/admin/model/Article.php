<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Article extends Model
{
    use SoftDelete;
    protected  $autoWriteTimestamp=true;
    protected  $createTime =false;
    protected $dateFormat='Y/m/d H:m:i';
    protected $deleteTime = 'delete_time';
    protected $insert=[
        'status'=>1,
        'view_count'=>0
    ];
    protected $auto=[
        'status'=>0
    ];
    public function category(){
        return $this->belongsTo('category');
    }
}
