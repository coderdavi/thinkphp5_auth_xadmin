<?php
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate{
    protected $rule=[
        ['username|用户名','require|min:3','用户名不能少于3位'],
        ['password|密码','require|min:6','密码不能少于6位'],
        ['captcha|验证码','require|captcha','验证码必须填写']
    ];
    public function sceneCheck(){
        return $this->only(['username', 'password','captcha']);
    }

}