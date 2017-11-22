<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class TasksGroupModel extends Model {

    /**
     * 增加任务分组信息
     */
    public function addTasksGroup($tasksGroup) {
        $result = M('tasksGroup')->add($tasksGroup);
        return $result;
    }

    /**
     *  删除任务分组表tasksGroup中tasksGroup_id为$tasksGroupid的一条数据
     */
    public function deleteTasksGroupById($tasksGroupId) {
        $result = M('tasksGroup')->delete($tasksGroupId);
        return $result;
    }


    /**
     *  编辑任务分组表tasksGroup中tasksGroup_id为$tasksGroupId的一条数据
     */
    public function saveAriticle($tasksGroupId, $tasksGroup) {
        $result = M('tasksGroup')->where('group_id=' . $tasksGroupId)->save($tasksGroup);
        return $result;
    }

    /**
     * 查找任务分组表中的所有任务分组
     */
    public function selectAllTasksGroups() {
        $result = M('tasksGroup')->select();
        return $result;
    }

    /**
     *  查找任务分组表tasksGroup中tasksGroup_id为$tasksGroupId的一条数据
     */
    public function selectTasksGroupById($tasksGroupId) {
        $result = M('tasksGroup')->find($tasksGroupId);
        return $result;
    }
    
     /**
     * 获取任务分组表中的总条数
     */
    public function selectTasksGroupTotalSize() {
        $result = M('tasksGroup')->count();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectTasksGroupByPage($Page) {
        $a['admin_id'] = session('adminId');
        if(session('adminId') == 46){
            $result = M('tasksGroup')->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }else{
            $result = M('tasksGroup')->where($a)->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }
    }


}
