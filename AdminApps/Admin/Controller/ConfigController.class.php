<?php

/**
 * Functions: 系统配置
 * Author: Xu Shiqing
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class ConfigController extends SuperController {

    /**
     * 修改网站配置
     */
    public function listMenuConfigs() {
        if ($_POST) {
            //接受POST传递过来的值
            $configId = I('configid');
            $webTitle = I('webtitle');
            $webKeyword = I('webkeywords');
            $webDescription = I('webdescription');
            $webCompany=I('webcompany');
            $webContact=I('webcontact');
            $webTelphone=I('webtelphone');
            $webFax=I('webfax');
            $webMobile=I("webmobile");
            $webeMail=I('webemail');
            $webQq=I('webqq');
            $webWeixin =I('webweixin');
            $webAddress=I('webaddress');

            // 获取上传路径
            $file = $_FILES['weblogo'];
            $info = upload_img($file);
            if ($info) {
                $webLogo = $info['savepath'] . $info['savename'];
            }
            //微信二维码
            //获取上传路径
            $file=$_FILES['webweixinurl'];
            $info=upload_img($file);
            if($info){
                $webWeixinUrl=$info['savepath'].$info['savename'];

            }
            //从页面获取网站配置数据
            $webUrl = I('weburl');
            $webIcp = I('webicp');
            $adminPage = I('adminpage');
            $indexPage = I('indexpage');
            $isAllowReg = I('isallowreg');
            $regTerm = I('regterm');
            $ipLimitTime = I('iplimittime');
            $ipLimitDate = I('iplimitdate');
            $banRegUser = I('banreguser');
            $uploadSize = I('uploadsize');
            $uploadType = I('uploadtype');
            $banVisitIp = I('banvisitip');
            $visitorCode = I('visitorcode');
            $webStatus = I('webstatus');
            $closedPrompt = I('closedprompt');
            //封装数据
            $webConfig['web_title'] = $webTitle;
            $webConfig['web_keywords'] = $webKeyword;
            $webConfig['web_description'] = $webDescription;
            if (!empty($webLogo)) {
                $webConfig['web_logo'] = $webLogo;
            }
          if(!empty($webWeixinUrl)){
              $webConfig['web_weixin_url']=$webWeixinUrl;
          }
            $webConfig['web_url'] = $webUrl;
            $webConfig['web_icp'] = $webIcp;
            $webConfig['admin_page'] = $adminPage;
            $webConfig['index_page'] = $indexPage;
            $webConfig['is_allow_reg'] = $isAllowReg;
            $webConfig['reg_term'] = $regTerm;
            $webConfig['ip_limit_time'] = $ipLimitTime;
            $webConfig['ip_limit_date'] = $ipLimitDate;
            $webConfig['ban_reg_user'] = $banRegUser;
            $webConfig['upload_size'] = $uploadSize;
            $webConfig['upload_type'] = $uploadType;
            $webConfig['ban_visit_ip'] = $banVisitIp;
            $webConfig['visitor_code'] = $visitorCode;
            $webConfig['web_status'] = $webStatus;
            $webConfig['closed_prompt'] = $closedPrompt;
            $webConfig['web_company']=$webCompany;
            $webConfig['web_contact']=$webContact;
            $webConfig['web_telphone']=$webTelphone;
            $webConfig['web_fax']=$webFax;
            $webConfig['web_mobile']=$webMobile;
            $webConfig['web_email']=$webeMail;
            $webConfig['web_qq']=$webQq;
            $webConfig['web_weixin']=$webWeixin;
            $webConfig['web_address']=$webAddress;

            //实例化网站配置模型并存入到数据库中
            $webConfigModel = D('WebConfig');
            $result = $webConfigModel->saveWebConfig($configId, $webConfig);
            if ($result >= 0) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "网站配置编辑成功。" . "网站标题：" . $webTitle;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('EDIT_WEBCONFIG_SUCCESS'), U('Config/editwebconfig'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "网站配置编辑失败。" . "网站标题：" . $webTitle;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->error(L('EDIT_WEBCONFIG_FAILURE'), U('Config/editwebconfig'));
            }
        } else {

            //实例化菜单分组模型并查询
            $menuGroupModel = D('MenuGroup');
            $menuGroupList = $menuGroupModel->selectAllMenuGroups();

            //实例化后台菜单模型并查询 
            $adminMenuModel = D('AdminMenu');
            $adminMenuList = $adminMenuModel->selectAllAdminMenus();

            //赋值到模版
            $this->assign('menugrouplist', $menuGroupList);
            $this->assign('adminmenulist', $adminMenuList);
            $this->display('Config/listmenuconfigs');
        }
    }

    /**
     * 新增后台菜单分组
     */
    public function addMenuGroup() {
        if (IS_POST) {
            //实例化菜单分组模型
            $menuGroupModel = D('MenuGroup');

            //从页面获取菜单分组数据
            $groupName = trim(I('groupname'));
            $groupOrder=I('grouporder');
            $isHidden = I('ishidden');

            //根据菜单分组名来查找菜单分组
            $menuGroup = $menuGroupModel->selectMenuGroupByGroupName($groupName);

            //做非空和重复判断
            if (empty($groupName)) {
                $this->error('菜单分组名不能为空');
            } elseif (!empty($menuGroup)) {
                $this->error('菜单分组名已存在，请重新输入');
            } else {
                //封装数据并存入到数据库中
                $menuGroup['group_order']=$groupOrder;
                $menuGroup['group_name'] = $groupName;
                $menuGroup['is_hidden'] = $isHidden;
                $result = $menuGroupModel->addMenuGroup($menuGroup);
                if ($result) {
                    //管理员操作记录到日志表中   
                    $logcontent = C('SYS_LOG_ACTION_ADD') . "菜单分组添加成功。" . "菜单分组名：" . $groupName;
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->success(L('ADD_MENUGROUP_SUCCESS'), U('Config/listmenuconfigs'));
                } else {
                    //管理员操作记录到日志表中   
                    $logcontent = C('SYS_LOG_ACTION_ADD') . "菜单分组添加失败。" . "菜单分组名：" . $groupName;
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->error(L('ADD_MENUGROUP_FAILURE'));
                }
            }
        } else {
            $this->display('Config/addmenugroup');
        }
    }

    /**
     * 删除后台菜单分组
     */
    public function deleteMenuGroup() {
        //从页面获取菜单分组id
        $groupId = I('groupid');

        //实例化菜单模型
        $adminMenuModel = D('AdminMenu');
        //实例化菜单分组模型
        $menuGroupModel = D('MenuGroup');
        $menuGroup = $menuGroupModel->selectMenuGroupById($groupId);
        //根据菜单分组id来查找菜单分组下的菜单
        $adminMenu = D('AdminMenu')->selectAdminMenusByGroupId($groupId);
        if (empty($adminMenu)) {
            $result = D('MenuGroup')->deleteMenuGroupById($groupId);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE') . "菜单分组删除成功。" . "菜单分组名：" . $menuGroup['group_name'];
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('DELTE_MENUGROUP_SUCCESS'), U('Config/listmenuconfigs'));
            }
        } else {
            //管理员操作记录到日志表中
            $logcontent = C('SYS_LOG_ACTION_DELETE') . "菜单分组删除失败。原因：分类下有子类。" . "分组名：" . $menuGroup['group_name'];
            sys_log(session('adminId'), session('adminName'), $logcontent);

            $this->error('请将下级菜单全部删除后再删除本分组', U('Config/listmenuconfigs'));
        }
    }

    /**
     * 修改菜单分组信息
     */
    public function editMenugroup() {
        if ($_POST) {
            //从页面中获取菜单分组信息
            $groupId = I('groupid');
            $groupName = I('groupname');
            $groupOrder=I('grouporder');
            $isHidden = I('ishidden');

            //封装数据
            $menuGroup['group_order']=$groupOrder;
            $menuGroup['group_name'] = $groupName;
            $menuGroup['is_hidden'] = $isHidden;

            //实例化菜单分组模型
            $menuGroupModel = D('MenuGroup');
            $result = $menuGroupModel->saveMenuGroup($groupId, $menuGroup);
            if ($result) {
                //管理员操作记录到日志表中             
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "菜单分组编辑成功。" . "菜单分组名：" . $groupName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('EDIT_MENUGROUP_SUCCESS'), U('Config/listmenuconfigs'));
            } else {
                //管理员操作记录到日志表中             
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "菜单分组编辑失败。" . "菜单分组名：" . $groupName;
                sys_log(session('adminId'), session('adminName'), $logcontent);


                $this->error(L('EDIT_MENUGROUP_FAILURE'), U('Config/listmenuconfigs'));
            }
        } else {
            //从页面中获取group_id
            $groupId = I('groupid');

            //实例化菜单分组模型并查询
            $menuGroupModel = D('MenuGroup');
            $menuGroup = $menuGroupModel->selectMenuGroupById($groupId);
            $this->assign('menugroup', $menuGroup);
            $this->display('Config/editmenugroup');
        }
    }

    /**
     *  新增后台菜单
     */
    public function addAdminMenu() {
        if (IS_POST) {
            //从页面获取菜单数据
            $menuName = trim(I('menuname'));
            $menuUrl = trim(I('menuurl'));
            $groupId = I('groupid');
            $isHidden = I('ishidden');
            $meunorder=I('menuorder');

            //做非空判断
            if (empty($menuName)) {
                $this->error('菜单名不能为空');
            } else {
                //封装数据并存入到数据库中去
                $adminMenuData['menu_order']=$meunorder;
                $adminMenuData['menu_name'] = $menuName;
                $adminMenuData['menu_url'] = $menuUrl;
                $adminMenuData['is_hidden'] = $isHidden;
                $adminMenuData['group_id'] = $groupId;

                //实例化后台菜单模型
                $adminMenuModel = D('AdminMenu');
                $result = $adminMenuModel->addAdminMenu($adminMenuData);
                if (true) {
                    //管理员操作记录到日志表中   
                    $logcontent = C('SYS_LOG_ACTION_ADD') . "后台菜单添加成功。" . "后台菜单名：" . $menuName;
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->success(L('ADD_MENU_SUCCESS'), U('Config/listmenuconfigs'));
                } else {
                    //管理员操作记录到日志表中   
                    $logcontent = C('SYS_LOG_ACTION_ADD') . "后台菜单添加失败。" . "后台菜单名：" . $menuName;
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->error(L('ADD_MENU_FAILURE'));
                }
            }
        } else {
            //从数据库中读取菜单分组数据赋值到页面中显示
            $menuGroupModel = D('MenuGroup');
            $menuGroup = $menuGroupModel->selectAllMenuGroups();
            $this->assign('menugroup', $menuGroup);
            $this->display('Config/addadminmenu');
        }
    }

    /**
     * 删除后台菜单
     */
    public function deleteAdminMenu() {
        //从页面获取菜单id
        $menuId = I('menuid');

        //实例化菜单分组模型
        $adminMenuModel = D('AdminMenu');

        $result = $adminMenuModel->deleteAdminMenuById($menuId);
        if ($result) {
            //管理员操作记录到日志表中
            $logcontent = C('SYS_LOG_ACTION_DELETE') . "后台菜单删除成功。" . "后台菜单名：" . $groupName['group_name'];
            sys_log(session('adminId'), session('adminName'), $logcontent);

            $this->success(L('DELTE_MENU_SUCCESS'), U('Config/listmenuconfigs'));
        }
    }

    /**
     * 显示修改菜单页面
     */
    public function editAdminMenu() {
        //从页面获取到menu_id
        $menuId = I('menuid');
        $menuName = I('menuname');

        if (empty($menuName)) {
            //实例化菜单分组模型
            $menuGroupModel = D('MenuGroup');
            $menuGroup = $menuGroupModel->selectAllMenuGroups();
            $this->assign('menuGroup', $menuGroup);

            //实例化菜单模型
            $adminMenuModel = D('AdminMenu');
            $adminMenu = $adminMenuModel->selectAdminMenuById($menuId);
            $this->assign('adminmenu', $adminMenu);

            $this->display('Config/editadminmenu');
        } else {
            $menuUrl = trim(I('menuurl'));
            $groupId = I('groupid');
            $isHidden = I('ishidden');
            $meunorder=I('menuorder');

            //封装数据
            $adminMenu['menu_name'] = $menuName;
            $adminMenu['menu_url'] = $menuUrl;
            $adminMenu['group_id'] = $groupId;
            $adminMenu['is_hidden'] = $isHidden;
            $adminMenu['menu_order']=$meunorder;
            //实例化菜单模型
            $adminMenuModel = D('AdminMenu');
            $result = $adminMenuModel->saveAdminMenu($menuId, $adminMenu);
            if ($result) {
                //管理员操作记录到日志表中             
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "后台菜单编辑失败。" . "后台菜单名：" . $menuName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->success(L('EDIT_MENU_SUCCESS'), U('Config/listmenuconfigs'));
            } else {
                //管理员操作记录到日志表中             
                $logcontent = C('SYS_LOG_ACTION_MODIFY') . "后台菜单编辑失败。" . "后台菜单名：" . $menuName;
                sys_log(session('adminId'), session('adminName'), $logcontent);

                $this->error(L('EDIT_MENU_FAILURE'));
            }
        }
    }

    /**
     * 显示地区管理页面
     */
    public function listAreas() {

        //实例化省份模型
        $provinceModel = D('Province');
        //实例化城市模型
        $cityModel = D('City');
        //实例化地区模型
        $areaModel = D('Area');

        //查询数据并赋值到页面
        $province = $provinceModel->selectAllProvinces();
        $city = $cityModel->selectAllCities();
        $area = $areaModel->selectAllAreas();
        $this->assign('province', $province);
        $this->assign('city', $city);
        $this->assign('area', $area);
        $this->display('Config/listareas');
    }

    /**
     * 新增省份
     */
    public function addProvince() {

        if (IS_POST) {
            //从页面获取省份信息
            $provinceName = trim(I('provincename'));
            $provinceSpelling = trim(I('provincespelling'));

            //做非空判断
            if (empty($provinceName)) {
                $this->error('请填写省份名称');
            }
            if (empty($provinceSpelling)) {
                $this->error('请填写省份全拼');
            }

            //实例化省份模型
            $provinceModel = D('province');

            //封装数据
            $province['province_name'] = $provinceName;
            $province['province_spelling'] = $provinceSpelling;

            //新增省份
            $result = $provinceModel->addProvince($province);
            if ($result) {
                $this->success(L('ADD_PROVINCE_SUCCESS'), U('Config/listareas'));
            } else {
                $this->error(L('ADD_PROVINCE_FAILURE'));
            }
        } else {
            $this->display('Config/addprovince');
        }
    }

    /**
     * 删除省份
     */
    public function deleteProvince() {
        //从页面获取省份的id
        $provinceId = I('provinceid');

        //实例化省份模型
        $provinceModel = D('Province');

        //删除省份
        $result = $provinceModel->deleteProvinceById($provinceId);
        if ($result) {
            $this->success(L('DELTE_PROVINCE_SUCCESS'), U('Config/listareas'));
        } else {
            $this->error(L('DELTE_PROVINCE_FAILURE'));
        }
    }

    /**
     * 编辑省份
     */
    public function editProvince() {
        //实例化省份模型
        $provinceModel = D('Province');

        if (IS_POST) {
            //从页面获取省份信息
            $provinceId = I('provinceid');
            $provinceName = I('provincename');
            $provinceSpelling = I('provincespelling');

            //做非空判断
            if (empty($provinceName)) {
                $this->error('请输入省份名称');
            } else if (empty($provinceSpelling)) {
                $this->error('请输入省份全拼');
            } else {
                //封装数据
                $province['province_name'] = $provinceName;
                $province['province_spelling'] = $provinceSpelling;

                //存入到数据库中
                $result = $provinceModel->saveProvince($provinceId, $province);
                if ($result) {
                    $this->success(L('EDIT_PROVINCE_SUCCESS'), U('Config/listareas'));
                } else {
                    $this->error(L('EDIT_PROVINCE_FAILURE'));
                }
            }
        } else {
            //从页面获取省份的id
            $provinceId = I('provinceid');

            //查找省份信息
            $provinc = $provinceModel->selectProvinceById($provinceId);
            $this->assign('province', $provinc);
            $this->display('Config/editprovince');
        }
    }

    /**
     * 新增城市
     */
    public function addCity() {

        if (IS_POST) {
            //从页面获取省份信息
            $cityName = trim(I('cityname'));
            $provinceId = I('provinceid');
            $citySpelling = trim(I('cityspelling'));
            $isHaveSite = I('ishavesite');
            $isHot = I('ishot');

            //做非空判断
            if (empty($cityName)) {
                $this->error('请填写城市名称');
            }
            if (empty($citySpelling)) {
                $this->error('请填写城市全拼');
            }

            //实例化城市模型
            $cityModel = D('City');

            //封装数据
            $city['city_name'] = $cityName;
            $city['province_id'] = $provinceId;
            $city['city_spelling'] = $citySpelling;
            $city['is_have_site'] = $isHaveSite;
            $city['is_hot'] = $isHot;

            //新增城市
            $result = $cityModel->addCity($city);
            if ($result) {
                $this->success(L('ADD_CITY_SUCCESS'), U('Config/listareas'));
            } else {
                $this->error(L('ADD_CITY_FAILURE'));
            }
        } else {
            //实例化省份模型
            $provinceModel = D('Province');

            //查找省份信息
            $province = $provinceModel->selectAllProvinces();
            $this->assign('province', $province);
            $this->display('Config/addcity');
        }
    }

    /**
     * 删除城市
     */
    public function deleteCity() {
        //从页面获取城市的id
        $cityId = I('cityid');

        //实例化城市模型
        $cityModel = D('City');

        //删除城市
        $result = $cityModel->deleteCityById($cityId);
        if ($result) {
            $this->success(L('DELTE_CITY_SUCCESS'), U('Config/listareas'));
        } else {
            $this->error(L('DELTE_CITY_FAILURE'));
        }
    }

    /**
     * 编辑城市
     */
    public function editCity() {
        //实例化省份模型
        $provinceModel = D('Province');

        //实例化城市模型
        $cityModel = D('City');

        if (IS_POST) {
            //从页面获取城市信息
            $cityId = I('cityid');
            $cityName = I('cityname');
            $citySpelling = I('cityspelling');
            $isHaveSite = I('ishavesite');
            $isHot = I('ishot');
            $provinceId = I('provinceid');

            //做非空判断
            if (empty($cityName)) {
                $this->error('请输入城市名称');
            } else if (empty($citySpelling)) {
                $this->error('请输入城市全拼');
            } else {
                //封装数据
                $city['city_name'] = $cityName;
                $city['city_spelling'] = $citySpelling;
                $city['is_have_site'] = $isHaveSite;
                $city['is_hot'] = $isHot;
                $city['province_id'] = $provinceId;

                //存入到数据库中
                $result = $cityModel->saveCity($cityId, $city);
                if ($result) {
                    $this->success(L('EDIT_CITY_SUCCESS'), U('Config/listareas'));
                } else {
                    $this->error(L('EDIT_CITY_FAILURE'));
                }
            }
        } else {

            //从页面获取城市的id
            $cityId = I('cityid');

            //查找省份信息
            $province = $provinceModel->selectAllProvinces();
            $this->assign('province', $province);

            //查找城市信息
            $city = $cityModel->selectCityById($cityId);
            $this->assign('city', $city);

            $this->display('Config/editcity');
        }
    }

    /**
     * 新增地区
     */
    public function addArea() {

        if (IS_POST) {
            //从页面获取地区信息
            $areaName = I('areaname');
            $cityId = I('cityid');
            $areaSpelling = I('areaspelling');

            //做非空判断
            if (empty($areaName)) {
                $this->error('请填写地区名称');
            }
            if (empty($areaSpelling)) {
                $this->error('请填写地区全拼');
            }

            //实例化地区模型
            $areaModel = D('Area');

            //封装数据
            $area['area_name'] = $areaName;
            $area['city_id'] = $cityId;
            $area['area_spelling'] = $areaSpelling;

            //新增地区
            $result = $areaModel->addArea($area);
            if ($result) {
                $this->success(L('ADD_AREA_SUCCESS'), U('Config/listareas'));
            } else {
                $this->error(L('ADD_AREA_FAILURE'));
            }
        } else {
            //实例化省份模型
            $provinceModel = D('Province');

            //查找省份信息
            $province = $provinceModel->selectAllProvinces();
            $this->assign('province', $province);

            //实例化城市模型
            $cityModel = D('City');

            //从页面中获取通过ajax传来的provinceid
            $provinceId = I('pronid');

            //通过获取页面中的provinceid来加载城市信息
            if (!empty($provinceId)) {
                $province = $provinceModel->selectProvinceById($provinceId);
                $city = $cityModel->selectCitysByProvinceId($province['province_id']);
                foreach ($city as $k => $v) {
                    $str .= "<option value='" . $v['city_id'] . "'>" . $v['city_name'] . "</option>";
                }
                $data = array(
                    'status' => 1,
                    'content' => $str
                );
                $this->ajaxReturn($data);
            }
            $this->display('Config/addarea');
        }
    }

    /**
     * 删除地区
     */
    public function deleteArea() {
        //从页面获取城市的id
        $areaId = I('areaid');

        //实例化地区模型
        $areaModel = D('Area');

        //删除地区
        $result = $areaModel->deleteAreaById($areaId);
        if ($result) {
            $this->success(L('DELTE_AREA_SUCCESS'), U('Config/listareas'));
        } else {
            $this->error(L('DELTE_AREA_FAILURE'));
        }
    }

    /**
     * 编辑地区
     */
    public function editArea() {
        //实例化省份模型
        $provinceModel = D('Province');

        //实例化城市模型
        $cityModel = D('City');

        //实例化地区模型
        $areaModel = D('Area');

        if (IS_POST) {
            //从页面获取地区信息
            $areaId = I('areaid');
            $areaName = I('areaname');
            $cityId = I('cityid');
            $areaSpelling = I('areaspelling');

            //做非空判断
            if (empty($areaName)) {
                $this->error('请填写地区名称');
            }
            if (empty($areaSpelling)) {
                $this->error('请填写地区全拼');
            }

            //封装数据
            $area['area_name'] = $areaName;
            $area['city_id'] = $cityId;
            $area['area_spelling'] = $areaSpelling;

            //新增地区
            $result = $areaModel->saveArea($areaId, $area);
            if ($result) {
                $this->success(L('EDIT_AREA_SUCCESS'), U('Config/listareas'));
            } else {
                $this->error(L('EDIT_AREA_FAILURE'));
            }
        } else {
            //从页面获取城市的id
            $areaId = I('areaid');

            //查找区域信息
            $area = $areaModel->selectAreaById($areaId);
            $this->assign('area', $area);

            //查找所属城市信息
            $city = $cityModel->selectCityById($area['city_id']);
            $this->assign('city', $city);

            //查找所属省份信息
            $province = $provinceModel->selectProvinceById($city['province_id']);
            $this->assign('province', $province);

            //查找所有省份信息
            $allProvince = $provinceModel->selectAllProvinces();
            $this->assign('allprovince', $allProvince);

            $this->display('Config/editarea');
        }
    }

    /**
     * 修改邮件配置信息
     */
    public function editMailConfig() {

        if (IS_POST) {
            //从页面获取邮件配置信息
            $configId = I('configid');
            $smtpServer = I('smtpserver');
            $smtpPort = I('smtpport');
            $smtpSender = I('smtpsender');
            $smtpName = I('smtpname');
            $smtpAccount = I('smtpaccount');
            $smtpPassword = I('smtppassword');

            //做非空判断
            if (empty($smtpServer)) {
                $this->error('请输入邮件服务器');
            } elseif (empty($smtpPort)) {
                $this->error('请输入邮件邮件发送端口');
            } elseif (empty($smtpSender)) {
                $this->error('请输入邮件发送者');
            } elseif (empty($smtpName)) {
                $this->error('请输入发送人称呼');
            } elseif (empty($smtpAccount)) {
                $this->error('请输入邮件帐号');
            } elseif (empty($smtpPassword)) {
                $this->error('请输入邮件发送密码');
            } else {
                //封装数据
                $mailConfig['smtp_server'] = $smtpServer;
                $mailConfig['smtp_port'] = $smtpPort;
                $mailConfig['smtp_sender'] = $smtpSender;
                $mailConfig['smtp_name'] = $smtpName;
                $mailConfig['smtp_account'] = $smtpAccount;
                $mailConfig['smtp_password'] = $smtpPassword;

                //实例化邮件配置模型
                $mailConfigModel = D('MailConfig');
                $result = $mailConfigModel->saveMailConfig($configId, $mailConfig);
                if ($result) {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_MODIFY') . "邮件配置编辑成功。";
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->success(L('EDIT_MAIL_SUCCESS'), U('Config/editmailconfig'));
                } else {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_MODIFY') . "邮件配置编辑失败。";
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->error(L('EDIT_MAIL_FAILURE'));
                }
            }
        } else {
            //实例化邮件配置模型并查找邮件配置信息
            $mailConfigModel = D('MailConfig');
            $mailConfig = $mailConfigModel->selectMailConfig();
            $this->assign('mailconfig', $mailConfig);
            $this->display('Config/editmailconfig');
        }
    }

    /**
     * 修改短信配置
     */
    public function editSmsConfig() {
        if ($_POST) {
            //从页面获取到的短信配置信息
            $configId = I('configid');
            $smsUserName = trim(I('smsusername'));
            $smsPassword = trim(I('smspassword'));
            $smsSender = trim(I('smssender'));

            //做非空判断
            if (empty($smsUserName)) {
                $this->error('请输入短信发送帐号');
            } elseif (empty($smsPassword)) {
                $this->error('请输入短信发送密码');
            } elseif (empty($smsSender)) {
                $this->error('请输入短信发送者');
            } else {
                //封装数据
                $smsConfig['sms_username'] = $smsUserName;
                $smsConfig['sms_password'] = $smsPassword;
                $smsConfig['sms_sender'] = $smsSender;

                //实例化短息配置模型
                $smsConfigModel = D('SmsConfig');
                $result = $smsConfigModel->saveSmsConfig($configId, $smsConfig);
                if ($result) {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_MODIFY') . "短信配置编辑成功。";
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->success(L('EDIT_SMS_SUCCESS'), U('Config/editsmsconfig'));
                } else {
                    //管理员操作记录到日志表中
                    $logcontent = C('SYS_LOG_ACTION_MODIFY') . "短信配置编辑失败。";
                    sys_log(session('adminId'), session('adminName'), $logcontent);

                    $this->error(L('EDIT_SMS_FAILURE'));
                }
            }
        } else {
            //实例化短信配置模型并查询短信配置信息
            $smsConfigModel = D('SmsConfig');
            $smsConfig = $smsConfigModel->selectSmsConfig();
            $this->assign('smsconfig', $smsConfig);
            $this->display('Config/editsmsconfig');
        }
    }

    /**
     * 显示行业配置页面
     */
    public function listWorkTypes() {
        $this->display('Config/listworktypes');
    }

    /**
     * 新增行业
     */
    public function addWorkType() {

        if (IS_POST) {
            //从页面获取行业信息
            $workName = I('workname');
            $parentId = I('parentid');

            //做非空判断
            if (empty($workName)) {
                $this->error('请填写行业名称');
            }

            //封装数据
            $workType['work_name'] = $workName;
            $workType['parent_id'] = $parentId;

            //实例化行业配置模型
            $workTypeModel = D('WorkType');

            //存入到数据库中
            $result = $workTypeModel->addWorkType($workType);
            if ($result) {
                $this->success(L('ADD_WORKTYPE_SUCCESS'), U('Config/listworktypes'));
            } else {
                $this->error(L('ADD_WORKTYPE_FAILURE'));
            }
        } else {
            $this->display('Config/addworktype');
        }
    }

    /**
     * 删除行业配置
     */
    public function deleteWorkType() {
        //从页面获取workid
        $workId = I('workid');

        //实例化行业配置模型
        $workTypeModel = D('WorkType');

        //查找行业配置信息
        $workType = $workTypeModel->selectWorkTypesByParentId($workId);

        if (empty($workType)) {

            //删除行业配置
            $result = $workTypeModel->deleteWorkTypeById($workId);
            if ($result) {
                $this->success(L('DELTE_WORKTYPE_SUCCESS'), U('Config/listworktypes'));
            } else {
                $this->error(L('DELTE_WORKTYPE_FAILURE'));
            }
        } else {
            $this->error('请先删除完下级行业');
        }
    }

    /**
     * 编辑行业配置
     */
    public function editWorkType() {
        //实例化行业配置模型
        $workTypeModel = D('WorkType');

        if (IS_POST) {
            //从页面获取信息
            $workId = I('workid');
            $workName = I('workname');
            $parentId = I('parentid');

            //做非空判断
            if (empty($workName)) {
                $this->error('请填写行业名称');
            }

            //封装数据
            $workType['work_name'] = $workName;
            $workType['parent_id'] = $parentId;

            //存入到数据库中
            $result = $workTypeModel->saveWorkType($workId, $workType);
            if ($result) {
                $this->success(L('EDIT_WORKTYPE_SUCCESS'), U('Config/listworktypes'));
            } else {
                $this->error(L('EDIT_WORKTYPE_FAILURE'));
            }
        } else {
            //从页面获取workid
            $workId = I('workid');

            //查找行业配置信息
            $workType = $workTypeModel->selectWorkTypeById($workId);
            $this->assign('worktype', $workType);

            //查找父行业信息
            $parentWorkType = $workTypeModel->selectWorkTypeById($workType['parent_id']);
            $this->assign('parentworktype', $parentWorkType);

            $this->display('Config/editworktype');
        }
    }



    /**
     * 元素界面
     */
    public function configList() {
        //select all configList information
        //实列化ConfigList模型
        $configListModel = D('ConfigList');

        //获取总的元素数
        $count = $configListModel->selectConfigListTotalSize();

        //实例化分页类
        $page = new \Org\Page\Page($count,$this->adminPageSize);


        //获取每页显示的数据集
        $configList = $configListModel->selectConfigListByPage($page);
        //分页显示输出
        $show = $page->show();

        //管理员操作记录到日志表中
        $logcontent =  C('SYS_LOG_ACTION_SELECT')."元素管理查询成功";
        sys_log(session('adminId'),session('adminName'),$logcontent);

        $this->assign('configList', $configList);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display('Config/configList');
    }


    /**
     * 添加元素的方法
     */
    public function addConfigList(){
        if (IS_POST) {
            //接受POST传递过来的值
            $listName = I('listname');;
            $ListContent = I('listcontent');
            //接收到的值不能为空
            if ( $listName=='') {
                $this->error('元素名不能为空');
            }
            if ( $ListContent=='') {
                $this->error('元素内容不能为空');
            }
            //封装数据
            $data['list_name'] = $listName;
            $data['list_content'] = $ListContent;

            //实列化ConfigList模型
            $configListModel = D('ConfigList');
            //添加元素信息
            $result = $configListModel->addConfigList($data);
            //返回添加结果
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."元素管理添加成功。" . "元素名：" . $listName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('ADD_LISTS_SUCCESS'), U('Config/configList'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."元素管理添加失败。" . "元素名：" . $listName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('ADD_LIST_FAILURE'));
            }
        } else{

            //赋值到模版
            $this->display('Config/addconfigList');
        }
    }
    /**
     * 删除元素的方法
     */
    public function deleteConfigList() {
        if (IS_GET){
            //接受GET传递过来的值
            $configListId = I('listid');

            //实列化ConfigList模型
            $configListModel = D('ConfigList');

            // 删除元素表中configList_id为$configListid的一条数据
            $result = $configListModel->deleteConfigListById($configListId);
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."元素删除成功。" . "元素名："  ;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('DELTE_LISTS_SUCCESS'), U('Config/configList'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_DELETE')."会员删除成功。" . "用户名：" ;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('DELTE_GOODS_FAILURE'));
            }
        }
    }

    /**
     * 编辑元素
     */
    public function editConfigList() {
        if (IS_POST) {
            //接受POST传递过来的参数
            $configListId = I('listid');
            $listName = I('listname');;
            $ListContent = I('listcontent');

            //接收到的值不能为空
            if (empty($listName)) {
                $this->error('元素名不能为空');
            }
            //封装数据
            $data['list_name'] = $listName;
            $data['list_content'] =  $ListContent;


            //实列化ConfigList模型
            $configListModel = D('ConfigList');
            //添加元素信息
            $result = $configListModel->saveConfigList($configListId, $data);
            //返回编辑结果
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."元素编辑成功。" . "元素名：" . $listName ;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('EDIT_LISTS_SUCCESS'), U('Config/configList'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."元素编辑失败。" . "元素名：" . $listName ;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('EDIT_LISTS_FAILURE'));
            }
        } else{

            //接受GET传递过来的参数
            $configListId = I('listid');

            //实列化ConfigList模型
            $configListModel = D('ConfigList');


            //查找元素表中configList_id为$configListId的一条数据
            $configList = $configListModel->selectConfigListById($configListId);

            //赋值到模版
            $this->assign('configList', $configList);

            $this->display();
        }
    }

    /**
     * 显示参数管理界面
     */
    public function listParamConfig() {
        //实例化ParamConfig模型
        $ParamConfigModel = D('ParamConfig');

        //获取总的用户数
        $count = $ParamConfigModel->selectParamConfigTotalSize();

        //实例化分页类
        $page = new \Org\Page\Page($count,$this->adminPageSize);


        //获取每页显示的数据集
        $ParamConfig =$ParamConfigModel->selectParamConfigByPage($page);
        //分页显示输出
        $show = $page->show();

        //管理员操作记录到日志表中
        $logcontent =C('SYS_LOG_ACTION_SELECT')."参数管理查询成功。";
        sys_log(session('adminId'),session('adminName'),$logcontent);

        //赋值到模版
        $this->assign('paramConfig', $ParamConfig);
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->display('Config/listParamConfig');
    }

    /**
     * 添加参数方法
     */
    public function addParamConfig() {
        if (IS_POST) {
            //接受POST传递过来的值
            $paramConfigName = I('paramconfigname');

            //实例化Role模型
            $paramConfigModel = D('ParamConfig');

            //保存参数
            $data['config_name'] =$paramConfigName ;
            $result = $paramConfigModel->addParamConfig($data);

            //返回一个添加结果
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."参数添加成功。" . "参数名：" . $paramConfigName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('ADD_PARAM_SUCCESS'), U('Config/listparamconfig'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_ADD')."参数名添加失败。" . "参数名：" .$paramConfigName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('ADD_PARAM_FAILURE'));
            }
        } else{
            //显示添加参数界面
            $this->display('Config/addParamConfig');
        }
    }

    /**
     * 编辑参数名
     */
    public function editParamConfig() {

        if (IS_POST) {
            //接受POST传递过来的参数
             $paramConfigId = I('paramconfigid');
            $paramConfigName = I('paramconfigname');

            //实例化Role模型
            $paramConfigModel = D('ParamConfig');
            $data['config_name']=$paramConfigName;

            //编辑参数名
            $result = $paramConfigModel->saveParamConfig($paramConfigId, $data);

            /* 返回一个编辑结果 */
            if ($result) {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."参数名编辑成功。" . "参数名：" .$paramConfigName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->success(L('EDIT_PARAM_SUCCESS'), U('Config/listparamconfig'));
            } else {
                //管理员操作记录到日志表中
                $logcontent = C('SYS_LOG_ACTION_MODIFY')."参数名编辑失败。" . "参数名：" .$paramConfigName;
                sys_log(session('adminId'),session('adminName'),$logcontent);

                $this->error(L('EDIT_PARAM_FAILURE'));
            }
        } else{
            //编辑参数界面
            //接受GET传递过来的参数
            $paramConfigId = I('paramconfigid');

            //实例化Role模型
            $paramConfigModel = D('ParamConfig');

            //查询某一个参数名
            $paramconfig = $paramConfigModel->selectParamConfigById( $paramConfigId);

            //赋值到模版
            $this->assign('paramconfig',  $paramconfig);
            $this->display("Config/editparamconfig");
        }
    }

    /**
     * 删除参数名
     */
    public function deleteParamConfig() {
        //接受get传递过来的paramconfigid
        $paramConfigId = I('paramconfigid');

        //实例化ParamConfig模型
        $paramConfigModel = D('ParamConfig');


        //查询参数
        $paramConfogName= $paramConfigModel->selectParamConfigById( $paramConfigId);
        //删除参数名
        $result =  $paramConfigModel->deleteParamConfigById($paramConfigId);

        //返回一个删除结果
        if ($result) {
            //管理员操作记录到日志表中
            $logcontent = C('SYS_LOG_ACTION_DELETE')."参数删除成功。" . "参数：" . $paramConfogName['config_name'];
            sys_log(session('adminId'),session('adminName'),$logcontent);

            $this->success(L('DELTE_PARAM_SUCCESS'));
        } else {
            //管理员操作记录到日志表中
            $logcontent = C('SYS_LOG_ACTION_DELETE')."参数删除失败。" . "参数：" . $paramConfogName['config_name'];
            sys_log(session('adminId'),session('adminName'),$logcontent);

            $this->error(L('DELTE_PARAM_FAILURE'));
        }
    }

    /**
     * 显示参数分配资源界面
     */
    public function listResources() {
        //接受GET传递过来的paramconfigid值
        $paramConfigId = I('paramconfigid');

        //实例化ParamConfig模型
        $paramConfigModel = D('ParamConfig');
        //实列化ConfigList模型
        $configListModel = D('ConfigList');

        //查找参数表中paramconfigid为$paramconfigidId一条数据信息
        $paramconfig = $paramConfigModel->selectParamConfigById($paramConfigId);

        //查询模块表中所有的模块资源
        $showconfiglist =  $configListModel->selectAllConfigList();

        //赋值到模版
        $this->assign('paramconfig',$paramconfig);
        $this->assign('showconfiglist', $showconfiglist);
        $this->display();
    }

    /**
     * 添加分配元素方法
     */
    public function addParamConfigResource() {

        if (IS_POST) {
            $paramConfigId = I('paramconfigid');
            $listId= I('listid');

            //实列化ParamConfig模型
            $ParamConfigModel = D('ParamConfig');


            //封装数据
                $data['config_list'] = implode(',',$listId);

                $data['config_id'] =  $paramConfigId;
                $result =  $ParamConfigModel->saveParamConfig($paramConfigId,$data);
//            返回添加参数-模块关系表中的id的结果
            if ($result) {
                $this->success(L('ADD_ADDLISTS_SUCCESS'), U('Config/listParamConfig'));
            } else {
                $this->error(L('ADD_ADDLISTS_FAILURE'));
            }
        }
    }





    /**
     *微信配置页面
     */
    public function editWechatConfig(){

        //实例化微信配置模型
        $wechatConfigModel = D('WechatConfig');

        if(IS_POST){

            //从页面获取微信配置信息
            $configId = I('configid');
            $appId = I('appid');
            $appSecret = I('appsecret');
            $firstReply = I('firstreply');
            $wechatToken = I('wechattoken');

            //封装数据
            $wechatConfig['app_id'] = $appId;
            $wechatConfig['app_secret'] = $appSecret;
            $wechatConfig['first_reply'] = $firstReply;
            $wechatConfig['wechat_token'] = $wechatToken;

            $result = $wechatConfigModel->saveWechatConfig($configId,$wechatConfig);
            if($result){
                $this->success('微信配置编辑成功',U('Config/editWechatConfig'));
            }else{
                $this->error('微信配置编辑失败');
            }
        }else{

            //查找微信配置信息
            $wechatConfig = $wechatConfigModel->selectWechatConfig();
            $this->assign('wechatconfig',$wechatConfig);

            $this->display('Config/editwechatconfig');
        }
    }

    /**
     *微信菜单页面
     */
    public function editWechatMenu(){

        //实例化微信菜单模型
        $wechatMenuModel = D('WechatMenu');


        if(IS_POST){

            // 存储第一个频道和频道下的菜单
            $firstParentMenuName = I('first_1_name');
            $firstParentMenuUrl = I('first_1_url');
            $firstChildMenuName = I('second_1_name');
            $firstChildMenuUrl = I('second_1_url');
            $firstChildMenu = array_combine($firstChildMenuName,$firstChildMenuUrl);

            //封装数据
            $firstParentMenu['menu_name'] = $firstParentMenuName;
            $firstParentMenu['menu_url'] = $firstParentMenuUrl;
            $firstParentMenu['parnet_id'] = 0;

            //清空微信菜单表
            $wechatMenuModel->deleteWechatMenu();
            $fpresult = $wechatMenuModel->addWechatMenu($firstParentMenu);
            if($fpresult){
                foreach($firstChildMenu as $k=>$v){

                    if(!empty($k) or !empty($v)){
                        //封装数据
                        $firstChildMenuArr['menu_name'] = $k;
                        $firstChildMenuArr['menu_url'] = $v;
                        $firstChildMenuArr['parent_id'] = $fpresult;
                        $fcresult = $wechatMenuModel->addWechatMenu($firstChildMenuArr);
                    }
                }
            }

            // 存储第二个频道和频道下的菜单
            $secondParentMenuName = I('first_2_name');
            $secondParentMenuUrl = I('first_2_url');
            $secondChildMenuName = I('second_2_name');
            $secondChildMenuUrl = I('second_2_url');
            $secondChildMenu = array_combine($secondChildMenuName,$secondChildMenuUrl);

            //封装数据
            $secondParentMenu['menu_name'] = $secondParentMenuName;
            $secondParentMenu['menu_url'] = $secondParentMenuUrl;
            $secondParentMenu['parnet_id'] = 0;

            $spresult = $wechatMenuModel->addWechatMenu($secondParentMenu);
            if($spresult){
                foreach($secondChildMenu as $k=>$v){

                    if(!empty($k) or !empty($v)){
                        //封装数据
                        $secondChildMenuArr['menu_name'] = $k;
                        $secondChildMenuArr['menu_url'] = $v;
                        $secondChildMenuArr['parent_id'] = $spresult;
                        $scresult = $wechatMenuModel->addWechatMenu($secondChildMenuArr);
                    }
                }
            }

            // 存储第三个频道和频道下的菜单
            $thirdParentMenuName = I('first_3_name');
            $thirdParentMenuUrl = I('first_3_url');
            $thirdChildMenuName = I('second_3_name');
            $thirdChildMenuUrl = I('second_3_url');
            $thirdChildMenu = array_combine($thirdChildMenuName,$thirdChildMenuUrl);

            //封装数据
            $thirdParentMenu['menu_name'] = $thirdParentMenuName;
            $thirdParentMenu['menu_url'] = $thirdMParentenuUrl;
            $thirdParentMenu['parnet_id'] = 0;

            $tpresult = $wechatMenuModel->addWechatMenu($thirdParentMenu);
            if($tpresult){
                foreach($thirdChildMenu as $k=>$v){

                    if(!empty($k) or !empty($v)){
                        //封装数据
                        $thirdChildMenuArr['menu_name'] = $k;
                        $thirdChildMenuArr['menu_url'] = $v;
                        $thirdChildMenuArr['parent_id'] = $tpresult;
                        $tcresult = $wechatMenuModel->addWechatMenu($thirdChildMenuArr);
                    }
                }
            }

            //判断是否存储成功
            if($fcresult && $scresult && $tcresult){

                //查找微信配置信息
                $wechatConfigModel = D('WechatConfig');
                $wechatConfig = $wechatConfigModel->selectWechatConfig();

                //实例化微信类
                $wechatObj =new \Org\Wechat\Wechat();
                //删除菜单
                $deleteMenu =$wechatObj->deleteMenu($wechatConfig['app_id'],$wechatConfig['app_secret']);

                if($deleteMenu == 'ok'){
                    //查找频道
                    $parentMenu = $wechatMenuModel->selectWechatMenusByParentId(0);
                    foreach($parentMenu as $k=>$v){
                        $pid[] = $v['menu_id'];
                        $pMenuName[] = $v['menu_name'];
                        $pMenuUrl[] = $v['menu_url'];
                    }

                    //查找频道一下的一级菜单
                    $firstChildMenu = $wechatMenuModel->selectWechatMenusByParentId($pid[0]);
                    $firstMenuData = '{"name":"'.$pMenuName[0].'","sub_button":[';
                    foreach($firstChildMenu as $k=>$v){
                        if($k == count($firstChildMenu)-1){
                            $firstMenuData .='{"type":"view","name":"'.$v['menu_name'].'","url":"'.$v['menu_url'].'"}';
                        }else{
                            $firstMenuData .='{"type":"view","name":"'.$v['menu_name'].'","url":"'.$v['menu_url'].'"},';
                        }
                    }
                    $firstMenuData .= ']}';

                    //查找频道二下的一级菜单
                    $secondChildMenu = $wechatMenuModel->selectWechatMenusByParentId($pid[1]);

                    $secondMenuData = '{"name":"'.$pMenuName[1].'","sub_button":[';
                    foreach($secondChildMenu as $k=>$v){
                        if($k == count($secondChildMenu)-1){
                            $secondMenuData .='{"type":"view","name":"'.$v['menu_name'].'","url":"'.$v['menu_url'].'"}';
                        }else{
                            $secondMenuData .='{"type":"view","name":"'.$v['menu_name'].'","url":"'.$v['menu_url'].'"},';
                        }
                    }
                    $secondMenuData .= ']}';

                    //查找频道三下的一级菜单
                    $thirdChildMenu = $wechatMenuModel->selectWechatMenusByParentId($pid[2]);
                    $thirdMenuData = '{"name":"'.$pMenuName[2].'","sub_button":[';
                    foreach($thirdChildMenu as $k=>$v){
                        if($k == count($thirdChildMenu)-1){
                            $thirdMenuData .='{"type":"view","name":"'.$v['menu_name'].'","url":"'.$v['menu_url'].'"}';
                        }else{
                            $thirdMenuData .='{"type":"view","name":"'.$v['menu_name'].'","url":"'.$v['menu_url'].'"},';
                        }
                    }
                    $thirdMenuData .= ']}';

                    //组装出菜单结构体
                    $menuData = '{"button":['.$firstMenuData.','.$secondMenuData.','.$thirdMenuData.']}';

                    //创建菜单
                    $creatMenu = $wechatObj->creatMenu($menuData,$wechatConfig['app_id'],$wechatConfig['app_secret']);

                    if($creatMenu == 'ok'){
                        $this->success('菜单保存并发布成功',U('Config/editWechatMenu'));
                    }else{
                        $this->error('菜单发布失败');
                    }
                }else{
                    $this->error('菜单删除失败');
                }
            }else{
                $this->error('菜单保存到数据库失败');
            }
        }else{

            //查找频道
            $parentMenu = $wechatMenuModel->selectWechatMenusByParentId(0);
            foreach($parentMenu as $k=>$v){
                $pid[] = $v['menu_id'];
                $pMenuName[] = $v['menu_name'];
                $pMenuUrl[] = $v['menu_url'];
            }
            $this->assign('pmenuname',$pMenuName);
            $this->assign('pmenuurl',$pMenuUrl);

            //查找频道一下的一级菜单
            $firstChildMenu = $wechatMenuModel->selectWechatMenusByParentId($pid[0]);
            foreach($firstChildMenu as $k=>$v){
                $fcMenuName[] = $v['menu_name'];
                $fcMenuUrl[] = $v['menu_url'];
            }
            $this->assign('fcmenuname',$fcMenuName);
            $this->assign('fcmenuurl',$fcMenuUrl);

            //查找频道二下的一级菜单
            $secondChildMenu = $wechatMenuModel->selectWechatMenusByParentId($pid[1]);
            foreach($secondChildMenu as $k=>$v){
                $scMenuName[] = $v['menu_name'];
                $scMenuUrl[] = $v['menu_url'];
            }
            $this->assign('scmenuname',$scMenuName);
            $this->assign('scmenuurl',$scMenuUrl);

            //查找频道三下的一级菜单
            $thirdChildMenu = $wechatMenuModel->selectWechatMenusByParentId($pid[2]);
            foreach($thirdChildMenu as $k=>$v){
                $tcMenuName[] = $v['menu_name'];
                $tcMenuUrl[] = $v['menu_url'];
            }
            $this->assign('tcmenuname',$tcMenuName);
            $this->assign('tcmenuurl',$tcMenuUrl);

            $this->display('Config/editwechatmenu');
        }
    }

    //ajax 提交改变ishidden 字段参数
    public function isHidden(){

        if(IS_POST){
            $ishidden=I('ishidden');
            $menuId=I('menuid');
            //实例化Singlepagemodel类
            $AdminMenuModel=D('AdminMenu');
            //封装数据
            $data['is_hidden']= $ishidden;
            //编辑单页表singlepage中singlepage_id为$singlepageId的一条数据
            $result=$AdminMenuModel->saveAdminMenu( $menuId, $data);

            if($result){
                $ishiddens = array(

                    'status' => C('JSON_SUCCESS_CODE'),

                );
            }
            $this->ajaxReturn($ishiddens);
        }
    }

    //ajax 提交改变ishidden 字段参数
    public function Hidden(){

        if(IS_POST){
            $ishidden=I('aaa');
            $groupId=I('groupid');
            //实例化Singlepagemodel类
            $menuGroupModel=D('MenuGroup');
            //封装数据
            $data['is_hidden']= $ishidden;
            //编辑单页表singlepage中singlepage_id为$singlepageId的一条数据
            $result=$menuGroupModel->saveMenuGroup( $groupId, $data);

            if($result){
                $ishiddens = array(

                    'status' => C('JSON_SUCCESS_CODE'),

                );
            }
            $this->ajaxReturn($ishiddens);
        }
    }



}
