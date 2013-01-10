<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "term_result_approvalinfo.php" ?>
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
$term_result_approval_list = new cterm_result_approval_list();
$Page =& $term_result_approval_list;

// Page init
$term_result_approval_list->Page_Init();

// Page main
$term_result_approval_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($term_result_approval->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var term_result_approval_list = new ew_Page("term_result_approval_list");

// page properties
term_result_approval_list.PageID = "list"; // page ID
term_result_approval_list.FormID = "fterm_result_approvallist"; // form ID
var EW_PAGE_ID = term_result_approval_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
term_result_approval_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
term_result_approval_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
term_result_approval_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
term_result_approval_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($term_result_approval->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$term_result_approval_list->lTotalRecs = $term_result_approval->SelectRecordCount();
	} else {
		if ($rs = $term_result_approval_list->LoadRecordset())
			$term_result_approval_list->lTotalRecs = $rs->RecordCount();
	}
	$term_result_approval_list->lStartRec = 1;
	if ($term_result_approval_list->lDisplayRecs <= 0 || ($term_result_approval->Export <> "" && $term_result_approval->ExportAll)) // Display all records
		$term_result_approval_list->lDisplayRecs = $term_result_approval_list->lTotalRecs;
	if (!($term_result_approval->Export <> "" && $term_result_approval->ExportAll))
		$term_result_approval_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $term_result_approval_list->LoadRecordset($term_result_approval_list->lStartRec-1, $term_result_approval_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $term_result_approval->TableCaption() ?>
<?php if ($term_result_approval->Export == "" && $term_result_approval->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fterm_result_approvallist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fterm_result_approvallist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fterm_result_approvallist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fterm_result_approvallist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$term_result_approval_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fterm_result_approvallist" id="fterm_result_approvallist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_term_result_approval" class="ewGridMiddlePanel">
<?php if ($term_result_approval_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $term_result_approval->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$term_result_approval_list->RenderListOptions();

// Render list options (header, left)
$term_result_approval_list->ListOptions->Render("header", "left");
?>
<?php if ($term_result_approval->approvalID->Visible) { // approvalID ?>
	<?php if ($term_result_approval->SortUrl($term_result_approval->approvalID) == "") { ?>
		<td><?php echo $term_result_approval->approvalID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $term_result_approval->SortUrl($term_result_approval->approvalID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $term_result_approval->approvalID->FldCaption() ?></td><td style="width: 10px;"><?php if ($term_result_approval->approvalID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($term_result_approval->approvalID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($term_result_approval->sessionTermID->Visible) { // sessionTermID ?>
	<?php if ($term_result_approval->SortUrl($term_result_approval->sessionTermID) == "") { ?>
		<td><?php echo $term_result_approval->sessionTermID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $term_result_approval->SortUrl($term_result_approval->sessionTermID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $term_result_approval->sessionTermID->FldCaption() ?></td><td style="width: 10px;"><?php if ($term_result_approval->sessionTermID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($term_result_approval->sessionTermID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($term_result_approval->status->Visible) { // status ?>
	<?php if ($term_result_approval->SortUrl($term_result_approval->status) == "") { ?>
		<td><?php echo $term_result_approval->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $term_result_approval->SortUrl($term_result_approval->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $term_result_approval->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($term_result_approval->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($term_result_approval->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$term_result_approval_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($term_result_approval->ExportAll && $term_result_approval->Export <> "") {
	$term_result_approval_list->lStopRec = $term_result_approval_list->lTotalRecs;
} else {
	$term_result_approval_list->lStopRec = $term_result_approval_list->lStartRec + $term_result_approval_list->lDisplayRecs - 1; // Set the last record to display
}
$term_result_approval_list->lRecCount = $term_result_approval_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $term_result_approval_list->lStartRec > 1)
		$rs->Move($term_result_approval_list->lStartRec - 1);
}

// Initialize aggregate
$term_result_approval->RowType = EW_ROWTYPE_AGGREGATEINIT;
$term_result_approval_list->RenderRow();
$term_result_approval_list->lRowCnt = 0;
while (($term_result_approval->CurrentAction == "gridadd" || !$rs->EOF) &&
	$term_result_approval_list->lRecCount < $term_result_approval_list->lStopRec) {
	$term_result_approval_list->lRecCount++;
	if (intval($term_result_approval_list->lRecCount) >= intval($term_result_approval_list->lStartRec)) {
		$term_result_approval_list->lRowCnt++;

	// Init row class and style
	$term_result_approval->CssClass = "";
	$term_result_approval->CssStyle = "";
	$term_result_approval->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($term_result_approval->CurrentAction == "gridadd") {
		$term_result_approval_list->LoadDefaultValues(); // Load default values
	} else {
		$term_result_approval_list->LoadRowValues($rs); // Load row values
	}
	$term_result_approval->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$term_result_approval_list->RenderRow();

	// Render list options
	$term_result_approval_list->RenderListOptions();
?>
	<tr<?php echo $term_result_approval->RowAttributes() ?>>
<?php

// Render list options (body, left)
$term_result_approval_list->ListOptions->Render("body", "left");
?>
	<?php if ($term_result_approval->approvalID->Visible) { // approvalID ?>
		<td<?php echo $term_result_approval->approvalID->CellAttributes() ?>>
<div<?php echo $term_result_approval->approvalID->ViewAttributes() ?>><?php echo $term_result_approval->approvalID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($term_result_approval->sessionTermID->Visible) { // sessionTermID ?>
		<td<?php echo $term_result_approval->sessionTermID->CellAttributes() ?>>
<div<?php echo $term_result_approval->sessionTermID->ViewAttributes() ?>><?php echo $term_result_approval->sessionTermID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($term_result_approval->status->Visible) { // status ?>
		<td<?php echo $term_result_approval->status->CellAttributes() ?>>
<div<?php echo $term_result_approval->status->ViewAttributes() ?>><?php echo $term_result_approval->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$term_result_approval_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($term_result_approval->CurrentAction <> "gridadd")
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
<?php if ($term_result_approval->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($term_result_approval->CurrentAction <> "gridadd" && $term_result_approval->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($term_result_approval_list->Pager)) $term_result_approval_list->Pager = new cPrevNextPager($term_result_approval_list->lStartRec, $term_result_approval_list->lDisplayRecs, $term_result_approval_list->lTotalRecs) ?>
<?php if ($term_result_approval_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($term_result_approval_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $term_result_approval_list->PageUrl() ?>start=<?php echo $term_result_approval_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($term_result_approval_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $term_result_approval_list->PageUrl() ?>start=<?php echo $term_result_approval_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $term_result_approval_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($term_result_approval_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $term_result_approval_list->PageUrl() ?>start=<?php echo $term_result_approval_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($term_result_approval_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $term_result_approval_list->PageUrl() ?>start=<?php echo $term_result_approval_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $term_result_approval_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $term_result_approval_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $term_result_approval_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $term_result_approval_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($term_result_approval_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($term_result_approval_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $term_result_approval_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($term_result_approval->Export == "" && $term_result_approval->CurrentAction == "") { ?>
<?php } ?>
<?php if ($term_result_approval->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$term_result_approval_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cterm_result_approval_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'term_result_approval';

	// Page object name
	var $PageObjName = 'term_result_approval_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $term_result_approval;
		if ($term_result_approval->UseTokenInUrl) $PageUrl .= "t=" . $term_result_approval->TableVar . "&"; // Add page token
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
		global $objForm, $term_result_approval;
		if ($term_result_approval->UseTokenInUrl) {
			if ($objForm)
				return ($term_result_approval->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($term_result_approval->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cterm_result_approval_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (term_result_approval)
		$GLOBALS["term_result_approval"] = new cterm_result_approval();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["term_result_approval"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "term_result_approvaldelete.php";
		$this->MultiUpdateUrl = "term_result_approvalupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'term_result_approval', TRUE);

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
		global $term_result_approval;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$term_result_approval->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$term_result_approval->Export = $_POST["exporttype"];
		} else {
			$term_result_approval->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $term_result_approval->Export; // Get export parameter, used in header
		$gsExportFile = $term_result_approval->TableVar; // Get export file, used in header
		if ($term_result_approval->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($term_result_approval->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($term_result_approval->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $term_result_approval;

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
		if ($term_result_approval->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $term_result_approval->getRecordsPerPage(); // Restore from Session
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
		$term_result_approval->setSessionWhere($sFilter);
		$term_result_approval->CurrentFilter = "";

		// Export selected records
		if ($term_result_approval->Export <> "")
			$term_result_approval->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($term_result_approval->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($term_result_approval->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $term_result_approval;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$term_result_approval->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$term_result_approval->CurrentOrderType = @$_GET["ordertype"];
			$term_result_approval->UpdateSort($term_result_approval->approvalID); // approvalID
			$term_result_approval->UpdateSort($term_result_approval->sessionTermID); // sessionTermID
			$term_result_approval->UpdateSort($term_result_approval->status); // status
			$term_result_approval->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $term_result_approval;
		$sOrderBy = $term_result_approval->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($term_result_approval->SqlOrderBy() <> "") {
				$sOrderBy = $term_result_approval->SqlOrderBy();
				$term_result_approval->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $term_result_approval;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$term_result_approval->setSessionOrderBy($sOrderBy);
				$term_result_approval->approvalID->setSort("");
				$term_result_approval->sessionTermID->setSort("");
				$term_result_approval->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$term_result_approval->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $term_result_approval;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"term_result_approval_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($term_result_approval->Export <> "" ||
			$term_result_approval->CurrentAction == "gridadd" ||
			$term_result_approval->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $term_result_approval;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($term_result_approval->approvalID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $term_result_approval;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $term_result_approval;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$term_result_approval->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$term_result_approval->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $term_result_approval->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$term_result_approval->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$term_result_approval->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$term_result_approval->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $term_result_approval;

		// Call Recordset Selecting event
		$term_result_approval->Recordset_Selecting($term_result_approval->CurrentFilter);

		// Load List page SQL
		$sSql = $term_result_approval->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$term_result_approval->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $term_result_approval;
		$sFilter = $term_result_approval->KeyFilter();

		// Call Row Selecting event
		$term_result_approval->Row_Selecting($sFilter);

		// Load SQL based on filter
		$term_result_approval->CurrentFilter = $sFilter;
		$sSql = $term_result_approval->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$term_result_approval->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $term_result_approval;
		$term_result_approval->approvalID->setDbValue($rs->fields('approvalID'));
		$term_result_approval->sessionTermID->setDbValue($rs->fields('sessionTermID'));
		$term_result_approval->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $term_result_approval;

		// Initialize URLs
		$this->ViewUrl = $term_result_approval->ViewUrl();
		$this->EditUrl = $term_result_approval->EditUrl();
		$this->InlineEditUrl = $term_result_approval->InlineEditUrl();
		$this->CopyUrl = $term_result_approval->CopyUrl();
		$this->InlineCopyUrl = $term_result_approval->InlineCopyUrl();
		$this->DeleteUrl = $term_result_approval->DeleteUrl();

		// Call Row_Rendering event
		$term_result_approval->Row_Rendering();

		// Common render codes for all row types
		// approvalID

		$term_result_approval->approvalID->CellCssStyle = ""; $term_result_approval->approvalID->CellCssClass = "";
		$term_result_approval->approvalID->CellAttrs = array(); $term_result_approval->approvalID->ViewAttrs = array(); $term_result_approval->approvalID->EditAttrs = array();

		// sessionTermID
		$term_result_approval->sessionTermID->CellCssStyle = ""; $term_result_approval->sessionTermID->CellCssClass = "";
		$term_result_approval->sessionTermID->CellAttrs = array(); $term_result_approval->sessionTermID->ViewAttrs = array(); $term_result_approval->sessionTermID->EditAttrs = array();

		// status
		$term_result_approval->status->CellCssStyle = ""; $term_result_approval->status->CellCssClass = "";
		$term_result_approval->status->CellAttrs = array(); $term_result_approval->status->ViewAttrs = array(); $term_result_approval->status->EditAttrs = array();
		if ($term_result_approval->RowType == EW_ROWTYPE_VIEW) { // View row

			// approvalID
			$term_result_approval->approvalID->ViewValue = $term_result_approval->approvalID->CurrentValue;
			$term_result_approval->approvalID->CssStyle = "";
			$term_result_approval->approvalID->CssClass = "";
			$term_result_approval->approvalID->ViewCustomAttributes = "";

			// sessionTermID
			$term_result_approval->sessionTermID->ViewValue = $term_result_approval->sessionTermID->CurrentValue;
			if (strval($term_result_approval->sessionTermID->CurrentValue) <> "") {
				$sFilterWrk = "`sessionTermID` = " . ew_AdjustSql($term_result_approval->sessionTermID->CurrentValue) . "";
			$sSqlWrk = "SELECT `termID` FROM `session_terms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$term_result_approval->sessionTermID->ViewValue = $rswrk->fields('termID');
					$rswrk->Close();
				} else {
					$term_result_approval->sessionTermID->ViewValue = $term_result_approval->sessionTermID->CurrentValue;
				}
			} else {
				$term_result_approval->sessionTermID->ViewValue = NULL;
			}
			$term_result_approval->sessionTermID->CssStyle = "";
			$term_result_approval->sessionTermID->CssClass = "";
			$term_result_approval->sessionTermID->ViewCustomAttributes = "";

			// status
			if (strval($term_result_approval->status->CurrentValue) <> "") {
				switch ($term_result_approval->status->CurrentValue) {
					case "1":
						$term_result_approval->status->ViewValue = "Publish";
						break;
					case "0":
						$term_result_approval->status->ViewValue = "Don't Publish";
						break;
					default:
						$term_result_approval->status->ViewValue = $term_result_approval->status->CurrentValue;
				}
			} else {
				$term_result_approval->status->ViewValue = NULL;
			}
			$term_result_approval->status->CssStyle = "";
			$term_result_approval->status->CssClass = "";
			$term_result_approval->status->ViewCustomAttributes = "";

			// approvalID
			$term_result_approval->approvalID->HrefValue = "";
			$term_result_approval->approvalID->TooltipValue = "";

			// sessionTermID
			$term_result_approval->sessionTermID->HrefValue = "";
			$term_result_approval->sessionTermID->TooltipValue = "";

			// status
			$term_result_approval->status->HrefValue = "";
			$term_result_approval->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($term_result_approval->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$term_result_approval->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $term_result_approval;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($term_result_approval->Export <> "") {
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
				$term_result_approval->approvalID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $term_result_approval->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $term_result_approval;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $term_result_approval->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($term_result_approval->ExportAll) {
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
		if ($term_result_approval->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($term_result_approval, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($term_result_approval->approvalID);
				$ExportDoc->ExportCaption($term_result_approval->sessionTermID);
				$ExportDoc->ExportCaption($term_result_approval->status);
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
				$term_result_approval->CssClass = "";
				$term_result_approval->CssStyle = "";
				$term_result_approval->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($term_result_approval->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('approvalID', $term_result_approval->approvalID->ExportValue($term_result_approval->Export, $term_result_approval->ExportOriginalValue));
					$XmlDoc->AddField('sessionTermID', $term_result_approval->sessionTermID->ExportValue($term_result_approval->Export, $term_result_approval->ExportOriginalValue));
					$XmlDoc->AddField('status', $term_result_approval->status->ExportValue($term_result_approval->Export, $term_result_approval->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($term_result_approval->approvalID);
					$ExportDoc->ExportField($term_result_approval->sessionTermID);
					$ExportDoc->ExportField($term_result_approval->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($term_result_approval->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($term_result_approval->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($term_result_approval->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($term_result_approval->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($term_result_approval->ExportReturnUrl());
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
