<?PHP
if($this->session->userdata('teacherLogin')==true)
{
?>
<div id="sidebar">
				<div class="inner">
				
				
					<!--[if !IE]>start calendar<![endif]-->
					<!--[if !IE]>end calendar<![endif]-->
					
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Sidebar Menus</h2>
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
												<ul class="sidebar_menu">
                                                	<li><a href="<?PHP echo site_url("teacher/index"); ?>">Administrator Dashboard</a></li>
													<li><a href="<?PHP echo site_url("teacher/myClasses"); ?>">My Classrooms</a></li>
                                                    <li><a href="<?PHP echo site_url("teacher/mySubjects"); ?>">My Subjects</a></li>
													<li><a href="javascript:runCommand2('<?PHP echo site_url("teacher/myProfile"); ?>')">My Profile</a></li>
													<li><a href="<?PHP echo site_url("teacher"); ?>">Change Password</a></li>
													<li><a href="<?PHP echo site_url("dash_board/signout"); ?>">Sign Out</a></li>
												</ul>
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
					
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start quick info<![endif]-->
					<div class="quick_info">
						<div class="quick_info_top">
							<h2>Quick info</h2>
						</div>
						<div class="quick_info_content">
                        <?PHP
						$db = mysql_connect('localhost', 'root', '');
						mysql_select_db('ssp',$db);
						
						$query1 ="SELECT * FROM students WHERE status=1";
						$query2 ="SELECT * FROM class_rooms WHERE status=1 AND classTeacher='".$this->session->userdata('teacherID')."'";
						$query3 = "SELECT * FROM subject_teachers WHERE status=1 AND subjectTeacher='".$this->session->userdata('teacherID')."'";
						$rs1 = mysql_query($query1);
						$rs2 = mysql_query($query2);
						$rs3 = mysql_query($query3);
						?>
							<dl>
								<dt><?PHP echo mysql_num_rows($rs1); ?> Students</dt>
								<dd>Active in the system</dd>
							</dl>
							<dl>
								<dt><?PHP echo mysql_num_rows($rs3); ?> Classes</dt>
								<dd>As the class teacher</dd>
							</dl>
							<dl>
								<dt><?PHP echo mysql_num_rows($rs2); ?> Subjects</dt>
								<dd>Attached to this teacher</dd>
							</dl>
						</div>
						<span class="quick_info_bottom"></span>
				  </div>
					<!--[if !IE]>end quick info<![endif]-->
					
					
				
				
			  </div>
			</div>
<?PHP
}
else if($this->session->userdata('adminLogin')==true)
{
?>
<div id="sidebar">
				<div class="inner">
				
				
					<!--[if !IE]>start calendar<![endif]-->
					<!--[if !IE]>end calendar<![endif]-->
					
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Sidebar Menus</h2>
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
												<ul class="sidebar_menu">
                                                	<li><a href="<?PHP echo site_url("admins/index"); ?>">Home</a></li>
													<li><a href="<?PHP echo site_url("admins/students"); ?>">Students</a></li>
                                                    <li><a href="<?PHP echo site_url("admins/schoolFees"); ?>">School Fees</a></li>
													<li><a href="<?PHP echo site_url("admins"); ?>">Change Password</a></li>
													<li><a href="<?PHP echo site_url("dash_board/signout"); ?>">Sign Out</a></li>
												</ul>
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
					
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start quick info<![endif]-->
					<div class="quick_info">
						<div class="quick_info_top">
							<h2>Quick info</h2>
						</div>
						<div class="quick_info_content">
                        <?PHP
						$db = mysql_connect('localhost', 'root', '');
						mysql_select_db('ssp',$db);
						
						$query1 ="SELECT * FROM students WHERE status=1";
						$query2 ="SELECT * FROM teachers WHERE status=1";
						$query3 = "SELECT * FROM parents WHERE status=1";
						$rs1 = mysql_query($query1);
						$rs2 = mysql_query($query2);
						$rs3 = mysql_query($query3);
						?>
							<dl>
								<dt><?PHP echo mysql_num_rows($rs1); ?> Votings</dt>
								<dd>still on going</dd>
							</dl>
							<dl>
								<dt><?PHP echo mysql_num_rows($rs3); ?> Users</dt>
								<dd>registered to this service</dd>
							</dl>
							<dl>
								<dt><?PHP echo mysql_num_rows($rs2); ?> candidate</dt>
								<dd>have contested so far</dd>
							</dl>
						</div>
						<span class="quick_info_bottom"></span>
				  </div>
					<!--[if !IE]>end quick info<![endif]-->
					
					
				
				
			  </div>
			</div>
<?PHP
}

else if($this->session->userdata('parentLogin')==true)
{
?>
<div id="sidebar">
				<div class="inner">
				
				
					<!--[if !IE]>start calendar<![endif]-->
					<!--[if !IE]>end calendar<![endif]-->
					
					
					
					
					<!--[if !IE]>start section<![endif]-->	
					<div class="section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2>Sidebar Menus</h2>
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
												<ul class="sidebar_menu">
                                                	<li><a href="<?PHP echo site_url("parents/index"); ?>">Home</a></li>
													<li><a href="<?PHP echo site_url("parents/students"); ?>">My Wards</a></li>
													<li><a href="<?PHP echo site_url("parent"); ?>">Change Password</a></li>
													<li><a href="<?PHP echo site_url("dash_board/signout"); ?>">Sign Out</a></li>
												</ul>
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
					
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start quick info<![endif]-->
					<div class="quick_info">
						<div class="quick_info_top">
							<h2>Quick info</h2>
						</div>
						<div class="quick_info_content">
                       <?PHP
						$db = mysql_connect('localhost', 'root', '');
						mysql_select_db('ssp',$db);
						
						$query1 ="SELECT * FROM students WHERE status=1 AND parentID='".$this->session->userdata('parentID')."'";
						$query2 ="SELECT * FROM teachers WHERE status=1";
						$query3 = "SELECT * FROM parents WHERE status=1";
						$rs1 = mysql_query($query1);
						$rs2 = mysql_query($query2);
						$rs3 = mysql_query($query3);
						?>
							<dl>
								<dt><?PHP echo mysql_num_rows($rs1); ?> Students</dt>
								<dd>attached to my account</dd>
							</dl>
							<dl>
								<dt><?PHP echo mysql_num_rows($rs2); ?> teachers</dt>
								<dd>Active on portal</dd>
							</dl>
						</div>
						<span class="quick_info_bottom"></span>
				  </div>
					<!--[if !IE]>end quick info<![endif]-->
					
					
				
				
			  </div>
			</div>
<?PHP
}
?>