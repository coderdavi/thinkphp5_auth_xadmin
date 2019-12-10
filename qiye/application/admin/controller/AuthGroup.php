<?php

namespace app\Admin\controller;

use app\admin\common\Base;
use app\Admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AuthRule as AuthRuleModel;
use think\Request;

class AuthGroup extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function lst()
    {
        $group = AuthGroupModel::all();
        $this->assign('group', $group);

        return view('auth_group/list');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public function edit(Request $request)
    {
        $group_id = $request->param('id');
        $group_info = AuthGroupModel::find($group_id);
        $auth_rule = new \app\Admin\model\AuthRule();
        $group_res = $auth_rule->getCate();
        $group_list = \app\Admin\model\AuthGroup::all();
        $this->assign('group_info', $group_info);
        $this->assign('group_res', $group_res);
        $this->assign('group_list', $group_list);

        return view('auth_group/edit');
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @return array
     */
    public function update(Request $request)
    {
        $status = 1;
        $message = '更新成功';

        $data = input('post.');
        if ($data['rules']) {
            $data['rules'] = implode(",", $data['rules']);
            $data['rules'] =  str_replace('，',",",$data['rules']);
        }
        $group= new AuthGroupModel();
        $res = $group->allowField(true)->isUpdate(true)->save($data);
        if (is_null($res)) {
            $status = 0;
            $message = '更新失败';
        }

        return ['status' => $status, 'message' => $message, 'res' => $res];
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
