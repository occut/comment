<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class SysController extends SuperController {

    /**
     * 显示查看日志列表
     */
    public function showSysLog() {
        //实例化SysLog模型
        $sysLogModel = D('SysLog');
        //实例化Admin模型
        $adminModel = D('Admin');

        //查询管理员表所有的数据
        $admins = $adminModel->showAdmins();
        $sysLog = $sysLogModel->selectSysLog();
        //赋值到模版
        $this->assign('showadmins', $admins);
        $this->assign('syslog', $sysLog);
        $this->display();
    }

}
