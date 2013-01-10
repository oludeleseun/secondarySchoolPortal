<?PHP
class Fees_invoice extends Model
{
	function Fees_invoice()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('fees_invoice', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('fees_invoiceID', $id);
		$status = $this->db->update('fees_invoice', $data);
		return $status;
	}
	function getById($id)
	{
		$query = $this->db->get_where('fees_invoice', array('feeID' => $id));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	function getByStudent($studentID, $sessionID)
	{
		$query = $this->db->get_where('fees_invoice', array('studentID'=>$studentID, 'sessionID'=>$sessionID));
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
		$this->db->select('fees_invoice.feeID, feeName, courseName, studentType, levelName, amount');
		$this->db->from('fees_invoice');
		$this->db->join('programs', 'fees_invoice.programID = programs.programID');
		$this->db->join('study_courses', 'programs.courseID = study_courses.courseID');
		$this->db->join('student_type', 'programs.studyType = student_type.studentTypeID');
		$this->db->join('academic_years', 'fees_invoice.levelID = academic_years.academicYearID');
		$this->db->order_by("courseName", "asc");
		$this->db->order_by("levelName", "asc");
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
		$this->db->where('feeID', $id);
		$status = $this->db->delete('fees_invoice');
		return $status;
	}
	function validateDuplicate($programID, $levelID)
	{
		$query = $this->db->get_where('fees_invoice', array('programID'=>$programID, 'levelID'=>$levelID));
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	function validateDuplicateEdit($programID, $levelID, $fees_invoiceID)
	{
		$query = $this->db->get_where('fees_invoice', array('programID'=>$programID, 'levelID'=>$levelID, 'feeID !='=>$fees_invoiceID));
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	
}
?>