<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- just this block *********************** you can play with -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?=base_url()?>assets/admin_metro/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?=base_url()?>assets/admin_metro/plugins/gritter/css/jquery.gritter-rtl.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?=base_url()?>assets/admin_metro/css/style-metronic-rtl.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/css/style-rtl.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/css/style-responsive-rtl.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/css/plugins-rtl.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/css/pages/tasks-rtl.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/css/themes/default-rtl.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?=base_url()?>assets/admin_metro/css/custom-rtl.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_metro/plugins/bootstrap-toastr/toastr-rtl.min.css"/>
<link href="<?=base_url()?>assets/site_metro/css/site.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/admin_metro/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css" rel="stylesheet" type="text/css" media="screen"/><!-- END THEME STYLES -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?=base_url()?>assets/admin_metro/plugins/respond.min.js"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?=base_url()?>assets/site/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?=base_url()?>assets/admin_metro/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
     <script src="<?=base_url()?>assets/admin_metro/plugins/bootstrap-switch/static/js/bootstrap-switch.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=base_url()?>assets/admin_metro/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?=base_url()?>assets/admin_metro/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/plugins/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>assets/admin_metro/scripts/app.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/scripts/index.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/admin_metro/scripts/tasks.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
   App.init(); // initlayout and core plugins
   Index.init();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Index.initDashboardDaterange();
   Tasks.initDashboardWidget();
});
</script>
<!-- END JAVASCRIPTS -->
<!-- ********************************************************** -->


<script type="text/javascript" src="<?=base_url()?>assets/site/js/whatsapp/send.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/site/js/whatsapp/groups.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/site/js/site.js"></script>
<script>
</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a href="index.html" class="navbar-brand">
		<img class="img-responsive" alt="logo" src="assets/img/logo.png">
		</a>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" href="javascript:;">
		<img alt="" src="assets/img/menu-toggler.png">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN NOTIFICATION DROPDOWN -->
			<li id="header_notification_bar" class="dropdown">
				<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
				<i class="fa fa-warning"></i>
				<span class="badge">
					6
				</span>
				</a>
				<ul class="dropdown-menu extended notification">
					<li>
						<p>
							You have 14 new notifications
						</p>
					</li>
					<li>
						<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul style="height: 250px; overflow: hidden; width: auto;" class="dropdown-menu-list scroller">
							<li>
								<a href="#">
								<span class="label label-icon label-success">
									<i class="fa fa-plus"></i>
								</span>
								 New user registered.
								<span class="time">
									Just now
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-icon label-danger">
									<i class="fa fa-bolt"></i>
								</span>
								 Server #12 overloaded.
								<span class="time">
									15 mins
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-icon label-warning">
									<i class="fa fa-bell-o"></i>
								</span>
								 Server #2 not responding.
								<span class="time">
									22 mins
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-icon label-info">
									<i class="fa fa-bullhorn"></i>
								</span>
								 Application error.
								<span class="time">
									40 mins
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-icon label-danger">
									<i class="fa fa-bolt"></i>
								</span>
								 Database overloaded 68%.
								<span class="time">
									2 hrs
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-icon label-danger">
									<i class="fa fa-bolt"></i>
								</span>
								 2 user IP blocked.
								<span class="time">
									5 hrs
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-icon label-warning">
									<i class="fa fa-bell-o"></i>
								</span>
								 Storage Server #4 not responding.
								<span class="time">
									45 mins
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-icon label-info">
									<i class="fa fa-bullhorn"></i>
								</span>
								 System Error.
								<span class="time">
									55 mins
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-icon label-danger">
									<i class="fa fa-bolt"></i>
								</span>
								 Database overloaded 68%.
								<span class="time">
									2 hrs
								</span>
								</a>
							</li>
						</ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(161, 178, 189); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; left: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div></div>
					</li>
					<li class="external">
						<a href="#">See all notifications <i class="m-icon-swapright"></i></a>
					</li>
				</ul>
			</li>
			<!-- END NOTIFICATION DROPDOWN -->
			<!-- BEGIN INBOX DROPDOWN -->
			<li id="header_inbox_bar" class="dropdown">
				<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
				<i class="fa fa-envelope"></i>
				<span class="badge">
					5
				</span>
				</a>
				<ul class="dropdown-menu extended inbox">
					<li>
						<p>
							You have 12 new messages
						</p>
					</li>
					<li>
						<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul style="height: 250px; overflow: hidden; width: auto;" class="dropdown-menu-list scroller">
							<li>
								<a href="inbox.html?a=view">
								<span class="photo">
									<img alt="" src="./assets/img/avatar2.jpg">
								</span>
								<span class="subject">
									<span class="from">
										Lisa Wong
									</span>
									<span class="time">
										Just Now
									</span>
								</span>
								<span class="message">
									 Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh...
								</span>
								</a>
							</li>
							<li>
								<a href="inbox.html?a=view">
								<span class="photo">
									<img alt="" src="./assets/img/avatar3.jpg">
								</span>
								<span class="subject">
									<span class="from">
										Richard Doe
									</span>
									<span class="time">
										16 mins
									</span>
								</span>
								<span class="message">
									 Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh...
								</span>
								</a>
							</li>
							<li>
								<a href="inbox.html?a=view">
								<span class="photo">
									<img alt="" src="./assets/img/avatar1.jpg">
								</span>
								<span class="subject">
									<span class="from">
										Bob Nilson
									</span>
									<span class="time">
										2 hrs
									</span>
								</span>
								<span class="message">
									 Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh...
								</span>
								</a>
							</li>
							<li>
								<a href="inbox.html?a=view">
								<span class="photo">
									<img alt="" src="./assets/img/avatar2.jpg">
								</span>
								<span class="subject">
									<span class="from">
										Lisa Wong
									</span>
									<span class="time">
										40 mins
									</span>
								</span>
								<span class="message">
									 Vivamus sed auctor 40% nibh congue nibh...
								</span>
								</a>
							</li>
							<li>
								<a href="inbox.html?a=view">
								<span class="photo">
									<img alt="" src="./assets/img/avatar3.jpg">
								</span>
								<span class="subject">
									<span class="from">
										Richard Doe
									</span>
									<span class="time">
										46 mins
									</span>
								</span>
								<span class="message">
									 Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh...
								</span>
								</a>
							</li>
						</ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(161, 178, 189); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; left: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div></div>
					</li>
					<li class="external">
						<a href="inbox.html">See all messages <i class="m-icon-swapright"></i></a>
					</li>
				</ul>
			</li>
			<!-- END INBOX DROPDOWN -->
			<!-- BEGIN TODO DROPDOWN -->
			<li id="header_task_bar" class="dropdown">
				<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
				<i class="fa fa-tasks"></i>
				<span class="badge">
					5
				</span>
				</a>
				<ul class="dropdown-menu extended tasks">
					<li>
						<p>
							You have 12 pending tasks
						</p>
					</li>
					<li>
						<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul style="height: 250px; overflow: hidden; width: auto;" class="dropdown-menu-list scroller">
							<li>
								<a href="#">
								<span class="task">
									<span class="desc">
										New release v1.2
									</span>
									<span class="percent">
										30%
									</span>
								</span>
								<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-success" style="width: 40%;">
										<span class="sr-only">
											40% Complete
										</span>
									</span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
									<span class="desc">
										Application deployment
									</span>
									<span class="percent">
										65%
									</span>
								</span>
								<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" class="progress-bar progress-bar-danger" style="width: 65%;">
										<span class="sr-only">
											65% Complete
										</span>
									</span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
									<span class="desc">
										Mobile app release
									</span>
									<span class="percent">
										98%
									</span>
								</span>
								<span class="progress">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="98" class="progress-bar progress-bar-success" style="width: 98%;">
										<span class="sr-only">
											98% Complete
										</span>
									</span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
									<span class="desc">
										Database migration
									</span>
									<span class="percent">
										10%
									</span>
								</span>
								<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" class="progress-bar progress-bar-warning" style="width: 10%;">
										<span class="sr-only">
											10% Complete
										</span>
									</span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
									<span class="desc">
										Web server upgrade
									</span>
									<span class="percent">
										58%
									</span>
								</span>
								<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="58" class="progress-bar progress-bar-info" style="width: 58%;">
										<span class="sr-only">
											58% Complete
										</span>
									</span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
									<span class="desc">
										Mobile development
									</span>
									<span class="percent">
										85%
									</span>
								</span>
								<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="85" class="progress-bar progress-bar-success" style="width: 85%;">
										<span class="sr-only">
											85% Complete
										</span>
									</span>
								</span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="task">
									<span class="desc">
										New UI release
									</span>
									<span class="percent">
										18%
									</span>
								</span>
								<span class="progress progress-striped">
									<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="18" class="progress-bar progress-bar-important" style="width: 18%;">
										<span class="sr-only">
											18% Complete
										</span>
									</span>
								</span>
								</a>
							</li>
						</ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(161, 178, 189); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; left: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div></div>
					</li>
					<li class="external">
						<a href="#">See all tasks <i class="m-icon-swapright"></i></a>
					</li>
				</ul>
			</li>
			<!-- END TODO DROPDOWN -->
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
				<img src="assets/img/avatar1_small.jpg" alt="">
				<span class="username">
					Bob Nilson
				</span>
				<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="extra_profile.html"><i class="fa fa-user"></i> My Profile</a>
					</li>
					<li>
						<a href="page_calendar.html"><i class="fa fa-calendar"></i> My Calendar</a>
					</li>
					<li>
						<a href="inbox.html"><i class="fa fa-envelope"></i> My Inbox
						<span class="badge badge-danger">
							3
						</span>
						</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-tasks"></i> My Tasks
						<span class="badge badge-success">
							7
						</span>
						</a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a id="trigger_fullscreen" href="javascript:;"><i class="fa fa-move"></i> Full Screen</a>
					</li>
					<li>
						<a href="extra_lock.html"><i class="fa fa-lock"></i> Lock Screen</a>
					</li>
					<li>
						<a href="login.html"><i class="fa fa-key"></i> Log Out</a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form method="POST" action="extra_search.html" class="sidebar-search">
						<div class="form-container">
							<div class="input-box">
								<a class="remove" href="javascript:;"></a>
								<input type="text" placeholder="Search...">
								<input type="button" value=" " class="submit">
							</div>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start ">
					<a href="index.html">
					<i class="fa fa-home"></i>
					<span class="title">
						Dashboard
					</span>
					</a>
				</li>
				<li class="">
					<a href="index_horizontal_menu.html">
					<i class="fa fa-briefcase"></i>
					<span class="title">
						Dashboard 2
					</span>
					</a>
				</li>
				<li class="active ">
					<a href="javascript:;">
					<i class="fa fa-cogs"></i>
					<span class="title">
						Layouts
					</span>
					<span class="selected">
					</span>
					<span class="arrow open">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="layout_session_timeout.html">
							<span class="badge badge-roundless badge-important">
								new
							</span>
							Session Timeout</a>
						</li>
						<li>
							<a href="layout_idle_timeout.html">
							<span class="badge badge-roundless badge-important">
								new
							</span>
							User Idle Timeout</a>
						</li>
						<li>
							<a href="layout_language_bar.html">
							Language Switch Bar</a>
						</li>
						<li>
							<a href="layout_horizontal_sidebar_menu.html">
							Horizontal &amp; Sidebar Menu</a>
						</li>
						<li>
							<a href="layout_horizontal_menu1.html">
							Horizontal Menu 1</a>
						</li>
						<li>
							<a href="layout_horizontal_menu2.html">
							Horizontal Menu 2</a>
						</li>
						<li>
							<a href="layout_search_on_header.html">
							<span class="badge badge-roundless badge-important">
								new
							</span>
							Search Box On Header</a>
						</li>
						<li>
							<a href="layout_sidebar_toggler_on_header.html">
							Sidebar Toggler On Header</a>
						</li>
						<li>
							<a href="layout_sidebar_reversed.html">
							<span class="badge badge-roundless badge-success">
								new
							</span>
							Left Sidebar Page</a>
						</li>
						<li>
							<a href="layout_sidebar_fixed.html">
							Sidebar Fixed Page</a>
						</li>
						<li>
							<a href="layout_sidebar_closed.html">
							Sidebar Closed Page</a>
						</li>
						<li>
							<a href="layout_disabled_menu.html">
							Disabled Menu Links</a>
						</li>
						<li class="active">
							<a href="layout_blank_page.html">
							Blank Page</a>
						</li>
						<li>
							<a href="layout_boxed_page.html">
							Boxed Page</a>
						</li>
						<li>
							<a href="layout_boxed_not_responsive.html">
							Non-Responsive Boxed Layout</a>
						</li>
						<li>
							<a href="layout_promo.html">
							Promo Page</a>
						</li>
						<li>
							<a href="layout_email.html">
							Email Templates</a>
						</li>
						<li>
							<a href="layout_ajax.html">
							Content Loading via Ajax</a>
						</li>
					</ul>
				</li>
				<li data-original-title="Frontend&nbsp;Theme For&nbsp;Metronic&nbsp;Admin" data-placement="left" class="tooltips" id="frontend-link">
					<a target="_blank" href="http://keenthemes.com/preview/index.php?theme=metronic_frontend">
					<i class="fa fa-gift"></i>
					<span class="title">
						Frontend Theme
					</span>
					</a>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-bookmark-o"></i>
					<span class="title">
						UI Features
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="ui_general.html">
							General</a>
						</li>
						<li>
							<a href="ui_buttons.html">
							Buttons &amp; Icons</a>
						</li>
						<li>
							<a href="ui_typography.html">
							Typography</a>
						</li>
						<li>
							<a href="ui_modals.html">
							Modals</a>
						</li>
						<li>
							<a href="ui_extended_modals.html">
							Extended Modals</a>
						</li>
						<li>
							<a href="ui_tabs_accordions_navs.html">
							Tabs, Accordions &amp; Navs</a>
						</li>
						<li>
							<a href="ui_datepaginator.html">
							<span class="badge badge-roundless badge-success">
								new
							</span>
							Date Paginator</a>
						</li>
						<li>
							<a href="ui_bootbox.html">
							<span class="badge badge-roundless badge-important">
								new
							</span>
							Bootbox Dialogs</a>
						</li>
						<li>
							<a href="ui_tiles.html">
							Tiles</a>
						</li>
						<li>
							<a href="ui_toastr.html">
							Toastr Notifications</a>
						</li>
						<li>
							<a href="ui_tree.html">
							Tree View</a>
						</li>
						<li>
							<a href="ui_nestable.html">
							Nestable List</a>
						</li>
						<li>
							<a href="ui_ion_sliders.html">
							Ion Range Sliders</a>
						</li>
						<li>
							<a href="ui_noui_sliders.html">
							NoUI Range Sliders</a>
						</li>
						<li>
							<a href="ui_jqueryui_sliders.html">
							jQuery UI Sliders</a>
						</li>
						<li>
							<a href="ui_knob.html">
							Knob Circle Dials</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-table"></i>
					<span class="title">
						Form Stuff
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="form_controls.html">
							Form Controls</a>
						</li>
						<li>
							<a href="form_layouts.html">
							Form Layouts</a>
						</li>
						<li>
							<a href="form_component.html">
							Form Components</a>
						</li>
						<li>
							<a href="form_editable.html">
							<span class="badge badge-roundless badge-warning">
								new
							</span>
							Form X-editable</a>
						</li>
						<li>
							<a href="form_wizard.html">
							Form Wizard</a>
						</li>
						<li>
							<a href="form_validation.html">
							Form Validation</a>
						</li>
						<li>
							<a href="form_image_crop.html">
							<span class="badge badge-roundless badge-important">
								new
							</span>
							Image Cropping</a>
						</li>
						<li>
							<a href="form_fileupload.html">
							Multiple File Upload</a>
						</li>
						<li>
							<a href="form_dropzone.html">
							Dropzone File Upload</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-sitemap"></i>
					<span class="title">
						Pages
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="page_portfolio.html">
							<i class="fa fa-briefcase"></i>
							<span class="badge badge-warning badge-roundless">
								new
							</span>
							Portfolio</a>
						</li>
						<li>
							<a href="page_timeline.html">
							<i class="fa fa-clock-o"></i>
							<span class="badge badge-info">
								4
							</span>
							Timeline</a>
						</li>
						<li>
							<a href="page_coming_soon.html">
							<i class="fa fa-cogs"></i>
							Coming Soon</a>
						</li>
						<li>
							<a href="page_blog.html">
							<i class="fa fa-comments"></i>
							Blog</a>
						</li>
						<li>
							<a href="page_blog_item.html">
							<i class="fa fa-font"></i>
							Blog Post</a>
						</li>
						<li>
							<a href="page_news.html">
							<i class="fa fa-coffee"></i>
							<span class="badge badge-success">
								9
							</span>
							News</a>
						</li>
						<li>
							<a href="page_news_item.html">
							<i class="fa fa-bell"></i>
							News View</a>
						</li>
						<li>
							<a href="page_about.html">
							<i class="fa fa-group"></i>
							About Us</a>
						</li>
						<li>
							<a href="page_contact.html">
							<i class="fa fa-envelope-o"></i>
							Contact Us</a>
						</li>
						<li>
							<a href="page_calendar.html">
							<i class="fa fa-calendar"></i>
							<span class="badge badge-important">
								14
							</span>
							Calendar</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-gift"></i>
					<span class="title">
						Extra
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="extra_profile.html">
							User Profile</a>
						</li>
						<li>
							<a href="extra_lock.html">
							Lock Screen</a>
						</li>
						<li>
							<a href="extra_faq.html">
							FAQ</a>
						</li>
						<li>
							<a href="inbox.html">
							<span class="badge badge-important">
								4
							</span>
							Inbox</a>
						</li>
						<li>
							<a href="extra_search.html">
							Search Results</a>
						</li>
						<li>
							<a href="extra_invoice.html">
							Invoice</a>
						</li>
						<li>
							<a href="extra_pricing_table.html">
							Pricing Tables</a>
						</li>
						<li>
							<a href="extra_404_option1.html">
							404 Page Option 1</a>
						</li>
						<li>
							<a href="extra_404_option2.html">
							404 Page Option 2</a>
						</li>
						<li>
							<a href="extra_404_option3.html">
							404 Page Option 3</a>
						</li>
						<li>
							<a href="extra_500_option1.html">
							500 Page Option 1</a>
						</li>
						<li>
							<a href="extra_500_option2.html">
							500 Page Option 2</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;" class="active">
					<i class="fa fa-leaf"></i>
					<span class="title">
						3 Level Menu
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
							Item 1
							<span class="arrow">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">Sample Link 1</a>
								</li>
								<li>
									<a href="#">Sample Link 2</a>
								</li>
								<li>
									<a href="#">Sample Link 3</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							Item 1
							<span class="arrow">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#">Sample Link 1</a>
								</li>
								<li>
									<a href="#">Sample Link 1</a>
								</li>
								<li>
									<a href="#">Sample Link 1</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#">
							Item 3 </a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">
					<i class="fa fa-folder-open"></i>
					<span class="title">
						4 Level Menu
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
							<i class="fa fa-cogs"></i> Item 1
							<span class="arrow">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="javascript:;">
									<i class="fa fa-user"></i>
									Sample Link 1
									<span class="arrow">
									</span>
									</a>
									<ul class="sub-menu">
										<li>
											<a href="#"><i class="fa fa-remove"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-pencil"></i> Sample Link 1</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-edit"></i> Sample Link 1</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="fa fa-user"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-external-link"></i> Sample Link 2</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-bell"></i> Sample Link 3</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							<i class="fa fa-globe"></i> Item 2
							<span class="arrow">
							</span>
							</a>
							<ul class="sub-menu">
								<li>
									<a href="#"><i class="fa fa-user"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-external-link"></i> Sample Link 1</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-bell"></i> Sample Link 1</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#">
							<i class="fa fa-folder-open"></i>
							Item 3 </a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-user"></i>
					<span class="title">
						Login Options
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="login.html">
							Login Form 1</a>
						</li>
						<li>
							<a href="login_soft.html">
							Login Form 2</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-th"></i>
					<span class="title">
						Data Tables
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="table_basic.html">
							Basic Datatables</a>
						</li>
						<li>
							<a href="table_responsive.html">
							Responsive Datatables</a>
						</li>
						<li>
							<a href="table_managed.html">
							Managed Datatables</a>
						</li>
						<li>
							<a href="table_editable.html">
							Editable Datatables</a>
						</li>
						<li>
							<a href="table_advanced.html">
							Advanced Datatables</a>
						</li>
						<li>
							<a href="table_ajax.html">
							Ajax Datatables</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-file-text"></i>
					<span class="title">
						Portlets
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="portlet_general.html">
							General Portlets</a>
						</li>
						<li>
							<a href="portlet_draggable.html">
							Draggable Portlets</a>
						</li>
					</ul>
				</li>
				<li class="">
					<a href="javascript:;">
					<i class="fa fa-map-marker"></i>
					<span class="title">
						Maps
					</span>
					<span class="arrow ">
					</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="maps_google.html">
							Google Maps</a>
						</li>
						<li>
							<a href="maps_vector.html">
							Vector Maps</a>
						</li>
					</ul>
				</li>
				<li class="last ">
					<a href="charts.html">
					<i class="fa fa-bar-chart-o"></i>
					<span class="title">
						Visual Charts
					</span>
					</a>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content" style="min-height:1358px !important">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="portlet-config" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button class="btn blue" type="button">Save changes</button>
							<button data-dismiss="modal" class="btn default" type="button">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
				<div class="toggler-close">
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
							THEME COLOR
						</span>
						<ul>
							<li data-style="default" class="color-black current color-default">
							</li>
							<li data-style="blue" class="color-blue">
							</li>
							<li data-style="brown" class="color-brown">
							</li>
							<li data-style="purple" class="color-purple">
							</li>
							<li data-style="grey" class="color-grey">
							</li>
							<li data-style="light" class="color-white color-light">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
							Layout
						</span>
						<select class="layout-option form-control input-small">
							<option selected="selected" value="fluid">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							Header
						</span>
						<select class="header-option form-control input-small">
							<option selected="selected" value="fixed">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							Sidebar
						</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option selected="selected" value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							Sidebar Position
						</span>
						<select class="sidebar-pos-option form-control input-small">
							<option selected="selected" value="left">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							Footer
						</span>
						<select class="footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option selected="selected" value="default">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					<small>blank page</small>
					Blank Page</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
							<button data-close-others="true" data-delay="1000" data-hover="dropdown" data-toggle="dropdown" class="btn blue dropdown-toggle" type="button">
							<span>
								Actions
							</span>
							<i class="fa fa-angle-down"></i>
							</button>
							<ul role="menu" class="dropdown-menu pull-right">
								<li>
									<a href="#">Action</a>
								</li>
								<li>
									<a href="#">Another action</a>
								</li>
								<li>
									<a href="#">Something else here</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#">Separated link</a>
								</li>
							</ul>
						</li>
						<li>
							<i class="fa fa-home"></i>
							<a href="index.html">Home</a>
							<i class="fa fa-angle-left"></i>
						</li>
						<li>
							<a href="#">Layouts</a>
							<i class="fa fa-angle-left"></i>
						</li>
						<li>
							<a href="#">Blank Page</a>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="row">
				<div class="col-md-12">

					<div class="tabbable tabbable-custom boxless">
						<ul class="nav nav-tabs">
							<li class="active">
								<a data-toggle="tab" href="#tab_0">Form Actions</a>
							</li>
							<li>
								<a data-toggle="tab" href="#tab_1">2 Columns</a>
							</li>
							<li>
								<a data-toggle="tab" href="#tab_2">2 Columns Horizontal</a>
							</li>
							<li>
								<a data-toggle="tab" href="#tab_3">2 Columns View Only</a>
							</li>
							<li>
								<a data-toggle="tab" href="#tab_4">Row Seperated</a>
							</li>
							<li>
								<a data-toggle="tab" href="#tab_5">Bordered</a>
							</li>
							<li>
								<a data-toggle="tab" href="#tab_6">Row Stripped</a>
							</li>
							<li>
								<a data-toggle="tab" href="#tab_7">Label Stripped</a>
							</li>
						</ul>
						<div class="tab-content">
							<div id="tab_0" class="tab-pane active">
								<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Actions On Bottom
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="form-horizontal" action="#">
											<div class="form-body">
											<div class="make-switch switch-large has-switch">
													<div class="switch-on"><input type="checkbox" class="toggle" checked=""><span class="switch-left switch-large">ON</span><label class="switch-large">&nbsp;</label><span class="switch-right switch-large">OFF</span></div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Text</label>
													<div class="col-md-4">
														<input type="text" placeholder="Enter text" class="form-control">
														<span class="help-block">
															A block of help text.
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Email Address</label>
													<div class="col-md-4">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-envelope"></i>
															</span>
															<input type="email" placeholder="Email Address" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Password</label>
													<div class="col-md-4">
														<div class="input-group">
															<input type="password" placeholder="Password" class="form-control">
															<span class="input-group-addon">
																<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Left Icon</label>
													<div class="col-md-4">
														<div class="input-icon">
															<i class="fa fa-bell-o"></i>
															<input type="text" placeholder="Left icon" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Right Icon</label>
													<div class="col-md-4">
														<div class="input-icon right">
															<i class="fa fa-microphone"></i>
															<input type="text" placeholder="Right icon" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Input With Spinner</label>
													<div class="col-md-4">
														<input type="password" placeholder="Password" class="form-control spinner">
													</div>
												</div>
												<div class="form-group last">
													<label class="col-md-3 control-label">Static Control</label>
													<div class="col-md-4">
														<p class="form-control-static">
															email@example.com
														</p>
													</div>
												</div>
											</div>
											<div class="form-actions fluid">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn blue" type="submit">Submit</button>
													<button class="btn default" type="button">Cancel</button>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Actions On Top
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="form-horizontal" action="#">
											<div class="form-actions top fluid ">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn green" type="submit">Submit</button>
													<button class="btn default" type="button">Cancel</button>
												</div>
											</div>
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Text</label>
													<div class="col-md-4">
														<input type="text" placeholder="Enter text" class="form-control">
														<span class="help-block">
															A block of help text.
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Email Address</label>
													<div class="col-md-4">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-envelope"></i>
															</span>
															<input type="email" placeholder="Email Address" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Password</label>
													<div class="col-md-4">
														<div class="input-group">
															<input type="password" placeholder="Password" class="form-control">
															<span class="input-group-addon">
																<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Left Icon</label>
													<div class="col-md-4">
														<div class="input-icon">
															<i class="fa fa-bell-o"></i>
															<input type="text" placeholder="Left icon" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Right Icon</label>
													<div class="col-md-4">
														<div class="input-icon right">
															<i class="fa fa-microphone"></i>
															<input type="text" placeholder="Right icon" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Input With Spinner</label>
													<div class="col-md-4">
														<input type="password" placeholder="Password" class="form-control spinner">
													</div>
												</div>
												<div class="form-group last">
													<label class="col-md-3 control-label">Static Control</label>
													<div class="col-md-4">
														<p class="form-control-static">
															email@example.com
														</p>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
								<div class="portlet box yellow">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Actions On Top &amp; Bottom
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="form-horizontal" action="#">
											<div class="form-actions top fluid">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn green" type="submit">Submit</button>
													<button class="btn default" type="button">Cancel</button>
												</div>
											</div>
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Text</label>
													<div class="col-md-4">
														<input type="text" placeholder="Enter text" class="form-control">
														<span class="help-block">
															A block of help text.
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Email Address</label>
													<div class="col-md-4">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-envelope"></i>
															</span>
															<input type="email" placeholder="Email Address" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Password</label>
													<div class="col-md-4">
														<div class="input-group">
															<input type="password" placeholder="Password" class="form-control">
															<span class="input-group-addon">
																<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Left Icon</label>
													<div class="col-md-4">
														<div class="input-icon">
															<i class="fa fa-bell-o"></i>
															<input type="text" placeholder="Left icon" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Right Icon</label>
													<div class="col-md-4">
														<div class="input-icon right">
															<i class="fa fa-microphone"></i>
															<input type="text" placeholder="Right icon" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Input With Spinner</label>
													<div class="col-md-4">
														<input type="password" placeholder="Password" class="form-control spinner">
													</div>
												</div>
												<div class="form-group last">
													<label class="col-md-3 control-label">Static Control</label>
													<div class="col-md-4">
														<p class="form-control-static">
															email@example.com
														</p>
													</div>
												</div>
											</div>
											<div class="form-actions fluid">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn green" type="submit">Submit</button>
													<button class="btn default" type="button">Cancel</button>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
								<div class="portlet box purple">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Actions Without Background Color
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="form-horizontal" action="#">
											<div class="form-actions top nobg fluid">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn green" type="submit">Submit</button>
													<button class="btn default" type="button">Cancel</button>
												</div>
											</div>
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-3 control-label">Text</label>
													<div class="col-md-4">
														<input type="text" placeholder="Enter text" class="form-control">
														<span class="help-block">
															A block of help text.
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Email Address</label>
													<div class="col-md-4">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-envelope"></i>
															</span>
															<input type="email" placeholder="Email Address" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Password</label>
													<div class="col-md-4">
														<div class="input-group">
															<input type="password" placeholder="Password" class="form-control">
															<span class="input-group-addon">
																<i class="fa fa-user"></i>
															</span>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Left Icon</label>
													<div class="col-md-4">
														<div class="input-icon">
															<i class="fa fa-bell-o"></i>
															<input type="text" placeholder="Left icon" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Right Icon</label>
													<div class="col-md-4">
														<div class="input-icon right">
															<i class="fa fa-microphone"></i>
															<input type="text" placeholder="Right icon" class="form-control">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Input With Spinner</label>
													<div class="col-md-4">
														<input type="password" placeholder="Password" class="form-control spinner">
													</div>
												</div>
												<div class="form-group last">
													<label class="col-md-3 control-label">Static Control</label>
													<div class="col-md-4">
														<p class="form-control-static">
															email@example.com
														</p>
													</div>
												</div>
											</div>
											<div class="form-actions nobg fluid">
												<div class="col-md-offset-3 col-md-9">
													<button class="btn green" type="submit">Submit</button>
													<button class="btn default" type="button">Cancel</button>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="portlet box red">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-reorder"></i>Left Aligned
												</div>
												<div class="tools">
													<a class="collapse" href="javascript:;"></a>
													<a class="config" data-toggle="modal" href="#portlet-config"></a>
													<a class="reload" href="javascript:;"></a>
													<a class="remove" href="javascript:;"></a>
												</div>
											</div>
											<div class="portlet-body form">
												<!-- BEGIN FORM-->
												<form action="#">
													<div class="form-actions top">
														<button class="btn green" type="submit">Submit</button>
														<button class="btn default" type="button">Cancel</button>
													</div>
													<div class="form-body">
														<div class="form-group">
															<label class="control-label">Text</label>
															<input type="text" placeholder="Enter text" class="form-control">
															<span class="help-block">
																A block of help text.
															</span>
														</div>
														<div class="form-group">
															<label class="control-label">Email Address</label>
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-envelope"></i>
																</span>
																<input type="email" placeholder="Email Address" class="form-control">
															</div>
														</div>
														<div class="form-group">
															<label class="control-label">Password</label>
															<div class="input-group">
																<input type="password" placeholder="Password" class="form-control">
																<span class="input-group-addon">
																	<i class="fa fa-user"></i>
																</span>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label">Left Icon</label>
															<div class="input-icon">
																<i class="fa fa-bell-o"></i>
																<input type="text" placeholder="Left icon" class="form-control">
															</div>
														</div>
														<div class="form-group">
															<label class="control-label">Right Icon</label>
															<div class="input-icon right">
																<i class="fa fa-microphone"></i>
																<input type="text" placeholder="Right icon" class="form-control">
															</div>
														</div>
														<div class="form-group">
															<label class="control-label">Input With Spinner</label>
															<input type="password" placeholder="Password" class="form-control spinner">
														</div>
														<div class="form-group last">
															<label class="control-label">Static Control</label>
															<p class="form-control-static">
																email@example.com
															</p>
														</div>
													</div>
													<div class="form-actions">
														<button class="btn green" type="submit">Submit</button>
														<button class="btn default" type="button">Cancel</button>
													</div>
												</form>
												<!-- END FORM-->
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="portlet box purple">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-reorder"></i>Right Aligned
												</div>
												<div class="tools">
													<a class="collapse" href="javascript:;"></a>
													<a class="config" data-toggle="modal" href="#portlet-config"></a>
													<a class="reload" href="javascript:;"></a>
													<a class="remove" href="javascript:;"></a>
												</div>
											</div>
											<div class="portlet-body form">
												<!-- BEGIN FORM-->
												<form class="" action="#">
													<div class="form-actions top right">
														<button class="btn green" type="submit">Submit</button>
														<button class="btn default" type="button">Cancel</button>
													</div>
													<div class="form-body">
														<div class="form-group">
															<label class="control-label">Text</label>
															<input type="text" placeholder="Enter text" class="form-control">
															<span class="help-block">
																A block of help text.
															</span>
														</div>
														<div class="form-group">
															<label class="control-label">Email Address</label>
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-envelope"></i>
																</span>
																<input type="email" placeholder="Email Address" class="form-control">
															</div>
														</div>
														<div class="form-group">
															<label class="control-label">Password</label>
															<div class="input-group">
																<input type="password" placeholder="Password" class="form-control">
																<span class="input-group-addon">
																	<i class="fa fa-user"></i>
																</span>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label">Left Icon</label>
															<div class="input-icon">
																<i class="fa fa-bell-o"></i>
																<input type="text" placeholder="Left icon" class="form-control">
															</div>
														</div>
														<div class="form-group">
															<label class="control-label">Right Icon</label>
															<div class="input-icon right">
																<i class="fa fa-microphone"></i>
																<input type="text" placeholder="Right icon" class="form-control">
															</div>
														</div>
														<div class="form-group">
															<label class="control-label">Input With Spinner</label>
															<input type="password" placeholder="Password" class="form-control spinner">
														</div>
														<div class="form-group last">
															<label class="control-label">Static Control</label>
															<p class="form-control-static">
																email@example.com
															</p>
														</div>
													</div>
													<div class="form-actions right">
														<button class="btn green" type="submit">Submit</button>
														<button class="btn default" type="button">Cancel</button>
													</div>
												</form>
												<!-- END FORM-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="tab_1" class="tab-pane">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Sample
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="horizontal-form" action="#">
											<div class="form-body">
												<h3 class="form-section">Person Info</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">First Name</label>
															<input type="text" placeholder="Chee Kin" class="form-control" id="firstName">
															<span class="help-block">
																This is inline help
															</span>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group has-error">
															<label class="control-label">Last Name</label>
															<input type="text" placeholder="Lim" class="form-control" id="lastName">
															<span class="help-block">
																This field has error.
															</span>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Gender</label>
															<select class="form-control">
																<option value="">Male</option>
																<option value="">Female</option>
															</select>
															<span class="help-block">
																Select your gender
															</span>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Date of Birth</label>
															<input type="text" placeholder="dd/mm/yyyy" class="form-control">
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Category</label>
															<div class="select2-container select2_category form-control" id="s2id_autogen1"><a tabindex="-1" class="select2-choice" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Category 1</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen2" tabindex="1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><select tabindex="-1" data-placeholder="Choose a Category" class="select2_category form-control select2-offscreen">
																<option value="Category 1">Category 1</option>
																<option value="Category 2">Category 2</option>
																<option value="Category 3">Category 5</option>
																<option value="Category 4">Category 4</option>
															</select>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">Membership</label>
															<div class="radio-list">
																<label class="radio-inline">
																<div class="radio" id="uniform-optionsRadios1"><span class="checked"><input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"></span></div> Option 1 </label>
																<label class="radio-inline">
																<div class="radio" id="uniform-optionsRadios2"><span><input type="radio" value="option2" id="optionsRadios2" name="optionsRadios"></span></div> Option 2 </label>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<h3 class="form-section">Address</h3>
												<div class="row">
													<div class="col-md-12 ">
														<div class="form-group">
															<label>Street</label>
															<input type="text" class="form-control">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>City</label>
															<input type="text" class="form-control">
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label>State</label>
															<input type="text" class="form-control">
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Post Code</label>
															<input type="text" class="form-control">
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label>Country</label>
															<select class="form-control">
															</select>
														</div>
													</div>
													<!--/span-->
												</div>
											</div>
											<div class="form-actions right">
												<button class="btn default" type="button">Cancel</button>
												<button class="btn blue" type="submit"><i class="fa fa-check"></i> Save</button>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
							<div id="tab_2" class="tab-pane ">
								<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Sample
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="form-horizontal" action="#">
											<div class="form-body">
												<h3 class="form-section">Person Info</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">First Name</label>
															<div class="col-md-9">
																<input type="text" placeholder="Chee Kin" class="form-control">
																<span class="help-block">
																	This is inline help
																</span>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group has-error">
															<label class="control-label col-md-3">Last Name</label>
															<div class="col-md-9">
																<input type="text" placeholder="Lim" class="form-control">
																<span class="help-block">
																	This field has error.
																</span>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Gender</label>
															<div class="col-md-9">
																<select class="form-control">
																	<option value="">Male</option>
																	<option value="">Female</option>
																</select>
																<span class="help-block">
																	Select your gender.
																</span>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Date of Birth</label>
															<div class="col-md-9">
																<input type="text" placeholder="dd/mm/yyyy" class="form-control">
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Category</label>
															<div class="col-md-9">
																<div class="select2-container select2_category form-control" id="s2id_autogen3"><a tabindex="-1" class="select2-choice" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Category 1</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen4" tabindex="1"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><select tabindex="-1" data-placeholder="Choose a Category" class="select2_category form-control select2-offscreen">
																	<option value="Category 1">Category 1</option>
																	<option value="Category 2">Category 2</option>
																	<option value="Category 3">Category 5</option>
																	<option value="Category 4">Category 4</option>
																</select>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Membership</label>
															<div class="col-md-9">
																<div class="radio-list">
																	<label class="radio-inline">
																	<div class="radio"><span><input type="radio" value="option1" name="optionsRadios2"></span></div>
																	Free </label>
																	<label class="radio-inline">
																	<div class="radio"><span class="checked"><input type="radio" checked="" value="option2" name="optionsRadios2"></span></div>
																	Professional </label>
																</div>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<h3 class="form-section">Address</h3>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Address 1</label>
															<div class="col-md-9">
																<input type="text" class="form-control">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Address 2</label>
															<div class="col-md-9">
																<input type="text" class="form-control">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">City</label>
															<div class="col-md-9">
																<input type="text" class="form-control">
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">State</label>
															<div class="col-md-9">
																<input type="text" class="form-control">
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Post Code</label>
															<div class="col-md-9">
																<input type="text" class="form-control">
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Country</label>
															<div class="col-md-9">
																<select class="form-control">
																	<option>Country 1</option>
																	<option>Country 2</option>
																</select>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
															<button class="btn green" type="submit">Submit</button>
															<button class="btn default" type="button">Cancel</button>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
							<div id="tab_3" class="tab-pane ">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Sample
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form role="form" class="form-horizontal">
											<div class="form-body">
												<h2 class="margin-bottom-20"> View User Info - Bob Nilson </h2>
												<h3 class="form-section">Person Info</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">First Name:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	Bob
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Last Name:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	Nilson
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Gender:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	Male
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Date of Birth:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	20.01.1984
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Category:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	Category1
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Membership:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	Free
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<h3 class="form-section">Address</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Address:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	#24 Sun Park Avenue, Rolton Str
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">City:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	New York
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">State:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	New York
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Post Code:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	457890
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Country:</label>
															<div class="col-md-9">
																<p class="form-control-static">
																	USA
																</p>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-6">
														<div class="col-md-offset-3 col-md-9">
															<button class="btn green" type="submit"><i class="fa fa-pencil"></i> Edit</button>
															<button class="btn default" type="button">Cancel</button>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
							<div id="tab_4" class="tab-pane">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Sample
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="form-horizontal form-row-seperated" action="#">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3">First Name</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="small">
														<span class="help-block">
															This is inline help
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Last Name</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="medium">
														<span class="help-block">
															This is inline help
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Gender</label>
													<div class="col-md-9">
														<select class="form-control">
															<option value="">Male</option>
															<option value="">Female</option>
														</select>
														<span class="help-block">
															Select your gender.
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Date of Birth</label>
													<div class="col-md-9">
														<input type="text" placeholder="dd/mm/yyyy" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Category</label>
													<div class="col-md-9">
														<div class="select2-container form-control select2_category" id="s2id_autogen5"><a tabindex="-1" class="select2-choice" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Category 1</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen6"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><select class="form-control select2_category select2-offscreen" tabindex="-1">
															<option value="Category 1">Category 1</option>
															<option value="Category 2">Category 2</option>
															<option value="Category 3">Category 5</option>
															<option value="Category 4">Category 4</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Multi-Value Select</label>
													<div class="col-md-9">
														<div class="select2-container select2-container-multi form-control select2_sample1" id="s2id_autogen13"><ul class="select2-choices">  <li class="select2-search-field">    <input type="text" class="select2-input select2-default" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" id="s2id_autogen14" style="width: 112%;">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none">   <ul class="select2-results">   <li class="select2-no-results">No matches found</li></ul></div></div><select multiple="" class="form-control select2_sample1 select2-offscreen" tabindex="-1">
															<optgroup label="NFC EAST">
															<option>Dallas Cowboys</option>
															<option>New York Giants</option>
															<option>Philadelphia Eagles</option>
															<option>Washington Redskins</option>
															</optgroup>
															<optgroup label="NFC NORTH">
															<option>Chicago Bears</option>
															<option>Detroit Lions</option>
															<option>Green Bay Packers</option>
															<option>Minnesota Vikings</option>
															</optgroup>
															<optgroup label="NFC SOUTH">
															<option>Atlanta Falcons</option>
															<option>Carolina Panthers</option>
															<option>New Orleans Saints</option>
															<option>Tampa Bay Buccaneers</option>
															</optgroup>
															<optgroup label="NFC WEST">
															<option>Arizona Cardinals</option>
															<option>St. Louis Rams</option>
															<option>San Francisco 49ers</option>
															<option>Seattle Seahawks</option>
															</optgroup>
															<optgroup label="AFC EAST">
															<option>Buffalo Bills</option>
															<option>Miami Dolphins</option>
															<option>New England Patriots</option>
															<option>New York Jets</option>
															</optgroup>
															<optgroup label="AFC NORTH">
															<option>Baltimore Ravens</option>
															<option>Cincinnati Bengals</option>
															<option>Cleveland Browns</option>
															<option>Pittsburgh Steelers</option>
															</optgroup>
															<optgroup label="AFC SOUTH">
															<option>Houston Texans</option>
															<option>Indianapolis Colts</option>
															<option>Jacksonville Jaguars</option>
															<option>Tennessee Titans</option>
															</optgroup>
															<optgroup label="AFC WEST">
															<option>Denver Broncos</option>
															<option>Kansas City Chiefs</option>
															<option>Oakland Raiders</option>
															<option>San Diego Chargers</option>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Loading Data</label>
													<div class="col-md-9">
														<div class="select2-container form-control select2_sample2" id="s2id_autogen21"><a tabindex="-1" class="select2-choice select2-default" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Type to select an option</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen22"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><input type="hidden" class="form-control select2_sample2 select2-offscreen" tabindex="-1">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Tags Support List</label>
													<div class="col-md-9">
														<div class="select2-container select2-container-multi form-control select2_sample3" id="s2id_autogen29"><ul class="select2-choices">  <li class="select2-search-choice">    <div>red</div>    <a tabindex="-1" class="select2-search-choice-close" onclick="return false;" href="#"></a></li><li class="select2-search-choice">    <div>blue</div>    <a tabindex="-1" class="select2-search-choice-close" onclick="return false;" href="#"></a></li><li class="select2-search-field">    <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" id="s2id_autogen30" style="width: 22px;">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none">   <ul class="select2-results">   </ul></div></div><input type="hidden" value="red,blue" class="form-control select2_sample3 select2-offscreen" tabindex="-1">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Membership</label>
													<div class="col-md-9">
														<div class="radio-list">
															<label>
															<div class="radio"><span><input type="radio" value="option1" name="optionsRadios2"></span></div>
															Free </label>
															<label>
															<div class="radio"><span class="checked"><input type="radio" checked="" value="option2" name="optionsRadios2"></span></div>
															Professional </label>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Street</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">City</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">State</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Post Code</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group last">
													<label class="control-label col-md-3">Country</label>
													<div class="col-md-9">
														<select class="form-control">
														</select>
													</div>
												</div>
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-offset-3 col-md-9">
															<button class="btn green" type="submit"><i class="fa fa-pencil"></i> Edit</button>
															<button class="btn default" type="button">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
							<div id="tab_5" class="tab-pane">
								<div class="portlet box blue ">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Sample
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="form-horizontal form-bordered" action="#">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3">First Name</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="small">
														<span class="help-block">
															This is inline help
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Last Name</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="medium">
														<span class="help-block">
															This is inline help
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Gender</label>
													<div class="col-md-9">
														<select class="form-control">
															<option value="">Male</option>
															<option value="">Female</option>
														</select>
														<span class="help-block">
															Select your gender.
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Date of Birth</label>
													<div class="col-md-9">
														<input type="text" placeholder="dd/mm/yyyy" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Category</label>
													<div class="col-md-9">
														<div class="select2-container form-control select2_category" id="s2id_autogen7"><a tabindex="-1" class="select2-choice" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Category 1</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen8"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><select class="form-control select2_category select2-offscreen" tabindex="-1">
															<option value="Category 1">Category 1</option>
															<option value="Category 2">Category 2</option>
															<option value="Category 3">Category 5</option>
															<option value="Category 4">Category 4</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Multi-Value Select</label>
													<div class="col-md-9">
														<div class="select2-container select2-container-multi form-control select2_sample1" id="s2id_autogen15"><ul class="select2-choices">  <li class="select2-search-field">    <input type="text" class="select2-input select2-default" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" id="s2id_autogen16" style="width: 112%;">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none">   <ul class="select2-results">   <li class="select2-no-results">No matches found</li></ul></div></div><select multiple="" class="form-control select2_sample1 select2-offscreen" tabindex="-1">
															<optgroup label="NFC EAST">
															<option>Dallas Cowboys</option>
															<option>New York Giants</option>
															<option>Philadelphia Eagles</option>
															<option>Washington Redskins</option>
															</optgroup>
															<optgroup label="NFC NORTH">
															<option>Chicago Bears</option>
															<option>Detroit Lions</option>
															<option>Green Bay Packers</option>
															<option>Minnesota Vikings</option>
															</optgroup>
															<optgroup label="NFC SOUTH">
															<option>Atlanta Falcons</option>
															<option>Carolina Panthers</option>
															<option>New Orleans Saints</option>
															<option>Tampa Bay Buccaneers</option>
															</optgroup>
															<optgroup label="NFC WEST">
															<option>Arizona Cardinals</option>
															<option>St. Louis Rams</option>
															<option>San Francisco 49ers</option>
															<option>Seattle Seahawks</option>
															</optgroup>
															<optgroup label="AFC EAST">
															<option>Buffalo Bills</option>
															<option>Miami Dolphins</option>
															<option>New England Patriots</option>
															<option>New York Jets</option>
															</optgroup>
															<optgroup label="AFC NORTH">
															<option>Baltimore Ravens</option>
															<option>Cincinnati Bengals</option>
															<option>Cleveland Browns</option>
															<option>Pittsburgh Steelers</option>
															</optgroup>
															<optgroup label="AFC SOUTH">
															<option>Houston Texans</option>
															<option>Indianapolis Colts</option>
															<option>Jacksonville Jaguars</option>
															<option>Tennessee Titans</option>
															</optgroup>
															<optgroup label="AFC WEST">
															<option>Denver Broncos</option>
															<option>Kansas City Chiefs</option>
															<option>Oakland Raiders</option>
															<option>San Diego Chargers</option>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Loading Data</label>
													<div class="col-md-9">
														<div class="select2-container form-control select2_sample2" id="s2id_autogen23"><a tabindex="-1" class="select2-choice select2-default" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Type to select an option</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen24"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><input type="hidden" class="form-control select2_sample2 select2-offscreen" tabindex="-1">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Tags Support List</label>
													<div class="col-md-9">
														<div class="select2-container select2-container-multi form-control select2_sample3" id="s2id_autogen31"><ul class="select2-choices">  <li class="select2-search-choice">    <div>red</div>    <a tabindex="-1" class="select2-search-choice-close" onclick="return false;" href="#"></a></li><li class="select2-search-choice">    <div>blue</div>    <a tabindex="-1" class="select2-search-choice-close" onclick="return false;" href="#"></a></li><li class="select2-search-field">    <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" id="s2id_autogen32" style="width: 22px;">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none">   <ul class="select2-results">   </ul></div></div><input type="hidden" value="red,blue" class="form-control select2_sample3 select2-offscreen" tabindex="-1">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Membership</label>
													<div class="col-md-9">
														<div class="radio-list">
															<label>
															<div class="radio"><span><input type="radio" value="option1" name="optionsRadios2"></span></div>
															Free </label>
															<label>
															<div class="radio"><span class="checked"><input type="radio" checked="" value="option2" name="optionsRadios2"></span></div>
															Professional </label>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Street</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">City</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">State</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Post Code</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group last">
													<label class="control-label col-md-3">Country</label>
													<div class="col-md-9">
														<select class="form-control">
														</select>
													</div>
												</div>
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-offset-3 col-md-9">
															<button class="btn green" type="submit"><i class="fa fa-check"></i> Submit</button>
															<button class="btn default" type="button">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
							<div id="tab_6" class="tab-pane">
								<div class="portlet box blue ">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Sample
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="form-horizontal form-bordered form-row-stripped" action="#">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3">First Name</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="small">
														<span class="help-block">
															This is inline help
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Last Name</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="medium">
														<span class="help-block">
															This is inline help
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Gender</label>
													<div class="col-md-9">
														<select class="form-control">
															<option value="">Male</option>
															<option value="">Female</option>
														</select>
														<span class="help-block">
															Select your gender.
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Date of Birth</label>
													<div class="col-md-9">
														<input type="text" placeholder="dd/mm/yyyy" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Category</label>
													<div class="col-md-9">
														<div class="select2-container form-control select2_category" id="s2id_autogen9"><a tabindex="-1" class="select2-choice" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Category 1</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen10"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><select class="form-control select2_category select2-offscreen" tabindex="-1">
															<option value="Category 1">Category 1</option>
															<option value="Category 2">Category 2</option>
															<option value="Category 3">Category 5</option>
															<option value="Category 4">Category 4</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Multi-Value Select</label>
													<div class="col-md-9">
														<div class="select2-container select2-container-multi form-control select2_sample1" id="s2id_autogen17"><ul class="select2-choices">  <li class="select2-search-field">    <input type="text" class="select2-input select2-default" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" id="s2id_autogen18" style="width: 112%;">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none">   <ul class="select2-results">   <li class="select2-no-results">No matches found</li></ul></div></div><select multiple="" class="form-control select2_sample1 select2-offscreen" tabindex="-1">
															<optgroup label="NFC EAST">
															<option>Dallas Cowboys</option>
															<option>New York Giants</option>
															<option>Philadelphia Eagles</option>
															<option>Washington Redskins</option>
															</optgroup>
															<optgroup label="NFC NORTH">
															<option>Chicago Bears</option>
															<option>Detroit Lions</option>
															<option>Green Bay Packers</option>
															<option>Minnesota Vikings</option>
															</optgroup>
															<optgroup label="NFC SOUTH">
															<option>Atlanta Falcons</option>
															<option>Carolina Panthers</option>
															<option>New Orleans Saints</option>
															<option>Tampa Bay Buccaneers</option>
															</optgroup>
															<optgroup label="NFC WEST">
															<option>Arizona Cardinals</option>
															<option>St. Louis Rams</option>
															<option>San Francisco 49ers</option>
															<option>Seattle Seahawks</option>
															</optgroup>
															<optgroup label="AFC EAST">
															<option>Buffalo Bills</option>
															<option>Miami Dolphins</option>
															<option>New England Patriots</option>
															<option>New York Jets</option>
															</optgroup>
															<optgroup label="AFC NORTH">
															<option>Baltimore Ravens</option>
															<option>Cincinnati Bengals</option>
															<option>Cleveland Browns</option>
															<option>Pittsburgh Steelers</option>
															</optgroup>
															<optgroup label="AFC SOUTH">
															<option>Houston Texans</option>
															<option>Indianapolis Colts</option>
															<option>Jacksonville Jaguars</option>
															<option>Tennessee Titans</option>
															</optgroup>
															<optgroup label="AFC WEST">
															<option>Denver Broncos</option>
															<option>Kansas City Chiefs</option>
															<option>Oakland Raiders</option>
															<option>San Diego Chargers</option>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Loading Data</label>
													<div class="col-md-9">
														<div class="select2-container form-control select2_sample2" id="s2id_autogen25"><a tabindex="-1" class="select2-choice select2-default" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Type to select an option</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen26"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><input type="hidden" class="form-control select2_sample2 select2-offscreen" tabindex="-1">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Tags Support List</label>
													<div class="col-md-9">
														<div class="select2-container select2-container-multi form-control select2_sample3" id="s2id_autogen33"><ul class="select2-choices">  <li class="select2-search-choice">    <div>red</div>    <a tabindex="-1" class="select2-search-choice-close" onclick="return false;" href="#"></a></li><li class="select2-search-choice">    <div>blue</div>    <a tabindex="-1" class="select2-search-choice-close" onclick="return false;" href="#"></a></li><li class="select2-search-field">    <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" id="s2id_autogen34" style="width: 22px;">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none">   <ul class="select2-results">   </ul></div></div><input type="hidden" value="red,blue" class="form-control select2_sample3 select2-offscreen" tabindex="-1">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Membership</label>
													<div class="col-md-9">
														<div class="radio-list">
															<label>
															<div class="radio"><span><input type="radio" value="option1" name="optionsRadios2"></span></div>
															Free </label>
															<label>
															<div class="radio"><span class="checked"><input type="radio" checked="" value="option2" name="optionsRadios2"></span></div>
															Professional </label>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Street</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">City</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">State</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Post Code</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group last">
													<label class="control-label col-md-3">Country</label>
													<div class="col-md-9">
														<select class="form-control">
														</select>
													</div>
												</div>
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-offset-3 col-md-9">
															<button class="btn green" type="submit"><i class="fa fa-check"></i> Submit</button>
															<button class="btn default" type="button">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
							<div id="tab_7" class="tab-pane">
								<div class="portlet box blue ">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-reorder"></i>Form Sample
										</div>
										<div class="tools">
											<a class="collapse" href="javascript:;"></a>
											<a class="config" data-toggle="modal" href="#portlet-config"></a>
											<a class="reload" href="javascript:;"></a>
											<a class="remove" href="javascript:;"></a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form class="form-horizontal form-bordered form-label-stripped" action="#">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3">First Name</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="small">
														<span class="help-block">
															This is inline help
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Last Name</label>
													<div class="col-md-9">
														<input type="text" class="form-control" placeholder="medium">
														<span class="help-block">
															This is inline help
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Gender</label>
													<div class="col-md-9">
														<select class="form-control">
															<option value="">Male</option>
															<option value="">Female</option>
														</select>
														<span class="help-block">
															Select your gender.
														</span>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Date of Birth</label>
													<div class="col-md-9">
														<input type="text" placeholder="dd/mm/yyyy" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Category</label>
													<div class="col-md-9">
														<div class="select2-container form-control select2_category" id="s2id_autogen11"><a tabindex="-1" class="select2-choice" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Category 1</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen12"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><select class="form-control select2_category select2-offscreen" tabindex="-1">
															<option value="Category 1">Category 1</option>
															<option value="Category 2">Category 2</option>
															<option value="Category 3">Category 5</option>
															<option value="Category 4">Category 4</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Multi-Value Select</label>
													<div class="col-md-9">
														<div class="select2-container select2-container-multi form-control select2_sample1" id="s2id_autogen19"><ul class="select2-choices">  <li class="select2-search-field">    <input type="text" class="select2-input select2-default" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" id="s2id_autogen20" style="width: 112%;">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none">   <ul class="select2-results">   <li class="select2-no-results">No matches found</li></ul></div></div><select multiple="" class="form-control select2_sample1 select2-offscreen" tabindex="-1">
															<optgroup label="NFC EAST">
															<option>Dallas Cowboys</option>
															<option>New York Giants</option>
															<option>Philadelphia Eagles</option>
															<option>Washington Redskins</option>
															</optgroup>
															<optgroup label="NFC NORTH">
															<option>Chicago Bears</option>
															<option>Detroit Lions</option>
															<option>Green Bay Packers</option>
															<option>Minnesota Vikings</option>
															</optgroup>
															<optgroup label="NFC SOUTH">
															<option>Atlanta Falcons</option>
															<option>Carolina Panthers</option>
															<option>New Orleans Saints</option>
															<option>Tampa Bay Buccaneers</option>
															</optgroup>
															<optgroup label="NFC WEST">
															<option>Arizona Cardinals</option>
															<option>St. Louis Rams</option>
															<option>San Francisco 49ers</option>
															<option>Seattle Seahawks</option>
															</optgroup>
															<optgroup label="AFC EAST">
															<option>Buffalo Bills</option>
															<option>Miami Dolphins</option>
															<option>New England Patriots</option>
															<option>New York Jets</option>
															</optgroup>
															<optgroup label="AFC NORTH">
															<option>Baltimore Ravens</option>
															<option>Cincinnati Bengals</option>
															<option>Cleveland Browns</option>
															<option>Pittsburgh Steelers</option>
															</optgroup>
															<optgroup label="AFC SOUTH">
															<option>Houston Texans</option>
															<option>Indianapolis Colts</option>
															<option>Jacksonville Jaguars</option>
															<option>Tennessee Titans</option>
															</optgroup>
															<optgroup label="AFC WEST">
															<option>Denver Broncos</option>
															<option>Kansas City Chiefs</option>
															<option>Oakland Raiders</option>
															<option>San Diego Chargers</option>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Loading Data</label>
													<div class="col-md-9">
														<div class="select2-container form-control select2_sample2" id="s2id_autogen27"><a tabindex="-1" class="select2-choice select2-default" onclick="return false;" href="javascript:void(0)">   <span class="select2-chosen">Type to select an option</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input type="text" class="select2-focusser select2-offscreen" id="s2id_autogen28"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off">   </div>   <ul class="select2-results">   </ul></div></div><input type="hidden" class="form-control select2_sample2 select2-offscreen" tabindex="-1">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Tags Support List</label>
													<div class="col-md-9">
														<div class="select2-container select2-container-multi form-control select2_sample3" id="s2id_autogen35"><ul class="select2-choices">  <li class="select2-search-choice">    <div>red</div>    <a tabindex="-1" class="select2-search-choice-close" onclick="return false;" href="#"></a></li><li class="select2-search-choice">    <div>blue</div>    <a tabindex="-1" class="select2-search-choice-close" onclick="return false;" href="#"></a></li><li class="select2-search-field">    <input type="text" class="select2-input" spellcheck="false" autocapitalize="off" autocorrect="off" autocomplete="off" id="s2id_autogen36" style="width: 22px;">  </li></ul><div class="select2-drop select2-drop-multi select2-display-none">   <ul class="select2-results">   </ul></div></div><input type="hidden" value="red,blue" class="form-control select2_sample3 select2-offscreen" tabindex="-1">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Membership</label>
													<div class="col-md-9">
														<div class="radio-list">
															<label>
															<div class="radio"><span><input type="radio" value="option1" name="optionsRadios2"></span></div>
															Free </label>
															<label>
															<div class="radio"><span class="checked"><input type="radio" checked="" value="option2" name="optionsRadios2"></span></div>
															Professional </label>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Street</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">City</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">State</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Post Code</label>
													<div class="col-md-9">
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="form-group last">
													<label class="control-label col-md-3">Country</label>
													<div class="col-md-9">
														<select class="form-control">
														</select>
													</div>
												</div>
											</div>
											<div class="form-actions fluid">
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-offset-3 col-md-9">
															<button class="btn green" type="submit"><i class="fa fa-check"></i> Submit</button>
															<button class="btn default" type="button">Cancel</button>
														</div>
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>

	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="footer-inner">
		 2013 &copy; Metronic by keenthemes.
	</div>
	<div class="footer-tools">
		<span class="go-top">
			<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->



</body><!-- END BODY --></html>