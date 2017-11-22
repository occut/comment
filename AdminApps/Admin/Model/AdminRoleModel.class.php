<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class AdminRoleModel extends Model {

    /**
     * 管理员添加角色 ,把管理员表中的admin_id和角色表中role_id存入到admin_role关系表中
     */
    public function addAdminRole($adminRole) {
        $result = M('admin_role')->add($adminRole);
        return $result;
    }
    
	/**
	*  删除管理员-角色admin_role关系表中所有role_id为$roleId的数据
	*/
    public function deleteAdminRoleByRoleId($roleId) {
        $result = M('admin_role')->where('role_id=' . $roleId)->delete();
        return $result;
    }

    /**
     *  删除管理员-角色admin_role关系表中admin_id为$adminId的数据信息  
     */
    public function deleteAdminRoleByAdminId($adminId) {
        $result = M('admin_role')->where('admin_id=' . $adminId)->delete();
        return $result;
    }

    /**
     *  查询管理员-角色admin_role关系表中所有admin_id为$id的数据
     */
    public function selectAdminRoleByAdminId($adminId) {
        $result = M('admin_role')->where('admin_id=' . $adminId)->select();
        return $result;
    }

   

}
