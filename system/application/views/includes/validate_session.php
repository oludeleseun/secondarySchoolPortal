<?php
ob_start();
session_start();
if(isset($_SESSION['userLogin']))
{
	if(($_SESSION['lastActivity'] + 9000) < time())
	{
		// timeout, destroy the session. change to 9000
		session_destroy();
		session_unset();
	   	header("Location: userLogin.php?msg='Session TimeOut'");
	} 
	else 
	{
		include_once('classes/RegisteredUsers.class.php');
		$regObj = new RegisteredUsers();
		$userData = $regObj->getById($_SESSION['userId']);
		if($userData != FALSE)
		{
			$_SESSION['lastActivity'] = time();
		}
		else
		{
			session_destroy();
			session_unset();
	   		header("Location: userLogin.php?msg='Unauthorized access is not permitted'");
		}
	}
}
else if (!isset($_SESSION['username']))
{ 
	$returnurl = $_SERVER['REQUEST_URI'];
	header("Location: userLogin.php?msg='You need to login to view this page'&returnurl=".$returnurl."");
}
?>