<?php

/**
 * Functions: .表admin_menu的增删改查（菜单模型）
 * Author: Xu Shiqing
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin \ Model;

use Think \ Model;

class DisableModel extends Model {


    /**
     * 添加后台菜单
     */
    public function addAdminMenu($adminMenu) {
        $result = M('admin_menu')->add($adminMenu);
        return $result;
    }

    /**
     * 根据AdminMenu的id来删除后台菜单
     */
    public function deleteAdminMenuById($menuId) {
        $result = M('admin_menu')->where("menu_id =" . $menuId)->delete();
        return $result;
    }

    /**
     * 根据AdminMenu的id来修改后台菜单
     */
    public function saveAdminMenu($menuId, $adminMenu) {
        $result = M('admin_menu')->where('menu_id =' . $menuId)->save($adminMenu);
        return $result;
    }
    
    /**
     * 查询可显示的后台菜单
     */
    public function selectAdminMenusByIsHidden($isHidden) {
        $result = M('admin_menu')->where('is_hidden='.$isHidden.'')->order('menu_order desc')->select();
        return $result;
    }

    /**
     * 查找所有的后台菜单
     */
    public function selectAllAdminMenus() {
        $result = M('admin_menu')->order('menu_order desc')-> select();
        return $result;
    }
    

    /**
     * 根据AdminMenu的menu_id来查找唯一的后台菜单
     */
    public function selectAdminMenuById($menuId) {
        $result = M('admin_menu')->where('menu_id =' . $menuId)->find();
        return $result;
    }

    /**
     * 根据AdminMenu的group_id来查找后台菜单
     */
    public function selectAdminMenusByGroupId($groupId) {
        $result = M('admin_menu')->where('group_id =' . $groupId)->select();
        return $result;
    }
     /**
      * 按条件查询菜单总数
      */
    public function selectAdminMenusByCondition($condition){
        $result=M('admin_menu')->where($condition)->count();
        return $result;
    }

}
