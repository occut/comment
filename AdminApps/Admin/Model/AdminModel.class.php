<?php

/**
 * Functions: 
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class AdminModel extends Model {

    /**
     * 添加管理信息
     */
    public function addAdmin($admin) {
        $result = M('admin')->add($admin);
        return $result;
    }

    /**
     * 删除管理员表中的admin_id为$adminId的一条数据
     */
    public function deleteAdminById($adminId) {
        $result = M('admin')->delete($adminId);
        return $result;
    }

    /**
     * 修改admin表中的一条信息
     */
    public function saveAdmin($adminId, $admin) {
        $result = M('admin')->where('admin_id=' . $adminId)->save($admin);
        return $result;
    }

    /**
     * 通过admin_id修改管理员表中的密码
     */
    public function savePassword($adminId, $password) {
        $result = M('admin')->where('admin_id=' . $adminId)->setField('admin_pass', $password);
        return $result;
    }

    /**
     *  通过admin_id查找管理员表中的一条信息 
     */
    public function selectAdminById($adminId) {
        $result = M('admin')->find($adminId);
        return $result;
    }

    /**
     * 查询admin表中 admin_name为$adminName并且admin_status为1的一条数据();
     */
    public function selectAdminByNameStatus($adminName, $adminStatus) {
        $result = M('admin')->where(array('admin_name' => $adminName, 'admin_status' => $adminStatus))->find();
        return $result;
    }

    /**
     * 查询admin表中 admin_name为$adminName的数据();
     */
    public function selectAdminByName($adminName) {
        $result = M('admin')->where('admin_name=\'' . $adminName . '\'')->find();
        return $result;
    }

    /**
     * 查询管理员表中的所有数据
     */
    public function selectAllAdmins() {
        $result = M('admin')->select();
        return $result;
    }

    /**
     * 获取用户表中的总条数
     */
    public function selectAdminTotalSize() {
        $result = M('admin')->count();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectAdminByPage($Page) {
        $result = M('admin')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return $result;
    }

}
