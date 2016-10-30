<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:70:"D:\xbenshan\public\mini_v1.0.1/application/admin\view\theme\index.html";i:1471616306;s:70:"D:\xbenshan\public\mini_v1.0.1/application/admin\view\common\head.html";i:1474875000;s:72:"D:\xbenshan\public\mini_v1.0.1/application/admin\view\common\header.html";i:1474875135;s:72:"D:\xbenshan\public\mini_v1.0.1/application/admin\view\common\navbar.html";i:1471616305;s:72:"D:\xbenshan\public\mini_v1.0.1/application/admin\view\common\footer.html";i:1474879114;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>小微云商城-系统管理</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="STATIC_PATH/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="STATIC_PATH/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="STATIC_PATH/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style type="text/css">
  .bg {
    height:230px;
  }

</style>
  
<body class="skin-blue sidebar-mini wysihtml5-supported fixed">
<div class="wrapper">

 <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo url('Index/index'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>小微云商城</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         <!--  <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
           
          </li> -->
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
             
              <li class="footer"><a href="#">View all</a></li>
            </ul> -->
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul> -->
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             
              <span class="hidden-xs"><?php echo Session('admin_user_auth.username'); ?></span>
            </a>
            <ul class="dropdown-menu">
 
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo url('user/edit'); ?>" class="btn btn-default btn-flat">个人资料</a>
                  
                </div>
                </li>
                <li>
                 <div class="box-footer">
                  
                   <a href="<?php echo url('common/logout'); ?>" class="btn btn-default btn-flat">退出</a>
                </div>
                
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         <!--  <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="height:40px;">
        <div class="pull-left info">
          <p><?php echo Session('admin_user_auth.username'); ?> <a href="#"><i class="fa fa-circle text-success"></i> </a></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">导航</li>
        <?php if(is_array($menuTree) || $menuTree instanceof \think\Collection): $i = 0; $__LIST__ = $menuTree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li class="<?php echo get_menu_navbar_active($vo['id']); ?> treeview">
          <a href="<?php echo $vo['url']; ?>">
            <i class="<?php echo $vo['icon']; ?>"></i> <span><?php echo $vo['name']; ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <?php if(!(empty($vo['_child']) || ($vo['_child'] instanceof \think\Collection && $vo['_child']->isEmpty()))): ?>
          <ul class="treeview-menu">
            <?php if(is_array($vo['_child']) || $vo['_child'] instanceof \think\Collection): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>
                <li class="<?php echo get_menu_navbar_active($sub['id']); ?>"><a href="<?php echo url($sub['url']); ?>"><i class="<?php echo $sub['icon']; ?>"></i><?php echo $sub['name']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
          <?php endif; ?>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        主题设置
        <small>主题列表</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url('Index/index'); ?>"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li><a href="<?php echo url('admin/link/index'); ?>">插件</a></li>
        <li><a>主题设置</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
                                         
               <h4>主题设置</h4>
             
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            
              <div class="table-responsive mailbox-messages">
              <div class="container-fluid bg">
                <div class="row" >                  
              <?php if(is_array($file) || $file instanceof \think\Collection): $i = 0;$__LIST__ = is_array($file) ? array_slice($file,2,null, true) : $file->slice(2,null, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($result == $vo): ?>
              <div class="col-lg-3 col-md-4 col-ms-4 col-xs-6 bg">
              <div style="border-width:10px;width:236px;height:200px;float:left;margin:10px 10px 10px 35px">
              <span class="label label-success"><?php echo $vo; ?>&nbsp;主题</span><br/>
              <img src="ROOT_PATH/themes/<?php echo $vo; ?>/screenshot.jpg"  height="150" width="230" style="border:3px solid green"/>
              <div class="pull-left" style="margin-top:5px;"> <button  type="button" name="<?php echo $vo; ?>" class="btn btn-block btn-primary btn-xs ">应用</button></div><div style="padding-top:5px;float:left;margin-left:150px;"><span class="label label-success" >已应用</span></div>
              </div>
              </div>
              <?php else: ?>
              <div class="col-lg-3 col-md-4 col-ms-4 col-xs-6 bg">
              <div style="border-width:50px;width:236px;height:200px;float:left;margin:10px 10px 10px 35px">
              <?php echo $vo; ?>&nbsp;主题<br/>
              <img src="ROOT_PATH/themes/<?php echo $vo; ?>/screenshot.jpg"  height="150" width="230" />
              <div class="pull-left" style="margin-top:5px;"> <button  type="button" name="<?php echo $vo; ?>" class="btn btn-block btn-primary btn-xs ">应用</button></div>  
              </div>
              </div>
              <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                  </div>
                </div>
                
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="pull-right" style="margin-right:20px;">
             
            </div>
              <!-- /.box-tools -->
           </div> 
          <!-- /. box -->

            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://qasl.cn">深蓝科技</a>.</strong> All rights
    reserved.
  </footer>
  <script type="text/javascript" src="http://tajs.qq.com/stats?sId=58696658" charset="UTF-8"></script>

</div>

<script src="STATIC_PATH/plugins/jQuery/jquery-1.9.1.min.js"></script>
<script src="STATIC_PATH/plugins/jQueryUI/jquery-ui.min.js"></script>

<script type="text/javascript">
  $.widget.bridge('uibutton',$.ui.button);  

  //判断使用了哪个主题
  $('button').click(function(){        
    var name=$(this).attr('name');

    $.ajax({
        cache:true,
        type :"POST",
        url  :'<?php echo url('change'); ?>',
        data :{
          "name":name       
        },
        async:false,
           success:function(data){
            if(data.code){
              alert(data.msg);
              setTimeout(function(){
                location.href=data.url;
              },1000);
            } else {
              alert(data.msg);
            }
           },
           error:function(request){
            alert("页面错误");
           }
      }); 
  });
</script>

<script>
  $(function () {
    
    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    
  });
      
      function dele(){
        if (!confirm("确认要删除？")) {
            return false;
        }
        else{
      var check = document.getElementsByName("check");
      
      var len=check.length;
      var idAll="";
  
      for(var i=0;i<len;i++){
        if(check[i].checked){
          ids=idAll+=check[i].value+",";
         
        }
     
      }
    
      $.ajax({
        type: "POST",
        url: "<?php echo url('menu/delAll'); ?>",
        data: {ids:ids},
        dataType: "json",
        success: function(data){
          alert(data.msg);
  
        }

      });
    }
  }
</script>
<script>
    function del(id){
        if (!confirm("确认要删除？")) {
            return false;
        }else{
            var id = id;
            $.ajax({
             type: "POST",
             url: "<?php echo url('menu/del'); ?>",
             data: {id:id},
             dataType: "json",
             success: function(data){
             alert(data.msg);
      
                      }

         });
        }
    }
</script>
<!-- Bootstrap 3.3.6 -->
<script src="STATIC_PATH/bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="STATIC_PATH/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE App -->
<script src="STATIC_PATH/dist/js/app.min.js"></script>
</body>
</html>