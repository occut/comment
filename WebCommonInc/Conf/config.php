<?php
/**
 * 项目公共配置文件.
 * @URL http://www.hfyefan.com
 * @Author HfYefan NetWork Co.,Ltd. 
 */
return array(
	//数据库连接配置.
	'DB_TYPE'   => 'mysql', 	  // 数据库类型
	'DB_HOST'   => 'localhost',   // 服务器地址
	'DB_NAME'   => 'tasks', // 数据库名
	'DB_USER'   => 'root', 		  // 用户名
	'DB_PWD'    => '2017Admindomain', 	      // 密码
	'DB_PORT'   => 3306, 		  // 端口
	'DB_PREFIX' => 'yefan_', 	  // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', 		  // 字符集
	'DB_DEBUG'  =>  TRUE, 		  // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增        
	
	//----------------------------
	
	//JSON 返回值
	'JSON_FAILURE_CODE'=>0,
	'JSON_SUCCESS_CODE'=>1,
	
	//----------------------------
	 'DATA_CACHE_TYPE'       => 'Memcache',
	//上传图片格式,用英文状态下的逗号隔开
	'UPLOAD_IMG_SUFFIX' => 'jpg,jpeg,gif,png,JPG,JPEG,GIF,PNG,doc',
	//上传图片大小,单位：M
	'UPLOAD_IMG_SIZE'=>'3',
	//图片上传路径
	'UPLOAD_IMG_DIRECTORY'=>'/UploadImages/',
	
	//----------------------------
        
        //配置零参数
        'NULL_PARAM'=>0,
    
       //支付宝配置参数
      'alipay_config'=>array(
      'partner' =>'2088411463617841',   //这里是你在成功申请支付宝接口后获取到的PID；
      'key'=>'j0kvppsabrott9bz6a795s0a2nr82px0',//这里是你在成功申请支付宝接口后获取到的Key
      'sign_type'=>strtoupper('MD5'),
      'input_charset'=> strtolower('utf-8'),
      'cacert'=> getcwd().'\\cacert.pem',
      'transport'=> 'http',
      ),
      
    'alipay'   =>array(
   //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
   'seller_email'=>'liming@ahyc.cc',
  //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
  'notify_url'=>'http://localhost/index.php/Pay/notifyurl', 
  //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
  'return_url'=>'http://localhost/index.php/Pay/returnurl',
  //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
  'successpage'=>'http://localhost/index.php/User/listpaymoney?ordtype=payed',   
  //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
  'errorpage'=>'http://localhost/index.php/User/alipay?ordtype=unpay', 
 ),
);
