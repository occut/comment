<?php

/*
 *
 * 项目公共函数库。
 */

/**
 * 调用框架的上传函数
 */
function upload_img($file) {

    //获取网站配置
    $webConfigModel = D('WebConfig');
    $webConfig = $webConfigModel->selectWebConfig();

    // 实例化上传类
    $upload = new \Think\Upload();
    // 设置附件上传大小
    $upload->maxSize = $webConfig['upload_size'] * 1024 * 1024;
    // 设置附件上传类型
    $upload->exts = explode('|', $webConfig['upload_type']);
    // 设置附件上传根目录
    $upload->rootPath = './';
    // 设置附件上传（子）目录
    $upload->savePath = C('UPLOAD_IMG_DIRECTORY');
    $info = $upload->uploadOne($file);
    return $info;
}

/**
 * 用户密码加密函数
 */
function user_md5($password) {
    $result = md5(md5($password, true));
    return $result;
}

/**
 * 生成信息编号（时间+8位随机数）
 */
function getinfonumber() {
    $arr = array();
    $count1 = 0;
    $count = 0;
    $str = "";
    $return = array();
    while ($count < 8) {
        $return[] = mt_rand(0, 9);
        $return = array_flip(array_flip($return));
        $count = count($return);
    }
    $arr = array_values($return); // 获得数组的值 
    foreach ($arr as $key) {
        $str .= $key;
    }
    $infonumber = date('Ymd', time());
    $infonumber .= $str;

    return $infonumber;
}

/**
 * 获取无限行业选项
 */
function getworktypeoptions($parentId, $level = 0, $workId) {
    global $str;
    $workTypeModel = D('WorkType');
    $workType = $workTypeModel->selectWorkTypesByParentId($parentId);
    if (!empty($workType)) {
        foreach ($workType as $k => $v) {
            if ($v['work_id'] != $workId) {
                $str .= "<option value='" . $v['work_id'] . "'>";
                $str .= str_repeat("&nbsp;", $level * 5) . $v['work_name'];
                $str .= "</option>";
                getworktypeoptions($v['work_id'], $level + 1, $workId);
            }
        }
    }
    return $str;
}

/**
 * 获取文章分组选项
 */
function getarticletypeeoptions($parentId, $level = 0, $groupId) {
    global $art;
    $articleGroupModel = D('ArticleGroup');
    $articleGroup = $articleGroupModel->selectArticleGroupByParentId($parentId);
    if (!empty($articleGroup)) {

        foreach ($articleGroup as $k => $v) {
            if ($v['group_id'] != $groupId) {
                $art .= "<option value='" . $v['group_id'] . "'>";
                $art .= str_repeat("&nbsp;", $level * 5) . $v['group_name'];
                $art .= "</option>";
                getarticletypeeoptions($v['group_id'], $level + 1, $groupId);
            }
        }
    }
    return $art;
}
/**
 * 获取产品分组选项
 */
function getproducttypeoptions($parentId, $level = 0, $groupId) {
    global $art;
    $productGroupModel = D('ProductGroup');
    $productGroup = $productGroupModel->selectProductGroupByParentId($parentId);
    if (!empty($productGroup)) {

        foreach ($productGroup as $k => $v) {
            if ($v['group_id'] != $groupId) {
                $art .= "<option value='" . $v['group_id'] . "'>";
                $art .= str_repeat("&nbsp;", $level * 5) . $v['group_name'];
                $art .= "</option>";
                getproducttypeoptions($v['group_id'], $level + 1, $groupId);
            }
        }
    }
    return $art;
}

/**
 * 获取招聘分类分组选项
 */
function gethrtypeoptions($parentId, $level = 0, $groupId) {
    global $art;
    $hrGroupModel = D('HrGroup');
    $hrGroup = $hrGroupModel->selectHrGroupByParentId($parentId);
    if (!empty($hrGroup)) {
        foreach ($hrGroup as $k => $v) {
            if ($v['group_id'] != $groupId) {
                $art .= "<option value='" . $v['group_id'] . "'>";
                $art .= str_repeat("&nbsp;", $level * 5) . $v['group_name'];
                $art .= "</option>";
                gethrtypeoptions($v['group_id'], $level + 1, $groupId);
            }
        }
    }
    return $art;
}

/**
 * 获取导航分组选项
 */
function getnavigationtypeoptions($parentId, $level = 0, $groupId) {
    global $art;
    $navigationModel = D('Navigation');
    $navigation = $navigationModel->selectNavigationByParentId($parentId);
    if (!empty($navigation)) {

        foreach ($navigation as $k => $v) {
            if ($v['nav_id'] != $groupId) {
                $art .= "<option value='" . $v['nav_id'] . "'>";
                $art .= str_repeat("&nbsp;", $level * 5) . $v['nav_name'];
                $art .= "</option>";
                getnavigationtypeoptions($v['nav_id'], $level + 1, $groupId);
            }
        }
    }
    return $art;
}

/**
 * 获取导航分组选项
 */
function getnavigationtypehtml($parentId, $level = 0, $groupId) {
    global $art;
    $navigationModel = D('Navigation');
    $navigation = $navigationModel->selectNavigationByParentId($parentId);
    if (!empty($navigation)) {
        $art.='<div id="navChild" style="display: none;">';
        foreach ($navigation as $k => $v){
//            $art.='<li rel=".$v['nav_url']" class=""><a href="{:U(\'Singlepage/aboutUs\'}"></a>';
            if ($v['nav_id'] != $groupId){
                $art .= "<a href='" . $v['nav_url'] . "'>";
                $art .= str_repeat("&nbsp;", $level * 5) . $v['nav_name'];
                $art .= "</a>";
                getnavigationtypehtml($v['nav_id'], $level + 1, $groupId);
            }

//            $art.='</li>';
        }
        $art.='</div>';


    }
    return $art;
}


/**
 * 查询号码归属地
 */
function queryphoneattr($mobile) {
    //根据阿凡达的数据库调用返回值  
    $url = "http://api.avatardata.cn/MobilePlace/LookUp?key=846008ad760e4d0f8f7354868a89dc54&mobileNumber=".$mobile;
    $content = file_get_contents($url);
    $info = json_decode($content, true);
    return $info['result']['mobilearea'];
}

?>
