<?php

namespace app\admin\model;
use think\Model;
class Admin extends Model
{

    //创建获取器方法,用来实现时间的转换
    public function getLastTimeAttr($val)
    {
        return date('Y/m/d H:i:s', $val);
    }
    protected $type = [
        'last_time'=>'timestamp',
    ];

    //创建修改器,将密码自动md5加密存储
    public function setPasswordAttr($val)
    {
        return md5($val);
    }
    //数据表中角色字段:role返回值处理
//    public function getRoleAttr($value)
//    {
//        $role = [
//            0=>'管理员',
//            1=> '超级管理员'
//        ];
//        return $role[$value];
//    }

}
