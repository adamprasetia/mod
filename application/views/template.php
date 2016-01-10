<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?php echo APP_NAME ?></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon.ico')?>"/>  
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('../assets/bootstrap-3.3.5-dist/css/bootstrap.min.css')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('../assets/jquery-ui-1.11.2/jquery-ui.css')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('../assets/AdminLTE-2.3.0/css/AdminLTE.css')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('../assets/AdminLTE-2.3.0/css/skins/_all-skins.min.css')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('../assets/AdminLTE-2.3.0/plugins/morris/morris.css')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('../assets/font-awesome-4.3.0/css/font-awesome.min.css')?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('../assets/ionicons-2.0.1/css/ionicons.min.css')?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css')?>"/>

  <script> var base_url = '<?php echo base_url()?>'</script>
	<script type="text/javascript" src="<?php echo base_url('../assets/js/jquery-1.11.3.min.js')?>"/></script>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
  <header class="main-header">
    <?php echo anchor('home','<span class="logo-mini"><b>'.APP_NAME.'</b></span><span class="logo-lg">'.APP_NAME.'</span>',array('class'=>'logo')) ?>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo get_user_photo($this->general->get_user_info('photo')) ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->general->get_user_info('nama') ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo get_user_photo($this->general->get_user_info('photo')) ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $this->general->get_user_info('nama') ?>
                  <small><?php echo $this->general->get_user_info('level') ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <?php echo anchor('change_password','Change Password',array('class'=>'btn btn-default btn-flat')) ?>
                </div>
                <div class="pull-right">
                  <?php echo anchor('home/logout','Sign out',array('class'=>'btn btn-default btn-flat')) ?>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php echo active_menu('master')?> treeview">
          <a href="#">
            <i class="fa fa-cubes"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('master','user_level')?>"><?php echo anchor('master/user_level','<i class="fa fa-circle-o"></i> User Level')?></li>
            <li class="<?php echo active_menu('master','user_status')?>"><?php echo anchor('master/user_status','<i class="fa fa-circle-o"></i> User Status')?></li>
            <li class="<?php echo active_menu('master','event_tipe')?>"><?php echo anchor('master/event_tipe','<i class="fa fa-circle-o"></i> Event Tipe')?></li>
            <li class="<?php echo active_menu('master','event_status')?>"><?php echo anchor('master/event_status','<i class="fa fa-circle-o"></i> Event Status')?></li>
            <li class="<?php echo active_menu('master','shift')?>"><?php echo anchor('master/shift','<i class="fa fa-circle-o"></i> Shift')?></li>
          </ul>
        </li> 
        <li class="<?php echo active_menu('user')?> treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('user','add')?>"><?php echo anchor('user/add','<i class="fa fa-circle-o"></i> Tambah User')?></li>
            <li class="<?php echo active_menu('user','')?>"><?php echo anchor('user','<i class="fa fa-circle-o"></i> List User')?></li>
          </ul>
        </li>                         
				<li class="<?php echo active_menu('event')?> treeview">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Event</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
						<li class="<?php echo active_menu('event','add')?>"><?php echo anchor('event/add','<i class="fa fa-circle-o"></i> Tambah Event')?></li>
						<li class="<?php echo active_menu('event','')?>"><?php echo anchor('event','<i class="fa fa-circle-o"></i> List Event')?></li>
          </ul>
      	</li>
        <li class="treeview <?php echo active_menu('user_event')?>"><?php echo anchor('user_event','<i class="fa fa-archive"></i> <span>User Event</span>')?></li>
        <li class="treeview <?php echo active_menu('absent')?>"><?php echo anchor('absent','<i class="fa fa-edit"></i> <span>Absent</span>')?></li>
        <li class="treeview <?php echo active_menu('price')?>"><?php echo anchor('price','<i class="fa fa-money"></i> <span>Price</span>')?></li>
        <li class="treeview <?php echo active_menu('schedule')?>"><?php echo anchor('schedule','<i class="fa fa-calendar"></i> <span>Schedule</span>')?></li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
  	<?php echo $content ?>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>PT Data Bina Solusindo (ADirect)</strong>
  </footer>
	<script type="text/javascript" src="<?php echo base_url('../assets/jquery-ui-1.11.2/jquery-ui.min.js')?>"/></script>
	<script type="text/javascript" src="<?php echo base_url('../assets/bootstrap-3.3.5-dist/js/bootstrap.min.js')?>"/></script>
	<script type="text/javascript" src="<?php echo base_url('../assets/AdminLTE-2.3.0/js/app.js')?>"/></script>
	<script type="text/javascript" src="<?php echo base_url('../assets/price_format_plugin.js')?>"/></script>
	<script type="text/javascript" src="<?php echo base_url('../assets/AdminLTE-2.3.0/plugins/slimScroll/jquery.slimscroll.min.js')?>"/></script>
	<script type="text/javascript" src="<?php echo base_url('../assets/AdminLTE-2.3.0/plugins/morris/raphael-min.js')?>"/></script>
	<script type="text/javascript" src="<?php echo base_url('../assets/AdminLTE-2.3.0/plugins/morris/morris.min.js')?>"/></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/general.js')?>"/></script>
</body>
</html>