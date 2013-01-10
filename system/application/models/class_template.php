<?PHP
class Academic_session extends Model
{
	function Academic_session()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('academic_sessions', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('ID', $id);
		$status = $this->db->update('mytable', $data);
		return $status;
	}
	function getById($id)
	{
		$query = $this->db->get_where('table', array('adminUsername' => $id));
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
		$query = $this->db->get('students');
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
		$this->db->where('id', $id);
		$this->db->delete('mytable');
	}
}
?>