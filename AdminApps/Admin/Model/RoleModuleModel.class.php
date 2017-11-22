<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class RoleModuleModel extends Model {

	
    /**
     *  保存角色-模块关系表中的role_id和module_id的值
     */
    public function addRoleIdModuleId($RoleIdModuleId){
        $result = M('role_module')->add($RoleIdModuleId);
        return $result;
    }
    
    /**
     * 删除角色-模块关系表role_module中role_id为$roleid的删除所有数据
     */
    public function deleteRoleModuleByRoleId($roleId) {
        $result = M('role_module')->where('role_id=' . $roleId)->delete();
        return $result;
    }

    /**
     *  删除角色-模块关系role_module表中module_id为$moduleId的所有数据
     */
    public function deleteRoleModuleByModuleId($moduleId) {
        $result = M('role_module')->where('module_id=' . $moduleId)->delete();
        return $result;
    }

    /**
     * 查询角色-模块表role_module表中role_id为$roleId的所有数据
     */
    public function selectRoleModuleByRoleId($roleId) {
        $result = M('role_module')->where('role_id=' . $roleId)->select();
        return $result;
    }


}
