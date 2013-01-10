<?PHP
class Academic_sessions extends Model
{
	function Academic_sessions()
	{
		parent::Model();
	}
	function edit($data, $id)
	{
		$this->db->where('sessionID', $id);
		$status = $this->db->update('academic_sessions', $data);
		return $status;
	}
	function getById($id)
	{
		$this->db->order_by('sessionStart', 'asc');
		$query = $this->db->get_where('academic_sessions', array('sessionID'=>$id, 'status'=>1));
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
		$this->db->from('academic_sessions');
		$this->db->order_by('sessionStart', 'asc');
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
	function getCurrentTerm()
	{
		$this->db->order_by('sessionStart', 'asc');
		$query = $this->db->get_where('academic_sessions', array('current'=>1, 'status'=>1));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	function delete($id)
	{
		$this->db->where('sessionID', $id);
		$status = $this->db->delete('academic_sessions');
		return $status;
	}
}
?>