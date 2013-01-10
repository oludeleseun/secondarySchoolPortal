<?PHP
class Admins extends Controller
{
	function Admins()
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
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$this->load->view('admin_home');
		}
	}
	
	function classes($page=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['classes'] = $this->classObj->getAll();
			$x = count($data['classes']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("admins/classes");
			$config['total_rows'] = $x;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$data['title'] = 'SSP | My Classes';
			$this->load->view('class_rooms', $data);
		}
	}
	
	//Display's the teacher's subjects
	function mySubjects($page=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['subjects'] = $this->subTeacherObj->getAll();
			$x = count($data['subjects']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("admins/myClasses/");
			$config['total_rows'] = $x;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$data['title'] = 'SSP | My Taught Subjects';
			$this->load->view('subject_teachers', $data);
		}
	}
	
	//Display's the student's attached to a classroom
	function students($page=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['students'] = $this->studentObj->getAll();
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
	
	function classResultGrid($classID, $termID)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$classSubjects = $this->subTeacherObj->getByClass($classID);
			//$studentResultGrid = array();
			$classStudents = $this->studentSubObj->getStudentSubjectsByClass($termID, $classID);
			$std_count = count($classStudents);
			if($classStudents != false)
			{
				for($i=0; $i<$std_count; $i++)
				{
					//retrieve the student's scores on each of the subjects
					$classInfo = $this->classObj->getById($classID);
					$currentStudent = $classStudents[$i]['studentID'];
					$studentResultGrid[$i]['studentID'] = $classStudents[$i]['studentID'];
					$studentResultGrid[$i]['firstname'] = $classStudents[$i]['firstname'];
					$studentResultGrid[$i]['middlename'] = $classStudents[$i]['studentID'];
					$studentResultGrid[$i]['lastname'] = $classStudents[$i]['lastname'];
					$studentResultGrid[$i]['gender'] = $classStudents[$i]['gender'];
					$studentResultGrid[$i]['admissionNumber'] = $classStudents[$i]['admissionNumber'];
					$studentResultGrid[$i]['className'] = $classInfo['className'];
					$sub_count = count($classSubjects);
					for($j=0; $j<$sub_count; $j++)
					{
						$currentSubjectTeacherID = $classSubjects[$j]['subjectTeacherID'];
						$subjectData = $this->studentSubObj->getForResultGrid($currentSubjectTeacherID, $termID, $currentStudent);
						$studentResultGrid[$i]['subject'.$j] = $subjectData['grade'];
					}
				}
				$pageData['subjects'] = $classSubjects;
				$pageData['studentResultGrid'] = $studentResultGrid;
				$pageData['divHeading'] = 'Students Class Results Grid View';
				$this->load->view('result_grid', $pageData);
			}
			else
				echo'No student record was found for the selected term';
		}
	}
	
	function academicSessions($classID=0, $page=0)
	{
		$sess = $this->valSessObj->validate();
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
	
	function sessionTerms($classID=0, $sessionID, $page=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['session_terms'] = $this->sessTermObj->getBySession($sessionID);
			$x = count($data['session_terms']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("admins/sessionTerms/$classID/$sessionID");
			$config['total_rows'] = $x;
			$config['per_page'] = '10';
			$config['uri_segment'] = 5;
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$data['divHeading'] = 'Session Terms';
			$data['page'] = $page;
			$data['classID'] = $classID;
			$this->load->view('session_terms', $data);
		}
	}
	
	function schoolFees($page=0)
	{
		$sess = $this->valSessObj->validate();
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
			$config['base_url'] = site_url("admins/academicSessions/");
			$config['total_rows'] = $x;
			$config['per_page'] = '10';
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$data['divHeading'] = 'Academic Sessions';
			$data['page'] = $page;
			$data['allowFees'] = true;
			$this->load->view('academic_sessions', $data);
		}
	}
	function payFeesForm($studentID=0)
	{
		$sess = $this->valSessObj->validate();
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
	
	function feesStudentListing()
	{
		$sess = $this->valSessObj->validate();
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
	function generateFees($sessionID=0)
	{
		$sess = $this->valSessObj->validate();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$sessionData = $this->acadSessObj->getById($sessionID);
			if($sessionData != false)
			{
				$students = $this->studentObj->getAll();
				$x = count($students);
				for($i=0; $i<$x; $i++)
				{
					$student_class = $this->classObj->getById($students[$i]['currentClass']);
					if($student_class != false)
					{
						$fees = (float)$student_class['schoolFees'];
						$invoiceData['sessionID'] = $sessionID;
						$invoiceData['amount'] = $fees;
						$invoiceData['dateGenerated'] = date('y-m-d');
						$invoiceData['studentID'] = $students[$i]['studentID'];
						//Check information if invoice has being previously generated for the student in the session
						$generated = $this->feesInvoiceObj->getByStudent($students[$i]['studentID'], $sessionID);
						if($generated == false)//Meaning no previous invoice has being generated
						{
							$this->feesInvoiceObj->add($invoiceData);
							$this->tuitionObj->addFeeToStudent($students[$i]['studentID'], $fees);
						}
					}
				}
				$data['success'] = 'Fees have being generated successfully';
				$this->load->view('success', $data);
			}
			else{
				$data['error'] = 'There was an error processing your request! Session is not valid';
				$this->load->view('error', $data);
			}
		}
	}
	function studentProfile($studentID=0)
	{
		$sess = $this->valSessObj->validate();
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