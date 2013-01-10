<?PHP
class Class_rooms extends Model
{
	function Classs_rooms()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('class_rooms', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('classID', $id);
		$status = $this->db->update('class_rooms', $data);
		return $status;
	}
	function getById($id)
	{
		$this->db->select('*');
		$this->db->from('class_rooms');
		$this->db->join('class_levels', 'class_rooms.classLevelID = class_levels.classLevelID');
		$this->db->where(array('classID'=>$id, 'class_rooms.status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	function getByClassTeacher($id)
	{
		//$query = $this->db->get_where('class_rooms', array('classTeacher'=>$id, 'status'=>1));
		$this->db->select('classID, classTeacher, className, classLevel, class_rooms.status');
		$this->db->from('class_rooms');
		$this->db->where('classTeacher', $id);
		$this->db->where('class_rooms.status', '1');
		$this->db->join('class_levels', 'class_rooms.classLevelID = class_levels.classLevelID');
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
	function getAll()
	{
		$this->db->select('*');
		$this->db->from('class_rooms');
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
	function delete($id)
	{
		$this->db->where('classID', $id);
		$status = $this->db->delete('class_rooms');
		return $status;
	}
}
?>