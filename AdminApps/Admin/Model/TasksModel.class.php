<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class TasksModel extends Model {

    /**
     * 增加文章信息
     */
    public function addTasks($tasks) {
        $result = M('tasks')->add($tasks);
        return $result;
    }

    /**
     *  删除文章表tasks中tasks_id为$tasksid的一条数据
     */
    public function deleteTasksById($tasksId) {
        $result = M('tasks')->delete($tasksId);
        return $result;
    }

//    /**
//     * 删除文章表tasks中group_id为$groupId的一条数据
//     */
//    public function deleteTasksByGroupId($groupId) {
//        $result = M('tasks')->where('group_id=' . $groupId)->delete();
//        return $result;
//    }

    /**
     *  编辑文章表tasks中tasks_id为$tasksId的一条数据
     */
    public function saveTask($tasksId, $tasks) {
        $result = M('tasks')->where('tasks_id=' . $tasksId)->save($tasks);
        return $result;
    }

    /**
     * 查找文章表中的所有文章
     */
    public function selectAllTasks() {
        $result = M('tasks')->select();
        return $result;
    }

    /**
     *  查找文章表tasks中tasks_id为$tasksId的一条数据
     */
    public function selectTasksById($tasksId) {
        $result = M('tasks')->find($tasksId);
        return $result;
    }

    /**
     *  查找文章表tasks中group_id为$groupId的所有数据
     */
    public function selectTasksByGroupId($groupId) {
        $result = M('tasks')->where('group_id=' . $groupId)->select();
        return $result;
    }

     /**
     * 获取文章表中的总条数
     */  /**
     * 获取文章表中的总条数
     */
    public function selectTasksTotalSize() {
        $result = M('tasks')->count();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectTasksByPage($Page) {
        $a['admin_id'] = session('adminId');
        if(session('adminId') == 46){
            $result = M('tasks')->order('tasks_id')->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }else{
            $result = M('tasks')->order('tasks_id')->where($a)->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }
    }

}
