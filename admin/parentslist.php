<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "parentsinfo.php" ?>
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
$parents_list = new cparents_list();
$Page =& $parents_list;

// Page init
$parents_list->Page_Init();

// Page main
$parents_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($parents->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var parents_list = new ew_Page("parents_list");

// page properties
parents_list.PageID = "list"; // page ID
parents_list.FormID = "fparentslist"; // form ID
var EW_PAGE_ID = parents_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
parents_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
parents_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
parents_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
parents_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($parents->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$parents_list->lTotalRecs = $parents->SelectRecordCount();
	} else {
		if ($rs = $parents_list->LoadRecordset())
			$parents_list->lTotalRecs = $rs->RecordCount();
	}
	$parents_list->lStartRec = 1;
	if ($parents_list->lDisplayRecs <= 0 || ($parents->Export <> "" && $parents->ExportAll)) // Display all records
		$parents_list->lDisplayRecs = $parents_list->lTotalRecs;
	if (!($parents->Export <> "" && $parents->ExportAll))
		$parents_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $parents_list->LoadRecordset($parents_list->lStartRec-1, $parents_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $parents->TableCaption() ?>
<?php if ($parents->Export == "" && $parents->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fparentslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fparentslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fparentslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fparentslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($parents->Export == "" && $parents->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(parents_list);" style="text-decoration: none;"><img id="parents_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="parents_list_SearchPanel">
<form name="fparentslistsrch" id="fparentslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="parents">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($parents->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $parents_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($parents->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($parents->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($parents->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$parents_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fparentslist" id="fparentslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_parents" class="ewGridMiddlePanel">
<?php if ($parents_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $parents->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$parents_list->RenderListOptions();

// Render list options (header, left)
$parents_list->ListOptions->Render("header", "left");
?>
<?php if ($parents->parentID->Visible) { // parentID ?>
	<?php if ($parents->SortUrl($parents->parentID) == "") { ?>
		<td><?php echo $parents->parentID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->parentID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->parentID->FldCaption() ?></td><td style="width: 10px;"><?php if ($parents->parentID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->parentID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->firstname->Visible) { // firstname ?>
	<?php if ($parents->SortUrl($parents->firstname) == "") { ?>
		<td><?php echo $parents->firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parents->firstname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->firstname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->middlename->Visible) { // middlename ?>
	<?php if ($parents->SortUrl($parents->middlename) == "") { ?>
		<td><?php echo $parents->middlename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->middlename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->middlename->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parents->middlename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->middlename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->lastname->Visible) { // lastname ?>
	<?php if ($parents->SortUrl($parents->lastname) == "") { ?>
		<td><?php echo $parents->lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parents->lastname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->lastname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->occupation->Visible) { // occupation ?>
	<?php if ($parents->SortUrl($parents->occupation) == "") { ?>
		<td><?php echo $parents->occupation->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->occupation) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->occupation->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parents->occupation->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->occupation->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->residentState->Visible) { // residentState ?>
	<?php if ($parents->SortUrl($parents->residentState) == "") { ?>
		<td><?php echo $parents->residentState->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->residentState) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->residentState->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parents->residentState->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->residentState->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->stateOfOrigin->Visible) { // stateOfOrigin ?>
	<?php if ($parents->SortUrl($parents->stateOfOrigin) == "") { ?>
		<td><?php echo $parents->stateOfOrigin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->stateOfOrigin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->stateOfOrigin->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parents->stateOfOrigin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->stateOfOrigin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->emailAddress->Visible) { // emailAddress ?>
	<?php if ($parents->SortUrl($parents->emailAddress) == "") { ?>
		<td><?php echo $parents->emailAddress->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->emailAddress) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->emailAddress->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parents->emailAddress->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->emailAddress->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->portalUsername->Visible) { // portalUsername ?>
	<?php if ($parents->SortUrl($parents->portalUsername) == "") { ?>
		<td><?php echo $parents->portalUsername->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->portalUsername) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->portalUsername->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($parents->portalUsername->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->portalUsername->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->portalPassword->Visible) { // portalPassword ?>
	<?php if ($parents->SortUrl($parents->portalPassword) == "") { ?>
		<td><?php echo $parents->portalPassword->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->portalPassword) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->portalPassword->FldCaption() ?></td><td style="width: 10px;"><?php if ($parents->portalPassword->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->portalPassword->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($parents->status->Visible) { // status ?>
	<?php if ($parents->SortUrl($parents->status) == "") { ?>
		<td><?php echo $parents->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $parents->SortUrl($parents->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $parents->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($parents->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($parents->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$parents_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($parents->ExportAll && $parents->Export <> "") {
	$parents_list->lStopRec = $parents_list->lTotalRecs;
} else {
	$parents_list->lStopRec = $parents_list->lStartRec + $parents_list->lDisplayRecs - 1; // Set the last record to display
}
$parents_list->lRecCount = $parents_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $parents_list->lStartRec > 1)
		$rs->Move($parents_list->lStartRec - 1);
}

// Initialize aggregate
$parents->RowType = EW_ROWTYPE_AGGREGATEINIT;
$parents_list->RenderRow();
$parents_list->lRowCnt = 0;
while (($parents->CurrentAction == "gridadd" || !$rs->EOF) &&
	$parents_list->lRecCount < $parents_list->lStopRec) {
	$parents_list->lRecCount++;
	if (intval($parents_list->lRecCount) >= intval($parents_list->lStartRec)) {
		$parents_list->lRowCnt++;

	// Init row class and style
	$parents->CssClass = "";
	$parents->CssStyle = "";
	$parents->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($parents->CurrentAction == "gridadd") {
		$parents_list->LoadDefaultValues(); // Load default values
	} else {
		$parents_list->LoadRowValues($rs); // Load row values
	}
	$parents->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$parents_list->RenderRow();

	// Render list options
	$parents_list->RenderListOptions();
?>
	<tr<?php echo $parents->RowAttributes() ?>>
<?php

// Render list options (body, left)
$parents_list->ListOptions->Render("body", "left");
?>
	<?php if ($parents->parentID->Visible) { // parentID ?>
		<td<?php echo $parents->parentID->CellAttributes() ?>>
<div<?php echo $parents->parentID->ViewAttributes() ?>><?php echo $parents->parentID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->firstname->Visible) { // firstname ?>
		<td<?php echo $parents->firstname->CellAttributes() ?>>
<div<?php echo $parents->firstname->ViewAttributes() ?>><?php echo $parents->firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->middlename->Visible) { // middlename ?>
		<td<?php echo $parents->middlename->CellAttributes() ?>>
<div<?php echo $parents->middlename->ViewAttributes() ?>><?php echo $parents->middlename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->lastname->Visible) { // lastname ?>
		<td<?php echo $parents->lastname->CellAttributes() ?>>
<div<?php echo $parents->lastname->ViewAttributes() ?>><?php echo $parents->lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->occupation->Visible) { // occupation ?>
		<td<?php echo $parents->occupation->CellAttributes() ?>>
<div<?php echo $parents->occupation->ViewAttributes() ?>><?php echo $parents->occupation->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->residentState->Visible) { // residentState ?>
		<td<?php echo $parents->residentState->CellAttributes() ?>>
<div<?php echo $parents->residentState->ViewAttributes() ?>><?php echo $parents->residentState->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->stateOfOrigin->Visible) { // stateOfOrigin ?>
		<td<?php echo $parents->stateOfOrigin->CellAttributes() ?>>
<div<?php echo $parents->stateOfOrigin->ViewAttributes() ?>><?php echo $parents->stateOfOrigin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->emailAddress->Visible) { // emailAddress ?>
		<td<?php echo $parents->emailAddress->CellAttributes() ?>>
<div<?php echo $parents->emailAddress->ViewAttributes() ?>><?php echo $parents->emailAddress->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->portalUsername->Visible) { // portalUsername ?>
		<td<?php echo $parents->portalUsername->CellAttributes() ?>>
<div<?php echo $parents->portalUsername->ViewAttributes() ?>><?php echo $parents->portalUsername->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->portalPassword->Visible) { // portalPassword ?>
		<td<?php echo $parents->portalPassword->CellAttributes() ?>>
<div<?php echo $parents->portalPassword->ViewAttributes() ?>><?php echo $parents->portalPassword->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($parents->status->Visible) { // status ?>
		<td<?php echo $parents->status->CellAttributes() ?>>
<div<?php echo $parents->status->ViewAttributes() ?>><?php echo $parents->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$parents_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($parents->CurrentAction <> "gridadd")
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
<?php if ($parents->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($parents->CurrentAction <> "gridadd" && $parents->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($parents_list->Pager)) $parents_list->Pager = new cPrevNextPager($parents_list->lStartRec, $parents_list->lDisplayRecs, $parents_list->lTotalRecs) ?>
<?php if ($parents_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($parents_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $parents_list->PageUrl() ?>start=<?php echo $parents_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($parents_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $parents_list->PageUrl() ?>start=<?php echo $parents_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $parents_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($parents_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $parents_list->PageUrl() ?>start=<?php echo $parents_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($parents_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $parents_list->PageUrl() ?>start=<?php echo $parents_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $parents_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $parents_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $parents_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $parents_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($parents_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($parents_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $parents_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($parents->Export == "" && $parents->CurrentAction == "") { ?>
<?php } ?>
<?php if ($parents->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$parents_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cparents_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'parents';

	// Page object name
	var $PageObjName = 'parents_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $parents;
		if ($parents->UseTokenInUrl) $PageUrl .= "t=" . $parents->TableVar . "&"; // Add page token
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
		global $objForm, $parents;
		if ($parents->UseTokenInUrl) {
			if ($objForm)
				return ($parents->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($parents->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cparents_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (parents)
		$GLOBALS["parents"] = new cparents();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["parents"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "parentsdelete.php";
		$this->MultiUpdateUrl = "parentsupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'parents', TRUE);

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
		global $parents;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$parents->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$parents->Export = $_POST["exporttype"];
		} else {
			$parents->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $parents->Export; // Get export parameter, used in header
		$gsExportFile = $parents->TableVar; // Get export file, used in header
		if ($parents->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($parents->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($parents->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $parents;

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
			$parents->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($parents->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $parents->getRecordsPerPage(); // Restore from Session
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
		$parents->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$parents->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$parents->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $parents->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$parents->setSessionWhere($sFilter);
		$parents->CurrentFilter = "";

		// Export selected records
		if ($parents->Export <> "")
			$parents->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($parents->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($parents->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $parents;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $parents->firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->middlename, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->occupation, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->mailingAddress, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->residentialAddress, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->residentState, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->stateOfOrigin, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->emailAddress, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->portalUsername, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $parents->portalPassword, $Keyword);
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
		global $Security, $parents;
		$sSearchStr = "";
		$sSearchKeyword = $parents->BasicSearchKeyword;
		$sSearchType = $parents->BasicSearchType;
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
			$parents->setSessionBasicSearchKeyword($sSearchKeyword);
			$parents->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $parents;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$parents->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $parents;
		$parents->setSessionBasicSearchKeyword("");
		$parents->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $parents;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$parents->BasicSearchKeyword = $parents->getSessionBasicSearchKeyword();
			$parents->BasicSearchType = $parents->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $parents;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$parents->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$parents->CurrentOrderType = @$_GET["ordertype"];
			$parents->UpdateSort($parents->parentID); // parentID
			$parents->UpdateSort($parents->firstname); // firstname
			$parents->UpdateSort($parents->middlename); // middlename
			$parents->UpdateSort($parents->lastname); // lastname
			$parents->UpdateSort($parents->occupation); // occupation
			$parents->UpdateSort($parents->residentState); // residentState
			$parents->UpdateSort($parents->stateOfOrigin); // stateOfOrigin
			$parents->UpdateSort($parents->emailAddress); // emailAddress
			$parents->UpdateSort($parents->portalUsername); // portalUsername
			$parents->UpdateSort($parents->portalPassword); // portalPassword
			$parents->UpdateSort($parents->status); // status
			$parents->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $parents;
		$sOrderBy = $parents->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($parents->SqlOrderBy() <> "") {
				$sOrderBy = $parents->SqlOrderBy();
				$parents->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $parents;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$parents->setSessionOrderBy($sOrderBy);
				$parents->parentID->setSort("");
				$parents->firstname->setSort("");
				$parents->middlename->setSort("");
				$parents->lastname->setSort("");
				$parents->occupation->setSort("");
				$parents->residentState->setSort("");
				$parents->stateOfOrigin->setSort("");
				$parents->emailAddress->setSort("");
				$parents->portalUsername->setSort("");
				$parents->portalPassword->setSort("");
				$parents->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$parents->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $parents;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"parents_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($parents->Export <> "" ||
			$parents->CurrentAction == "gridadd" ||
			$parents->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $parents;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($parents->parentID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $parents;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $parents;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$parents->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$parents->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $parents->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$parents->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$parents->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$parents->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $parents;
		$parents->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$parents->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $parents;

		// Call Recordset Selecting event
		$parents->Recordset_Selecting($parents->CurrentFilter);

		// Load List page SQL
		$sSql = $parents->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$parents->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $parents;
		$sFilter = $parents->KeyFilter();

		// Call Row Selecting event
		$parents->Row_Selecting($sFilter);

		// Load SQL based on filter
		$parents->CurrentFilter = $sFilter;
		$sSql = $parents->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$parents->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $parents;
		$parents->parentID->setDbValue($rs->fields('parentID'));
		$parents->firstname->setDbValue($rs->fields('firstname'));
		$parents->middlename->setDbValue($rs->fields('middlename'));
		$parents->lastname->setDbValue($rs->fields('lastname'));
		$parents->occupation->setDbValue($rs->fields('occupation'));
		$parents->mailingAddress->setDbValue($rs->fields('mailingAddress'));
		$parents->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$parents->residentState->setDbValue($rs->fields('residentState'));
		$parents->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$parents->emailAddress->setDbValue($rs->fields('emailAddress'));
		$parents->portalUsername->setDbValue($rs->fields('portalUsername'));
		$parents->portalPassword->setDbValue($rs->fields('portalPassword'));
		$parents->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $parents;

		// Initialize URLs
		$this->ViewUrl = $parents->ViewUrl();
		$this->EditUrl = $parents->EditUrl();
		$this->InlineEditUrl = $parents->InlineEditUrl();
		$this->CopyUrl = $parents->CopyUrl();
		$this->InlineCopyUrl = $parents->InlineCopyUrl();
		$this->DeleteUrl = $parents->DeleteUrl();

		// Call Row_Rendering event
		$parents->Row_Rendering();

		// Common render codes for all row types
		// parentID

		$parents->parentID->CellCssStyle = ""; $parents->parentID->CellCssClass = "";
		$parents->parentID->CellAttrs = array(); $parents->parentID->ViewAttrs = array(); $parents->parentID->EditAttrs = array();

		// firstname
		$parents->firstname->CellCssStyle = ""; $parents->firstname->CellCssClass = "";
		$parents->firstname->CellAttrs = array(); $parents->firstname->ViewAttrs = array(); $parents->firstname->EditAttrs = array();

		// middlename
		$parents->middlename->CellCssStyle = ""; $parents->middlename->CellCssClass = "";
		$parents->middlename->CellAttrs = array(); $parents->middlename->ViewAttrs = array(); $parents->middlename->EditAttrs = array();

		// lastname
		$parents->lastname->CellCssStyle = ""; $parents->lastname->CellCssClass = "";
		$parents->lastname->CellAttrs = array(); $parents->lastname->ViewAttrs = array(); $parents->lastname->EditAttrs = array();

		// occupation
		$parents->occupation->CellCssStyle = ""; $parents->occupation->CellCssClass = "";
		$parents->occupation->CellAttrs = array(); $parents->occupation->ViewAttrs = array(); $parents->occupation->EditAttrs = array();

		// residentState
		$parents->residentState->CellCssStyle = ""; $parents->residentState->CellCssClass = "";
		$parents->residentState->CellAttrs = array(); $parents->residentState->ViewAttrs = array(); $parents->residentState->EditAttrs = array();

		// stateOfOrigin
		$parents->stateOfOrigin->CellCssStyle = ""; $parents->stateOfOrigin->CellCssClass = "";
		$parents->stateOfOrigin->CellAttrs = array(); $parents->stateOfOrigin->ViewAttrs = array(); $parents->stateOfOrigin->EditAttrs = array();

		// emailAddress
		$parents->emailAddress->CellCssStyle = ""; $parents->emailAddress->CellCssClass = "";
		$parents->emailAddress->CellAttrs = array(); $parents->emailAddress->ViewAttrs = array(); $parents->emailAddress->EditAttrs = array();

		// portalUsername
		$parents->portalUsername->CellCssStyle = ""; $parents->portalUsername->CellCssClass = "";
		$parents->portalUsername->CellAttrs = array(); $parents->portalUsername->ViewAttrs = array(); $parents->portalUsername->EditAttrs = array();

		// portalPassword
		$parents->portalPassword->CellCssStyle = ""; $parents->portalPassword->CellCssClass = "";
		$parents->portalPassword->CellAttrs = array(); $parents->portalPassword->ViewAttrs = array(); $parents->portalPassword->EditAttrs = array();

		// status
		$parents->status->CellCssStyle = ""; $parents->status->CellCssClass = "";
		$parents->status->CellAttrs = array(); $parents->status->ViewAttrs = array(); $parents->status->EditAttrs = array();
		if ($parents->RowType == EW_ROWTYPE_VIEW) { // View row

			// parentID
			$parents->parentID->ViewValue = $parents->parentID->CurrentValue;
			$parents->parentID->CssStyle = "";
			$parents->parentID->CssClass = "";
			$parents->parentID->ViewCustomAttributes = "";

			// firstname
			$parents->firstname->ViewValue = $parents->firstname->CurrentValue;
			$parents->firstname->CssStyle = "";
			$parents->firstname->CssClass = "";
			$parents->firstname->ViewCustomAttributes = "";

			// middlename
			$parents->middlename->ViewValue = $parents->middlename->CurrentValue;
			$parents->middlename->CssStyle = "";
			$parents->middlename->CssClass = "";
			$parents->middlename->ViewCustomAttributes = "";

			// lastname
			$parents->lastname->ViewValue = $parents->lastname->CurrentValue;
			$parents->lastname->CssStyle = "";
			$parents->lastname->CssClass = "";
			$parents->lastname->ViewCustomAttributes = "";

			// occupation
			$parents->occupation->ViewValue = $parents->occupation->CurrentValue;
			$parents->occupation->CssStyle = "";
			$parents->occupation->CssClass = "";
			$parents->occupation->ViewCustomAttributes = "";

			// residentState
			$parents->residentState->ViewValue = $parents->residentState->CurrentValue;
			$parents->residentState->CssStyle = "";
			$parents->residentState->CssClass = "";
			$parents->residentState->ViewCustomAttributes = "";

			// stateOfOrigin
			$parents->stateOfOrigin->ViewValue = $parents->stateOfOrigin->CurrentValue;
			$parents->stateOfOrigin->CssStyle = "";
			$parents->stateOfOrigin->CssClass = "";
			$parents->stateOfOrigin->ViewCustomAttributes = "";

			// emailAddress
			$parents->emailAddress->ViewValue = $parents->emailAddress->CurrentValue;
			$parents->emailAddress->CssStyle = "";
			$parents->emailAddress->CssClass = "";
			$parents->emailAddress->ViewCustomAttributes = "";

			// portalUsername
			$parents->portalUsername->ViewValue = $parents->portalUsername->CurrentValue;
			$parents->portalUsername->CssStyle = "";
			$parents->portalUsername->CssClass = "";
			$parents->portalUsername->ViewCustomAttributes = "";

			// portalPassword
			$parents->portalPassword->ViewValue = "********";
			$parents->portalPassword->CssStyle = "";
			$parents->portalPassword->CssClass = "";
			$parents->portalPassword->ViewCustomAttributes = "";

			// status
			if (strval($parents->status->CurrentValue) <> "") {
				switch ($parents->status->CurrentValue) {
					case "1":
						$parents->status->ViewValue = "Enabled";
						break;
					case "0":
						$parents->status->ViewValue = "Disabled";
						break;
					default:
						$parents->status->ViewValue = $parents->status->CurrentValue;
				}
			} else {
				$parents->status->ViewValue = NULL;
			}
			$parents->status->CssStyle = "";
			$parents->status->CssClass = "";
			$parents->status->ViewCustomAttributes = "";

			// parentID
			$parents->parentID->HrefValue = "";
			$parents->parentID->TooltipValue = "";

			// firstname
			$parents->firstname->HrefValue = "";
			$parents->firstname->TooltipValue = "";

			// middlename
			$parents->middlename->HrefValue = "";
			$parents->middlename->TooltipValue = "";

			// lastname
			$parents->lastname->HrefValue = "";
			$parents->lastname->TooltipValue = "";

			// occupation
			$parents->occupation->HrefValue = "";
			$parents->occupation->TooltipValue = "";

			// residentState
			$parents->residentState->HrefValue = "";
			$parents->residentState->TooltipValue = "";

			// stateOfOrigin
			$parents->stateOfOrigin->HrefValue = "";
			$parents->stateOfOrigin->TooltipValue = "";

			// emailAddress
			$parents->emailAddress->HrefValue = "";
			$parents->emailAddress->TooltipValue = "";

			// portalUsername
			$parents->portalUsername->HrefValue = "";
			$parents->portalUsername->TooltipValue = "";

			// portalPassword
			$parents->portalPassword->HrefValue = "";
			$parents->portalPassword->TooltipValue = "";

			// status
			$parents->status->HrefValue = "";
			$parents->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($parents->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$parents->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $parents;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($parents->Export <> "") {
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
				$parents->parentID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $parents->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $parents;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $parents->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($parents->ExportAll) {
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
		if ($parents->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($parents, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($parents->parentID);
				$ExportDoc->ExportCaption($parents->firstname);
				$ExportDoc->ExportCaption($parents->middlename);
				$ExportDoc->ExportCaption($parents->lastname);
				$ExportDoc->ExportCaption($parents->occupation);
				$ExportDoc->ExportCaption($parents->residentState);
				$ExportDoc->ExportCaption($parents->stateOfOrigin);
				$ExportDoc->ExportCaption($parents->emailAddress);
				$ExportDoc->ExportCaption($parents->portalUsername);
				$ExportDoc->ExportCaption($parents->portalPassword);
				$ExportDoc->ExportCaption($parents->status);
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
				$parents->CssClass = "";
				$parents->CssStyle = "";
				$parents->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($parents->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('parentID', $parents->parentID->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('firstname', $parents->firstname->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('middlename', $parents->middlename->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('lastname', $parents->lastname->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('occupation', $parents->occupation->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('residentState', $parents->residentState->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('stateOfOrigin', $parents->stateOfOrigin->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('emailAddress', $parents->emailAddress->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('portalUsername', $parents->portalUsername->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('portalPassword', $parents->portalPassword->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('status', $parents->status->ExportValue($parents->Export, $parents->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($parents->parentID);
					$ExportDoc->ExportField($parents->firstname);
					$ExportDoc->ExportField($parents->middlename);
					$ExportDoc->ExportField($parents->lastname);
					$ExportDoc->ExportField($parents->occupation);
					$ExportDoc->ExportField($parents->residentState);
					$ExportDoc->ExportField($parents->stateOfOrigin);
					$ExportDoc->ExportField($parents->emailAddress);
					$ExportDoc->ExportField($parents->portalUsername);
					$ExportDoc->ExportField($parents->portalPassword);
					$ExportDoc->ExportField($parents->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($parents->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($parents->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($parents->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($parents->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($parents->ExportReturnUrl());
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
