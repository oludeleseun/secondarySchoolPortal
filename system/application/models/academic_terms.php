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
		$status = $this->db->update('academic_terms', $data);
		return $status;
	}
	function getById($id)
	{
		$this->db->order_by('termStart', 'asc');
		$query = $this->db->get_where('academic_terms', array('sessionID'=>$id, 'status'=>1));
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
		$this->db->from('academic_terms');
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
		$query = $this->db->get_where('academic_terms', array('current'=>1, 'status'=>1));
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
		$status = $this->db->delete('academic_terms');
		return $status;
	}
	
	function getForParent($studentID)
	{
		$this->db->select('*');
		$this->db->from('student_subjects');
		$this->db->join('session_terms', 'student_subjects.termID = session_terms.sessionTermID');
		$this->db->join('academic_terms', 'session_terms.termID = academic_terms.termID');
		$this->db->join('subject_teachers', 'student_subjects.subjectTeacherID = subject_teachers.subjectTeacherID');
		$this->db->where(array('student_subjects.studentID'=>$studentID));
		$this->db->group_by("student_subjects.termID");
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