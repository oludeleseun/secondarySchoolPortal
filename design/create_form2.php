<?PHP
$this->load->helper('url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Administration Panel | Votings</title>
<link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->

<script type="text/javascript" src="js/behaviour.js"></script>
</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<!--[if !IE]>start head<![endif]-->
		<div id="head">
			
			<!--[if !IE]>start logo and user details<![endif]-->
			<?PHP include('includes/logoSpaceTop.php'); ?>
			
			<!--[if !IE]>end logo end user details<![endif]-->
			
			
			
			<!--[if !IE]>start menus_wrapper<![endif]-->
			<div id="menus_wrapper">
				
				
				
				
				
				<?PHP include('includes/topmenu.php'); ?>
				
				
				
				<div id="sec_menu">
					<ul>
						<li><a href="#" class="sm1">Add New</a></li>
						<li><a href="#" class="sm2">View All Votings</a></li>
					  	<li><a href="#" class="sm3">Search</a></li>
					</ul>
				</div>
	    </div>
			<!--[if !IE]>end menus_wrapper<![endif]-->
			
			
			
		</div>
		<!--[if !IE]>end head<![endif]-->
		
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			
			
			
			
			
			<!--[if !IE]>start page<![endif]-->
			<div id="page">
				<div class="inner">
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					
					<!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					
					<!--[if !IE]>start section<![endif]-->	
				  
					<!--[if !IE]>end section<![endif]-->
					
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Forms Template</h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
						<!--[if !IE]>start section content<![endif]-->
						<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
										  <div class="sct_right">
												
												<h3>Subtitle will go here if needed</h3>
														
										    <p>
													<!--[if !IE]>start system messages<![endif]-->
										    <ul class="system_messages">
                                              <?PHP if(isset($error)) { ?>
											  <li class="red"><span class="ico"></span><strong class="system_title">This is a negative error message !</strong></li>
                                                <?PHP } ?>
                                                <?PHP if(isset($success)) { ?>
												<li class="green"><span class="ico"></span><strong class="system_title">This is a positive message !</strong></li>
                                                <?PHP } ?>
                                              <?PHP if(isset($warning)) { ?>
												<li class="yellow"><span class="ico"></span><strong class="system_title">This is a warning !</strong></li>
                                                <?PHP } ?>
										    </ul>
												<!--[if !IE]>end system messages<![endif]-->
												</p>
									      <p></p>
												
												<!--[if !IE]>start forms<![endif]-->
												<form method="post" action="<?PHP if(isset($votingID)) echo site_url("manage_votings/saveData/".$votingID); else echo site_url("manage_votings/saveNew");  ?>" class="search_form general_form">
													<!--[if !IE]>start fieldset<![endif]-->
													<fieldset>
														<!--[if !IE]>start forms<![endif]-->
														<div class="forms">
														
														
														
														<!--[if !IE]>start row<![endif]-->
														<div class="row">
															<label>Name Of Voting:</label>
															<div class="inputs">
																<span class="input_wrapper"><input class="text" name="votingTitle" type="text" /></span>
														  </div>
														</div>
														<!--[if !IE]>end row<![endif]-->
														
														<!--[if !IE]>start row<![endif]-->
														<div class="row">
														  <label>Voting Keyword:</label>
															<div class="inputs">
																<span class="input_wrapper"><input class="text" name="voteKeyword" type="text" /></span>
															</div>
														</div>
														<!--[if !IE]>end row<![endif]-->
                                                        
                                                        <!--[if !IE]>start row<![endif]-->
														<div class="row">
														  <label>Voting Help:</label>
															<div class="inputs">
																<span class="input_wrapper"><input class="text" name="voteHelpText" type="text" /></span>
															</div>
														</div>
														<!--[if !IE]>end row<![endif]-->
														
														<!--[if !IE]>start row<![endif]-->
														<div class="row">
															<label>Status:</label>
															<div class="inputs">
																	<input class="radio" name="status" value="1" type="radio" /> Ongoing
																	<input class="radio" name="status" value="0" type="radio" /> End Voting
															</div>
														</div>
														<!--[if !IE]>end row<![endif]-->
														
														
														<!--[if !IE]>start row<![endif]-->
														<div class="row">
														  <div class="buttons">
															<span class="button send_form_btn"><span><span>SEND FORM</span></span><input name="" type="submit" /></span>       
															</div>
														</div>
														<!--[if !IE]>end row<![endif]-->
														
														
														
														</div>
														<!--[if !IE]>end forms<![endif]-->
														
													</fieldset>
													<!--[if !IE]>end fieldset<![endif]-->
													
													
													
													
										    </form>
											  <!--[if !IE]>end forms<![endif]-->
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--[if !IE]>end section content top<![endif]-->
							<!--[if !IE]>start section content bottom<![endif]-->
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<!--[if !IE]>end section content bottom<![endif]-->
							
						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>
					<!--[if !IE]>end section<![endif]-->
					
					
					
					
						
				</div>
			</div>
			<!--[if !IE]>end page<![endif]-->
			<!--[if !IE]>start sidebar<![endif]-->
			<?PHP include('includes/side.php'); ?>
			<!--[if !IE]>end sidebar<![endif]-->
			
			
			
			
		</div>
		<!--[if !IE]>end content<![endif]-->
		
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	
	<!--[if !IE]>start footer<![endif]-->
	<?PHP include('includes/footer.php'); ?>
	<!--[if !IE]>end footer<![endif]-->
	
</body>
</html>