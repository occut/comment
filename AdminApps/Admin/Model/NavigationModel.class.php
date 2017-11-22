<?php
/**
 * Functions: POS机控制器.
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */
namespace Admin\Model;

use Think\Model;
class NavigationModel extends Model{
    /**
     * ��ӵ�������
     */
    public function addNavigation($navigation){
        $result=M('navigation')->add($navigation);
        return $result;
    }
    /**
     * ɾ�����navigation��group_idΪ$groupid��һ�����
     */
    public function deleteNavigationById($groupId) {
        $result = M('navigation')->delete($groupId);
        return $result;
    }
    /**
     * ���浼������navigation��group_idΪ$groupid��һ�����
     */
    public function saveNavigation($groupId, $Navigation) {
        $result = M('navigation')->where('nav_id=' . $groupId)->save($Navigation);
        return $result;
    }
    /**
     * �������еĵ�������
     */
    public function selectAllNavigations() {
        $result = M('navigation')->select();
        return $result;
    }
    /**
     * ���ҵ�������navigation��group_idΪ$groupid��һ�����
     */
    public function selectNavigationById($groupId) {
        $result = M('navigation')->find($groupId);
        return $result;
    }
    /**
     * ��ȡ����������е�������
     */
    public function selectNavigationTotalSize() {
        $result = M('navigation')->count();
        return $result;
    }
    /**
     * ��ҳ��ݼ�
     */
    public function selectNavigationByPage($Page){

        $data['admin_id'] = session('adminId');
        if(session('adminId') == 46){
            $result=M('navigation')->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }else{
            $result = M('navigation')->where($data)->limit($Page->firstRow . ',' . $Page->listRows)->select();
            return $result;
        }
    }
    /**
     * ��ȡ���������и���
     */
    public function selectNavigationByParentId($parentId) {
        $data['admin_id'] = session('adminId');
        if(session('adminId') == 46){
            $result = M('navigation')->where('parent_id='.$parentId)->order('nav_order desc')->select();
            return $result;
        }else{
            $result = M('navigation')->where($data)->where('parent_id='.$parentId)->order('nav_order desc')->select();
            return $result;
        }
    }

}