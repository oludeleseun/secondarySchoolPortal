<?PHP
$this->load->helper('url');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>SSP | Students Listing</title>
<?PHP include('includes/assets_loader.php'); ?>
<script language="javascript">
function checkAll(){
	for (var i=0;i<document.students.elements.length;i++)
	{
		var e=document.students.elements[i];
		if ((e.name != 'allbox') && (e.type=='checkbox'))
		{
			e.checked=document.students.allbox.checked;
		}
	}
}
</script>
</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<!--[if !IE]>start head<![endif]-->
		<div id="head">
			
			<!--[if !IE]>start logo and user details<![endif]-->
			<?PHP include('includes/logoSpaceTop.php'); ?>
			
			<!--[if !IE]>end logo end user details<![endif]-->
			
			
			
			<!--[if !IE]>start menus_wrapper<![endif]-->
			<div id="menus_wrapper">
				
				
				
				
				
				<?PHP include('includes/topmenu.php'); ?>
				
				
				
				
			</div>
			<!--[if !IE]>end menus_wrapper<![endif]-->
			
			
			
		</div>
		<!--[if !IE]>end head<![endif]-->
		
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			
			
			
			
			
			<!--[if !IE]>start page<![endif]-->
			<div id="page">
				<div class="inner">
					
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					<!--[if !IE]>start section<![endif]-->	
				  <div class="section table_section">
						<!--[if !IE]>start title wrapper<![endif]-->
						<div class="title_wrapper">
							<h2><?PHP echo $divHeading; ?></h2>
							<span class="title_wrapper_left"></span>
							<span class="title_wrapper_right"></span>
						</div>
						<!--[if !IE]>end title wrapper<![endif]-->
						<!--[if !IE]>start section content<![endif]-->
						<div class="section_content">
							<!--[if !IE]>start section content top<![endif]-->
							<div class="sct">
								<div class="sct_left">
									<div class="sct_right">
										<div class="sct_left">
											<div class="sct_right">
                                            <div>
                                            	<!--[if !IE]>start system messages<![endif]-->
												<ul class="system_messages">
                                                <?PHP
												if(isset($success)){
												?>
													<li class="green"><span class="ico"></span><strong class="system_title"><?PHP echo $success; ?></strong></li>
                                                <?PHP
												}
												if(isset($warning)){
												?>
													<li class="yellow"><span class="ico"></span><strong class="system_title"><?PHP echo $warning; ?></strong></li>
                                                <?PHP
												}
												?>
												</ul>
												<!--[if !IE]>end system messages<![endif]--></div>
												<form action="<?PHP echo site_url("teacher/processScores/$subjectID/$classID/$page") ?>" method="post" name="students">
												<fieldset>
												<!--[if !IE]>start table_wrapper<![endif]-->
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
                                                    <?PHP
													if($students != false)
													{
													?>
													<table cellpadding="0" cellspacing="0" width="100%">
														<tbody><tr>
															<th>No.</th>
                                                            <th><input type="checkbox" value="on" name="allbox" id="checkbox1" onclick="checkAll();" /></th>
															<th><a href="#">Admission No</a></th>
															<th><a href="#">Student Name</a></th>
                                                            <th><a href="#">Gender</a></th>
															<th><a href="#">C.A.</a></th>
                                                            <th><a href="#">Exam</a></th>
															<th><a href="#">Total</a></th>
                                                            <th><a href="#">Grade</a></th>
                                                            <th><a href="#">Comments</a></th>
														</tr>
                                                        <?PHP
															$x = count($students);
														 	$counter = 0;
															//echo $x.' '.$startFrom;
															for($i=$startFrom; $i<$x; $i++)
															{
														?>
														<tr class="first">
															<td><?PHP echo ($counter+1); ?></td>
                                                            <td><input type="checkbox" value="<?PHP echo $students[$i]['studentSubjectID'] ?>" name="studentSubjectIDs[]" /></td>
															<td><?PHP echo $students[$i]['admissionNumber']; ?></td>
															<td><?PHP echo $students[$i]['lastname'].' '.$students[$i]['middlename'].' '.$students[$i]['firstname']; ?></td>
                                                            <td><?PHP echo $students[$i]['gender']; ?></td>
															<td><input size="5" value="<?PHP echo $students[$i]['caScore']; ?>" type="text" name="ca_<?PHP echo $students[$i]['studentSubjectID'] ?>" /></td>
                                                            <td><input size="5" value="<?PHP echo $students[$i]['examScore']; ?>" type="text" name="exam_<?PHP echo $students[$i]['studentSubjectID'] ?>" /></td>
															<td><?PHP echo $students[$i]['caScore']+$students[$i]['examScore']; ?></td>
                                                            <td><?PHP echo $students[$i]['grade']; ?></td>
                                                            <td><input value="<?PHP echo $students[$i]['comments']; ?>" type="text" name="comments_<?PHP echo $students[$i]['studentSubjectID'] ?>" /></td>
														</tr>
														<?PHP
																$counter++;
																if($counter == $perpage)
																	break;
															}
														?>
														
													</tbody></table>
                                                    <?PHP
													}
													else
														echo'No record was found';
													?>
													</div>
												</div>
												<!--[if !IE]>end table_wrapper<![endif]-->
												
												<!--[if !IE]>start table menu<![endif]-->
												<div class="table_menu">
													<ul class="left">
														<li><span class="button send_form_btn"><span><span>SAVE CHANGES</span></span><input name="" type="submit" /></span></li>
													</ul>
													<ul class="right">
														<!--<li><a href="#" class="button check_all"><span><span>CHECK ALL</span></span></a></li>
														<li><a href="#" class="button uncheck_all"><span><span>UNCHECK ALL</span></span></a></li>
														<li><span class="button approve"><span><span>APPROVE</span></span></span></li>-->
													</ul>
												</div>
												<!--[if !IE]>end table menu<![endif]-->
												
												
												</fieldset>
												</form>
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--[if !IE]>end section content top<![endif]-->
							<!--[if !IE]>start section content bottom<![endif]-->
							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							<!--[if !IE]>end section content bottom<![endif]-->
							
						</div>
						<!--[if !IE]>end section content<![endif]-->
					</div>
					<!--[if !IE]>end section<![endif]-->
					
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					
					
					<!--[if !IE]>start section<![endif]--><!--[if !IE]>end section<![endif]-->
					
					
					
					
						
				</div>
			</div>
			<!--[if !IE]>end page<![endif]-->
			<!--[if !IE]>start sidebar<![endif]-->
			<?PHP include('includes/side.php'); ?>
			<!--[if !IE]>end sidebar<![endif]-->
			
			
			
			
		</div>
		<!--[if !IE]>end content<![endif]-->
		
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	
	<!--[if !IE]>start footer<![endif]-->
	<?PHP include('includes/footer.php'); ?>
	<!--[if !IE]>end footer<![endif]-->
	
</body>
</html>
