<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_termsinfo.php" ?>
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
$academic_terms_view = new cacademic_terms_view();
$Page =& $academic_terms_view;

// Page init
$academic_terms_view->Page_Init();

// Page main
$academic_terms_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($academic_terms->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var academic_terms_view = new ew_Page("academic_terms_view");

// page properties
academic_terms_view.PageID = "view"; // page ID
academic_terms_view.FormID = "facademic_termsview"; // form ID
var EW_PAGE_ID = academic_terms_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
academic_terms_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
academic_terms_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_terms_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_terms_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_terms->TableCaption() ?>
<?php if ($academic_terms->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $academic_terms_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $academic_terms_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $academic_terms_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $academic_terms_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($academic_terms->Export == "") { ?>
<a href="<?php echo $academic_terms_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_terms_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_terms_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_terms_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_terms_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_terms_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($academic_terms->termID->Visible) { // termID ?>
	<tr<?php echo $academic_terms->termID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_terms->termID->FldCaption() ?></td>
		<td<?php echo $academic_terms->termID->CellAttributes() ?>>
<div<?php echo $academic_terms->termID->ViewAttributes() ?>><?php echo $academic_terms->termID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($academic_terms->termName->Visible) { // termName ?>
	<tr<?php echo $academic_terms->termName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_terms->termName->FldCaption() ?></td>
		<td<?php echo $academic_terms->termName->CellAttributes() ?>>
<div<?php echo $academic_terms->termName->ViewAttributes() ?>><?php echo $academic_terms->termName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($academic_terms->status->Visible) { // status ?>
	<tr<?php echo $academic_terms->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_terms->status->FldCaption() ?></td>
		<td<?php echo $academic_terms->status->CellAttributes() ?>>
<div<?php echo $academic_terms->status->ViewAttributes() ?>><?php echo $academic_terms->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($academic_terms->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$academic_terms_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_terms_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'academic_terms';

	// Page object name
	var $PageObjName = 'academic_terms_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_terms;
		if ($academic_terms->UseTokenInUrl) $PageUrl .= "t=" . $academic_terms->TableVar . "&"; // Add page token
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
		global $objForm, $academic_terms;
		if ($academic_terms->UseTokenInUrl) {
			if ($objForm)
				return ($academic_terms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_terms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_terms_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_terms)
		$GLOBALS["academic_terms"] = new cacademic_terms();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_terms', TRUE);

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
		global $academic_terms;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$academic_terms->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$academic_terms->Export = $_POST["exporttype"];
		} else {
			$academic_terms->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $academic_terms->Export; // Get export parameter, used in header
		$gsExportFile = $academic_terms->TableVar; // Get export file, used in header
		if (@$_GET["termID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["termID"]);
		}
		if ($academic_terms->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($academic_terms->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($academic_terms->Export == "csv") {
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
		global $Language, $academic_terms;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["termID"] <> "") {
				$academic_terms->termID->setQueryStringValue($_GET["termID"]);
				$this->arRecKey["termID"] = $academic_terms->termID->QueryStringValue;
			} else {
				$sReturnUrl = "academic_termslist.php"; // Return to list
			}

			// Get action
			$academic_terms->CurrentAction = "I"; // Display form
			switch ($academic_terms->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "academic_termslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($academic_terms->Export, array("html","word","excel","xml","csv","email"))) {
				if ($academic_terms->Export == "email" && $academic_terms->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$academic_terms->setExportReturnUrl($academic_terms->ViewUrl()); // Add key
				$this->ExportData();
				if ($academic_terms->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "academic_termslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$academic_terms->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $academic_terms;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$academic_terms->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$academic_terms->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $academic_terms->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$academic_terms->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$academic_terms->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$academic_terms->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $academic_terms;

		// Call Recordset Selecting event
		$academic_terms->Recordset_Selecting($academic_terms->CurrentFilter);

		// Load List page SQL
		$sSql = $academic_terms->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$academic_terms->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_terms;
		$sFilter = $academic_terms->KeyFilter();

		// Call Row Selecting event
		$academic_terms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_terms->CurrentFilter = $sFilter;
		$sSql = $academic_terms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_terms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_terms;
		$academic_terms->termID->setDbValue($rs->fields('termID'));
		$academic_terms->termName->setDbValue($rs->fields('termName'));
		$academic_terms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_terms;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "termID=" . urlencode($academic_terms->termID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "termID=" . urlencode($academic_terms->termID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "termID=" . urlencode($academic_terms->termID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "termID=" . urlencode($academic_terms->termID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "termID=" . urlencode($academic_terms->termID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "termID=" . urlencode($academic_terms->termID->CurrentValue);
		$this->AddUrl = $academic_terms->AddUrl();
		$this->EditUrl = $academic_terms->EditUrl();
		$this->CopyUrl = $academic_terms->CopyUrl();
		$this->DeleteUrl = $academic_terms->DeleteUrl();
		$this->ListUrl = $academic_terms->ListUrl();

		// Call Row_Rendering event
		$academic_terms->Row_Rendering();

		// Common render codes for all row types
		// termID

		$academic_terms->termID->CellCssStyle = ""; $academic_terms->termID->CellCssClass = "";
		$academic_terms->termID->CellAttrs = array(); $academic_terms->termID->ViewAttrs = array(); $academic_terms->termID->EditAttrs = array();

		// termName
		$academic_terms->termName->CellCssStyle = ""; $academic_terms->termName->CellCssClass = "";
		$academic_terms->termName->CellAttrs = array(); $academic_terms->termName->ViewAttrs = array(); $academic_terms->termName->EditAttrs = array();

		// status
		$academic_terms->status->CellCssStyle = ""; $academic_terms->status->CellCssClass = "";
		$academic_terms->status->CellAttrs = array(); $academic_terms->status->ViewAttrs = array(); $academic_terms->status->EditAttrs = array();
		if ($academic_terms->RowType == EW_ROWTYPE_VIEW) { // View row

			// termID
			$academic_terms->termID->ViewValue = $academic_terms->termID->CurrentValue;
			$academic_terms->termID->CssStyle = "";
			$academic_terms->termID->CssClass = "";
			$academic_terms->termID->ViewCustomAttributes = "";

			// termName
			$academic_terms->termName->ViewValue = $academic_terms->termName->CurrentValue;
			$academic_terms->termName->CssStyle = "";
			$academic_terms->termName->CssClass = "";
			$academic_terms->termName->ViewCustomAttributes = "";

			// status
			if (strval($academic_terms->status->CurrentValue) <> "") {
				switch ($academic_terms->status->CurrentValue) {
					case "1":
						$academic_terms->status->ViewValue = "Enabled";
						break;
					case "0":
						$academic_terms->status->ViewValue = "Disabled";
						break;
					default:
						$academic_terms->status->ViewValue = $academic_terms->status->CurrentValue;
				}
			} else {
				$academic_terms->status->ViewValue = NULL;
			}
			$academic_terms->status->CssStyle = "";
			$academic_terms->status->CssClass = "";
			$academic_terms->status->ViewCustomAttributes = "";

			// termID
			$academic_terms->termID->HrefValue = "";
			$academic_terms->termID->TooltipValue = "";

			// termName
			$academic_terms->termName->HrefValue = "";
			$academic_terms->termName->TooltipValue = "";

			// status
			$academic_terms->status->HrefValue = "";
			$academic_terms->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($academic_terms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_terms->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $academic_terms;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $academic_terms->SelectRecordCount();
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
		if ($academic_terms->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($academic_terms, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($academic_terms->termID);
				$ExportDoc->ExportCaption($academic_terms->termName);
				$ExportDoc->ExportCaption($academic_terms->status);
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
				$academic_terms->CssClass = "";
				$academic_terms->CssStyle = "";
				$academic_terms->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($academic_terms->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('termID', $academic_terms->termID->ExportValue($academic_terms->Export, $academic_terms->ExportOriginalValue));
					$XmlDoc->AddField('termName', $academic_terms->termName->ExportValue($academic_terms->Export, $academic_terms->ExportOriginalValue));
					$XmlDoc->AddField('status', $academic_terms->status->ExportValue($academic_terms->Export, $academic_terms->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($academic_terms->termID);
					$ExportDoc->ExportField($academic_terms->termName);
					$ExportDoc->ExportField($academic_terms->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($academic_terms->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($academic_terms->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($academic_terms->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($academic_terms->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($academic_terms->ExportReturnUrl());
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
