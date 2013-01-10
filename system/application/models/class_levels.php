<?PHP
class Class_levels extends Model
{
	function Class_levels()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('class_levels', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('classLevelID', $id);
		$status = $this->db->update('class_levels', $data);
		return $status;
	}
	function getById($id)
	{
		$query = $this->db->get_where('class_levels', array('classLevelID' => $id));
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
		$this->db->from('class_levels');
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
		$this->db->where('classLevelID', $id);
		$status = $this->db->delete('class_levels');
		return $status;
	}
}
?>