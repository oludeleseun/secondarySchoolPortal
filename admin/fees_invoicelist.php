<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "fees_invoiceinfo.php" ?>
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
$fees_invoice_list = new cfees_invoice_list();
$Page =& $fees_invoice_list;

// Page init
$fees_invoice_list->Page_Init();

// Page main
$fees_invoice_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($fees_invoice->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var fees_invoice_list = new ew_Page("fees_invoice_list");

// page properties
fees_invoice_list.PageID = "list"; // page ID
fees_invoice_list.FormID = "ffees_invoicelist"; // form ID
var EW_PAGE_ID = fees_invoice_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
fees_invoice_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
fees_invoice_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
fees_invoice_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
fees_invoice_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($fees_invoice->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$fees_invoice_list->lTotalRecs = $fees_invoice->SelectRecordCount();
	} else {
		if ($rs = $fees_invoice_list->LoadRecordset())
			$fees_invoice_list->lTotalRecs = $rs->RecordCount();
	}
	$fees_invoice_list->lStartRec = 1;
	if ($fees_invoice_list->lDisplayRecs <= 0 || ($fees_invoice->Export <> "" && $fees_invoice->ExportAll)) // Display all records
		$fees_invoice_list->lDisplayRecs = $fees_invoice_list->lTotalRecs;
	if (!($fees_invoice->Export <> "" && $fees_invoice->ExportAll))
		$fees_invoice_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $fees_invoice_list->LoadRecordset($fees_invoice_list->lStartRec-1, $fees_invoice_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $fees_invoice->TableCaption() ?>
<?php if ($fees_invoice->Export == "" && $fees_invoice->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.ffees_invoicelist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.ffees_invoicelist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.ffees_invoicelist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.ffees_invoicelist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$fees_invoice_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="ffees_invoicelist" id="ffees_invoicelist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_fees_invoice" class="ewGridMiddlePanel">
<?php if ($fees_invoice_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $fees_invoice->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$fees_invoice_list->RenderListOptions();

// Render list options (header, left)
$fees_invoice_list->ListOptions->Render("header", "left");
?>
<?php if ($fees_invoice->invoiceID->Visible) { // invoiceID ?>
	<?php if ($fees_invoice->SortUrl($fees_invoice->invoiceID) == "") { ?>
		<td><?php echo $fees_invoice->invoiceID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $fees_invoice->SortUrl($fees_invoice->invoiceID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $fees_invoice->invoiceID->FldCaption() ?></td><td style="width: 10px;"><?php if ($fees_invoice->invoiceID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($fees_invoice->invoiceID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($fees_invoice->sessionID->Visible) { // sessionID ?>
	<?php if ($fees_invoice->SortUrl($fees_invoice->sessionID) == "") { ?>
		<td><?php echo $fees_invoice->sessionID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $fees_invoice->SortUrl($fees_invoice->sessionID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $fees_invoice->sessionID->FldCaption() ?></td><td style="width: 10px;"><?php if ($fees_invoice->sessionID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($fees_invoice->sessionID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($fees_invoice->amount->Visible) { // amount ?>
	<?php if ($fees_invoice->SortUrl($fees_invoice->amount) == "") { ?>
		<td><?php echo $fees_invoice->amount->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $fees_invoice->SortUrl($fees_invoice->amount) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $fees_invoice->amount->FldCaption() ?></td><td style="width: 10px;"><?php if ($fees_invoice->amount->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($fees_invoice->amount->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($fees_invoice->studentID->Visible) { // studentID ?>
	<?php if ($fees_invoice->SortUrl($fees_invoice->studentID) == "") { ?>
		<td><?php echo $fees_invoice->studentID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $fees_invoice->SortUrl($fees_invoice->studentID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $fees_invoice->studentID->FldCaption() ?></td><td style="width: 10px;"><?php if ($fees_invoice->studentID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($fees_invoice->studentID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($fees_invoice->dateGenerated->Visible) { // dateGenerated ?>
	<?php if ($fees_invoice->SortUrl($fees_invoice->dateGenerated) == "") { ?>
		<td><?php echo $fees_invoice->dateGenerated->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $fees_invoice->SortUrl($fees_invoice->dateGenerated) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $fees_invoice->dateGenerated->FldCaption() ?></td><td style="width: 10px;"><?php if ($fees_invoice->dateGenerated->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($fees_invoice->dateGenerated->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$fees_invoice_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($fees_invoice->ExportAll && $fees_invoice->Export <> "") {
	$fees_invoice_list->lStopRec = $fees_invoice_list->lTotalRecs;
} else {
	$fees_invoice_list->lStopRec = $fees_invoice_list->lStartRec + $fees_invoice_list->lDisplayRecs - 1; // Set the last record to display
}
$fees_invoice_list->lRecCount = $fees_invoice_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $fees_invoice_list->lStartRec > 1)
		$rs->Move($fees_invoice_list->lStartRec - 1);
}

// Initialize aggregate
$fees_invoice->RowType = EW_ROWTYPE_AGGREGATEINIT;
$fees_invoice_list->RenderRow();
$fees_invoice_list->lRowCnt = 0;
while (($fees_invoice->CurrentAction == "gridadd" || !$rs->EOF) &&
	$fees_invoice_list->lRecCount < $fees_invoice_list->lStopRec) {
	$fees_invoice_list->lRecCount++;
	if (intval($fees_invoice_list->lRecCount) >= intval($fees_invoice_list->lStartRec)) {
		$fees_invoice_list->lRowCnt++;

	// Init row class and style
	$fees_invoice->CssClass = "";
	$fees_invoice->CssStyle = "";
	$fees_invoice->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($fees_invoice->CurrentAction == "gridadd") {
		$fees_invoice_list->LoadDefaultValues(); // Load default values
	} else {
		$fees_invoice_list->LoadRowValues($rs); // Load row values
	}
	$fees_invoice->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$fees_invoice_list->RenderRow();

	// Render list options
	$fees_invoice_list->RenderListOptions();
?>
	<tr<?php echo $fees_invoice->RowAttributes() ?>>
<?php

// Render list options (body, left)
$fees_invoice_list->ListOptions->Render("body", "left");
?>
	<?php if ($fees_invoice->invoiceID->Visible) { // invoiceID ?>
		<td<?php echo $fees_invoice->invoiceID->CellAttributes() ?>>
<div<?php echo $fees_invoice->invoiceID->ViewAttributes() ?>><?php echo $fees_invoice->invoiceID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($fees_invoice->sessionID->Visible) { // sessionID ?>
		<td<?php echo $fees_invoice->sessionID->CellAttributes() ?>>
<div<?php echo $fees_invoice->sessionID->ViewAttributes() ?>><?php echo $fees_invoice->sessionID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($fees_invoice->amount->Visible) { // amount ?>
		<td<?php echo $fees_invoice->amount->CellAttributes() ?>>
<div<?php echo $fees_invoice->amount->ViewAttributes() ?>><?php echo $fees_invoice->amount->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($fees_invoice->studentID->Visible) { // studentID ?>
		<td<?php echo $fees_invoice->studentID->CellAttributes() ?>>
<div<?php echo $fees_invoice->studentID->ViewAttributes() ?>><?php echo $fees_invoice->studentID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($fees_invoice->dateGenerated->Visible) { // dateGenerated ?>
		<td<?php echo $fees_invoice->dateGenerated->CellAttributes() ?>>
<div<?php echo $fees_invoice->dateGenerated->ViewAttributes() ?>><?php echo $fees_invoice->dateGenerated->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$fees_invoice_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($fees_invoice->CurrentAction <> "gridadd")
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
<?php if ($fees_invoice->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($fees_invoice->CurrentAction <> "gridadd" && $fees_invoice->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($fees_invoice_list->Pager)) $fees_invoice_list->Pager = new cPrevNextPager($fees_invoice_list->lStartRec, $fees_invoice_list->lDisplayRecs, $fees_invoice_list->lTotalRecs) ?>
<?php if ($fees_invoice_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($fees_invoice_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $fees_invoice_list->PageUrl() ?>start=<?php echo $fees_invoice_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($fees_invoice_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $fees_invoice_list->PageUrl() ?>start=<?php echo $fees_invoice_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $fees_invoice_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($fees_invoice_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $fees_invoice_list->PageUrl() ?>start=<?php echo $fees_invoice_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($fees_invoice_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $fees_invoice_list->PageUrl() ?>start=<?php echo $fees_invoice_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $fees_invoice_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $fees_invoice_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $fees_invoice_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $fees_invoice_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($fees_invoice_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($fees_invoice_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $fees_invoice_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($fees_invoice->Export == "" && $fees_invoice->CurrentAction == "") { ?>
<?php } ?>
<?php if ($fees_invoice->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$fees_invoice_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cfees_invoice_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'fees_invoice';

	// Page object name
	var $PageObjName = 'fees_invoice_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $fees_invoice;
		if ($fees_invoice->UseTokenInUrl) $PageUrl .= "t=" . $fees_invoice->TableVar . "&"; // Add page token
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
		global $objForm, $fees_invoice;
		if ($fees_invoice->UseTokenInUrl) {
			if ($objForm)
				return ($fees_invoice->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($fees_invoice->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfees_invoice_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (fees_invoice)
		$GLOBALS["fees_invoice"] = new cfees_invoice();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["fees_invoice"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "fees_invoicedelete.php";
		$this->MultiUpdateUrl = "fees_invoiceupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'fees_invoice', TRUE);

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
		global $fees_invoice;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$fees_invoice->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$fees_invoice->Export = $_POST["exporttype"];
		} else {
			$fees_invoice->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $fees_invoice->Export; // Get export parameter, used in header
		$gsExportFile = $fees_invoice->TableVar; // Get export file, used in header
		if ($fees_invoice->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($fees_invoice->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($fees_invoice->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $fees_invoice;

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
		if ($fees_invoice->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $fees_invoice->getRecordsPerPage(); // Restore from Session
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
		$fees_invoice->setSessionWhere($sFilter);
		$fees_invoice->CurrentFilter = "";

		// Export selected records
		if ($fees_invoice->Export <> "")
			$fees_invoice->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($fees_invoice->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($fees_invoice->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $fees_invoice;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$fees_invoice->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$fees_invoice->CurrentOrderType = @$_GET["ordertype"];
			$fees_invoice->UpdateSort($fees_invoice->invoiceID); // invoiceID
			$fees_invoice->UpdateSort($fees_invoice->sessionID); // sessionID
			$fees_invoice->UpdateSort($fees_invoice->amount); // amount
			$fees_invoice->UpdateSort($fees_invoice->studentID); // studentID
			$fees_invoice->UpdateSort($fees_invoice->dateGenerated); // dateGenerated
			$fees_invoice->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $fees_invoice;
		$sOrderBy = $fees_invoice->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($fees_invoice->SqlOrderBy() <> "") {
				$sOrderBy = $fees_invoice->SqlOrderBy();
				$fees_invoice->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $fees_invoice;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$fees_invoice->setSessionOrderBy($sOrderBy);
				$fees_invoice->invoiceID->setSort("");
				$fees_invoice->sessionID->setSort("");
				$fees_invoice->amount->setSort("");
				$fees_invoice->studentID->setSort("");
				$fees_invoice->dateGenerated->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$fees_invoice->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $fees_invoice;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"fees_invoice_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($fees_invoice->Export <> "" ||
			$fees_invoice->CurrentAction == "gridadd" ||
			$fees_invoice->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $fees_invoice;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($fees_invoice->invoiceID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $fees_invoice;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $fees_invoice;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$fees_invoice->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$fees_invoice->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $fees_invoice->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$fees_invoice->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$fees_invoice->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$fees_invoice->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $fees_invoice;

		// Call Recordset Selecting event
		$fees_invoice->Recordset_Selecting($fees_invoice->CurrentFilter);

		// Load List page SQL
		$sSql = $fees_invoice->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$fees_invoice->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $fees_invoice;
		$sFilter = $fees_invoice->KeyFilter();

		// Call Row Selecting event
		$fees_invoice->Row_Selecting($sFilter);

		// Load SQL based on filter
		$fees_invoice->CurrentFilter = $sFilter;
		$sSql = $fees_invoice->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$fees_invoice->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $fees_invoice;
		$fees_invoice->invoiceID->setDbValue($rs->fields('invoiceID'));
		$fees_invoice->sessionID->setDbValue($rs->fields('sessionID'));
		$fees_invoice->amount->setDbValue($rs->fields('amount'));
		$fees_invoice->studentID->setDbValue($rs->fields('studentID'));
		$fees_invoice->dateGenerated->setDbValue($rs->fields('dateGenerated'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $fees_invoice;

		// Initialize URLs
		$this->ViewUrl = $fees_invoice->ViewUrl();
		$this->EditUrl = $fees_invoice->EditUrl();
		$this->InlineEditUrl = $fees_invoice->InlineEditUrl();
		$this->CopyUrl = $fees_invoice->CopyUrl();
		$this->InlineCopyUrl = $fees_invoice->InlineCopyUrl();
		$this->DeleteUrl = $fees_invoice->DeleteUrl();

		// Call Row_Rendering event
		$fees_invoice->Row_Rendering();

		// Common render codes for all row types
		// invoiceID

		$fees_invoice->invoiceID->CellCssStyle = ""; $fees_invoice->invoiceID->CellCssClass = "";
		$fees_invoice->invoiceID->CellAttrs = array(); $fees_invoice->invoiceID->ViewAttrs = array(); $fees_invoice->invoiceID->EditAttrs = array();

		// sessionID
		$fees_invoice->sessionID->CellCssStyle = ""; $fees_invoice->sessionID->CellCssClass = "";
		$fees_invoice->sessionID->CellAttrs = array(); $fees_invoice->sessionID->ViewAttrs = array(); $fees_invoice->sessionID->EditAttrs = array();

		// amount
		$fees_invoice->amount->CellCssStyle = ""; $fees_invoice->amount->CellCssClass = "";
		$fees_invoice->amount->CellAttrs = array(); $fees_invoice->amount->ViewAttrs = array(); $fees_invoice->amount->EditAttrs = array();

		// studentID
		$fees_invoice->studentID->CellCssStyle = ""; $fees_invoice->studentID->CellCssClass = "";
		$fees_invoice->studentID->CellAttrs = array(); $fees_invoice->studentID->ViewAttrs = array(); $fees_invoice->studentID->EditAttrs = array();

		// dateGenerated
		$fees_invoice->dateGenerated->CellCssStyle = ""; $fees_invoice->dateGenerated->CellCssClass = "";
		$fees_invoice->dateGenerated->CellAttrs = array(); $fees_invoice->dateGenerated->ViewAttrs = array(); $fees_invoice->dateGenerated->EditAttrs = array();
		if ($fees_invoice->RowType == EW_ROWTYPE_VIEW) { // View row

			// invoiceID
			$fees_invoice->invoiceID->ViewValue = $fees_invoice->invoiceID->CurrentValue;
			$fees_invoice->invoiceID->CssStyle = "";
			$fees_invoice->invoiceID->CssClass = "";
			$fees_invoice->invoiceID->ViewCustomAttributes = "";

			// sessionID
			if (strval($fees_invoice->sessionID->CurrentValue) <> "") {
				$sFilterWrk = "`sessionID` = " . ew_AdjustSql($fees_invoice->sessionID->CurrentValue) . "";
			$sSqlWrk = "SELECT `sessionName` FROM `academic_sessions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `sessionName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$fees_invoice->sessionID->ViewValue = $rswrk->fields('sessionName');
					$rswrk->Close();
				} else {
					$fees_invoice->sessionID->ViewValue = $fees_invoice->sessionID->CurrentValue;
				}
			} else {
				$fees_invoice->sessionID->ViewValue = NULL;
			}
			$fees_invoice->sessionID->CssStyle = "";
			$fees_invoice->sessionID->CssClass = "";
			$fees_invoice->sessionID->ViewCustomAttributes = "";

			// amount
			$fees_invoice->amount->ViewValue = $fees_invoice->amount->CurrentValue;
			$fees_invoice->amount->CssStyle = "";
			$fees_invoice->amount->CssClass = "";
			$fees_invoice->amount->ViewCustomAttributes = "";

			// studentID
			if (strval($fees_invoice->studentID->CurrentValue) <> "") {
				$sFilterWrk = "`studentID` = " . ew_AdjustSql($fees_invoice->studentID->CurrentValue) . "";
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
					$fees_invoice->studentID->ViewValue = $rswrk->fields('firstname');
					$fees_invoice->studentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$fees_invoice->studentID->ViewValue = $fees_invoice->studentID->CurrentValue;
				}
			} else {
				$fees_invoice->studentID->ViewValue = NULL;
			}
			$fees_invoice->studentID->CssStyle = "";
			$fees_invoice->studentID->CssClass = "";
			$fees_invoice->studentID->ViewCustomAttributes = "";

			// dateGenerated
			$fees_invoice->dateGenerated->ViewValue = $fees_invoice->dateGenerated->CurrentValue;
			$fees_invoice->dateGenerated->ViewValue = ew_FormatDateTime($fees_invoice->dateGenerated->ViewValue, 5);
			$fees_invoice->dateGenerated->CssStyle = "";
			$fees_invoice->dateGenerated->CssClass = "";
			$fees_invoice->dateGenerated->ViewCustomAttributes = "";

			// invoiceID
			$fees_invoice->invoiceID->HrefValue = "";
			$fees_invoice->invoiceID->TooltipValue = "";

			// sessionID
			$fees_invoice->sessionID->HrefValue = "";
			$fees_invoice->sessionID->TooltipValue = "";

			// amount
			$fees_invoice->amount->HrefValue = "";
			$fees_invoice->amount->TooltipValue = "";

			// studentID
			$fees_invoice->studentID->HrefValue = "";
			$fees_invoice->studentID->TooltipValue = "";

			// dateGenerated
			$fees_invoice->dateGenerated->HrefValue = "";
			$fees_invoice->dateGenerated->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($fees_invoice->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$fees_invoice->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $fees_invoice;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($fees_invoice->Export <> "") {
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
				$fees_invoice->invoiceID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $fees_invoice->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $fees_invoice;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $fees_invoice->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($fees_invoice->ExportAll) {
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
		if ($fees_invoice->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($fees_invoice, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($fees_invoice->invoiceID);
				$ExportDoc->ExportCaption($fees_invoice->sessionID);
				$ExportDoc->ExportCaption($fees_invoice->amount);
				$ExportDoc->ExportCaption($fees_invoice->studentID);
				$ExportDoc->ExportCaption($fees_invoice->dateGenerated);
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
				$fees_invoice->CssClass = "";
				$fees_invoice->CssStyle = "";
				$fees_invoice->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($fees_invoice->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('invoiceID', $fees_invoice->invoiceID->ExportValue($fees_invoice->Export, $fees_invoice->ExportOriginalValue));
					$XmlDoc->AddField('sessionID', $fees_invoice->sessionID->ExportValue($fees_invoice->Export, $fees_invoice->ExportOriginalValue));
					$XmlDoc->AddField('amount', $fees_invoice->amount->ExportValue($fees_invoice->Export, $fees_invoice->ExportOriginalValue));
					$XmlDoc->AddField('studentID', $fees_invoice->studentID->ExportValue($fees_invoice->Export, $fees_invoice->ExportOriginalValue));
					$XmlDoc->AddField('dateGenerated', $fees_invoice->dateGenerated->ExportValue($fees_invoice->Export, $fees_invoice->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($fees_invoice->invoiceID);
					$ExportDoc->ExportField($fees_invoice->sessionID);
					$ExportDoc->ExportField($fees_invoice->amount);
					$ExportDoc->ExportField($fees_invoice->studentID);
					$ExportDoc->ExportField($fees_invoice->dateGenerated);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($fees_invoice->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($fees_invoice->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($fees_invoice->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($fees_invoice->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($fees_invoice->ExportReturnUrl());
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
