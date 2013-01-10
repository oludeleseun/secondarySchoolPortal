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
$term_result_approval_view = new cterm_result_approval_view();
$Page =& $term_result_approval_view;

// Page init
$term_result_approval_view->Page_Init();

// Page main
$term_result_approval_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($term_result_approval->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var term_result_approval_view = new ew_Page("term_result_approval_view");

// page properties
term_result_approval_view.PageID = "view"; // page ID
term_result_approval_view.FormID = "fterm_result_approvalview"; // form ID
var EW_PAGE_ID = term_result_approval_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
term_result_approval_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
term_result_approval_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
term_result_approval_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
term_result_approval_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $term_result_approval->TableCaption() ?>
<?php if ($term_result_approval->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $term_result_approval_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $term_result_approval_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $term_result_approval_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $term_result_approval_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($term_result_approval->Export == "") { ?>
<a href="<?php echo $term_result_approval_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $term_result_approval_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $term_result_approval_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $term_result_approval_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $term_result_approval_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$term_result_approval_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($term_result_approval->approvalID->Visible) { // approvalID ?>
	<tr<?php echo $term_result_approval->approvalID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $term_result_approval->approvalID->FldCaption() ?></td>
		<td<?php echo $term_result_approval->approvalID->CellAttributes() ?>>
<div<?php echo $term_result_approval->approvalID->ViewAttributes() ?>><?php echo $term_result_approval->approvalID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($term_result_approval->sessionTermID->Visible) { // sessionTermID ?>
	<tr<?php echo $term_result_approval->sessionTermID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $term_result_approval->sessionTermID->FldCaption() ?></td>
		<td<?php echo $term_result_approval->sessionTermID->CellAttributes() ?>>
<div<?php echo $term_result_approval->sessionTermID->ViewAttributes() ?>><?php echo $term_result_approval->sessionTermID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($term_result_approval->status->Visible) { // status ?>
	<tr<?php echo $term_result_approval->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $term_result_approval->status->FldCaption() ?></td>
		<td<?php echo $term_result_approval->status->CellAttributes() ?>>
<div<?php echo $term_result_approval->status->ViewAttributes() ?>><?php echo $term_result_approval->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$term_result_approval_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cterm_result_approval_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'term_result_approval';

	// Page object name
	var $PageObjName = 'term_result_approval_view';

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
	function cterm_result_approval_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (term_result_approval)
		$GLOBALS["term_result_approval"] = new cterm_result_approval();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'term_result_approval', TRUE);

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
		if (@$_GET["approvalID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["approvalID"]);
		}
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
		global $Language, $term_result_approval;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["approvalID"] <> "") {
				$term_result_approval->approvalID->setQueryStringValue($_GET["approvalID"]);
				$this->arRecKey["approvalID"] = $term_result_approval->approvalID->QueryStringValue;
			} else {
				$sReturnUrl = "term_result_approvallist.php"; // Return to list
			}

			// Get action
			$term_result_approval->CurrentAction = "I"; // Display form
			switch ($term_result_approval->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "term_result_approvallist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($term_result_approval->Export, array("html","word","excel","xml","csv","email"))) {
				if ($term_result_approval->Export == "email" && $term_result_approval->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$term_result_approval->setExportReturnUrl($term_result_approval->ViewUrl()); // Add key
				$this->ExportData();
				if ($term_result_approval->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "term_result_approvallist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$term_result_approval->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "approvalID=" . urlencode($term_result_approval->approvalID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "approvalID=" . urlencode($term_result_approval->approvalID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "approvalID=" . urlencode($term_result_approval->approvalID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "approvalID=" . urlencode($term_result_approval->approvalID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "approvalID=" . urlencode($term_result_approval->approvalID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "approvalID=" . urlencode($term_result_approval->approvalID->CurrentValue);
		$this->AddUrl = $term_result_approval->AddUrl();
		$this->EditUrl = $term_result_approval->EditUrl();
		$this->CopyUrl = $term_result_approval->CopyUrl();
		$this->DeleteUrl = $term_result_approval->DeleteUrl();
		$this->ListUrl = $term_result_approval->ListUrl();

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

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $term_result_approval;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $term_result_approval->SelectRecordCount();
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
		if ($term_result_approval->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($term_result_approval, "v");
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
}
?>
