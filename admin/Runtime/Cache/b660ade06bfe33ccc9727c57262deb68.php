<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
		<title>管理</title>
		<meta charset="utf-8" />
	</head>	
	<body>
			<div class="content-box"><!-- Start Content Box -->
				
				<div class="content-box-header">
					
					<h3>类别管理</h3>
					
					<div class="clear"></div>
					
				</div> <!-- End .content-box-header -->
				
				<div class="content-box-content">
					
					<div class="tab-content default-tab" id="tab2">
					
						<form action="<?php echo U('Base/save_admin');?>" method="post">
							
							<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
								<p>
									<label>类别名称</label>
										<input class="text-input small-input" type="text" id="small-input" name="username" />
								</p>

								<p>
									<input class="button" type="submit" value="添加" />
								</p>
								
							</fieldset>
							
							<div class="clear"></div><!-- End .clear -->
							
						</form>
						
					</div> <!-- End #tab2 -->        
				</div> <!-- End .content-box-content -->
			</div>
		</body>
</html>