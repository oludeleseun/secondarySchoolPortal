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
                                    <td width="7%" rowspan="2" style="border-bottom:none;"><img src="http://epp.unad.edu.ng/assets/images/unadLogo.png" width="62" height="95" alt="Logo" /></td>
                                    <td width="93%" height="96" align="center" style="border-bottom:none;"><span class="bigText">Thomas Adewunmi International College</span><br />
                                    <span class="bigText">OKO, Kwara State, NIGERIA </span>                                   <br />
                                    <span class="bigText"><strong>www.adewunmi.edu.ng</strong></span></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" align="center" valign="top" style="border-bottom:none;">&nbsp;</td>
                                  </tr>
                                </table>
                              </div>
                            <span class="menuText3">STUDENT RESULT</span></div>
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
                                            <td width="64%"><?PHP echo $result_info['lastname'].' '.$result_info['middlename'].' '.$result_info['firstname']; ?></td>
                                            <td width="15%" rowspan="7"><img border="1" name="" src="http://localhost/secondarySchoolPortal/admin/uploads/<?PHP echo $result_info['studentImage']; ?>" width="150" height="150" alt="Candidate's Image file" />
                                          </tr>
                                          <tr>
                                            <td>Admission Number</td>
                                            <td><?PHP echo $result_info['admissionNumber']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Class</td>
                                            <td><?PHP echo $result_info['className']; ?></td>
                                          </tr>
                                          <tr>
                                            <td><strong>Date Of Birth</strong></td>
                                            <td><?PHP echo $result_info['dob']; ?></td>
                                          </tr>
                                          <tr>
                                            <td><strong>Gender</strong></td>
                                            <td><?PHP echo $result_info['gender']; ?></td>
                                          </tr>
                                          <tr>
                                            <td><strong>Number Of Times School Opened</strong></td>
                                            <td><?PHP echo $result_info['schoolOpened']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Number Of Times Present</td>
                                            <td><?PHP echo $result_info['timesPresent']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Term</td>
                                            <td colspan="2"><?PHP echo $result_info['termName']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Session</td>
                                            <td colspan="2"><?PHP echo $result_info['sessionName']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>Next Term Begins</td>
                                            <td colspan="2">&nbsp;</td>
                                          </tr>
                                </table></div>
                                        <h4>&nbsp;</h4>
                                        <div class="formatDivTbl">
                                        <table width="100%" border="0" cellspacing="1" cellpadding="4" class="menuText3">
                                        <tr class="yellow">
                                              <td width="13%">SUBJECT</td>
                                              <td width="9%">CA SCORE</td>
                                              <td width="9%">EXAM SCORE</td>
                                              <td width="12%">WEIGHTED AVERAGE</td>
                                              <td width="10%">SESSION AVG.</td>
                                              <td width="9%">TERM GRADE</td>
                                              <td width="10%">SESSION GRADE</td>
                                              <td width="28%">SUBJECT TEACHER'S COMMENTS</td>
                                          </tr>
                                        <?PHP
											if($result_details != false)
											{
												$x = count($result_details);
												for($i=0; $i<$x; $i++)
												{
										?>
                                          <tr>
                                            <td><?PHP echo $result_details[$i]['subjectName']; ?></td>
                                            <td><?PHP echo $result_details[$i]['caScore']; ?></td>
                                            <td><?PHP echo $result_details[$i]['examScore']; ?></td>
                                            <td><?PHP echo $result_details[$i]['examScore']+$result_details[$i]['caScore']; ?></td>
                                            <td>&nbsp;</td>
                                            <td><?PHP echo $result_details[$i]['grade']; ?></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <?PHP
												}
											}
										  ?>
                                        </table></div>
                        <h4>&nbsp;</h4>
                        <div class="formatDivTbl">
                          <table width="100%" border="0" cellspacing="1" cellpadding="4" class="menuText3">
                            <tr class="yellow">
                                              <td colspan="3">&nbsp;</td>
                            </tr>
                                          <tr>
                                            <td width="21%">&nbsp;</td>
                                            <td width="79%">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                          </table></div>
                                        </p>
                                    </div>
                                  <br />
                              </div><!--end content_block-->
                                
                          </div>
        
    </body>
    
</html>