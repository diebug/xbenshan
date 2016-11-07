<?php
namespace app\admin\controller;

use think\Controller;
use think\File;
use think\Request;
use think\Db;


class Image extends Controller
{
    //显示列表页面
    public function imageList()
    {
        $model=model('Image');
        //取出所有数据
        $data=$model->select();
        //取出总记录数
        $count=$model->Count();
        $this->assign([
            'data'  => $data,
            'count' => $count
        ]);
        return $this->fetch();
    }    
      //添加信息 
    public function imageAdd()
    {	  
            //如果是POST提交
        if(Request::instance()->isPost()) 
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

               //缩略图

              // 获取当前请求中的文件上传对象(打开原图)
               $thumb= \think\Image::open(request()->file('image'));
               //缩略图保存路径
               $thumb_path=ROOT_PATH . 'public' . DS . 'thumb'.DS;
               //缩略图名
               $thumb->thumb(150, 150)->save($thumb_path.'s_'.$data['image']);
               //缩略图名称
               $data['thumb']='s_'.$data['image'];
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
            $data['create_time']=time();
            $model= model('Image');
            if($model->allowField(true)->save($data))
                $this->success('添加成功', 'Image/imageList');
            else
                $this->error('添加失败', 'Image/imageList');
            exit;    
        }
        return $this->fetch();
    }
        //图片信息编辑
     public function imageEdit()
    {	
        $model = model('Image');
         //获取图片信息ID
        $image_id = input('image_id');
        if($image_id)
        {
            //获取对应ID 信息
           $info = $model->where('id', $image_id) ->find();
        }
        if(Request::instance()->isPost()) 
        {   
            // 获取经过过滤的全部post变量
            $data=Request::instance()->post(); 
            $data['update_time']=time();
            if($model->isUpdate(true)->allowField(true)->save($data,['id' =>$data['image_id']]))
                $this->success('修改成功', 'Image/imageList');
            else
                $this->error('修改失败', 'Image/imageList');
            exit;
        } 
        $this->assign('data',$info);
        return $this->fetch();
    }
    
    //图片信息删除
    public function  imageDel()
    {
        $image_id = input('image_id');
       
        if(Db::table('x_image')->delete($image_id))
             $this->success('删除成功', 'Image/imageList');
        else
             $this->error('删除失败', 'Image/imageList');
    }
    
}
