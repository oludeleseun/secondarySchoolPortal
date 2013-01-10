<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "subjectsinfo.php" ?>
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
$subjects_view = new csubjects_view();
$Page =& $subjects_view;

// Page init
$subjects_view->Page_Init();

// Page main
$subjects_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($subjects->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subjects_view = new ew_Page("subjects_view");

// page properties
subjects_view.PageID = "view"; // page ID
subjects_view.FormID = "fsubjectsview"; // form ID
var EW_PAGE_ID = subjects_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subjects_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subjects_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subjects_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subjects_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subjects->TableCaption() ?>
<?php if ($subjects->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $subjects_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $subjects_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $subjects_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $subjects_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($subjects->Export == "") { ?>
<a href="<?php echo $subjects_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subjects_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subjects_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subjects_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subjects_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subjects_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subjects->subjectID->Visible) { // subjectID ?>
	<tr<?php echo $subjects->subjectID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subjects->subjectID->FldCaption() ?></td>
		<td<?php echo $subjects->subjectID->CellAttributes() ?>>
<div<?php echo $subjects->subjectID->ViewAttributes() ?>><?php echo $subjects->subjectID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subjects->subjectName->Visible) { // subjectName ?>
	<tr<?php echo $subjects->subjectName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subjects->subjectName->FldCaption() ?></td>
		<td<?php echo $subjects->subjectName->CellAttributes() ?>>
<div<?php echo $subjects->subjectName->ViewAttributes() ?>><?php echo $subjects->subjectName->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subjects->subjectDescription->Visible) { // subjectDescription ?>
	<tr<?php echo $subjects->subjectDescription->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subjects->subjectDescription->FldCaption() ?></td>
		<td<?php echo $subjects->subjectDescription->CellAttributes() ?>>
<div<?php echo $subjects->subjectDescription->ViewAttributes() ?>><?php echo $subjects->subjectDescription->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subjects->status->Visible) { // status ?>
	<tr<?php echo $subjects->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subjects->status->FldCaption() ?></td>
		<td<?php echo $subjects->status->CellAttributes() ?>>
<div<?php echo $subjects->status->ViewAttributes() ?>><?php echo $subjects->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($subjects->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$subjects_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csubjects_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'subjects';

	// Page object name
	var $PageObjName = 'subjects_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subjects;
		if ($subjects->UseTokenInUrl) $PageUrl .= "t=" . $subjects->TableVar . "&"; // Add page token
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
		global $objForm, $subjects;
		if ($subjects->UseTokenInUrl) {
			if ($objForm)
				return ($subjects->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subjects->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubjects_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subjects)
		$GLOBALS["subjects"] = new csubjects();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subjects', TRUE);

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
		global $subjects;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$subjects->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$subjects->Export = $_POST["exporttype"];
		} else {
			$subjects->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $subjects->Export; // Get export parameter, used in header
		$gsExportFile = $subjects->TableVar; // Get export file, used in header
		if (@$_GET["subjectID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["subjectID"]);
		}
		if ($subjects->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($subjects->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($subjects->Export == "csv") {
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
		global $Language, $subjects;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["subjectID"] <> "") {
				$subjects->subjectID->setQueryStringValue($_GET["subjectID"]);
				$this->arRecKey["subjectID"] = $subjects->subjectID->QueryStringValue;
			} else {
				$sReturnUrl = "subjectslist.php"; // Return to list
			}

			// Get action
			$subjects->CurrentAction = "I"; // Display form
			switch ($subjects->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "subjectslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($subjects->Export, array("html","word","excel","xml","csv","email"))) {
				if ($subjects->Export == "email" && $subjects->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$subjects->setExportReturnUrl($subjects->ViewUrl()); // Add key
				$this->ExportData();
				if ($subjects->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "subjectslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$subjects->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subjects;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$subjects->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$subjects->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $subjects->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$subjects->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$subjects->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$subjects->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subjects;

		// Call Recordset Selecting event
		$subjects->Recordset_Selecting($subjects->CurrentFilter);

		// Load List page SQL
		$sSql = $subjects->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subjects->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subjects;
		$sFilter = $subjects->KeyFilter();

		// Call Row Selecting event
		$subjects->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subjects->CurrentFilter = $sFilter;
		$sSql = $subjects->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subjects->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subjects;
		$subjects->subjectID->setDbValue($rs->fields('subjectID'));
		$subjects->subjectName->setDbValue($rs->fields('subjectName'));
		$subjects->subjectDescription->setDbValue($rs->fields('subjectDescription'));
		$subjects->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subjects;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "subjectID=" . urlencode($subjects->subjectID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "subjectID=" . urlencode($subjects->subjectID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "subjectID=" . urlencode($subjects->subjectID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "subjectID=" . urlencode($subjects->subjectID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "subjectID=" . urlencode($subjects->subjectID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "subjectID=" . urlencode($subjects->subjectID->CurrentValue);
		$this->AddUrl = $subjects->AddUrl();
		$this->EditUrl = $subjects->EditUrl();
		$this->CopyUrl = $subjects->CopyUrl();
		$this->DeleteUrl = $subjects->DeleteUrl();
		$this->ListUrl = $subjects->ListUrl();

		// Call Row_Rendering event
		$subjects->Row_Rendering();

		// Common render codes for all row types
		// subjectID

		$subjects->subjectID->CellCssStyle = ""; $subjects->subjectID->CellCssClass = "";
		$subjects->subjectID->CellAttrs = array(); $subjects->subjectID->ViewAttrs = array(); $subjects->subjectID->EditAttrs = array();

		// subjectName
		$subjects->subjectName->CellCssStyle = ""; $subjects->subjectName->CellCssClass = "";
		$subjects->subjectName->CellAttrs = array(); $subjects->subjectName->ViewAttrs = array(); $subjects->subjectName->EditAttrs = array();

		// subjectDescription
		$subjects->subjectDescription->CellCssStyle = ""; $subjects->subjectDescription->CellCssClass = "";
		$subjects->subjectDescription->CellAttrs = array(); $subjects->subjectDescription->ViewAttrs = array(); $subjects->subjectDescription->EditAttrs = array();

		// status
		$subjects->status->CellCssStyle = ""; $subjects->status->CellCssClass = "";
		$subjects->status->CellAttrs = array(); $subjects->status->ViewAttrs = array(); $subjects->status->EditAttrs = array();
		if ($subjects->RowType == EW_ROWTYPE_VIEW) { // View row

			// subjectID
			$subjects->subjectID->ViewValue = $subjects->subjectID->CurrentValue;
			$subjects->subjectID->CssStyle = "";
			$subjects->subjectID->CssClass = "";
			$subjects->subjectID->ViewCustomAttributes = "";

			// subjectName
			$subjects->subjectName->ViewValue = $subjects->subjectName->CurrentValue;
			$subjects->subjectName->CssStyle = "";
			$subjects->subjectName->CssClass = "";
			$subjects->subjectName->ViewCustomAttributes = "";

			// subjectDescription
			$subjects->subjectDescription->ViewValue = $subjects->subjectDescription->CurrentValue;
			$subjects->subjectDescription->CssStyle = "";
			$subjects->subjectDescription->CssClass = "";
			$subjects->subjectDescription->ViewCustomAttributes = "";

			// status
			if (strval($subjects->status->CurrentValue) <> "") {
				switch ($subjects->status->CurrentValue) {
					case "1":
						$subjects->status->ViewValue = "Enabled";
						break;
					case "0":
						$subjects->status->ViewValue = "Disabled";
						break;
					default:
						$subjects->status->ViewValue = $subjects->status->CurrentValue;
				}
			} else {
				$subjects->status->ViewValue = NULL;
			}
			$subjects->status->CssStyle = "";
			$subjects->status->CssClass = "";
			$subjects->status->ViewCustomAttributes = "";

			// subjectID
			$subjects->subjectID->HrefValue = "";
			$subjects->subjectID->TooltipValue = "";

			// subjectName
			$subjects->subjectName->HrefValue = "";
			$subjects->subjectName->TooltipValue = "";

			// subjectDescription
			$subjects->subjectDescription->HrefValue = "";
			$subjects->subjectDescription->TooltipValue = "";

			// status
			$subjects->status->HrefValue = "";
			$subjects->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subjects->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subjects->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $subjects;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $subjects->SelectRecordCount();
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
		if ($subjects->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($subjects, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($subjects->subjectID);
				$ExportDoc->ExportCaption($subjects->subjectName);
				$ExportDoc->ExportCaption($subjects->status);
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
				$subjects->CssClass = "";
				$subjects->CssStyle = "";
				$subjects->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($subjects->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('subjectID', $subjects->subjectID->ExportValue($subjects->Export, $subjects->ExportOriginalValue));
					$XmlDoc->AddField('subjectName', $subjects->subjectName->ExportValue($subjects->Export, $subjects->ExportOriginalValue));
					$XmlDoc->AddField('status', $subjects->status->ExportValue($subjects->Export, $subjects->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($subjects->subjectID);
					$ExportDoc->ExportField($subjects->subjectName);
					$ExportDoc->ExportField($subjects->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($subjects->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($subjects->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($subjects->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($subjects->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($subjects->ExportReturnUrl());
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
