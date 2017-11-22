<?php

/**
 * Functions: 文章管理控制器.
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class ArticleController extends SuperController {

    /**
     * 显示文章分组界面
     */
    public function listArticleGroups() {
        
       //管理员操作记录到日志表中
        $logcontent =C('SYS_LOG_ACTION_SELECT')."文章分组查询成功。";
        sys_log(session('adminId'),session('adminName'),$logcontent);   
       
        $this->display('Article/listarticlegroups');
    }

    /**
     *   添加文章分组大的方法
     */
    public function addArticleGroup() {
        //实例化ArticleGroup模型
       $articleGroupModel = D('ArticleGroup');   
        if (IS_POST) {
            $groupName=I('groupname');
            $parentId=I('parentid');
            if(empty($groupName)){
                $this->error('文章分组名不能为空');
            }
            
            //封装数据
            $data['group_name'] = $groupName;
            $data['parent_id']= $parentId;
        
              
            $result = $articleGroupModel->addArticleGroup($data);
            if ($result) {
                //管理员操作记录到日志表中   
               $logcontent = C('SYS_LOG_ACTION_ADD')."文章分组添加成功。" . "文章分组名：" . $groupName;
               sys_log(session('adminId'),session('adminName'),$logcontent);
               
                $this->success(L('ADD_ARTICLEGROUP_SUCCESS'), U('Article/listarticlegroups'));
            } else {
               //管理员操作记录到日志表中   
               $logcontent = C('SYS_LOG_ACTION_ADD')."文章分组添加成功。" . "文章分组名：" . $groupName;
               sys_log(session('adminId'),session('adminName'),$logcontent);
               
                $this->error(L('ADD_ARTICLEGROUP_FAILURE'));
            }
        } else{
            
            $this->display('Article/addarticlegroup');
        }
    }

    /**
     * 编辑文章分组的方法
     */
    public function editArticleGroup() {
        if (IS_POST) {
            //接受POST传递过来的参数
            $groupId = I('groupid');
            $groupName = I('groupname');
            $parentId=I('parentid');
            //封装数据
            $data['group_name'] = $groupName;
            $data['parent_id']=$parentId;
            //实例化ArticleGroup模型
            $articleGroupModel = D('ArticleGroup');

            $result = $articleGroupModel->saveArticleGroup($groupId, $data);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."文章分组编辑成功。" . "文章分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);
                
                $this->success(L('EDIT_ARTICLEGROUP_SUCCESS'), U('Article/listarticlegroups'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."文章分组编辑失败。" . "文章分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);
                
                $this->error(L('EDIT_ARTICLEGROUP_FAILURE'));
            }
        } else{
            //接受GET传递过来的参数
            $groupId = I('groupid');

            //实例化ArticleGroup模型
            $articleGroupModel = D('ArticleGroup');
            //编辑文章分组article_group中group_id为$groupid的一条数据
            $articleGroup = $articleGroupModel->selectArticleGroupById($groupId);
            
            //查找父行业信息
            $parentArticleGroup =$articleGroupModel->selectArticleGroupById($articleGroup['parent_id']);
                     
            //赋值到模版
            $this->assign('articlegroup', $articleGroup);
            $this->assign('parentarticlegroup',$parentArticleGroup);
            $this->display();
        }
    }

    /**
     * 删除文章分组的方法
     */
    public function deleteArticleGroup() {
        //接受GET传递过来的参数
        $groupId = I('groupid');

        //实例化ArticleGroup模型
        $articleGroupModel = D('ArticleGroup');
        
        //实列化Article模型
        $articleModel = D('Article');
        
       //查找文章分组article_group中group_id为$groupid的一条数据
        $articleGroup = $articleGroupModel->selectArticleGroupById($groupId);
        
        //查找文章表中group_id为$groupid的所有数据
        $group = $articleModel->selectArticlceByGroupId($groupId);
        
        //查找文章分组中的parentId
        $groupParentId= $articleGroupModel->selectArticleGroupByParentId($groupId);
        if ($group) {
            //管理员操作记录到日志表中
             $logcontent =C('SYS_LOG_ACTION_DELETE')."文章分组删除失败。原因：分类下有子类。" . "文章分组名：" .$articleGroup['group_name'];
             sys_log(session('adminId'),session('adminName'),$logcontent);
            
            $this->error(L('EXIST_SUBARTICLE'));
        } else {
            
            if(empty($groupParentId)){
                
            //删除文章分组    
            $del = $articleGroupModel->deleteArticleGroupById($groupId);
            
            if ($del) {
                 //管理员操作记录到日志表中
                   $logcontent = C('SYS_LOG_ACTION_DELETE')."文章分组删除成功。" . "文章分组名：" . $articleGroup['group_name'];
                   sys_log(session('adminId'),session('adminName'),$logcontent);
                
                   $this->success(L('DELTE_ARTICLEGROUP_SUCCESS'), U('Article/listarticlegroups'));
            } else {
                //管理员操作记录到日志表中
                  $logcontent = C('SYS_LOG_ACTION_DELETE')."文章分组删除失败。" . "文章分组名：" . $articleGroup['group_name'];
                  sys_log(session('adminId'),session('adminName'),$logcontent);
                
                  $this->error(L('DELTE_ARTICLEGROUP_FAILURE'));
            }
            }else{
               $this-> error(L('EXIST_SUBPARENTID'));
            }
        }
    }

    /**
     * 文章界面
     */
    public function listArticles() {
        //select all article information
        //实列化Article模型
        $articleModel = D('Article');
        //实例化ArticleGroup模型
        $articleGroupModel = D('ArticleGroup');

        //获取总的文章数
        $count = $articleModel->selectArticleTotalSize();

        //实例化分页类
        $page = new \Org\Page\Page($count,$this->adminPageSize);


        //获取每页显示的数据集
        $articles = $articleModel->selectArticleByPage($page);
        //分页显示输出
        $show = $page->show();
        //查找所有的文章分组
        $articleGroup = $articleGroupModel->selectAllArticleGroups();
        
        //管理员操作记录到日志表中
        $logcontent =  C('SYS_LOG_ACTION_SELECT')."文章管理查询成功";
        sys_log(session('adminId'),session('adminName'),$logcontent);
        $this->assign('articlegroup', $articleGroup);
        $this->assign('articles', $articles);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display('Article/listarticles');
    }

//    /**
//     * 添加文章的方法
//     */
    public function addArticle(){
        if (IS_POST) {
            //接受POST传递过来的值
            $articleName = I('articlename');
            $articleTitle = I('articletitle');
            $articleKeywords = I('articlekeywords');
            $articleDescription = I('articledescription');
            $groupId = I('groupid');
            $ishidden=I('ishidden');
            
            //调用上传图片的方法
            $file = $_FILES['articlepic'];
            $info = upload_img($file);
            //获取上传路径
            $articlePic = $info['savepath'] . $info['savename'];

            $articleContent = I('articlecontent');
            $articlebrowse=I('articlebrowse');
            $articleclick=I('articleclick');
            $articleauthor=I('articleauthor');
            $articleSummary = I('articlesummary');
            $articleaddTime=I('articleaddtime');
            //接收到的值不能为空 
//            if (empty($articleName)) {
//                $this->error('文章名不能为空');
//            }
//            if (empty($articleTitle)) {
//                $this->error('标题不能为空');
//            }
//            if (empty($groupId)) {
//                $this->error('文章分组不能为空');
//            }
            //封装数据
            $data['is_hidden']=$ishidden;
            $data['article_name'] = $articleName;
            $data['article_title'] = $articleTitle;
            $data['article_keywords'] = $articleKeywords;
            $data['group_id'] = $groupId;
            $data['article_pic'] = $articlePic;
            $data['article_description'] = $articleDescription;
            $data['article_content'] = $articleContent;
            $data['article_summary'] = $articleSummary;
            $data['article_browse']= $articlebrowse;
            $data['article_click']=$articleclick;
            $data['article_author']=$articleauthor;
            if(empty($articleaddTime)){
               $data['article_addtime'] = time();
            }else{
               $data['article_addtime']=strtotime($articleaddTime);  
            }

            //实列化Article模型
            $articleModel = D('Article');
            //添加文章信息
            $result = $articleModel->addArticle($data);
            //返回添加结果
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."文章管理添加成功。" . "文章名：" . $articleName;
                sys_log(session('adminId'),session('adminName'),$logcontent);
                
                $this->success(L('ADD_ARTICLE_SUCCESS'), U('Article/listarticles'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."文章管理添加失败。" . "文章名：" . $articleName;
                sys_log(session('adminId'),session('adminName'),$logcontent);
                
                $this->error(L('ADD_ARTICLE_FAILURE'));
            }
        } else{
            //实例化ArticleGroup模型
            $articleGroupModel = D('ArticleGroup');
            //查找文章分组表中所有的数据
            $articleGroup = $articleGroupModel->selectAllArticleGroups();
            //赋值到模版
            $this->assign('articlegroup', $articleGroup);
            $this->display('Article/addarticle');
        }
    }

    /**
     * 删除文章的方法
     */
    public function deleteArticle() {
        if (IS_GET){
            //接受GET传递过来的值
            $articleId = I('articleid');

            //实列化Article模型
            $articleModel = D('Article');
            //查找文章表中article_id为$articleId的一条数据
            $article = $articleModel->selectArticleById($articleId);
            // 删除文章表中article_id为$articleid的一条数据
            $result = $articleModel->deleteArticleById($articleId);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."文章删除成功。" . "文章名：" .$article['article_name'];
                sys_log(session('adminId'),session('adminName'),$logcontent);
                
                $this->success(L('DELTE_ARTICLE_SUCCESS'), U('Article/listarticles'));
        } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."会员删除成功。" . "用户名：" .$article['article_name'];
                sys_log(session('adminId'),session('adminName'),$logcontent);           
            
                $this->error(L('DELTE_ARTICLE_FAILURE'));
        }
    }
    }

    /**
     * 编辑文章
     */
    public function editArticle() {
        if (IS_POST) {
            //接受POST传递过来的参数
            $articleId = I('articleid');
            $articleName = I('articlename');
            $articleTitle = I('articletitle');
            $articleKeywords = I('articlekeywords');
            $articleDescription = I('articledescription');
            $groupId = I('groupid');
            $ishidden=I('ishidden');
            // 调用上传图片的方法
            $file = $_FILES['articlepic'];
            $info = upload_img($file);
            //获取上传路径
            if ($info) {
                $articlePic = $info['savepath'] . $info['savename'];
            } else {
                $articlePic = $_FILES['articlepic'];
            }
            $articleContent = I('articlecontent');
            $articleSummary = I('articlesummary');
            $articleaddtime=I('articleaddtime');
         
            //接收到的值不能为空 
            if (empty($articleName)) {
                $this->error('文章名不能为空');
            }
            if (empty($articleTitle)) {
                $this->error('标题不能为空');
            }
            if (empty($groupId)) {
                $this->error('文章分组不能为空');
            }
            //封装数据
            $data['is_hidden']=$ishidden;
            $data['article_name'] = $articleName;
            $data['article_title'] = $articleTitle;
            $data['article_keywords'] = $articleKeywords;
            $data['group_id'] = $groupId;
            $data['article_pic'] = $articlePic;
            $data['article_description'] = $articleDescription;
            $data['article_content'] = $articleContent;
            $data['article_summary'] = $articleSummary;
            if(empty($articleaddtime)){
               $data['article_addtime'] = time();
            }else{
               $data['article_addtime']=strtotime($articleaddtime);  
            }
           

            //实列化Article模型
            $articleModel = D('Article');
            //添加文章信息
            $result = $articleModel->saveAriticle($articleId, $data);
            //返回编辑结果
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."文章编辑成功。" . "文章名：" . $articleName ;
                sys_log(session('adminId'),session('adminName'),$logcontent);
                
                $this->success(L('EDIT_ARTICLE_SUCCESS'), U('Article/listarticles'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."文章编辑失败。" . "文章名：" . $articleName ;
                sys_log(session('adminId'),session('adminName'),$logcontent);
                
                $this->error(L('EDIT_ARTICLE_FAILURE'));
            }
        } else{

            //接受GET传递过来的参数
            $articleId = I('articleid');

            //实列化Article模型
            $articleModel = D('Article');
            // //实例化ArticleGroup模型
            $articleGroupModel = D('ArticleGroup');

            //查找文章分组表中所有的数据
            $articleGroup = $articleGroupModel->selectAllArticleGroups();


            //查找文章表中article_id为$articleId的一条数据
            $article = $articleModel->selectArticleById($articleId);

            //赋值到模版
            $this->assign('article', $article);
            $this->assign('articlegroup', $articleGroup);
            $this->display();
        }
    }



    //ajax 提交改变ishidden 字段参数
    public function isHidden(){

        if(IS_POST){
            $ishidden=I('ishidden');
            $articleId=I('articleid');
            //实例化Singlepagemodel类
            $ArticleModel=D('Article');
            //封装数据
            $data['tasks_status']= $ishidden;
            //编辑单页表singlepage中singlepage_id为$singlepageId的一条数据
            $result=$ArticleModel->saveAriticle($articleId, $data);
            
            //var_dump($data);

            if($result){
                $ishiddens = array(

                    'status' => C('JSON_SUCCESS_CODE'),

                );
            }
            $this->ajaxReturn($ishiddens);
        }
    }

}
