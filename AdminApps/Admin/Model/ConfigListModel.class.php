<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 16-11-17
 * Time: 上午10:16
 */

namespace Admin\Model;

use Think\Model;
class ConfigListModel extends Model{
    /**
     * 增加元素信息
     */
    public function addConfigList($configList) {
        $result = M('configList')->add($configList);
        return $result;
    }
    /**
     *  删除元素表configList中configList_id为$configListid的一条数据
     */
    public function deleteConfigListById($configListid) {
        $result = M('configList')->delete($configListid);
        return $result;
    }

    /**
     *  编辑元素表configList中configList_id为$configListId的一条数据
     */
    public function saveConfigList($configListId, $configList) {
        $result = M('configList')->where('list_id=' . $configListId)->save($configList);
        return $result;
    }
    /**
     * 查找元素表中的所有元素
     */
    public function selectAllConfigList() {
        $result = M('configList')->order('List_id')->select();
        return $result;
    }
    /**
     *  查找元素表configList中configList_id为$configListId的一条数据
     */
    public function selectConfigListById($configListId) {
        $result = M('configList')->find($configListId);
        return $result;
    }

    /**
     * 获取元素表中的总条数
     */
    public function selectConfigListTotalSize() {
        $result = M('configList')->count();
        return $result;
    }
    /**
     * 分页数据集
     */
    public function selectConfigListByPage($Page) {
        $result = M('configList')->limit($Page->firstRow . ',' . $Page->listRows)->order('list_id desc')->select();
        return $result;
    }








}