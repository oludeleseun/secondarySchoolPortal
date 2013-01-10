<?PHP
class Login_m extends Model
{
	function Login_m()
	{
		parent::Model();
	}
	function checkLogin($username, $password)
	{
		$query = $this->db->get_where('admin', array('adminUsername' => $username));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			if($row['adminPassword'] == $password)
			{
				return $row;
			}
		}
		else
		{
			return false;
		}
	}
	
	function checkLoginStudent($username, $password)
	{
		$query = $this->db->get_where('students', array('portalUsername'=>$username, 'status'=>1));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			if($row['portalPassword'] == $password)
			{
				return $row;
			}
		}
		else
		{
			return false;
		}
	}
	
	function checkLoginTeacher($username, $password)
	{
		$query = $this->db->get_where('teachers', array('username'=>$username, 'status'=>1));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			if($row['portalPassword'] == $password)
			{
				return $row;
			}
		}
		else
		{
			return false;
		}
	}
	
	function checkLoginParent($username, $password)
	{
		$query = $this->db->get_where('parents', array('portalUsername'=>$username, 'portalPassword'=>$password));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
		{
			return false;
		}
	}
}
?>