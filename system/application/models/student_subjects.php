<?PHP
class Student_subjects extends Model
{
	function Student_subjects()
	{
		parent::Model();
	}
	function edit($data, $id)
	{
		$this->db->where('studentSubjectID', $id);
		$status = $this->db->update('student_subjects', $data);
		return $status;
	}
	function getById($id)
	{
		$query = $this->db->get_where('student_subjects', array('studentSubjectID' => $id, 'status'=>1));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	function getForResultGrid($subjectTeacherID, $termID, $studentID)
	{
		$this->db->select('*');
		$this->db->from('student_subjects');
		$this->db->join('subject_teachers', 'student_subjects.subjectTeacherID = subject_teachers.subjectTeacherID');
		$this->db->where(array('student_subjects.subjectTeacherID'=>$subjectTeacherID, 'termID'=>$termID, 'studentID'=>$studentID));
		$query = $this->db->get();
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
		$this->db->from('student_subjects');
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
	function getSubjectStudents($subjectID, $termID, $teacherID, $classID)
	{
		$this->db->select('*');
		$this->db->from('student_subjects');
		$this->db->join('students', 'student_subjects.studentID = students.studentID');
		$this->db->join('session_terms', 'student_subjects.termID = session_terms.sessionTermID');
		$this->db->join('subject_teachers', 'student_subjects.subjectTeacherID = subject_teachers.subjectTeacherID');
		$this->db->where(array('subjectID' => $subjectID, 'student_subjects.termID'=>$termID, 'subjectTeacher'=>$teacherID, 'vClassID'=>$classID));
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
	function getTeacherSubjectStudents($teacherID, $termID)
	{
		$this->db->select('*');
		$this->db->from('student_subjects');
		$this->db->join('class_rooms', 'student_subjects.currentClass = class_rooms.classID');
		$this->db->where(array('currentClass' => $classID, 'student_subjects.status'=>1));
		$query = $this->db->get();
		//$query = $this->db->get_where('student_subjects', array('currentClass' => $classID, 'status'=>1));
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
	function getStudentSubjectsByClass($termID, $classID)
	{
		$this->db->select('*');
		$this->db->from('student_subjects');
		$this->db->join('students', 'student_subjects.studentID = students.studentID');
		$this->db->join('session_terms', 'student_subjects.termID = session_terms.sessionTermID');
		$this->db->join('subject_teachers', 'student_subjects.subjectTeacherID = subject_teachers.subjectTeacherID');
		$this->db->where(array('student_subjects.termID'=>$termID, 'vClassID'=>$classID));
		$this->db->group_by("student_subjects.studentID");
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
	function computeGrade($studentSubjectID)
	{
		echo'ID: '.$studentSubjectID;
		$regData = $this->getById($studentSubjectID);
		if($regData != false)
		{
			$ca = (float)$regData['caScore'];
			$exam = (float)$regData['examScore'];
			$totalScore = $ca + $exam;
			$grade = '';
			if($totalScore >= 70)
				$grade = 'A';
			else if($totalScore >= 60 && $totalScore <=69)
				$grade = 'B';
			else if($totalScore >= 50 && $totalScore <=59)
				$grade = 'C';
			else if($totalScore >= 40 && $totalScore <=49)
				$grade = 'D';
			else if($totalScore < 40)
				$grade = 'F';
			else
				$grade = 'N';
			$data['grade'] = $grade;
			echo' Grade: '.$grade.' ';
			$this->edit($data, $studentSubjectID);
		}
	}
	
	function getStudentSubjectsByStudent($termID, $studentID)
	{
		$this->db->select('*');
		$this->db->from('student_subjects');
		$this->db->join('students', 'student_subjects.studentID = students.studentID');
		$this->db->join('session_terms', 'student_subjects.termID = session_terms.sessionTermID');
		$this->db->join('subject_teachers', 'student_subjects.subjectTeacherID = subject_teachers.subjectTeacherID');
		$this->db->join('subjects', 'subject_teachers.subjectID = subjects.subjectID');//cssd
		$this->db->where(array('student_subjects.termID'=>$termID, 'student_subjects.studentID'=>$studentID));
		//$this->db->group_by("student_subjects.studentID");
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
		$this->db->where('studentSubjectID', $id);
		$status = $this->db->delete('student_subjects');
		return $status;
	}
}
?>