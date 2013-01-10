<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "studentsinfo.php" ?>
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
$students_list = new cstudents_list();
$Page =& $students_list;

// Page init
$students_list->Page_Init();

// Page main
$students_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($students->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var students_list = new ew_Page("students_list");

// page properties
students_list.PageID = "list"; // page ID
students_list.FormID = "fstudentslist"; // form ID
var EW_PAGE_ID = students_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
students_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
students_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
students_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
students_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($students->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$students_list->lTotalRecs = $students->SelectRecordCount();
	} else {
		if ($rs = $students_list->LoadRecordset())
			$students_list->lTotalRecs = $rs->RecordCount();
	}
	$students_list->lStartRec = 1;
	if ($students_list->lDisplayRecs <= 0 || ($students->Export <> "" && $students->ExportAll)) // Display all records
		$students_list->lDisplayRecs = $students_list->lTotalRecs;
	if (!($students->Export <> "" && $students->ExportAll))
		$students_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $students_list->LoadRecordset($students_list->lStartRec-1, $students_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $students->TableCaption() ?>
<?php if ($students->Export == "" && $students->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fstudentslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fstudentslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fstudentslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fstudentslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($students->Export == "" && $students->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(students_list);" style="text-decoration: none;"><img id="students_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="students_list_SearchPanel">
<form name="fstudentslistsrch" id="fstudentslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="students">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($students->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $students_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($students->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($students->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($students->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$students_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fstudentslist" id="fstudentslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_students" class="ewGridMiddlePanel">
<?php if ($students_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $students->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$students_list->RenderListOptions();

// Render list options (header, left)
$students_list->ListOptions->Render("header", "left");
?>
<?php if ($students->studentID->Visible) { // studentID ?>
	<?php if ($students->SortUrl($students->studentID) == "") { ?>
		<td><?php echo $students->studentID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->studentID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->studentID->FldCaption() ?></td><td style="width: 10px;"><?php if ($students->studentID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->studentID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->admissionNumber->Visible) { // admissionNumber ?>
	<?php if ($students->SortUrl($students->admissionNumber) == "") { ?>
		<td><?php echo $students->admissionNumber->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->admissionNumber) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->admissionNumber->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($students->admissionNumber->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->admissionNumber->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->firstname->Visible) { // firstname ?>
	<?php if ($students->SortUrl($students->firstname) == "") { ?>
		<td><?php echo $students->firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($students->firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->middlename->Visible) { // middlename ?>
	<?php if ($students->SortUrl($students->middlename) == "") { ?>
		<td><?php echo $students->middlename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->middlename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->middlename->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($students->middlename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->middlename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->lastname->Visible) { // lastname ?>
	<?php if ($students->SortUrl($students->lastname) == "") { ?>
		<td><?php echo $students->lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($students->lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->gender->Visible) { // gender ?>
	<?php if ($students->SortUrl($students->gender) == "") { ?>
		<td><?php echo $students->gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->gender->FldCaption() ?></td><td style="width: 10px;"><?php if ($students->gender->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->gender->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->dob->Visible) { // dob ?>
	<?php if ($students->SortUrl($students->dob) == "") { ?>
		<td><?php echo $students->dob->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->dob) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->dob->FldCaption() ?></td><td style="width: 10px;"><?php if ($students->dob->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->dob->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->residentState->Visible) { // residentState ?>
	<?php if ($students->SortUrl($students->residentState) == "") { ?>
		<td><?php echo $students->residentState->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->residentState) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->residentState->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($students->residentState->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->residentState->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->stateOfOrigin->Visible) { // stateOfOrigin ?>
	<?php if ($students->SortUrl($students->stateOfOrigin) == "") { ?>
		<td><?php echo $students->stateOfOrigin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->stateOfOrigin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->stateOfOrigin->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($students->stateOfOrigin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->stateOfOrigin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->currentClass->Visible) { // currentClass ?>
	<?php if ($students->SortUrl($students->currentClass) == "") { ?>
		<td><?php echo $students->currentClass->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->currentClass) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->currentClass->FldCaption() ?></td><td style="width: 10px;"><?php if ($students->currentClass->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->currentClass->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->parentID->Visible) { // parentID ?>
	<?php if ($students->SortUrl($students->parentID) == "") { ?>
		<td><?php echo $students->parentID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->parentID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->parentID->FldCaption() ?></td><td style="width: 10px;"><?php if ($students->parentID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->parentID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->feesCreditBalance->Visible) { // feesCreditBalance ?>
	<?php if ($students->SortUrl($students->feesCreditBalance) == "") { ?>
		<td><?php echo $students->feesCreditBalance->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->feesCreditBalance) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->feesCreditBalance->FldCaption() ?></td><td style="width: 10px;"><?php if ($students->feesCreditBalance->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->feesCreditBalance->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($students->status->Visible) { // status ?>
	<?php if ($students->SortUrl($students->status) == "") { ?>
		<td><?php echo $students->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $students->SortUrl($students->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $students->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($students->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($students->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$students_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($students->ExportAll && $students->Export <> "") {
	$students_list->lStopRec = $students_list->lTotalRecs;
} else {
	$students_list->lStopRec = $students_list->lStartRec + $students_list->lDisplayRecs - 1; // Set the last record to display
}
$students_list->lRecCount = $students_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $students_list->lStartRec > 1)
		$rs->Move($students_list->lStartRec - 1);
}

// Initialize aggregate
$students->RowType = EW_ROWTYPE_AGGREGATEINIT;
$students_list->RenderRow();
$students_list->lRowCnt = 0;
while (($students->CurrentAction == "gridadd" || !$rs->EOF) &&
	$students_list->lRecCount < $students_list->lStopRec) {
	$students_list->lRecCount++;
	if (intval($students_list->lRecCount) >= intval($students_list->lStartRec)) {
		$students_list->lRowCnt++;

	// Init row class and style
	$students->CssClass = "";
	$students->CssStyle = "";
	$students->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($students->CurrentAction == "gridadd") {
		$students_list->LoadDefaultValues(); // Load default values
	} else {
		$students_list->LoadRowValues($rs); // Load row values
	}
	$students->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$students_list->RenderRow();

	// Render list options
	$students_list->RenderListOptions();
?>
	<tr<?php echo $students->RowAttributes() ?>>
<?php

// Render list options (body, left)
$students_list->ListOptions->Render("body", "left");
?>
	<?php if ($students->studentID->Visible) { // studentID ?>
		<td<?php echo $students->studentID->CellAttributes() ?>>
<div<?php echo $students->studentID->ViewAttributes() ?>><?php echo $students->studentID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->admissionNumber->Visible) { // admissionNumber ?>
		<td<?php echo $students->admissionNumber->CellAttributes() ?>>
<div<?php echo $students->admissionNumber->ViewAttributes() ?>><?php echo $students->admissionNumber->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->firstname->Visible) { // firstname ?>
		<td<?php echo $students->firstname->CellAttributes() ?>>
<div<?php echo $students->firstname->ViewAttributes() ?>><?php echo $students->firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->middlename->Visible) { // middlename ?>
		<td<?php echo $students->middlename->CellAttributes() ?>>
<div<?php echo $students->middlename->ViewAttributes() ?>><?php echo $students->middlename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->lastname->Visible) { // lastname ?>
		<td<?php echo $students->lastname->CellAttributes() ?>>
<div<?php echo $students->lastname->ViewAttributes() ?>><?php echo $students->lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->gender->Visible) { // gender ?>
		<td<?php echo $students->gender->CellAttributes() ?>>
<div<?php echo $students->gender->ViewAttributes() ?>><?php echo $students->gender->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->dob->Visible) { // dob ?>
		<td<?php echo $students->dob->CellAttributes() ?>>
<div<?php echo $students->dob->ViewAttributes() ?>><?php echo $students->dob->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->residentState->Visible) { // residentState ?>
		<td<?php echo $students->residentState->CellAttributes() ?>>
<div<?php echo $students->residentState->ViewAttributes() ?>><?php echo $students->residentState->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->stateOfOrigin->Visible) { // stateOfOrigin ?>
		<td<?php echo $students->stateOfOrigin->CellAttributes() ?>>
<div<?php echo $students->stateOfOrigin->ViewAttributes() ?>><?php echo $students->stateOfOrigin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->currentClass->Visible) { // currentClass ?>
		<td<?php echo $students->currentClass->CellAttributes() ?>>
<div<?php echo $students->currentClass->ViewAttributes() ?>><?php echo $students->currentClass->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->parentID->Visible) { // parentID ?>
		<td<?php echo $students->parentID->CellAttributes() ?>>
<div<?php echo $students->parentID->ViewAttributes() ?>><?php echo $students->parentID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->feesCreditBalance->Visible) { // feesCreditBalance ?>
		<td<?php echo $students->feesCreditBalance->CellAttributes() ?>>
<div<?php echo $students->feesCreditBalance->ViewAttributes() ?>><?php echo $students->feesCreditBalance->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($students->status->Visible) { // status ?>
		<td<?php echo $students->status->CellAttributes() ?>>
<div<?php echo $students->status->ViewAttributes() ?>><?php echo $students->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$students_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($students->CurrentAction <> "gridadd")
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
<?php if ($students->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($students->CurrentAction <> "gridadd" && $students->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($students_list->Pager)) $students_list->Pager = new cPrevNextPager($students_list->lStartRec, $students_list->lDisplayRecs, $students_list->lTotalRecs) ?>
<?php if ($students_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($students_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $students_list->PageUrl() ?>start=<?php echo $students_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($students_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $students_list->PageUrl() ?>start=<?php echo $students_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $students_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($students_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $students_list->PageUrl() ?>start=<?php echo $students_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($students_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $students_list->PageUrl() ?>start=<?php echo $students_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $students_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $students_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $students_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $students_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($students_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($students_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $students_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($students->Export == "" && $students->CurrentAction == "") { ?>
<?php } ?>
<?php if ($students->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$students_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudents_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'students';

	// Page object name
	var $PageObjName = 'students_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $students;
		if ($students->UseTokenInUrl) $PageUrl .= "t=" . $students->TableVar . "&"; // Add page token
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
		global $objForm, $students;
		if ($students->UseTokenInUrl) {
			if ($objForm)
				return ($students->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($students->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudents_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (students)
		$GLOBALS["students"] = new cstudents();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["students"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "studentsdelete.php";
		$this->MultiUpdateUrl = "studentsupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'students', TRUE);

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
		global $students;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$students->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$students->Export = $_POST["exporttype"];
		} else {
			$students->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $students->Export; // Get export parameter, used in header
		$gsExportFile = $students->TableVar; // Get export file, used in header
		if ($students->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($students->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($students->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $students;

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
			$students->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($students->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $students->getRecordsPerPage(); // Restore from Session
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
		$students->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$students->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$students->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $students->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$students->setSessionWhere($sFilter);
		$students->CurrentFilter = "";

		// Export selected records
		if ($students->Export <> "")
			$students->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($students->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($students->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $students;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $students->admissionNumber, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $students->firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $students->middlename, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $students->lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $students->gender, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $students->residentialAddress, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $students->residentState, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $students->stateOfOrigin, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $students->studentImage, $Keyword);
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
		global $Security, $students;
		$sSearchStr = "";
		$sSearchKeyword = $students->BasicSearchKeyword;
		$sSearchType = $students->BasicSearchType;
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
			$students->setSessionBasicSearchKeyword($sSearchKeyword);
			$students->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $students;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$students->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $students;
		$students->setSessionBasicSearchKeyword("");
		$students->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $students;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$students->BasicSearchKeyword = $students->getSessionBasicSearchKeyword();
			$students->BasicSearchType = $students->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $students;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$students->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$students->CurrentOrderType = @$_GET["ordertype"];
			$students->UpdateSort($students->studentID); // studentID
			$students->UpdateSort($students->admissionNumber); // admissionNumber
			$students->UpdateSort($students->firstname); // firstname
			$students->UpdateSort($students->middlename); // middlename
			$students->UpdateSort($students->lastname); // lastname
			$students->UpdateSort($students->gender); // gender
			$students->UpdateSort($students->dob); // dob
			$students->UpdateSort($students->residentState); // residentState
			$students->UpdateSort($students->stateOfOrigin); // stateOfOrigin
			$students->UpdateSort($students->currentClass); // currentClass
			$students->UpdateSort($students->parentID); // parentID
			$students->UpdateSort($students->feesCreditBalance); // feesCreditBalance
			$students->UpdateSort($students->status); // status
			$students->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $students;
		$sOrderBy = $students->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($students->SqlOrderBy() <> "") {
				$sOrderBy = $students->SqlOrderBy();
				$students->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $students;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$students->setSessionOrderBy($sOrderBy);
				$students->studentID->setSort("");
				$students->admissionNumber->setSort("");
				$students->firstname->setSort("");
				$students->middlename->setSort("");
				$students->lastname->setSort("");
				$students->gender->setSort("");
				$students->dob->setSort("");
				$students->residentState->setSort("");
				$students->stateOfOrigin->setSort("");
				$students->currentClass->setSort("");
				$students->parentID->setSort("");
				$students->feesCreditBalance->setSort("");
				$students->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$students->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $students;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"students_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($students->Export <> "" ||
			$students->CurrentAction == "gridadd" ||
			$students->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $students;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($students->studentID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $students;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $students;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$students->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$students->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $students->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$students->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$students->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$students->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $students;
		$students->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$students->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $students;

		// Call Recordset Selecting event
		$students->Recordset_Selecting($students->CurrentFilter);

		// Load List page SQL
		$sSql = $students->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$students->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $students;
		$sFilter = $students->KeyFilter();

		// Call Row Selecting event
		$students->Row_Selecting($sFilter);

		// Load SQL based on filter
		$students->CurrentFilter = $sFilter;
		$sSql = $students->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$students->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $students;
		$students->studentID->setDbValue($rs->fields('studentID'));
		$students->admissionNumber->setDbValue($rs->fields('admissionNumber'));
		$students->firstname->setDbValue($rs->fields('firstname'));
		$students->middlename->setDbValue($rs->fields('middlename'));
		$students->lastname->setDbValue($rs->fields('lastname'));
		$students->gender->setDbValue($rs->fields('gender'));
		$students->dob->setDbValue($rs->fields('dob'));
		$students->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$students->residentState->setDbValue($rs->fields('residentState'));
		$students->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$students->currentClass->setDbValue($rs->fields('currentClass'));
		$students->portalUsername->setDbValue($rs->fields('portalUsername'));
		$students->portalPassword->setDbValue($rs->fields('portalPassword'));
		$students->parentID->setDbValue($rs->fields('parentID'));
		$students->studentImage->Upload->DbValue = $rs->fields('studentImage');
		$students->feesCreditBalance->setDbValue($rs->fields('feesCreditBalance'));
		$students->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $students;

		// Initialize URLs
		$this->ViewUrl = $students->ViewUrl();
		$this->EditUrl = $students->EditUrl();
		$this->InlineEditUrl = $students->InlineEditUrl();
		$this->CopyUrl = $students->CopyUrl();
		$this->InlineCopyUrl = $students->InlineCopyUrl();
		$this->DeleteUrl = $students->DeleteUrl();

		// Call Row_Rendering event
		$students->Row_Rendering();

		// Common render codes for all row types
		// studentID

		$students->studentID->CellCssStyle = ""; $students->studentID->CellCssClass = "";
		$students->studentID->CellAttrs = array(); $students->studentID->ViewAttrs = array(); $students->studentID->EditAttrs = array();

		// admissionNumber
		$students->admissionNumber->CellCssStyle = ""; $students->admissionNumber->CellCssClass = "";
		$students->admissionNumber->CellAttrs = array(); $students->admissionNumber->ViewAttrs = array(); $students->admissionNumber->EditAttrs = array();

		// firstname
		$students->firstname->CellCssStyle = ""; $students->firstname->CellCssClass = "";
		$students->firstname->CellAttrs = array(); $students->firstname->ViewAttrs = array(); $students->firstname->EditAttrs = array();

		// middlename
		$students->middlename->CellCssStyle = ""; $students->middlename->CellCssClass = "";
		$students->middlename->CellAttrs = array(); $students->middlename->ViewAttrs = array(); $students->middlename->EditAttrs = array();

		// lastname
		$students->lastname->CellCssStyle = ""; $students->lastname->CellCssClass = "";
		$students->lastname->CellAttrs = array(); $students->lastname->ViewAttrs = array(); $students->lastname->EditAttrs = array();

		// gender
		$students->gender->CellCssStyle = ""; $students->gender->CellCssClass = "";
		$students->gender->CellAttrs = array(); $students->gender->ViewAttrs = array(); $students->gender->EditAttrs = array();

		// dob
		$students->dob->CellCssStyle = ""; $students->dob->CellCssClass = "";
		$students->dob->CellAttrs = array(); $students->dob->ViewAttrs = array(); $students->dob->EditAttrs = array();

		// residentState
		$students->residentState->CellCssStyle = ""; $students->residentState->CellCssClass = "";
		$students->residentState->CellAttrs = array(); $students->residentState->ViewAttrs = array(); $students->residentState->EditAttrs = array();

		// stateOfOrigin
		$students->stateOfOrigin->CellCssStyle = ""; $students->stateOfOrigin->CellCssClass = "";
		$students->stateOfOrigin->CellAttrs = array(); $students->stateOfOrigin->ViewAttrs = array(); $students->stateOfOrigin->EditAttrs = array();

		// currentClass
		$students->currentClass->CellCssStyle = ""; $students->currentClass->CellCssClass = "";
		$students->currentClass->CellAttrs = array(); $students->currentClass->ViewAttrs = array(); $students->currentClass->EditAttrs = array();

		// parentID
		$students->parentID->CellCssStyle = ""; $students->parentID->CellCssClass = "";
		$students->parentID->CellAttrs = array(); $students->parentID->ViewAttrs = array(); $students->parentID->EditAttrs = array();

		// feesCreditBalance
		$students->feesCreditBalance->CellCssStyle = ""; $students->feesCreditBalance->CellCssClass = "";
		$students->feesCreditBalance->CellAttrs = array(); $students->feesCreditBalance->ViewAttrs = array(); $students->feesCreditBalance->EditAttrs = array();

		// status
		$students->status->CellCssStyle = ""; $students->status->CellCssClass = "";
		$students->status->CellAttrs = array(); $students->status->ViewAttrs = array(); $students->status->EditAttrs = array();
		if ($students->RowType == EW_ROWTYPE_VIEW) { // View row

			// studentID
			$students->studentID->ViewValue = $students->studentID->CurrentValue;
			$students->studentID->CssStyle = "";
			$students->studentID->CssClass = "";
			$students->studentID->ViewCustomAttributes = "";

			// admissionNumber
			$students->admissionNumber->ViewValue = $students->admissionNumber->CurrentValue;
			$students->admissionNumber->CssStyle = "";
			$students->admissionNumber->CssClass = "";
			$students->admissionNumber->ViewCustomAttributes = "";

			// firstname
			$students->firstname->ViewValue = $students->firstname->CurrentValue;
			$students->firstname->CssStyle = "";
			$students->firstname->CssClass = "";
			$students->firstname->ViewCustomAttributes = "";

			// middlename
			$students->middlename->ViewValue = $students->middlename->CurrentValue;
			$students->middlename->CssStyle = "";
			$students->middlename->CssClass = "";
			$students->middlename->ViewCustomAttributes = "";

			// lastname
			$students->lastname->ViewValue = $students->lastname->CurrentValue;
			$students->lastname->CssStyle = "";
			$students->lastname->CssClass = "";
			$students->lastname->ViewCustomAttributes = "";

			// gender
			if (strval($students->gender->CurrentValue) <> "") {
				switch ($students->gender->CurrentValue) {
					case "Male":
						$students->gender->ViewValue = "Male";
						break;
					case "Female":
						$students->gender->ViewValue = "Female";
						break;
					default:
						$students->gender->ViewValue = $students->gender->CurrentValue;
				}
			} else {
				$students->gender->ViewValue = NULL;
			}
			$students->gender->CssStyle = "";
			$students->gender->CssClass = "";
			$students->gender->ViewCustomAttributes = "";

			// dob
			$students->dob->ViewValue = $students->dob->CurrentValue;
			$students->dob->ViewValue = ew_FormatDateTime($students->dob->ViewValue, 5);
			$students->dob->CssStyle = "";
			$students->dob->CssClass = "";
			$students->dob->ViewCustomAttributes = "";

			// residentState
			$students->residentState->ViewValue = $students->residentState->CurrentValue;
			$students->residentState->CssStyle = "";
			$students->residentState->CssClass = "";
			$students->residentState->ViewCustomAttributes = "";

			// stateOfOrigin
			$students->stateOfOrigin->ViewValue = $students->stateOfOrigin->CurrentValue;
			$students->stateOfOrigin->CssStyle = "";
			$students->stateOfOrigin->CssClass = "";
			$students->stateOfOrigin->ViewCustomAttributes = "";

			// currentClass
			if (strval($students->currentClass->CurrentValue) <> "") {
				$sFilterWrk = "`classID` = " . ew_AdjustSql($students->currentClass->CurrentValue) . "";
			$sSqlWrk = "SELECT `className`, `classTeacher` FROM `class_rooms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$students->currentClass->ViewValue = $rswrk->fields('className');
					$students->currentClass->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('classTeacher');
					$rswrk->Close();
				} else {
					$students->currentClass->ViewValue = $students->currentClass->CurrentValue;
				}
			} else {
				$students->currentClass->ViewValue = NULL;
			}
			$students->currentClass->CssStyle = "";
			$students->currentClass->CssClass = "";
			$students->currentClass->ViewCustomAttributes = "";

			// parentID
			if (strval($students->parentID->CurrentValue) <> "") {
				$sFilterWrk = "`parentID` = " . ew_AdjustSql($students->parentID->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `parents`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$students->parentID->ViewValue = $rswrk->fields('firstname');
					$students->parentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$students->parentID->ViewValue = $students->parentID->CurrentValue;
				}
			} else {
				$students->parentID->ViewValue = NULL;
			}
			$students->parentID->CssStyle = "";
			$students->parentID->CssClass = "";
			$students->parentID->ViewCustomAttributes = "";

			// feesCreditBalance
			$students->feesCreditBalance->ViewValue = $students->feesCreditBalance->CurrentValue;
			$students->feesCreditBalance->CssStyle = "";
			$students->feesCreditBalance->CssClass = "";
			$students->feesCreditBalance->ViewCustomAttributes = "";

			// status
			if (strval($students->status->CurrentValue) <> "") {
				switch ($students->status->CurrentValue) {
					case "1":
						$students->status->ViewValue = "Enabled";
						break;
					case "0":
						$students->status->ViewValue = "Disabled";
						break;
					default:
						$students->status->ViewValue = $students->status->CurrentValue;
				}
			} else {
				$students->status->ViewValue = NULL;
			}
			$students->status->CssStyle = "";
			$students->status->CssClass = "";
			$students->status->ViewCustomAttributes = "";

			// studentID
			$students->studentID->HrefValue = "";
			$students->studentID->TooltipValue = "";

			// admissionNumber
			$students->admissionNumber->HrefValue = "";
			$students->admissionNumber->TooltipValue = "";

			// firstname
			$students->firstname->HrefValue = "";
			$students->firstname->TooltipValue = "";

			// middlename
			$students->middlename->HrefValue = "";
			$students->middlename->TooltipValue = "";

			// lastname
			$students->lastname->HrefValue = "";
			$students->lastname->TooltipValue = "";

			// gender
			$students->gender->HrefValue = "";
			$students->gender->TooltipValue = "";

			// dob
			$students->dob->HrefValue = "";
			$students->dob->TooltipValue = "";

			// residentState
			$students->residentState->HrefValue = "";
			$students->residentState->TooltipValue = "";

			// stateOfOrigin
			$students->stateOfOrigin->HrefValue = "";
			$students->stateOfOrigin->TooltipValue = "";

			// currentClass
			$students->currentClass->HrefValue = "";
			$students->currentClass->TooltipValue = "";

			// parentID
			$students->parentID->HrefValue = "";
			$students->parentID->TooltipValue = "";

			// feesCreditBalance
			$students->feesCreditBalance->HrefValue = "";
			$students->feesCreditBalance->TooltipValue = "";

			// status
			$students->status->HrefValue = "";
			$students->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($students->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$students->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $students;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($students->Export <> "") {
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
				$students->studentID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $students->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $students;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $students->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($students->ExportAll) {
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
		if ($students->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($students, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($students->studentID);
				$ExportDoc->ExportCaption($students->admissionNumber);
				$ExportDoc->ExportCaption($students->firstname);
				$ExportDoc->ExportCaption($students->middlename);
				$ExportDoc->ExportCaption($students->lastname);
				$ExportDoc->ExportCaption($students->gender);
				$ExportDoc->ExportCaption($students->dob);
				$ExportDoc->ExportCaption($students->residentState);
				$ExportDoc->ExportCaption($students->stateOfOrigin);
				$ExportDoc->ExportCaption($students->currentClass);
				$ExportDoc->ExportCaption($students->parentID);
				$ExportDoc->ExportCaption($students->feesCreditBalance);
				$ExportDoc->ExportCaption($students->status);
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
				$students->CssClass = "";
				$students->CssStyle = "";
				$students->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($students->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('studentID', $students->studentID->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('admissionNumber', $students->admissionNumber->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('firstname', $students->firstname->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('middlename', $students->middlename->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('lastname', $students->lastname->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('gender', $students->gender->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('dob', $students->dob->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('residentState', $students->residentState->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('stateOfOrigin', $students->stateOfOrigin->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('currentClass', $students->currentClass->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('parentID', $students->parentID->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('feesCreditBalance', $students->feesCreditBalance->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('status', $students->status->ExportValue($students->Export, $students->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($students->studentID);
					$ExportDoc->ExportField($students->admissionNumber);
					$ExportDoc->ExportField($students->firstname);
					$ExportDoc->ExportField($students->middlename);
					$ExportDoc->ExportField($students->lastname);
					$ExportDoc->ExportField($students->gender);
					$ExportDoc->ExportField($students->dob);
					$ExportDoc->ExportField($students->residentState);
					$ExportDoc->ExportField($students->stateOfOrigin);
					$ExportDoc->ExportField($students->currentClass);
					$ExportDoc->ExportField($students->parentID);
					$ExportDoc->ExportField($students->feesCreditBalance);
					$ExportDoc->ExportField($students->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($students->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($students->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($students->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($students->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($students->ExportReturnUrl());
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
