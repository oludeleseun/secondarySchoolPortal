<?PHP
class Etranzact_payment extends Controller
{
	function Etranzact_payment()
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
		$this->load->model('etranzact_transactions','paymentObj');
		$this->load->helper('url');
	}
	
	//listing of all study courses in the database
	function index($studentID=0)
	{
		if($this->valSessObj->validate() == false && $this->valSessObj->validateParentLogin() == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($this->valSessObj->validate() == true || $this->valSessObj->validateParentLogin() == true)
		{
			$data['studentID'] = $studentID;
			$this->load->view('payment_form', $data);
		}
	}
	//Display's the teacher's subjects
	function startPayment()
	{
		if($this->valSessObj->validate() == false && $this->valSessObj->validateParentLogin() == false)
		{
			$data['status'] = 'You do not have a valid session, please login to continue';
			$this->load->view('login', $data);
		}
		else if($this->valSessObj->validate() == true || $this->valSessObj->validateParentLogin() == true)
		{
			$paymentData = array('confirmationNumber'=>$this->input->post('confirmationNumber'),
			'receiptNumber'=>$this->input->post('receiptNumber'),
			'studentID'=>$this->input->post('studentID'));
			$this->session->set_userdata($paymentData);
			$this->load->view('payment_submit', $paymentData);
		}
	}
	
	function processPaymentResult()
	{
		$success = $this->input->get_post('SUCCESS');
		if($success == '-1' || $success == '-2')
		{
			$this->load->model('pins', 'pinObj');
			$pinData = $this->pinObj->getPinInformation($this->session->userdata('confirmationNumber'));
			if($pinData != false)
			{
				$success = 'RECEIPT_NO='.$pinData['receipt_no'].'&PAYMENT_CODE=' .$pinData['confirm_code'].'&MERCHANT_CODE='.$pinData['bankcode'].'&TRANS_AMOUNT='.$pinData['amount'].'&TRANS_DATE='.date('m-d-y');
			}
		}
		if($success == '-1')
		{
			$pd['error'] = 'Error, The PIN you have entered is invalid! Please restart the process.';
			$this->load->view('error_page', $pd);
		}
		else if($success == '-2')
		{
			$pageData =  array('terminalID'=>'0330000023', 'confirmationNumber'=>$this->session->userdata('confirmationNumber'), 'receiptNumber'=>$this->session->userdata('receiptNumber'));
			$pageData['warning'] = "There was an error while processing your request. The payment gateway has timed out while trying to confirm your PIN. Please try again.";
			$this->load->view('payment_pin2', $pageData);
			return;
		}
		else
		{
			//string manipulation to process the response
			//confirm that the PIn has not being previously used for another application
			$bit = explode('&', $success);
			$receiptNumber = $bit[0];
			$merchantCode = $bit[2];
			$confirmationNumber = $bit[1];//This is the actual PIN
			$transAmount = $bit[3];
			$transDate = $bit[4];
			$x = explode('=', $bit[0]);
			$receiptNumber = $x[1];
			$x = explode('=', $bit[1]);
			$transactionDetails['PAYMENT_CODE'] = $x[1];				
			$x = explode('=', $bit[3]);
			$transactionDetails['AMOUNT'] = (float)$x[1];
			$x = explode('=', $bit[4]);
			$transactionDetails['TRANS_DATE'] = $x[1];
			$transactionDetails['receiptNumber'] = $receiptNumber;
			$transactionDetails['confirmationNumber'] = $transactionDetails['PAYMENT_CODE'];
			
			$used = $this->paymentObj->pinUsed($transactionDetails['PAYMENT_CODE'], $receiptNumber);
			if($used == false)
			{
				$data['success'] = 'Payment of '.$transAmount.' was successful!';
				$this->load->view('success', $data);
			}
			else
			{
				$data['error'] = 'The payment details you are trying to used has already being used!';
				$this->load->view('error', $data);
			}
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
}
?>