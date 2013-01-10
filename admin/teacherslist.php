<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "teachersinfo.php" ?>
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
$teachers_list = new cteachers_list();
$Page =& $teachers_list;

// Page init
$teachers_list->Page_Init();

// Page main
$teachers_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($teachers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var teachers_list = new ew_Page("teachers_list");

// page properties
teachers_list.PageID = "list"; // page ID
teachers_list.FormID = "fteacherslist"; // form ID
var EW_PAGE_ID = teachers_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
teachers_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
teachers_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
teachers_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
teachers_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($teachers->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$teachers_list->lTotalRecs = $teachers->SelectRecordCount();
	} else {
		if ($rs = $teachers_list->LoadRecordset())
			$teachers_list->lTotalRecs = $rs->RecordCount();
	}
	$teachers_list->lStartRec = 1;
	if ($teachers_list->lDisplayRecs <= 0 || ($teachers->Export <> "" && $teachers->ExportAll)) // Display all records
		$teachers_list->lDisplayRecs = $teachers_list->lTotalRecs;
	if (!($teachers->Export <> "" && $teachers->ExportAll))
		$teachers_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $teachers_list->LoadRecordset($teachers_list->lStartRec-1, $teachers_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $teachers->TableCaption() ?>
<?php if ($teachers->Export == "" && $teachers->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fteacherslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fteacherslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fteacherslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fteacherslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($teachers->Export == "" && $teachers->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(teachers_list);" style="text-decoration: none;"><img id="teachers_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="teachers_list_SearchPanel">
<form name="fteacherslistsrch" id="fteacherslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="teachers">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($teachers->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $teachers_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($teachers->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($teachers->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($teachers->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$teachers_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fteacherslist" id="fteacherslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_teachers" class="ewGridMiddlePanel">
<?php if ($teachers_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $teachers->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$teachers_list->RenderListOptions();

// Render list options (header, left)
$teachers_list->ListOptions->Render("header", "left");
?>
<?php if ($teachers->teacherID->Visible) { // teacherID ?>
	<?php if ($teachers->SortUrl($teachers->teacherID) == "") { ?>
		<td><?php echo $teachers->teacherID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $teachers->SortUrl($teachers->teacherID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $teachers->teacherID->FldCaption() ?></td><td style="width: 10px;"><?php if ($teachers->teacherID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($teachers->teacherID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($teachers->firstname->Visible) { // firstname ?>
	<?php if ($teachers->SortUrl($teachers->firstname) == "") { ?>
		<td><?php echo $teachers->firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $teachers->SortUrl($teachers->firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $teachers->firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($teachers->firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($teachers->firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($teachers->middlename->Visible) { // middlename ?>
	<?php if ($teachers->SortUrl($teachers->middlename) == "") { ?>
		<td><?php echo $teachers->middlename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $teachers->SortUrl($teachers->middlename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $teachers->middlename->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($teachers->middlename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($teachers->middlename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($teachers->lastname->Visible) { // lastname ?>
	<?php if ($teachers->SortUrl($teachers->lastname) == "") { ?>
		<td><?php echo $teachers->lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $teachers->SortUrl($teachers->lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $teachers->lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($teachers->lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($teachers->lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($teachers->qualification->Visible) { // qualification ?>
	<?php if ($teachers->SortUrl($teachers->qualification) == "") { ?>
		<td><?php echo $teachers->qualification->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $teachers->SortUrl($teachers->qualification) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $teachers->qualification->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($teachers->qualification->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($teachers->qualification->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($teachers->stateOfOrigin->Visible) { // stateOfOrigin ?>
	<?php if ($teachers->SortUrl($teachers->stateOfOrigin) == "") { ?>
		<td><?php echo $teachers->stateOfOrigin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $teachers->SortUrl($teachers->stateOfOrigin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $teachers->stateOfOrigin->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($teachers->stateOfOrigin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($teachers->stateOfOrigin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($teachers->zemail->Visible) { // email ?>
	<?php if ($teachers->SortUrl($teachers->zemail) == "") { ?>
		<td><?php echo $teachers->zemail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $teachers->SortUrl($teachers->zemail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $teachers->zemail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($teachers->zemail->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($teachers->zemail->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($teachers->username->Visible) { // username ?>
	<?php if ($teachers->SortUrl($teachers->username) == "") { ?>
		<td><?php echo $teachers->username->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $teachers->SortUrl($teachers->username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $teachers->username->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($teachers->username->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($teachers->username->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($teachers->status->Visible) { // status ?>
	<?php if ($teachers->SortUrl($teachers->status) == "") { ?>
		<td><?php echo $teachers->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $teachers->SortUrl($teachers->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $teachers->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($teachers->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($teachers->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$teachers_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($teachers->ExportAll && $teachers->Export <> "") {
	$teachers_list->lStopRec = $teachers_list->lTotalRecs;
} else {
	$teachers_list->lStopRec = $teachers_list->lStartRec + $teachers_list->lDisplayRecs - 1; // Set the last record to display
}
$teachers_list->lRecCount = $teachers_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $teachers_list->lStartRec > 1)
		$rs->Move($teachers_list->lStartRec - 1);
}

// Initialize aggregate
$teachers->RowType = EW_ROWTYPE_AGGREGATEINIT;
$teachers_list->RenderRow();
$teachers_list->lRowCnt = 0;
while (($teachers->CurrentAction == "gridadd" || !$rs->EOF) &&
	$teachers_list->lRecCount < $teachers_list->lStopRec) {
	$teachers_list->lRecCount++;
	if (intval($teachers_list->lRecCount) >= intval($teachers_list->lStartRec)) {
		$teachers_list->lRowCnt++;

	// Init row class and style
	$teachers->CssClass = "";
	$teachers->CssStyle = "";
	$teachers->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($teachers->CurrentAction == "gridadd") {
		$teachers_list->LoadDefaultValues(); // Load default values
	} else {
		$teachers_list->LoadRowValues($rs); // Load row values
	}
	$teachers->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$teachers_list->RenderRow();

	// Render list options
	$teachers_list->RenderListOptions();
?>
	<tr<?php echo $teachers->RowAttributes() ?>>
<?php

// Render list options (body, left)
$teachers_list->ListOptions->Render("body", "left");
?>
	<?php if ($teachers->teacherID->Visible) { // teacherID ?>
		<td<?php echo $teachers->teacherID->CellAttributes() ?>>
<div<?php echo $teachers->teacherID->ViewAttributes() ?>><?php echo $teachers->teacherID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($teachers->firstname->Visible) { // firstname ?>
		<td<?php echo $teachers->firstname->CellAttributes() ?>>
<div<?php echo $teachers->firstname->ViewAttributes() ?>><?php echo $teachers->firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($teachers->middlename->Visible) { // middlename ?>
		<td<?php echo $teachers->middlename->CellAttributes() ?>>
<div<?php echo $teachers->middlename->ViewAttributes() ?>><?php echo $teachers->middlename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($teachers->lastname->Visible) { // lastname ?>
		<td<?php echo $teachers->lastname->CellAttributes() ?>>
<div<?php echo $teachers->lastname->ViewAttributes() ?>><?php echo $teachers->lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($teachers->qualification->Visible) { // qualification ?>
		<td<?php echo $teachers->qualification->CellAttributes() ?>>
<div<?php echo $teachers->qualification->ViewAttributes() ?>><?php echo $teachers->qualification->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($teachers->stateOfOrigin->Visible) { // stateOfOrigin ?>
		<td<?php echo $teachers->stateOfOrigin->CellAttributes() ?>>
<div<?php echo $teachers->stateOfOrigin->ViewAttributes() ?>><?php echo $teachers->stateOfOrigin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($teachers->zemail->Visible) { // email ?>
		<td<?php echo $teachers->zemail->CellAttributes() ?>>
<div<?php echo $teachers->zemail->ViewAttributes() ?>><?php echo $teachers->zemail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($teachers->username->Visible) { // username ?>
		<td<?php echo $teachers->username->CellAttributes() ?>>
<div<?php echo $teachers->username->ViewAttributes() ?>><?php echo $teachers->username->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($teachers->status->Visible) { // status ?>
		<td<?php echo $teachers->status->CellAttributes() ?>>
<div<?php echo $teachers->status->ViewAttributes() ?>><?php echo $teachers->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$teachers_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($teachers->CurrentAction <> "gridadd")
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
<?php if ($teachers->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($teachers->CurrentAction <> "gridadd" && $teachers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($teachers_list->Pager)) $teachers_list->Pager = new cPrevNextPager($teachers_list->lStartRec, $teachers_list->lDisplayRecs, $teachers_list->lTotalRecs) ?>
<?php if ($teachers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($teachers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $teachers_list->PageUrl() ?>start=<?php echo $teachers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($teachers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $teachers_list->PageUrl() ?>start=<?php echo $teachers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $teachers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($teachers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $teachers_list->PageUrl() ?>start=<?php echo $teachers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($teachers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $teachers_list->PageUrl() ?>start=<?php echo $teachers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $teachers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $teachers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $teachers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $teachers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($teachers_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($teachers_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $teachers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($teachers->Export == "" && $teachers->CurrentAction == "") { ?>
<?php } ?>
<?php if ($teachers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$teachers_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cteachers_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'teachers';

	// Page object name
	var $PageObjName = 'teachers_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $teachers;
		if ($teachers->UseTokenInUrl) $PageUrl .= "t=" . $teachers->TableVar . "&"; // Add page token
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
		global $objForm, $teachers;
		if ($teachers->UseTokenInUrl) {
			if ($objForm)
				return ($teachers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($teachers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cteachers_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (teachers)
		$GLOBALS["teachers"] = new cteachers();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["teachers"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "teachersdelete.php";
		$this->MultiUpdateUrl = "teachersupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'teachers', TRUE);

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
		global $teachers;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$teachers->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$teachers->Export = $_POST["exporttype"];
		} else {
			$teachers->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $teachers->Export; // Get export parameter, used in header
		$gsExportFile = $teachers->TableVar; // Get export file, used in header
		if ($teachers->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($teachers->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($teachers->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $teachers;

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
			$teachers->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($teachers->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $teachers->getRecordsPerPage(); // Restore from Session
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
		$teachers->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$teachers->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$teachers->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $teachers->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$teachers->setSessionWhere($sFilter);
		$teachers->CurrentFilter = "";

		// Export selected records
		if ($teachers->Export <> "")
			$teachers->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($teachers->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($teachers->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $teachers;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $teachers->firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->middlename, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->qualification, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->stateOfOrigin, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->aboutTeacher, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->residentialAddress, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->zemail, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->username, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->portalPassword, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $teachers->teacherImage, $Keyword);
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
		global $Security, $teachers;
		$sSearchStr = "";
		$sSearchKeyword = $teachers->BasicSearchKeyword;
		$sSearchType = $teachers->BasicSearchType;
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
			$teachers->setSessionBasicSearchKeyword($sSearchKeyword);
			$teachers->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $teachers;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$teachers->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $teachers;
		$teachers->setSessionBasicSearchKeyword("");
		$teachers->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $teachers;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$teachers->BasicSearchKeyword = $teachers->getSessionBasicSearchKeyword();
			$teachers->BasicSearchType = $teachers->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $teachers;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$teachers->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$teachers->CurrentOrderType = @$_GET["ordertype"];
			$teachers->UpdateSort($teachers->teacherID); // teacherID
			$teachers->UpdateSort($teachers->firstname); // firstname
			$teachers->UpdateSort($teachers->middlename); // middlename
			$teachers->UpdateSort($teachers->lastname); // lastname
			$teachers->UpdateSort($teachers->qualification); // qualification
			$teachers->UpdateSort($teachers->stateOfOrigin); // stateOfOrigin
			$teachers->UpdateSort($teachers->zemail); // email
			$teachers->UpdateSort($teachers->username); // username
			$teachers->UpdateSort($teachers->status); // status
			$teachers->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $teachers;
		$sOrderBy = $teachers->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($teachers->SqlOrderBy() <> "") {
				$sOrderBy = $teachers->SqlOrderBy();
				$teachers->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $teachers;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$teachers->setSessionOrderBy($sOrderBy);
				$teachers->teacherID->setSort("");
				$teachers->firstname->setSort("");
				$teachers->middlename->setSort("");
				$teachers->lastname->setSort("");
				$teachers->qualification->setSort("");
				$teachers->stateOfOrigin->setSort("");
				$teachers->zemail->setSort("");
				$teachers->username->setSort("");
				$teachers->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$teachers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $teachers;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"teachers_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($teachers->Export <> "" ||
			$teachers->CurrentAction == "gridadd" ||
			$teachers->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $teachers;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($teachers->teacherID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $teachers;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $teachers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$teachers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$teachers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $teachers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$teachers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$teachers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$teachers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $teachers;
		$teachers->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$teachers->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $teachers;

		// Call Recordset Selecting event
		$teachers->Recordset_Selecting($teachers->CurrentFilter);

		// Load List page SQL
		$sSql = $teachers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$teachers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $teachers;
		$sFilter = $teachers->KeyFilter();

		// Call Row Selecting event
		$teachers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$teachers->CurrentFilter = $sFilter;
		$sSql = $teachers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$teachers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $teachers;
		$teachers->teacherID->setDbValue($rs->fields('teacherID'));
		$teachers->firstname->setDbValue($rs->fields('firstname'));
		$teachers->middlename->setDbValue($rs->fields('middlename'));
		$teachers->lastname->setDbValue($rs->fields('lastname'));
		$teachers->qualification->setDbValue($rs->fields('qualification'));
		$teachers->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$teachers->aboutTeacher->setDbValue($rs->fields('aboutTeacher'));
		$teachers->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$teachers->zemail->setDbValue($rs->fields('email'));
		$teachers->username->setDbValue($rs->fields('username'));
		$teachers->portalPassword->setDbValue($rs->fields('portalPassword'));
		$teachers->status->setDbValue($rs->fields('status'));
		$teachers->teacherImage->Upload->DbValue = $rs->fields('teacherImage');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $teachers;

		// Initialize URLs
		$this->ViewUrl = $teachers->ViewUrl();
		$this->EditUrl = $teachers->EditUrl();
		$this->InlineEditUrl = $teachers->InlineEditUrl();
		$this->CopyUrl = $teachers->CopyUrl();
		$this->InlineCopyUrl = $teachers->InlineCopyUrl();
		$this->DeleteUrl = $teachers->DeleteUrl();

		// Call Row_Rendering event
		$teachers->Row_Rendering();

		// Common render codes for all row types
		// teacherID

		$teachers->teacherID->CellCssStyle = ""; $teachers->teacherID->CellCssClass = "";
		$teachers->teacherID->CellAttrs = array(); $teachers->teacherID->ViewAttrs = array(); $teachers->teacherID->EditAttrs = array();

		// firstname
		$teachers->firstname->CellCssStyle = ""; $teachers->firstname->CellCssClass = "";
		$teachers->firstname->CellAttrs = array(); $teachers->firstname->ViewAttrs = array(); $teachers->firstname->EditAttrs = array();

		// middlename
		$teachers->middlename->CellCssStyle = ""; $teachers->middlename->CellCssClass = "";
		$teachers->middlename->CellAttrs = array(); $teachers->middlename->ViewAttrs = array(); $teachers->middlename->EditAttrs = array();

		// lastname
		$teachers->lastname->CellCssStyle = ""; $teachers->lastname->CellCssClass = "";
		$teachers->lastname->CellAttrs = array(); $teachers->lastname->ViewAttrs = array(); $teachers->lastname->EditAttrs = array();

		// qualification
		$teachers->qualification->CellCssStyle = ""; $teachers->qualification->CellCssClass = "";
		$teachers->qualification->CellAttrs = array(); $teachers->qualification->ViewAttrs = array(); $teachers->qualification->EditAttrs = array();

		// stateOfOrigin
		$teachers->stateOfOrigin->CellCssStyle = ""; $teachers->stateOfOrigin->CellCssClass = "";
		$teachers->stateOfOrigin->CellAttrs = array(); $teachers->stateOfOrigin->ViewAttrs = array(); $teachers->stateOfOrigin->EditAttrs = array();

		// email
		$teachers->zemail->CellCssStyle = ""; $teachers->zemail->CellCssClass = "";
		$teachers->zemail->CellAttrs = array(); $teachers->zemail->ViewAttrs = array(); $teachers->zemail->EditAttrs = array();

		// username
		$teachers->username->CellCssStyle = ""; $teachers->username->CellCssClass = "";
		$teachers->username->CellAttrs = array(); $teachers->username->ViewAttrs = array(); $teachers->username->EditAttrs = array();

		// status
		$teachers->status->CellCssStyle = ""; $teachers->status->CellCssClass = "";
		$teachers->status->CellAttrs = array(); $teachers->status->ViewAttrs = array(); $teachers->status->EditAttrs = array();
		if ($teachers->RowType == EW_ROWTYPE_VIEW) { // View row

			// teacherID
			$teachers->teacherID->ViewValue = $teachers->teacherID->CurrentValue;
			$teachers->teacherID->CssStyle = "";
			$teachers->teacherID->CssClass = "";
			$teachers->teacherID->ViewCustomAttributes = "";

			// firstname
			$teachers->firstname->ViewValue = $teachers->firstname->CurrentValue;
			$teachers->firstname->CssStyle = "";
			$teachers->firstname->CssClass = "";
			$teachers->firstname->ViewCustomAttributes = "";

			// middlename
			$teachers->middlename->ViewValue = $teachers->middlename->CurrentValue;
			$teachers->middlename->CssStyle = "";
			$teachers->middlename->CssClass = "";
			$teachers->middlename->ViewCustomAttributes = "";

			// lastname
			$teachers->lastname->ViewValue = $teachers->lastname->CurrentValue;
			$teachers->lastname->CssStyle = "";
			$teachers->lastname->CssClass = "";
			$teachers->lastname->ViewCustomAttributes = "";

			// qualification
			$teachers->qualification->ViewValue = $teachers->qualification->CurrentValue;
			$teachers->qualification->CssStyle = "";
			$teachers->qualification->CssClass = "";
			$teachers->qualification->ViewCustomAttributes = "";

			// stateOfOrigin
			$teachers->stateOfOrigin->ViewValue = $teachers->stateOfOrigin->CurrentValue;
			$teachers->stateOfOrigin->CssStyle = "";
			$teachers->stateOfOrigin->CssClass = "";
			$teachers->stateOfOrigin->ViewCustomAttributes = "";

			// email
			$teachers->zemail->ViewValue = $teachers->zemail->CurrentValue;
			$teachers->zemail->CssStyle = "";
			$teachers->zemail->CssClass = "";
			$teachers->zemail->ViewCustomAttributes = "";

			// username
			$teachers->username->ViewValue = $teachers->username->CurrentValue;
			$teachers->username->CssStyle = "";
			$teachers->username->CssClass = "";
			$teachers->username->ViewCustomAttributes = "";

			// status
			if (strval($teachers->status->CurrentValue) <> "") {
				switch ($teachers->status->CurrentValue) {
					case "1":
						$teachers->status->ViewValue = "Enabled";
						break;
					case "0":
						$teachers->status->ViewValue = "Disabled";
						break;
					default:
						$teachers->status->ViewValue = $teachers->status->CurrentValue;
				}
			} else {
				$teachers->status->ViewValue = NULL;
			}
			$teachers->status->CssStyle = "";
			$teachers->status->CssClass = "";
			$teachers->status->ViewCustomAttributes = "";

			// teacherID
			$teachers->teacherID->HrefValue = "";
			$teachers->teacherID->TooltipValue = "";

			// firstname
			$teachers->firstname->HrefValue = "";
			$teachers->firstname->TooltipValue = "";

			// middlename
			$teachers->middlename->HrefValue = "";
			$teachers->middlename->TooltipValue = "";

			// lastname
			$teachers->lastname->HrefValue = "";
			$teachers->lastname->TooltipValue = "";

			// qualification
			$teachers->qualification->HrefValue = "";
			$teachers->qualification->TooltipValue = "";

			// stateOfOrigin
			$teachers->stateOfOrigin->HrefValue = "";
			$teachers->stateOfOrigin->TooltipValue = "";

			// email
			$teachers->zemail->HrefValue = "";
			$teachers->zemail->TooltipValue = "";

			// username
			$teachers->username->HrefValue = "";
			$teachers->username->TooltipValue = "";

			// status
			$teachers->status->HrefValue = "";
			$teachers->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($teachers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$teachers->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $teachers;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($teachers->Export <> "") {
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
				$teachers->teacherID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $teachers->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $teachers;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $teachers->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($teachers->ExportAll) {
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
		if ($teachers->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($teachers, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($teachers->teacherID);
				$ExportDoc->ExportCaption($teachers->firstname);
				$ExportDoc->ExportCaption($teachers->middlename);
				$ExportDoc->ExportCaption($teachers->lastname);
				$ExportDoc->ExportCaption($teachers->qualification);
				$ExportDoc->ExportCaption($teachers->stateOfOrigin);
				$ExportDoc->ExportCaption($teachers->zemail);
				$ExportDoc->ExportCaption($teachers->username);
				$ExportDoc->ExportCaption($teachers->status);
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
				$teachers->CssClass = "";
				$teachers->CssStyle = "";
				$teachers->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($teachers->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('teacherID', $teachers->teacherID->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('firstname', $teachers->firstname->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('middlename', $teachers->middlename->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('lastname', $teachers->lastname->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('qualification', $teachers->qualification->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('stateOfOrigin', $teachers->stateOfOrigin->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('zemail', $teachers->zemail->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('username', $teachers->username->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('status', $teachers->status->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($teachers->teacherID);
					$ExportDoc->ExportField($teachers->firstname);
					$ExportDoc->ExportField($teachers->middlename);
					$ExportDoc->ExportField($teachers->lastname);
					$ExportDoc->ExportField($teachers->qualification);
					$ExportDoc->ExportField($teachers->stateOfOrigin);
					$ExportDoc->ExportField($teachers->zemail);
					$ExportDoc->ExportField($teachers->username);
					$ExportDoc->ExportField($teachers->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($teachers->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($teachers->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($teachers->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($teachers->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($teachers->ExportReturnUrl());
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
