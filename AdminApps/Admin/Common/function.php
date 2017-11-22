<?php

/**
 * Functions: 后台公共函数文件.
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

/**
 * 管理员密码加密函数
 */
function admin_md5($password) {
    $result = substr((md5(md5($password, true))), 1, 20);
    return $result;
}

/**
 * 添加管理员操作记录到日志表中
 */
function sys_log_database($adminId, $logcontent) {
    $data['admin_id'] = $adminId;
    $data['log_content'] = $logcontent;
    $data['log_time'] = time();
    $returnValue = D('SysLog')->add($data);
    return $returnValue;
}

/* *
 *  生成日志文件名
 */

function sys_log_file($adminName, $logcontent) {
    header("Content-type: text/html; charset=utf-8");
    $filename = C('SYS_LOG_DIRECTORY') . date('Ymd', time()) . '.txt'; //要写入文件的文件名（可以是任意文件名），如果文件不存在，将会创建一个
    $time = date("Y-m-d H:i:s", time());
    $content = "$adminName:" . '  ' . $logcontent . '  ' . "生成时间：" . $time . "\r\n";
    file_put_contents($filename, $content, FILE_APPEND);
}

/**
 * 添加管理员操作记录到日志表中
 */
function sys_log($adminId, $adminName, $logcontent) {
    sys_log_database($adminId, $logcontent);
    sys_log_file($adminName, $logcontent);
}

/**
 * 获取无限分类行业列表
 */
function getworktypelist($parentId, $level = 0) {
    global $str;
    $workTypeModel = D('WorkType');
    $workType = $workTypeModel->selectWorkTypesByParentId($parentId);
    if (!empty($workType)) {
        foreach ($workType as $k => $v) {

            $str .= "<tr>";
            $str .= "<td>" . $v['work_id'] . "</td>";
            $str .= "<td>" . str_repeat('&nbsp;', $level * 5) . $v['work_name'] . "</td>";
            $str .= "<td><a href=\"" . U('Config/editWorkType', array('workid' => $v['work_id'])) . "\">编辑</a> <a href=\"" . U('Config/deleteWorkType', array('workid' => $v['work_id'])) . "\" onclick=\"if (confirm('确定删除?') == false)
                                                        return false;\">删除</a></td>";
            $str .= "</tr>";
            getworktypelist($v['work_id'], $level + 1);
        }
    }
    return $str;
}

/**
 * 获取文章分组无限级列表
 */
function getarticlegrouplist($parentId, $level = 0) {
    global $art;
    $articleGroupModel = D('ArticleGroup');
    $articleGroup =$articleGroupModel->selectArticleGroupByParentId($parentId);
    if (!empty($articleGroup)) {
        foreach ($articleGroup as $k => $v) {

            $art .= "<tr>";
            $art .= "<td>" . $v['group_id'] . "</td>";
            $art .= "<td>" . str_repeat('&nbsp;', $level * 5) . $v['group_name'] . "</td>";
            $art .= "<td ><a href=\"" . U('Article/editarticlegroup', array('groupid' => $v['group_id'])) . "\">编辑</a> <a href=\"" . U('Article/deleteArticleGroup', array('groupid' => $v['group_id'])) . "\" onclick=\"if (confirm('确定删除?') == false)
                                                        return false;\">删除</a></td>";
            $art .= "</tr>";
            getarticlegrouplist($v['group_id'], $level + 1);
        }
    }
    return $art;
}
//获取文章url
function articlegrouplist($parentId, $level = 0) {
    global $art;
    $articleGroupModel = D('ArticleGroup');
    $articleGroup =$articleGroupModel->selectArticleGroupByParentId($parentId);
    if (!empty($articleGroup)) {
        foreach ($articleGroup as $k => $v) {

            $art .= "<tr>";
            $art .= '<td style="text-align:left;line-height: 36px;padding-left: 60px ">'.str_repeat('&nbsp;', $level * 5) . $v['group_name'] . "</td>";
            $art.='<td style="text-align: right ;padding-right: 30px"><button onclick="urllist(this)" class="btn btn-primary">点击选中</b></td>';
            $art .= "<td style='text-align:right ;display: none'>" . C('ARTICLE').'listArticleid/'.$v['group_id'] ."</td>";
            $art .= "</tr>";
           articlegrouplist($v['group_id'], $level + 1);
        }
    }
    return $art;
}


//获取案例url
function casegrouplist($parentId, $level = 0) {
    global $art1;
    $articleGroupModel = D('ArticleGroup');
    $articleGroup =$articleGroupModel->selectArticleGroupByParentId($parentId);
    if (!empty($articleGroup)) {
        foreach ($articleGroup as $k => $v) {

            $art1 .= "<tr>";
            $art1 .= '<td style="text-align:left ;line-height: 36px;padding-left: 60px">'.str_repeat('&nbsp;', $level * 5) . $v['group_name'] . "</td>";
            $art1.='<td style="text-align: right ;padding-right: 30px"><button onclick="urllist(this)" class="btn btn-primary">点击选中</b></td>';
            $art1 .= "<td style='text-align: right ;display: none'>" . C('CASE').'caseid/'.$v['group_id'] . "</td>";
            $art1 .= "</tr>";
            casegrouplist($v['group_id'], $level + 1);
        }
    }
    return $art1;
}


/**
 * 获取产品url
 */
function productgrouplist($parentId, $level = 0) {
    global $art2;
    $productGroupModel = D('ProductGroup');
    $productGroup = $productGroupModel->selectProductGroupByParentId($parentId);
    if (!empty($productGroup)) {
        foreach ($productGroup as $k => $v) {

            $art2 .= "<tr>";
            $art2 .= '<td style="text-align:left;line-height: 36px;padding-left: 60px ">'.str_repeat('&nbsp;', $level * 5) . $v['group_name'] . "</td>";
            $art2.='<td style="text-align: right ;padding-right: 30px"><button onclick="urllist(this)" class="btn btn-primary">点击选中</b></td>';
            $art2 .= "<td style='text-align: right ;display: none'>" . C('PRODUCT').'productid/'.$v['group_id'] . "</td>";
            $art2 .= "</tr>";
            productgrouplist($v['group_id'], $level + 1);
        }
    }
    return $art2;
}

/**
 * 获取人才招聘url
 */
function hrgrouplist($parentId, $level = 0) {
    global $art3;
    $hrGroupModel = D('HrGroup');
    $hrGroup = $hrGroupModel->selectHrGroupByParentId($parentId);
    if (!empty($hrGroup)) {
        foreach ($hrGroup as $k => $v) {

            $art3 .= "<tr>";
            $art3 .= '<td style="text-align:left ;line-height: 36px;padding-left: 60px">'.str_repeat('&nbsp;', $level * 5) . $v['group_name'] . "</td>";
            $art3.='<td style="text-align: right;padding-right: 30px"><button onclick="urllist(this)" class="btn btn-primary">点击选中</b></td>';
            $art3 .= "<td style='text-align: right;display: none '>" . C('HR').'hrid/'.$v['group_id'] . "</td>";
            $art3 .= "</tr>";
            hrgrouplist($v['group_id'], $level + 1);
        }
    }
    return $art3;
}








/**
 * 获取产品分组无限级列表
 */
function getproductgrouplist($parentId, $level = 0) {
    global $art;
    $productGroupModel = D('ProductGroup');
    $productGroup = $productGroupModel->selectProductGroupByParentId($parentId);
    if (!empty($productGroup)) {
        foreach ($productGroup as $k => $v) {

            $art .= "<tr>";
            $art .= "<td>" . $v['group_id'] . "</td>";
            $art .= "<td>" . str_repeat('&nbsp;', $level * 5) . $v['group_name'] . "</td>";
            $art .= "<td><a href=\"" . U('Product/editproductgroup', array('groupid' => $v['group_id'])) . "\">编辑</a> <a href=\"" . U('Product/deleteProductGroup', array('groupid' => $v['group_id'])) . "\" onclick=\"if (confirm('确定删除?') == false)
                                                        return false;\">删除</a></td>";
            $art .= "</tr>";
            getproductgrouplist($v['group_id'], $level + 1);
        }
    }
    return $art;
}

/**
 * 获取招聘分类分组无限级列表
 */
function gethrgrouplist($parentId, $level = 0) {
    global $art;
    $hrGroupModel = D('HrGroup');
    $hrGroup = $hrGroupModel->selectHrGroupByParentId($parentId);
    if (!empty($hrGroup)) {
        foreach ($hrGroup as $k => $v) {

            $art .= "<tr>";
            $art .= "<td>" . $v['group_id'] . "</td>";
            $art .= "<td>" . str_repeat('&nbsp;', $level * 5) . $v['group_name'] . "</td>";
            $art .= "<td><a href=\"" . U('Hr/edithrgroup', array('groupid' => $v['group_id'])) . "\">编辑</a> <a href=\"" . U('Hr/deleteHrGroup', array('groupid' => $v['group_id'])) . "\" onclick=\"if (confirm('确定删除?') == false)
                                                        return false;\">删除</a></td>";
            $art .= "</tr>";
            gethrgrouplist($v['group_id'], $level + 1);
        }
    }
    return $art;
}

/**
 * 获取导航分组无限级列表
 */
//if($v['is_hidden']==0){echo'是';}else{echo'否';}
function getnavigationgrouplist($parentId, $level = 0) {
    global $art;
    $navigationModel = D('Navigation');
    $navigation = $navigationModel->selectNavigationByParentId($parentId);
    if (!empty($navigation)) {
        foreach ($navigation as $k => $v) {

            $art .= "<tr>";
            $art .= "<td>" . $v['nav_id'] . "</td>";
            $art .= "<td>" . str_repeat('', $level * 5) . $v['nav_name'] . "</td>";
            $art.="<td>".$v['nav_title']."</td>";
            if($v['is_out']==0){
                $art.="<td>". $v['nav_url'] ."</a></td>";
            }else{
                $art.="<td></td>";
            }
            $art .= "<td><a href=\"" . U('Navigation/editnavigation', array('navid' => $v['nav_id'])) . "\">编辑</a> <a href=\"" . U('Navigation/deleteNavigation', array('navid' => $v['nav_id'])) . "\" onclick=\"if (confirm('确定删除?') == false)
                                                        return false;\">删除</a></td>";
            $art .= "</tr>";
            getnavigationgrouplist($v['nav_id'], $level + 1);
        }
    }
    return $art;
}

/**
 * 删除缓存文件
 */
function deldir($dir) {
    //先删除目录下的文件：
    $dh = opendir($dir);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != "..") {
            $fullpath = $dir . "/" . $file;
            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }
    closedir($dh);
    //删除当前文件夹：
    if (rmdir($dir)) {
        return true;
    } else {
        return false;
    }
}

/**
 * 数据备份
 */
function MySqlBackup() {
    $dbhost = C('DB_HOST'); //数据库主机名 
    $dbuser = C('DB_USER'); //数据库用户名 
    $dbpass = C('DB_PWD');  //数据库密码 
    $dbname = C('DB_NAME'); //数据库名
    $dbcharset = C('DB_CHARSET'); // 数据库字符集
    mysql_connect($dbhost, $dbuser, $dbpass) or die("数据库连接失败，请核对后再试"); //连接数据库 
    mysql_select_db($dbname) or die("不存在数据库: $dbname 请核对后再试");         //打开数据库 	
    mysql_query("set names 'utf8'");
    $mysql = "set charset utf8;|||\r\n";
    $q1 = mysql_query("show tables");
    while ($t = mysql_fetch_array($q1)) {
        $table = $t[0];
        $q2 = mysql_query("show create table `$table`");
        $sql = mysql_fetch_array($q2);
        $mysql .= $sql['Create Table'] . ";|||\r\n";
        $q3 = mysql_query("select * from `$table`");
        while ($data = mysql_fetch_assoc($q3)) {
            $keys = array_keys($data);
            $keys = array_map('addslashes', $keys);
            $keys = join('`,`', $keys);
            $keys = "`" . $keys . "`";
            $vals = array_values($data);
            $vals = array_map('addslashes', $vals);
            $vals = join("','", $vals);
            $vals = "'" . $vals . "'";
            $mysql .= "insert into `$table`($keys) values($vals);|||\r\n";
        }
    }
    mysql_close();
//    if(!file_exists(C('DB_MYSQL'))){
//        mkdir()
//    }
    $filename = C('DB_MYSQL') . $dbname . date('YmdHis') . ".sql"; //存放路径，默认存放到项目最外层
    if(!file_exists(C('DB_MYSQL'))){
        mkdir(C('DB_MYSQL'));
    }
    $fp = fopen($filename, 'w');
    fputs($fp, $mysql);
    fclose($fp);

    //echo "数据备份成功";
    return true;
}

/**
 * 获取文件下面的文件列表
 */
function MyScandir($FilePath = './', $Order = 0) {
    $FilePath = opendir($FilePath);
    while (false !== ($filename = readdir($FilePath))) {
        $FileAndFolderAyy[] = $filename;
    }
    closedir($FilePath);
    $Order == 0 ? sort($FileAndFolderAyy) : rsort($FileAndFolderAyy);
    return $FileAndFolderAyy;
}

/**
 * 导入备份的数据库
 */
function MySqlUpload() {
    $file_name = C('DB_MYSQL');     //读取要导入的SQL文件名 
    $dir = MyScandir($file_name, 1); //获取文件下面的文件列表
    $fileDir = $file_name . $dir[0];  //获取最近一次备份的文件
    $info = file_get_contents($fileDir); //读取最近一次备份的文件内容

    $dbhost = C('DB_HOST'); //数据库主机名 
    $dbuser = C('DB_USER'); //数据库用户名 
    $dbpass = C('DB_PWD');  //数据库密码 
    $dbname = C('DB_NAME'); //数据库名
    $dbcharset = C('DB_CHARSET'); // 数据库字符集	
    set_time_limit(0);     //设置超时时间为0，表示一直执行。当php在safe mode模式下无效，此时可能会导致导入超时，此时需要分段导入 
    mysql_connect($dbhost, $dbuser, $dbpass) or die("数据库连接失败，请核对后再试"); //连接数据库 
    mysql_select_db($dbname) or die("不存在数据库: $dbname 请核对后再试");         //打开数据库 
    //echo "<p>正在清空数据库,请稍等....<br>";
    if (empty($info)) {
        return false;
    } else {
        $result = mysql_query("SHOW TABLES");
        while ($currow = mysql_fetch_array($result)) {
            mysql_query("DROP TABLE IF EXISTS $currow[0]");
            //echo "清空数据表【" . $currow[0] . "】成功！<br>";
        }
        //echo "<br>恭喜你清理MYSQL成功<br>";
        //读取文件内容，用|||分割成数组，上传到数据库
        $info = explode('|||', $info);
        foreach ($info as $k => $v) {
            mysql_query($v);
            //unset($k);
        }
        mysql_close();
        //echo "<br>导入完成！";
        return true;
    }
}

/**
 * 根据用户名来获取用户ID
 */
function getuserid($userName) {
    //实例化用户模型
    $userModel = D('User');

    //查找用户信息
    $user = $userModel->selectUserByName($userName);

    foreach ($user as $k => $v) {
        $userid = $v['user_id'];
    }

    return $userid;
}

/*字符串截断函数+省略号*/
function subtext($text, $length)
{
    if(mb_strlen($text, 'utf8') > $length)
        return mb_substr($text, 0, $length, 'utf8').'...';
    return $text;
}