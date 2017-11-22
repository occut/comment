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
       
        //公共配置
        'EXIST_SUBCLASS'=>'分类下有子类，请先删除子类', 
        'EXIST_SUBARTICLE'=>'分类下有文章，请先删除文章', 
         'EXIST_SUBPARENTID'=>'请先删除文章分组中的下级',
        
    //登录验证
    'LOGIN_ERROR_USERNAME'=>'用户名输入错误，请重新输入',
    'LOGIN_ERROR_STATUS'=>'此用户状态错误，请联系管理员',
    'LOGIN_ERROR_PASSWORD'=>'密码输入错误，请重新输入',
    
	//网站配置
	'EDIT_WEBCONFIG_SUCCESS'=>'网站配置编辑成功',
	'EDIT_WEBCONFIG_FAILURE'=>'网站配置编辑失败',
    
	
	//菜单配置
	'ADD_MENUGROUP_SUCCESS'=>'菜单分组添加成功',
	'ADD_MENUGROUP_FAILURE'=>'菜单分组添加失败',
	'DELTE_MENUGROUP_SUCCESS'=>'菜单分组删除成功',
	'DELTE_MENUGROUP_FAILURE'=>'菜单分组删除失败',
	'EDIT_MENUGROUP_SUCCESS'=>'菜单分组编辑成功',
	'EDIT_MENUGROUP_FAILURE'=>'菜单分组编辑失败',
	
	'ADD_MENU_SUCCESS'=>'菜单添加成功',
	'ADD_MENU_FAILURE'=>'菜单添加失败',
	'DELTE_MENU_SUCCESS'=>'菜单删除成功',
	'DELTE_MENU_FAILURE'=>'菜单删除失败',
	'EDIT_MENU_SUCCESS'=>'菜单编辑成功',
	'EDIT_MENU_FAILURE'=>'菜单编辑失败',
	
	//省份管理
        'ADD_PROVINCE_SUCCESS'=>'省份添加成功',
	'ADD_PROVINCE_FAILURE'=>'省份添加失败',
	'DELTE_PROVINCE_SUCCESS'=>'省份删除成功',
	'DELTE_PROVINCE_FAILURE'=>'省份删除失败',
	'EDIT_PROVINCE_SUCCESS'=>'省份编辑成功',
	'EDIT_PROVINCE_FAILURE'=>'省份编辑失败',
    
        //城市管理
        'ADD_CITY_SUCCESS'=>'城市添加成功',
	'ADD_CITY_FAILURE'=>'城市添加失败',
	'DELTE_CITY_SUCCESS'=>'城市删除成功',
	'DELTE_CITY_FAILURE'=>'城市删除失败',
	'EDIT_CITY_SUCCESS'=>'城市编辑成功',
	'EDIT_CITY_FAILURE'=>'城市编辑失败',
    
        //地区管理
        'ADD_AREA_SUCCESS'=>'地区添加成功',
	'ADD_AREA_FAILURE'=>'地区添加失败',
	'DELTE_AREA_SUCCESS'=>'地区删除成功',
	'DELTE_AREA_FAILURE'=>'地区删除失败',
	'EDIT_AREA_SUCCESS'=>'地区编辑成功',
	'EDIT_AREA_FAILURE'=>'地区编辑失败',
	
	//邮件配置
	'EDIT_MAIL_SUCCESS'=>'邮件编辑成功',
	'EDIT_MAIL_FAILURE'=>'邮件编辑失败',
	
	//短信配置
	'EDIT_SMS_SUCCESS'=>'短信编辑成功',
	'EDIT_SMS_FAILURE'=>'短信编辑失败',
	
	//行业配置
	'ADD_WORKTYPE_SUCCESS'=>'行业添加成功',
	'ADD_WORKTYPE_FAILURE'=>'行业添加失败',
	'DELTE_WORKTYPE_SUCCESS'=>'行业删除成功',
	'DELTE_WORKTYPE_FAILURE'=>'行业删除失败',
	'EDIT_WORKTYPE_SUCCESS'=>'行业编辑成功',
	'EDIT_WORKTYPE_FAILURE'=>'行业编辑失败',
	
	//文章管理
	'ADD_ARTICLE_SUCCESS'=>'文章添加成功',
	'ADD_ARTICLE_FAILURE'=>'文章添加失败',
	'DELTE_ARTICLE_SUCCESS'=>'文章删除成功',
	'DELTE_ARTICLE_FAILURE'=>'文章删除失败',
	'EDIT_ARTICLE_SUCCESS'=>'文章编辑成功',
	'EDIT_ARTICLE_FAILURE'=>'文章编辑失败',
    
	//文章分组
	'ADD_ARTICLEGROUP_SUCCESS'=>'文章分组添加成功',
	'ADD_ARTICLEGROUP_FAILURE'=>'文章分组添加失败',
	'DELTE_ARTICLEGROUP_SUCCESS'=>'文章分组删除成功',
	'DELTE_ARTICLEGROUP_FAILURE'=>'文章分组删除失败',
	'EDIT_ARTICLEGROUP_SUCCESS'=>'文章分组编辑成功',
	'EDIT_ARTICLEGROUP_FAILURE'=>'文章分组编辑失败',
	
	//会员管理
	'ADD_USER_SUCCESS'=>'会员添加成功',
	'ADD_USER_FAILURE'=>'会员添加失败',
	'DELTE_USER_SUCCESS'=>'会员删除成功',
	'DELTE_USER_FAILURE'=>'会员删除失败',
	'EDIT_USER_SUCCESS'=>'会员编辑成功',
	'EDIT_USER_FAILURE'=>'会员编辑失败',
	
	//会员分组
	'ADD_USERGROUP_SUCCESS'=>'会员分组添加成功',
	'ADD_USERGROUP_FAILURE'=>'会员分组添加失败',
	'DELTE_USERGROUP_SUCCESS'=>'会员分组删除成功',
	'DELTE_USERGROUP_FAILURE'=>'会员分组删除失败',
	'EDIT_USERGROUP_SUCCESS'=>'会员分组编辑成功',
	'EDIT_USERGROUP_FAILURE'=>'会员分组编辑失败',
	
	//管理员管理
	'ADD_ADMIN_SUCCESS'=>'管理员添加成功',
	'ADD_ADMIN_FAILURE'=>'管理员添加失败',
	'DELTE_ADMIN_SUCCESS'=>'管理员删除成功',
	'DELTE_ADMIN_FAILURE'=>'管理员删除失败',
	'EDIT_ADMIN_SUCCESS'=>'管理员编辑成功',
	'EDIT_ADMIN_FAILURE'=>'管理员编辑失败',
    
        //管理员分配权限
        'ADD_ADMINANDROLES_SUCCESS'=>'权限分配成功',
	'ADD_ADMINANDROLES_FAILURE'=>'权限分配失败',
	
	//角色管理
	'ADD_ROLE_SUCCESS'=>'角色添加成功',
	'ADD_ROLE_FAILURE'=>'角色添加失败',
	'DELTE_ROLE_SUCCESS'=>'角色删除成功',
	'DELTE_ROLE_FAILURE'=>'角色删除失败',
	'EDIT_ROLE_SUCCESS'=>'角色编辑成功',
	'EDIT_ROLE_FAILURE'=>'角色编辑失败',
        
       //角色分配资源
        'ADD_ROLERESOURCE_SUCCESS'=>'资源分配成功',
 	'ADD_ROLERESOURCE_FAILURE'=>'资源分配失败',
        
	
	//模块管理
	'ADD_MODULE_SUCCESS'=>'模块添加成功',
	'ADD_MODULE_FAILURE'=>'模块添加失败',
	'DELTE_MODULE_SUCCESS'=>'模块删除成功',
	'DELTE_MODULE_FAILURE'=>'模块删除失败',
	'EDIT_MODULE_SUCCESS'=>'模块编辑成功',
	'EDIT_MODULE_FAILURE'=>'模块编辑失败',
	
	//密码修改
	'EDIT_PASSWORD_SUCCESS'=>'密码修改成功',
	'EDIT_PASSWORD_FAILURE'=>'密码修改失败',
	
	//广告位置
	'ADD_ADSLOCATION_SUCCESS'=>'广告位置添加成功',
	'ADD_ADSLOCATION_FAILURE'=>'广告位置添加失败',
	'DELTE_ADSLOCATION_SUCCESS'=>'广告位置删除成功',
	'DELTE_ADSLOCATION_FAILURE'=>'广告位置删除失败',
	'EDIT_ADSLOCATION_SUCCESS'=>'广告位置编辑成功',
	'EDIT_ADSLOCATION_FAILURE'=>'广告位置编辑失败',
	
	//广告管理
	'ADD_ADS_SUCCESS'=>'广告添加成功',
	'ADD_ADS_FAILURE'=>'广告添加失败',
	'DELTE_ADS_SUCCESS'=>'广告删除成功',
	'DELTE_ADS_FAILURE'=>'广告删除失败',
	'EDIT_ADS_SUCCESS'=>'广告编辑成功',
	'EDIT_ADS_FAILURE'=>'广告编辑失败',
	
	//友链管理
	'ADD_FRIENDLYLINK_SUCCESS'=>'友情链接添加成功',
	'ADD_FRIENDLYLINK_FAILURE'=>'友情链接添加失败',
	'DELTE_FRIENDLYLINK_SUCCESS'=>'友情链接删除成功',
	'DELTE_FRIENDLYLINK_FAILURE'=>'友情链接删除失败',
	'EDIT_FRIENDLYLINK_SUCCESS'=>'友情链接编辑成功',
	'EDIT_FRIENDLYLINK_FAILURE'=>'友情链接编辑失败',
	
	//友链分组
	'ADD_LINKGROUP_SUCCESS'=>'友情链接分组添加成功',
	'ADD_LINKGROUP_FAILURE'=>'友情链接分组添加失败',
	'DELTE_LINKGROUP_SUCCESS'=>'友情链接分组删除成功',
	'DELTE_LINKGROUP_FAILURE'=>'友情链接分组删除失败',
	'EDIT_LINKGROUP_SUCCESS'=>'友情链接分组编辑成功',
	'EDIT_LINKGROUP_FAILURE'=>'友情链接分组编辑失败',
	
	//缓存清理
	'DELETE_CACHE_SUCCESS'=> '缓存清理完成。',
	'DELETE_CACHE_FAILURE'=> '缓存清理失败。',
	
	//数据备份
	'BACKUP_DATABASE_SUCCESS'=>'数据库备份成功。',
	'BACKUP_DATABASE_FAILURE'=>'数据库备份失败。',
	'RESTORE_DATABASE_SUCCESS'=>'数据库恢复成功。',
	'RESTORE_DATABASE_FAILURE'=>'数据库恢复失败。',
	
	//支付方式
	'EDIT_PAYWAP_SUCCESS'=>'支付方式编辑成功',
	'EDIT_PAYWAP_FAILURE'=>'支付方式编辑失败',
        
       //贷款类型
        'ADD_FUNDCLASS_SUCCESS'=>'贷款类型增加成功',
	'ADD_FUNDCLASS_FAILURE'=>'贷款类型添加失败',
	'DELTE_FUNDCLASS_SUCCESS'=>'贷款类型删除成功',
	'DELTE_FUNDCLASS_FAILURE'=>'贷款类型删除失败',
	'EDIT_FUNDCLASS_SUCCESS'=>'贷款类型编辑成功',
	'EDIT_FUNDCLASS_FAILURE'=>'贷款类型编辑失败',
	
        //贷款方式
        'ADD_FUNDTYPE_SUCCESS'=>'贷款方式添加成功',
	'ADD_FUNDTYPE_FAILURE'=>'贷款方式添加失败',
	'DELTE_FUNDTYPE_SUCCESS'=>'贷款方式删除成功',
	'DELTE_FUNDTYPE_FAILURE'=>'贷款方式删除失败',
	'EDIT_FUNDTYPE_SUCCESS'=>'贷款方式编辑成功',
	'EDIT_FUNDTYPE_FAILURE'=>'贷款方式编辑失败',
	
	//银行种类
        'ADD_BANK_SUCCESS'=>'银行种类添加成功',
	'ADD_BANK_FAILURE'=>'银行种类添加失败',
	'DELTE_BANK_SUCCESS'=>'银行种类删除成功',
	'DELTE_BANK_FAILURE'=>'银行种类删除失败',
	'EDIT_BANK_SUCCESS'=>'银行种类编辑成功',
	'EDIT_BANK_FAILURE'=>'银行种类编辑失败',
	
	//贷款金额分类
        'ADD_INVESTAMOUNT_SUCCESS'=>'贷款金额分类添加成功',
	'ADD_INVESTAMOUNT_FAILURE'=>'贷款金额分类添加失败',
	'DELTE_INVESTAMOUNT_SUCCESS'=>'贷款金额分类删除成功',
	'DELTE_INVESTAMOUNT_FAILURE'=>'贷款金额分类删除失败',
	'EDIT_INVESTAMOUNT_SUCCESS'=>'贷款金额分类编辑成功',
	'EDIT_INVESTAMOUNT_FAILURE'=>'贷款金额分类编辑失败',
	
	//还款方式
        'ADD_REIMBURSEMENTWAY_SUCCESS'=>'还款方式添加成功',
	'ADD_REIMBURSEMENTWAY_FAILURE'=>'还款方式添加失败',
	'DELTE_REIMBURSEMENTWAY_SUCCESS'=>'还款方式删除成功',
	'DELTE_REIMBURSEMENTWAY_FAILURE'=>'还款方式删除失败',
	'EDIT_REIMBURSEMENTWAY_SUCCESS'=>'还款方式编辑成功',
	'EDIT_REIMBURSEMENTWAY_FAILURE'=>'还款方式编辑失败',
	
	//还款时间
        'ADD_REIMBURSEMENTTIME_SUCCESS'=>'还款时间添加成功',
	'ADD_REIMBURSEMENTTIME_FAILURE'=>'还款时间添加失败',
	'DELTE_REIMBURSEMENTTIME_SUCCESS'=>'还款时间删除成功',
	'DELTE_REIMBURSEMENTTIME_FAILURE'=>'还款时间删除失败',
	'EDIT_REIMBURSEMENTTIME_SUCCESS'=>'还款时间编辑成功',
	'EDIT_REIMBURSEMENTTIME_FAILURE'=>'还款时间编辑失败',
	
	//资金来源
        'ADD_FUNDSOURCE_SUCCESS'=>'资金来源添加成功',
	'ADD_FUNDSOURCE_FAILURE'=>'资金来源添加失败',
	'DELTE_FUNDSOURCE_SUCCESS'=>'资金来源删除成功',
	'DELTE_FUNDSOURCE_FAILURE'=>'资金来源删除失败',
	'EDIT_FUNDSOURCE_SUCCESS'=>'资金来源编辑成功',
	'EDIT_FUNDSOURCE_FAILURE'=>'资金来源编辑失败',
	
	//垫资类型
        'ADD_LOANTYPE_SUCCESS'=>'垫资类型添加成功',
	'ADD_LOANTYPE_FAILURE'=>'垫资类型添加失败',
	'DELTE_LOANTYPE_SUCCESS'=>'垫资类型删除成功',
	'DELTE_LOANTYPE_FAILURE'=>'垫资类型删除失败',
	'EDIT_LOANTYPE_SUCCESS'=>'垫资类型编辑成功',
	'EDIT_LOANTYPE_FAILURE'=>'垫资类型编辑失败',
	
	//利息标准
        'ADD_INTERESTSTANDARD_SUCCESS'=>'利息标准添加成功',
	'ADD_INTERESTSTANDARD_FAILURE'=>'利息标准添加失败',
	'DELTE_INTERESTSTANDARD_SUCCESS'=>'利息标准删除成功',
	'DELTE_INTERESTSTANDARD_FAILURE'=>'利息标准删除失败',
	'EDIT_INTERESTSTANDARD_SUCCESS'=>'利息标准编辑成功',
	'EDIT_INTERESTSTANDARD_FAILURE'=>'利息标准编辑失败',
	
	//垫资（融资）周期
        'ADD_CYCLE_SUCCESS'=>'垫资（融资）周期添加成功',
	'ADD_CYCLE_FAILURE'=>'垫资（融资）周期添加失败',
	'DELTE_CYCLE_SUCCESS'=>'垫资（融资）周期删除成功',
	'DELTE_CYCLE_FAILURE'=>'垫资（融资）周期删除失败',
	'EDIT_CYCLE_SUCCESS'=>'垫资（融资）周期编辑成功',
	'EDIT_CYCLE_FAILURE'=>'垫资（融资）周期编辑失败',
	
	//职位类别
        'ADD_JOBCATEGORY_SUCCESS'=>'职位类别添加成功',
	'ADD_JOBCATEGORY_FAILURE'=>'职位类别添加失败',
	'DELTE_JOBCATEGORY_SUCCESS'=>'职位类别删除成功',
	'DELTE_JOBCATEGORY_FAILURE'=>'职位类别删除失败',
	'EDIT_JOBCATEGORY_SUCCESS'=>'职位类别编辑成功',
	'EDIT_JOBCATEGORY_FAILURE'=>'职位类别编辑失败',
	
	//薪资标准
        'ADD_SALARYSTANDARD_SUCCESS'=>'薪资标准添加成功',
	'ADD_SALARYSTANDARD_FAILURE'=>'薪资标准添加失败',
	'DELTE_SALARYSTANDARD_SUCCESS'=>'薪资标准删除成功',
	'DELTE_SALARYSTANDARD_FAILURE'=>'薪资标准删除失败',
	'EDIT_SALARYSTANDARD_SUCCESS'=>'薪资标准编辑成功',
	'EDIT_SALARYSTANDARD_FAILURE'=>'薪资标准编辑失败',
	
	 //学历管理
        'ADD_EDUCATION_SUCCESS'=>'学历添加成功',
	'ADD_EDUCATION_FAILURE'=>'学历添加失败',
	'DELTE_EDUCATION_SUCCESS'=>'学历删除成功',
	'DELTE_EDUCATION_FAILURE'=>'学历删除失败',
	'EDIT_EDUCATION_SUCCESS'=>'学历编辑成功',
	'EDIT_EDUCATION_FAILURE'=>'学历编辑失败',
	
	//年龄管理
        'ADD_AGE_SUCCESS'=>'年龄添加成功',
	'ADD_AGE_FAILURE'=>'年龄添加失败',
	'DELTE_AGE_SUCCESS'=>'年龄删除成功',
	'DELTE_AGE_FAILURE'=>'年龄删除失败',
	'EDIT_AGE_SUCCESS'=>'年龄编辑成功',
	'EDIT_AGE_FAILURE'=>'年龄编辑失败',
	
	//工作经验
        'ADD_WORKEXPERIENCE_SUCCESS'=>'工作经验添加成功',
	'ADD_WORKEXPERIENCE_FAILURE'=>'工作经验添加失败',
	'DELTE_WORKEXPERIENCE_SUCCESS'=>'工作经验删除成功',
	'DELTE_WORKEXPERIENCE_FAILURE'=>'工作经验删除失败',
	'EDIT_WORKEXPERIENCE_SUCCESS'=>'工作经验编辑成功',
	'EDIT_WORKEXPERIENCE_FAILURE'=>'工作经验编辑失败',
	
	//公司类型
        'ADD_COMPANYTYPE_SUCCESS'=>'公司类型添加成功',
	'ADD_COMPANYTYPE_FAILURE'=>'公司类型添加失败',
	'DELTE_COMPANYTYPE_SUCCESS'=>'公司类型删除成功',
	'DELTE_COMPANYTYPE_FAILURE'=>'公司类型删除失败',
	'EDIT_COMPANYTYPE_SUCCESS'=>'公司类型编辑成功',
	'EDIT_COMPANYTYPE_FAILURE'=>'公司类型编辑失败',
	
	//年化收益
        'ADD_ANNUALYIELD_SUCCESS'=>'年化收益添加成功',
	'ADD_ANNUALYIELD_FAILURE'=>'年化收益添加失败',
	'DELTE_ANNUALYIELD_SUCCESS'=>'年化收益删除成功',
	'DELTE_ANNUALYIELD_FAILURE'=>'年化收益删除失败',
	'EDIT_ANNUALYIELD_SUCCESS'=>'年化收益编辑成功',
	'EDIT_ANNUALYIELD_FAILURE'=>'年化收益编辑失败',
	
	//项目类型
        'ADD_PROJECTTYPE_SUCCESS'=>'项目类型添加成功',
	'ADD_PROJECTTYPE_FAILURE'=>'项目类型添加失败',
	'DELTE_PROJECTTYPE_SUCCESS'=>'项目类型删除成功',
	'DELTE_PROJECTTYPE_FAILURE'=>'项目类型删除失败',
	'EDIT_PROJECTTYPE_SUCCESS'=>'项目类型编辑成功',
	'EDIT_PROJECTTYPE_FAILURE'=>'项目类型编辑失败',
         
       //POS机配置
	'ADD_POS_SUCCESS'=>'POS机配置添加成功',
	'ADD_POS_FAILURE'=>'POS机配置添加失败',
	'DELTE_POS_SUCCESS'=>'POS机配置删除成功',
	'DELTE_POS_FAILURE'=>'POS机配置删除失败',
	'EDIT_POS_SUCCESS'=>'POS机配置编辑成功',
	'EDIT_POS_FAILURE'=>'POS机配置编辑失败',
    
       //费率标准
	'ADD_RATESTANDARD_SUCCESS'=>'费率标准添加成功',
	'ADD_RATESTANDARD_FAILURE'=>'费率标准添加失败',
	'DELTE_RATESTANDARD_SUCCESS'=>'费率标准删除成功',
	'DELTE_RATESTANDARD_FAILURE'=>'费率标准删除失败',
	'EDIT_RATESTANDARD_SUCCESS'=>'费率标准编辑成功',
	'EDIT_RATESTANDARD_FAILURE'=>'费率标准编辑失败',
    
       //封顶收费
	'ADD_CAPCHARGE_SUCCESS'=>'封顶收费添加成功',
	'ADD_CAPCHARGE_FAILURE'=>'封顶收费添加失败',
	'DELTE_CAPCHARGE_SUCCESS'=>'封顶收费删除成功',
	'DELTE_CAPCHARGE_FAILURE'=>'封顶收费删除失败',
	'EDIT_CAPCHARGE_SUCCESS'=>'封顶收费编辑成功',
	'EDIT_CAPCHARGE_FAILURE'=>'封顶收费编辑失败',
       
       //机器类型
	'ADD_MACHINETYPE_SUCCESS'=>'机器类型添加成功',
	'ADD_MACHINETYPE_FAILURE'=>'机器类型添加失败',
	'DELTE_MACHINETYPE_SUCCESS'=>'机器类型删除成功',
	'DELTE_MACHINETYPE_FAILURE'=>'机器类型删除失败',
	'EDIT_MACHINETYPE_SUCCESS'=>'机器类型编辑成功',
	'EDIT_MACHINETYPE_FAILURE'=>'机器类型编辑失败',
    
       //信用
	'ADD_CREDITCARD_SUCCESS'=>'信用卡配置添加成功',
	'ADD_CREDITCARD_FAILURE'=>'信用卡配置添加失败',
	'DELTE_CREDITCARD_SUCCESS'=>'信用卡配置删除成功',
	'DELTE_CREDITCARD_FAILURE'=>'信用卡配置删除失败',
	'EDIT_CREDITCARD_SUCCESS'=>'信用卡配置编辑成功',
	'EDIT_CREDITCARD_FAILURE'=>'信用卡配置编辑失败',
       
       //发卡主题
	'ADD_CardTheme_SUCCESS'=>'发卡主题添加成功',
	'ADD_CardTheme_FAILURE'=>'发卡主题添加失败',
	'DELTE_CardTheme_SUCCESS'=>'发卡主题删除成功',
	'DELTE_CardTheme_FAILURE'=>'发卡主题删除失败',
	'EDIT_CardTheme_SUCCESS'=>'发卡主题编辑成功',
	'EDIT_CardTheme_FAILURE'=>'发卡主题编辑失败',
        
       //发卡组织
	'ADD_ISSUEORGANIZATION_SUCCESS'=>'发卡组织添加成功',
	'ADD_ISSUEORGANIZATION_FAILURE'=>'发卡组织添加失败',
	'DELTE_ISSUEORGANIZATION_SUCCESS'=>'发卡组织删除成功',
	'DELTE_ISSUEORGANIZATION_FAILURE'=>'发卡组织删除失败',
	'EDIT_ISSUEORGANIZATION_SUCCESS'=>'发卡组织编辑成功',
	'EDIT_ISSUEORGANIZATION_FAILURE'=>'发卡组织编辑失败',
    
       //卡片等级
	'ADD_CARDLEVEL_SUCCESS'=>'卡片等级添加成功',
	'ADD_CARDLEVEL_FAILURE'=>'卡片等级添加失败',
	'DELTE_CARDLEVEL_SUCCESS'=>'卡片等级删除成功',
	'DELTE_CARDLEVEL_FAILURE'=>'卡片等级删除失败',
	'EDIT_CARDLEVEL_SUCCESS'=>'卡片等级编辑成功',
	'EDIT_CARDLEVEL_FAILURE'=>'卡片等级编辑失败',
       
       //卡片特权
	'ADD_CARDPRIVILEGE_SUCCESS'=>'卡片特权添加成功',
	'ADD_CARDPRIVILEGE_FAILURE'=>'卡片特权添加失败',
	'DELTE_CARDPRIVILEGE_SUCCESS'=>'卡片特权删除成功',
	'DELTE_CARDPRIVILEGE_FAILURE'=>'卡片特权删除失败',
	'EDIT_CARDPRIVILEGE_SUCCESS'=>'卡片特权编辑成功',
	'EDIT_CARDPRIVILEGE_FAILURE'=>'卡片特权编辑失败',
    
        //贷款产品
	'ADD_LOANPRODUCT_SUCCESS'=>'贷款产品添加成功',
	'ADD_LOANPRODUCT_FAILURE'=>'贷款产品添加失败',
	'DELTE_LOANPRODUCT_SUCCESS'=>'贷款产品删除成功',
	'DELTE_LOANPRODUCT_FAILURE'=>'贷款产品删除失败',
	'EDIT_LOANPRODUCT_SUCCESS'=>'贷款产品编辑成功',
	'EDIT_LOANPRODUCT_FAILURE'=>'贷款产品编辑失败',
    
        //拍品行
	'ADD_AUCTION_SUCCESS'=>'拍卖行添加成功',
	'ADD_AAUCTION_FAILURE'=>'拍卖行添加失败',
	'DELTE_AUCTION_SUCCESS'=>'拍卖行删除成功',
	'DELTE_AUCTION_FAILURE'=>'拍卖行删除失败',
	'EDIT_AUCTION_SUCCESS'=>'拍卖行编辑成功',
	'EDIT_AUCTION_FAILURE'=>'拍卖行编辑失败',
    
        //拍品类型
	'ADD_AUCTIONTYPE_SUCCESS'=>'拍品类型添加成功',
	'ADD_AUCTIONTYPE_FAILURE'=>'拍品类型添加失败',
	'DELTE_AUCTIONTYPE_SUCCESS'=>'拍品类型删除成功',
	'DELTE_AUCTIONTYPE_FAILURE'=>'拍品类型删除失败',
	'EDIT_AUCTIONTYPE_SUCCESS'=>'拍品类型编辑成功',
	'EDIT_AUCTIONTYPE_FAILURE'=>'拍品类型编辑失败',
         
        //拍品金额
	'ADD_AUCTIONAMOUNT_SUCCESS'=>'拍品金额添加成功',
	'ADD_AUCTIONAMOUNT_FAILURE'=>'拍品金额添加失败',
	'DELTE_AUCTIONAMOUNT_SUCCESS'=>'拍品金额删除成功',
	'DELTE_AUCTIONAMOUNT_FAILURE'=>'拍品金额删除失败',
	'EDIT_AUCTIONAMOUNT_SUCCESS'=>'拍品金额编辑成功',
	'EDIT_AUCTIONAMOUNT_FAILURE'=>'拍品金额编辑失败',
    
        //过桥垫资
	'ADD_BRIDGELOAN_SUCCESS'=>'过桥垫资添加成功',
	'ADD_BRIDGELOAN_FAILURE'=>'过桥垫资添加失败',
	'DELTE_BRIDGELOAN_SUCCESS'=>'过桥垫资删除成功',
	'DELTE_BRIDGELOAN_FAILURE'=>'过桥垫资删除失败',
	'EDIT_BRIDGELOAN_SUCCESS'=>'过桥垫资编辑成功',
	'EDIT_BRIDGELOAN_FAILURE'=>'过桥垫资编辑失败',
        
        //精英求职
	'ADD_JOB_SUCCESS'=>'精英求职添加成功',
	'ADD_JOB_FAILURE'=>'精英求职添加失败',
	'DELTE_JOB_SUCCESS'=>'精英求职删除成功',
	'DELTE_JOB_FAILURE'=>'精英求职删除失败',
	'EDIT_JOB_SUCCESS'=>'精英求职编辑成功',
	'EDIT_JOB_FAILURE'=>'精英求职编辑失败',
    
        //企业招聘
	'ADD_COMPANY_SUCCESS'=>'企业招聘添加成功',
	'ADD_COMPANY_FAILURE'=>'企业招聘添加失败',
	'DELTE_COMPANY_SUCCESS'=>'企业招聘删除成功',
	'DELTE_COMPANY_FAILURE'=>'企业招聘删除失败',
	'EDIT_COMPANY_SUCCESS'=>'企业招聘编辑成功',
	'EDIT_COMPANY_FAILURE'=>'企业招聘编辑失败',
        
        //融资管理
	'ADD_FUNDING_SUCCESS'=>'融资管理添加成功',
	'ADD_FUNDING_FAILURE'=>'融资管理添加失败',
	'DELTE_FUNDING_SUCCESS'=>'融资管理删除成功',
	'DELTE_FUNDING_FAILURE'=>'融资管理删除失败',
	'EDIT_FUNDING_SUCCESS'=>'融资管理编辑成功',
	'EDIT_FUNDING_FAILURE'=>'融资管理编辑失败',
	
        //企业名录
	'ADD_BUSINESS_SUCCESS'=>'企业名录添加成功',
	'ADD_BUSINESS_FAILURE'=>'企业名录添加失败',
	'DELTE_BUSINESS_SUCCESS'=>'企业名录删除成功',
	'DELTE_BUSINESS_FAILURE'=>'企业名录删除失败',
	'EDIT_BUSINESS_SUCCESS'=>'企业名录编辑成功',
	'EDIT_BUSINESS_FAILURE'=>'企业名录编辑失败',
		
        //企业店铺
	'ADD_SHOP_SUCCESS'=>'企业店铺添加成功',
	'ADD_SHOP_FAILURE'=>'企业店铺添加失败',
	'DELTE_SHOP_SUCCESS'=>'企业店铺删除成功',
	'DELTE_SHOP_FAILURE'=>'企业店铺删除失败',
	'EDIT_SHOP_SUCCESS'=>'企业店铺编辑成功',
	'EDIT_SHOP_FAILURE'=>'企业店铺编辑失败',
        
        //缓存清理
	'DELETEINDEXCACHE_SUCCESS'=>'前台缓存清理成功',
	'DELETEINDEXCACHE_FAILURE'=>'前台缓存清理失败',
        'DELETEADMINCACHE_SUCCESS'=>'后台缓存清理成功',
	'DELETEADMINCACHE_FAILURE'=>'后台缓存清理失败',
    
        //数据备份和导入
        'DATABACKUP_SUCCESS'=>'数据备份成功',
        'DATABACKUP_FAILURE'=>'数据备份失败',
        'DATAIMPORT_SUCCESS'=>'数据导入成功',
        'DATAIMPORT_FAILURE'=>'数据导入失败，备份文件不存在',
       
       //贷款申请分组
        'ADD_APPLYLLOANSGROUP_SUCCESS'=>'贷款申请分组添加成功',
	'ADD_APPLYLLOANSGROUP_FAILURE'=>'贷款申请添加失败',
	'DELTE_APPLYLLOANSGROUP_SUCCESS'=>'贷款申请分组删除成功',
	'DELTE_APPLYLLOANSGROUP_FAILURE'=>'贷款申请分组删除失败',
	'EDIT_APPLYLLOANSGROUP_SUCCESS'=>'贷款申请分组编辑成功',
	'EDIT_APPLYLLOANSGROUP_FAILURE'=>'贷款申请分组编辑失败',
    
      //贷款申请
        'ADD_APPLYLLOANS_SUCCESS'=>'贷款申请添加成功',
	'ADD_APPLYLLOANS_FAILURE'=>'贷款申请添加失败',
	'DELTE_APPLYLLOANS_SUCCESS'=>'贷款申请删除成功',
	'DELTE_APPLYLLOANS_FAILURE'=>'贷款申请删除失败',
	'EDIT_APPLYLLOANS_SUCCESS'=>'贷款申请编辑成功',
	'EDIT_APPLYLLOANS_FAILURE'=>'贷款申请编辑失败',

	//产品管理
	'ADD_PRODUCT_SUCCESS'=>'产品添加成功',
	'ADD_PRODUCT_FAILURE'=>'产品添加失败',
	'DELTE_PRODUCT_SUCCESS'=>'产品删除成功',
	'DELTE_PRODUCT_FAILURE'=>'产品删除失败',
	'EDIT_PRODUCT_SUCCESS'=>'产品编辑成功',
	'EDIT_PRODUCT_FAILURE'=>'产品编辑失败',

	//产品分组
	'ADD_PRODUCTGROUP_SUCCESS'=>'产品分类添加成功',
	'ADD_PRODUCTGROUP_FAILURE'=>'产品分类添加失败',
	'DELTE_PRODUCTGROUP_SUCCESS'=>'产品分类删除成功',
	'DELTE_PRODUCTGROUP_FAILURE'=>'产品分类删除失败',
	'EDIT_PRODUCTGROUP_SUCCESS'=>'产品分类编辑成功',
	'EDIT_PRODUCTGROUP_FAILURE'=>'产品分类编辑失败',

	//人才管理
	'DELTE_HRORDER_SUCCESS'=>'删除成功',
	'DELTE_HRORDER_FAILURE'=>'删除失败',

//招聘管理
	'ADD_HR_SUCCESS'=>'招聘添加成功',
	'ADD_HR_FAILURE'=>'招聘添加失败',
	'DELTE_HR_SUCCESS'=>'招聘删除成功',
	'DELTE_HR_FAILURE'=>'招聘删除失败',
	'EDIT_HR_SUCCESS'=>'招聘编辑成功',
	'EDIT_HR_FAILURE'=>'招聘编辑失败',

	//招聘分类
	'ADD_HRGROUP_SUCCESS'=>'招聘分类添加成功',
	'ADD_HRGROUP_FAILURE'=>'招聘分类添加失败',
	'DELTE_HRGROUP_SUCCESS'=>'招聘分类删除成功',
	'DELTE_HRGROUP_FAILURE'=>'招聘分类删除失败',
	'EDIT_HRGROUP_SUCCESS'=>'招聘分类编辑成功',
	'EDIT_HRGROUP_FAILURE'=>'招聘分类编辑失败',

	//留言管理
	'DELTE_MESSAGE_SUCCESS'=>'留言删除成功',
	'DELTE_MESSAGE_FAILURE'=>'留言删除失败',
	'EDIT_MESSAGE_SUCCESS'=>'留言回复成功',
	'EDIT_MESSAGE_FAILURE'=>'留言回复失败',


	//导航
	'ADD_NAVGROUP_SUCCESS'=>'导航添加成功',
	'ADD_NAVGROUP_FAILURE'=>'导航添加失败',
	'DELTE_NAVGROUP_SUCCESS'=>'导航删除成功',
	'DELTE_NAVGROUP_FAILURE'=>'导航删除失败',
	'EDIT_NAVGROUP_SUCCESS'=>'导航编辑成功',
	'EDIT_NAVGROUP_FAILURE'=>'导航编辑失败',

	//参数选项
	'ADD_LISTS_SUCCESS'=>'元素添加成功',
	'ADD_LISTS_FAILURE'=>'元素添加失败',
	'DELTE_LISTS_SUCCESS'=>'元素删除成功',
	'DELTE_LISTS_FAILURE'=>'元素删除失败',
	'EDIT_LISTS_SUCCESS'=>'元素编辑成功',
	'EDIT_LISTS_FAILURE'=>'元素编辑失败',
	//参数配置
	'ADD_PARAM_SUCCESS'=>'参数添加成功',
	'ADD_PARAM_FAILURE'=>'参数添加失败',
	'DELTE_PARAM_SUCCESS'=>'参数删除成功',
	'DELTE_PARAM_FAILURE'=>'参数删除失败',
	'EDIT_PARAM_SUCCESS'=>'参数编辑成功',
	'EDIT_PARAM_FAILURE'=>'参数编辑失败',
	//添加选项
	'ADD_ADDLISTS_SUCCESS'=>'参数编辑成功',
	'ADD_ADDLISTS_FAILURE'=>'参数编辑失败',

	//参数配置
	'ADD_SINGLEPAGE_SUCCESS'=>'单页添加成功',
	'ADD_SINGLEPAGE_FAILURE'=>'单页添加失败',
	'DELTE_SINGLEPAGE_SUCCESS'=>'单页删除成功',
	'DELTE_SINGLEPAGE_FAILURE'=>'单页删除失败',
	'EDIT_SINGLEPAGE_SUCCESS'=>'单页编辑成功',
	'EDIT_SINGLEPAGE_FAILURE'=>'单页编辑失败',




);

?>
