<?php

/**
 * Functions: .表admin_menu的增删改查（菜单模型）
 * Author: Xu Shiqing
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin \ Model;

use Think \ Model;

class SysLogModel extends Model {

    /**
     * 添加日志
     */
    public function addSysLog($SysLog) {
        $result = M('sys_logo')->add($SysLog);
        return $result;
    }

    /**
     * 查询可显示的后台菜单
     */
    public function selectAllSysLogs() {
        $result = M('sys_log')->order('log_time desc')->select();
        return $result;
    }
    
    /**
     * 获取日志总数
     */
    public function countSysLog(){
        $result = M('sys_log')->count();
        return $result;
    }
    
    /**
     * 每页可现实的日志数
     */
    public function selectSysLogsByPage($page){
        $result = M('sys_log')->limit($page->firstRow.','.$page->listRows)->select();
        return $result;
    }
}
