<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class ArticleGroupModel extends Model {

    /**
     * 添加文章分组
     */
    public function addArticleGroup($articleGroup) {
        $result = M('article_group')->add($articleGroup);
        return $result;
    }

    /**
     * 删除文章分组article_group中group_id为$groupid的一条数据
     */
    public function deleteArticleGroupById($groupId) {
        $result = M('article_group')->delete($groupId);
        return $result;
    }

    /**
     * 查找文章分组article_group中group_id为$groupid的一条数据
     */
    public function saveArticleGroup($groupId, $articleGroup) {
        $result = M('article_group')->where('group_id=' . $groupId)->save($articleGroup);
        return $result;
    }

    /**
     * 查找所有的文章分组
     */
    public function selectAllArticleGroups() {
        $result = M('article_group')->select();
        return $result;
    }

    /**
     * 查找文章分组article_group中group_id为$groupid的一条数据
     */
    public function selectArticleGroupById($groupId) {
        $result = M('article_group')->find($groupId);
        return $result;
    }

    /**
     * 获取文章分组表中的总条数
     */
    public function selectArticleGroupTotalSize() {
        $result = M('article_group')->count();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectArticleGroupByPage($Page) {
        $result = M('article_group')->where()->limit($Page->firstRow . ',' . $Page->listRows)->select();
        return $result;
    }
    
    /**
     * 获取文章分组中父级
     */
    public function selectArticleGroupByParentId($parentId) {
        $result = M('article_group')->where('parent_id='.$parentId)->select();
        return $result;
    }

}
