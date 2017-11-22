<?php
/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class ProductOrderModel extends Model{
    
    /**
     *  ɾ���productOrder��productOrder_idΪ$productOrderid��һ�����
     */
    public function deleteProductOrderById($productOrderid) {
        $result = M('product_order')->delete($productOrderid);
        return $result;
    }
    /**
     * ���Ҷ������е����ж���
     */
    public function selectAllProductOrder() {
        $result = M('product_order')->order('order_addtime')->select();
        return $result;
    }
    /**
     *  ���Ҷ�����productOrder��productOrder_idΪ$productOrderId��һ�����
     */
    public function selectProductOrderById($productOrderId) {
        $result = M('product_order')->find($productOrderId);
        return $result;
    }

    /**
     * ��ȡ�������е�������
     */
    public function selectProductOrderTotalSize() {
        $result = M('product_order')->count();
        return $result;
    }
    /**
     * ��ҳ��ݼ�
     */
    public function selectProductOrderByPage($Page) {
        $result = M('product_order')->limit($Page->firstRow . ',' . $Page->listRows)->order('order_id desc')->select();
        return $result;
    }

    //���ҳ����ж�����Ӧ�ò�Ʒ
    public function selectAllProductByPage($Page){
        $result=M('product_order')->join('left join yefan_product on yefan_product_order.product_id  = yefan_product.product_id ')->limit($Page->firstRow . ',' . $Page->listRows)->order('order_id desc')->select();
        return $result;
    }
}
