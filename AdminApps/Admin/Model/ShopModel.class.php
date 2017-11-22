<?php
/**
 * Functions:表shop的增删改查（企业店铺模型）
 * Author: Xu Shiqing
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;
use Think\Model;

class ShopModel extends Model{
    
    /**
     * 增加企业店铺
     */
    public function addShop($shop){
        $result = M('shop')->add($shop);
        return $result;
    }
    
    /**
     *根据店铺的id来删除企业店铺
     */
    public function deleteShopById($shopId){
        $result = M('shop')->where('shop_id ='.$shopId)->delete();
        return $result;
    }
    
    /**
     * 根据店铺的id来编辑企业店铺
     */
    public function saveShop($shopId,$shop){
        $result = M('shop')->where('shop_id ='.$shopId)->save($shop);
        return $result;
    }
    
    /**
     * 查找所有的企业店铺
     */
    public function selectShops(){
        $result = M('shop')->select();
        return $result;
    }
    
    /**
     * 根据店铺的id来查找企业店铺
     */
    public function selectShopById($shopId){
        $result = M('shop')->where('shop_id ='.$shopId)->find();
        return $result;
    }
    
    /**
     * 获取企业店铺总数
     */
    public function countShops(){
        $result = M('shop')->count();
        return $result;
    }
    
    /**
     * 获取每页的数据集
     */
    public function selectShopsByPage($page){
        $result = M('shop')->limit($page->firstRow . ',' . $page->listRows)->order('shop_id desc')->select();
        return $result;
    }
    
    /**
     * 查找待审核的店铺数
     */
    public function selectVerifyingShopCount(){
        $result = M('shop')->where('shop_status = 1')->count();
        return $result;
    }
}