<?PHP
class School_admin extends Controller
{
	function Manage_voters()
	{
		parent::Controller();
		$this->load->model('validate_session','valSessObj');
		$this->load->model('candidates','candidateObj');
		$this->load->model('votings','votingObj');
		$this->load->model('voters','votersObj');
	}
	
	//listing of all study courses in the database
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
			$data['voters'] = $this->votersObj->getAll();
			$x = count($data['voters']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("manage_voters/index/");
			$config['total_rows'] = $x;
			$config['per_page'] = '100';
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$this->load->view('voters', $data);
		}
	}
	
	//controller to display new form to register a department
	function launchForm($userID=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data = $this->votersObj->getById($userID);
			$data['userID'] = $userID;
			$this->load->view('new_voter', $data);
		}
	}
	
	//controller for new department submit form action
	function saveData($userID=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data = array('fullName'=>$this->input->post('fullName'), 
			'status'=>$this->input->post('status')
			);
			if($data['fullName']!='' && $data['status']!='')
			{
				$status = $this->votersObj->edit($data, $userID);
				if($status == 1)
				{
					$data['success'] = 'Changes have being saved for user.';
					$data['userID'] = $userID;
					$this->load->view('new_voter', $data);
				}
				else
				{
					$data['error'] = 'An internal server error has occured, please contact administrator if error persists';
					$data['userID'] = $userID;
					$this->load->view('new_voter', $data);
				}
			}
			else
			{
				$data['warning'] = 'All the field data have not being filled completely, please fill and resend.';
				$data['candidateID'] = $candidateID;
				$data['votings'] = $this->votingObj->getAll();
				$this->load->view('new_voter', $data);
			}
		}
	}
}
?>