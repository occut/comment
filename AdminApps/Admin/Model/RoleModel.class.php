<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class RoleModel extends Model {

    /**
     * 添加角色名
     */
    public function addRole($roleName) {
        $result = M('role')->add($roleName);
        return $result;
    }

    /**
     * 根据Role表中role_id删除某一个角色名
     */
    public function deleteRoleById($roleId) {
        $result = M('role')->delete($roleId);
        return $result;
    }

    /**
     * 根据Role表中的role_id编辑某一个角色名
     */
    public function saveRole($roleId, $roleName) {
        $result = M('role')->where('role_id=' . $roleId)->setField('role_name', $roleName);
        return $result;
    }

    /**
     * 查询所有的角色
     */
    public function selectAllRoles() {
        $result = M('role')->order('role_id desc')->select();
        return $result;
    }

    /**
     * 根据Role表中的role_id查询某一个角色名
     */
    public function selectRoleById($roleId) {
        $result = M('role')->where('role_id=' . $roleId)->find();
        return $result;
    }
    
    
     /**
     * 获取用户表中的总条数
     */
    public function selectRoleTotalSize() {
        $result = M('role')->count();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectRoleByPage($Page) {
        $result = M('role')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return $result;
    }

}
