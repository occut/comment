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
    echo '标题:'.$data['time_title'].'|'.'分组:'.$data['group_name'].'|'.'URL:'.$data['time_url'].'|'.'经纬度:'.$data['time_ip'].'|'.'下单量:'.$data['time_flow'].'|'.'完成量:'.$data['time_complete'].'|'.'开始时间:'.$data['time_starttime'].'|'.'结束时间:'.$data['time_endtime'];
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
            $idcard = $WechaModel->where($b)->find();
//            var_dump($idcard);
//            die;
            $a['wei_id'] = $idcard['wei_id'];
//            var_dump($a);
//            die;
            $data['wei_static'] = 2;
            $value = $WechaModel->where($a)->save($data);
            if($idcard == ''){
                echo "0";
            }else{
                echo $idcard['wei_name'].','.$idcard['wei_password'].','.$idcard['wei_data'];
            }

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
//            var_dump($a);
//            die;
            $user = $WechaModel->where($a)->select();
//            var_dump($user);
            if(!$user){
                echo "0";
                die;
            }
            if($password == $user[0]['wei_password']){
                $value = $WechaModel->where($a)->save($data);
                if($value){
//                    echo $user[0]['wei_id'];
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
    //大众点评 任务量
    public function complete(){
        if(IS_GET){
            $time_id=I('get.time_id');
            $taskModel = D('Taskstime');
            $relationship = D('Relationship');
            $a['time_id'] = $time_id;
            $test=$taskModel->where($a)->find();
            $time_flow = $test["time_flow"];//下单
            $time_complete = $test["time_complete"];//完成
            $finish = $test["finish"];//完成
            ++$finish;
            ++$time_complete;
//            dump($time_complete >= $time_flow);
            if( $time_complete >= $time_flow){
                $data['time_status'] = 1;
                $data['time_complete'] = $time_complete;
                $data['finish'] = $finish;
                 $data['equipment_id'] = 0;
                $de['ta_id'] = $time_id;
                $relationship->where($de)->delete();
                $data=$taskModel->where($a)->save($data);
                if($data){
                    echo "1";
                    return false;
                }else{
                    echo "0";
                    return false;
                }

            }
            $data['time_complete'] = $time_complete;
            $data['finish'] = $finish;
            $d=$taskModel->where($a)->save($data);
            if($d){
                echo "1";
            }else{
                echo "0";
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
    //大众点评任务
 public function tasks(){
        if(IS_GET) {
            //接收数据
            $equipment = I('id');
            $group_name=I('get.group_name');
            $con = '';
            //设置缓存
            F($equipment,$equipment);
            $equipment = F($equipment);
            if(empty($equipment)){
                echo "0";
                return false;
            }
            //实例化模型
            $relationship = D('Relationship');
            $taskGroupModel = D('TasksGroup');
            $taskModel = D('Taskstime');
            $ipjudeg = M('ipjudge');
            $res = $taskModel->select();
            //是否第二天
            foreach ($res as $vo){
                $b['time_id'] = $vo['time_id'];
                $de['ta_id'] = $vo['time_id'];
                $zuo = substr($vo['time_resources'],0,10);
                $jin = date('Y-m-d');
                if($zuo!=$jin){
                    $data['time_complete'] = 0;
                    $data['equipment_id'] = 0;
                    $data['time_status'] = 0;
                    $data['time_lcomplete'] = $vo['time_complete'];
                    $data['time_resources'] = date("Y-m-d h:i:s", time());
                    $ipju['name'] = $vo['time_title'];
                    $taskModel->where($b)->save($data);
                    $ipjudeg->where($ipju)->delete();
                    $relationship->where($de)->delete();
                }
            }
        }

         //循环遍历所有数据，判断是否过期
         $flow = '';
         foreach ($res as $vo){
             $flow += $vo['time_flow'];
             $time = (strtotime($vo['time_endtime']) - time());
             $day = floor($time/(24*3600));
             $day = $day+1;
             if($day < 0){ //封装数据
                 $b['time_id'] = $vo['time_id'];
                 $data['time_status'] = 1;
                 $data['equipment_id'] = 0;
                 $de['ta_id'] = $vo['time_id'];
                 $relationship->where($de)->delete();//删除绑定参数
                 $taskModel->where($b)->save($data);
             }
         }
        
        //判断设备
            $group['group_name']=$group_name;
            $equipment_id['equipment_id'] = $equipment;
            $group_equlist = $taskGroupModel->where($group)->find();
            $group_equlist_name = explode(',',$group_equlist['equlist']);
            $group_id = in_array($equipment,$group_equlist_name);
            if(!$group_id){
                echo "0";
                return false;
            }
            // echo 1;
            //查找设备任务
            // $re['qi_id'] = $equipment;
            // $revalue = $relationship->where($re)->find();
            // if(empty($revalue)){
                //取任务
                $task['equipment_id'] = 0;
                $task['time_status'] = 0;
                $task['group_name'] = $group_name;
                $contnet = $taskModel->order('time_flow DESC')->select();
                foreach ($contnet as $value) {
                    if($value['equipment_id'] == "0" and $value['time_status'] == "0"){
                       $a = $contnet = $value;
                        break;
                    }
                }
                 // dump($contnet);die;
                if(!empty($contnet[0])){
                    echo "0";
                    return false;
                }
                // //绑订任务
                // $time_id['time_id'] = $contnet['time_id'];
                // $relat['qi_id'] = $equipment;
                // $relat['ta_id'] = $contnet['time_id'];
                // $relatid['ta_id'] = $contnet['time_id'];
                // dump($relat);
                // $aa = $relationship->where($relatid)->find();
                // dump($aa);
                // if(!empty($aa)){
                //     $relationship->where($relatid)->delete();
                //     echo "0";
                //     return false;
                // }
                // $addre = $relationship->add($relat);
                // if(!$addre){
                //     echo "0";
                //     return false;
                // }
                // $savetask = $taskModel->where($time_id)->save($equipment_id);
                // if(!$savetask){
                //     echo "0";
                //     return false;
                // }

                $con .= 'ID:'.$contnet['time_id'].'--'.'title:'.$contnet['time_title'].'--'.'flow:'.$contnet['time_flow'].'--'.'Jingwei:'.$contnet['time_ip'].'--'.$contnet['time_stop'].'|';
            // }
            // else{
            //     $time_id['time_id'] = $revalue['ta_id'];
            //     $contnet = $taskModel->where($time_id)->find();
            //     // dump($time_id['time_id']);
            //     if(empty($contnet)){
            //         echo "0";
            //         $relationship->where($re)->delete();
            //         return false;
            //     }
            //     $con .= 'ID:'.$contnet['time_id'].'--'.'title:'.$contnet['time_title'].'--'.'flow:'.$contnet['time_flow'].'--'.'Jingwei:'.$contnet['time_ip'].'--'.$contnet['time_stop'].'|';
            // }
           echo $con;
    }
    
    public function me(){
         $Data = 123;
        F('data',$Data);
        $Data = F('data');
        F('data',NULL);
        var_dump($Data);
    }

    /**
     * 对比IP
     */
    public function addip(){
        $name = I('name');
        if(empty($name)){
            echo "0|必要参数为空";
            return false;
        }
        $ip = I('ip');
        if(empty($ip)){
            echo "0|必要参数为空";
            return false;
        }
       
        F($name,$name);
        F($ip,$ip);
        $ipjudeg = M('ipjudge');
        $a['name'] = $name;$a['ip'] = $ip;
        $data['name'] = $name;$data['ip'] = $ip;
        $value = $ipjudeg->where($a)->select();
        if(!empty($value)){
            echo "0|IP段已存在";
            F($name,NULL); F($ip,NULL);
            return false;
        }
        $content = $ipjudeg->add($data);
        if($content){
            echo "1|添加成功";
            F($name,NULL); F($ip,NULL);
            return false;
        }else{
            echo "0|添加失败";
            F($name,NULL); F($ip,NULL);
            return false;
        }
    }



}