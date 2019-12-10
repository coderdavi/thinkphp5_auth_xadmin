<?php
namespace app\index\controller;

use app\admin\common\Base;
use think\Request;

class Index extends Base
{
    public function index()
    {
        return '<h1>网站开启状态</h1>';

    }
}
