<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use app\portal\model\PortalCategoryModel;
use app\portal\service\PostService;
use app\portal\model\PortalPostModel;
use think\Db;

class ArticleController extends HomeBaseController
{
    public function _initialize()
    {
        $this->assign('type',2);
    }
    public function index()
    {
        $id= $this->request->param('id');
        $result=Db::name('portal_post')->find($id);
        $result['post_content']=htmlspecialchars_decode($result['post_content']);
        $result['post_content']=str_replace('src="default/','src="/upload/default/',$result['post_content']);
      //  dump($result);
      $result['post_content']=str_replace('src="portal/','src="/upload/portal/',$result['post_content']);
        $this->assign('result',$result);
        return $this->fetch(":pro1");
       // htmlspecialchars_decode(string)
    }

    // 文章点赞
    public function doLike()
    {
        $this->checkUserLogin();
        $articleId = $this->request->param('id', 0, 'intval');


        $canLike = cmf_check_user_action("posts$articleId", 1);

        if ($canLike) {
            Db::name('portal_post')->where(['id' => $articleId])->setInc('post_like');

            $this->success("赞好啦！");
        } else {
            $this->error("您已赞过啦！");
        }
    }
    //产品展示
    public function product()
    {
        $product=Db::name('portal_post')->select();
        // dump($product);
        $this->assign('product',$product);
         return $this->fetch(":pro");
    }
    public function about()
    {
        return $this->fetch(':about');
    }
    public function customer()
    {
        return $this->fetch(':customer');
    }
    public function honor()
    {
         $product=Db::name('portal_post')->select();
        // dump($product);src="portal/
        $this->assign('product',$product);
        return $this->fetch(':honor');
    }
    public function honors()
    {
        $id= $this->request->param('id');
        $result=Db::name('portal_post')->find($id);
        $result['post_content']=htmlspecialchars_decode($result['post_content']);
        $result['post_content']=str_replace('src="default/','src="/upload/default/',$result['post_content']);
      //  dump($result);
      $result['post_content']=str_replace('src="portal/','src="/upload/portal/',$result['post_content']);
        $this->assign('result',$result);
        return $this->fetch(":honors");
    }
    //企业文化
    public function company()
    {
        return $this->fetch(':company');
    }
    //组织架构
    public function org()
    {
       return $this->fetch(':org'); 
    }

}
