<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "class_levelsinfo.php" ?>
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
$class_levels_view = new cclass_levels_view();
$Page =& $class_levels_view;

// Page init
$class_levels_view->Page_Init();

// Page main
$class_levels_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($class_levels->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var class_levels_view = new ew_Page("class_levels_view");

// page properties
class_levels_view.PageID = "view"; // page ID
class_levels_view.FormID = "fclass_levelsview"; // form ID
var EW_PAGE_ID = class_levels_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
class_levels_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
class_levels_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
class_levels_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
class_levels_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $class_levels->TableCaption() ?>
<?php if ($class_levels->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $class_levels_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $class_levels_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $class_levels_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $class_levels_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($class_levels->Export == "") { ?>
<a href="<?php echo $class_levels_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_levels_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_levels_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_levels_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_levels_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$class_levels_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($class_levels->classLevelID->Visible) { // classLevelID ?>
	<tr<?php echo $class_levels->classLevelID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_levels->classLevelID->FldCaption() ?></td>
		<td<?php echo $class_levels->classLevelID->CellAttributes() ?>>
<div<?php echo $class_levels->classLevelID->ViewAttributes() ?>><?php echo $class_levels->classLevelID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($class_levels->classLevel->Visible) { // classLevel ?>
	<tr<?php echo $class_levels->classLevel->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_levels->classLevel->FldCaption() ?></td>
		<td<?php echo $class_levels->classLevel->CellAttributes() ?>>
<div<?php echo $class_levels->classLevel->ViewAttributes() ?>><?php echo $class_levels->classLevel->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($class_levels->classOrder->Visible) { // classOrder ?>
	<tr<?php echo $class_levels->classOrder->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_levels->classOrder->FldCaption() ?></td>
		<td<?php echo $class_levels->classOrder->CellAttributes() ?>>
<div<?php echo $class_levels->classOrder->ViewAttributes() ?>><?php echo $class_levels->classOrder->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($class_levels->schoolFees->Visible) { // schoolFees ?>
	<tr<?php echo $class_levels->schoolFees->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_levels->schoolFees->FldCaption() ?></td>
		<td<?php echo $class_levels->schoolFees->CellAttributes() ?>>
<div<?php echo $class_levels->schoolFees->ViewAttributes() ?>><?php echo $class_levels->schoolFees->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($class_levels->status->Visible) { // status ?>
	<tr<?php echo $class_levels->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_levels->status->FldCaption() ?></td>
		<td<?php echo $class_levels->status->CellAttributes() ?>>
<div<?php echo $class_levels->status->ViewAttributes() ?>><?php echo $class_levels->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($class_levels->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$class_levels_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cclass_levels_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'class_levels';

	// Page object name
	var $PageObjName = 'class_levels_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $class_levels;
		if ($class_levels->UseTokenInUrl) $PageUrl .= "t=" . $class_levels->TableVar . "&"; // Add page token
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
		global $objForm, $class_levels;
		if ($class_levels->UseTokenInUrl) {
			if ($objForm)
				return ($class_levels->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($class_levels->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclass_levels_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (class_levels)
		$GLOBALS["class_levels"] = new cclass_levels();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'class_levels', TRUE);

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
		global $class_levels;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$class_levels->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$class_levels->Export = $_POST["exporttype"];
		} else {
			$class_levels->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $class_levels->Export; // Get export parameter, used in header
		$gsExportFile = $class_levels->TableVar; // Get export file, used in header
		if (@$_GET["classLevelID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["classLevelID"]);
		}
		if ($class_levels->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($class_levels->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($class_levels->Export == "csv") {
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
		global $Language, $class_levels;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["classLevelID"] <> "") {
				$class_levels->classLevelID->setQueryStringValue($_GET["classLevelID"]);
				$this->arRecKey["classLevelID"] = $class_levels->classLevelID->QueryStringValue;
			} else {
				$sReturnUrl = "class_levelslist.php"; // Return to list
			}

			// Get action
			$class_levels->CurrentAction = "I"; // Display form
			switch ($class_levels->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "class_levelslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($class_levels->Export, array("html","word","excel","xml","csv","email"))) {
				if ($class_levels->Export == "email" && $class_levels->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$class_levels->setExportReturnUrl($class_levels->ViewUrl()); // Add key
				$this->ExportData();
				if ($class_levels->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "class_levelslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$class_levels->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $class_levels;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$class_levels->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$class_levels->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $class_levels->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$class_levels->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$class_levels->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$class_levels->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $class_levels;

		// Call Recordset Selecting event
		$class_levels->Recordset_Selecting($class_levels->CurrentFilter);

		// Load List page SQL
		$sSql = $class_levels->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$class_levels->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $class_levels;
		$sFilter = $class_levels->KeyFilter();

		// Call Row Selecting event
		$class_levels->Row_Selecting($sFilter);

		// Load SQL based on filter
		$class_levels->CurrentFilter = $sFilter;
		$sSql = $class_levels->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$class_levels->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $class_levels;
		$class_levels->classLevelID->setDbValue($rs->fields('classLevelID'));
		$class_levels->classLevel->setDbValue($rs->fields('classLevel'));
		$class_levels->classOrder->setDbValue($rs->fields('classOrder'));
		$class_levels->schoolFees->setDbValue($rs->fields('schoolFees'));
		$class_levels->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $class_levels;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "classLevelID=" . urlencode($class_levels->classLevelID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "classLevelID=" . urlencode($class_levels->classLevelID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "classLevelID=" . urlencode($class_levels->classLevelID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "classLevelID=" . urlencode($class_levels->classLevelID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "classLevelID=" . urlencode($class_levels->classLevelID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "classLevelID=" . urlencode($class_levels->classLevelID->CurrentValue);
		$this->AddUrl = $class_levels->AddUrl();
		$this->EditUrl = $class_levels->EditUrl();
		$this->CopyUrl = $class_levels->CopyUrl();
		$this->DeleteUrl = $class_levels->DeleteUrl();
		$this->ListUrl = $class_levels->ListUrl();

		// Call Row_Rendering event
		$class_levels->Row_Rendering();

		// Common render codes for all row types
		// classLevelID

		$class_levels->classLevelID->CellCssStyle = ""; $class_levels->classLevelID->CellCssClass = "";
		$class_levels->classLevelID->CellAttrs = array(); $class_levels->classLevelID->ViewAttrs = array(); $class_levels->classLevelID->EditAttrs = array();

		// classLevel
		$class_levels->classLevel->CellCssStyle = ""; $class_levels->classLevel->CellCssClass = "";
		$class_levels->classLevel->CellAttrs = array(); $class_levels->classLevel->ViewAttrs = array(); $class_levels->classLevel->EditAttrs = array();

		// classOrder
		$class_levels->classOrder->CellCssStyle = ""; $class_levels->classOrder->CellCssClass = "";
		$class_levels->classOrder->CellAttrs = array(); $class_levels->classOrder->ViewAttrs = array(); $class_levels->classOrder->EditAttrs = array();

		// schoolFees
		$class_levels->schoolFees->CellCssStyle = ""; $class_levels->schoolFees->CellCssClass = "";
		$class_levels->schoolFees->CellAttrs = array(); $class_levels->schoolFees->ViewAttrs = array(); $class_levels->schoolFees->EditAttrs = array();

		// status
		$class_levels->status->CellCssStyle = ""; $class_levels->status->CellCssClass = "";
		$class_levels->status->CellAttrs = array(); $class_levels->status->ViewAttrs = array(); $class_levels->status->EditAttrs = array();
		if ($class_levels->RowType == EW_ROWTYPE_VIEW) { // View row

			// classLevelID
			$class_levels->classLevelID->ViewValue = $class_levels->classLevelID->CurrentValue;
			$class_levels->classLevelID->CssStyle = "";
			$class_levels->classLevelID->CssClass = "";
			$class_levels->classLevelID->ViewCustomAttributes = "";

			// classLevel
			$class_levels->classLevel->ViewValue = $class_levels->classLevel->CurrentValue;
			$class_levels->classLevel->CssStyle = "";
			$class_levels->classLevel->CssClass = "";
			$class_levels->classLevel->ViewCustomAttributes = "";

			// classOrder
			$class_levels->classOrder->ViewValue = $class_levels->classOrder->CurrentValue;
			$class_levels->classOrder->CssStyle = "";
			$class_levels->classOrder->CssClass = "";
			$class_levels->classOrder->ViewCustomAttributes = "";

			// schoolFees
			$class_levels->schoolFees->ViewValue = $class_levels->schoolFees->CurrentValue;
			$class_levels->schoolFees->CssStyle = "";
			$class_levels->schoolFees->CssClass = "";
			$class_levels->schoolFees->ViewCustomAttributes = "";

			// status
			if (strval($class_levels->status->CurrentValue) <> "") {
				switch ($class_levels->status->CurrentValue) {
					case "1":
						$class_levels->status->ViewValue = "Enabled";
						break;
					case "0":
						$class_levels->status->ViewValue = "Disabled";
						break;
					default:
						$class_levels->status->ViewValue = $class_levels->status->CurrentValue;
				}
			} else {
				$class_levels->status->ViewValue = NULL;
			}
			$class_levels->status->CssStyle = "";
			$class_levels->status->CssClass = "";
			$class_levels->status->ViewCustomAttributes = "";

			// classLevelID
			$class_levels->classLevelID->HrefValue = "";
			$class_levels->classLevelID->TooltipValue = "";

			// classLevel
			$class_levels->classLevel->HrefValue = "";
			$class_levels->classLevel->TooltipValue = "";

			// classOrder
			$class_levels->classOrder->HrefValue = "";
			$class_levels->classOrder->TooltipValue = "";

			// schoolFees
			$class_levels->schoolFees->HrefValue = "";
			$class_levels->schoolFees->TooltipValue = "";

			// status
			$class_levels->status->HrefValue = "";
			$class_levels->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($class_levels->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$class_levels->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $class_levels;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $class_levels->SelectRecordCount();
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
		if ($class_levels->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($class_levels, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($class_levels->classLevelID);
				$ExportDoc->ExportCaption($class_levels->classLevel);
				$ExportDoc->ExportCaption($class_levels->classOrder);
				$ExportDoc->ExportCaption($class_levels->schoolFees);
				$ExportDoc->ExportCaption($class_levels->status);
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
				$class_levels->CssClass = "";
				$class_levels->CssStyle = "";
				$class_levels->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($class_levels->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('classLevelID', $class_levels->classLevelID->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
					$XmlDoc->AddField('classLevel', $class_levels->classLevel->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
					$XmlDoc->AddField('classOrder', $class_levels->classOrder->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
					$XmlDoc->AddField('schoolFees', $class_levels->schoolFees->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
					$XmlDoc->AddField('status', $class_levels->status->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($class_levels->classLevelID);
					$ExportDoc->ExportField($class_levels->classLevel);
					$ExportDoc->ExportField($class_levels->classOrder);
					$ExportDoc->ExportField($class_levels->schoolFees);
					$ExportDoc->ExportField($class_levels->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($class_levels->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($class_levels->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($class_levels->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($class_levels->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($class_levels->ExportReturnUrl());
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
