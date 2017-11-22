<?php

/**
 * Functions: 管理员控制器.
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class CeshiController extends SuperController {

    public function index(){
        $this->display('Ceshi/index');
    }
    public function tasks(){
        if(IS_GET){
            $tasks_name=I('get.tasks_name');
            $tasks_status=I('get.tasks_status');
//            var_dump($tasks_status);
//            echo $tasks_name;
//            die;

            $User=M('tasks');
            $a['tasks_name'] = $tasks_name;
            $test=$User->where($a)->select();
            $status = $test[0]["tasks_status"];
//            if($tasks_status == $status){//任务代码错误提示
//                echo "任务已是该状态";
//                die;
//            }
            $a['tasks_name'] = $tasks_name;
            $data['tasks_status'] = $tasks_status;
            $data=$User->where($a)->save($data);
            if($data){
                echo "成功";
            }else{
                echo "失败";
            }
        }
    }
}
?>