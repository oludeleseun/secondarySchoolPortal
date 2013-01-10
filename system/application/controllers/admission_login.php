<?PHP
class Admission_login extends Controller
{
	function Admission_login()
	{
		parent::Controller();	
		$this->load->model('admission', 'admissionObj');
	}
	function login($receiptNumber=NULL, $confirmationNumber=NULL)
	{
		if($receiptNumber==NULL || $confirmationNumber==NULL)
		{
			$receiptNumber = $this->input->post('receiptNumber'); //$_POST['name'];
			$confirmationNumber = $this->input->post('confirmationNumber');//$_POST['password'];
		}
		$this->load->model('login_m','loginObj');
		$row = $this->loginObj->checkAdmissionLogin($confirmationNumber, $receiptNumber);
		if($row != false)
		{
			$userSessionData = array('regNumber'=> $row['regNumber'], 'applicationID'=>$row['applicationID'], 'admissionLogin'=>true, 'admissionID'=>$row['admissionID'], 'confirmationNumber'=>$row['confirmationNumber'], 'receiptNumber'=>$row['receiptNumber']);
			$this->session->set_userdata($userSessionData);
			
			$admissionID = $this->session->userdata('admissionID');
			$regNumber = $this->session->userdata('regNumber');
			$confirmationNumber = $this->session->userdata('confirmationNumber');
			$data = $this->admissionObj->getUserAdmissionData($confirmationNumber);
			$data['programs'] = $this->admissionObj->getAdmissionPrograms($admissionID);
			//$this->load->view('admission_biodata', $data);
			$this->load->helper('url');
			header('Location: '.site_url('admissions/bio_data'));
		}
		else
		{
			//if admission login fails, check if the user is trying to login for the admissionList
			$row = $this->loginObj->checkAdmissionListLogin($confirmationNumber, $receiptNumber);
			if($row != false)
			{
				$userSessionData = array('regNumber'=> $row['regNumber'], 'admissionListLogin'=>true, 'confirmationNumber'=>$row['confirmationNumber'], 'receiptNumber'=>$row['receiptNumber']);
				$this->session->set_userdata($userSessionData);
				$this->load->helper('url');
				header('Location: '.site_url('admissions/admissionLetter'));
			}
			else
			{
				$data['status'] = 'Invalid Username/Password combination, please try again';
				$this->load->view('admissionLogin', $data);
			}
		}
	}
}
?>