<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "class_roomsinfo.php" ?>
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
$class_rooms_view = new cclass_rooms_view();
$Page =& $class_rooms_view;

// Page init
$class_rooms_view->Page_Init();

// Page main
$class_rooms_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($class_rooms->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var class_rooms_view = new ew_Page("class_rooms_view");

// page properties
class_rooms_view.PageID = "view"; // page ID
class_rooms_view.FormID = "fclass_roomsview"; // form ID
var EW_PAGE_ID = class_rooms_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
class_rooms_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
class_rooms_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
class_rooms_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
class_rooms_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $class_rooms->TableCaption() ?>
<?php if ($class_rooms->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $class_rooms_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $class_rooms_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $class_rooms_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $class_rooms_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($class_rooms->Export == "") { ?>
<a href="<?php echo $class_rooms_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_rooms_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_rooms_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_rooms_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_rooms_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$class_rooms_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($class_rooms->classID->Visible) { // classID ?>
	<tr<?php echo $class_rooms->classID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->classID->FldCaption() ?></td>
		<td<?php echo $class_rooms->classID->CellAttributes() ?>>
<div<?php echo $class_rooms->classID->ViewAttributes() ?>><?php echo $class_rooms->classID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($class_rooms->classLevelID->Visible) { // classLevelID ?>
	<tr<?php echo $class_rooms->classLevelID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->classLevelID->FldCaption() ?></td>
		<td<?php echo $class_rooms->classLevelID->CellAttributes() ?>>
<div<?php echo $class_rooms->classLevelID->ViewAttributes() ?>><?php echo $class_rooms->classLevelID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($class_rooms->className->Visible) { // className ?>
	<tr<?php echo $class_rooms->className->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->className->FldCaption() ?></td>
		<td<?php echo $class_rooms->className->CellAttributes() ?>>
<div<?php echo $class_rooms->className->ViewAttributes() ?>><?php echo $class_rooms->className->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($class_rooms->classTeacher->Visible) { // classTeacher ?>
	<tr<?php echo $class_rooms->classTeacher->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->classTeacher->FldCaption() ?></td>
		<td<?php echo $class_rooms->classTeacher->CellAttributes() ?>>
<div<?php echo $class_rooms->classTeacher->ViewAttributes() ?>><?php echo $class_rooms->classTeacher->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($class_rooms->status->Visible) { // status ?>
	<tr<?php echo $class_rooms->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->status->FldCaption() ?></td>
		<td<?php echo $class_rooms->status->CellAttributes() ?>>
<div<?php echo $class_rooms->status->ViewAttributes() ?>><?php echo $class_rooms->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($class_rooms->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$class_rooms_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cclass_rooms_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'class_rooms';

	// Page object name
	var $PageObjName = 'class_rooms_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $class_rooms;
		if ($class_rooms->UseTokenInUrl) $PageUrl .= "t=" . $class_rooms->TableVar . "&"; // Add page token
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
		global $objForm, $class_rooms;
		if ($class_rooms->UseTokenInUrl) {
			if ($objForm)
				return ($class_rooms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($class_rooms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclass_rooms_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (class_rooms)
		$GLOBALS["class_rooms"] = new cclass_rooms();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'class_rooms', TRUE);

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
		global $class_rooms;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$class_rooms->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$class_rooms->Export = $_POST["exporttype"];
		} else {
			$class_rooms->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $class_rooms->Export; // Get export parameter, used in header
		$gsExportFile = $class_rooms->TableVar; // Get export file, used in header
		if (@$_GET["classID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["classID"]);
		}
		if ($class_rooms->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($class_rooms->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($class_rooms->Export == "csv") {
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
		global $Language, $class_rooms;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["classID"] <> "") {
				$class_rooms->classID->setQueryStringValue($_GET["classID"]);
				$this->arRecKey["classID"] = $class_rooms->classID->QueryStringValue;
			} else {
				$sReturnUrl = "class_roomslist.php"; // Return to list
			}

			// Get action
			$class_rooms->CurrentAction = "I"; // Display form
			switch ($class_rooms->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "class_roomslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($class_rooms->Export, array("html","word","excel","xml","csv","email"))) {
				if ($class_rooms->Export == "email" && $class_rooms->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$class_rooms->setExportReturnUrl($class_rooms->ViewUrl()); // Add key
				$this->ExportData();
				if ($class_rooms->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "class_roomslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$class_rooms->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $class_rooms;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$class_rooms->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$class_rooms->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $class_rooms->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$class_rooms->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$class_rooms->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$class_rooms->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $class_rooms;

		// Call Recordset Selecting event
		$class_rooms->Recordset_Selecting($class_rooms->CurrentFilter);

		// Load List page SQL
		$sSql = $class_rooms->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$class_rooms->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $class_rooms;
		$sFilter = $class_rooms->KeyFilter();

		// Call Row Selecting event
		$class_rooms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$class_rooms->CurrentFilter = $sFilter;
		$sSql = $class_rooms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$class_rooms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $class_rooms;
		$class_rooms->classID->setDbValue($rs->fields('classID'));
		$class_rooms->classLevelID->setDbValue($rs->fields('classLevelID'));
		$class_rooms->className->setDbValue($rs->fields('className'));
		$class_rooms->classTeacher->setDbValue($rs->fields('classTeacher'));
		$class_rooms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $class_rooms;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "classID=" . urlencode($class_rooms->classID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "classID=" . urlencode($class_rooms->classID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "classID=" . urlencode($class_rooms->classID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "classID=" . urlencode($class_rooms->classID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "classID=" . urlencode($class_rooms->classID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "classID=" . urlencode($class_rooms->classID->CurrentValue);
		$this->AddUrl = $class_rooms->AddUrl();
		$this->EditUrl = $class_rooms->EditUrl();
		$this->CopyUrl = $class_rooms->CopyUrl();
		$this->DeleteUrl = $class_rooms->DeleteUrl();
		$this->ListUrl = $class_rooms->ListUrl();

		// Call Row_Rendering event
		$class_rooms->Row_Rendering();

		// Common render codes for all row types
		// classID

		$class_rooms->classID->CellCssStyle = ""; $class_rooms->classID->CellCssClass = "";
		$class_rooms->classID->CellAttrs = array(); $class_rooms->classID->ViewAttrs = array(); $class_rooms->classID->EditAttrs = array();

		// classLevelID
		$class_rooms->classLevelID->CellCssStyle = ""; $class_rooms->classLevelID->CellCssClass = "";
		$class_rooms->classLevelID->CellAttrs = array(); $class_rooms->classLevelID->ViewAttrs = array(); $class_rooms->classLevelID->EditAttrs = array();

		// className
		$class_rooms->className->CellCssStyle = ""; $class_rooms->className->CellCssClass = "";
		$class_rooms->className->CellAttrs = array(); $class_rooms->className->ViewAttrs = array(); $class_rooms->className->EditAttrs = array();

		// classTeacher
		$class_rooms->classTeacher->CellCssStyle = ""; $class_rooms->classTeacher->CellCssClass = "";
		$class_rooms->classTeacher->CellAttrs = array(); $class_rooms->classTeacher->ViewAttrs = array(); $class_rooms->classTeacher->EditAttrs = array();

		// status
		$class_rooms->status->CellCssStyle = ""; $class_rooms->status->CellCssClass = "";
		$class_rooms->status->CellAttrs = array(); $class_rooms->status->ViewAttrs = array(); $class_rooms->status->EditAttrs = array();
		if ($class_rooms->RowType == EW_ROWTYPE_VIEW) { // View row

			// classID
			$class_rooms->classID->ViewValue = $class_rooms->classID->CurrentValue;
			$class_rooms->classID->CssStyle = "";
			$class_rooms->classID->CssClass = "";
			$class_rooms->classID->ViewCustomAttributes = "";

			// classLevelID
			if (strval($class_rooms->classLevelID->CurrentValue) <> "") {
				$sFilterWrk = "`classLevelID` = " . ew_AdjustSql($class_rooms->classLevelID->CurrentValue) . "";
			$sSqlWrk = "SELECT `classLevel` FROM `class_levels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$class_rooms->classLevelID->ViewValue = $rswrk->fields('classLevel');
					$rswrk->Close();
				} else {
					$class_rooms->classLevelID->ViewValue = $class_rooms->classLevelID->CurrentValue;
				}
			} else {
				$class_rooms->classLevelID->ViewValue = NULL;
			}
			$class_rooms->classLevelID->CssStyle = "";
			$class_rooms->classLevelID->CssClass = "";
			$class_rooms->classLevelID->ViewCustomAttributes = "";

			// className
			$class_rooms->className->ViewValue = $class_rooms->className->CurrentValue;
			$class_rooms->className->CssStyle = "";
			$class_rooms->className->CssClass = "";
			$class_rooms->className->ViewCustomAttributes = "";

			// classTeacher
			if (strval($class_rooms->classTeacher->CurrentValue) <> "") {
				$sFilterWrk = "`teacherID` = " . ew_AdjustSql($class_rooms->classTeacher->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `teachers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `lastname` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$class_rooms->classTeacher->ViewValue = $rswrk->fields('firstname');
					$class_rooms->classTeacher->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$class_rooms->classTeacher->ViewValue = $class_rooms->classTeacher->CurrentValue;
				}
			} else {
				$class_rooms->classTeacher->ViewValue = NULL;
			}
			$class_rooms->classTeacher->CssStyle = "";
			$class_rooms->classTeacher->CssClass = "";
			$class_rooms->classTeacher->ViewCustomAttributes = "";

			// status
			if (strval($class_rooms->status->CurrentValue) <> "") {
				switch ($class_rooms->status->CurrentValue) {
					case "1":
						$class_rooms->status->ViewValue = "Enabled";
						break;
					case "0":
						$class_rooms->status->ViewValue = "Disabled";
						break;
					default:
						$class_rooms->status->ViewValue = $class_rooms->status->CurrentValue;
				}
			} else {
				$class_rooms->status->ViewValue = NULL;
			}
			$class_rooms->status->CssStyle = "";
			$class_rooms->status->CssClass = "";
			$class_rooms->status->ViewCustomAttributes = "";

			// classID
			$class_rooms->classID->HrefValue = "";
			$class_rooms->classID->TooltipValue = "";

			// classLevelID
			$class_rooms->classLevelID->HrefValue = "";
			$class_rooms->classLevelID->TooltipValue = "";

			// className
			$class_rooms->className->HrefValue = "";
			$class_rooms->className->TooltipValue = "";

			// classTeacher
			$class_rooms->classTeacher->HrefValue = "";
			$class_rooms->classTeacher->TooltipValue = "";

			// status
			$class_rooms->status->HrefValue = "";
			$class_rooms->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($class_rooms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$class_rooms->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $class_rooms;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $class_rooms->SelectRecordCount();
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
		if ($class_rooms->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($class_rooms, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($class_rooms->classID);
				$ExportDoc->ExportCaption($class_rooms->classLevelID);
				$ExportDoc->ExportCaption($class_rooms->className);
				$ExportDoc->ExportCaption($class_rooms->classTeacher);
				$ExportDoc->ExportCaption($class_rooms->status);
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
				$class_rooms->CssClass = "";
				$class_rooms->CssStyle = "";
				$class_rooms->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($class_rooms->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('classID', $class_rooms->classID->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
					$XmlDoc->AddField('classLevelID', $class_rooms->classLevelID->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
					$XmlDoc->AddField('className', $class_rooms->className->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
					$XmlDoc->AddField('classTeacher', $class_rooms->classTeacher->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
					$XmlDoc->AddField('status', $class_rooms->status->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($class_rooms->classID);
					$ExportDoc->ExportField($class_rooms->classLevelID);
					$ExportDoc->ExportField($class_rooms->className);
					$ExportDoc->ExportField($class_rooms->classTeacher);
					$ExportDoc->ExportField($class_rooms->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($class_rooms->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($class_rooms->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($class_rooms->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($class_rooms->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($class_rooms->ExportReturnUrl());
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
