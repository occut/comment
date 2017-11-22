<?php

/**
 * Functions: .表menu_group的增删改查（菜单分组模型）
 * Author: Xu Shiqing
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;

use Think\Model;

class MenuGroupModel extends Model {
	
	/**
     * 添加菜单分组
     */
    public function addMenuGroup($menuGroup) {
        $result = M('menu_group')->add($menuGroup);
        return $result;
    }

    /**
     * 根据MenuGroup的id来删除后台菜单分组
     */
    public function deleteMenuGroupById($groupId) {
        $result = M('menu_group')->where('group_id =' . $groupId)->delete();
        return $result;
    }

    /**
     * 根据MenuGroup的id来修改后台菜单分组
     */
    public function saveMenuGroup($groupId, $menuGroup) {
        $result = M('menu_group')->where('group_id =' . $groupId)->save($menuGroup);
        return $result;
    }

    /**
     * 查询可显示的后台菜单分组
     */
    public function selectAllMenuGroupByIsHidden($isHidden) {
        $result = M('menu_group')->where('is_hidden='.$isHidden)->order('group_order desc')->select();
        return $result;
    }

    /**
     * 查找所有的后台菜单分组
     */
    public function selectAllMenuGroups() {
        $result = M('menu_group')->order('group_order desc')->select();
        return $result;
    }

    /**
     * 根据MenuGroup的id来查找唯一的后台菜单分组
     */
    public function selectMenuGroupById($groupId) {
        $result = M('menu_group')->where('group_id = ' . $groupId)->find();
        return $result;
    }
    
    /**
     * 根据菜单分组名来查找菜单分组
     */
    public function selectMenuGroupByGroupName($groupName){
       
        $condition['group_name'] = $groupName;
        $result = M('menu_group')->where($condition)->find();
        return $result;
        
    }
   
}
