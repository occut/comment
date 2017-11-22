<?php
/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */
namespace Admin\Model;

use Think\Model;
class ProductGroupModel extends Model{
    /**
     * ��Ӳ�Ʒ����
     */
    public function addProductGroup($productGroup){
        $result=M('product_group')->add($productGroup);
        return $result;
    }
    /**
     * ɾ���Ʒ����product_group��group_idΪ$groupid��һ�����
     */
    public function deleteProductGroupById($groupId) {
        $result = M('product_group')->delete($groupId);
        return $result;
    }
    /**
     * �����Ʒ����product_group��group_idΪ$groupid��һ�����
     */
    public function saveProductGroup($groupId, $ProductGroup) {
        $result = M('product_group')->where('group_id=' . $groupId)->save($ProductGroup);
        return $result;
    }
    /**
     * �������еĲ�Ʒ����
     */
    public function selectAllProductGroups() {
        $result = M('product_group')->select();
        return $result;
    }
    /**
     * ���Ҳ�Ʒ����product_group��group_idΪ$groupid��һ�����
     */
    public function selectProductGroupById($groupId) {
        $result = M('product_group')->find($groupId);
        return $result;
    }
    /**
     * ��ȡ��Ʒ������е�������
     */
    public function selectProductGroupTotalSize() {
        $result = M('product_group')->count();
        return $result;
    }
    /**
     * ��ҳ��ݼ�
     */
    public function selectProductGroupByPage($Page){
        $result=M('product_group')->where()->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return $result;
    }
    /**
     * ��ȡ��Ʒ�����и���
     */
    public function selectProductGroupByParentId($parentId) {
        $result = M('product_group')->where('parent_id='.$parentId)->select();
        return $result;
    }

}