<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class TaskstimeModel extends Model {

    /**
     * 增加文章信息
     */
    public function addTasks($tasks) {
        $result = M('Taskstime')->add($tasks);
        return $result;
    }

    /**
     *  删除文章表tasks中tasks_id为$tasksid的一条数据
     */
    public function deleteTasksById($tasksId) {
        $result = M('Taskstime')->delete($tasksId);
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
        $result = M('Taskstime')->where('tasks_id=' . $tasksId)->save($tasks);
        return $result;
    }

    /**
     * 查找文章表中的所有文章
     */
    public function selectAllTasks() {
        $result = M('Taskstime')->select();
        return $result;
    }

    /**
     *  查找文章表tasks中tasks_id为$tasksId的一条数据
     */
    public function selectTasksById($tasksId) {
        $result = M('Taskstime')->find($tasksId);
        return $result;
    }

    /**
     *  查找文章表tasks中group_id为$groupId的所有数据
     */
    public function selectTasksByGroupId($groupId) {
        $result = M('Taskstime')->where('group_id=' . $groupId)->select();
        return $result;
    }

     /**
     * 获取文章表中的总条数
     */  /**
     * 获取文章表中的总条数
     */
    public function selectTasksTotalSize() {
        $result = M('Taskstime')->count();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectTasksByPage($Page,$title) {
        $a['admin_id'] = session('adminId');
        if(!empty($title)){
            $a['time_title'] =  array('like','%'.$title.'%');
            $b['time_title'] =  array('like','%'.$title.'%');
        }
        if(session('adminId') == 46){
            $result = M('Taskstime')->where($b)->order('time_id')->limit($Page->firstRow . ',' . $Page->listRows)->select();

            return $result;
        }else{
            $result = M('Taskstime')->order('time_id')->where($a)->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }
    }

}
