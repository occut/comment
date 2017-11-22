<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>跳转提示</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/AdminResource/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/AdminResource/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/AdminResource/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          跳转提示：
          <small>页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></small>
        </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-dashboard"></i> 首页</li>
          <li>提示</li>
          <li class="active">跳转提示</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">
			
			<?php if(isset($message)) {?>
			<font color="#00FF00">提示：</font>
			<?php }else{?>
			<font color="#FF0000">错误：</font>
			<?php }?>
			
			</h3>
          </div>
          <div class="box-body">
            
			<?php if(isset($message)) {?>
			<font color="#00FF00"><?php echo($message); ?></font>
			<?php }else{?>
			<font color="#FF0000"><?php echo($error); ?></font>
			<?php }?>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.3
      </div>
      <strong>Copyright &copy; 2012-2016 <a href="http://www.hfyefan.com">YF</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="/AdminResource/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/AdminResource/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/AdminResource/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/AdminResource/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/AdminResource/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/AdminResource/dist/js/demo.js"></script>

<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>

</body>
</html>

