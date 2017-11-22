<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class TasksParamModel extends Model {

    /**
     * 增加配置信息
     */
    public function addTasksParam($tasksParam) {
        $result = M('tasksParam')->add($tasksParam);
        return $result;
    }

    /**
     *  删除配置表tasksParam中tasksParam_id为$tasksParamid的一条数据
     */
    public function deleteTasksParamById($tasksParamId) {
        $result = M('tasksParam')->delete($tasksParamId);
        return $result;
    }



    /**
     *  编辑配置表tasksParam中tasksParam_id为$tasksParamId的一条数据
     */
    public function saveAriticle($tasksParamId, $tasksParam) {
        $result = M('tasksParam')->where('tasksParam_id=' . $tasksParamId)->save($tasksParam);
        return $result;
    }

    /**
     * 查找配置表中的所有配置
     */
    public function selectAllTasksParams() {
        $result = M('tasksParam')->select();
        return $result;
    }

    /**
     *  查找配置表tasksParam中tasksParam_id为$tasksParamId的一条数据
     */
    public function selectTasksParamById($tasksParamId) {
        $result = M('tasksParam')->find($tasksParamId);
        return $result;
    }


    
     /**
     * 获取配置表中的总条数
     */
    public function selectTasksParamTotalSize() {
        $result = M('tasksParam')->count();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectTasksParamByPage($Page) {
        $result = M('tasksParam')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return $result;
    }

}
