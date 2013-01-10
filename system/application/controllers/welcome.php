<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	function index()
	{
		$this->load->view('login');//$this->load->view('welcome_message');
	}
	function login()
	{
		$this->load->view('login');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */