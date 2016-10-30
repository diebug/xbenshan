<?php
// +----------------------------------------------------------------------
// | Minishop [ Easy to handle for Micro businesses]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.qasl.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: vaey
// +----------------------------------------------------------------------

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
use common\library\Databack;

class Database extends Common
{
	/**
     * 数据库备份/还原列表
     * @param  String $type import-还原，export-备份
     */
    public function index($type = null){
        switch ($type) {
            /* 数据还原 */
            case 'import':
                //列出备份文件列表
                $path = realpath(config('data_backup_puth'));
                $flag = \FilesystemIterator::KEY_AS_FILENAME;
                $glob = new \FilesystemIterator($path,  $flag);
                $list = array();
                foreach ($glob as $name => $file) {
                    if(preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql(?:\.gz)?$/', $name)){
                        $name = sscanf($name, '%4s%2s%2s-%2s%2s%2s-%d');

                        $date = "{$name[0]}-{$name[1]}-{$name[2]}";
                        $time = "{$name[3]}:{$name[4]}:{$name[5]}";
                        $part = $name[6];

                        if(isset($list["{$date} {$time}"])){
                            $info = $list["{$date} {$time}"];
                            $info['part'] = max($info['part'], $part);
                            $info['size'] = $info['size'] + $file->getSize();
                        } else {
                            $info['part'] = $part;
                            $info['size'] = $file->getSize();
                        }
                        $extension        = strtoupper(pathinfo($file->getFilename(), PATHINFO_EXTENSION));
                        $info['compress'] = ($extension === 'SQL') ? '-' : $extension;
                        $info['time']     = strtotime("{$date} {$time}");

                        $list["{$date} {$time}"] = $info;
                    }
                }
                krsort($list);
                break;

            /* 数据备份 */
            case 'export':
                $list  = Db::query('SHOW TABLE STATUS');
                $list  = array_map('array_change_key_case', $list);
                break;
            default:
                $this->error('参数错误！');
        }

        //渲染模板
        $this->assign('list', $list);
        return $this->fetch($type);
    }

    /**
     * 优化表
     * @param  String $tables 表名
     */
    public function optimize($tables = null){
        if($tables) {
            if(is_array($tables)){
                $tables = implode('`,`', $tables);
                $list = Db::query("OPTIMIZE TABLE `{$tables}`");

                if($list){
                    return $this->success("数据表优化完成！");
                } else {
                    return $this->error("数据表优化出错请重试！");
                }
            } else {
                $list = Db::query("OPTIMIZE TABLE `{$tables}`");
                if($list){
                    return $this->success("数据表'{$tables}'优化完成！");
                } else {
                    return $this->error("数据表'{$tables}'优化出错请重试！");
                }
            }
        } else {
            return $this->error("请指定要优化的表！");
        }
    }

    /**
     * 修复表
     * @param  String $tables 表名
     */
    public function repair($tables = null){
        if($tables) {
            if(is_array($tables)){
                $tables = implode('`,`', $tables);
                $list = Db::query("REPAIR TABLE `{$tables}`");

                if($list){
                    return $this->success("数据表修复完成！");
                } else {
                    return $this->error("数据表修复出错请重试！");
                }
            } else {
                $list = Db::query("REPAIR TABLE `{$tables}`");
                if($list){
                    return $this->success("数据表'{$tables}'修复完成！");
                } else {
                    return $this->error("数据表'{$tables}'修复出错请重试！");
                }
            }
        } else {
            return $this->error("请指定要修复的表！");
        }
    }

    /**
     * 删除备份文件
     * @param  Integer $time 备份时间
     */
    public function del($time = 0){
        if(is_array($time)){
            $flg = false;
            foreach ($time as  $value) {
                if($value){
                    $name  = date('Ymd-His', $value) . '-*.sql*';
                    $path  = realpath(config('data_backup_puth')).DIRECTORY_SEPARATOR. $name;
                    array_map("unlink", glob($path));
                    if(!count(glob($path))){
                        $flg = true;
                    } 
                } else {
                    $this->error('参数错误！');
                }
            }
            if($flg){
                 return $this->success('备份文件删除成功！');
            }
        }else{
            return $this->error('参数错误');
        }
        
    }

    /**
     * 备份数据库
     * @param  String  $tables 表名
     * @param  Integer $id     表ID
     * @param  Integer $start  起始行数
     */
    public function export($tables = null, $id = null, $start = null){

        if(request()->isPost() && !empty($tables) && is_array($tables)){ //初始化
            //读取备份配置
            $config = array(
                'path'     => realpath(config('data_backup_puth')).DIRECTORY_SEPARATOR,
                'part'     => '20971520',
                'compress' => '1',
                'level'    => '9',
            );
            //检查是否有正在执行的任务
            $lock = "{$config['path']}backup.lock";
            if(is_file($lock)){
                $this->error('检测到有一个备份任务正在执行，请稍后再试！');
            } else {
                //创建锁文件
                file_put_contents($lock, time());
            }

            //检查备份目录是否可写
            is_writeable($config['path']) || $this->error('备份目录不存在或不可写，请检查后重试！');
            session('backup_config', $config);

            //生成备份文件信息
            $file = array(
                'name' => date('Ymd-His', time()),
                'part' => 1,
            );
            session('backup_file', $file);

            //缓存要备份的表
            session('backup_tables', $tables);

            //创建备份文件
            $Databack = new Databack($file, $config);
            if(false !== $Databack->create()){
                $tab = array('id' => 0, 'start' => 0);
                return $this->success('初始化成功！', '', array('tables' => $tables, 'tab' => $tab));
            } else {
                return $this->error('初始化失败，备份文件创建失败！');
            }
        } elseif (request()->isGet() && is_numeric($id) && is_numeric($start)) { //备份数据
            $tables = session('backup_tables');
            //备份指定表
            $Databack = new Databack(session('backup_file'), session('backup_config'));
            $start  = $Databack->backup($tables[$id], $start);
            if(false === $start){ //出错
                $this->error('备份出错！');
            } elseif (0 === $start) { //下一表
                if(isset($tables[++$id])){
                    $tab = array('id' => $id, 'start' => 0);
                    return $this->success('备份完成！', '', array('tab' => $tab));
                } else { //备份完成，清空缓存
                    unlink(session('backup_config.path') . 'backup.lock');
                    session('backup_tables', null);
                    session('backup_file', null);
                    session('backup_config', null);
                    return $this->success('备份完成！','',array('tid'=>$id));
                }
            } else {
                $tab  = array('id' => $id, 'start' => $start[0]);
                $rate = floor(100 * ($start[0] / $start[1]));
                return $this->success("正在备份...({$rate}%)", '', array('tab' => $tab));
            }

        } else { //出错
            $this->error('参数错误！');
        }
    }

    /**
     * 还原数据库
     */
    public function import($time = 0, $part = null, $start = null){
        if(is_numeric($time) && is_null($part) && is_null($start)){ //初始化
            //获取备份文件信息
            $name  = date('Ymd-His', $time) . '-*.sql*';
            $path  = realpath(config('data_backup_puth')).DIRECTORY_SEPARATOR. $name;
            $files = glob($path);
            $list  = array();
            foreach($files as $name){
                $basename = basename($name);
                $match    = sscanf($basename, '%4s%2s%2s-%2s%2s%2s-%d');
                $gz       = preg_match('/^\d{8,8}-\d{6,6}-\d+\.sql.gz$/', $basename);
                $list[$match[6]] = array($match[6], $name, $gz);
            }
            ksort($list);

            //检测文件正确性
            $last = end($list);
            if(count($list) === $last[0]){
                session('backup_list', $list); //缓存备份列表
                return $this->success('正在还原...！', '', array('part' => 1, 'start' => 0));
            } else {
                return $this->error('备份文件可能已经损坏，请检查！');
            }
        } elseif(is_numeric($part) && is_numeric($start)) {
            $list  = session('backup_list');
            $db = new Databack($list[$part], array(
                'path'     => realpath(config('data_backup_puth')),
                'compress' => $list[$part][2]));
            $start = $db->import($start);
        
            if(false === $start){
                $this->error('还原数据出错！');
            } elseif(0 === $start) { //下一卷
                if(isset($list[++$part])){
                    $data = array('part' => $part, 'start' => 0);
                    return $this->success("正在还原...#{$part}", '', $data);
                } else {
                    session('backup_list', null);
                    return $this->success('还原完成！');
                }
            } else {
                $data = array('part' => $part, 'start' => $start[0]);
                if($start[1]){
                    $rate = floor(100 * ($start[0] / $start[1]));
                    return $this->success("正在还原...#{$part} ({$rate}%)", '', $data);
                } else {
                    $data['gz'] = 1;
                    return $this->success("正在还原...#{$part}", '', $data);
                }
            }

        } else {
            $this->error('参数错误！');
        }
    }
}
