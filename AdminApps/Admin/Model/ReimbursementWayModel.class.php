<?php
/**
 * Functions: 表reimbursement_way的增删查改
 * Author: Xu Shiqing
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;
use Think\Model;
class ReimbursementWayModel extends Model{
	
    /**
     * 新增还款方式
     */
    public function addReimbursementWay($reimbursementWay){
        $result = M('reimbursement_way')->add($reimbursementWay);
        return $result;
    }
    
    /**
     * 根据方式id来删除还款方式
     */
    public function deleteReimbursementWayById($wayId) {
        $result = M('reimbursement_way')->where('way_id ='.$wayId)->delete();
        return $result;
    }
    
    /**
      * 根据方式的id来修改还款方式
      */
    public function saveReimbursementWay($wayId,$reimbursementWay){
        $result = M('reimbursement_way')->where('way_id ='.$wayId)->save($reimbursementWay);
        return $result;
    }
    
    /**
     * 查找所有的还款方式
     */
    public function selectReimbursementWays(){
        $result = M('reimbursement_way')->select();
        return $result;
    }
    
     /**
      * 根据方式的id来查找还款方式
      */
    public function selectReimbursementWayById($wayId){
        $result = M('reimbursement_way')->where('way_id ='.$wayId)->find();
        return $result;
    }

    
}


