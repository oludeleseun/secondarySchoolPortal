<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "session_termsinfo.php" ?>
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
$session_terms_list = new csession_terms_list();
$Page =& $session_terms_list;

// Page init
$session_terms_list->Page_Init();

// Page main
$session_terms_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($session_terms->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var session_terms_list = new ew_Page("session_terms_list");

// page properties
session_terms_list.PageID = "list"; // page ID
session_terms_list.FormID = "fsession_termslist"; // form ID
var EW_PAGE_ID = session_terms_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
session_terms_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
session_terms_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
session_terms_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
session_terms_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($session_terms->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$session_terms_list->lTotalRecs = $session_terms->SelectRecordCount();
	} else {
		if ($rs = $session_terms_list->LoadRecordset())
			$session_terms_list->lTotalRecs = $rs->RecordCount();
	}
	$session_terms_list->lStartRec = 1;
	if ($session_terms_list->lDisplayRecs <= 0 || ($session_terms->Export <> "" && $session_terms->ExportAll)) // Display all records
		$session_terms_list->lDisplayRecs = $session_terms_list->lTotalRecs;
	if (!($session_terms->Export <> "" && $session_terms->ExportAll))
		$session_terms_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $session_terms_list->LoadRecordset($session_terms_list->lStartRec-1, $session_terms_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $session_terms->TableCaption() ?>
<?php if ($session_terms->Export == "" && $session_terms->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fsession_termslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fsession_termslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fsession_termslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fsession_termslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$session_terms_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fsession_termslist" id="fsession_termslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_session_terms" class="ewGridMiddlePanel">
<?php if ($session_terms_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $session_terms->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$session_terms_list->RenderListOptions();

// Render list options (header, left)
$session_terms_list->ListOptions->Render("header", "left");
?>
<?php if ($session_terms->sessionTermID->Visible) { // sessionTermID ?>
	<?php if ($session_terms->SortUrl($session_terms->sessionTermID) == "") { ?>
		<td><?php echo $session_terms->sessionTermID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $session_terms->SortUrl($session_terms->sessionTermID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $session_terms->sessionTermID->FldCaption() ?></td><td style="width: 10px;"><?php if ($session_terms->sessionTermID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($session_terms->sessionTermID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($session_terms->session->Visible) { // session ?>
	<?php if ($session_terms->SortUrl($session_terms->session) == "") { ?>
		<td><?php echo $session_terms->session->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $session_terms->SortUrl($session_terms->session) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $session_terms->session->FldCaption() ?></td><td style="width: 10px;"><?php if ($session_terms->session->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($session_terms->session->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($session_terms->termID->Visible) { // termID ?>
	<?php if ($session_terms->SortUrl($session_terms->termID) == "") { ?>
		<td><?php echo $session_terms->termID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $session_terms->SortUrl($session_terms->termID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $session_terms->termID->FldCaption() ?></td><td style="width: 10px;"><?php if ($session_terms->termID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($session_terms->termID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($session_terms->termStart->Visible) { // termStart ?>
	<?php if ($session_terms->SortUrl($session_terms->termStart) == "") { ?>
		<td><?php echo $session_terms->termStart->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $session_terms->SortUrl($session_terms->termStart) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $session_terms->termStart->FldCaption() ?></td><td style="width: 10px;"><?php if ($session_terms->termStart->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($session_terms->termStart->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($session_terms->termEnd->Visible) { // termEnd ?>
	<?php if ($session_terms->SortUrl($session_terms->termEnd) == "") { ?>
		<td><?php echo $session_terms->termEnd->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $session_terms->SortUrl($session_terms->termEnd) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $session_terms->termEnd->FldCaption() ?></td><td style="width: 10px;"><?php if ($session_terms->termEnd->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($session_terms->termEnd->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($session_terms->currentTerm->Visible) { // currentTerm ?>
	<?php if ($session_terms->SortUrl($session_terms->currentTerm) == "") { ?>
		<td><?php echo $session_terms->currentTerm->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $session_terms->SortUrl($session_terms->currentTerm) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $session_terms->currentTerm->FldCaption() ?></td><td style="width: 10px;"><?php if ($session_terms->currentTerm->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($session_terms->currentTerm->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($session_terms->showResults->Visible) { // showResults ?>
	<?php if ($session_terms->SortUrl($session_terms->showResults) == "") { ?>
		<td><?php echo $session_terms->showResults->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $session_terms->SortUrl($session_terms->showResults) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $session_terms->showResults->FldCaption() ?></td><td style="width: 10px;"><?php if ($session_terms->showResults->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($session_terms->showResults->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($session_terms->status->Visible) { // status ?>
	<?php if ($session_terms->SortUrl($session_terms->status) == "") { ?>
		<td><?php echo $session_terms->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $session_terms->SortUrl($session_terms->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $session_terms->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($session_terms->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($session_terms->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$session_terms_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($session_terms->ExportAll && $session_terms->Export <> "") {
	$session_terms_list->lStopRec = $session_terms_list->lTotalRecs;
} else {
	$session_terms_list->lStopRec = $session_terms_list->lStartRec + $session_terms_list->lDisplayRecs - 1; // Set the last record to display
}
$session_terms_list->lRecCount = $session_terms_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $session_terms_list->lStartRec > 1)
		$rs->Move($session_terms_list->lStartRec - 1);
}

// Initialize aggregate
$session_terms->RowType = EW_ROWTYPE_AGGREGATEINIT;
$session_terms_list->RenderRow();
$session_terms_list->lRowCnt = 0;
while (($session_terms->CurrentAction == "gridadd" || !$rs->EOF) &&
	$session_terms_list->lRecCount < $session_terms_list->lStopRec) {
	$session_terms_list->lRecCount++;
	if (intval($session_terms_list->lRecCount) >= intval($session_terms_list->lStartRec)) {
		$session_terms_list->lRowCnt++;

	// Init row class and style
	$session_terms->CssClass = "";
	$session_terms->CssStyle = "";
	$session_terms->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($session_terms->CurrentAction == "gridadd") {
		$session_terms_list->LoadDefaultValues(); // Load default values
	} else {
		$session_terms_list->LoadRowValues($rs); // Load row values
	}
	$session_terms->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$session_terms_list->RenderRow();

	// Render list options
	$session_terms_list->RenderListOptions();
?>
	<tr<?php echo $session_terms->RowAttributes() ?>>
<?php

// Render list options (body, left)
$session_terms_list->ListOptions->Render("body", "left");
?>
	<?php if ($session_terms->sessionTermID->Visible) { // sessionTermID ?>
		<td<?php echo $session_terms->sessionTermID->CellAttributes() ?>>
<div<?php echo $session_terms->sessionTermID->ViewAttributes() ?>><?php echo $session_terms->sessionTermID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($session_terms->session->Visible) { // session ?>
		<td<?php echo $session_terms->session->CellAttributes() ?>>
<div<?php echo $session_terms->session->ViewAttributes() ?>><?php echo $session_terms->session->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($session_terms->termID->Visible) { // termID ?>
		<td<?php echo $session_terms->termID->CellAttributes() ?>>
<div<?php echo $session_terms->termID->ViewAttributes() ?>><?php echo $session_terms->termID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($session_terms->termStart->Visible) { // termStart ?>
		<td<?php echo $session_terms->termStart->CellAttributes() ?>>
<div<?php echo $session_terms->termStart->ViewAttributes() ?>><?php echo $session_terms->termStart->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($session_terms->termEnd->Visible) { // termEnd ?>
		<td<?php echo $session_terms->termEnd->CellAttributes() ?>>
<div<?php echo $session_terms->termEnd->ViewAttributes() ?>><?php echo $session_terms->termEnd->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($session_terms->currentTerm->Visible) { // currentTerm ?>
		<td<?php echo $session_terms->currentTerm->CellAttributes() ?>>
<div<?php echo $session_terms->currentTerm->ViewAttributes() ?>><?php echo $session_terms->currentTerm->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($session_terms->showResults->Visible) { // showResults ?>
		<td<?php echo $session_terms->showResults->CellAttributes() ?>>
<div<?php echo $session_terms->showResults->ViewAttributes() ?>><?php echo $session_terms->showResults->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($session_terms->status->Visible) { // status ?>
		<td<?php echo $session_terms->status->CellAttributes() ?>>
<div<?php echo $session_terms->status->ViewAttributes() ?>><?php echo $session_terms->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$session_terms_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($session_terms->CurrentAction <> "gridadd")
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
<?php if ($session_terms->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($session_terms->CurrentAction <> "gridadd" && $session_terms->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($session_terms_list->Pager)) $session_terms_list->Pager = new cPrevNextPager($session_terms_list->lStartRec, $session_terms_list->lDisplayRecs, $session_terms_list->lTotalRecs) ?>
<?php if ($session_terms_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($session_terms_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $session_terms_list->PageUrl() ?>start=<?php echo $session_terms_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($session_terms_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $session_terms_list->PageUrl() ?>start=<?php echo $session_terms_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $session_terms_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($session_terms_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $session_terms_list->PageUrl() ?>start=<?php echo $session_terms_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($session_terms_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $session_terms_list->PageUrl() ?>start=<?php echo $session_terms_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $session_terms_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $session_terms_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $session_terms_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $session_terms_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($session_terms_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($session_terms_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $session_terms_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($session_terms->Export == "" && $session_terms->CurrentAction == "") { ?>
<?php } ?>
<?php if ($session_terms->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$session_terms_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csession_terms_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'session_terms';

	// Page object name
	var $PageObjName = 'session_terms_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $session_terms;
		if ($session_terms->UseTokenInUrl) $PageUrl .= "t=" . $session_terms->TableVar . "&"; // Add page token
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
		global $objForm, $session_terms;
		if ($session_terms->UseTokenInUrl) {
			if ($objForm)
				return ($session_terms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($session_terms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csession_terms_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (session_terms)
		$GLOBALS["session_terms"] = new csession_terms();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["session_terms"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "session_termsdelete.php";
		$this->MultiUpdateUrl = "session_termsupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'session_terms', TRUE);

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
		global $session_terms;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$session_terms->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$session_terms->Export = $_POST["exporttype"];
		} else {
			$session_terms->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $session_terms->Export; // Get export parameter, used in header
		$gsExportFile = $session_terms->TableVar; // Get export file, used in header
		if ($session_terms->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($session_terms->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($session_terms->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $session_terms;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($session_terms->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $session_terms->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$session_terms->setSessionWhere($sFilter);
		$session_terms->CurrentFilter = "";

		// Export selected records
		if ($session_terms->Export <> "")
			$session_terms->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($session_terms->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($session_terms->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $session_terms;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$session_terms->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$session_terms->CurrentOrderType = @$_GET["ordertype"];
			$session_terms->UpdateSort($session_terms->sessionTermID); // sessionTermID
			$session_terms->UpdateSort($session_terms->session); // session
			$session_terms->UpdateSort($session_terms->termID); // termID
			$session_terms->UpdateSort($session_terms->termStart); // termStart
			$session_terms->UpdateSort($session_terms->termEnd); // termEnd
			$session_terms->UpdateSort($session_terms->currentTerm); // currentTerm
			$session_terms->UpdateSort($session_terms->showResults); // showResults
			$session_terms->UpdateSort($session_terms->status); // status
			$session_terms->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $session_terms;
		$sOrderBy = $session_terms->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($session_terms->SqlOrderBy() <> "") {
				$sOrderBy = $session_terms->SqlOrderBy();
				$session_terms->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $session_terms;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$session_terms->setSessionOrderBy($sOrderBy);
				$session_terms->sessionTermID->setSort("");
				$session_terms->session->setSort("");
				$session_terms->termID->setSort("");
				$session_terms->termStart->setSort("");
				$session_terms->termEnd->setSort("");
				$session_terms->currentTerm->setSort("");
				$session_terms->showResults->setSort("");
				$session_terms->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$session_terms->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $session_terms;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"session_terms_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($session_terms->Export <> "" ||
			$session_terms->CurrentAction == "gridadd" ||
			$session_terms->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $session_terms;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($session_terms->sessionTermID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $session_terms;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $session_terms;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$session_terms->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$session_terms->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $session_terms->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$session_terms->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$session_terms->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$session_terms->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $session_terms;

		// Call Recordset Selecting event
		$session_terms->Recordset_Selecting($session_terms->CurrentFilter);

		// Load List page SQL
		$sSql = $session_terms->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$session_terms->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $session_terms;
		$sFilter = $session_terms->KeyFilter();

		// Call Row Selecting event
		$session_terms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$session_terms->CurrentFilter = $sFilter;
		$sSql = $session_terms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$session_terms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $session_terms;
		$session_terms->sessionTermID->setDbValue($rs->fields('sessionTermID'));
		$session_terms->session->setDbValue($rs->fields('session'));
		$session_terms->termID->setDbValue($rs->fields('termID'));
		$session_terms->termStart->setDbValue($rs->fields('termStart'));
		$session_terms->termEnd->setDbValue($rs->fields('termEnd'));
		$session_terms->currentTerm->setDbValue($rs->fields('currentTerm'));
		$session_terms->showResults->setDbValue($rs->fields('showResults'));
		$session_terms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $session_terms;

		// Initialize URLs
		$this->ViewUrl = $session_terms->ViewUrl();
		$this->EditUrl = $session_terms->EditUrl();
		$this->InlineEditUrl = $session_terms->InlineEditUrl();
		$this->CopyUrl = $session_terms->CopyUrl();
		$this->InlineCopyUrl = $session_terms->InlineCopyUrl();
		$this->DeleteUrl = $session_terms->DeleteUrl();

		// Call Row_Rendering event
		$session_terms->Row_Rendering();

		// Common render codes for all row types
		// sessionTermID

		$session_terms->sessionTermID->CellCssStyle = ""; $session_terms->sessionTermID->CellCssClass = "";
		$session_terms->sessionTermID->CellAttrs = array(); $session_terms->sessionTermID->ViewAttrs = array(); $session_terms->sessionTermID->EditAttrs = array();

		// session
		$session_terms->session->CellCssStyle = ""; $session_terms->session->CellCssClass = "";
		$session_terms->session->CellAttrs = array(); $session_terms->session->ViewAttrs = array(); $session_terms->session->EditAttrs = array();

		// termID
		$session_terms->termID->CellCssStyle = ""; $session_terms->termID->CellCssClass = "";
		$session_terms->termID->CellAttrs = array(); $session_terms->termID->ViewAttrs = array(); $session_terms->termID->EditAttrs = array();

		// termStart
		$session_terms->termStart->CellCssStyle = ""; $session_terms->termStart->CellCssClass = "";
		$session_terms->termStart->CellAttrs = array(); $session_terms->termStart->ViewAttrs = array(); $session_terms->termStart->EditAttrs = array();

		// termEnd
		$session_terms->termEnd->CellCssStyle = ""; $session_terms->termEnd->CellCssClass = "";
		$session_terms->termEnd->CellAttrs = array(); $session_terms->termEnd->ViewAttrs = array(); $session_terms->termEnd->EditAttrs = array();

		// currentTerm
		$session_terms->currentTerm->CellCssStyle = ""; $session_terms->currentTerm->CellCssClass = "";
		$session_terms->currentTerm->CellAttrs = array(); $session_terms->currentTerm->ViewAttrs = array(); $session_terms->currentTerm->EditAttrs = array();

		// showResults
		$session_terms->showResults->CellCssStyle = ""; $session_terms->showResults->CellCssClass = "";
		$session_terms->showResults->CellAttrs = array(); $session_terms->showResults->ViewAttrs = array(); $session_terms->showResults->EditAttrs = array();

		// status
		$session_terms->status->CellCssStyle = ""; $session_terms->status->CellCssClass = "";
		$session_terms->status->CellAttrs = array(); $session_terms->status->ViewAttrs = array(); $session_terms->status->EditAttrs = array();
		if ($session_terms->RowType == EW_ROWTYPE_VIEW) { // View row

			// sessionTermID
			$session_terms->sessionTermID->ViewValue = $session_terms->sessionTermID->CurrentValue;
			$session_terms->sessionTermID->CssStyle = "";
			$session_terms->sessionTermID->CssClass = "";
			$session_terms->sessionTermID->ViewCustomAttributes = "";

			// session
			if (strval($session_terms->session->CurrentValue) <> "") {
				$sFilterWrk = "`sessionID` = " . ew_AdjustSql($session_terms->session->CurrentValue) . "";
			$sSqlWrk = "SELECT `sessionName` FROM `academic_sessions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$session_terms->session->ViewValue = $rswrk->fields('sessionName');
					$rswrk->Close();
				} else {
					$session_terms->session->ViewValue = $session_terms->session->CurrentValue;
				}
			} else {
				$session_terms->session->ViewValue = NULL;
			}
			$session_terms->session->CssStyle = "";
			$session_terms->session->CssClass = "";
			$session_terms->session->ViewCustomAttributes = "";

			// termID
			if (strval($session_terms->termID->CurrentValue) <> "") {
				$sFilterWrk = "`termID` = " . ew_AdjustSql($session_terms->termID->CurrentValue) . "";
			$sSqlWrk = "SELECT `termName` FROM `academic_terms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$session_terms->termID->ViewValue = $rswrk->fields('termName');
					$rswrk->Close();
				} else {
					$session_terms->termID->ViewValue = $session_terms->termID->CurrentValue;
				}
			} else {
				$session_terms->termID->ViewValue = NULL;
			}
			$session_terms->termID->CssStyle = "";
			$session_terms->termID->CssClass = "";
			$session_terms->termID->ViewCustomAttributes = "";

			// termStart
			$session_terms->termStart->ViewValue = $session_terms->termStart->CurrentValue;
			$session_terms->termStart->ViewValue = ew_FormatDateTime($session_terms->termStart->ViewValue, 5);
			$session_terms->termStart->CssStyle = "";
			$session_terms->termStart->CssClass = "";
			$session_terms->termStart->ViewCustomAttributes = "";

			// termEnd
			$session_terms->termEnd->ViewValue = $session_terms->termEnd->CurrentValue;
			$session_terms->termEnd->ViewValue = ew_FormatDateTime($session_terms->termEnd->ViewValue, 5);
			$session_terms->termEnd->CssStyle = "";
			$session_terms->termEnd->CssClass = "";
			$session_terms->termEnd->ViewCustomAttributes = "";

			// currentTerm
			if (strval($session_terms->currentTerm->CurrentValue) <> "") {
				switch ($session_terms->currentTerm->CurrentValue) {
					case "1":
						$session_terms->currentTerm->ViewValue = "Yes";
						break;
					case "0":
						$session_terms->currentTerm->ViewValue = "No";
						break;
					default:
						$session_terms->currentTerm->ViewValue = $session_terms->currentTerm->CurrentValue;
				}
			} else {
				$session_terms->currentTerm->ViewValue = NULL;
			}
			$session_terms->currentTerm->CssStyle = "";
			$session_terms->currentTerm->CssClass = "";
			$session_terms->currentTerm->ViewCustomAttributes = "";

			// showResults
			if (strval($session_terms->showResults->CurrentValue) <> "") {
				switch ($session_terms->showResults->CurrentValue) {
					case "1":
						$session_terms->showResults->ViewValue = "Yes";
						break;
					case "0":
						$session_terms->showResults->ViewValue = "No";
						break;
					default:
						$session_terms->showResults->ViewValue = $session_terms->showResults->CurrentValue;
				}
			} else {
				$session_terms->showResults->ViewValue = NULL;
			}
			$session_terms->showResults->CssStyle = "";
			$session_terms->showResults->CssClass = "";
			$session_terms->showResults->ViewCustomAttributes = "";

			// status
			if (strval($session_terms->status->CurrentValue) <> "") {
				switch ($session_terms->status->CurrentValue) {
					case "1":
						$session_terms->status->ViewValue = "Enabled";
						break;
					case "0":
						$session_terms->status->ViewValue = "Disabled";
						break;
					default:
						$session_terms->status->ViewValue = $session_terms->status->CurrentValue;
				}
			} else {
				$session_terms->status->ViewValue = NULL;
			}
			$session_terms->status->CssStyle = "";
			$session_terms->status->CssClass = "";
			$session_terms->status->ViewCustomAttributes = "";

			// sessionTermID
			$session_terms->sessionTermID->HrefValue = "";
			$session_terms->sessionTermID->TooltipValue = "";

			// session
			$session_terms->session->HrefValue = "";
			$session_terms->session->TooltipValue = "";

			// termID
			$session_terms->termID->HrefValue = "";
			$session_terms->termID->TooltipValue = "";

			// termStart
			$session_terms->termStart->HrefValue = "";
			$session_terms->termStart->TooltipValue = "";

			// termEnd
			$session_terms->termEnd->HrefValue = "";
			$session_terms->termEnd->TooltipValue = "";

			// currentTerm
			$session_terms->currentTerm->HrefValue = "";
			$session_terms->currentTerm->TooltipValue = "";

			// showResults
			$session_terms->showResults->HrefValue = "";
			$session_terms->showResults->TooltipValue = "";

			// status
			$session_terms->status->HrefValue = "";
			$session_terms->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($session_terms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$session_terms->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $session_terms;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($session_terms->Export <> "") {
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
				$session_terms->sessionTermID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $session_terms->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $session_terms;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $session_terms->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($session_terms->ExportAll) {
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
		if ($session_terms->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($session_terms, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($session_terms->sessionTermID);
				$ExportDoc->ExportCaption($session_terms->session);
				$ExportDoc->ExportCaption($session_terms->termID);
				$ExportDoc->ExportCaption($session_terms->termStart);
				$ExportDoc->ExportCaption($session_terms->termEnd);
				$ExportDoc->ExportCaption($session_terms->currentTerm);
				$ExportDoc->ExportCaption($session_terms->showResults);
				$ExportDoc->ExportCaption($session_terms->status);
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
				$session_terms->CssClass = "";
				$session_terms->CssStyle = "";
				$session_terms->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($session_terms->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('sessionTermID', $session_terms->sessionTermID->ExportValue($session_terms->Export, $session_terms->ExportOriginalValue));
					$XmlDoc->AddField('session', $session_terms->session->ExportValue($session_terms->Export, $session_terms->ExportOriginalValue));
					$XmlDoc->AddField('termID', $session_terms->termID->ExportValue($session_terms->Export, $session_terms->ExportOriginalValue));
					$XmlDoc->AddField('termStart', $session_terms->termStart->ExportValue($session_terms->Export, $session_terms->ExportOriginalValue));
					$XmlDoc->AddField('termEnd', $session_terms->termEnd->ExportValue($session_terms->Export, $session_terms->ExportOriginalValue));
					$XmlDoc->AddField('currentTerm', $session_terms->currentTerm->ExportValue($session_terms->Export, $session_terms->ExportOriginalValue));
					$XmlDoc->AddField('showResults', $session_terms->showResults->ExportValue($session_terms->Export, $session_terms->ExportOriginalValue));
					$XmlDoc->AddField('status', $session_terms->status->ExportValue($session_terms->Export, $session_terms->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($session_terms->sessionTermID);
					$ExportDoc->ExportField($session_terms->session);
					$ExportDoc->ExportField($session_terms->termID);
					$ExportDoc->ExportField($session_terms->termStart);
					$ExportDoc->ExportField($session_terms->termEnd);
					$ExportDoc->ExportField($session_terms->currentTerm);
					$ExportDoc->ExportField($session_terms->showResults);
					$ExportDoc->ExportField($session_terms->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($session_terms->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($session_terms->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($session_terms->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($session_terms->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($session_terms->ExportReturnUrl());
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
