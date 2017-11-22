<?php

/**
 * Functions: Api控制器.
 * Author: Li Yang
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Api\Controller;

use Think\Controller;

class ApiController extends Controller{
   public function select(){
        if(IS_GET)
        {
            $tasks_status=I('get.tasks_status');
            $admin_name=I('get.admin_name');
            $adminModel = D('Admin');
            $user['admin_name'] = $admin_name;
            $userId = $adminModel->where($user)->find();
//            var_dump($userId['admin_id']);
            $User=M('Taskstime');
            $a['time_status']=$tasks_status;
            $a['admin_id'] = $userId['admin_id'];
//            var_dump($a);
            $data=$User->where($a)->order('time_id ASC')->select();
//            var_dump($data);
//            die;
            foreach ($data as $k=>$v)
            {
                echo $data[$k]['time_id'].",".$data[$k]['time_title'].",".$data[$k]['group_name']."|";
            }
        }
        if(!$data) {// 上传错误提示错误信息
            echo "0";
        }
    }
//返回任务
public function messages(){
    $id=I('get.id');
    $User=M('Taskstime');
    $a['time_id']=$id;
//            var_dump($a);
    $data=$User->where($a)->find();
    $aa = "title:".$data['time_title'].'|'.'group:'.$data['group_name'].'|'.'URL:'.$data['time_url'].'|'.'Jingwei:'.$data['time_ip'].'|'.'OrderQuantity:'.$data['time_flow'].'|'.'complete:'.$data['time_complete'].'|'.'starttime:'.$data['time_starttime'].'|'.'endtime:'.$data['time_endtime'];

    // mb_convert_encoding($aa,'utf-8',mb_detect_encoding($aa));
    echo utf8_encode($aa);

//    var_dump($data);
}
    public function Setup(){
        if(IS_GET){
            $tasks_name=I('get.tasks_id');
            $tasks_status=I('get.tasks_status');
            $User=M('tasks');
            $a['tasks_id'] = $tasks_name;
            $test=$User->where($a)->select();
//            var_dump($test);
            $status = $test[0]["tasks_status"];
            if($tasks_status == $status){//任务代码错误提示
                echo "0";
                die;
            }
            $a['tasks_id'] = $tasks_name;
            $data['tasks_status'] = $tasks_status;
            $data=$User->where($a)->save($data);
            if($data){
                echo "1";
            }else{
                echo "0";
            }
        }
    }
    //任务进度
    public function state(){
        if(IS_GET){
            $tasks_state=I('get.tasks_state');
            $tasks_name=I('get.tasks_id');
            $User=M('tasks');
            $a['tasks_id'] = $tasks_name;
            $test=$User->where($a)->select();
            $status = $test[0]["tasks_state"];
            if($tasks_state == $status){//任务代码错误提示
                echo "0";
                die;
            }
            $data['tasks_state'] = $tasks_state;
            $data=$User->where($a)->save($data);
            if($data){
                echo "1";
            }else{
                echo "0";
            }
        }
    }
    public function states(){
        $equlist=I('get.equlist');
        $tasks_name=I('get.tasks_name');
        $tasks_state=I('get.tasks_state');
        $Grouping = D('Grouping');
        $a['equlist']=$equlist;
//        var_dump($a);
        $tasks = $Grouping->where($a)->select();
//        var_dump($tasks);
        if(empty($tasks)){
            echo "0";
            die;
        }
//        dump($tasks[0]['tasks_name']);
        if($tasks[0]['tasks_name'] ==$tasks_name){
            $data['tasks_state']=$tasks_state;
            $data=$Grouping->where($a)->save($data);
        }else{
            $data['tasks_name']=$tasks_name;
            $data['tasks_state']=$tasks_state;
            $data=$Grouping->where($a)->save($data);
        }
//        var_dump($data);
//        if($data){
            echo "1";
//        }else{
//            echo "失败";
//        }

    }
    //任务量
    public function complete(){
        if(IS_GET){
            $equlist=I('get.equlist');
//            $equlist=I('get.tasks_id');
            $tasksGroup=M('TasksGroup');
//            $a['equlist'] = $equlist;
//            $test=$tasksGroup->where($a)->select();
//            var_dump($test);
//        if($equlist == $test[0]['equlist']){
            $tasks_name=I('get.tasks_id');
            $User=M('tasks');
            $a['tasks_id'] = $tasks_name;
            $test=$User->where($a)->select();
            $status = $test[0]["tasks_number"];
            $tasks_complete = $test[0]["tasks_complete"];
            ++$tasks_complete;
            if($status == $tasks_complete){
                $data['tasks_status'] = 1;
                $data['tasks_complete'] = 0;
                $data=$User->where($a)->save($data);
                if($data){
                    echo "1";
                }else{
                    echo "0";
                }
                die;
            }
            $data['tasks_complete'] = $tasks_complete;
//            var_dump($data);
//            var_dump($a);
            $d=$User->where($a)->save($data);
//            var_dump($d);
//            die;
            if($d){
                echo "1";
            }else{
                echo "0";
            }
        }
//        }
    }


    public function select_messages(){
        if(IS_GET)
        {
            $name=I('get.tasks_name');
            $id=I('get.tasks_id');
            $navigation=M('navigation');
            $a['nav_name']=$name;
            $data=$navigation->where($a)->select();
            foreach ($data as $k=>$v)
            {
                if($data[$k]['nav_url']!="")
                {
                    $isurl="有图片";
                    $url=$data[$k]['nav_url'];
                    $num=$data[$k]['url_num'];
                }
                if($data[$k]['nav_url']=="")
                {
                    $isurl="无图片";
                    $url="";
                    $num="0";                }
            }
            if($data[$k]['tasks_status']==0)
            {
                $zhuangtai="开启";
            }
            if($data[$k]['tasks_status']==1)
            {
                $zhuangtai="关闭";
            }
            $tasks=M('tasks');
            $b['tasks_id']=$id;
            $data1=$tasks->where($b)->order('tasks_id')->select();
            foreach ($data1 as $k1=>$v1)
            {
                $group=$data1[$k1]['group_name'];
                $info=$data1[$k1]['tasks_configs'];
            }
            echo $isurl.":".$name.",".$group.",".$info.",".$num.",".$url;
        }
        if(!$data) {// 上传错误提示错误信息
            echo "0";
        }
    }
    public function selectgroup(){
        if(IS_GET)
        {
            $group_name=I('get.group_name');
            $user=M('tasks_group');
            $a['group_name']=$group_name;
            $data=$user->where($a)->order('group_id ASC')->select();
            foreach ($data as $k=>$v)
            {
                echo utf8_encode($data[$k]['equlist']);
            }
        }
        if(!$data) {
            echo "0";
        }
    }
    //判断设备
    public function equipment(){
        if(IS_GET) {
            $equlist=I('get.equlist');
            $group_name=I('get.group_name');
            $taskGroupModel = D('TasksGroup');
            $a['group_name']=$group_name;
            $arr = $taskGroupModel->where($a)->select();
            $equlist1 = explode(',',$arr[0]['equlist']);
            $value = in_array($equlist,$equlist1);
            if($value){
                echo "1";
            }else{
                echo "0";
            }
        }
    }
    //返回账号
    public function wechart(){
        if(IS_GET){
            $WechaModel = D('Weichat');
            $b[wei_static] = 0;
            $idcard = $WechaModel->where($b)->order("wei_id ASC")->find();
            $a['wei_id'] = $idcard['wei_id'];
            $data['wei_static'] = 2;
            $value = $WechaModel->where($a)->save($data);
            if($idcard == ''){
                echo "0";
            }else{
                echo $idcard['wei_name'].','.$idcard['wei_password'].','.$idcard['wei_data'];
            }

        }
    }
    //添加账号
    public function addwechart(){
        $name = I('get.name');
        $password = I('get.password');
        $admin_name = I('get.admin');
        $WechaModel = D('Weichat');
        $adminModel = D('Admin');
        $user['admin_name'] = $admin_name;
        $userId = $adminModel->where($user)->find();
        $data['wei_name'] = $name;
        $f['wei_name'] = $name;
        $data['wei_password'] =$password;
        $data['admin_id']=$userId['admin_id'];
        $va = $WechaModel->where($f)->select();
        if(!empty($va)){
            $data = '';
        }
        $value = '';
        if($data !=''){
            $value = $WechaModel->add($data);
            }
            if($value){
            echo "1";
            }else{
                echo "0";
            }
    }
    //传入账号
    public function account(){
        if(IS_GET) {
            $equlist = I('get.wei_equipment');
            $name = I('get.wei_name');
            $password = I('get.wei_password');
            $static = I('get.wei_static');
            $remarks = I('get.wei_remarks');
            $data['wei_equipment'] = I('get.wei_equipment');
//            $data['wei_name'] = I('get.wei_name');
//            $data['wei_password'] = I('get.wei_password');
            $data['wei_static'] = I('get.wei_static');
            $data['wei_remarks'] = I('get.wei_remarks');
            $WechaModel = D('Weichat');

            $a['wei_name']=str_replace(' ','+',$name);
            $user = $WechaModel->where($a)->select();
            if(!$user){
                echo "0";
                die;
            }
            if($password == $user[0]['wei_password']){
                $value = $WechaModel->where($a)->save($data);
                if($value){
                    echo "1";
                    die;
                }else{
                    echo "0";
                    die;
                };
            }else{
                echo "0";
            }
        }
    }
    //删除账号
    public function accountdelete(){
        if(IS_GET) {
            $name = I('get.wei_name');
            $a['wei_name']= str_replace(' ','+',$name);
            $WechaModel = D('Weichat');
            $user = $WechaModel->where($a)->delete();
            //var_dump($user);
            if($user){
                echo "1";
            }else{
                echo "0";
            }
        }
    }
    //返回身份证账号
    public function idcard(){
        if(IS_GET){
            $IdCardModel = D('IdCard');
            $idcard = $IdCardModel->find();
//            var_dump($idcard);
            echo $idcard['card_id'].','.$idcard['card_name'].','.$idcard['card_number'];
        }
    }
    //删除身份证账号
    public function idcarddelete(){
        if(IS_GET) {
            $name = I('get.card_id');
            $a['card_id']= $name;
            $IdCardModel = D('IdCard');
            $user = $IdCardModel->where($a)->delete();
            if($user){
                echo "1";
            }else{
                echo "0";
            }
        }
    }
    //返回任务量
    public function quantity(){
        $tasks_status=I('get.tasks_id');
        $User=M('tasks');
        $a['tasks_id'] = $tasks_status;
        $user = $User->where($a)->find();
        if(!empty($user)){
            echo $user['tasks_number'];
            die;
        }else{
            echo "失败";
        }

    }
    //任务完成量
    public function quancomplete(){
        $tasks_status=I('get.tasks_id');
        $User=M('tasks');
        $a['tasks_id'] = $tasks_status;
        $user = $User->where($a)->find();
        if(!empty($user)){
            echo $user['tasks_complete'];
            die;
        }else{
            echo "失败";
        }
    }
    //返回文件资源
    public function images(){
        if(IS_GET){
            $admin_name=I('get.name');
            $adminModel = D('Admin');
            $user['admin_name'] = $admin_name;
            $userId = $adminModel->where($user)->find();
            $UploadModel=D('Upload');
            $a['admin_id'] = $userId['admin_id'];
            $image = $UploadModel->where($a)->select();
//            var_dump($image);
            if(!empty($image)){
                foreach ($image as $vo){
                    $array[]= $vo['upload_name'].'----'.$vo['upload_path'];
                }
//            var_dump($array);
                foreach ($array as $a){
                    echo $a.'|';
                }
            }else{
                echo "0";
            }

        }

    }
    //返回文章资源
    public function content(){
        if(IS_GET){
            $admin_name=I('get.name');
            $adminModel = D('Admin');
            $user['admin_name'] = $admin_name;
            $userId = $adminModel->where($user)->find();
            $a['admin_id'] = $userId['admin_id'];
            $TextaraeaModel=D('Textarea');
            $value = $TextaraeaModel->where($a)->find();
//            var_dump($value['text_content']);
            if(empty($value)){
                echo "0";
            }else{
                $result = preg_split('/[;\r\n]+/s', $value['text_content']);
                foreach ($result as $value){
                    echo $value."----";
                }
            }

        }
    }
    //一键关闭用户下的任务
    public function superesc(){
        if(IS_GET){
            $admin_name=I('get.name');
            $taskid =I('get.static');
//            var_dump($admin_name);
            $taskModel = D('Tasks');
            $adminModel = D('Admin');
            $admin['admin_name'] = $admin_name;
            $value = $adminModel->where($admin)->find();
            if(!$value){
                echo "0";
                die;
            }
            $admin_id = $value['admin_id'];
            $a['tasks_status'] = $taskid;
            $b['admin_id'] = $admin_id;
            $tasks = $taskModel->where($b)->save($a);
            if($tasks){
                echo "1";
            }else{
                echo "0";
            }
        }
    }
    public function disable(){//被删除账号统计
        $DisableModel = D('Disable');
        $test=$DisableModel->select();
        $value = $test[0]['value'];
        ++$value;
        $a['id'] = $test[0]['id'];
        $data['value'] = $value;
        $data=$DisableModel->where($a)->save($data);
    }
    public function modify(){
        if(IS_GET){
            $name = I('get.name');
            $password = I('get.password');
            $WechaModel = D('Weichat');
            $a['wei_name']= str_replace(' ','+',$name);
            $data['wei_password'] = $password;
//            var_dump($name);
            $data=$WechaModel->where($a)->save($data);
            if($data){
                echo '1';
            }else{
                echo '0';
            }
        }
    }
    //更改任务金币数
    public function wechatgold(){
        if(IS_GET){
            $name = I('get.name');
            $gold = I('get.gole');
//            $password = I('get.password');
            $WechaModel = D('Weichat');
            $a['wei_name']= str_replace(' ','+',$name);
            $data['wei_gold'] = $gold;
//            var_dump($name);
            $data=$WechaModel->where($a)->save($data);
            if($data){
                echo '1';
            }else{
                echo '0';
            }
        }
    }

     public function completel(){
        if(IS_GET){
            $time_id=I('get.time_id');
            $taskModel = D('Taskstime');
            $a['time_id'] = $time_id;
            $test=$taskModel->where($a)->find();
            $time_flow = $test["time_flow"];//下单
            $time_complete = $test["time_complete"];//完成
            ++$time_complete;
            if( $time_complete >= $time_flow){
                $data['time_status'] = 1;
                $data['time_complete'] = $time_complete;
                $data=$taskModel->where($a)->save($data);
                if($data){
                    echo "1";
                }else{
                    echo "0";
                }
                die;
            }
            $data['time_complete'] = $time_complete;
            $d=$taskModel->where($a)->save($data);
            if($d){
                echo "1";
            }else{
                echo "0";
            }
        }
    }
    //大众点评任务
    public function tasks(){
        if(IS_GET) {
            $equipment = I('id');
            $group_name=I('get.group_name');
            $taskGroupModel = D('TasksGroup');
            $a['group_name']=$group_name;
            $arr = $taskGroupModel->where($a)->find();
            $equlist1 = explode(',',$arr['equlist']);
            $value = in_array($equipment,$equlist1);
            $taskModel = D('Taskstime');
            $a['time_status'] = 0;
            $a['group_name'] = $arr['group_name'];
            $a['equipment_id'] = 0;
            $res = $taskModel->select();
            foreach ($res as $vo){
                $b['time_id'] = $vo['time_id'];
                $time = (time() - strtotime($vo['time_resources']));
                $day = floor($time/(24*3600));
                $time1 = (strtotime($vo['time_endtime']) - time());
                $day1 = floor($time1/(24*3600));
                $day1 = $day1+1;
                if($day1 >= 0){
                    if($day > 0){
                        $data['time_status'] = 0;
                        $data['time_lcomplete'] = $vo['time_complete'];
                        $data['time_resources'] = date("Y-m-d h:i:s", time());
                        $data['time_complete'] = 0;
                        $res = $taskModel->where($b)->save($data);
                    }
                }
            }
        }
        if($value){
            $cc['equipment_id'] = $equipment;
            $contnet = $taskModel->where($cc)->find();
            $con = '';
            if(empty($contnet)){
                $va = $taskModel->where($a)->find();
                $time_id['time_id'] = $va['time_id'];
                $taskModel->where($time_id)->save($cc);
                if(!empty($va)){
                    $con .= 'ID:'.$va['time_id'].'--'.'title:'.$va['time_title'].'--'.'flow:'.$va['time_flow'].'--'.'Jingwei:'.$va['time_ip'].'|';
                }else{
                    echo "0";
                }
            }else{
                $bb['time_status'] = 0;
                $bb['equipment_id'] = $equipment;
                $bb['group_name'] = $arr['group_name'];
                $contnet = $taskModel->where($bb)->find();
                if(!empty($contnet)){
                    $con .= 'ID:'.$contnet['time_id'].'--'.'title:'.$contnet['time_title'].'--'.'flow:'.$contnet['time_flow'].'--'.'Jingwei:'.$contnet['time_ip'].'|';
                }else{
                    echo "0";
                }

            }
            echo $con;
        }else{
            echo "0";
        }
    }

}