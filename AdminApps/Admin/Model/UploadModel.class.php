<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin \ Model;

use Think \ Model;

class UploadModel extends Model {

    /**
     * 添加用户表user信息
     */
    public function addUser($user) {
        $result = M('user')->add($user);
        return $result;
    }

    /**
     * 删除用户表中user中user_id为$userId的一条数据
     */
    public function deleteUserById($userId) {
        $result = M('user')->delete($userId);
        return $result;
    }

    /**
     *  编辑用户表中user中user_id为$userId的一条数据
     */
    public function saveUser($userId, $user){
        $result = M('user')->where('user_id=' . $userId)->save($user);
        return $result;
    }

    /**
     * 查询用户表Use表中所有的数据
     */
    public function selectAllUsers() {
        $result = M('user')->order('user_id desc')->select();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectUsersByPage($Page) {
        $result = M('user')->limit($Page->firstRow . ',' . $Page->listRows)->order('user_id desc')->select();
        return $result;
    }

    /**
     * 查找用户表User中的user_id为$userId的一条数据
     */
    public function selectUserById($userId) {
        $result = M('user')->find($userId);
        return $result;
    }

    /**
     * 查找用户表User中的group_id为$groupId的所有数据
     */
    public function selectUsersByGroupId($groupId) {
        $result = M('user')->where('group_id=' . $groupId)->select();
        return $result;
    }

    /**
     * 查找用户表User中的user_name为$userName的所有数据
     */
    public function selectUserByName($userName) {
        $result = M('user')->where('user_name=\'' . $userName . '\'')->select();
        return $result;
    }

    /**
     * 获取用户表中的总条数
     */
    public function selectUserTotalSize() {
        $result = M('user')->count();
        return $result;
    }

    /**
     * 根据username模糊查询用户信息
     */
    public function selectUsersByName($userName){
        $result = M('user')->where("user_name like '%$userName%'")->select();
        return $result;
    }

    /**
     * 获取根据username模糊查询的用户个数
     */
    public function countUserByName($userName){
        $result = M('user')->where("user_name like '%$userName%'")->count();
        return $result;
    }

    /**
     * 查找待审核会员认证数
     */
    public function selectVerifyingUserCount(){
        $result = M('user')->where('user_id_status =  0')->count();
        return $result;
    }
}
