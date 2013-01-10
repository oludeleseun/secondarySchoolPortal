<?PHP
class Login extends Controller
{
	function Login()
	{
		parent::Controller();	
		$this->load->helper('url');
	}
	function userLogin()
	{
		$username = $this->input->post('name'); //$_POST['name'];
		$password = $this->input->post('password');//$_POST['password'];
		$this->load->model('login_m','loginObj');
		$row = $this->loginObj->checkLogin($username, $password);
		if($row != false)
		{
			$userSessionData = array('adminUsername'=> $row['adminUsername'], 'lastname'=>$row['surname'], 'othernames' => $row['othernames'], 'adminId'=>$row['adminID'], 'adminLogin'=>true);
			$this->session->set_userdata($userSessionData);
			$this->load->view('admin_home');
		}
		else
		{
			$row = $this->loginObj->checkLoginParent($username, $password);
			if( $row != false)
			{
				$userSessionData = array('parentUsername'=> $row['portalUsername'], 'lastname'=>$row['lastname'], 'firstname' => $row['firstname'], 'middlename'=>$row['middlename'], 'parentID'=>$row['parentID'], 'parentLogin'=>true);
				$this->session->set_userdata($userSessionData);
				$this->load->view('parent_home');
			}
			else
			{
				$row = $this->loginObj->checkLoginTeacher($username, $password);
				if( $row != false)
				{
					$userSessionData = array('teacherUsername'=> $row['username'], 'lastname'=>$row['lastname'], 'firstname' => $row['firstname'], 'middlename'=>$row['middlename'], 'teacherID'=>$row['teacherID'], 'teacherLogin'=>true);
				$this->session->set_userdata($userSessionData);
				header('Location: '.site_url('teacher/index'));
				return;
				}
				else
				{
					$data['status'] = 'Login Error! Username/password combination is invalid';
					$this->load->view('login', $data);
				}
			}
		}
	}
	function adminHome()
	{
		$this->load->view('adminhome');
	}
}
?>