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
$academic_sessions_view = new cacademic_sessions_view();
$Page =& $academic_sessions_view;

// Page init
$academic_sessions_view->Page_Init();

// Page main
$academic_sessions_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($academic_sessions->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var academic_sessions_view = new ew_Page("academic_sessions_view");

// page properties
academic_sessions_view.PageID = "view"; // page ID
academic_sessions_view.FormID = "facademic_sessionsview"; // form ID
var EW_PAGE_ID = academic_sessions_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
academic_sessions_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
academic_sessions_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_sessions_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_sessions_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_sessions->TableCaption() ?>
<?php if ($academic_sessions->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $academic_sessions_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $academic_sessions_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $academic_sessions_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $academic_sessions_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($academic_sessions->Export == "") { ?>
<a href="<?php echo $academic_sessions_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_sessions_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_sessions_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_sessions_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_sessions_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_sessions_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($academic_sessions->sessionID->Visible) { // sessionID ?>
	<tr<?php echo $academic_sessions->sessionID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->sessionID->FldCaption() ?></td>
		<td<?php echo $academic_sessions->sessionID->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionID->ViewAttributes() ?>><?php echo $academic_sessions->sessionID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($academic_sessions->sessionName->Visible) { // sessionName ?>
	<tr<?php echo $academic_sessions->sessionName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->sessionName->FldCaption() ?></td>
		<td<?php echo $academic_sessions->sessionName->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionName->ViewAttributes() ?>><?php echo $academic_sessions->sessionName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($academic_sessions->sessionStart->Visible) { // sessionStart ?>
	<tr<?php echo $academic_sessions->sessionStart->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->sessionStart->FldCaption() ?></td>
		<td<?php echo $academic_sessions->sessionStart->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionStart->ViewAttributes() ?>><?php echo $academic_sessions->sessionStart->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($academic_sessions->sessionEnd->Visible) { // sessionEnd ?>
	<tr<?php echo $academic_sessions->sessionEnd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->sessionEnd->FldCaption() ?></td>
		<td<?php echo $academic_sessions->sessionEnd->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionEnd->ViewAttributes() ?>><?php echo $academic_sessions->sessionEnd->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($academic_sessions->currentSession->Visible) { // currentSession ?>
	<tr<?php echo $academic_sessions->currentSession->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->currentSession->FldCaption() ?></td>
		<td<?php echo $academic_sessions->currentSession->CellAttributes() ?>>
<div<?php echo $academic_sessions->currentSession->ViewAttributes() ?>><?php echo $academic_sessions->currentSession->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($academic_sessions->status->Visible) { // status ?>
	<tr<?php echo $academic_sessions->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->status->FldCaption() ?></td>
		<td<?php echo $academic_sessions->status->CellAttributes() ?>>
<div<?php echo $academic_sessions->status->ViewAttributes() ?>><?php echo $academic_sessions->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$academic_sessions_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_sessions_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'academic_sessions';

	// Page object name
	var $PageObjName = 'academic_sessions_view';

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
	function cacademic_sessions_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_sessions)
		$GLOBALS["academic_sessions"] = new cacademic_sessions();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_sessions', TRUE);

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
		if (@$_GET["sessionID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["sessionID"]);
		}
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
		global $Language, $academic_sessions;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["sessionID"] <> "") {
				$academic_sessions->sessionID->setQueryStringValue($_GET["sessionID"]);
				$this->arRecKey["sessionID"] = $academic_sessions->sessionID->QueryStringValue;
			} else {
				$sReturnUrl = "academic_sessionslist.php"; // Return to list
			}

			// Get action
			$academic_sessions->CurrentAction = "I"; // Display form
			switch ($academic_sessions->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "academic_sessionslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($academic_sessions->Export, array("html","word","excel","xml","csv","email"))) {
				if ($academic_sessions->Export == "email" && $academic_sessions->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$academic_sessions->setExportReturnUrl($academic_sessions->ViewUrl()); // Add key
				$this->ExportData();
				if ($academic_sessions->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "academic_sessionslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$academic_sessions->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "sessionID=" . urlencode($academic_sessions->sessionID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "sessionID=" . urlencode($academic_sessions->sessionID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "sessionID=" . urlencode($academic_sessions->sessionID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "sessionID=" . urlencode($academic_sessions->sessionID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "sessionID=" . urlencode($academic_sessions->sessionID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "sessionID=" . urlencode($academic_sessions->sessionID->CurrentValue);
		$this->AddUrl = $academic_sessions->AddUrl();
		$this->EditUrl = $academic_sessions->EditUrl();
		$this->CopyUrl = $academic_sessions->CopyUrl();
		$this->DeleteUrl = $academic_sessions->DeleteUrl();
		$this->ListUrl = $academic_sessions->ListUrl();

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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $academic_sessions;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $academic_sessions->SelectRecordCount();
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
		if ($academic_sessions->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($academic_sessions, "v");
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
}
?>
