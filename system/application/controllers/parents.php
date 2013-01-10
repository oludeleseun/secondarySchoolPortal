<?PHP
class Parents extends Controller
{
	function Parents()
	{
		parent::Controller();
		$this->load->model('students','studentObj');
		$this->load->model('teachers','teacherObj');
		$this->load->model('class_rooms', 'classObj');
		$this->load->model('subject_teachers', 'subTeacherObj');
		$this->load->model('validate_session', 'valSessObj');
		$this->load->model('session_terms', 'sessTermObj');
		$this->load->model('student_subjects', 'studentSubObj');
		$this->load->model('academic_sessions', 'acadSessObj');
		$this->load->model('class_levels', 'classLevelObj');
		$this->load->model('fees_invoice', 'feesInvoiceObj');
		$this->load->model('tuition', 'tuitionObj');
		$this->load->helper('url');
	}
	
	//listing of all study courses in the database
	function index($page=0)
	{
		$sess = $this->valSessObj->validateParentLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$this->load->view('parent_home');
		}
	}	
	//Display's the student's attached to a classroom
	function students($page=0)
	{
		$sess = $this->valSessObj->validateParentLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['students'] = $this->studentObj->getByParent($this->session->userdata('parentID'));
			$x = count($data['students']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("admins/students");
			$config['total_rows'] = $x;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$data['divHeading'] = 'Students Listing';
			$data['showPayment'] = true;
			$this->load->view('students', $data);
		}
	}
	
	function academicSessions($classID=0, $page=0)
	{
		$sess = $this->valSessObj->validateParentLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['academic_sessions'] = $this->acadSessObj->getAll();
			$x = count($data['academic_sessions']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("admins/academicSessions/$classID");
			$config['total_rows'] = $x;
			$config['per_page'] = '10';
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$data['divHeading'] = 'Academic Sessions';
			$data['page'] = $page;
			$data['classID'] = $classID;
			$this->load->view('academic_sessions', $data);
		}
	}
	
	function terms($studentID=0)
	{
		$sess = $this->valSessObj->validateParentLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['session_terms'] = $this->sessTermObj->getForParent($studentID);
			$data['studentID'] = $studentID;
			$this->load->view('parent_terms', $data);
		}
	}
	
	function studentResult($studentID=0, $termID=0)
	{
		$sess = $this->valSessObj->validateParentLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['result_info'] = $this->studentObj->getById($studentID);
			$data['result_details'] = $this->studentSubObj->getStudentSubjectsByStudent($termID, $studentID);
			$data['studentID'] = $studentID;
			$data['result_info']['className'] = 'Basic 7A';
			$data['result_info']['schoolOpened'] = 102;
			$data['result_info']['timesPresent'] = 102;
			$session_terms = $this->sessTermObj->getById($termID);
			$data['result_info']['sessionName'] = $session_terms['sessionName'];
			$data['result_info']['termName'] = $session_terms['termName'];
			$this->load->view('student_result', $data);
		}
	}
	
	function feesStudentListing()
	{
		$sess = $this->valSessObj->validateParentLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['studentID'] = $studentID;
			$this->load->view('payment_form', $data);
		}
	}
	function studentProfile($studentID=0)
	{
		$sess = $this->valSessObj->validateParentLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['student_info'] = $this->studentObj->getById($studentID);
			$data['parent_info'] = $this->studentObj->getParent($data['student_info']['parentID']);
			$this->load->view('student_profile', $data);
		}
	}
}
?>