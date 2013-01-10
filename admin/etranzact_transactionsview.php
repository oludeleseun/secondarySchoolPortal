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
$etranzact_transactions_view = new cetranzact_transactions_view();
$Page =& $etranzact_transactions_view;

// Page init
$etranzact_transactions_view->Page_Init();

// Page main
$etranzact_transactions_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($etranzact_transactions->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var etranzact_transactions_view = new ew_Page("etranzact_transactions_view");

// page properties
etranzact_transactions_view.PageID = "view"; // page ID
etranzact_transactions_view.FormID = "fetranzact_transactionsview"; // form ID
var EW_PAGE_ID = etranzact_transactions_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
etranzact_transactions_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
etranzact_transactions_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
etranzact_transactions_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
etranzact_transactions_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $etranzact_transactions->TableCaption() ?>
<?php if ($etranzact_transactions->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $etranzact_transactions_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $etranzact_transactions_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $etranzact_transactions_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $etranzact_transactions_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($etranzact_transactions->Export == "") { ?>
<a href="<?php echo $etranzact_transactions_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $etranzact_transactions_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $etranzact_transactions_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $etranzact_transactions_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $etranzact_transactions_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$etranzact_transactions_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($etranzact_transactions->transactionID->Visible) { // transactionID ?>
	<tr<?php echo $etranzact_transactions->transactionID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->transactionID->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->transactionID->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionID->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($etranzact_transactions->studentID->Visible) { // studentID ?>
	<tr<?php echo $etranzact_transactions->studentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->studentID->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->studentID->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->studentID->ViewAttributes() ?>><?php echo $etranzact_transactions->studentID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($etranzact_transactions->transactionAmount->Visible) { // transactionAmount ?>
	<tr<?php echo $etranzact_transactions->transactionAmount->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->transactionAmount->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->transactionAmount->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionAmount->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionAmount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($etranzact_transactions->confirmationNumber->Visible) { // confirmationNumber ?>
	<tr<?php echo $etranzact_transactions->confirmationNumber->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->confirmationNumber->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->confirmationNumber->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->confirmationNumber->ViewAttributes() ?>><?php echo $etranzact_transactions->confirmationNumber->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($etranzact_transactions->receiptNumber->Visible) { // receiptNumber ?>
	<tr<?php echo $etranzact_transactions->receiptNumber->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->receiptNumber->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->receiptNumber->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->receiptNumber->ViewAttributes() ?>><?php echo $etranzact_transactions->receiptNumber->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($etranzact_transactions->transactionNumber->Visible) { // transactionNumber ?>
	<tr<?php echo $etranzact_transactions->transactionNumber->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->transactionNumber->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->transactionNumber->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionNumber->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionNumber->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($etranzact_transactions->transactionDate->Visible) { // transactionDate ?>
	<tr<?php echo $etranzact_transactions->transactionDate->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->transactionDate->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->transactionDate->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionDate->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionDate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($etranzact_transactions->dateLogged->Visible) { // dateLogged ?>
	<tr<?php echo $etranzact_transactions->dateLogged->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->dateLogged->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->dateLogged->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->dateLogged->ViewAttributes() ?>><?php echo $etranzact_transactions->dateLogged->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($etranzact_transactions->transactionReference->Visible) { // transactionReference ?>
	<tr<?php echo $etranzact_transactions->transactionReference->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->transactionReference->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->transactionReference->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionReference->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionReference->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($etranzact_transactions->status->Visible) { // status ?>
	<tr<?php echo $etranzact_transactions->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $etranzact_transactions->status->FldCaption() ?></td>
		<td<?php echo $etranzact_transactions->status->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->status->ViewAttributes() ?>><?php echo $etranzact_transactions->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$etranzact_transactions_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cetranzact_transactions_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'etranzact_transactions';

	// Page object name
	var $PageObjName = 'etranzact_transactions_view';

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
	function cetranzact_transactions_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (etranzact_transactions)
		$GLOBALS["etranzact_transactions"] = new cetranzact_transactions();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'etranzact_transactions', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
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
		if (@$_GET["transactionID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["transactionID"]);
		}
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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $etranzact_transactions;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["transactionID"] <> "") {
				$etranzact_transactions->transactionID->setQueryStringValue($_GET["transactionID"]);
				$this->arRecKey["transactionID"] = $etranzact_transactions->transactionID->QueryStringValue;
			} else {
				$sReturnUrl = "etranzact_transactionslist.php"; // Return to list
			}

			// Get action
			$etranzact_transactions->CurrentAction = "I"; // Display form
			switch ($etranzact_transactions->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "etranzact_transactionslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($etranzact_transactions->Export, array("html","word","excel","xml","csv","email"))) {
				if ($etranzact_transactions->Export == "email" && $etranzact_transactions->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$etranzact_transactions->setExportReturnUrl($etranzact_transactions->ViewUrl()); // Add key
				$this->ExportData();
				if ($etranzact_transactions->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "etranzact_transactionslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$etranzact_transactions->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "transactionID=" . urlencode($etranzact_transactions->transactionID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "transactionID=" . urlencode($etranzact_transactions->transactionID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "transactionID=" . urlencode($etranzact_transactions->transactionID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "transactionID=" . urlencode($etranzact_transactions->transactionID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "transactionID=" . urlencode($etranzact_transactions->transactionID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "transactionID=" . urlencode($etranzact_transactions->transactionID->CurrentValue);
		$this->AddUrl = $etranzact_transactions->AddUrl();
		$this->EditUrl = $etranzact_transactions->EditUrl();
		$this->CopyUrl = $etranzact_transactions->CopyUrl();
		$this->DeleteUrl = $etranzact_transactions->DeleteUrl();
		$this->ListUrl = $etranzact_transactions->ListUrl();

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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $etranzact_transactions;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $etranzact_transactions->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;
		$this->SetUpStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->lDisplayRecs < 0) {
			$this->lStopRec = $this->lTotalRecs;
		} else {
			$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
		}
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
			$ExportDoc = new cExportDocument($etranzact_transactions, "v");
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
}
?>
