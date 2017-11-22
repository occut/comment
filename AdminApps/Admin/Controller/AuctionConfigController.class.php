<?php
/**
 * Functions: 拍卖控制器.
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class AuctionConfigController extends SuperController{
     
  /**  
   * 显示拍品类型
   */
    public function listAuctionTypes(){
        //实列化AuctionType模型
        $auctionTypeModel=D('AuctionType');
        //查询拍品类型所有的数据
        $auctionType=$auctionTypeModel->selectAllAuctionTypes();
        //赋值到模版
        $this->assign('auctiontypes',$auctionType);
        $this->display('AuctionConfig/listauctiontypes');
    }
    
    /**
     * 新增拍品类型 
     */
    public function addAuctionType(){
       if(IS_POST){
          //接受POST传递过来的参数
        $typeName=I('typename'); 
         
          //数据不能为空
          if(empty($typeName)){
            $this->error('拍品类型不能为空');  
          }
          
          //封装数据
          $data['type_name']=$typeName;
          
          //实列化AuctionType模型
          $auctionTypeModel=D('AuctionType');
          
          $result=$auctionTypeModel->addAuctionType($data);
          if($result){
             $this->success(L('ADD_AUCTIONTYPE_SUCCESS'),U('AuctionConfig/listauctiontypes'));  
          }else{
           $this->error(L('ADD_AuctionType_FAILURE')); 
          }
       }else{ 
        
      $this->display('AuctionConfig/addauctiontype');  
    }
}

 /**
  * 编辑拍品类型
  */
   public function editAuctionType(){
       if(IS_POST){
         //接受POST传递过来的参数
       $typeId=I('typeid');
       $typeName=I('typename');
         
         //数据不能为空
         if(empty($typeName)){
          $this->error('拍品类型不能为空');  
          }
          
         //封装数据
         $data['type_name']=$typeName;
         
         //实列化AuctionType模型
         $auctionTypeModel=D('AuctionType');
        //编辑拍品类型
         $result=$auctionTypeModel->saveAuctionType($typeId,$data); 
         if($result){
           $this->success(L('EDIT_AUCTIONTYPE_SUCCESS'),U('AuctionConfig/listauctiontypes'));  
         }else{
           $this->error(L('EDIT_AUCTIONTYPE_FAILURE'));  
         }
       }else{ 
         //接受GET传递过来的参数
        $typeId =I('typeid');
           
        //实列化AuctionType模型
         $auctionTypeModel=D('AuctionType');
        //编辑card_theme拍品类型表标准表中standard_id为$typeId的一条数据
         $auctionType=$auctionTypeModel->selectAuctionTypeById($typeId);
        
         //赋值到模版
         $this->assign('auctiontype',$auctionType);
         $this->display('AuctionConfig/editauctiontype');    
       }
   }
   
 /**
  * 删除拍品类型
  */
   public function deleteAuctionType(){
       if(IS_GET){
      $typeId =I('typeid');  
        //实列化AuctionType模型
        $auctionTypeModel=D('AuctionType');
        //删除拍品类型
        $result=$auctionTypeModel->deleteAuctionTypeById($typeId);
        if($result){
           $this->success(L('DELTE_AUCTIONTYPE_SUCCESS'),U('AuctionConfig/listauctiontypes'));  
         }else{
           $this->error(L('DELTE_AUCTIONTYPE_FAILURE'));  
         }
       }
   }
    
  /**
   * 显示拍买金额
   */
   public function listAuctionAmounts(){
       //实列化AuctionAmount模型
       $AuctionAmountModel=D('AuctionAmount');
       //查询所有的拍买金额
       $AuctionAmount=$AuctionAmountModel->selectAllAuctionAmounts();
      //赋值到模版
       $this->assign('auctionamounts',$AuctionAmount);
       $this->display('AuctionConfig/listauctionamounts');
   }
   
   /**
     * 新增拍品类型 
     */
    public function addAuctionAmount(){
       if(IS_POST){
          //接受POST传递过来的参数
          $amountName=I('amountname'); 
          
          //数据不能为空
          if(empty($amountName)){
            $this->error('拍买金额不能为空');  
          }
          
          //封装数据
          $data['amount_name']=$amountName;
          
          //实列化AuctionAmount模型
          $AuctionAmountModel=D('AuctionAmount');
          
          $result=$AuctionAmountModel->addAuctionAmount($data);
          if($result){
             $this->success(L('ADD_AUCTIONAMOUNT_SUCCESS'),U('AuctionConfig/listauctionamounts'));  
          }else{
           $this->error(L('ADD_AUCTIONAMOUNT_FAILURE')); 
          }
       }else{ 
        
      $this->display('AuctionConfig/addauctionamount');  
    }
}

  /**   
  * 编辑拍买金额
  */
   public function editAuctionAmount(){
       if(IS_POST){
         //接受POST传递过来的参数
         $amountId=I('amountid');
         $amountName=I('amountname');
         
         //数据不能为空
         if(empty($amountName)){
          $this->error('拍买金额不能为空');  
          }
          
         //封装数据
         $data['amount_name']=$amountName;
         
          //实列化AuctionType模型
          $AuctionAmountModel=D('AuctionAmount');
        //编辑拍品类型
         $result=$AuctionAmountModel->saveAuctionAmount($amountId,$data); 
         if($result){
           $this->success(L('EDIT_AUCTIONAMOUNT_SUCCESS'),U('AuctionConfig/listauctionamounts'));  
         }else{
           $this->error(L('EDIT_AUCTIONAMOUNT_FAILURE'));  
         }
       }else{ 
         //接受GET传递过来的参数
         $amountId=I('amountid');
           
        //实列化AuctionAmount模型
         $AuctionAmountModel=D('AuctionAmount');
        //编辑cap_charge拍买金额表中charge_id为$OrganizationId的一条数据
         $auctionAmount=$AuctionAmountModel->selectAuctionAmountById($amountId);
        
         //赋值到模版
         $this->assign('auctionamount', $auctionAmount);
         $this->display('AuctionConfig/editauctionamount');    
       }
   }
   
 /**
  * 删除拍买金额
  */
   public function deleteAuctionAmount(){
       if(IS_GET){
          $amountId=I('amountid');
         //实列化AuctionAmount模型
         $AuctionAmountModel=D('AuctionAmount');
        //删除拍买金额
        $result= $AuctionAmountModel->deleteAuctionAmountById($amountId);
        if($result){
           $this->success(L('DELTE_AUCTIONAMOUNT_SUCCESS'),U('AuctionConfig/listauctionamounts'));  
         }else{
           $this->error(L('DELTE_AUCTIONAMOUNT_FAILURE'));  
         }
       }
   }
  


}