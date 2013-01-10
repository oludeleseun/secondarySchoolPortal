<?PHP
class Validate_session extends Model
{
	function Validate_session()
	{
		parent::Model();
	}
	function validate()
	{
		if($this->session->userdata('adminLogin') == true)
		{
			$query = $this->db->get_where('admin', array('adminId' => $this->session->userdata('adminId')));
			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	function validateParentLogin()
	{
		if($this->session->userdata('parentLogin') == true)
		{
			$query = $this->db->get_where('parents', array('portalUsername' => $this->session->userdata('parentUsername')));
			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	function validateTeacherLogin()
	{
		if($this->session->userdata('teacherLogin') == true)
		{
			$query = $this->db->get_where('teachers', array('username' => $this->session->userdata('username')));
			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	function validateAdmissionLogin()
	{
		if($this->session->userdata('admissionLogin') == true)
		{
			$query = $this->db->get_where('admission_application', array('confirmationNumber'=>$this->session->userdata('confirmationNumber')));
			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function validateAdmissionListLogin()
	{
		if($this->session->userdata('admissionListLogin') == true)
		{
			$query = $this->db->get_where('admission_list_login', array('confirmationNumber'=>$this->session->userdata('confirmationNumber')));
			if($query->num_rows() > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}
?>