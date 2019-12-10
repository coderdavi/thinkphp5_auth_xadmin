<?php
namespace app\admin\validate;

use think\Validate;

class article extends  Validate{
    protected $rule=[
        ['title|标题','require|min:4','标题必须填写且不少于4个字符'],
        ['content|内容','require|min:3','内容必须填写且不少于3个字符'],
        ['source|来源','require','来源必须填写']
    ];
    protected $scene=[
        'save'=>'title'
    ];
}
