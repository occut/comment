<?php
/**
 * Created by PhpStorm.
 * User: occur
 * Date: 2017/7/9
 * Time: 18:49
 */
namespace Admin\Controller;

use Think\Controller;

class UploadController extends SuperController {
    /**
     * 显示weichat用户  正常
     */
   public function index(){
       $path = I('city');
       if(empty($path)){
           $dir = "UploadImages/friend";
       }else{
           $dir = "UploadImages/".$path;
       };

       $image = [];
       if (is_dir($dir)){
           if ($dh = opendir($dir)){
               while (($file = readdir($dh))!= false){
                   if($file !="." & $file != ".."){
                       //文件名的全路径 包含文件名
                     //  var_dump($file);
//                       $image['file'] = $dir.'/'.$file;
//                       $image['name'] = $file;
//                       $image[]=[
//                           'file'=>$dir.'/'.$file,
//                           'name'=>$file,
//                       ];
//                   var_dump($filePath);
//                   echo "<img src='".$filePath."'/>";
                   }
               }
               closedir($dh);
           }
       }
       $UploadModel=D('Upload');
       $a['admin_id']=session('adminId');
       $image = $UploadModel->where($a)->select();

       $this->assign('image', $image);
       $this->display('Upload/index');
   }
//   保存
   public function upbload()
   {
       $taskid=I('taskid');
       $navModel=D('Navigation');

       $nav= $navModel->selectNavigationById($taskid);
       //接收上传路径地址
       $path = I('city');
       $url=$path;
       //接收上传文件
       $file = $_FILES['tasks'];
       $webConfigModel = D('WebConfig');
       $webConfig = $webConfigModel->selectWebConfig();
       // 实例化上传类
       $upload = new \Think\Upload();
       // 设置附件上传大小
       $upload->maxSize = $webConfig['upload_size'] * 1024 * 1024;
       // 设置附件上传类型
       $upload->exts = explode('|', $webConfig['upload_type']);
       // 设置附件上传根目录
       $upload->rootPath = './';
       $upload->saveName="";
       // 设置附件上传（子）目录
       $upload->savePath = C('UPLOAD_IMG_DIRECTORY').$url."/";
       $info = $upload->uploadOne($file);
           if(!$info)
           {
               $UploadModel=D('Upload');
               $a['admin']=session('adminId');
               $image = $UploadModel->where($a)->select();
               $this->assign('image', $image);
               $this->display('Upload/index');
           }else{
               //获取上传路径
               $UploadModel=D('Upload');
               $data['upload_name']=$info['savename'];
               $data['upload_path']=$info['savepath'];
               $data['admin_id']=session('adminId');
               $value = $UploadModel->add($data);
               $taskPic = $info['savepath'].$info['savename'];
               $a['admin']=session('adminId');
               $image = $UploadModel->where($a)->select();
               $this->assign('image', $image);
               $this->display('Upload/index');
           }

       }

       public function content(){
           $textarea=I('textarea');
           $userid = session('adminId');
           $TextaraeaModel=D('Textarea');
           $b['admin_id']=$userid;
           $a['text_content']=$textarea;
           $value = $TextaraeaModel->where($b)->find();
           $this->assign('value', $value);
           $this->display('Upload/content');
       }
       public function addContent(){
           $TextaraeaModel=D('Textarea');
           $textarea=I('textarea');
           $userid = session('adminId');
           $a['admin_id']=$userid;
           $a['text_content']=$textarea;
           $b['admin_id']=$userid;
           $value = $TextaraeaModel->where($b)->find();
           if(empty($value)){
               $TextaraeaModel->add($a);
               $this->success('新增成功', U('Upload/content'));
           }else{
               $TextaraeaModel->where($b)->delete();
               $TextaraeaModel->add($a);
               $this->success('新增成功', U('Upload/content'));
           }
       }
       public function dell(){
           $TextaraeaModel=D('Upload');
           $textarea=I('upload_id');
           $b['upload_id'] = $textarea;
           $value = $TextaraeaModel->where($b)->find();
           $path = ".".$value['upload_path'].$value['upload_name'];
           unlink($path);
           $value = $TextaraeaModel->where($b)->delete();
           if($value){
               $this->success('删除成功', U('Upload/index'));
           }else{
               $this->success('删除失败', U('Upload/index'));
           }

       }
}