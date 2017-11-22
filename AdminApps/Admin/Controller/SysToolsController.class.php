<?php

/**
 * Functions: 系统工具.
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class SysToolsController extends SuperController {

    /**
     * 显示查看日志列表
     */
    public function listSysLogs() {

        //实例化SysLog模型
        $sysLogModel = D('SysLog');
        //实例化Admin模型
        $adminModel = D('Admin');

        //查询管理员表所有的数据
        $admins = $adminModel->selectAllAdmins();

        //获取日志总数
        $count = $sysLogModel->countSysLog();
        $this->assign('count', $count);

        //获取页码
        $page = new \Org\Page\Page($count, $this->adminPageSize);
        $show = $page->show();
        $this->assign('pagelist', $show);

        //获取每页日志数
        $sysLog = $sysLogModel->selectSysLogsByPage($page);
        $this->assign('syslog', $sysLog);

        //赋值到模版
        $this->assign('showadmins', $admins);
        $this->display('SysTools/listsyslogs');
    }

    /**
     * 清空日志
     */
    public function deleteSysLogs() {

        //实例化系统日志模型
        $sysLogModel = D('SysLog');
        $sysLog = $sysLogModel->selectAllSysLogs();

        if (empty($sysLog)) {
            $this->error('日志已清除');
        } else {
            $model = new \Think\Model();
            $sql = "TRUNCATE yefan_sys_log";
            $model->execute($sql);
            $this->success('日志清除成功', U('SysTools/listsyslogs'));
        }
    }

    /**
     * 支付方式
     */
    public function editPayWay() {
        if (IS_POST) {
            $payId = I('payid');
            $payAccounts = I('payaccounts');
            $payBusinumber = I('paybusinumber');
            $paySecretkey = I('paysecretkey');

            //封装数据
            $data['pay_accounts'] = $payAccounts;
            $data['pay_businumber'] = $payBusinumber;
            $data['pay_secretkey'] = $paySecretkey;

            //实列化PayWay
            $paywayModel = D('PayWay');
            if(empty($payId)){
                $result = $paywayModel->addPayWay($data);
            }else{
                $result = $paywayModel->savePayWay($payId, $data);
            }            
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "支付方式编辑成功。" . "支付帐号：" . $payAccounts;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('EDIT_PAYWAP_SUCCESS'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "支付方式编辑失败。" . "支付帐号：" . $payAccounts;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->error(L('EDIT_PAYWAP_FAILURE'));
            }
        } else {

            $paywayModel = D('PayWay');
            $payWay = $paywayModel->selectPayWay();
            $this->assign('payway', $payWay);      
            $this->display('SysTools/editPayWay');
        }
    }

    /**
     * 缓存清理
     */
    public function deleteCache() {

        //从页面获取操作
        $act = I('act');
        if (!empty($act)) {
            //前台缓存清理
            if ($act == 'index') {
                $indexResult = deldir(C('INDEX_RUNTIME_PATH'));
                if ($indexResult) {
                    $this->success(L('DELETEINDEXCACHE_SUCCESS'), U('SysTools/deleteCache'));
                } else {
                    $this->error(L('DELETEINDEXCACHE_FAILURE'));
                }
            }

            //后台缓存清理
            if ($act == 'admin') {
                $dir = C('ADMIN_RUNTIME_PATH');

                if (deldir($dir)) {
                    $this->success(L('DELETEADMINCACHE_SUCCESS'), U('SysTools/deleteCache'));
                } else {
                    $this->error(L('DELETEADMINCACHE_FAILURE'));
                }
            }
        } else {
            $this->display('SysTools/deletecache');
        }
    }

    /**
     * 数据备份
     */
    public function dataBackUp() {

        //从页面获取操作
        $act = I('act');

        if (!empty($act)) {
            //数据备份
            if ($act == 'backup') {
                $mysql = MySqlBackup();
                if ($mysql) {
                    $this->success(L('DATABACKUP_SUCCESS'), U('SysTools/dataBackUp'));
                } else {
                    $this->error(L('DATABACKUP_FAILURE'));
                }
            }

            //数据导入
            if ($act == 'import') {
                if (MySqlUpload()) {
                    $this->success(L('DATAIMPORT_SUCCESS'), U('SysTools/dataBackUp'));
                } else {
                    $this->error(L('DATAIMPORT_FAILURE'));
                }
            }
        } else {
            $this->display('SysTools/databackup');
        }
    }




}
