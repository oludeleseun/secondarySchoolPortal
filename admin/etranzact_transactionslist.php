<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "etranzact_transactionsinfo.php" ?>
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
$etranzact_transactions_list = new cetranzact_transactions_list();
$Page =& $etranzact_transactions_list;

// Page init
$etranzact_transactions_list->Page_Init();

// Page main
$etranzact_transactions_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($etranzact_transactions->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var etranzact_transactions_list = new ew_Page("etranzact_transactions_list");

// page properties
etranzact_transactions_list.PageID = "list"; // page ID
etranzact_transactions_list.FormID = "fetranzact_transactionslist"; // form ID
var EW_PAGE_ID = etranzact_transactions_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
etranzact_transactions_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
etranzact_transactions_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
etranzact_transactions_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
etranzact_transactions_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($etranzact_transactions->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$etranzact_transactions_list->lTotalRecs = $etranzact_transactions->SelectRecordCount();
	} else {
		if ($rs = $etranzact_transactions_list->LoadRecordset())
			$etranzact_transactions_list->lTotalRecs = $rs->RecordCount();
	}
	$etranzact_transactions_list->lStartRec = 1;
	if ($etranzact_transactions_list->lDisplayRecs <= 0 || ($etranzact_transactions->Export <> "" && $etranzact_transactions->ExportAll)) // Display all records
		$etranzact_transactions_list->lDisplayRecs = $etranzact_transactions_list->lTotalRecs;
	if (!($etranzact_transactions->Export <> "" && $etranzact_transactions->ExportAll))
		$etranzact_transactions_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $etranzact_transactions_list->LoadRecordset($etranzact_transactions_list->lStartRec-1, $etranzact_transactions_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $etranzact_transactions->TableCaption() ?>
<?php if ($etranzact_transactions->Export == "" && $etranzact_transactions->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fetranzact_transactionslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fetranzact_transactionslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fetranzact_transactionslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fetranzact_transactionslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($etranzact_transactions->Export == "" && $etranzact_transactions->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(etranzact_transactions_list);" style="text-decoration: none;"><img id="etranzact_transactions_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="etranzact_transactions_list_SearchPanel">
<form name="fetranzact_transactionslistsrch" id="fetranzact_transactionslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="etranzact_transactions">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($etranzact_transactions->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $etranzact_transactions_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($etranzact_transactions->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($etranzact_transactions->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($etranzact_transactions->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$etranzact_transactions_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fetranzact_transactionslist" id="fetranzact_transactionslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_etranzact_transactions" class="ewGridMiddlePanel">
<?php if ($etranzact_transactions_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $etranzact_transactions->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$etranzact_transactions_list->RenderListOptions();

// Render list options (header, left)
$etranzact_transactions_list->ListOptions->Render("header", "left");
?>
<?php if ($etranzact_transactions->transactionID->Visible) { // transactionID ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->transactionID) == "") { ?>
		<td><?php echo $etranzact_transactions->transactionID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->transactionID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->transactionID->FldCaption() ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->transactionID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->transactionID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($etranzact_transactions->studentID->Visible) { // studentID ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->studentID) == "") { ?>
		<td><?php echo $etranzact_transactions->studentID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->studentID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->studentID->FldCaption() ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->studentID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->studentID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($etranzact_transactions->transactionAmount->Visible) { // transactionAmount ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->transactionAmount) == "") { ?>
		<td><?php echo $etranzact_transactions->transactionAmount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->transactionAmount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->transactionAmount->FldCaption() ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->transactionAmount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->transactionAmount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($etranzact_transactions->confirmationNumber->Visible) { // confirmationNumber ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->confirmationNumber) == "") { ?>
		<td><?php echo $etranzact_transactions->confirmationNumber->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->confirmationNumber) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->confirmationNumber->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->confirmationNumber->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->confirmationNumber->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($etranzact_transactions->receiptNumber->Visible) { // receiptNumber ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->receiptNumber) == "") { ?>
		<td><?php echo $etranzact_transactions->receiptNumber->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->receiptNumber) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->receiptNumber->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->receiptNumber->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->receiptNumber->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($etranzact_transactions->transactionNumber->Visible) { // transactionNumber ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->transactionNumber) == "") { ?>
		<td><?php echo $etranzact_transactions->transactionNumber->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->transactionNumber) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->transactionNumber->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->transactionNumber->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->transactionNumber->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($etranzact_transactions->transactionDate->Visible) { // transactionDate ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->transactionDate) == "") { ?>
		<td><?php echo $etranzact_transactions->transactionDate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->transactionDate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->transactionDate->FldCaption() ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->transactionDate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->transactionDate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($etranzact_transactions->dateLogged->Visible) { // dateLogged ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->dateLogged) == "") { ?>
		<td><?php echo $etranzact_transactions->dateLogged->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->dateLogged) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->dateLogged->FldCaption() ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->dateLogged->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->dateLogged->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($etranzact_transactions->transactionReference->Visible) { // transactionReference ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->transactionReference) == "") { ?>
		<td><?php echo $etranzact_transactions->transactionReference->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->transactionReference) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->transactionReference->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->transactionReference->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->transactionReference->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($etranzact_transactions->status->Visible) { // status ?>
	<?php if ($etranzact_transactions->SortUrl($etranzact_transactions->status) == "") { ?>
		<td><?php echo $etranzact_transactions->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $etranzact_transactions->SortUrl($etranzact_transactions->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $etranzact_transactions->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($etranzact_transactions->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($etranzact_transactions->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$etranzact_transactions_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($etranzact_transactions->ExportAll && $etranzact_transactions->Export <> "") {
	$etranzact_transactions_list->lStopRec = $etranzact_transactions_list->lTotalRecs;
} else {
	$etranzact_transactions_list->lStopRec = $etranzact_transactions_list->lStartRec + $etranzact_transactions_list->lDisplayRecs - 1; // Set the last record to display
}
$etranzact_transactions_list->lRecCount = $etranzact_transactions_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $etranzact_transactions_list->lStartRec > 1)
		$rs->Move($etranzact_transactions_list->lStartRec - 1);
}

// Initialize aggregate
$etranzact_transactions->RowType = EW_ROWTYPE_AGGREGATEINIT;
$etranzact_transactions_list->RenderRow();
$etranzact_transactions_list->lRowCnt = 0;
while (($etranzact_transactions->CurrentAction == "gridadd" || !$rs->EOF) &&
	$etranzact_transactions_list->lRecCount < $etranzact_transactions_list->lStopRec) {
	$etranzact_transactions_list->lRecCount++;
	if (intval($etranzact_transactions_list->lRecCount) >= intval($etranzact_transactions_list->lStartRec)) {
		$etranzact_transactions_list->lRowCnt++;

	// Init row class and style
	$etranzact_transactions->CssClass = "";
	$etranzact_transactions->CssStyle = "";
	$etranzact_transactions->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($etranzact_transactions->CurrentAction == "gridadd") {
		$etranzact_transactions_list->LoadDefaultValues(); // Load default values
	} else {
		$etranzact_transactions_list->LoadRowValues($rs); // Load row values
	}
	$etranzact_transactions->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$etranzact_transactions_list->RenderRow();

	// Render list options
	$etranzact_transactions_list->RenderListOptions();
?>
	<tr<?php echo $etranzact_transactions->RowAttributes() ?>>
<?php

// Render list options (body, left)
$etranzact_transactions_list->ListOptions->Render("body", "left");
?>
	<?php if ($etranzact_transactions->transactionID->Visible) { // transactionID ?>
		<td<?php echo $etranzact_transactions->transactionID->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionID->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($etranzact_transactions->studentID->Visible) { // studentID ?>
		<td<?php echo $etranzact_transactions->studentID->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->studentID->ViewAttributes() ?>><?php echo $etranzact_transactions->studentID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($etranzact_transactions->transactionAmount->Visible) { // transactionAmount ?>
		<td<?php echo $etranzact_transactions->transactionAmount->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionAmount->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionAmount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($etranzact_transactions->confirmationNumber->Visible) { // confirmationNumber ?>
		<td<?php echo $etranzact_transactions->confirmationNumber->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->confirmationNumber->ViewAttributes() ?>><?php echo $etranzact_transactions->confirmationNumber->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($etranzact_transactions->receiptNumber->Visible) { // receiptNumber ?>
		<td<?php echo $etranzact_transactions->receiptNumber->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->receiptNumber->ViewAttributes() ?>><?php echo $etranzact_transactions->receiptNumber->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($etranzact_transactions->transactionNumber->Visible) { // transactionNumber ?>
		<td<?php echo $etranzact_transactions->transactionNumber->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionNumber->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionNumber->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($etranzact_transactions->transactionDate->Visible) { // transactionDate ?>
		<td<?php echo $etranzact_transactions->transactionDate->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionDate->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionDate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($etranzact_transactions->dateLogged->Visible) { // dateLogged ?>
		<td<?php echo $etranzact_transactions->dateLogged->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->dateLogged->ViewAttributes() ?>><?php echo $etranzact_transactions->dateLogged->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($etranzact_transactions->transactionReference->Visible) { // transactionReference ?>
		<td<?php echo $etranzact_transactions->transactionReference->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionReference->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionReference->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($etranzact_transactions->status->Visible) { // status ?>
		<td<?php echo $etranzact_transactions->status->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->status->ViewAttributes() ?>><?php echo $etranzact_transactions->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$etranzact_transactions_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($etranzact_transactions->CurrentAction <> "gridadd")
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
<?php if ($etranzact_transactions->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($etranzact_transactions->CurrentAction <> "gridadd" && $etranzact_transactions->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($etranzact_transactions_list->Pager)) $etranzact_transactions_list->Pager = new cPrevNextPager($etranzact_transactions_list->lStartRec, $etranzact_transactions_list->lDisplayRecs, $etranzact_transactions_list->lTotalRecs) ?>
<?php if ($etranzact_transactions_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($etranzact_transactions_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $etranzact_transactions_list->PageUrl() ?>start=<?php echo $etranzact_transactions_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($etranzact_transactions_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $etranzact_transactions_list->PageUrl() ?>start=<?php echo $etranzact_transactions_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $etranzact_transactions_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($etranzact_transactions_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $etranzact_transactions_list->PageUrl() ?>start=<?php echo $etranzact_transactions_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($etranzact_transactions_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $etranzact_transactions_list->PageUrl() ?>start=<?php echo $etranzact_transactions_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $etranzact_transactions_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $etranzact_transactions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $etranzact_transactions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $etranzact_transactions_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($etranzact_transactions_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($etranzact_transactions_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $etranzact_transactions_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($etranzact_transactions->Export == "" && $etranzact_transactions->CurrentAction == "") { ?>
<?php } ?>
<?php if ($etranzact_transactions->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$etranzact_transactions_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cetranzact_transactions_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'etranzact_transactions';

	// Page object name
	var $PageObjName = 'etranzact_transactions_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $etranzact_transactions;
		if ($etranzact_transactions->UseTokenInUrl) $PageUrl .= "t=" . $etranzact_transactions->TableVar . "&"; // Add page token
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
		global $objForm, $etranzact_transactions;
		if ($etranzact_transactions->UseTokenInUrl) {
			if ($objForm)
				return ($etranzact_transactions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($etranzact_transactions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cetranzact_transactions_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (etranzact_transactions)
		$GLOBALS["etranzact_transactions"] = new cetranzact_transactions();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["etranzact_transactions"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "etranzact_transactionsdelete.php";
		$this->MultiUpdateUrl = "etranzact_transactionsupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'etranzact_transactions', TRUE);

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
		global $etranzact_transactions;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$etranzact_transactions->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$etranzact_transactions->Export = $_POST["exporttype"];
		} else {
			$etranzact_transactions->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $etranzact_transactions->Export; // Get export parameter, used in header
		$gsExportFile = $etranzact_transactions->TableVar; // Get export file, used in header
		if ($etranzact_transactions->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($etranzact_transactions->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($etranzact_transactions->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $etranzact_transactions;

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
			$etranzact_transactions->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($etranzact_transactions->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $etranzact_transactions->getRecordsPerPage(); // Restore from Session
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
		$etranzact_transactions->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$etranzact_transactions->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$etranzact_transactions->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $etranzact_transactions->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$etranzact_transactions->setSessionWhere($sFilter);
		$etranzact_transactions->CurrentFilter = "";

		// Export selected records
		if ($etranzact_transactions->Export <> "")
			$etranzact_transactions->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($etranzact_transactions->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($etranzact_transactions->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $etranzact_transactions;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $etranzact_transactions->confirmationNumber, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $etranzact_transactions->receiptNumber, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $etranzact_transactions->transactionNumber, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $etranzact_transactions->transactionReference, $Keyword);
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
		global $Security, $etranzact_transactions;
		$sSearchStr = "";
		$sSearchKeyword = $etranzact_transactions->BasicSearchKeyword;
		$sSearchType = $etranzact_transactions->BasicSearchType;
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
			$etranzact_transactions->setSessionBasicSearchKeyword($sSearchKeyword);
			$etranzact_transactions->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $etranzact_transactions;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$etranzact_transactions->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $etranzact_transactions;
		$etranzact_transactions->setSessionBasicSearchKeyword("");
		$etranzact_transactions->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $etranzact_transactions;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$etranzact_transactions->BasicSearchKeyword = $etranzact_transactions->getSessionBasicSearchKeyword();
			$etranzact_transactions->BasicSearchType = $etranzact_transactions->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $etranzact_transactions;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$etranzact_transactions->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$etranzact_transactions->CurrentOrderType = @$_GET["ordertype"];
			$etranzact_transactions->UpdateSort($etranzact_transactions->transactionID); // transactionID
			$etranzact_transactions->UpdateSort($etranzact_transactions->studentID); // studentID
			$etranzact_transactions->UpdateSort($etranzact_transactions->transactionAmount); // transactionAmount
			$etranzact_transactions->UpdateSort($etranzact_transactions->confirmationNumber); // confirmationNumber
			$etranzact_transactions->UpdateSort($etranzact_transactions->receiptNumber); // receiptNumber
			$etranzact_transactions->UpdateSort($etranzact_transactions->transactionNumber); // transactionNumber
			$etranzact_transactions->UpdateSort($etranzact_transactions->transactionDate); // transactionDate
			$etranzact_transactions->UpdateSort($etranzact_transactions->dateLogged); // dateLogged
			$etranzact_transactions->UpdateSort($etranzact_transactions->transactionReference); // transactionReference
			$etranzact_transactions->UpdateSort($etranzact_transactions->status); // status
			$etranzact_transactions->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $etranzact_transactions;
		$sOrderBy = $etranzact_transactions->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($etranzact_transactions->SqlOrderBy() <> "") {
				$sOrderBy = $etranzact_transactions->SqlOrderBy();
				$etranzact_transactions->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $etranzact_transactions;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$etranzact_transactions->setSessionOrderBy($sOrderBy);
				$etranzact_transactions->transactionID->setSort("");
				$etranzact_transactions->studentID->setSort("");
				$etranzact_transactions->transactionAmount->setSort("");
				$etranzact_transactions->confirmationNumber->setSort("");
				$etranzact_transactions->receiptNumber->setSort("");
				$etranzact_transactions->transactionNumber->setSort("");
				$etranzact_transactions->transactionDate->setSort("");
				$etranzact_transactions->dateLogged->setSort("");
				$etranzact_transactions->transactionReference->setSort("");
				$etranzact_transactions->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$etranzact_transactions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $etranzact_transactions;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"etranzact_transactions_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($etranzact_transactions->Export <> "" ||
			$etranzact_transactions->CurrentAction == "gridadd" ||
			$etranzact_transactions->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $etranzact_transactions;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($etranzact_transactions->transactionID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $etranzact_transactions;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $etranzact_transactions;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$etranzact_transactions->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$etranzact_transactions->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $etranzact_transactions->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$etranzact_transactions->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$etranzact_transactions->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$etranzact_transactions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $etranzact_transactions;
		$etranzact_transactions->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$etranzact_transactions->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $etranzact_transactions;

		// Call Recordset Selecting event
		$etranzact_transactions->Recordset_Selecting($etranzact_transactions->CurrentFilter);

		// Load List page SQL
		$sSql = $etranzact_transactions->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$etranzact_transactions->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $etranzact_transactions;
		$sFilter = $etranzact_transactions->KeyFilter();

		// Call Row Selecting event
		$etranzact_transactions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$etranzact_transactions->CurrentFilter = $sFilter;
		$sSql = $etranzact_transactions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$etranzact_transactions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $etranzact_transactions;
		$etranzact_transactions->transactionID->setDbValue($rs->fields('transactionID'));
		$etranzact_transactions->studentID->setDbValue($rs->fields('studentID'));
		$etranzact_transactions->transactionAmount->setDbValue($rs->fields('transactionAmount'));
		$etranzact_transactions->confirmationNumber->setDbValue($rs->fields('confirmationNumber'));
		$etranzact_transactions->receiptNumber->setDbValue($rs->fields('receiptNumber'));
		$etranzact_transactions->transactionNumber->setDbValue($rs->fields('transactionNumber'));
		$etranzact_transactions->transactionDate->setDbValue($rs->fields('transactionDate'));
		$etranzact_transactions->dateLogged->setDbValue($rs->fields('dateLogged'));
		$etranzact_transactions->transactionReference->setDbValue($rs->fields('transactionReference'));
		$etranzact_transactions->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $etranzact_transactions;

		// Initialize URLs
		$this->ViewUrl = $etranzact_transactions->ViewUrl();
		$this->EditUrl = $etranzact_transactions->EditUrl();
		$this->InlineEditUrl = $etranzact_transactions->InlineEditUrl();
		$this->CopyUrl = $etranzact_transactions->CopyUrl();
		$this->InlineCopyUrl = $etranzact_transactions->InlineCopyUrl();
		$this->DeleteUrl = $etranzact_transactions->DeleteUrl();

		// Call Row_Rendering event
		$etranzact_transactions->Row_Rendering();

		// Common render codes for all row types
		// transactionID

		$etranzact_transactions->transactionID->CellCssStyle = ""; $etranzact_transactions->transactionID->CellCssClass = "";
		$etranzact_transactions->transactionID->CellAttrs = array(); $etranzact_transactions->transactionID->ViewAttrs = array(); $etranzact_transactions->transactionID->EditAttrs = array();

		// studentID
		$etranzact_transactions->studentID->CellCssStyle = ""; $etranzact_transactions->studentID->CellCssClass = "";
		$etranzact_transactions->studentID->CellAttrs = array(); $etranzact_transactions->studentID->ViewAttrs = array(); $etranzact_transactions->studentID->EditAttrs = array();

		// transactionAmount
		$etranzact_transactions->transactionAmount->CellCssStyle = ""; $etranzact_transactions->transactionAmount->CellCssClass = "";
		$etranzact_transactions->transactionAmount->CellAttrs = array(); $etranzact_transactions->transactionAmount->ViewAttrs = array(); $etranzact_transactions->transactionAmount->EditAttrs = array();

		// confirmationNumber
		$etranzact_transactions->confirmationNumber->CellCssStyle = ""; $etranzact_transactions->confirmationNumber->CellCssClass = "";
		$etranzact_transactions->confirmationNumber->CellAttrs = array(); $etranzact_transactions->confirmationNumber->ViewAttrs = array(); $etranzact_transactions->confirmationNumber->EditAttrs = array();

		// receiptNumber
		$etranzact_transactions->receiptNumber->CellCssStyle = ""; $etranzact_transactions->receiptNumber->CellCssClass = "";
		$etranzact_transactions->receiptNumber->CellAttrs = array(); $etranzact_transactions->receiptNumber->ViewAttrs = array(); $etranzact_transactions->receiptNumber->EditAttrs = array();

		// transactionNumber
		$etranzact_transactions->transactionNumber->CellCssStyle = ""; $etranzact_transactions->transactionNumber->CellCssClass = "";
		$etranzact_transactions->transactionNumber->CellAttrs = array(); $etranzact_transactions->transactionNumber->ViewAttrs = array(); $etranzact_transactions->transactionNumber->EditAttrs = array();

		// transactionDate
		$etranzact_transactions->transactionDate->CellCssStyle = ""; $etranzact_transactions->transactionDate->CellCssClass = "";
		$etranzact_transactions->transactionDate->CellAttrs = array(); $etranzact_transactions->transactionDate->ViewAttrs = array(); $etranzact_transactions->transactionDate->EditAttrs = array();

		// dateLogged
		$etranzact_transactions->dateLogged->CellCssStyle = ""; $etranzact_transactions->dateLogged->CellCssClass = "";
		$etranzact_transactions->dateLogged->CellAttrs = array(); $etranzact_transactions->dateLogged->ViewAttrs = array(); $etranzact_transactions->dateLogged->EditAttrs = array();

		// transactionReference
		$etranzact_transactions->transactionReference->CellCssStyle = ""; $etranzact_transactions->transactionReference->CellCssClass = "";
		$etranzact_transactions->transactionReference->CellAttrs = array(); $etranzact_transactions->transactionReference->ViewAttrs = array(); $etranzact_transactions->transactionReference->EditAttrs = array();

		// status
		$etranzact_transactions->status->CellCssStyle = ""; $etranzact_transactions->status->CellCssClass = "";
		$etranzact_transactions->status->CellAttrs = array(); $etranzact_transactions->status->ViewAttrs = array(); $etranzact_transactions->status->EditAttrs = array();
		if ($etranzact_transactions->RowType == EW_ROWTYPE_VIEW) { // View row

			// transactionID
			$etranzact_transactions->transactionID->ViewValue = $etranzact_transactions->transactionID->CurrentValue;
			$etranzact_transactions->transactionID->CssStyle = "";
			$etranzact_transactions->transactionID->CssClass = "";
			$etranzact_transactions->transactionID->ViewCustomAttributes = "";

			// studentID
			if (strval($etranzact_transactions->studentID->CurrentValue) <> "") {
				$sFilterWrk = "`studentID` = " . ew_AdjustSql($etranzact_transactions->studentID->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `students`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$etranzact_transactions->studentID->ViewValue = $rswrk->fields('firstname');
					$etranzact_transactions->studentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$etranzact_transactions->studentID->ViewValue = $etranzact_transactions->studentID->CurrentValue;
				}
			} else {
				$etranzact_transactions->studentID->ViewValue = NULL;
			}
			$etranzact_transactions->studentID->CssStyle = "";
			$etranzact_transactions->studentID->CssClass = "";
			$etranzact_transactions->studentID->ViewCustomAttributes = "";

			// transactionAmount
			$etranzact_transactions->transactionAmount->ViewValue = $etranzact_transactions->transactionAmount->CurrentValue;
			$etranzact_transactions->transactionAmount->CssStyle = "";
			$etranzact_transactions->transactionAmount->CssClass = "";
			$etranzact_transactions->transactionAmount->ViewCustomAttributes = "";

			// confirmationNumber
			$etranzact_transactions->confirmationNumber->ViewValue = $etranzact_transactions->confirmationNumber->CurrentValue;
			$etranzact_transactions->confirmationNumber->CssStyle = "";
			$etranzact_transactions->confirmationNumber->CssClass = "";
			$etranzact_transactions->confirmationNumber->ViewCustomAttributes = "";

			// receiptNumber
			$etranzact_transactions->receiptNumber->ViewValue = $etranzact_transactions->receiptNumber->CurrentValue;
			$etranzact_transactions->receiptNumber->CssStyle = "";
			$etranzact_transactions->receiptNumber->CssClass = "";
			$etranzact_transactions->receiptNumber->ViewCustomAttributes = "";

			// transactionNumber
			$etranzact_transactions->transactionNumber->ViewValue = $etranzact_transactions->transactionNumber->CurrentValue;
			$etranzact_transactions->transactionNumber->CssStyle = "";
			$etranzact_transactions->transactionNumber->CssClass = "";
			$etranzact_transactions->transactionNumber->ViewCustomAttributes = "";

			// transactionDate
			$etranzact_transactions->transactionDate->ViewValue = $etranzact_transactions->transactionDate->CurrentValue;
			$etranzact_transactions->transactionDate->ViewValue = ew_FormatDateTime($etranzact_transactions->transactionDate->ViewValue, 5);
			$etranzact_transactions->transactionDate->CssStyle = "";
			$etranzact_transactions->transactionDate->CssClass = "";
			$etranzact_transactions->transactionDate->ViewCustomAttributes = "";

			// dateLogged
			$etranzact_transactions->dateLogged->ViewValue = $etranzact_transactions->dateLogged->CurrentValue;
			$etranzact_transactions->dateLogged->ViewValue = ew_FormatDateTime($etranzact_transactions->dateLogged->ViewValue, 5);
			$etranzact_transactions->dateLogged->CssStyle = "";
			$etranzact_transactions->dateLogged->CssClass = "";
			$etranzact_transactions->dateLogged->ViewCustomAttributes = "";

			// transactionReference
			$etranzact_transactions->transactionReference->ViewValue = $etranzact_transactions->transactionReference->CurrentValue;
			$etranzact_transactions->transactionReference->CssStyle = "";
			$etranzact_transactions->transactionReference->CssClass = "";
			$etranzact_transactions->transactionReference->ViewCustomAttributes = "";

			// status
			$etranzact_transactions->status->ViewValue = $etranzact_transactions->status->CurrentValue;
			$etranzact_transactions->status->CssStyle = "";
			$etranzact_transactions->status->CssClass = "";
			$etranzact_transactions->status->ViewCustomAttributes = "";

			// transactionID
			$etranzact_transactions->transactionID->HrefValue = "";
			$etranzact_transactions->transactionID->TooltipValue = "";

			// studentID
			$etranzact_transactions->studentID->HrefValue = "";
			$etranzact_transactions->studentID->TooltipValue = "";

			// transactionAmount
			$etranzact_transactions->transactionAmount->HrefValue = "";
			$etranzact_transactions->transactionAmount->TooltipValue = "";

			// confirmationNumber
			$etranzact_transactions->confirmationNumber->HrefValue = "";
			$etranzact_transactions->confirmationNumber->TooltipValue = "";

			// receiptNumber
			$etranzact_transactions->receiptNumber->HrefValue = "";
			$etranzact_transactions->receiptNumber->TooltipValue = "";

			// transactionNumber
			$etranzact_transactions->transactionNumber->HrefValue = "";
			$etranzact_transactions->transactionNumber->TooltipValue = "";

			// transactionDate
			$etranzact_transactions->transactionDate->HrefValue = "";
			$etranzact_transactions->transactionDate->TooltipValue = "";

			// dateLogged
			$etranzact_transactions->dateLogged->HrefValue = "";
			$etranzact_transactions->dateLogged->TooltipValue = "";

			// transactionReference
			$etranzact_transactions->transactionReference->HrefValue = "";
			$etranzact_transactions->transactionReference->TooltipValue = "";

			// status
			$etranzact_transactions->status->HrefValue = "";
			$etranzact_transactions->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($etranzact_transactions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$etranzact_transactions->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $etranzact_transactions;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($etranzact_transactions->Export <> "") {
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
				$etranzact_transactions->transactionID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $etranzact_transactions->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $etranzact_transactions;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $etranzact_transactions->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($etranzact_transactions->ExportAll) {
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
		if ($etranzact_transactions->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($etranzact_transactions, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($etranzact_transactions->transactionID);
				$ExportDoc->ExportCaption($etranzact_transactions->studentID);
				$ExportDoc->ExportCaption($etranzact_transactions->transactionAmount);
				$ExportDoc->ExportCaption($etranzact_transactions->confirmationNumber);
				$ExportDoc->ExportCaption($etranzact_transactions->receiptNumber);
				$ExportDoc->ExportCaption($etranzact_transactions->transactionNumber);
				$ExportDoc->ExportCaption($etranzact_transactions->transactionDate);
				$ExportDoc->ExportCaption($etranzact_transactions->dateLogged);
				$ExportDoc->ExportCaption($etranzact_transactions->transactionReference);
				$ExportDoc->ExportCaption($etranzact_transactions->status);
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
				$etranzact_transactions->CssClass = "";
				$etranzact_transactions->CssStyle = "";
				$etranzact_transactions->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($etranzact_transactions->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('transactionID', $etranzact_transactions->transactionID->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
					$XmlDoc->AddField('studentID', $etranzact_transactions->studentID->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
					$XmlDoc->AddField('transactionAmount', $etranzact_transactions->transactionAmount->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
					$XmlDoc->AddField('confirmationNumber', $etranzact_transactions->confirmationNumber->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
					$XmlDoc->AddField('receiptNumber', $etranzact_transactions->receiptNumber->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
					$XmlDoc->AddField('transactionNumber', $etranzact_transactions->transactionNumber->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
					$XmlDoc->AddField('transactionDate', $etranzact_transactions->transactionDate->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
					$XmlDoc->AddField('dateLogged', $etranzact_transactions->dateLogged->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
					$XmlDoc->AddField('transactionReference', $etranzact_transactions->transactionReference->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
					$XmlDoc->AddField('status', $etranzact_transactions->status->ExportValue($etranzact_transactions->Export, $etranzact_transactions->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($etranzact_transactions->transactionID);
					$ExportDoc->ExportField($etranzact_transactions->studentID);
					$ExportDoc->ExportField($etranzact_transactions->transactionAmount);
					$ExportDoc->ExportField($etranzact_transactions->confirmationNumber);
					$ExportDoc->ExportField($etranzact_transactions->receiptNumber);
					$ExportDoc->ExportField($etranzact_transactions->transactionNumber);
					$ExportDoc->ExportField($etranzact_transactions->transactionDate);
					$ExportDoc->ExportField($etranzact_transactions->dateLogged);
					$ExportDoc->ExportField($etranzact_transactions->transactionReference);
					$ExportDoc->ExportField($etranzact_transactions->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($etranzact_transactions->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($etranzact_transactions->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($etranzact_transactions->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($etranzact_transactions->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($etranzact_transactions->ExportReturnUrl());
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
