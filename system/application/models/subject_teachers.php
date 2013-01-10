<?PHP
class Subject_teachers extends Model
{
	function Subject_teachers()
	{
		parent::Model();
	}
	function getById($id)
	{
		$query = $this->db->get_where('subject_teachers', array('subjectTeacherID'=>$id, 'status'=>1));
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	function getByTeacher($id)
	{
		$this->db->select('*');
		$this->db->from('subject_teachers');
		$this->db->join('teachers', 'subject_teachers.subjectTeacher = teachers.teacherID');
		$this->db->join('subjects', 'subject_teachers.subjectID = subjects.subjectID');
		$this->db->join('class_rooms', 'subject_teachers.classRoomID = class_rooms.classID');
		$this->db->where('subjectTeacher', $id);
		$this->db->where('subject_teachers.status', '1');
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
	function getByClass($id)
	{
		$this->db->select('*');
		$this->db->from('subject_teachers');
		$this->db->join('teachers', 'subject_teachers.subjectTeacher = teachers.teacherID');
		$this->db->join('subjects', 'subject_teachers.subjectID = subjects.subjectID');
		$this->db->join('class_rooms', 'subject_teachers.classRoomID = class_rooms.classID');
		$this->db->where('classroomID', $id);
		$this->db->where('subject_teachers.status', '1');
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
		$this->db->from('subject_teachers');
		$this->db->join('teachers', 'subject_teachers.subjectTeacher = teachers.teacherID');
		$this->db->join('subjects', 'subject_teachers.subjectID = subjects.subjectID');
		$this->db->join('class_rooms', 'subject_teachers.classRoomID = class_rooms.classID');
		$this->db->where('subject_teachers.status', '1');
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
		$this->db->where('classID', $id);
		$status = $this->db->delete('class_rooms');
		return $status;
	}
}
?>