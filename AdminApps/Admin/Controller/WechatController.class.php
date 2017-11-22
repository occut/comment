<?php
/**
 * Created by PhpStorm.
 * User: occur
 * Date: 2017/7/9
 * Time: 18:49
 */
namespace Admin\Controller;

use Think\Controller;

class WechatController extends SuperController {
    /**
     * 显示weichat用户  正常
     */
    public function WechaGroups() {
        //实例化UserGroup模型
        $WechaModel = D('Weichat');
        //获取总的用户数
        $id = 4;
        $count = $WechaModel->selectWeichatTotalSize($id);
//        dump($count);
        //实例化分页类
        $page = new \Org\Page\Page($count, 100);
        //获取每页显示的数据集
        $userGroups = $WechaModel->selectWeichatByPage($page);
        //分页显示输出
        $show = $page->show();
        //管理员操作记录到日志表中
        $logcontent = C('SYS_LOG_ACTION_SELECT') . "会员分组查询成功。";
        sys_log(session('adminId'), session('adminName'), $logcontent);
        //赋值到模版
        $this->assign('usergroups', $userGroups);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('static',0);
        $this->display('Wechat/listWechatGroups');
    }
    //账户异常
    public function WechaAbnormal() {
        //实例化UserGroup模型
        $WechaModel = D('Weichat');
        //获取总的用户数
        $id = 5;
        $count = $WechaModel->selectWeichatTotalSize($id);
//        dump($count);
        //实例化分页类
        $page = new \Org\Page\Page($count, 100);
        //获取每页显示的数据集
        $userGroups = $WechaModel->selectWeichatByPageabnormal($page);
        //分页显示输出
        $show = $page->show();
        //管理员操作记录到日志表中
        $logcontent = C('SYS_LOG_ACTION_SELECT') . "会员分组查询成功。";
        sys_log(session('adminId'), session('adminName'), $logcontent);
        //赋值到模版
        $this->assign('usergroups', $userGroups);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('static',0);
        $this->display('Wechat/listWechatGroups');
    }
//导出
    public function WeExport(){
        $taskid=I('wei_static');
        $WechaModel = D('Weichat');
        $data['wei_static']= $taskid;
        if($taskid == ""){
            $Weicha = $WechaModel->select();
        }else{
            $Weicha = $WechaModel->where($data)->select();
        }
        $a = implode("\r\n",[1,2]);
        $arr = [];
        foreach ($Weicha as $vo){
            $arr[] = $vo['wei_name'].'----'.$vo['wei_password'].'----'.$vo['wei_data'];
        }
        $a = implode("\r\n",$arr);
        $this->assign('data',$a);
        $this->display('Wechat/WeExport');
    }
    //导入
    public function Import(){
        if(IS_GET){
            $this->display('Wechat/Import');
        }else{
         $taskid=I('desc');
         $WechaModel = D('Weichat');
            $result = preg_split('/[;\r\n]+/s', $taskid);

            $a = explode("\r\n",$taskid);
//        var_dump($result);
//        die;
        foreach ($result as $b){
            $c = explode("----",$b);
            $data['wei_name'] = $c[0];
            $f['wei_name'] = $c[0];
            $data['wei_password'] = $c[1];
            $data['wei_data'] = $c[2];
            $data['admin_id']=session('adminId');
            $va = $WechaModel->where($f)->select();
            if(!empty($va)){
                $data = '';
            }
            if($data !=''){
                $value = $WechaModel->add($data);
//                var_dump($value."1");
            }

        }
            echo 1;
        }
    }
    public function idcardImport(){
        if(IS_GET){
            $this->display('Wechat/idcardImport');
        }else{
            $taskid=I('desc');
//            echo "<pre/>";
//            echo $taskid;
            $WechaModel = D('IdCard');
            $result = preg_split('/[;\r\n]+/s', $taskid);
//            $a = explode("\r\n",$taskid);
//            var_dump($result);
//            die;
            foreach ($result as $b){
                $c = explode("----",$b);
                $data['card_name'] = $c[0];
                $f['card_number'] = $c[1];
                $data['card_number'] = $c[1];
                $va = $WechaModel->where($f)->select();
                if(!empty($va)){
                    $data = '';
                }
                if($data !=''){
                    $value = $WechaModel->add($data);
                }
            }
            echo 1;
        }
    }
    //禁用
    public function WechaGroupsDisable(){
        //实例化UserGroup模型
        $WechaModel = D('Weichat');
        //获取总的用户数
        $id = 1;
        $count = $WechaModel->selectWeichatTotalSize($id);
//        $count = $WechaModel->selectWeichatTotalSize();
//        dump($count);
        //实例化分页类
        $page = new \Org\Page\Page($count, 1000);
        //获取每页显示的数据集
        $userGroups = $WechaModel->selectWeichatByPage1($page);
        //分页显示输出
        $show = $page->show();
        //管理员操作记录到日志表中
        $logcontent = C('SYS_LOG_ACTION_SELECT') . "会员分组查询成功。";
        sys_log(session('adminId'), session('adminName'), $logcontent);
        //赋值到模版
        $this->assign('usergroups', $userGroups);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('static',1);
        $this->display('Wechat/listWechatGroups');
    }
    //全部
    public function WechaGroupsWhole(){
        //实例化UserGroup模型
        $WechaModel = D('Weichat');
        //获取总的用户数
        $id = 0;
        $count = $WechaModel->selectWeichatTotalSize($id);
//        $count = $WechaModel->selectWeichatTotalSize();
//        dump($count);
        //实例化分页类
        $page = new \Org\Page\Page($count, 100);
        //获取每页显示的数据集
        $userGroups = $WechaModel->selectWeichatByPage2($page);
        //分页显示输出
        $show = $page->show();
        //管理员操作记录到日志表中
        $logcontent = C('SYS_LOG_ACTION_SELECT') . "会员分组查询成功。";
        sys_log(session('adminId'), session('adminName'), $logcontent);
        //赋值到模版
        $this->assign('usergroups', $userGroups);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('static','');
        $this->display('Wechat/listWechatGroups');
    }
    //登录中
    public function WechaGroupsLogin(){
        //实例化UserGroup模型
        $WechaModel = D('Weichat');
        //获取总的用户数
        $id = 0;
        $count = $WechaModel->selectWeichatTotalSize($id);
//        $count = $WechaModel->selectWeichatTotalSize();
//        dump($count);
        //实例化分页类
        $page = new \Org\Page\Page($count, 100);
        //获取每页显示的数据集
        $userGroups = $WechaModel->selectWeichatByPage3($page);
        //分页显示输出
        $show = $page->show();
        //管理员操作记录到日志表中
        $logcontent = C('SYS_LOG_ACTION_SELECT') . "会员分组查询成功。";
        sys_log(session('adminId'), session('adminName'), $logcontent);
        //赋值到模版
        $this->assign('usergroups', $userGroups);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('static','2');
        $this->display('Wechat/listWechatGroups');
    }
    public function  WechaIdCard(){
        $IdCard = D('IdCard');
        $count = $IdCard->selectIdCardTotalSize();
//        dump($count);
        //实例化分页类
        $page = new \Org\Page\Page($count, 100);
        //获取每页显示的数据集
        $userGroups = $IdCard->selectIdCardByPage($page);
        //分页显示输出
        $show = $page->show();
        //管理员操作记录到日志表中
        $logcontent = C('SYS_LOG_ACTION_SELECT') . "会员分组查询成功。";
        sys_log(session('adminId'), session('adminName'), $logcontent);
        //赋值到模版
        $this->assign('usergroups', $userGroups);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('static','2');
        $this->display('Wechat/WechaIdCard');
    }
    public function deleteWechat(){
        $WechaModel = D('Weichat');
        $taskid=I('wei_id');
        $a['wei_id'] = $taskid;
//        var_dump($a);
        $value = $WechaModel->where($a)->delete();
//        var_dump($value);
//        die;
        if($value){
            $this->success(L('DELTE_ARTICLE_SUCCESS'));
        }else{
            $this->error(L('DELTE_ARTICLE_FAILURE'));
        }
//        var_dump($taskid);
    }
    public function deleteWechats(){
        $WechaModel = D('Weichat');
        $taskid=I('ids');
//        var_dump($taskid);
        $a['wei_id'] = array('in',$taskid);
        $value = $WechaModel->where($a)->delete();
//        var_dump(!empty($value));
        if ($value){
            echo 1;
            die;
        }
           echo 2;
//       echo 123;
    }
    public function state(){
        $WechaModel = D('Weichat');
        $taskid=I('ids');
//        var_dump($taskid);
        $a['wei_id'] = array('in',$taskid);
        $data['wei_static'] = 0;
        $value = $WechaModel->where($a)->save($data);
        if ($value){
            echo 1;
        }else{
            echo 2;
        }

    }
}