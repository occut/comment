<?php
/**
 * Functions: 导航.
 * Author: Li Ming
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */
namespace Admin\Controller;

use Think\Controller;

class NavigationController extends SuperController{
    /**
     * 显示导航分组界面
     */
    public function listNavigations() {

        //管理员操作记录到日志表中
        $logcontent =C('SYS_LOG_ACTION_SELECT')."导航分组查询成功。";
        sys_log(session('adminId'),session('adminName'),$logcontent);
        $this->display('Navigation/listnavigations');
    }
    //显示设备分组
    public function deviceGrouping(){
        $taskGroupModel = D('TasksGroup');
        $Grouping = D('Grouping');
        $tasks = $Grouping->order('id ASC')->select();
        //获取总的任务数
        $count = $Grouping->selectUserGroupTotalSize();
        //实例化分页类
        $page = new \Org\Page\Page($count,$this->adminPageSize);
        //获取每页显示的数据集
        $tasksGroup = $Grouping->selectGroupingByPage($page);
        //分页显示输出
        $show = $page->show();
        //管理员操作记录到日志表中
        $logcontent =  C('SYS_LOG_ACTION_SELECT')."任务管理查询成功";
        sys_log(session('adminId'),session('adminName'),$logcontent);
        $taskModel = D('Tasks');
//        print_r($tasks);
        $this->assign('tasksGroup',$tasksGroup);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display('Navigation/deviceGrouping');
    }
    /**
     *   添加导航分组大的方法
     */
    public function addNavigation() {
        //实例化Navigation模型
        $NavigationModel = D('Navigation');
        if (IS_POST) {
            //配置名称
            $groupName=I('navname');
            $parentId=I('parentid');
            //附带图片
            $ishidden=I('ishidden');
            $url=I('navigationurl');
            $num=I('urlnum');
            $isout=I('isout');
            $isnewpage=I('isnewpage');
            $navtitle=I('navtitle');
            $navkeywrods=I('navkeywords');

            $navdescription=I('navdescription');
            //配置参数
            $navOrder=I('navorder');
            if(empty($groupName)){
                $this->error('导航分组名不能为空');
            }
//            if(empty($url)){
//                $this->error('导航地址并不能为空');
//            }
            //封装数据
            $data['nav_order']=$navOrder;
            $data['is_out']=$isout;
            $data['is_new_page']=$isnewpage;
            $data['nav_keywords']=$navkeywrods;
            $data['nav_title']=$navtitle;
            $data['nav_description']=$navdescription;
            $data['nav_name'] = $groupName;
            $data['parent_id']= $parentId;
            $data['is_hidden']=  $ishidden;
            $data['nav_url']=$url;
            $data['url_num']=$num;
            $data['admin_id']=session('adminId');

            $result =  $NavigationModel->addNavigation($data);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."导航分组添加成功。" . "导航分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('ADD_NAVGROUP_SUCCESS'), U('Navigation/listnavigations'));
            }
            else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."导航分组添加成功。" . "导航分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('ADD_NAVGROUP_FAILURE'));
            }
        }
        else{
            $this->display('Navigation/addnavigation');
        }
    }

    /**
     * 编辑导航分组的方法
     */
    public function editNavigation() {
        if (IS_POST) {
            //接受POST传递过来的参数
            $navOrder=I('navorder');
            $groupId = I('navid');
            $groupName = I('navname');
            $parentId=I('parentid');
            $num=I('urlnum');
            $url=I('navigationurl');
            $ishidden=I('ishidden');
            $isout=I('isout');
            $isnewpage=I('isnewpage');
            $navtitle=I('navtitle');
            $navkeywrods=I('navkeywords');
            $navdescription=I('navdescription');
            //封装数据
            $data['nav_order']=$navOrder;
            $data['is_out']=$isout;
            $data['is_new_page']=$isnewpage;
            $data['nav_keywords']=$navkeywrods;
            $data['nav_title']=$navtitle;
            $data['nav_description']=$navdescription;
            $data['nav_url']=$url;
            $data['url_num']=$num;
            $data['is_hidden']=$ishidden;
            $data['nav_name'] = $groupName;
            $data['parent_id']=$parentId;
            //实例化Navigation模型
            $NavigationModel = D('Navigation');

            $result =  $NavigationModel->saveNavigation($groupId, $data);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."导航分组编辑成功。" . "导航分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('EDIT_NAVGROUP_SUCCESS'), U('Navigation/listnavigations'));
            }
 else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."导航分组编辑失败。" . "导航分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('EDIT_NAVGROUP_FAILURE'));
            }
        } else{
            //接受GET传递过来的参数
            $groupId = I('navid');

            //实例化Navigation模型
            $NavigationModel = D('Navigation');
            //编辑导航分组navigation_group中group_id为$groupid的一条数据
            $Navigation =$NavigationModel->selectNavigationById($groupId);
//			print_r($Navigation);

            //查找父行业信息
            $parentNavigation =$NavigationModel->selectNavigationById($Navigation['parent_id']);

            //赋值到模版
            $this->assign('navigation', $Navigation);
            $this->assign('parentnavigation',$parentNavigation);
            $this->display();
        }
    }

    /**
     * 删除导航分组的方法
     */
    public function deleteNavigation() {
        //接受GET传递过来的参数
        $groupId = I('navid');

        //实例化Navigation模型
        $navigationModel = D('Navigation');

        //查找导航分组navigation_group中group_id为$groupid的一条数据
        $navigation = $navigationModel->selectNavigationById($groupId);

        //查找导航分组中的parentId
        $groupParentId= $navigationModel->selectNavigationByParentId($groupId);

            if(empty($groupParentId)){

                //删除导航分组
                $del = $navigationModel->deleteNavigationById($groupId);

                if ($del) {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_DELETE')."导航分组删除成功。" . "导航分组名：" . $navigation['nav_name'];
                    sys_log(session('adminId'),session('adminName'),$logcontent);

                    $this->success(L('DELTE_NAVGROUP_SUCCESS'), U('Navigation/listnavigations'));
                } else {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_DELETE')."导航分组删除失败。" . "导航分组名：" .$navigation['nav_name'];
                    sys_log(session('adminId'),session('adminName'),$logcontent);

                    $this->error(L('DELTE_NAVGROUP_FAILURE'));
                }
            }else{
                $this-> error(L('EXIST_SUBPARENTID'));
            }
        }



//    ajax调取数据
    public function geturl(){
        //实例化SinglepageModel
        $SinglepageModel=D('Singlepage');
        $singlepagelist=$SinglepageModel->selectAllSinglepage();
        $str='';

        $str.='<tr ><th style="text-align: left ;padding-left: 30px">网站首页</th><th></th></tr>';
        $str.='<tr ><td style="text-align:left ;line-height: 36px;padding-left: 60px">网站首页</td>';
        $str.='<td style="text-align: right ;padding-right: 30px"><button onclick="urllist(this)" class="btn btn-primary">点击选中</b></td>';
        $str.='<td style="text-align:  right ;display: none">'.C('INDEX').'</td>';
        $str.='</tr>';

        //获取单页url
        $str.='<tr "><th style="text-align: left ;padding-left: 30px">单页管理</th><th></th></tr>';
        foreach($singlepagelist as $k=>$v){
            $str.='<tr>';
             $str.='<td style="text-align:left;line-height: 36px;padding-left:60px">'.$v['singlepage_name'].'</td>';
            $str.='<td style="text-align: right ;padding-right: 30px"><button onclick="urllist(this)" class="btn btn-primary">点击选中</b></td>';
            $str.='<td style="text-align: right ;display: none">'.C('SINGLEPAGE').'singlepageid/'.$v['singlepage_id'].'</td>';

            $str.='</tr>';
        }

        //获取新闻url
        $str.='<tr ><th style="text-align: left ;padding-left: 30px">文章</th><th></th></tr>';
        $str.='<tr>';
        $str.=  articlegrouplist(0);
        $str.='</tr>';

//        //获取案例url
//        $str.='<tr ><th style="text-align: left ;padding-left: 30px">成功案例</th><th></th></tr>';
//        $str.='<tr>';
//        $str.= casegrouplist(22);
//        $str.='</tr>';

        //获取产品url
        $str.='<tr><th style="text-align: left ;padding-left: 30px">产品中心</th><th></th></tr>';
        $str.='<tr>';
        $str.=  productgrouplist(0);
        $str.='</tr>';

        //获取人才招聘url
        $str.='<tr><th style="text-align: left ;padding-left: 30px">人才招聘</th><th></th></tr>';
        $str.='<tr>';
        $str.=  hrgrouplist(0);
        $str.='</tr>';

        //获取留言url
        $str.='<tr ><th style="text-align: left;padding-left: 30px">在线留言</th><th></th></tr>';
        $str.='<tr ><td style="text-align: left;line-height: 36px;padding-left: 60px">在线留言</td>';
        $str.='<td style="text-align: right ;padding-right: 30px"><button onclick="urllist(this)" class="btn btn-primary">点击选中</b></td>';
        $str.='<td style="text-align:  right;display: none">'.C('MESSAGE').'</td>';
        $str.='</tr>';

        $userdata = array(
            'status' => C('JSON_SUCCESS_CODE'),
            'content' => $str,
        );

        $this->ajaxReturn($userdata);

    }


    //ajax 提交改变ishidden 字段参数
    public function isHidden(){

        if(IS_POST){
            $ishidden=I('ishidden');
            $navId=I('navid');
            //实例化Singlepagemodel类
            $NavigationModel=D('Navigation');
            //封装数据
            $data['is_hidden']= $ishidden;
            //编辑单页表singlepage中singlepage_id为$singlepageId的一条数据
            $result= $NavigationModel->saveNavigation($navId, $data);

            if($result){
                $ishiddens = array(

                    'status' => C('JSON_SUCCESS_CODE'),

                );
            }
            $this->ajaxReturn($ishiddens);
        }
    }


}

