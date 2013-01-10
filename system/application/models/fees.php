<?PHP
class Fees extends Model
{
	function Fees()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('fees', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('feesID', $id);
		$status = $this->db->update('fees', $data);
		return $status;
	}
	function getById($id)
	{
		$query = $this->db->get_where('fees', array('feeID' => $id));
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
		$this->db->select('fees.feeID, feeName, courseName, studentType, levelName, amount');
		$this->db->from('fees');
		$this->db->join('programs', 'fees.programID = programs.programID');
		$this->db->join('study_courses', 'programs.courseID = study_courses.courseID');
		$this->db->join('student_type', 'programs.studyType = student_type.studentTypeID');
		$this->db->join('academic_years', 'fees.levelID = academic_years.academicYearID');
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
		$status = $this->db->delete('fees');
		return $status;
	}
	function validateDuplicate($programID, $levelID)
	{
		$query = $this->db->get_where('fees', array('programID'=>$programID, 'levelID'=>$levelID));
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	function validateDuplicateEdit($programID, $levelID, $feesID)
	{
		$query = $this->db->get_where('fees', array('programID'=>$programID, 'levelID'=>$levelID, 'feeID !='=>$feesID));
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	
}
?>