<?PHP
class Teacher extends Controller
{
	function Teacher()
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
		$this->load->helper('url');
	}
	
	//listing of all study courses in the database
	function index($page=0)
	{
		$sess = $this->valSessObj->validateTeacherLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$this->load->view('teacher_home');
		}
	}
	
	function myClasses($page=0)
	{
		$sess = $this->valSessObj->validateTeacherLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['classes'] = $this->classObj->getByClassTeacher($this->session->userdata('teacherID'));
			$x = count($data['classes']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("teacher/myClasses");
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
		$sess = $this->valSessObj->validateTeacherLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['subjects'] = $this->subTeacherObj->getByTeacher($this->session->userdata('teacherID'));
			$x = count($data['subjects']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("teacher/myClasses/");
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
	function classStudents($classID=0, $page=0)
	{
		$sess = $this->valSessObj->validateTeacherLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['students'] = $this->studentObj->getClassStudents($classID);
			$x = count($data['students']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("teacher/classStudents/$classID");
			$config['total_rows'] = $x;
			$config['per_page'] = '10';
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$data['divHeading'] = 'Class Students';
			$this->load->view('students', $data);
		}
	}
	
	//save a new record
	function mySubjectStudent($subjectID=0, $classID=0, $page=0, $success=NULL)
	{
		$sess = $this->valSessObj->validateTeacherLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$teacherID = $this->session->userdata('teacherID');
			$terms = $this->sessTermObj->getCurrentTerm();
			$data['students'] = $this->studentSubObj->getSubjectStudents($subjectID, $terms['sessionTermID'], $teacherID, $classID);
			$x = count($data['students']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("teacher/mySubjectStudent/$subjectID/$classID");
			$config['total_rows'] = $x;
			$config['per_page'] = '10';
			$config['uri_segment'] = 5;
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$data['divHeading'] = 'My Subject Students Students';
			$data['subjectID'] = $subjectID;
			$data['classID'] = $classID;
			$data['page'] = $page;
			if($success != NULL)
				$data['success'] = $success;
			$this->load->view('subject_students', $data);
		}
	}
	
	//Process all student's scores
	function processScores($subjectID=0, $classID=0, $page=0)
	{
		$sess = $this->valSessObj->validateTeacherLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$studentSubjectIDs = $this->input->post('studentSubjectIDs');
			$x = count($studentSubjectIDs);
			for($i=0; $i<$x; $i++)
			{
				$studentSubjectID = $studentSubjectIDs[$i];
				
				$studentScore = array();
				if($this->input->post('ca_'.$studentSubjectID) != '')
					$studentScore['caScore'] = $this->input->post('ca_'.$studentSubjectID);
				if($this->input->post('exam_'.$studentSubjectID) != '')
					$studentScore['examScore'] = $this->input->post('exam_'.$studentSubjectID);
				if($this->input->post('comments_'.$studentSubjectID) != '')
					$studentScore['comments'] = $this->input->post('comments_'.$studentSubjectID);
				if($this->input->post('ca_'.$studentSubjectID)!='' || $this->input->post('exam_'.$studentSubjectID)!='' || $this->input->post('comments_'.$studentSubjectID)!='')
				{
					$this->studentSubObj->edit($studentScore, $studentSubjectID);
				}
				$this->studentSubObj->computeGrade($studentSubjectID);
			}
			$success = 'Your changes have being processed successfully!';
			$this->mySubjectStudent($subjectID,$classID,$page,$success);
		}
	}
	
	function classResultGrid($classID, $termID)
	{
		$sess = $this->valSessObj->validateTeacherLogin();
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
		$sess = $this->valSessObj->validateTeacherLogin();
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
			$config['base_url'] = site_url("teacher/academicSessions/$classID");
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
		$sess = $this->valSessObj->validateTeacherLogin();
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
			$config['base_url'] = site_url("teacher/sessionTerms/$classID/$sessionID");
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
	
	function results($page=0)
	{
		$sess = $this->valSessObj->validateTeacherLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['classes'] = $this->classObj->getByClassTeacher($this->session->userdata('teacherID'));
			$x = count($data['classes']);
			$this->load->library('pagination');
			$this->load->helper('url');
			$config['base_url'] = site_url("teacher/myClasses");
			$config['total_rows'] = $x;
			$config['per_page'] = '10';
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$data['pagenation'] = $this->pagination->create_links();
			$data['startFrom'] = $page;
			$data['perpage'] = $config['per_page'];
			$data['title'] = 'SSP | View Class Results - Class Selection';
			$data['allowResult'] = true;
			$this->load->view('class_rooms', $data);
		}
	}
	
	function studentProfile($studentID=0)
	{
		$sess = $this->valSessObj->validateTeacherLogin();
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
	
	function myProfile()
	{
		$sess = $this->valSessObj->validateTeacherLogin();
		if($sess == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($sess == true)
		{
			$data['teacher_info'] = $this->teacherObj->getById($this->session->userdata('teacherID'));
			$this->load->view('teacher_profile', $data);
		}
	}
}
?>