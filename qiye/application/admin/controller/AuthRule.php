<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use \app\admin\model\AuthRule as AuthRuleModel;
use think\Response;

class AuthRule extends Base
{
    /**
     * 显示资源列表
     *
     * @return Response
     */
    public function lst()
    {
        //1、获取分类信息
        $rule = model('admin/AuthRule')->getCate();
        //2.用模型获取分页数据
        $rule_list=AuthRuleModel::order('sort desc')->paginate(4);
        //3.获取记录数量
        $count = AuthRuleModel::count();

        //4.模板赋值
        $this -> view -> assign('rule', $rule);
        $this -> view -> assign('rule_list', $rule_list);
        $this -> view -> assign('count', $count);
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        //1.设置返回的值
        $status = 1;
        $message = '添加成功';
        //找到上级导航的level
        $plevel = AuthRuleModel::where(['id'=>$request->param('pid')])->value('level');
        if($plevel){
            $level=$plevel+1;
        }else{
            $level=0;
        }
        //2.添加数据到分类表中
        $res = AuthRuleModel::create([
            'name'=>$request->param('name'),
            'title'=> $request->param('title'),
            'pid'=> $request->param('pid'),
            'level'=>$level
        ]);

        //3.添加失败的处理
        if (is_null($res)) {
            $status = 0;
            $message = '添加失败';
        }

        return ['status'=> $status, 'message'=> $message, 'res'=> $res->toJson()];
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return Response
     */
    public function save(Request $request)
    {
        //
    }


    /**
     * 显示编辑资源表单页.
     *
     * @param Request $request
     * @return Response
     * @throws \think\exception\DbException
     */
    public function edit(Request $request)
    {
        //1、获取分类信息
        $rule = model('admin/AuthRule')->getCate();;
        $rule_id = $request -> param('id');
        //2.查询要更新的数据
        $rule_now = AuthRuleModel::get($rule_id);
        $this->assign('rule',$rule);
        $this->assign('rule_now',$rule_now);
        return view('auth_rule/edit');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(Request $request)
    {
        //1.获取一下提交的数据
        $data = $request -> param();
        $res = AuthRuleModel::update(
        $data,['id'=> $data['id']]);
        $status = 1;
        $message = '更新成功';
        if (is_null($res)){
            $status=0;
            $message='更新失败';
        }
        return ['status'=>$status, 'message'=> $message];
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        AuthRuleModel::destroy($id);

    }
}
