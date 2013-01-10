<?PHP
class Manage_votings extends Controller
{
	function Manage_votings()
	{
		parent::Controller();
		$this->load->model('validate_session','valSessObj');
		$this->load->model('votings','votingObj');
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
			$data['votings'] = $this->votingObj->getAll();
			$x = count($data['votings']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("manage_votings/index/");
			$config['total_rows'] = $x;
			$config['per_page'] = '100';
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$this->load->view('votings', $data);
		}
	}
	
	//controller to display new form to register a department
	function launchForm($votingID=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			if($votingID != 0)
			{
				$data = $this->votingObj->getById($votingID);
				$data['votingID'] = $votingID;
				$this->load->view('new_voting', $data);
			}
			else
				$this->load->view('new_voting');
		}
	}
	
	//save a new record
	function saveNew()
	{
		$data = array('votingTitle'=>$this->input->post('votingTitle'), 
		'voteKeyword'=>$this->input->post('voteKeyword'),
		'voteHelpText'=>$this->input->post('voteHelpText'),
		'status'=>$this->input->post('status')
		);
		$status = $this->votingObj->add($data);
		if($status == 1)
		{
			unset($data);
			$pagedata = array();
			$pagedata['success'] = 'New voting has being entered into the database';
			$this->load->view('new_voting', $pagedata);
			return;
		}
		else
		{
			$data['error'] = 'database error';
			$this->load->view('new_voting', $data);
		}
	}
	
	//controller for new department submit form action
	function saveData($votingID=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data = array('votingTitle'=>$this->input->post('votingTitle'), 
			'voteKeyword'=>$this->input->post('voteKeyword'),
			'voteHelpText'=>$this->input->post('voteHelpText'),
			'status'=>$this->input->post('status')
			);
			if($data['votingTitle']!='' && $data['voteKeyword']!='' && $data['voteHelpText']!='' && $data['status']!='')
			{
				$status = $this->votingObj->edit($data, $votingID);
				if($status == 1)
				{
					$data['success'] = 'Changes have being saved for voting.';
					$data['votingID'] = $votingID;
					$this->load->view('new_voting', $data);
				}
				else
				{
					$data['error'] = 'An internal server error has occured, please contact administrator if error persists';
					$data['votingID'] = $votingID;
					$this->load->view('new_voting', $data);
				}
			}
			else
			{
				$data['warning'] = 'All the field data have not being filled completely, please fill and resend.';
				$data['votingID'] = $votingID;
				$this->load->view('new_voting', $data);
			}
		}
	}
}
?>