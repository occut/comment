<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class ModuleModel extends Model {

    /**
     * 添加一个模块
     */
    public function addModule($module) {
        $result = M('module')->add($module);
        return $result;
    }
    
    /**
     * 根据module表中的module_Id删除一条模块信息
     */
    public function deleteModuleById($moduleId) {
        $result = M('module')->delete($moduleId);
        return $result;
    }
    
    /**
     * 根据module表中的module_id编辑模块信息
     */
    public function saveModule($moduleId, $module){
        $result = M('module')->where('module_id=' . $moduleId)->save($module);
        return $result;
    }
	
    /**
     * 查询所有的模块
     */
    public function selectAllModules() {
        $result = M('module')->select();
        return $result;
    }

    /**
     * 根据module表中的module_id查找模块信息
     */
    public function selectModuleById($moduleId) {
        $result = M('module')->where('module_id=' . $moduleId)->find();
        return $result;
    }

    /**
     * 按排序查询所有的模块资源
     */
    public function selectAllModulesOrderByModuleNameAsc() {
        $result = M('module')->order('module_name asc')->select();
        return $result;
    }
    
     /**
     * 获取用户表中的总条数
     */
    public function selectModuleTotalSize() {
        $result = M('module')->count();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectModuleByPage($Page) {
        $result = M('module')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return $result;
    }

}
