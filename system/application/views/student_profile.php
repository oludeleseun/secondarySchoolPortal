<?PHP
$this->load->helper('url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="Reflect Template" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <title>Thoman Adewunmi Internation College | Application Preview</title>
<style type="text/css">
h2 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #333333;
	font-weight: bold;
	text-decoration:none;
}
h4 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #333333;
	font-weight: bold;
	text-decoration:none;
}
.bigText {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 18px;
	color: #333333;
	font-weight: bold;
	text-decoration:none;
}
.formatDivTbl2 {background-color: #ACACAC; }
.formatDivTbl2 tr {background-color:#fff;}
.menuText3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333333;
	font-weight: bold;
	text-decoration:none;
}
.menuText3 a:link{
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333333;
	font-weight: bold;
	text-decoration:none;
}
.menuText3 a:visited{
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333333;
	font-weight: bold;
	text-decoration:none;
}
.menuText3 a:hover{
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #2378A1;
	font-weight: bold;
	text-decoration:underline;
}
.lightBlueBack2 {
	background-color: #D4D4D4;
}

/*new style codes for tables */
table {
	font: 11px/24px Verdana, Arial, Helvetica, sans-serif;
	border-collapse: collapse;
	/*width: 320px;*/
	}

th {
	padding: 0 0.5em;
	text-align: left;
	}

tr.yellow td {
	border-top: 1px solid #FB7A31;
	border-bottom: 1px solid #FB7A31;
	background: #FFC;
	}

td {
	border-bottom: 1px solid #CCC;
	padding: 0 0.5em;
	}

td.width {
	width: 190px;
	}

td.adjacent {
	border-left: 1px solid #CCC;
	text-align: center;
	}

</style>
    </head>
    
    <body>
            	<div>
                                <div class="content_block">
                                <div style=" text-align:center;">
                              <h2>&nbsp;</h2>
                              
                              <div>
                                <table width="100%" border="0">
                                  <tr>
                                    <td width="9%" style="border-bottom:none;"><img src="http://localhost/secondarySchoolPortal/assets/images/logo.jpg" alt="Logo" /></td>
                                    <td width="91%" height="96" align="left" style="border-bottom:none;"><span class="bigText">Thomas Adewunmi International College</span><br />
                                    <span class="bigText">OKO, Kwara State, NIGERIA </span></td>
                                  </tr>
                                </table>
                              </div>
                            <span class="menuText3">STUDENT PROFILE INFORMATION</span></div>
                                    <div class="box-grey">
                                   	  <h4>&nbsp;</h4>
                                      <div class="formatDivTbl">
                                        <table width="100%" border="0" cellspacing="1" cellpadding="4" class="menuText3">
                                          <tr class="yellow">
                                              <td colspan="3">Student Information</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td width="21%"><strong>Full Name</strong></td>
                                            <td width="64%"><?PHP echo $student_info['lastname'].' '.$student_info['middlename'].' '.$student_info['firstname']; ?></td>
                                            <td width="15%" rowspan="7"><img border="1" name="" src="http://localhost/secondarySchoolPortal/admin/uploads/<?PHP echo $student_info['studentImage']; ?>" width="150" height="150" alt="Candidate's Image file" />
                                          </tr>
                                          <tr>
                                            <td>Admission Number</td>
                                            <td><?PHP echo $student_info['admissionNumber']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Class</td>
                                            <td><?PHP echo $student_info['className']; ?></td>
                                          </tr>
                                          <tr>
                                            <td><strong>Date Of Birth</strong></td>
                                            <td><?PHP echo $student_info['dob']; ?></td>
                                          </tr>
                                          <tr>
                                            <td><strong>Gender</strong></td>
                                            <td><?PHP echo $student_info['gender']; ?></td>
                                          </tr>
                                          <tr>
                                            <td><strong>Residential Address</strong></td>
                                            <td><?PHP echo $student_info['residentialAddress']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Resident State</td>
                                            <td><?PHP echo $student_info['residentState']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>State Of Origin</td>
                                            <td colspan="2"><?PHP echo $student_info['stateOfOrigin']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Current Class</td>
                                            <td colspan="2"><?PHP echo $student_info['className']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>School Fees Balance</td>
                                            <td colspan="2"><?PHP echo $student_info['feesCreditBalance']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Status</td>
                                            <td colspan="2"><?PHP if($student_info['status']==1)echo'Active'; else echo'Inactive'; ?></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td colspan="2">&nbsp;</td>
                                          </tr>
                                          <tr class="yellow">
                                            <td colspan="3">PARENT INFORMATION</td>
                                          </tr>
                                          <tr>
                                            <td>Full Names</td>
                                            <td colspan="2"><?PHP echo $parent_info['lastname'].' '.$parent_info['middlename'].' '.$parent_info['firstname']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Occupation</td>
                                            <td colspan="2"><?PHP echo $parent_info['occupation']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Mailing Address</td>
                                            <td colspan="2"><?PHP echo $parent_info['mailingAddress']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Residential Address</td>
                                            <td colspan="2"><?PHP echo $parent_info['residentialAddress']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Resident State</td>
                                            <td colspan="2"><?PHP echo $parent_info['residentState']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>State Of Origin</td>
                                            <td colspan="2"><?PHP echo $parent_info['stateOfOrigin']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>E-Mail</td>
                                            <td colspan="2"><?PHP echo $parent_info['emailAddress']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Status</td>
                                            <td colspan="2"><?PHP if($parent_info['status']==1)echo'Active'; else echo'Inactive'; ?></td>
                                          </tr>
                                        </table>
                                        </p>
                                    </div>
</div>
                                  <br />
                              </div><!--end content_block-->
                                
                          </div>
        
    </body>
    
</html>