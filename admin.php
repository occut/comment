<?php
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
define('APP_DEBUG',true);
define('COMMON_PATH','./WebCommonInc/');
define('APP_PATH','./AdminApps/');
define('RUNTIME_PATH','./AdminRuntime/');
define('TMPL_PATH','./AdminTemplate/');
define('BUILD_DIR_SECURE', false);
define('BIND_MODULE','Admin'); 
require './ThinkPHPFrame/ThinkPHP.php';