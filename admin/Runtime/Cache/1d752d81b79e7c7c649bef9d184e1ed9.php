<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>博客后台管理系统</title>
		
		<!--                       CSS                       -->
	  
		<!-- Reset Stylesheet -->
		<link rel="stylesheet" href="../Public/resources/css/reset.css" type="text/css" media="screen" />
	  
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="../Public/resources/css/style.css" type="text/css" media="screen" />
		
		<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
		<link rel="stylesheet" href="../Public/resources/css/invalid.css" type="text/css" media="screen" />	
		
		<!-- Colour Schemes
	  
		Default colour scheme is green. Uncomment prefered stylesheet to use it.
		
		<link rel="stylesheet" href="../Public/resources/css/blue.css" type="text/css" media="screen" />
		
		<link rel="stylesheet" href="../Public/resources/css/red.css" type="text/css" media="screen" />  
	 
		-->
		
		<!-- Internet Explorer Fixes Stylesheet -->
		
		<!--[if lte IE 7]>
			<link rel="stylesheet" href="../Public/resources/css/ie.css" type="text/css" media="screen" />
		<![endif]-->
		
		<!--                       Javascripts                       -->
  
		<!-- jQuery -->
		<script type="text/javascript" src="../Public/resources/scripts/jquery-1.3.2.min.js"></script>
		
		<!-- jQuery Configuration -->
		<script type="text/javascript" src="../Public/resources/scripts/simpla.jquery.configuration.js"></script>
		
		<!-- Facebox jQuery Plugin -->
		<script type="text/javascript" src="../Public/resources/scripts/facebox.js"></script>
		
		<!-- jQuery WYSIWYG Plugin -->
		<script type="text/javascript" src="../Public/resources/scripts/jquery.wysiwyg.js"></script>
		
		<!-- jQuery Datepicker Plugin -->
		<script type="text/javascript" src="../Public/resources/scripts/jquery.datePicker.js"></script>
		<script type="text/javascript" src="../Public/resources/scripts/jquery.date.js"></script>
		<!--[if IE]><script type="text/javascript" src="../Public/resources/scripts/jquery.bgiframe.js"></script><![endif]-->

		
		<!-- Internet Explorer .png-fix -->
		
		<!--[if IE 6]>
			<script type="text/javascript" src="../Public/resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
		
	</head>
  
	<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title"><a href="javascript:void(0);">博客后台管理</a></h1>
		  
			<!-- Logo (221px wide) -->
			<a href="javascript:void(0);"><img id="logo" src="../Public/resources/images/logo.png" alt="Simpla Admin logo" /></a>
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				欢迎回来, <a href="javascript:void(0);" title="Edit your profile"><?php echo (session('username')); ?></a><br />
				<br />
				<a href="../../" title="View the Site" target="_blank">查看网站</a> | <a href="<?php echo U('Index/logout');?>" title="登出">登出</a>
			</div>        
			
			<ul id="main-nav">  <!-- Accordion Menu -->
				
				<li>
					<a href="<?php echo U('Index/index');?>" class="nav-top-item no-submenu current"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
						首页面板
					</a>       
				</li>
				
				<li>
					<a href="javascript:void(0);" class="nav-top-item">
						博客设置
					</a>
					<ul>
						<li><a href="<?php echo U('Base/blog_setting');?>">基本信息设定</a></li>
						<li><a href="<?php echo U('Base/add_admin');?>">添加管理员</a></li>
						<li><a href="<?php echo U('Base/manage_admin');?>">管理管理员</a></li>
					</ul>
				</li>
				
				<li> 
					<a href="javascript:void(0);" class="nav-top-item"> <!-- Add the class "current" to current menu item -->
					文章管理
					</a>
					<ul>
						<li><a href="<?php echo U('Article/add_article');?>">添加新文章</a></li>
						<li><a href="<?php echo U('Article/manage_article');?>">管理文章</a></li> <!-- Add class "current" to sub menu items also -->
					</ul>
				</li>
				
				<li>
					<a href="javascript:void(0);" class="nav-top-item">
						文章类型管理
					</a>
					<ul>
						<li><a href="<?php echo U('Type/add_type');?>">添加新的类别</a></li>
						<li><a href="<?php echo U('Type/manage_type');?>">管理文章类别</a></li>
					</ul>
				</li>
				
				      
				
			</ul> <!-- End #main-nav -->
			
			
			
		</div></div> <!-- End #sidebar -->
		
		<div id="main-content"> <!-- Main Content Section with everything -->
			
			
			<!-- Page Head -->
			<h2>欢迎管理员 Tony</h2>
			<p id="page-intro"></p>
			
			<div class="clear"></div> <!-- End .clear -->
			
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3><?php echo ($action); ?>文章</h3>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab2">
					
						<form enctype="multipart/form-data" action="<?php echo U('Goods/save_goodsedit');?>" method="post">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>商品标题
										<input class="text-input small-input" type="text" id="small-input" name="title" value="<?php echo ($goods['title']); ?>" />
								</p>
								
								<p>类别
										<select name="cid" id="small-input">
											<?php if(is_array($classes)): $i = 0; $__LIST__ = $classes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v['cid']); ?>"><?php echo ($v['cname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
								</p>
								
								<p>品牌
										<select name="bid" id="small-input">
											<?php if(is_array($brands)): $i = 0; $__LIST__ = $brands;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v['bid']); ?>"><?php echo ($v['bname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
										</select>
								</p>
								
								<p>库存
										<input class="text-input small-input" type="text" id="small-input" name="quantity" value="<?php echo ($goods['quantity']); ?>" />
								</p>
								
								<p>价格
										<input class="text-input small-input" type="text" id="small-input" name="price" value="<?php echo ($goods['price']); ?>" />
								</p>
								<p>立刻上架
										<input type="radio" name="on_sale" value="Y" checked="checked"/>是
										<input type="radio" name="on_sale" value="N" />否
								</p>
								<p>
									<label>商品描述</label>
									<?php echo W('Editord',array($goods['description']));?>
								</p>
								
								
								<p>
									<input type="hidden" name="gid" value="<?php echo ($goods['gid']); ?>" />
									<input class="button" type="submit" value="修改" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
					
				</div> <!-- End .content-box-content -->
				
			</div> <!-- End .content-box -->
			<div id="footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
						&#169; Copyright 2009 Your Company | Powered by <a href="http://themeforest.net/item/simpla-admin-flexible-user-friendly-admin-skin/46073">Simpla Admin</a> | <a href="#">Top</a>
				</small>
			</div><!-- End #footer -->
			
		</div> <!-- End #main-content -->
		
	</div></body>
  

<!-- Download From www.exet.tk-->
</html>