<?php

/**
 * Functions: 留言管理 .
 * Author: Fang Lijie
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class MessageController extends SuperController {

    /**
     * 留言列表界面
     */
    public function listMessages() {
        //select all message information
        //实列化Message模型
        $messageModel = D('Message');

        //获取总的留言数
        $count = $messageModel->selectMessageTotalSize();

        //实例化分页类
        $page = new \Org\Page\Page($count,$this->adminPageSize);


        //获取每页显示的数据集
        $messages = $messageModel->selectMessageByPage($page);

        //分页显示输出
        $show = $page->show();

        //管理员操作记录到日志表中
        $logcontent =  C('SYS_LOG_ACTION_SELECT')."留言管理查询成功";
        sys_log(session('adminId'),session('adminName'),$logcontent);

        $this->assign('messages', $messages);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display('Message/listmessages');
    }
    /**
     * 删除留言的方法
     */
    public function deleteMessage() {
        if (IS_GET){
            //接受GET传递过来的值
            $messageId = I('messageid');

            //实列化Message模型
            $messageModel = D('Message');
            //查找留言表中message_id为$messageId的一条数据
            $message = $messageModel->selectMessageById($messageId);
            // 删除留言表中message_id为$messageid的一条数据
            $result = $messageModel->deleteMessageById($messageId);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."留言删除成功。" . "留言名：" .$message['message_name'];
                sys_log(session('adminId'),session('adminName'),$logcontent);
                
                $this->success(L('DELTE_ARTICLE_SUCCESS'), U('Message/listmessages'));
        } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."会员删除成功。" . "用户名：" .$message['message_name'];
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('DELTE_ARTICLE_FAILURE'));
        }
    }
    }
            /*
             * 回复留言表中message_id为messageid的一条留言
             */
    public function addMessageReply() {
        if (IS_POST) {
            //接受POST传递过来的参数
            $messageId = I('messageid');
            $messageReply = I('messagereply');
            $ishidden=I('ishidden');

            //接收到的值不能为空

            //封装数据
            $data['is_hidden']=$ishidden;
           $data['message_reply']=$messageReply;
            //实列化Message模型
            $messageModel = D('Message');
            //添加回复信息
            $result = $messageModel->addMessageReply($messageId, $data);
            //返回编辑结果
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."回复成功。"  ;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('EDIT_MESSAGE_SUCCESS'), U('Message/listmessages'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."回复失败。"  ;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('EDIT_MESSAGE_FAILURE'));
            }
        } else{

            //接受GET传递过来的参数
            $messageId = I('messageid');

            //实列化Message模型
            $messageModel = D('Message');
            
            //查找留言表中message_id为$messageId的一条数据
            $message = $messageModel->selectMessageById($messageId);

            //赋值到模版
            $this->assign('message', $message);
            $this->display();
        }
    }



    //ajax 提交改变ishidden 字段参数
    public function isHidden(){

        if(IS_POST){
            $ishidden=I('ishidden');
            $messageId=I('messageid');
            //实例化Singlepagemodel类
            $MessageModel=D('Message');
            //封装数据
            $data['is_hidden']= $ishidden;
            //编辑单页表singlepage中singlepage_id为$singlepageId的一条数据
            $result= $MessageModel->saveMessage($messageId, $data);

            if($result){
                $ishiddens = array(

                    'status' => C('JSON_SUCCESS_CODE'),

                );
            }
            $this->ajaxReturn($ishiddens);
        }
    }

}
