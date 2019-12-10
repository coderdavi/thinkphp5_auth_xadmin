<?php

namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Category as CategoryModel;
use think\Db;
use think\Exception;
use think\exception\DbException;
use think\Loader;
use think\Request;
use app\admin\model\Article as ArticleModel;
use app\admin\model\Category;
use app\admin\validate\Article as ArticleValidate;
use think\Response;

class Article extends Base
{
    /**
     * 显示资源列表
     *
     * @return string
     * @throws DbException
     * @throws Exception
     */
    public function index()
    {
        //1.获取到所有的数据记录
        $articles = model('Article')->with('Category')->order('id','desc')->paginate(4);

        $count = ArticleModel::count();
        //给结果集对象数组中的每个模板对象添加班级关联数据,非常重要
//        foreach ($articles as $value) {
//            $value -> article_class = $value -> category -> cate_name;
//        }

        //2.模板赋值
        $this->view->assign('article', $articles);
        $this->view->assign('count', $count);

        return $this -> view -> fetch('article_list');

    }

    /**
     * 显示创建资源表单页.
     *
     * @return string
     * @throws Exception
     */
    public function create()
    {
        $cate_level = CategoryModel::getCate();
        $this->view->assign('cate_level',$cate_level);

        return $this->view->fetch('article_add');
    }

    /**
     * 保存新建的资源
     *
     * @param Request $request
     * @return void
     */
    public function save(Request $request)
    {
        if ($request->isPost()){
            $data =$request->except(['file']);
            //验证器验证
//            $validate =Loader::validate('Article');
//            if (!$validate->scene('save')->check($data)){
//                $this->error($validate->getError());
//            }
            $validate = new ArticleValidate();
            if (!$validate->scene('save')->check($data)){
                $this->error($validate->getError());
            }
            //验证通过之后保存在数据库
            $article = new ArticleModel();
            $res = $article->save($data);

         //  $res= ArticleModel::create($data);
            if (is_null($res)){
                $this->error('添加失败');
            }else{
               $this->success('添加成功');
            }
        }
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return void
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return string
     * @throws DbException
     * @throws Exception
     */
    public function edit($id)
    {
        $article = ArticleModel::get($id);
        $cate_level = CategoryModel::getCate();
        //根据关联id查找出分类名称
        $cate_name = $article->category->cate_name;
        $this->view->assign('article',$article);
        $this->view->assign('cate_name',$cate_name);
        $this->view->assign('cate_level',$cate_level);

        return  $this->view->fetch('article_edit');
    }

    /**
     * 保存更新的资源
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isPost()){
            $data =$request->except(['file']);
            //验证器验证
            $validate = new ArticleValidate();
            if (!$validate->check($data)){
                $this->error($validate->getError());
            }
            $article =new ArticleModel();
            $res =$article->where(['id'=>$data['id']])->update($data) ;
        //   $res= ArticleModel::update($data,['id'=>$data['id']]);
            if (is_null($res)){
                $this->error('更新失败');
            }else{
                $this->success('更新成功');
            }
        }
    }

    /**
     * 删除指定资源
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        $article_id = $request->param('id');
        ArticleModel::update(['status'=>0],['id'=>$article_id]);
        ArticleModel::destroy($article_id);
    }
    public function unDelete(){
        ArticleModel::update(['delete_time'=>NULL,'status'=>1],['status'=>0]);
    }
}
