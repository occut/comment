<?php
/**
 * Functions: 后台配置文件.
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */
 
/**
 * 后台用到的一些常量配置
 */
return array(

	//管理员状态
	'ADMIN_STATUS_OK'=>'1',
	'ADMIN_STATUS_NO'=>'0',

    //缓存路径
    'INDEX_RUNTIME_PATH'=>'IndexRuntime/',
    'ADMIN_RUNTIME_PATH'=>'AdminRuntime/',
    
	//代码路径
    'RESOURCE_PATH'=>'/AdminResource/',
    'TEMPLATE_PATH'=>'/AdminTemplate/',

    // 默认控制器名称
    'DEFAULT_CONTROLLER'    =>  'Login',
    // 默认操作名称 
    'DEFAULT_ACTION'        =>  'index', 
    
    //日志类型
    'SYS_LOG_ACTION_ADD'=>'Add Operation:',
    'SYS_LOG_ACTION_DELETE'=>'Delete Operation:',
    'SYS_LOG_ACTION_MODIFY'=>'Modify Operation:',
    'SYS_LOG_ACTION_SELECT'=>'Select Operation:',
    'SYS_LOG_ACTION_OTHER'=>'Other Operation:',
    
    //文件日志保存目录
    'SYS_LOG_DIRECTORY'  => 'AdminLogs/',
    
    //开启语言包功能
    'LANG_SWITCH_ON' => true,   // 开启语言包功能
    'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'        => 'zh-cn', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量
    
    //配置sql文件备份路径
    'DB_MYSQL'  =>'WebDataBackup/',
    
    
    //单页
        "SINGLEPAGE"=>"Singlepage/listSinglepage/",
    //产品
        'PRODUCT'=>'Product/listProduct/',
    //招聘
        'HR'=>'Hr/listHr/',
    //留言
    	'MESSAGE'=>'Message/message/',
    //文章
    	'ARTICLE'=>'Article/listArticle/',
    //网站首页
    	'INDEX'=>'Index/index/',

);