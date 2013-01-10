<?PHP
class Tuition extends Model
{
	function Tuition()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('tuition', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('tuitionID', $id);
		$status = $this->db->update('tuition', $data);
		return $status;
	}
	function getById($id)
	{
		$query = $this->db->get_where('tuition', array('tuitionID' => $id));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	function getByProgramLevel($programID, $levelID)
	{
		$query = $this->db->get_where('tuition', array('programID' => $programID, 'levelID'=>$levelID));
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
		$this->db->select('tuition.tuitionID, courseName, studentType, levelName, amount, period, minimumPercentageAcceptable');
		$this->db->from('tuition');
		$this->db->join('programs', 'tuition.programID = programs.programID');
		$this->db->join('study_courses', 'programs.courseID = study_courses.courseID');
		$this->db->join('student_type', 'programs.studyType = student_type.studentTypeID');
		$this->db->join('academic_years', 'tuition.levelID = academic_years.academicYearID');
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
		$this->db->where('tuitionID', $id);
		$status = $this->db->delete('tuition');
		return $status;
	}
	function validateDuplicate($programID, $levelID)
	{
		$query = $this->db->get_where('tuition', array('programID'=>$programID, 'levelID'=>$levelID));
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	function validateDuplicateEdit($programID, $levelID, $tuitionID)
	{
		$query = $this->db->get_where('tuition', array('programID'=>$programID, 'levelID'=>$levelID, 'tuitionID !='=>$tuitionID));
		if ($query->num_rows() > 0)
			return true;
		else
			return false;
	}
	function addFeeToStudent($studentID, $amount)
	{
		$sql = "UPDATE students SET feesCreditBalance = feesCreditBalance + $amount WHERE studentID='$studentID'";
		$status = $this->db->query($sql);
		return $status;
	}
	function creditStudent($studentID, $amount)//function to call after student has paid school fees
	{
		$sql = "UPDATE students SET feesCreditBalance = feesCreditBalance - $amount WHERE studentID='$studentID'";
		$status = $this->db->query($sql);
		return $status;
	}
}
?>