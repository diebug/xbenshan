<?php
namespace app\admin\controller;

use think\Controller;
use think\File;
use think\Request;


class Image extends Controller
{
    public function imageList()
    {
        return $this->fetch();
    }    
           
    public function imageAdd()
    {	  
        return $this->fetch();
    }
    
    public function upload()
    {        
        if(Request::instance()->isPost()) //如果是POST提交
        {    
            // 获取经过过滤的全部post变量
            $data=Request::instance()->post();  
             // 获取表单上传文件 
            $file = request()->file('image');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $path=ROOT_PATH . 'public' . DS . 'uploads/';
            $info = $file->move($path);
            if($info){
                //获得文件名
               $data['image']= $info->getFilename();  
             //  $info->getSaveName();
               //缩略图
               
              // 获取当前请求中的文件上传对象(打开原图)
               $thumb= \think\Image::open(request()->file('image'));
               $thumb_path=ROOT_PATH . 'public' . DS . 'uploads/thumb/';
               $thumb->thumb(150, 150)->save($thumb_path.'s_'.$data['image']);
               //缩略图名称
               $data['thumb']='s_'.$data['image'];
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
                exit;
            }
        }
        $data['create_time']=time();
        $model= model('Image');
        if($model->save($data))
            $this->success('添加成功', 'Image/imageList');
        
    }
    
    
}
