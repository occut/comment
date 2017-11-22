<?php
/**
 * Functions: 产品管理控制器.
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class ProductController extends SuperController{
    /**
     * 显示产品分组界面
     */
    public function listProductGroups() {

        //管理员操作记录到日志表中
        $logcontent =C('SYS_LOG_ACTION_SELECT')."产品分组查询成功。";
        sys_log(session('adminId'),session('adminName'),$logcontent);

        $this->display('Product/listproductgroups');
    }

    /**
     *   添加产品分组大的方法
     */
    public function addProductGroup() {
        //实例化ProductGroup模型
        $ProductGroupModel = D('ProductGroup');
        if (IS_POST) {
            $groupName=I('groupname');
            $parentId=I('parentid');
            if(empty($groupName)){
                $this->error('产品分组名不能为空');
            }

            //封装数据
            $data['group_name'] = $groupName;
            $data['parent_id']= $parentId;


            $result =  $ProductGroupModel->addProductGroup($data);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."产品分组添加成功。" . "产品分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('ADD_PRODUCTGROUP_SUCCESS'), U('Product/listproductgroups'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."产品分组添加成功。" . "产品分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('ADD_PRODUCTGROUP_FAILURE'));
            }
        } else{

            $this->display('Product/addproductgroup');
        }
    }

    /**
     * 编辑产品分组的方法
     */
    public function editProductGroup() {
        if (IS_POST) {
            //接受POST传递过来的参数
            $groupId = I('groupid');
            $groupName = I('groupname');
            $parentId=I('parentid');
            //封装数据
            $data['group_name'] = $groupName;
            $data['parent_id']=$parentId;
            //实例化ProductGroup模型
            $ProductGroupModel = D('ProductGroup');

            $result =  $ProductGroupModel->saveProductGroup($groupId, $data);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."产品分组编辑成功。" . "产品分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('EDIT_PRODUCTGROUP_SUCCESS'), U('Product/listproductgroups'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."产品分组编辑失败。" . "产品分组名：" . $groupName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('EDIT_PRODUCTGROUP_FAILURE'));
            }
        } else{
            //接受GET传递过来的参数
            $groupId = I('groupid');

            //实例化ProductGroup模型
            $ProductGroupModel = D('ProductGroup');
            //编辑产品分组product_group中group_id为$groupid的一条数据
            $ProductGroup =$ProductGroupModel->selectProductGroupById($groupId);

            //查找父行业信息
            $parentProductGroup =$ProductGroupModel->selectProductGroupById($ProductGroup['parent_id']);

            //赋值到模版
            $this->assign('productgroup', $ProductGroup);
            $this->assign('parentproductgroup',$parentProductGroup);
            $this->display();
        }
    }

    /**
     * 删除产品分组的方法
     */
    public function deleteProductGroup() {
        //接受GET传递过来的参数
        $groupId = I('groupid');

        //实例化ProductGroup模型
        $productGroupModel = D('ProductGroup');

        //实列化Product模型
        $productModel = D('Product');

        //查找产品分组product_group中group_id为$groupid的一条数据
        $productGroup = $productGroupModel->selectProductGroupById($groupId);

        //查找产品表中group_id为$groupid的所有数据
        $group = $productModel->selectProductByGroupId($groupId);

        //查找产品分组中的parentId
        $groupParentId= $productGroupModel->selectProductGroupByParentId($groupId);
        if ($group) {
            //管理员操作记录到日志表中
            $logcontent =C('SYS_LOG_ACTION_DELETE')."产品分组删除失败。原因：分类下有子类。" . "产品分组名：" .$productGroup['group_name'];
            sys_log(session('adminId'),session('adminName'),$logcontent);

            $this->error(L('EXIST_SUBPRODUCT'));
        } else {

            if(empty($groupParentId)){

                //删除产品分组
                $del = $productGroupModel->deleteProductGroupById($groupId);

                if ($del) {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_DELETE')."产品分组删除成功。" . "产品分组名：" . $productGroup['group_name'];
                    sys_log(session('adminId'),session('adminName'),$logcontent);

                    $this->success(L('DELTE_PRODUCTGROUP_SUCCESS'), U('Product/listproductgroups'));
                } else {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_DELETE')."产品分组删除失败。" . "产品分组名：" .$productGroup['group_name'];
                    sys_log(session('adminId'),session('adminName'),$logcontent);

                    $this->error(L('DELTE_PRODUCTGROUP_FAILURE'));
                }
            }else{
                $this-> error(L('EXIST_SUBPARENTID'));
            }
        }
    }

    /**
     * 产品界面
     */
    public function listProduct() {
        //select all product information
        //实列化Product模型
        $productModel = D('Product');
        //实例化ProductGroup模型
        $productGroupModel = D('ProductGroup');

        //获取总的产品数
        $count = $productModel->selectProductTotalSize();

        //实例化分页类
        $page = new \Org\Page\Page($count,$this->adminPageSize);


        //获取每页显示的数据集
        $product = $productModel->selectProductByPage($page);
        //分页显示输出
        $show = $page->show();
        //查找所有的产品分组
        $productGroup = $productGroupModel->selectAllProductGroups();

        //管理员操作记录到日志表中
        $logcontent =  C('SYS_LOG_ACTION_SELECT')."产品管理查询成功";
        sys_log(session('adminId'),session('adminName'),$logcontent);

        $this->assign('productgroup', $productGroup);
        $this->assign('product', $product);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display('Product/listproduct');
    }


    //参数页面
    public function productparam(){
        //实例化ParamConfigModel
        $ParamConfigModel=D('ParamConfig');
        $paramConfig=$ParamConfigModel->selectAllParamConfigs();
        $str='';
        foreach($paramConfig as $k=>$v){
            $str.='<tr>';
            $str.='<td style="text-align: center;;line-height: 36px">'.$v['config_name'].'</td>';
            $str.='<td style="text-align: center"><button onclick="urllist(this)" class="btn btn-primary">点击选中</b></td>';
            $str.='<td style="text-align: center ;display: none" >'.$v['config_id'].'</td>';
            $str.='</tr>';
        };
        $userdata = array(
            'status' => C('JSON_SUCCESS_CODE'),
            'content' => $str,
        );

        $this->ajaxReturn($userdata);

    }


    /**
     * 添加产品的方法
     */
    public function addProduct(){
        if (IS_POST) {
            //接受POST传递过来的值
            $paramConfigId=I('paramconfigid');
            $productName = I('productname');
            $productTitle = I('producttitle');
            $productKeywords = I('productkeywords');
            $productDescription = I('productdescription');
            $groupId = I('groupid');


            //调用上传图片的方法
            $file = $_FILES['productpic'];
            $info = upload_img($file);
            //获取上传路径
            $productPic = $info['savepath'] . $info['savename'];

            $productContent = I('productcontent');
            $productbrowse=I('productbrowse');
            $productclick=I('productclick');
            $productauthor=I('productauthor');
            $productSummary = I('productsummary');
            $productaddTime=I('productaddtime');
            //接收到的值不能为空
            if (empty($productName)) {
                $this->error('产品名不能为空');
            }
            if (empty($productTitle)) {
                $this->error('标题不能为空');
            }
            if (empty($groupId)) {
                $this->error('产品分组不能为空');
            }
//            if(empty($paramConfigList)){
//                $this->error('参数不能为空');
//            }
            //封装数据
            $data['param_config_id']= $paramConfigId;
            $data['product_name'] = $productName;
            $data['product_title'] = $productTitle;
            $data['product_keywords'] = $productKeywords;
            $data['group_id'] = $groupId;
            $data['product_pic'] = $productPic;
            $data['product_description'] = $productDescription;
            $data['product_content'] = $productContent;
            $data['product_summary'] = $productSummary;
            $data['product_browse']= $productbrowse;
            $data['product_click']=$productclick;
            $data['product_author']=$productauthor;
            if(empty($productaddTime)){
                $data['product_addtime'] = time();
            }else{
                $data['product_addtime']=strtotime($productaddTime);
            }

            //实列化Product模型
            $productModel = D('Product');
            //添加产品信息
            $result = $productModel->addProduct($data);
            //返回添加结果
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."产品管理添加成功。" . "产品名：" . $productName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('ADD_PRODUCT_SUCCESS'), U('Product/listproduct'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."产品管理添加失败。" . "产品名：" . $productName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('ADD_PRODUCT_FAILURE'));
            }
        } else{
            //实例化ProductGroup模型
            $productGroupModel = D('ProductGroup');
            //查找产品分组表中所有的数据
            $productGroup = $productGroupModel->selectAllProductGroups();
            //赋值到模版
            $this->assign('productgroup', $productGroup);
            $this->display('Product/addproduct');
        }



    }


    /**
     * 删除产品的方法
     */
    public function deleteProduct() {
        if (IS_GET){
            //接受GET传递过来的值
            $productId = I('productid');

            //实列化Product模型
            $productModel = D('Product');
            //查找产品表中product_id为$productId的一条数据
            $product = $productModel->selectProductById($productId);
            // 删除产品表中product_id为$productid的一条数据
            $result = $productModel->deleteProductById($productId);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."产品删除成功。" . "产品名：" .$product['product_name'];
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('DELTE_PRODUCT_SUCCESS'), U('Product/listproduct'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."会员删除成功。" . "用户名：" .$product['product_name'];
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('DELTE_PRODUCT_FAILURE'));
            }
        }
    }

    /**
     * 编辑产品
     */
    public function editProduct() {
        if (IS_POST) {
            //接受POST传递过来的参数
            $paramConfigId=I('paramconfigid');
            $productId = I('productid');
            $productName = I('productname');
            $productTitle = I('producttitle');
            $productKeywords = I('productkeywords');
            $productDescription = I('productdescription');
            $groupId = I('groupid');
            // 调用上传图片的方法
            $file = $_FILES['productpic'];
            $info = upload_img($file);
            //获取上传路径
            if ($info) {
                $productPic = $info['savepath'] . $info['savename'];
            } else {
                $productPic = $_FILES['productpic'];
            }
            $productContent = I('productcontent');
            $productSummary = I('productsummary');
            $productaddtime=I('productaddtime');

            //接收到的值不能为空
            if (empty($productName)) {
                $this->error('产品名不能为空');
            }
            if (empty($productTitle)) {
                $this->error('标题不能为空');
            }
            if (empty($groupId)) {
                $this->error('产品分组不能为空');
            }
            //封装数据
            $data['param_config_id']=$paramConfigId;
            $data['product_name'] = $productName;
            $data['product_title'] = $productTitle;
            $data['product_keywords'] = $productKeywords;
            $data['group_id'] = $groupId;
            $data['product_pic'] = $productPic;
            $data['product_description'] = $productDescription;
            $data['product_content'] = $productContent;
            $data['product_summary'] = $productSummary;
            if(empty($productaddtime)){
                $data['product_addtime'] = time();
            }else{
                $data['product_addtime']=strtotime($productaddtime);
            }


            //实列化Product模型
            $productModel = D('Product');
            //添加产品信息
            $result = $productModel->saveProduct($productId, $data);
            //返回编辑结果
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."产品编辑成功。" . "产品名：" . $productName ;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('EDIT_PRODUCT_SUCCESS'), U('Product/listproduct'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."产品编辑失败。" . "产品名：" . $productName ;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('EDIT_PRODUCT_FAILURE'));
            }
        } else{

            //接受GET传递过来的参数
            $productId = I('productid');

            //实列化Product模型
            $productModel = D('Product');
            // //实例化ProductGroup模型
            $productGroupModel = D('ProductGroup');

            //查找产品分组表中所有的数据
            $productGroup = $productGroupModel->selectAllProductGroups();


            //查找产品表中product_id为$productId的一条数据
            $product = $productModel->selectProductById($productId);
            //实例化 ParamConfigModel
            $ParamConfigModel=D('ParamConfig');
            //查找到paramConfig的id
            $paramConfigId=$product['param_config_id'];
            //查找到paramConfig的id对应得那条数据；
            $paramconfig=$ParamConfigModel->selectParamConfigById($paramConfigId);

            //赋值到模版
            $this->assign('paramconfig',$paramconfig);
            $this->assign('product', $product);
            $this->assign('productgroup', $productGroup);
            $this->display();
        }
    }

    /**
     * 订单界面
     */
    public function listProductorder(){
        //select all product information
        //实例化Productorder模型
        $productorderModel=D('ProductOrder');
        //所有订单的数量
        $count=$productorderModel->selectProductOrderTotalSize();
        //实例化分页类
        $page = new \Org\Page\Page($count,$this->adminPageSize);
        //获取每页显示的数据集
        $productorder = $productorderModel->selectAllProductByPage($page);
        //分页显示输出
        $show = $page->show();
        //管理员操作记录到日志表中
        $logcontent =  C('SYS_LOG_ACTION_SELECT')."产品管理查询成功";

        sys_log(session('adminId'),session('adminName'),$logcontent);
        $this->assign('productorder', $productorder);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display('Product/listproductorder');
    }
    /**
     * 删除订单的方法
     */
    public function deleteProductorder() {
        if (IS_GET){
            //接受GET传递过来的值
            $productorderId = I('producordertid');

            //实列化Product模型
            $productorderModel = D('ProductOrder');
            //查找产品表中product_id为$productId的一条数据
            $productorder = $productorderModel->selectProductOrderById($productorderId);
            // 删除产品表中product_id为$productid的一条数据
            $result = $productorderModel->deleteProductorderById($productorderId);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."订单删除成功。" . "订单号：" .$productorder['order_id'];
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('DELTE_PRODUCT_SUCCESS'), U('Product/listproduct'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."订单删除成功。" . "用户名：" .$productorder['order_id'];
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('DELTE_PRODUCT_FAILURE'));
            }
        }
    }
    //查看订单详情
    public function productOrder(){
        //接受GET传递过来的参数
        $productorderId = I('productOrderId');

        //实列化Message模型
        $productorderModel = D('ProductOrder');

        //查找留言表中message_id为$messageId的一条数据
        $productorder = $productorderModel->selectProductOrderById($productorderId);
        $productid=$productorder['product_id'];
        //实例化productModel类
        $productModel=D('Product');
        //查找productid为productid 的一条数据
        $product=$productModel->selectProductById($productid);
        //赋值到模版
        $this->assign('product',$product);
        $this->assign('productorder', $productorder);
        $this->display();
    }


    //ajax 提交改变ishidden 字段参数
    public function isHidden(){

        if(IS_POST){
            $ishidden=I('ishidden');
            $productId=I('productid');
            //实例化Singlepagemodel类
            $ProductModel=D('Product');
            //封装数据
            $data['is_hidden']= $ishidden;
            //编辑单页表singlepage中singlepage_id为$singlepageId的一条数据
            $result=$ProductModel->saveProduct($productId, $data);

            if($result){
                $ishiddens = array(

                    'status' => C('JSON_SUCCESS_CODE'),

                );
            }
            $this->ajaxReturn($ishiddens);
        }
    }





}