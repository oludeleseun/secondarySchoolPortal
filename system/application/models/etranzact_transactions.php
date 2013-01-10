<?PHP
class Etranzact_transactions extends Model
{
	function Etranzact_transactions()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('etranzact_transactions', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('transactionID', $id);
		$status = $this->db->update('etranzact_transactions', $data);
		return $status;
	}
	function getById($id)
	{
		$query = $this->db->get_where('etranzact_transactions', array('transactionID' => $id));
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
		$query = $this->db->get('etranzact_transactions');
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
		$this->db->where('admissionID', $id);
		$status = $this->db->delete('admissions');
		return $status;
	}
	function getByReg($regNumber)
	{
		$query = $this->db->get_where('etranzact_transactions', array('regNumber' => $regNumber));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	function pinUsed($confirmationNumber, $receiptNumber)
	{
		$query = $this->db->get_where('etranzact_transactions', array('confirmationNumber'=>$confirmationNumber, 'receiptNumber'=>$receiptNumber));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	
	function queryPIN($pinInformation)
	{
		$this->db->select('*');
		$this->db->from('etranzact_transactions');
		$this->db->like('confirmationNumber', $pinInformation);
		$this->db->or_like('receiptNumber', $pinInformation);
		$this->db->or_like('regNumber', $pinInformation);
		$this->db->or_like('amount', $pinInformation);
		$this->db->order_by("regNumber", "asc");
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
}
?>