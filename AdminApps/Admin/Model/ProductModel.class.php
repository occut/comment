<?php
/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */
namespace Admin\Model;

use Think\Model;
class ProductModel extends Model{
    /**
     * ���Ӳ�Ʒ��Ϣ
     */
    public function addProduct($product) {
        $result = M('product')->add($product);
        return $result;
    }
    /**
     *  ɾ���Ʒ��product��product_idΪ$productid��һ�����
     */
    public function deleteProductById($productid) {
        $result = M('product')->delete($productid);
        return $result;
    }
    /**
     * ɾ���Ʒ��product��group_idΪ$groupId��һ�����
     */
    public function deleteProductByGroupId($groupId) {
        $result = M('product')->where('group_id=' . $groupId)->delete();
        return $result;
    }
    /**
     *  �༭��Ʒ��product��product_idΪ$productId��һ�����
     */
    public function saveProduct($productId, $product) {
        $result = M('product')->where('product_id=' . $productId)->save($product);
        return $result;
    }
    /**
     * ���Ҳ�Ʒ���е����в�Ʒ
     */
    public function selectAllProduct() {
        $result = M('product')->order('product_addtime')->select();
        return $result;
    }
    /**
     *  ���Ҳ�Ʒ��product��product_idΪ$productId��һ�����
     */
    public function selectProductById($productId) {
        $result = M('product')->find($productId);
        return $result;
    }
    /**
     *  ���Ҳ�Ʒ��product��group_idΪ$groupId���������
     */
    public function selectProductByGroupId($groupId) {
        $result = M('product')->where('group_id=' . $groupId)->select();
        return $result;
    }
    /**
     * ��ȡ��Ʒ���е�������
     */
    public function selectProductTotalSize() {
        $result = M('product')->count();
        return $result;
    }
    /**
     * ��ҳ��ݼ�
     */
    public function selectProductByPage($Page) {
        $result = M('product')->limit($Page->firstRow . ',' . $Page->listRows)->order('group_id desc')->select();
        return $result;
    }


}