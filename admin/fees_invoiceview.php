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
$fees_invoice_view = new cfees_invoice_view();
$Page =& $fees_invoice_view;

// Page init
$fees_invoice_view->Page_Init();

// Page main
$fees_invoice_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($fees_invoice->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var fees_invoice_view = new ew_Page("fees_invoice_view");

// page properties
fees_invoice_view.PageID = "view"; // page ID
fees_invoice_view.FormID = "ffees_invoiceview"; // form ID
var EW_PAGE_ID = fees_invoice_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
fees_invoice_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
fees_invoice_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
fees_invoice_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
fees_invoice_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $fees_invoice->TableCaption() ?>
<?php if ($fees_invoice->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $fees_invoice_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $fees_invoice_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $fees_invoice_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $fees_invoice_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($fees_invoice->Export == "") { ?>
<a href="<?php echo $fees_invoice_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $fees_invoice_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $fees_invoice_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $fees_invoice_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $fees_invoice_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$fees_invoice_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($fees_invoice->invoiceID->Visible) { // invoiceID ?>
	<tr<?php echo $fees_invoice->invoiceID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $fees_invoice->invoiceID->FldCaption() ?></td>
		<td<?php echo $fees_invoice->invoiceID->CellAttributes() ?>>
<div<?php echo $fees_invoice->invoiceID->ViewAttributes() ?>><?php echo $fees_invoice->invoiceID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($fees_invoice->sessionID->Visible) { // sessionID ?>
	<tr<?php echo $fees_invoice->sessionID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $fees_invoice->sessionID->FldCaption() ?></td>
		<td<?php echo $fees_invoice->sessionID->CellAttributes() ?>>
<div<?php echo $fees_invoice->sessionID->ViewAttributes() ?>><?php echo $fees_invoice->sessionID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($fees_invoice->amount->Visible) { // amount ?>
	<tr<?php echo $fees_invoice->amount->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $fees_invoice->amount->FldCaption() ?></td>
		<td<?php echo $fees_invoice->amount->CellAttributes() ?>>
<div<?php echo $fees_invoice->amount->ViewAttributes() ?>><?php echo $fees_invoice->amount->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($fees_invoice->studentID->Visible) { // studentID ?>
	<tr<?php echo $fees_invoice->studentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $fees_invoice->studentID->FldCaption() ?></td>
		<td<?php echo $fees_invoice->studentID->CellAttributes() ?>>
<div<?php echo $fees_invoice->studentID->ViewAttributes() ?>><?php echo $fees_invoice->studentID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($fees_invoice->dateGenerated->Visible) { // dateGenerated ?>
	<tr<?php echo $fees_invoice->dateGenerated->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $fees_invoice->dateGenerated->FldCaption() ?></td>
		<td<?php echo $fees_invoice->dateGenerated->CellAttributes() ?>>
<div<?php echo $fees_invoice->dateGenerated->ViewAttributes() ?>><?php echo $fees_invoice->dateGenerated->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$fees_invoice_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cfees_invoice_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'fees_invoice';

	// Page object name
	var $PageObjName = 'fees_invoice_view';

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
	function cfees_invoice_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (fees_invoice)
		$GLOBALS["fees_invoice"] = new cfees_invoice();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'fees_invoice', TRUE);

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
		if (@$_GET["invoiceID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["invoiceID"]);
		}
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
		global $Language, $fees_invoice;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["invoiceID"] <> "") {
				$fees_invoice->invoiceID->setQueryStringValue($_GET["invoiceID"]);
				$this->arRecKey["invoiceID"] = $fees_invoice->invoiceID->QueryStringValue;
			} else {
				$sReturnUrl = "fees_invoicelist.php"; // Return to list
			}

			// Get action
			$fees_invoice->CurrentAction = "I"; // Display form
			switch ($fees_invoice->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "fees_invoicelist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($fees_invoice->Export, array("html","word","excel","xml","csv","email"))) {
				if ($fees_invoice->Export == "email" && $fees_invoice->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$fees_invoice->setExportReturnUrl($fees_invoice->ViewUrl()); // Add key
				$this->ExportData();
				if ($fees_invoice->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "fees_invoicelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$fees_invoice->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "invoiceID=" . urlencode($fees_invoice->invoiceID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "invoiceID=" . urlencode($fees_invoice->invoiceID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "invoiceID=" . urlencode($fees_invoice->invoiceID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "invoiceID=" . urlencode($fees_invoice->invoiceID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "invoiceID=" . urlencode($fees_invoice->invoiceID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "invoiceID=" . urlencode($fees_invoice->invoiceID->CurrentValue);
		$this->AddUrl = $fees_invoice->AddUrl();
		$this->EditUrl = $fees_invoice->EditUrl();
		$this->CopyUrl = $fees_invoice->CopyUrl();
		$this->DeleteUrl = $fees_invoice->DeleteUrl();
		$this->ListUrl = $fees_invoice->ListUrl();

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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $fees_invoice;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $fees_invoice->SelectRecordCount();
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
		if ($fees_invoice->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($fees_invoice, "v");
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
}
?>
