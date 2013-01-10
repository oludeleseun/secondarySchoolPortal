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
$session_terms_view = new csession_terms_view();
$Page =& $session_terms_view;

// Page init
$session_terms_view->Page_Init();

// Page main
$session_terms_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($session_terms->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var session_terms_view = new ew_Page("session_terms_view");

// page properties
session_terms_view.PageID = "view"; // page ID
session_terms_view.FormID = "fsession_termsview"; // form ID
var EW_PAGE_ID = session_terms_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
session_terms_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
session_terms_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
session_terms_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
session_terms_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $session_terms->TableCaption() ?>
<?php if ($session_terms->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $session_terms_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $session_terms_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $session_terms_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $session_terms_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($session_terms->Export == "") { ?>
<a href="<?php echo $session_terms_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $session_terms_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $session_terms_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $session_terms_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $session_terms_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$session_terms_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($session_terms->sessionTermID->Visible) { // sessionTermID ?>
	<tr<?php echo $session_terms->sessionTermID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->sessionTermID->FldCaption() ?></td>
		<td<?php echo $session_terms->sessionTermID->CellAttributes() ?>>
<div<?php echo $session_terms->sessionTermID->ViewAttributes() ?>><?php echo $session_terms->sessionTermID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($session_terms->session->Visible) { // session ?>
	<tr<?php echo $session_terms->session->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->session->FldCaption() ?></td>
		<td<?php echo $session_terms->session->CellAttributes() ?>>
<div<?php echo $session_terms->session->ViewAttributes() ?>><?php echo $session_terms->session->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($session_terms->termID->Visible) { // termID ?>
	<tr<?php echo $session_terms->termID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->termID->FldCaption() ?></td>
		<td<?php echo $session_terms->termID->CellAttributes() ?>>
<div<?php echo $session_terms->termID->ViewAttributes() ?>><?php echo $session_terms->termID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($session_terms->termStart->Visible) { // termStart ?>
	<tr<?php echo $session_terms->termStart->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->termStart->FldCaption() ?></td>
		<td<?php echo $session_terms->termStart->CellAttributes() ?>>
<div<?php echo $session_terms->termStart->ViewAttributes() ?>><?php echo $session_terms->termStart->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($session_terms->termEnd->Visible) { // termEnd ?>
	<tr<?php echo $session_terms->termEnd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->termEnd->FldCaption() ?></td>
		<td<?php echo $session_terms->termEnd->CellAttributes() ?>>
<div<?php echo $session_terms->termEnd->ViewAttributes() ?>><?php echo $session_terms->termEnd->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($session_terms->currentTerm->Visible) { // currentTerm ?>
	<tr<?php echo $session_terms->currentTerm->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->currentTerm->FldCaption() ?></td>
		<td<?php echo $session_terms->currentTerm->CellAttributes() ?>>
<div<?php echo $session_terms->currentTerm->ViewAttributes() ?>><?php echo $session_terms->currentTerm->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($session_terms->showResults->Visible) { // showResults ?>
	<tr<?php echo $session_terms->showResults->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->showResults->FldCaption() ?></td>
		<td<?php echo $session_terms->showResults->CellAttributes() ?>>
<div<?php echo $session_terms->showResults->ViewAttributes() ?>><?php echo $session_terms->showResults->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($session_terms->status->Visible) { // status ?>
	<tr<?php echo $session_terms->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->status->FldCaption() ?></td>
		<td<?php echo $session_terms->status->CellAttributes() ?>>
<div<?php echo $session_terms->status->ViewAttributes() ?>><?php echo $session_terms->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$session_terms_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csession_terms_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'session_terms';

	// Page object name
	var $PageObjName = 'session_terms_view';

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
	function csession_terms_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (session_terms)
		$GLOBALS["session_terms"] = new csession_terms();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'session_terms', TRUE);

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
		if (@$_GET["sessionTermID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["sessionTermID"]);
		}
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
		global $Language, $session_terms;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["sessionTermID"] <> "") {
				$session_terms->sessionTermID->setQueryStringValue($_GET["sessionTermID"]);
				$this->arRecKey["sessionTermID"] = $session_terms->sessionTermID->QueryStringValue;
			} else {
				$sReturnUrl = "session_termslist.php"; // Return to list
			}

			// Get action
			$session_terms->CurrentAction = "I"; // Display form
			switch ($session_terms->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "session_termslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($session_terms->Export, array("html","word","excel","xml","csv","email"))) {
				if ($session_terms->Export == "email" && $session_terms->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$session_terms->setExportReturnUrl($session_terms->ViewUrl()); // Add key
				$this->ExportData();
				if ($session_terms->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "session_termslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$session_terms->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "sessionTermID=" . urlencode($session_terms->sessionTermID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "sessionTermID=" . urlencode($session_terms->sessionTermID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "sessionTermID=" . urlencode($session_terms->sessionTermID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "sessionTermID=" . urlencode($session_terms->sessionTermID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "sessionTermID=" . urlencode($session_terms->sessionTermID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "sessionTermID=" . urlencode($session_terms->sessionTermID->CurrentValue);
		$this->AddUrl = $session_terms->AddUrl();
		$this->EditUrl = $session_terms->EditUrl();
		$this->CopyUrl = $session_terms->CopyUrl();
		$this->DeleteUrl = $session_terms->DeleteUrl();
		$this->ListUrl = $session_terms->ListUrl();

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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $session_terms;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $session_terms->SelectRecordCount();
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
		if ($session_terms->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($session_terms, "v");
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
}
?>
