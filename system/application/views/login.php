<?PHP
$this->load->helper('url');
$this->session->sess_destroy();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Administration Panel</title>
<link media="screen" rel="stylesheet" type="text/css" href="http://localhost/secondarySchoolPortal/assets/css/admin-login.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-login-ie.css" /><![endif]-->

</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		
		
		
		
		<!--[if !IE]>start login wrapper<![endif]-->
		<div id="login_wrapper">
			
			
			<div class="error">
            <?PHP
			if(isset($status))
			{
			?>
				<div class="error_inner">
					<?PHP echo $status; ?>
                    <!--<strong>Access Denied</strong> | <span>user/password combination wrong</span>-->
				</div>
            <?PHP
			}
			else if(isset($signout))
				echo'<span><b>You have successfully signed out.</b></span>';
			else
				echo'<span><b>Please enter credentials to login</b></span>';
			?>
			</div>
			
			
			
			<!--[if !IE]>start login<![endif]-->
			<form action="<?PHP echo site_url("login/userLogin") ?>" method="post">
				<fieldset>
					
					
					
					
					
					<h1 id="logo"><a href="#">websitename Administration Panel</a></h1>
					<div class="formular">
						<div class="formular_inner">
						
						<label>
							<strong>Username:</strong>
							<span class="input_wrapper">
								<input name="name" type="text" id="name" />
							</span>
						</label>
						<label>
							<strong>Password:</strong>
							<span class="input_wrapper">
								<input name="password" type="password" id="password" />
							</span>
						</label>
						<label class="inline">
							<input class="checkbox" name="" type="checkbox" value="" />
							remember me on this computer
						</label>
						
						
						<ul class="form_menu">
							<li><span class="button"><span><span>Sign In</span></span><input type="submit" name=""/></span></li>
						</ul>
						
						</div>
					</div>
				</fieldset>
			</form>
			<!--[if !IE]>end login<![endif]-->
		</div>
		<!--[if !IE]>end login wrapper<![endif]-->
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
</body>
</html>
