<?php
/**
 * Functions: .表province的增删查改（省份模型）
 * Author: Xu Shiqing
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */
 
namespace Admin\Model;
use Think\Model;
class ProvinceModel extends Model{
	
    /**
     *新增省份
     */
    public function addProvince($province){
        $result = M('province')->add($province);
        return $result;
    }
    
    /**
     * 根据省份id来删除省份
     */
    public function deleteProvinceById($provinceId){
        $result = M('province')->where('province_id ='.$provinceId)->delete();
        return $result;
    }
    
     /**
      * 根据省份的id来修改省份信息
      */
    public function saveProvince($provinceId,$province){
        $result = M('province')->where('province_id ='.$provinceId)->save($province);
        return $result;
    }
    
    /**
     * 查找省份信息
     */
    public function selectAllProvinces(){
        $result = M('province')->select();
        return $result;
    }
    
    /**
     * 根据省份的id来查找省份信息
     */
    public function selectProvinceById($provinceId){
        $result = M('province')->where('province_id ='.$provinceId)->find();
        return $result;
    }    
}
