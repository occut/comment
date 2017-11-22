<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class MessageModel extends Model {

    /**
     * 增加留言信息
     */
    public function addMessage($message) {
        $result = M('message')->add($message);
        return $result;
    }

    /**
     *  删除留言表message中message_id为$messageid的一条数据
     */
    public function deleteMessageById($messageId) {
        $result = M('message')->delete($messageId);
        return $result;
    }

    /**
     *  编辑留言表message中message_id为$messageId的一条数据
     */
    public function saveMessage($messageId, $message) {
        $result = M('message')->where('message_id=' . $messageId)->save($message);
        return $result;
    }

    /**
     * 查找留言表中的所有留言
     */
    public function selectAllMessages() {
        $result = M('message')->order('message_addtime')->select();
        return $result;
    }

    /**
     *  查找留言表message中message_id为$messageId的一条数据
     */
    public function selectMessageById($messageId) {
        $result = M('message')->find($messageId);
        return $result;
    }

    /**
     *  添加留言表message中message_id为$messageId的一条留言
     */
    public function addMessageReply($messageId, $message) {
        $result = M('Message')->where('message_id=' . $messageId)->save($message);
        return $result;
    }
    
     /**
     * 获取留言表中的总条数
     */
    public function selectMessageTotalSize() {
        $result = M('message')->count();
        return $result;
    }


    /**
     * 分页数据集
     */
    public function selectMessageByPage($Page) {
        $result = M('message')->limit($Page->firstRow . ',' . $Page->listRows)->order('message_id desc')->select();
        return $result;
    }

}
