<?php
/**
 * Functions: 表project_type的增删查改
 * Author: Xu Shiqing
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Model;
use Think\Model;
class ProjectTypeModel extends Model{
	
    /**
     * 新增项目类型
     */
    public function addProjectType($projectType){
        $result = M('project_type')->add($projectType);
        return $result;
    }
    
    /**
     * 根据类型id来删除项目类型
     */
    public function deleteProjectTypeById($typeId) {
        $result = M('project_type')->where('type_id ='.$typeId)->delete();
        return $result;
    }
    
    /**
      * 根据类型的id来修改项目类型
      */
    public function saveProjectType($typeId,$projectType){
        $result = M('project_type')->where('type_id ='.$typeId)->save($projectType);
        return $result;
    }
    
    /**
     * 查找所有的项目类型
     */
    public function selectProjectTypes(){
        $result = M('project_type')->select();
        return $result;
    }
    
     /**
      * 根据类型的id来查找项目类型
      */
    public function selectProjectTypeById($typeId){
        $result = M('project_type')->where('type_id ='.$typeId)->find();
        return $result;
    }    
}


