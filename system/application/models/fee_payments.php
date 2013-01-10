<?PHP
class Fee_payments extends Model
{
	function Fee_payments()
	{
		parent::Model();
	}
	function add($data)
	{
		$status = $this->db->insert('fee_payments', $data);
		return $status;
	}
	function edit($data, $id)
	{
		$this->db->where('feesID', $id);
		$status = $this->db->update('fee_payments', $data);
		return $status;
	}	
	function getById($id)
	{
		$query = $this->db->get_where('fee_payments', array('paymentID' => $id));
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
		$this->db->select('paymentID, academicSessionID, session, firstname, lastname, middlename, courseName, levelName, amountPaid, receiptNumber, confirmationNumber, transactionID, studentType, datePaid, fee_payments.studentID');
		$this->db->from('fee_payments');
		$this->db->join('students', 'fee_payments.studentID = students.studentID');
		$this->db->join('programs', 'students.studyProgram = programs.programID');
		$this->db->join('study_courses', 'programs.courseID = study_courses.courseID');
		$this->db->join('student_type', 'programs.studyType = student_type.studentTypeID');
		$this->db->join('academic_years', 'fee_payments.levelID = academic_years.academicYearID');
		$this->db->join('academic_sessions', 'fee_payments.academicSessionID = academic_sessions.sessionID');
		$this->db->order_by("datePaid", "asc");
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
	function getStudentPayment($studentID)
	{
		$this->db->select('paymentID, academicSessionID, session, firstname, lastname, middlename, courseName, levelName, amountPaid, receiptNumber, confirmationNumber, transactionID, studentType, datePaid, fee_payments.studentID');
		$this->db->from('fee_payments');
		$this->db->join('students', 'fee_payments.studentID = students.studentID');
		$this->db->join('programs', 'students.studyProgram = programs.programID');
		$this->db->join('study_courses', 'programs.courseID = study_courses.courseID');
		$this->db->join('student_type', 'programs.studyType = student_type.studentTypeID');
		$this->db->join('academic_years', 'fee_payments.levelID = academic_years.academicYearID');
		$this->db->join('academic_sessions', 'fee_payments.academicSessionID = academic_sessions.sessionID');
		$this->db->where('fee_payments.studentID', $studentID);
		$this->db->order_by("datePaid", "asc");
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
	
	function getPayment($paymentID)
	{
		$this->db->select('paymentID, academicSessionID, session, firstname, lastname, middlename, courseName, levelName, amountPaid, receiptNumber, confirmationNumber, transactionID, studentType, datePaid, fee_payments.studentID');
		$this->db->from('fee_payments');
		$this->db->join('students', 'fee_payments.studentID = students.studentID');
		$this->db->join('programs', 'students.studyProgram = programs.programID');
		$this->db->join('study_courses', 'programs.courseID = study_courses.courseID');
		$this->db->join('student_type', 'programs.studyType = student_type.studentTypeID');
		$this->db->join('academic_years', 'fee_payments.levelID = academic_years.academicYearID');
		$this->db->join('academic_sessions', 'fee_payments.academicSessionID = academic_sessions.sessionID');
		$this->db->where('fee_payments.paymentID', $paymentID);
		$this->db->order_by("datePaid", "asc");
		$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
		   	$row = $query->row_array();
			return $row;
		}
		else
			return false;
	}
	
}
?>