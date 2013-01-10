<?PHP
class Teachers extends Model
{
	function Teachers()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('teachers', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('teacherID', $id);
		$status = $this->db->update('fees', $data);
		return $status;
	}
	function getById($id)
	{
		$query = $this->db->get_where('teachers', array('teacherID' => $id));
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
		$this->db->from('teachers');
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
		$this->db->where('teacherID', $id);
		$status = $this->db->delete('teachers');
		return $status;
	}
}
?>