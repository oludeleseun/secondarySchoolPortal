<?PHP
class Students extends Model
{
	function Students()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('students', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('studentID', $id);
		$status = $this->db->update('students', $data);
		return $status;
	}
	function getById($id)
	{
		//$query = $this->db->get_where('students', array('studentID' => $id, 'status'=>1));
		$this->db->select('*');
		$this->db->from('students');
		$this->db->join('class_rooms', 'students.currentClass = class_rooms.classID');
		$this->db->where(array('studentID'=>$id, 'students.status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	function getAll()
	{
		$this->db->select('*');
		$this->db->from('students');
		$this->db->join('class_rooms', 'students.currentClass = class_rooms.classID');
		$this->db->where('students.status', '1');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$i = 0;
			$data = array();
			foreach ($query->result_array() as $row)
			{
				$data[$i] = $row;
				$i++;
			}
			return $data;
		}
		else
			return false;
	}
	
	function getByParent($parentID)
	{
		$this->db->select('*');
		$this->db->from('students');
		$this->db->join('class_rooms', 'students.currentClass = class_rooms.classID');
		$this->db->where('students.status', '1');
		$this->db->where('parentID', $parentID);
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			$i = 0;
			$data = array();
			foreach ($query->result_array() as $row)
			{
				$data[$i] = $row;
				$i++;
			}
			return $data;
		}
		else
			return false;
	}
	
	function getClassStudents($classID)
	{
		$this->db->select('*');
		$this->db->from('students');
		$this->db->join('class_rooms', 'students.currentClass = class_rooms.classID');
		$this->db->where(array('currentClass'=>$classID, 'students.status'=>1));
		$query = $this->db->get();
		//$query = $this->db->get_where('students', array('currentClass' => $classID, 'status'=>1));
		if ($query->num_rows() > 0)
		{
			$i = 0;
			$data = array();
			foreach ($query->result_array() as $row)
			{
				$data[$i] = $row;
				$i++;
			}
			return $data;
		}
		else
			return false;
	}
	function delete($id)
	{
		$this->db->where('studentID', $id);
		$status = $this->db->delete('students');
		return $status;
	}
	function getParent($id)
	{
		//$query = $this->db->get_where('students', array('studentID' => $id, 'status'=>1));
		$this->db->select('*');
		$this->db->from('parents');
		$this->db->where(array('parentID'=>$id));
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
}
?>