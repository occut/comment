<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class GroupingModel extends Model {

    /**
     * 添加用户分组表user_group数据
     */
    public function addUserGroup($userGroup) {
        $result = M('grouping')->add($userGroup);
        return $result;
    }

    /**
     *  删除用户分组表user_group中group_id为$groupId的一条数据
     */
    public function deleteUserGroupById($groupId) {
        $result = M('grouping')->delete($groupId);
        return $result;
    }

    /**
     *  编辑用户分组表user_group中group_id为$groupId的一条数据
     */
    public function saveUserGroup($groupId, $userGroup) {
        $result = M('user_group')->where('group_id=' . $groupId)->save($userGroup);
        return $result;
    }

    /**
     * 查询用户分组表user_group中所有的数据
     */
    public function selectAllUserGroups() {
        $result = M('user_group')->order('group_id desc')->select();
        return $result;
    }

    /**
     * 查询用户分组表user_group中group_id为$groupId的一条数据
     */
    public function selectUserGroupById($groupId) {
        $result = M('user_group')->find($groupId);
        return $result;
    }
    
      /**
     * 获取用户分组表中的总条数
     */
    public function selectUserGroupTotalSize() {
        $result = M('grouping')->count();
        return $result;
    }
    
    
     /**
     * 分页数据集
     */
    public function selectGroupingByPage($Page) {
        $a['admin_id'] = session('adminId');
        if(session('adminId') == 46){
            $result = M('Grouping')->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }else{
            $result = M('Grouping')->where($a)->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }
    }

}
