<?PHP
class Session_terms extends Model
{
	function Session_terms()
	{
		parent::Model();
	}
	function edit($data, $id)
	{
		$this->db->where('sessionTermID', $id);
		$status = $this->db->update('session_terms', $data);
		return $status;
	}
	function getForParent($studentID)
	{
		$this->db->select('*');
		$this->db->from('student_subjects');
		$this->db->join('session_terms', 'student_subjects.termID = session_terms.sessionTermID');
		$this->db->join('academic_terms', 'session_terms.termID = academic_terms.termID');
		$this->db->join('academic_sessions', 'session_terms.session = academic_sessions.sessionID');
		$this->db->join('subject_teachers', 'student_subjects.subjectTeacherID = subject_teachers.subjectTeacherID');
		$this->db->where(array('student_subjects.studentID'=>$studentID, 'showResults'=>1));
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
	function getById($id)
	{
		$this->db->select('*');
		$this->db->from('session_terms');
		$this->db->join('academic_terms', 'session_terms.termID = academic_terms.termID');
		$this->db->join('academic_sessions', 'session_terms.session = academic_sessions.sessionID');
		$this->db->where(array('sessionTermID'=>$id, 'session_terms.status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	function getBySession($sessionID)
	{
		$this->db->select('*');
		$this->db->from('session_terms');
		$this->db->join('academic_terms', 'session_terms.termID = academic_terms.termID');
		$this->db->join('academic_sessions', 'session_terms.session = academic_sessions.sessionID');
		$this->db->where(array('sessionID'=>$sessionID, 'session_terms.status'=>1));
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
	function getAll()
	{
		$this->db->select('*');
		$this->db->from('session_terms');
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
		$this->db->select('*');
		$this->db->from('session_terms');
		$this->db->join('academic_terms', 'session_terms.termID = academic_terms.termID');
		$this->db->where(array('currentTerm'=>1, 'session_terms.status'=>1));
		$query = $this->db->get();
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
		$this->db->where('sessionTermID', $id);
		$status = $this->db->delete('session_terms');
		return $status;
	}
}
?>