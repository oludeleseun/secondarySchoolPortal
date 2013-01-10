<?PHP
class Dash_board extends Controller
{
	function Dash_board()
	{
		parent::Controller();
		$this->load->model('validate_session','valSessObj');
	}
	function index($page=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$this->load->view('adminhome');
		}
	}
	function signout()
	{
		$this->session->sess_destroy();
		$data['signout'] = 'You have successfully being signed out';
		$this->load->view('login', $data);
	}
}
?>