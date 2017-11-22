<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin \ Model;

use Think \ Model;

class IdCardModel extends Model {

    /**
     * 获取文章表中的总条数
     */
    public function selectIdCardTotalSize() {
        $result = M('IdCard')->count();
        return $result;
    }
    /**
     * 分页数据集
     */


    public function selectIdCardByPage($Page) {

        $data['admin_id'] = session('adminId');
        if(session('adminId') == 46){
            $result = M('IdCard')->order('card_id')->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }else{
            $result = M('IdCard')->order('card_id')->where($data)->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }
    }

    /**
     * 查找WebConfig
     */
    public function selectWebConfig() {
        $result = M('Weichat')->find();
        return $result;
    }
    public function selectAllTasks() {
        $result = M('tasks')->select();
        return $result;
    }
}