<?PHP
class Admin extends Model
{
	function Admin()
	{
		parent::Model();
	}
	function add($data)
	{
		$this->db->insert('admin', $data);
	}
	function edit($data, $id)
	{
		$this->db->where('adminId', $id);
		$this->db->update('admin', $data);
	}
	function getById($id)
	{
		$query = $this->db->get_where('admin', array('adminId' => $id));
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
		$query = $this->db->get('admin');
		$i = 0;
		$data = array();
		foreach ($query->result_array() as $row)
		{
			$data[$i] = $row;
			$i++;
		}
	}
	function delete($id)
	{
		$this->db->where('adminId', $id);
		$this->db->delete('admin');
	}
}
?>