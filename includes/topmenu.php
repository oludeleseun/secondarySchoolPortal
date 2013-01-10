<?PHP
if($this->session->userdata('teacherLogin')==true)
{
?>
<div id="main_menu">
					<ul>
						<li><a href="<?PHP echo site_url("teacher"); ?>"><span><span>Home</span></span></a></li>
						<li><a href="<?PHP echo site_url("teacher/mySubjects"); ?>"><span><span>My Subjects</span></span></a></li>
						<li><a href="<?PHP echo site_url("teacher/myClasses"); ?>"><span><span>My Classes</span></span></a></li>
						<li><a href="<?PHP echo site_url("teacher"); ?>"><span><span>Change Password</span></span></a></li>
						<li class="last"><a href="<?PHP echo site_url("dash_board/signout"); ?>"><span><span>Sign Out</span></span></a></li>
					</ul>
				</div>
<?PHP
}
else if($this->session->userdata('adminLogin')==true)
{
?>
<div id="main_menu">
					<ul>
						<li><a href="<?PHP echo site_url("dash_board"); ?>"><span><span>Homxe</span></span></a></li>
						<li><a href="<?PHP echo site_url("admins/students"); ?>"><span><span>Students</span></span></a></li>
						<li><a href="<?PHP echo site_url("admins/schoolFees"); ?>"><span><span>School Fees</span></span></a></li>
						<li class="last"><a href="<?PHP echo site_url("dash_board/signout"); ?>"><span><span>Sign Out</span></span></a></li>
					</ul>
				</div>
<?PHP
}

else if($this->session->userdata('parentLogin')==true)
{
?>
<div id="main_menu">
					<ul>
						<li><a href="<?PHP echo site_url("parents"); ?>"><span><span>Home</span></span></a></li>
						<li><a href="<?PHP echo site_url("parents/students"); ?>"><span><span>My Wards</span></span></a></li>
						<li><a href="<?PHP echo site_url("parents"); ?>"><span><span>Change Password</span></span></a></li>
						<li class="last"><a href="<?PHP echo site_url("dash_board/signout"); ?>"><span><span>Sign Out</span></span></a></li>
					</ul>
				</div>
<?PHP
}
?>