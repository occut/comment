<?php
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
define('APP_DEBUG',true);
define('COMMON_PATH','./WebCommonInc/');
define('APP_PATH','./ApiApps/');
define('RUNTIME_PATH','./ApiRuntime/');
define('TMPL_PATH','./ApiApps/');
define('BUILD_DIR_SECURE', false);
define('BIND_MODULE','Api'); 
require './ThinkPHPFrame/ThinkPHP.php';