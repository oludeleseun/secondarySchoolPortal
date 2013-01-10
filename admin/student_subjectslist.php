<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "student_subjectsinfo.php" ?>
<?php include "admininfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$student_subjects_list = new cstudent_subjects_list();
$Page =& $student_subjects_list;

// Page init
$student_subjects_list->Page_Init();

// Page main
$student_subjects_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($student_subjects->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var student_subjects_list = new ew_Page("student_subjects_list");

// page properties
student_subjects_list.PageID = "list"; // page ID
student_subjects_list.FormID = "fstudent_subjectslist"; // form ID
var EW_PAGE_ID = student_subjects_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
student_subjects_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
student_subjects_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
student_subjects_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
student_subjects_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($student_subjects->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$student_subjects_list->lTotalRecs = $student_subjects->SelectRecordCount();
	} else {
		if ($rs = $student_subjects_list->LoadRecordset())
			$student_subjects_list->lTotalRecs = $rs->RecordCount();
	}
	$student_subjects_list->lStartRec = 1;
	if ($student_subjects_list->lDisplayRecs <= 0 || ($student_subjects->Export <> "" && $student_subjects->ExportAll)) // Display all records
		$student_subjects_list->lDisplayRecs = $student_subjects_list->lTotalRecs;
	if (!($student_subjects->Export <> "" && $student_subjects->ExportAll))
		$student_subjects_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $student_subjects_list->LoadRecordset($student_subjects_list->lStartRec-1, $student_subjects_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $student_subjects->TableCaption() ?>
<?php if ($student_subjects->Export == "" && $student_subjects->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fstudent_subjectslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fstudent_subjectslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fstudent_subjectslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fstudent_subjectslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($student_subjects->Export == "" && $student_subjects->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(student_subjects_list);" style="text-decoration: none;"><img id="student_subjects_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="student_subjects_list_SearchPanel">
<form name="fstudent_subjectslistsrch" id="fstudent_subjectslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="student_subjects">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($student_subjects->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $student_subjects_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($student_subjects->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($student_subjects->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($student_subjects->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$student_subjects_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fstudent_subjectslist" id="fstudent_subjectslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_student_subjects" class="ewGridMiddlePanel">
<?php if ($student_subjects_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $student_subjects->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$student_subjects_list->RenderListOptions();

// Render list options (header, left)
$student_subjects_list->ListOptions->Render("header", "left");
?>
<?php if ($student_subjects->studentSubjectID->Visible) { // studentSubjectID ?>
	<?php if ($student_subjects->SortUrl($student_subjects->studentSubjectID) == "") { ?>
		<td><?php echo $student_subjects->studentSubjectID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->studentSubjectID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->studentSubjectID->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_subjects->studentSubjectID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->studentSubjectID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_subjects->studentID->Visible) { // studentID ?>
	<?php if ($student_subjects->SortUrl($student_subjects->studentID) == "") { ?>
		<td><?php echo $student_subjects->studentID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->studentID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->studentID->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_subjects->studentID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->studentID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_subjects->subjectTeacherID->Visible) { // subjectTeacherID ?>
	<?php if ($student_subjects->SortUrl($student_subjects->subjectTeacherID) == "") { ?>
		<td><?php echo $student_subjects->subjectTeacherID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->subjectTeacherID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->subjectTeacherID->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_subjects->subjectTeacherID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->subjectTeacherID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_subjects->termID->Visible) { // termID ?>
	<?php if ($student_subjects->SortUrl($student_subjects->termID) == "") { ?>
		<td><?php echo $student_subjects->termID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->termID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->termID->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_subjects->termID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->termID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_subjects->vClassID->Visible) { // vClassID ?>
	<?php if ($student_subjects->SortUrl($student_subjects->vClassID) == "") { ?>
		<td><?php echo $student_subjects->vClassID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->vClassID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->vClassID->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_subjects->vClassID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->vClassID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_subjects->caScore->Visible) { // caScore ?>
	<?php if ($student_subjects->SortUrl($student_subjects->caScore) == "") { ?>
		<td><?php echo $student_subjects->caScore->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->caScore) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->caScore->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_subjects->caScore->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->caScore->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_subjects->examScore->Visible) { // examScore ?>
	<?php if ($student_subjects->SortUrl($student_subjects->examScore) == "") { ?>
		<td><?php echo $student_subjects->examScore->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->examScore) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->examScore->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_subjects->examScore->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->examScore->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_subjects->grade->Visible) { // grade ?>
	<?php if ($student_subjects->SortUrl($student_subjects->grade) == "") { ?>
		<td><?php echo $student_subjects->grade->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->grade) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->grade->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($student_subjects->grade->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->grade->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_subjects->comments->Visible) { // comments ?>
	<?php if ($student_subjects->SortUrl($student_subjects->comments) == "") { ?>
		<td><?php echo $student_subjects->comments->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->comments) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->comments->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($student_subjects->comments->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->comments->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($student_subjects->status->Visible) { // status ?>
	<?php if ($student_subjects->SortUrl($student_subjects->status) == "") { ?>
		<td><?php echo $student_subjects->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $student_subjects->SortUrl($student_subjects->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $student_subjects->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($student_subjects->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($student_subjects->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$student_subjects_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($student_subjects->ExportAll && $student_subjects->Export <> "") {
	$student_subjects_list->lStopRec = $student_subjects_list->lTotalRecs;
} else {
	$student_subjects_list->lStopRec = $student_subjects_list->lStartRec + $student_subjects_list->lDisplayRecs - 1; // Set the last record to display
}
$student_subjects_list->lRecCount = $student_subjects_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $student_subjects_list->lStartRec > 1)
		$rs->Move($student_subjects_list->lStartRec - 1);
}

// Initialize aggregate
$student_subjects->RowType = EW_ROWTYPE_AGGREGATEINIT;
$student_subjects_list->RenderRow();
$student_subjects_list->lRowCnt = 0;
while (($student_subjects->CurrentAction == "gridadd" || !$rs->EOF) &&
	$student_subjects_list->lRecCount < $student_subjects_list->lStopRec) {
	$student_subjects_list->lRecCount++;
	if (intval($student_subjects_list->lRecCount) >= intval($student_subjects_list->lStartRec)) {
		$student_subjects_list->lRowCnt++;

	// Init row class and style
	$student_subjects->CssClass = "";
	$student_subjects->CssStyle = "";
	$student_subjects->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($student_subjects->CurrentAction == "gridadd") {
		$student_subjects_list->LoadDefaultValues(); // Load default values
	} else {
		$student_subjects_list->LoadRowValues($rs); // Load row values
	}
	$student_subjects->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$student_subjects_list->RenderRow();

	// Render list options
	$student_subjects_list->RenderListOptions();
?>
	<tr<?php echo $student_subjects->RowAttributes() ?>>
<?php

// Render list options (body, left)
$student_subjects_list->ListOptions->Render("body", "left");
?>
	<?php if ($student_subjects->studentSubjectID->Visible) { // studentSubjectID ?>
		<td<?php echo $student_subjects->studentSubjectID->CellAttributes() ?>>
<div<?php echo $student_subjects->studentSubjectID->ViewAttributes() ?>><?php echo $student_subjects->studentSubjectID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_subjects->studentID->Visible) { // studentID ?>
		<td<?php echo $student_subjects->studentID->CellAttributes() ?>>
<div<?php echo $student_subjects->studentID->ViewAttributes() ?>><?php echo $student_subjects->studentID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_subjects->subjectTeacherID->Visible) { // subjectTeacherID ?>
		<td<?php echo $student_subjects->subjectTeacherID->CellAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($student_subjects->termID->Visible) { // termID ?>
		<td<?php echo $student_subjects->termID->CellAttributes() ?>>
<div<?php echo $student_subjects->termID->ViewAttributes() ?>><?php echo $student_subjects->termID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_subjects->vClassID->Visible) { // vClassID ?>
		<td<?php echo $student_subjects->vClassID->CellAttributes() ?>>
<div<?php echo $student_subjects->vClassID->ViewAttributes() ?>><?php echo $student_subjects->vClassID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_subjects->caScore->Visible) { // caScore ?>
		<td<?php echo $student_subjects->caScore->CellAttributes() ?>>
<div<?php echo $student_subjects->caScore->ViewAttributes() ?>><?php echo $student_subjects->caScore->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_subjects->examScore->Visible) { // examScore ?>
		<td<?php echo $student_subjects->examScore->CellAttributes() ?>>
<div<?php echo $student_subjects->examScore->ViewAttributes() ?>><?php echo $student_subjects->examScore->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_subjects->grade->Visible) { // grade ?>
		<td<?php echo $student_subjects->grade->CellAttributes() ?>>
<div<?php echo $student_subjects->grade->ViewAttributes() ?>><?php echo $student_subjects->grade->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_subjects->comments->Visible) { // comments ?>
		<td<?php echo $student_subjects->comments->CellAttributes() ?>>
<div<?php echo $student_subjects->comments->ViewAttributes() ?>><?php echo $student_subjects->comments->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($student_subjects->status->Visible) { // status ?>
		<td<?php echo $student_subjects->status->CellAttributes() ?>>
<div<?php echo $student_subjects->status->ViewAttributes() ?>><?php echo $student_subjects->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$student_subjects_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($student_subjects->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($student_subjects->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($student_subjects->CurrentAction <> "gridadd" && $student_subjects->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($student_subjects_list->Pager)) $student_subjects_list->Pager = new cPrevNextPager($student_subjects_list->lStartRec, $student_subjects_list->lDisplayRecs, $student_subjects_list->lTotalRecs) ?>
<?php if ($student_subjects_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($student_subjects_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $student_subjects_list->PageUrl() ?>start=<?php echo $student_subjects_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($student_subjects_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $student_subjects_list->PageUrl() ?>start=<?php echo $student_subjects_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $student_subjects_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($student_subjects_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $student_subjects_list->PageUrl() ?>start=<?php echo $student_subjects_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($student_subjects_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $student_subjects_list->PageUrl() ?>start=<?php echo $student_subjects_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $student_subjects_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $student_subjects_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $student_subjects_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $student_subjects_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($student_subjects_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($student_subjects_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $student_subjects_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($student_subjects->Export == "" && $student_subjects->CurrentAction == "") { ?>
<?php } ?>
<?php if ($student_subjects->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$student_subjects_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudent_subjects_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'student_subjects';

	// Page object name
	var $PageObjName = 'student_subjects_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $student_subjects;
		if ($student_subjects->UseTokenInUrl) $PageUrl .= "t=" . $student_subjects->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $student_subjects;
		if ($student_subjects->UseTokenInUrl) {
			if ($objForm)
				return ($student_subjects->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($student_subjects->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudent_subjects_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (student_subjects)
		$GLOBALS["student_subjects"] = new cstudent_subjects();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["student_subjects"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "student_subjectsdelete.php";
		$this->MultiUpdateUrl = "student_subjectsupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'student_subjects', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $student_subjects;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$student_subjects->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$student_subjects->Export = $_POST["exporttype"];
		} else {
			$student_subjects->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $student_subjects->Export; // Get export parameter, used in header
		$gsExportFile = $student_subjects->TableVar; // Get export file, used in header
		if ($student_subjects->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($student_subjects->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($student_subjects->Export == "csv") {
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $student_subjects;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$student_subjects->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($student_subjects->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $student_subjects->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$student_subjects->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$student_subjects->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$student_subjects->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $student_subjects->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$student_subjects->setSessionWhere($sFilter);
		$student_subjects->CurrentFilter = "";

		// Export selected records
		if ($student_subjects->Export <> "")
			$student_subjects->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($student_subjects->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($student_subjects->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $student_subjects;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $student_subjects->grade, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $student_subjects->comments, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $student_subjects;
		$sSearchStr = "";
		$sSearchKeyword = $student_subjects->BasicSearchKeyword;
		$sSearchType = $student_subjects->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$student_subjects->setSessionBasicSearchKeyword($sSearchKeyword);
			$student_subjects->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $student_subjects;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$student_subjects->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $student_subjects;
		$student_subjects->setSessionBasicSearchKeyword("");
		$student_subjects->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $student_subjects;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$student_subjects->BasicSearchKeyword = $student_subjects->getSessionBasicSearchKeyword();
			$student_subjects->BasicSearchType = $student_subjects->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $student_subjects;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$student_subjects->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$student_subjects->CurrentOrderType = @$_GET["ordertype"];
			$student_subjects->UpdateSort($student_subjects->studentSubjectID); // studentSubjectID
			$student_subjects->UpdateSort($student_subjects->studentID); // studentID
			$student_subjects->UpdateSort($student_subjects->subjectTeacherID); // subjectTeacherID
			$student_subjects->UpdateSort($student_subjects->termID); // termID
			$student_subjects->UpdateSort($student_subjects->vClassID); // vClassID
			$student_subjects->UpdateSort($student_subjects->caScore); // caScore
			$student_subjects->UpdateSort($student_subjects->examScore); // examScore
			$student_subjects->UpdateSort($student_subjects->grade); // grade
			$student_subjects->UpdateSort($student_subjects->comments); // comments
			$student_subjects->UpdateSort($student_subjects->status); // status
			$student_subjects->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $student_subjects;
		$sOrderBy = $student_subjects->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($student_subjects->SqlOrderBy() <> "") {
				$sOrderBy = $student_subjects->SqlOrderBy();
				$student_subjects->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $student_subjects;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$student_subjects->setSessionOrderBy($sOrderBy);
				$student_subjects->studentSubjectID->setSort("");
				$student_subjects->studentID->setSort("");
				$student_subjects->subjectTeacherID->setSort("");
				$student_subjects->termID->setSort("");
				$student_subjects->vClassID->setSort("");
				$student_subjects->caScore->setSort("");
				$student_subjects->examScore->setSort("");
				$student_subjects->grade->setSort("");
				$student_subjects->comments->setSort("");
				$student_subjects->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$student_subjects->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $student_subjects;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"student_subjects_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($student_subjects->Export <> "" ||
			$student_subjects->CurrentAction == "gridadd" ||
			$student_subjects->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $student_subjects;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($student_subjects->studentSubjectID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $student_subjects;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $student_subjects;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$student_subjects->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$student_subjects->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $student_subjects->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$student_subjects->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$student_subjects->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$student_subjects->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $student_subjects;
		$student_subjects->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$student_subjects->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $student_subjects;

		// Call Recordset Selecting event
		$student_subjects->Recordset_Selecting($student_subjects->CurrentFilter);

		// Load List page SQL
		$sSql = $student_subjects->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$student_subjects->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $student_subjects;
		$sFilter = $student_subjects->KeyFilter();

		// Call Row Selecting event
		$student_subjects->Row_Selecting($sFilter);

		// Load SQL based on filter
		$student_subjects->CurrentFilter = $sFilter;
		$sSql = $student_subjects->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$student_subjects->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $student_subjects;
		$student_subjects->studentSubjectID->setDbValue($rs->fields('studentSubjectID'));
		$student_subjects->studentID->setDbValue($rs->fields('studentID'));
		$student_subjects->subjectTeacherID->setDbValue($rs->fields('subjectTeacherID'));
		$student_subjects->termID->setDbValue($rs->fields('termID'));
		$student_subjects->vClassID->setDbValue($rs->fields('vClassID'));
		$student_subjects->caScore->setDbValue($rs->fields('caScore'));
		$student_subjects->examScore->setDbValue($rs->fields('examScore'));
		$student_subjects->grade->setDbValue($rs->fields('grade'));
		$student_subjects->comments->setDbValue($rs->fields('comments'));
		$student_subjects->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $student_subjects;

		// Initialize URLs
		$this->ViewUrl = $student_subjects->ViewUrl();
		$this->EditUrl = $student_subjects->EditUrl();
		$this->InlineEditUrl = $student_subjects->InlineEditUrl();
		$this->CopyUrl = $student_subjects->CopyUrl();
		$this->InlineCopyUrl = $student_subjects->InlineCopyUrl();
		$this->DeleteUrl = $student_subjects->DeleteUrl();

		// Call Row_Rendering event
		$student_subjects->Row_Rendering();

		// Common render codes for all row types
		// studentSubjectID

		$student_subjects->studentSubjectID->CellCssStyle = ""; $student_subjects->studentSubjectID->CellCssClass = "";
		$student_subjects->studentSubjectID->CellAttrs = array(); $student_subjects->studentSubjectID->ViewAttrs = array(); $student_subjects->studentSubjectID->EditAttrs = array();

		// studentID
		$student_subjects->studentID->CellCssStyle = ""; $student_subjects->studentID->CellCssClass = "";
		$student_subjects->studentID->CellAttrs = array(); $student_subjects->studentID->ViewAttrs = array(); $student_subjects->studentID->EditAttrs = array();

		// subjectTeacherID
		$student_subjects->subjectTeacherID->CellCssStyle = ""; $student_subjects->subjectTeacherID->CellCssClass = "";
		$student_subjects->subjectTeacherID->CellAttrs = array(); $student_subjects->subjectTeacherID->ViewAttrs = array(); $student_subjects->subjectTeacherID->EditAttrs = array();

		// termID
		$student_subjects->termID->CellCssStyle = ""; $student_subjects->termID->CellCssClass = "";
		$student_subjects->termID->CellAttrs = array(); $student_subjects->termID->ViewAttrs = array(); $student_subjects->termID->EditAttrs = array();

		// vClassID
		$student_subjects->vClassID->CellCssStyle = ""; $student_subjects->vClassID->CellCssClass = "";
		$student_subjects->vClassID->CellAttrs = array(); $student_subjects->vClassID->ViewAttrs = array(); $student_subjects->vClassID->EditAttrs = array();

		// caScore
		$student_subjects->caScore->CellCssStyle = ""; $student_subjects->caScore->CellCssClass = "";
		$student_subjects->caScore->CellAttrs = array(); $student_subjects->caScore->ViewAttrs = array(); $student_subjects->caScore->EditAttrs = array();

		// examScore
		$student_subjects->examScore->CellCssStyle = ""; $student_subjects->examScore->CellCssClass = "";
		$student_subjects->examScore->CellAttrs = array(); $student_subjects->examScore->ViewAttrs = array(); $student_subjects->examScore->EditAttrs = array();

		// grade
		$student_subjects->grade->CellCssStyle = ""; $student_subjects->grade->CellCssClass = "";
		$student_subjects->grade->CellAttrs = array(); $student_subjects->grade->ViewAttrs = array(); $student_subjects->grade->EditAttrs = array();

		// comments
		$student_subjects->comments->CellCssStyle = ""; $student_subjects->comments->CellCssClass = "";
		$student_subjects->comments->CellAttrs = array(); $student_subjects->comments->ViewAttrs = array(); $student_subjects->comments->EditAttrs = array();

		// status
		$student_subjects->status->CellCssStyle = ""; $student_subjects->status->CellCssClass = "";
		$student_subjects->status->CellAttrs = array(); $student_subjects->status->ViewAttrs = array(); $student_subjects->status->EditAttrs = array();
		if ($student_subjects->RowType == EW_ROWTYPE_VIEW) { // View row

			// studentSubjectID
			$student_subjects->studentSubjectID->ViewValue = $student_subjects->studentSubjectID->CurrentValue;
			$student_subjects->studentSubjectID->CssStyle = "";
			$student_subjects->studentSubjectID->CssClass = "";
			$student_subjects->studentSubjectID->ViewCustomAttributes = "";

			// studentID
			if (strval($student_subjects->studentID->CurrentValue) <> "") {
				$sFilterWrk = "`studentID` = " . ew_AdjustSql($student_subjects->studentID->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `students`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `firstname` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_subjects->studentID->ViewValue = $rswrk->fields('firstname');
					$student_subjects->studentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$student_subjects->studentID->ViewValue = $student_subjects->studentID->CurrentValue;
				}
			} else {
				$student_subjects->studentID->ViewValue = NULL;
			}
			$student_subjects->studentID->CssStyle = "";
			$student_subjects->studentID->CssClass = "";
			$student_subjects->studentID->ViewCustomAttributes = "";

			// subjectTeacherID
			$student_subjects->subjectTeacherID->CssStyle = "";
			$student_subjects->subjectTeacherID->CssClass = "";
			$student_subjects->subjectTeacherID->ViewCustomAttributes = "";

			// termID
			$student_subjects->termID->ViewValue = $student_subjects->termID->CurrentValue;
			$student_subjects->termID->CssStyle = "";
			$student_subjects->termID->CssClass = "";
			$student_subjects->termID->ViewCustomAttributes = "";

			// vClassID
			$student_subjects->vClassID->ViewValue = $student_subjects->vClassID->CurrentValue;
			$student_subjects->vClassID->CssStyle = "";
			$student_subjects->vClassID->CssClass = "";
			$student_subjects->vClassID->ViewCustomAttributes = "";

			// caScore
			$student_subjects->caScore->ViewValue = $student_subjects->caScore->CurrentValue;
			$student_subjects->caScore->CssStyle = "";
			$student_subjects->caScore->CssClass = "";
			$student_subjects->caScore->ViewCustomAttributes = "";

			// examScore
			$student_subjects->examScore->ViewValue = $student_subjects->examScore->CurrentValue;
			$student_subjects->examScore->CssStyle = "";
			$student_subjects->examScore->CssClass = "";
			$student_subjects->examScore->ViewCustomAttributes = "";

			// grade
			$student_subjects->grade->ViewValue = $student_subjects->grade->CurrentValue;
			$student_subjects->grade->CssStyle = "";
			$student_subjects->grade->CssClass = "";
			$student_subjects->grade->ViewCustomAttributes = "";

			// comments
			$student_subjects->comments->ViewValue = $student_subjects->comments->CurrentValue;
			$student_subjects->comments->CssStyle = "";
			$student_subjects->comments->CssClass = "";
			$student_subjects->comments->ViewCustomAttributes = "";

			// status
			if (strval($student_subjects->status->CurrentValue) <> "") {
				switch ($student_subjects->status->CurrentValue) {
					case "1":
						$student_subjects->status->ViewValue = "Enabled";
						break;
					case "0":
						$student_subjects->status->ViewValue = "Disabled";
						break;
					default:
						$student_subjects->status->ViewValue = $student_subjects->status->CurrentValue;
				}
			} else {
				$student_subjects->status->ViewValue = NULL;
			}
			$student_subjects->status->CssStyle = "";
			$student_subjects->status->CssClass = "";
			$student_subjects->status->ViewCustomAttributes = "";

			// studentSubjectID
			$student_subjects->studentSubjectID->HrefValue = "";
			$student_subjects->studentSubjectID->TooltipValue = "";

			// studentID
			$student_subjects->studentID->HrefValue = "";
			$student_subjects->studentID->TooltipValue = "";

			// subjectTeacherID
			$student_subjects->subjectTeacherID->HrefValue = "";
			$student_subjects->subjectTeacherID->TooltipValue = "";

			// termID
			$student_subjects->termID->HrefValue = "";
			$student_subjects->termID->TooltipValue = "";

			// vClassID
			$student_subjects->vClassID->HrefValue = "";
			$student_subjects->vClassID->TooltipValue = "";

			// caScore
			$student_subjects->caScore->HrefValue = "";
			$student_subjects->caScore->TooltipValue = "";

			// examScore
			$student_subjects->examScore->HrefValue = "";
			$student_subjects->examScore->TooltipValue = "";

			// grade
			$student_subjects->grade->HrefValue = "";
			$student_subjects->grade->TooltipValue = "";

			// comments
			$student_subjects->comments->HrefValue = "";
			$student_subjects->comments->TooltipValue = "";

			// status
			$student_subjects->status->HrefValue = "";
			$student_subjects->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($student_subjects->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$student_subjects->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $student_subjects;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($student_subjects->Export <> "") {
			if (ew_IsHttpPost()) {
				if (isset($_POST["key_m"])) {
					$this->nKeySelected = count($_POST["key_m"]);
					$this->arKeys = ew_StripSlashes($_POST["key_m"]);
				}
			} elseif (isset($_GET["key_m"])) {
				$this->nKeySelected = count($_GET["key_m"]);
				$this->arKeys = ew_StripSlashes($_GET["key_m"]);
			}
			foreach ($this->arKeys as $sKey) {
				$sKeyFld = $sKey;
				if (!is_numeric($sKeyFld))
				 	return "";
				$student_subjects->studentSubjectID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $student_subjects->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $student_subjects;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $student_subjects->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($student_subjects->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($student_subjects->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($student_subjects, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($student_subjects->studentSubjectID);
				$ExportDoc->ExportCaption($student_subjects->studentID);
				$ExportDoc->ExportCaption($student_subjects->subjectTeacherID);
				$ExportDoc->ExportCaption($student_subjects->termID);
				$ExportDoc->ExportCaption($student_subjects->vClassID);
				$ExportDoc->ExportCaption($student_subjects->caScore);
				$ExportDoc->ExportCaption($student_subjects->examScore);
				$ExportDoc->ExportCaption($student_subjects->grade);
				$ExportDoc->ExportCaption($student_subjects->comments);
				$ExportDoc->ExportCaption($student_subjects->status);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$student_subjects->CssClass = "";
				$student_subjects->CssStyle = "";
				$student_subjects->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($student_subjects->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('studentSubjectID', $student_subjects->studentSubjectID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('studentID', $student_subjects->studentID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('subjectTeacherID', $student_subjects->subjectTeacherID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('termID', $student_subjects->termID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('vClassID', $student_subjects->vClassID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('caScore', $student_subjects->caScore->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('examScore', $student_subjects->examScore->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('grade', $student_subjects->grade->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('comments', $student_subjects->comments->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('status', $student_subjects->status->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($student_subjects->studentSubjectID);
					$ExportDoc->ExportField($student_subjects->studentID);
					$ExportDoc->ExportField($student_subjects->subjectTeacherID);
					$ExportDoc->ExportField($student_subjects->termID);
					$ExportDoc->ExportField($student_subjects->vClassID);
					$ExportDoc->ExportField($student_subjects->caScore);
					$ExportDoc->ExportField($student_subjects->examScore);
					$ExportDoc->ExportField($student_subjects->grade);
					$ExportDoc->ExportField($student_subjects->comments);
					$ExportDoc->ExportField($student_subjects->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($student_subjects->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($student_subjects->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($student_subjects->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($student_subjects->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($student_subjects->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
