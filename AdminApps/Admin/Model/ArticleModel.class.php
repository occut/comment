<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class ArticleModel extends Model {

    /**
     * 增加文章信息
     */
    public function addArticle($article) {
        $result = M('article')->add($article);
        return $result;
    }

    /**
     *  删除文章表article中article_id为$articleid的一条数据
     */
    public function deleteArticleById($articleId) {
        $result = M('article')->delete($articleId);
        return $result;
    }

    /**
     * 删除文章表article中group_id为$groupId的一条数据
     */
    public function deleteArticleByGroupId($groupId) {
        $result = M('article')->where('group_id=' . $groupId)->delete();
        return $result;
    }

    /**
     *  编辑文章表article中article_id为$articleId的一条数据
     */
    public function saveAriticle($articleId, $article) {
        $result = M('tasks')->where('tasks_id=' . $articleId)->save($article);
        return $result;
    }

    /**
     * 查找文章表中的所有文章
     */
    public function selectAllArticles() {
        $result = M('article')->order('article_addtime')->select();
        return $result;
    }

    /**
     *  查找文章表article中article_id为$articleId的一条数据
     */
    public function selectArticleById($articleId) {
        $result = M('article')->find($articleId);
        return $result;
    }

    /**
     *  查找文章表article中group_id为$groupId的所有数据
     */
    public function selectArticlceByGroupId($groupId) {
        $result = M('article')->where('group_id=' . $groupId)->select();
        return $result;
    }
    
     /**
     * 获取文章表中的总条数
     */
    public function selectArticleTotalSize() {
        $result = M('article')->count();
        return $result;
    }

    /**
     * 分页数据集
     */
    public function selectArticleByPage($Page) {
        $result = M('article')->limit($Page->firstRow . ',' . $Page->listRows)->order('group_id desc')->select();
        return $result;
    }

}
