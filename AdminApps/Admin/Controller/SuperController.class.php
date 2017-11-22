<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class SuperController extends Controller
{

    /**
     * 构造函数初始化配置信息
     */
    function __construct()
    {
        //父类初始化
        parent::__construct();

        //其他配置加载
        $this->checkRbac();
        $this->getResourcePath();
        $this->getWebConfig();
        $this->getLeftMenus();
        $this->getGroupAndMenuId();
        $this->accessAuthorities();
        $this->getAdminPageSize();
        $this->adminPageSize = $this->getAdminPageSize();

        $this->getUserInfo();
        //$this->getApplyLoansGroup();
    }

    /**
     * 获取后台资源路径
     */
    protected function getResourcePath()
    {
        $this->assign('resource', C('RESOURCE_PATH'));
    }

    /**
     * 获取网站配置
     */
    protected function getWebConfig()
    {

        //实例化网站配置模型
        $menuGroupModel = D('WebConfig');

        //查询网站配置
        $webconfig = $menuGroupModel->selectWebConfig();
        $webconfig['reg_term'] = htmlspecialchars_decode($webconfig['reg_term']);
        $this->assign('webconfig', $webconfig);
    }

    /**
     * 展示左边分组
     */
    protected function getLeftMenus()
    {
        //实例化菜单分组模型
        $menugroupModel = D('MenuGroup');
        //查询菜单分组
        $menuGroup = $menugroupModel->selectAllMenuGroupByIsHidden(0);

        //实例化后台菜单分组模型
        $adminmenuModel = D('AdminMenu');
        //查询后台菜单分组    
        $adminMenu = $adminmenuModel->selectAdminMenusByIsHidden(0);

        //赋值到模版
        $this->assign('menuGroup', $menuGroup);
        $this->assign('adminMenu', $adminMenu);
    }

    /**
     * 获取页面的分组id和菜单id
     */
    protected function getGroupAndMenuId()
    {

        //从页面获取groupid和menuid
        $groupId = I('gd');
        $menuId = I('md');

        if (!empty($groupId) and !empty($menuId)) {
            //存入到session中
            session('groupid', $groupId);
            session('menuid', $menuId);
        }
    }

    /**
     * 访问权限和时间过期
     */
    protected function accessAuthorities()
    {
        if (!session('?adminName') || is_null(session('adminName')) && !session('?adminId') || is_null(session('adminId')))
            $this->error('您还没有登录系统或登录已经过期，请重新登录', U('Login/index'));
    }

    /**
     * 获取后台页面每页显示的页数
     */
    protected function getAdminPageSize()
    {
        //实例化网站配置模型
        $webConfigModel = D('WebConfig');
        $adminPage = $webConfigModel->getField('admin_page');
        return $adminPage;
    }
    /**
     * 贷款申请
     */
    
     protected function getApplyLoansGroup(){
         //实例化ApplyGroup模型
        $applyGroupModel = D('ApplyGroup');

        //查找所有的申请贷款分组信息
        $applyGroups = $applyGroupModel->selectAllApplyGroupes();
        //赋值模版
        $this->assign('applyGroups', $applyGroups); 
     }

    /**
     * 获取用户信息
     */
    protected function getUserInfo() {
        if (IS_GET) {
            //从页面获取username
            $userName = I('userinfo');

            if (!empty($userName)) {
                //实例化用户模型
                $userModel = D('User');

                //查找用户信息
                $user = $userModel->selectUsersByName($userName);
                $count = $userModel->countUserByName($userName);

                if (empty($user)) {
                    $str = "<tr><td>不存在这样的用户</td></tr>";
                    $count = "";
                } else {
                    foreach ($user as $k => $v) {
                        $str .= "<tr class='tnd' onclick=\"selectuser(" . $v['user_id'] . ")\">";
                        $str .= "<td id='userid_" . $v['user_id'] . "'>" . $v['user_id'] . "</td>";
                        $str .= "<td id='username_" . $v['user_id'] . "'>" . $v['user_name'] . "</td>";
                        $str .= "</tr>";
                    }
                    $countStr = "共" . $count . "个";
                }
                $userdata = array(
                    'status' => C('JSON_SUCCESS_CODE'),
                    'content' => $str,
                    'count' => $countStr
                );
                $this->ajaxReturn($userdata);
            }
        }
    }

    /**
     * 检查用户权限
     */
    protected function checkRbac() {

        //获取adminid
        $adminId = session('adminId');

        if (!empty($adminId)) {
            //实例化管理员-角色模型
            $adminRoleModel = D('AdminRole');

            //获取角色id
            $roleId = $adminRoleModel->selectAdminRoleByAdminId($adminId);

            //实例化角色-模块模型
            $roleModuleModel = D('RoleModule');

            //获取模块id
            foreach ($roleId as $k => $v) {
                $moduleId[] = $roleModuleModel->selectRoleModuleByRoleId($v['role_id']);
            }

            //实例化模块模型
            $moduleModel = D('Module');

            //获取模块
            foreach ($moduleId as $k => $v) {
                foreach ($v as $k1 => $v1) {
                    $module[] = $moduleModel->selectModuleById($v1['module_id']);
                }
            }

            //获取模块的URL
            foreach ($module as $k => $v) {
                $moduleUrl[] = $v['module_url'];
            }
            $this->assign('moduleurl', $moduleUrl);
            $urlStr = implode(',', $moduleUrl);

            $path = I('path.0') . "/" . I('path.1');
            $result = stripos($urlStr, $path);

            if ($result === false) {
                $this->error('您无权访问此页面');
            }
        } else {
            $this->error('您还没有登录系统或登录已经过期，请重新登录', U('Login/index'));
        }
    }

}
