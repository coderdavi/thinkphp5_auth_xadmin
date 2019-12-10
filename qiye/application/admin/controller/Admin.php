<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Model;
use think\Request;
use app\admin\model\Admin as AdminModel;

class Admin extends Base
{

    //显示管理员首页
    public function index()
    {
        $auth = new Auth();
        $adminres = model('admin/Admin')->paginate(1);
        foreach ($adminres as $k => $v) {
            $_groupTitle=$auth->getGroups($v['id']);
            $groupTitle=$_groupTitle[0]['title'];
            $v['groupTitle']=$groupTitle;

        }
        //1.读取admin管理员表的信息
//        $admin = AdminModel::all();

        //2.将当前管理员的信息赋值给模板
        $this -> view -> assign('adminres', $adminres);

        //3.渲染模板
        return $this -> view -> fetch('admin_list');

    }



   //渲染编辑模板
    public function edit(Request $request)
    {

        //1.读取admin管理员表的信息
        $id = $request->param('id');
        $admin = AdminModel::get($id);
        $authGroupAccess=db('auth_group_access')->where(['uid'=>$id])->find();
        $authGroupRes= model('admin/AuthGroup')->select();
        //2.将当前管理员的信息赋值给模板
        $this -> view -> assign('admin', $admin);
        $this->assign('authGroupRes',$authGroupRes);
        $this->assign('groupId',$authGroupAccess['group_id']);
        //3.渲染模板
        return $this -> view -> fetch('admin_edit');
    }

    //执行更新操作
    public function update(Request $request)
    {
        //更新成功的提示信息
        $status = 1;
        $message = '更新成功';
        if ($request -> isAjax(true)){

            //获取提交的数据,自动过滤一下空值
            $data = array_filter($request->param());

             db('auth_group_access')->where(['uid'=>$data['id']])->update(['group_id'=>$data['group_id']]);
            //设置更新条件
            $map = ['is_update' => $data['is_update']];

            $admin = new \app\admin\model\Admin();

            //更新用户表
            $res = $admin->allowField(['password','email'])->save($data,['id'=>$data['id']]);
            //如果更新失败
            if (is_null($res)) {
                $status = 0;
                $message = '更新失败';
            }
        }
        return ['status'=>$status, 'message'=>$message];
    }




}
