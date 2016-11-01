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
        $model= model('Image');
        if(Request::instance()->isPost()) //如果是POST提交
        {    // 获取经过过滤的全部post变量
            $data=Request::instance()->post();  
             // 获取表单上传文件 
            $file = request()->file('image');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                //获得文件名
               $data['image']= $info->getFilename();   
               //缩略图
               
              // 获取当前请求中的文件上传对象(打开图片)
               $thumb= \think\Image::open(request()->file('image'));
            
               
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
        // 过滤post数组中的非数据表字段数据
        $model->allowField(true)->save($data); 
    }
    
    
}
