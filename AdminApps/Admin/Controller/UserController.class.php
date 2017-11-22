<?php

/**
 * Functions: 用户控制器
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class UserController extends SuperController {

    public function listUserGroups() {
        //实例化UserGroup模型
        $userGroupModel = D('UserGroup');
        //获取总的用户数
        $count = $userGroupModel->selectUserGroupTotalSize();
        //实例化分页类
        $page = new \Org\Page\Page($count, $this->adminPageSize);
        //获取每页显示的数据集
        $userGroups = $userGroupModel->selectUserGroupByPage($page);
        //分页显示输出
        $show = $page->show();
        //管理员操作记录到日志表中
        $logcontent = C('SYS_LOG_ACTION_SELECT') . "会员分组查询成功。";
        sys_log(session('adminId'), session('adminName'), $logcontent);

        //赋值到模版 
        $this->assign('usergroups', $userGroups);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display('User/listUserGroups');
    }

    /**
     * 添加会员分组的方法
     */
    public function addUserGroup() {

        if (IS_POST) {

            //接收POST传递过来的参数
            $groupName = I('groupname');
            $minScore = I('minscore');
            $maxScore = I('maxscore');

            //调用上传方法
            $file = $_FILES['grouplogo'];
            $info = upload_img($file);
            //获取上传路径
            $groupLogo = $info['savepath'] . $info['savename'];

            //实列化UserGroup模型
            $userGroupModel = D('UserGroup');

            //添加用户分组数据
            $data['group_name'] = $groupName;
            $data['group_logo'] = $groupLogo;
            $data['min_score'] = $minScore;
            $data['max_score'] = $maxScore;
            $result = $userGroupModel->addUserGroup($data);

            //返回添加结果
            if ($result) {
                //管理员操作记录到日志表中   
                $logcontent = C('SYS_LOG_ACTION_ADD') . "会员分组添加成功。" . "分组名：" . $groupName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('ADD_USERGROUP_SUCCESS'), U('User/listusergroups'));
            } else {

                //管理员操作记录到日志表中             
                $logcontent = C('SYS_LOG_ACTION_SELECT') . "会员分组添加失败。" . "分组名：" . $groupName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->error(L('ADD_USERGROUP_FAILURE'));
            }
        } else {
            //显示添加会员分组界面
            $this->display('User/addusergroup');
        }
    }

    /**
     * 编辑用户分组
     */
    public function editUserGroup() {
        if (IS_POST) {
            //接受POST传递过来的值
            $groupId = I('groupid');
            $groupName = I('groupname');

            //调用上传图片的方法
            $file = $_FILES['grouplogo'];
            $info = upload_img($file);

            //获取上传路径
            if ($info) {
                $groupLogo = $info['savepath'] . $info['savename'];
            } else {
                $groupLogo = $_FILES['grouplogo'];
            }
            $maxScore = I('maxscore');
            $minScore = I('minscore');

            //实列化user_group模型
            $userGroupModel = D('UserGroup');

            $data['group_name'] = $groupName;
            $data['group_logo'] = $groupLogo;
            $data['max_score'] = $maxScore;
            $data['min_score'] = $minScore;
            //编辑用户分组
            $result = $userGroupModel->saveUserGroup($groupId, $data);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "会员分组编辑成功。" . "分组名：" . $groupName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('EDIT_USERGROUP_SUCCESS'), U('User/listusergroups'));
            } else {
                //管理员操作记录到日志表中             
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "会员分组编辑失败。" . "分组名：" . $groupName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->error(L('EDIT_USERGROUP_FAILURE'));
            }
        } else {
            //显示编辑用户分组界面
            //接受GET传递过来的参数
            $groupId = I('groupid');

            //实列化UserGroup模型
            $userGroupModel = D('UserGroup');

            //查询用户分组表user_group中group_id为$groupId的一条数据
            $userGroup = $userGroupModel->selectUserGroupById($groupId);

            //赋值到模版
            $this->assign('usergroup', $userGroup);
            $this->display('User/editusergroup');
        }
    }

    /**
     * 删除用户分组    
     */
    public function deleteUserGroup() {

        if (IS_GET) {
            //接受GET传递过来的参数
            $groupId = I('groupid');

            //实列化UserGroup模型
            $userGroupModel = D('UserGroup');
            //实列化User模型
            $userModel = D('User');

            //查询用户分组表user_group中group_id为$id的一条数据
            $groupName = $userGroupModel->selectUserGroupById($groupId);
            //查找用户usesr_group表中group_id为$groupId所有数据
            $group = $userModel->selectUsersByGroupId($groupId);
            //返回查询结果
            if ($group) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE') . "会员分组删除失败。原因：分类下有子类。" . "分组名：" . $groupName['group_name'];
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->error(L('EXIST_SUBCLASS'));
            } else {
                //删除用户分组表user_group中group_id为$groupId的一条数据
                $result = $userGroupModel->deleteUserGroupById($groupId);
                //返回删除会员份的结果
                if ($result) {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_DELETE') . "会员分组删除成功。" . "分组名：" . $groupName['group_name'];
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->success(L('DELTE_USERGROUP_SUCCESS'));
                } else {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_DELETE') . "会员分组删除失败。" . "分组名：" . $groupName['group_name'];
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->error(L('DELTE_USERGROUP_FAILURE'));
                }
            }
        }
    }

    /**
     * 显示会员管理界面 
     */
    public function listUsers() {
        //实例化User模型
        $userModel = D('User');

        //实列化UserGroup模型
        $userGroupModel = D('UserGroup');

        //查询会员表user中所有的数据
        $users = $userModel->selectAllUsers();

        //查询用户分组表user_grouo中所有的数据
        $userGroup = $userGroupModel->selectAllUserGroups();

        //获取总的用户数
        $count = $userModel->selectUserTotalSize();
        $this->assign('count', $count);

        //实例化分页类
        $page = new \Org\Page\Page($count, $this->adminPageSize);

        //获取每页显示的数据集
        $list = $userModel->selectUsersByPage($page);
        $this->assign('list', $list);

        //分页显示输出
        $show = $page->show();
        $this->assign('page', $show);

        //赋值到模版
        $this->assign('usergroup', $userGroup);
        $this->assign('users', $users);

        //管理员操作记录到日志表中
        $logcontent = C('SYS_LOG_ACTION_SELECT') . "会员管理查询成功";
        sys_log(session('adminId'), session('adminName'), $logcontent);

        $this->display('User/listusers');
    }

    /**
     * 添加会员信息的方法
     */
    public function addUser() {
        if (IS_POST) {
            //接受POST传递过来的参数
            $userName = I('username');
            $userMobile = I('usermobile');
            $userEmail = I('useremail');
            $isBusiness = I('is_business');
            $groupId = I('groupid');
            $userMoney = I('usermoney');
            $userScore = I('userscore');
            $userStatus = I('userstatus');
            $passWord = I('password');
            $userPass = I('userpass');
            $userWexin = I('userweixin');
            $userQq = I('userqq');

            if ($passWord != $userPass) {
                $this->error('两次输入的密码不一致');
            }

            //接受到的值不能为空
            if (empty($groupId)) {
                $this->error('会员分组不能为空');
            }

            //实例化User模型
            $userModel = D('User');

            //查找用户表User中的user_name为$username的所有数据
            $user = $userModel->selectUserByName($userName);


            if ($user) {
                $this->error('用户名已存在');
            }
            //会员信息存入到数据库中
            $data['user_name'] = $userName;
            $data['user_mobile'] = $userMobile;
            $data['user_email'] = $userEmail;
            $data['is_business'] = $isBusiness;
            $data['group_id'] = $groupId;
            $data['user_money'] = $userMoney;
            $data['user_score'] = $userScore;
            $data['user_status'] = $userStatus;
            $data['user_pass'] = user_md5($userPass);
            $data['reg_time'] = time();
            $data['user_weixin'] = $userWexin;
            $data['user_qq'] = $userQq;

            $result = $userModel->addUser($data);
            //返回添加会员的方法
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD') . "会员添加成功。" . "用户名：" . $userName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('ADD_USER_SUCCESS'), U('User/listusers'));
            } else {

                //管理员操作记录到日志表中

                $logcontent = C('SYS_LOG_ACTION_ADD') . "会员添加失败。" . "用户名：" . $userName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->error(L('ADD_USER_FAILURE'));
            }
        } else {
            //显示添加会员界面    
            //实例化UserGroup模型
            $userGroupModel = D('UserGroup');

            //查询用户分组表user_group中所有的数据
            $userGroup = $userGroupModel->selectAllUserGroups();

            //赋值到模版
            $this->assign('usergroup', $userGroup);
            $this->display('User/adduser');
        }
    }

    /**
     * 编辑用户信息
     */
    public function editUser() {
        if (IS_POST) {
            //接受POST传递过来的值
            $userId = I('userid');
            $userName = I('username');
            $userMobile = I('usermobile');
            $userEmail = I('useremail');
            $isBusiness = I('is_business');
            $groupId = I('groupid');
            $userMoney = I('usermoney');
            $userScore = I('userscore');
            $userStatus = I('userstatus');
            $passWord = I('password');
            $userPass = I('userpass');
            $failReason = I('failreason');
            $userIdStatus = I('useridstatus');
            $userWexin = I('userweixin');
            $userQq = I('userqq');

            if ($newpassword != $userpass) {
                $this->error('两次输入的密码不一致');
            }
            //实例化User模型
            $userModel = D('User');

            $data['user_name'] = $userName;
            $data['user_mobile'] = $userMobile;
            $data['user_email'] = $userEmail;
            $data['is_business'] = $isBusiness;
            $data['group_id'] = $groupId;
            $data['user_money'] = $userMoney;
            $data['user_score'] = $userScore;
            $data['user_status'] = $userStatus;
            $data['fail_reason'] = $failReason;
            $data['user_weixin'] = $userWexin;
            $data['user_qq'] = $userQq;
            if (!empty($userPass)) {
                $data['user_pass'] = user_md5($userPass);
            }
            $data['reg_time'] = time();
            $data['user_id_status'] = $userIdStatus;

            //查找用户信息
            $userInfo = $userModel->selectUserById($userId);

            if ($userIdStatus == 1 && $userInfo['user_id_status'] == 0) {
                $data['user_order'] = $userInfo['user_order'] + 2;
            }

            //编辑用户信息
            $result = $userModel->saveUser($userId, $data);

            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "会员编辑成功。" . "用户名：" . $userName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('EDIT_USER_SUCCESS'), U('User/listusers'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "会员编辑失败。" . "用户名：" . $userName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->error(L('EDIT_USER_FAILURE'));
            }
        } else {
            //显示编辑会员界面
            //接受GET传递过来的user_id参数
            $userId = I('userid');

            //实例化User模型
            $userModel = D('User');
            //实列化UserGroup模型
            $userGroupModel = D('UserGroup');

            //查找用户表中user_id为$userId的一条数据
            $user = $userModel->selectUserById($userId);

            //查询用户分组表user_group中所有的分组
            $usergroup = $userGroupModel->selectAllUserGroups();
            $this->assign('usergroup', $usergroup);
            $this->assign('user', $user);
            $this->display();
        }
    }

    /**
     * 删除用户表user中user_id为$id的信息
     */
    public function deleteUser() {
        if (IS_GET) {
            //接受GET传递过来的参数
            $userId = I('userid');

            //实列化User模型
            $userModel = D('User');

            //查找用户表User中的user_id为$id的一条数据
            $userName = $userModel->selectUserById($userId);

            //删除用户表User中的user_id为$id的一条数据
            $result = $userModel->deleteUserById($userId);

            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE') . "会员删除成功。" . "用户名：" . $userName['user_name'];
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('DELTE_USER_SUCCESS'), U('User/listusers'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE') . "会员删除失败。" . "用户名：" . $userName['user_name'];
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->error(L('DELTE_USER_FAILURE'));
            }
        }
    }

}
