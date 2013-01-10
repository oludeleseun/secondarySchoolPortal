<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_sessionsinfo.php" ?>
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
$academic_sessions_list = new cacademic_sessions_list();
$Page =& $academic_sessions_list;

// Page init
$academic_sessions_list->Page_Init();

// Page main
$academic_sessions_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($academic_sessions->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var academic_sessions_list = new ew_Page("academic_sessions_list");

// page properties
academic_sessions_list.PageID = "list"; // page ID
academic_sessions_list.FormID = "facademic_sessionslist"; // form ID
var EW_PAGE_ID = academic_sessions_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
academic_sessions_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
academic_sessions_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_sessions_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_sessions_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($academic_sessions->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$academic_sessions_list->lTotalRecs = $academic_sessions->SelectRecordCount();
	} else {
		if ($rs = $academic_sessions_list->LoadRecordset())
			$academic_sessions_list->lTotalRecs = $rs->RecordCount();
	}
	$academic_sessions_list->lStartRec = 1;
	if ($academic_sessions_list->lDisplayRecs <= 0 || ($academic_sessions->Export <> "" && $academic_sessions->ExportAll)) // Display all records
		$academic_sessions_list->lDisplayRecs = $academic_sessions_list->lTotalRecs;
	if (!($academic_sessions->Export <> "" && $academic_sessions->ExportAll))
		$academic_sessions_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $academic_sessions_list->LoadRecordset($academic_sessions_list->lStartRec-1, $academic_sessions_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_sessions->TableCaption() ?>
<?php if ($academic_sessions->Export == "" && $academic_sessions->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.facademic_sessionslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.facademic_sessionslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.facademic_sessionslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.facademic_sessionslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($academic_sessions->Export == "" && $academic_sessions->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(academic_sessions_list);" style="text-decoration: none;"><img id="academic_sessions_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="academic_sessions_list_SearchPanel">
<form name="facademic_sessionslistsrch" id="facademic_sessionslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="academic_sessions">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($academic_sessions->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $academic_sessions_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($academic_sessions->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($academic_sessions->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($academic_sessions->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_sessions_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="facademic_sessionslist" id="facademic_sessionslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_academic_sessions" class="ewGridMiddlePanel">
<?php if ($academic_sessions_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $academic_sessions->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$academic_sessions_list->RenderListOptions();

// Render list options (header, left)
$academic_sessions_list->ListOptions->Render("header", "left");
?>
<?php if ($academic_sessions->sessionID->Visible) { // sessionID ?>
	<?php if ($academic_sessions->SortUrl($academic_sessions->sessionID) == "") { ?>
		<td><?php echo $academic_sessions->sessionID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $academic_sessions->SortUrl($academic_sessions->sessionID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $academic_sessions->sessionID->FldCaption() ?></td><td style="width: 10px;"><?php if ($academic_sessions->sessionID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($academic_sessions->sessionID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($academic_sessions->sessionName->Visible) { // sessionName ?>
	<?php if ($academic_sessions->SortUrl($academic_sessions->sessionName) == "") { ?>
		<td><?php echo $academic_sessions->sessionName->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $academic_sessions->SortUrl($academic_sessions->sessionName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $academic_sessions->sessionName->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($academic_sessions->sessionName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($academic_sessions->sessionName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($academic_sessions->sessionStart->Visible) { // sessionStart ?>
	<?php if ($academic_sessions->SortUrl($academic_sessions->sessionStart) == "") { ?>
		<td><?php echo $academic_sessions->sessionStart->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $academic_sessions->SortUrl($academic_sessions->sessionStart) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $academic_sessions->sessionStart->FldCaption() ?></td><td style="width: 10px;"><?php if ($academic_sessions->sessionStart->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($academic_sessions->sessionStart->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($academic_sessions->sessionEnd->Visible) { // sessionEnd ?>
	<?php if ($academic_sessions->SortUrl($academic_sessions->sessionEnd) == "") { ?>
		<td><?php echo $academic_sessions->sessionEnd->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $academic_sessions->SortUrl($academic_sessions->sessionEnd) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $academic_sessions->sessionEnd->FldCaption() ?></td><td style="width: 10px;"><?php if ($academic_sessions->sessionEnd->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($academic_sessions->sessionEnd->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($academic_sessions->currentSession->Visible) { // currentSession ?>
	<?php if ($academic_sessions->SortUrl($academic_sessions->currentSession) == "") { ?>
		<td><?php echo $academic_sessions->currentSession->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $academic_sessions->SortUrl($academic_sessions->currentSession) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $academic_sessions->currentSession->FldCaption() ?></td><td style="width: 10px;"><?php if ($academic_sessions->currentSession->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($academic_sessions->currentSession->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($academic_sessions->status->Visible) { // status ?>
	<?php if ($academic_sessions->SortUrl($academic_sessions->status) == "") { ?>
		<td><?php echo $academic_sessions->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $academic_sessions->SortUrl($academic_sessions->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $academic_sessions->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($academic_sessions->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($academic_sessions->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$academic_sessions_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($academic_sessions->ExportAll && $academic_sessions->Export <> "") {
	$academic_sessions_list->lStopRec = $academic_sessions_list->lTotalRecs;
} else {
	$academic_sessions_list->lStopRec = $academic_sessions_list->lStartRec + $academic_sessions_list->lDisplayRecs - 1; // Set the last record to display
}
$academic_sessions_list->lRecCount = $academic_sessions_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $academic_sessions_list->lStartRec > 1)
		$rs->Move($academic_sessions_list->lStartRec - 1);
}

// Initialize aggregate
$academic_sessions->RowType = EW_ROWTYPE_AGGREGATEINIT;
$academic_sessions_list->RenderRow();
$academic_sessions_list->lRowCnt = 0;
while (($academic_sessions->CurrentAction == "gridadd" || !$rs->EOF) &&
	$academic_sessions_list->lRecCount < $academic_sessions_list->lStopRec) {
	$academic_sessions_list->lRecCount++;
	if (intval($academic_sessions_list->lRecCount) >= intval($academic_sessions_list->lStartRec)) {
		$academic_sessions_list->lRowCnt++;

	// Init row class and style
	$academic_sessions->CssClass = "";
	$academic_sessions->CssStyle = "";
	$academic_sessions->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($academic_sessions->CurrentAction == "gridadd") {
		$academic_sessions_list->LoadDefaultValues(); // Load default values
	} else {
		$academic_sessions_list->LoadRowValues($rs); // Load row values
	}
	$academic_sessions->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$academic_sessions_list->RenderRow();

	// Render list options
	$academic_sessions_list->RenderListOptions();
?>
	<tr<?php echo $academic_sessions->RowAttributes() ?>>
<?php

// Render list options (body, left)
$academic_sessions_list->ListOptions->Render("body", "left");
?>
	<?php if ($academic_sessions->sessionID->Visible) { // sessionID ?>
		<td<?php echo $academic_sessions->sessionID->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionID->ViewAttributes() ?>><?php echo $academic_sessions->sessionID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($academic_sessions->sessionName->Visible) { // sessionName ?>
		<td<?php echo $academic_sessions->sessionName->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionName->ViewAttributes() ?>><?php echo $academic_sessions->sessionName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($academic_sessions->sessionStart->Visible) { // sessionStart ?>
		<td<?php echo $academic_sessions->sessionStart->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionStart->ViewAttributes() ?>><?php echo $academic_sessions->sessionStart->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($academic_sessions->sessionEnd->Visible) { // sessionEnd ?>
		<td<?php echo $academic_sessions->sessionEnd->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionEnd->ViewAttributes() ?>><?php echo $academic_sessions->sessionEnd->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($academic_sessions->currentSession->Visible) { // currentSession ?>
		<td<?php echo $academic_sessions->currentSession->CellAttributes() ?>>
<div<?php echo $academic_sessions->currentSession->ViewAttributes() ?>><?php echo $academic_sessions->currentSession->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($academic_sessions->status->Visible) { // status ?>
		<td<?php echo $academic_sessions->status->CellAttributes() ?>>
<div<?php echo $academic_sessions->status->ViewAttributes() ?>><?php echo $academic_sessions->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$academic_sessions_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($academic_sessions->CurrentAction <> "gridadd")
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
<?php if ($academic_sessions->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($academic_sessions->CurrentAction <> "gridadd" && $academic_sessions->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($academic_sessions_list->Pager)) $academic_sessions_list->Pager = new cPrevNextPager($academic_sessions_list->lStartRec, $academic_sessions_list->lDisplayRecs, $academic_sessions_list->lTotalRecs) ?>
<?php if ($academic_sessions_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($academic_sessions_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $academic_sessions_list->PageUrl() ?>start=<?php echo $academic_sessions_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($academic_sessions_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $academic_sessions_list->PageUrl() ?>start=<?php echo $academic_sessions_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $academic_sessions_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($academic_sessions_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $academic_sessions_list->PageUrl() ?>start=<?php echo $academic_sessions_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($academic_sessions_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $academic_sessions_list->PageUrl() ?>start=<?php echo $academic_sessions_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $academic_sessions_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $academic_sessions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $academic_sessions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $academic_sessions_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($academic_sessions_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($academic_sessions_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_sessions_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($academic_sessions->Export == "" && $academic_sessions->CurrentAction == "") { ?>
<?php } ?>
<?php if ($academic_sessions->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$academic_sessions_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_sessions_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'academic_sessions';

	// Page object name
	var $PageObjName = 'academic_sessions_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_sessions;
		if ($academic_sessions->UseTokenInUrl) $PageUrl .= "t=" . $academic_sessions->TableVar . "&"; // Add page token
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
		global $objForm, $academic_sessions;
		if ($academic_sessions->UseTokenInUrl) {
			if ($objForm)
				return ($academic_sessions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_sessions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_sessions_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_sessions)
		$GLOBALS["academic_sessions"] = new cacademic_sessions();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["academic_sessions"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "academic_sessionsdelete.php";
		$this->MultiUpdateUrl = "academic_sessionsupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_sessions', TRUE);

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
		global $academic_sessions;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$academic_sessions->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$academic_sessions->Export = $_POST["exporttype"];
		} else {
			$academic_sessions->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $academic_sessions->Export; // Get export parameter, used in header
		$gsExportFile = $academic_sessions->TableVar; // Get export file, used in header
		if ($academic_sessions->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($academic_sessions->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($academic_sessions->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $academic_sessions;

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
			$academic_sessions->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($academic_sessions->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $academic_sessions->getRecordsPerPage(); // Restore from Session
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
		$academic_sessions->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$academic_sessions->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$academic_sessions->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $academic_sessions->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$academic_sessions->setSessionWhere($sFilter);
		$academic_sessions->CurrentFilter = "";

		// Export selected records
		if ($academic_sessions->Export <> "")
			$academic_sessions->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($academic_sessions->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($academic_sessions->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $academic_sessions;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $academic_sessions->sessionName, $Keyword);
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
		global $Security, $academic_sessions;
		$sSearchStr = "";
		$sSearchKeyword = $academic_sessions->BasicSearchKeyword;
		$sSearchType = $academic_sessions->BasicSearchType;
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
			$academic_sessions->setSessionBasicSearchKeyword($sSearchKeyword);
			$academic_sessions->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $academic_sessions;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$academic_sessions->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $academic_sessions;
		$academic_sessions->setSessionBasicSearchKeyword("");
		$academic_sessions->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $academic_sessions;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$academic_sessions->BasicSearchKeyword = $academic_sessions->getSessionBasicSearchKeyword();
			$academic_sessions->BasicSearchType = $academic_sessions->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $academic_sessions;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$academic_sessions->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$academic_sessions->CurrentOrderType = @$_GET["ordertype"];
			$academic_sessions->UpdateSort($academic_sessions->sessionID); // sessionID
			$academic_sessions->UpdateSort($academic_sessions->sessionName); // sessionName
			$academic_sessions->UpdateSort($academic_sessions->sessionStart); // sessionStart
			$academic_sessions->UpdateSort($academic_sessions->sessionEnd); // sessionEnd
			$academic_sessions->UpdateSort($academic_sessions->currentSession); // currentSession
			$academic_sessions->UpdateSort($academic_sessions->status); // status
			$academic_sessions->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $academic_sessions;
		$sOrderBy = $academic_sessions->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($academic_sessions->SqlOrderBy() <> "") {
				$sOrderBy = $academic_sessions->SqlOrderBy();
				$academic_sessions->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $academic_sessions;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$academic_sessions->setSessionOrderBy($sOrderBy);
				$academic_sessions->sessionID->setSort("");
				$academic_sessions->sessionName->setSort("");
				$academic_sessions->sessionStart->setSort("");
				$academic_sessions->sessionEnd->setSort("");
				$academic_sessions->currentSession->setSort("");
				$academic_sessions->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$academic_sessions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $academic_sessions;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"academic_sessions_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($academic_sessions->Export <> "" ||
			$academic_sessions->CurrentAction == "gridadd" ||
			$academic_sessions->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $academic_sessions;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($academic_sessions->sessionID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $academic_sessions;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $academic_sessions;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$academic_sessions->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$academic_sessions->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $academic_sessions->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$academic_sessions->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$academic_sessions->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$academic_sessions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $academic_sessions;
		$academic_sessions->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$academic_sessions->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $academic_sessions;

		// Call Recordset Selecting event
		$academic_sessions->Recordset_Selecting($academic_sessions->CurrentFilter);

		// Load List page SQL
		$sSql = $academic_sessions->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$academic_sessions->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_sessions;
		$sFilter = $academic_sessions->KeyFilter();

		// Call Row Selecting event
		$academic_sessions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_sessions->CurrentFilter = $sFilter;
		$sSql = $academic_sessions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_sessions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_sessions;
		$academic_sessions->sessionID->setDbValue($rs->fields('sessionID'));
		$academic_sessions->sessionName->setDbValue($rs->fields('sessionName'));
		$academic_sessions->sessionStart->setDbValue($rs->fields('sessionStart'));
		$academic_sessions->sessionEnd->setDbValue($rs->fields('sessionEnd'));
		$academic_sessions->currentSession->setDbValue($rs->fields('currentSession'));
		$academic_sessions->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_sessions;

		// Initialize URLs
		$this->ViewUrl = $academic_sessions->ViewUrl();
		$this->EditUrl = $academic_sessions->EditUrl();
		$this->InlineEditUrl = $academic_sessions->InlineEditUrl();
		$this->CopyUrl = $academic_sessions->CopyUrl();
		$this->InlineCopyUrl = $academic_sessions->InlineCopyUrl();
		$this->DeleteUrl = $academic_sessions->DeleteUrl();

		// Call Row_Rendering event
		$academic_sessions->Row_Rendering();

		// Common render codes for all row types
		// sessionID

		$academic_sessions->sessionID->CellCssStyle = ""; $academic_sessions->sessionID->CellCssClass = "";
		$academic_sessions->sessionID->CellAttrs = array(); $academic_sessions->sessionID->ViewAttrs = array(); $academic_sessions->sessionID->EditAttrs = array();

		// sessionName
		$academic_sessions->sessionName->CellCssStyle = ""; $academic_sessions->sessionName->CellCssClass = "";
		$academic_sessions->sessionName->CellAttrs = array(); $academic_sessions->sessionName->ViewAttrs = array(); $academic_sessions->sessionName->EditAttrs = array();

		// sessionStart
		$academic_sessions->sessionStart->CellCssStyle = ""; $academic_sessions->sessionStart->CellCssClass = "";
		$academic_sessions->sessionStart->CellAttrs = array(); $academic_sessions->sessionStart->ViewAttrs = array(); $academic_sessions->sessionStart->EditAttrs = array();

		// sessionEnd
		$academic_sessions->sessionEnd->CellCssStyle = ""; $academic_sessions->sessionEnd->CellCssClass = "";
		$academic_sessions->sessionEnd->CellAttrs = array(); $academic_sessions->sessionEnd->ViewAttrs = array(); $academic_sessions->sessionEnd->EditAttrs = array();

		// currentSession
		$academic_sessions->currentSession->CellCssStyle = ""; $academic_sessions->currentSession->CellCssClass = "";
		$academic_sessions->currentSession->CellAttrs = array(); $academic_sessions->currentSession->ViewAttrs = array(); $academic_sessions->currentSession->EditAttrs = array();

		// status
		$academic_sessions->status->CellCssStyle = ""; $academic_sessions->status->CellCssClass = "";
		$academic_sessions->status->CellAttrs = array(); $academic_sessions->status->ViewAttrs = array(); $academic_sessions->status->EditAttrs = array();
		if ($academic_sessions->RowType == EW_ROWTYPE_VIEW) { // View row

			// sessionID
			$academic_sessions->sessionID->ViewValue = $academic_sessions->sessionID->CurrentValue;
			$academic_sessions->sessionID->CssStyle = "";
			$academic_sessions->sessionID->CssClass = "";
			$academic_sessions->sessionID->ViewCustomAttributes = "";

			// sessionName
			$academic_sessions->sessionName->ViewValue = $academic_sessions->sessionName->CurrentValue;
			$academic_sessions->sessionName->CssStyle = "";
			$academic_sessions->sessionName->CssClass = "";
			$academic_sessions->sessionName->ViewCustomAttributes = "";

			// sessionStart
			$academic_sessions->sessionStart->ViewValue = $academic_sessions->sessionStart->CurrentValue;
			$academic_sessions->sessionStart->ViewValue = ew_FormatDateTime($academic_sessions->sessionStart->ViewValue, 5);
			$academic_sessions->sessionStart->CssStyle = "";
			$academic_sessions->sessionStart->CssClass = "";
			$academic_sessions->sessionStart->ViewCustomAttributes = "";

			// sessionEnd
			$academic_sessions->sessionEnd->ViewValue = $academic_sessions->sessionEnd->CurrentValue;
			$academic_sessions->sessionEnd->ViewValue = ew_FormatDateTime($academic_sessions->sessionEnd->ViewValue, 5);
			$academic_sessions->sessionEnd->CssStyle = "";
			$academic_sessions->sessionEnd->CssClass = "";
			$academic_sessions->sessionEnd->ViewCustomAttributes = "";

			// currentSession
			if (strval($academic_sessions->currentSession->CurrentValue) <> "") {
				switch ($academic_sessions->currentSession->CurrentValue) {
					case "Current Session":
						$academic_sessions->currentSession->ViewValue = "1";
						break;
					case "Not Current Session":
						$academic_sessions->currentSession->ViewValue = "0";
						break;
					default:
						$academic_sessions->currentSession->ViewValue = $academic_sessions->currentSession->CurrentValue;
				}
			} else {
				$academic_sessions->currentSession->ViewValue = NULL;
			}
			$academic_sessions->currentSession->CssStyle = "";
			$academic_sessions->currentSession->CssClass = "";
			$academic_sessions->currentSession->ViewCustomAttributes = "";

			// status
			if (strval($academic_sessions->status->CurrentValue) <> "") {
				switch ($academic_sessions->status->CurrentValue) {
					case "1":
						$academic_sessions->status->ViewValue = "Enabled";
						break;
					case "0":
						$academic_sessions->status->ViewValue = "Disabled";
						break;
					default:
						$academic_sessions->status->ViewValue = $academic_sessions->status->CurrentValue;
				}
			} else {
				$academic_sessions->status->ViewValue = NULL;
			}
			$academic_sessions->status->CssStyle = "";
			$academic_sessions->status->CssClass = "";
			$academic_sessions->status->ViewCustomAttributes = "";

			// sessionID
			$academic_sessions->sessionID->HrefValue = "";
			$academic_sessions->sessionID->TooltipValue = "";

			// sessionName
			$academic_sessions->sessionName->HrefValue = "";
			$academic_sessions->sessionName->TooltipValue = "";

			// sessionStart
			$academic_sessions->sessionStart->HrefValue = "";
			$academic_sessions->sessionStart->TooltipValue = "";

			// sessionEnd
			$academic_sessions->sessionEnd->HrefValue = "";
			$academic_sessions->sessionEnd->TooltipValue = "";

			// currentSession
			$academic_sessions->currentSession->HrefValue = "";
			$academic_sessions->currentSession->TooltipValue = "";

			// status
			$academic_sessions->status->HrefValue = "";
			$academic_sessions->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($academic_sessions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_sessions->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $academic_sessions;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($academic_sessions->Export <> "") {
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
				$academic_sessions->sessionID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $academic_sessions->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $academic_sessions;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $academic_sessions->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($academic_sessions->ExportAll) {
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
		if ($academic_sessions->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($academic_sessions, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($academic_sessions->sessionID);
				$ExportDoc->ExportCaption($academic_sessions->sessionName);
				$ExportDoc->ExportCaption($academic_sessions->sessionStart);
				$ExportDoc->ExportCaption($academic_sessions->sessionEnd);
				$ExportDoc->ExportCaption($academic_sessions->currentSession);
				$ExportDoc->ExportCaption($academic_sessions->status);
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
				$academic_sessions->CssClass = "";
				$academic_sessions->CssStyle = "";
				$academic_sessions->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($academic_sessions->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('sessionID', $academic_sessions->sessionID->ExportValue($academic_sessions->Export, $academic_sessions->ExportOriginalValue));
					$XmlDoc->AddField('sessionName', $academic_sessions->sessionName->ExportValue($academic_sessions->Export, $academic_sessions->ExportOriginalValue));
					$XmlDoc->AddField('sessionStart', $academic_sessions->sessionStart->ExportValue($academic_sessions->Export, $academic_sessions->ExportOriginalValue));
					$XmlDoc->AddField('sessionEnd', $academic_sessions->sessionEnd->ExportValue($academic_sessions->Export, $academic_sessions->ExportOriginalValue));
					$XmlDoc->AddField('currentSession', $academic_sessions->currentSession->ExportValue($academic_sessions->Export, $academic_sessions->ExportOriginalValue));
					$XmlDoc->AddField('status', $academic_sessions->status->ExportValue($academic_sessions->Export, $academic_sessions->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($academic_sessions->sessionID);
					$ExportDoc->ExportField($academic_sessions->sessionName);
					$ExportDoc->ExportField($academic_sessions->sessionStart);
					$ExportDoc->ExportField($academic_sessions->sessionEnd);
					$ExportDoc->ExportField($academic_sessions->currentSession);
					$ExportDoc->ExportField($academic_sessions->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($academic_sessions->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($academic_sessions->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($academic_sessions->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($academic_sessions->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($academic_sessions->ExportReturnUrl());
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
