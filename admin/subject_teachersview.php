<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "subject_teachersinfo.php" ?>
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
$subject_teachers_view = new csubject_teachers_view();
$Page =& $subject_teachers_view;

// Page init
$subject_teachers_view->Page_Init();

// Page main
$subject_teachers_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($subject_teachers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subject_teachers_view = new ew_Page("subject_teachers_view");

// page properties
subject_teachers_view.PageID = "view"; // page ID
subject_teachers_view.FormID = "fsubject_teachersview"; // form ID
var EW_PAGE_ID = subject_teachers_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subject_teachers_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subject_teachers_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subject_teachers_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subject_teachers_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subject_teachers->TableCaption() ?>
<?php if ($subject_teachers->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $subject_teachers_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $subject_teachers_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $subject_teachers_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $subject_teachers_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($subject_teachers->Export == "") { ?>
<a href="<?php echo $subject_teachers_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subject_teachers_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subject_teachers_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subject_teachers_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subject_teachers_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subject_teachers_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subject_teachers->subjectTeacherID->Visible) { // subjectTeacherID ?>
	<tr<?php echo $subject_teachers->subjectTeacherID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subject_teachers->subjectTeacherID->FldCaption() ?></td>
		<td<?php echo $subject_teachers->subjectTeacherID->CellAttributes() ?>>
<div<?php echo $subject_teachers->subjectTeacherID->ViewAttributes() ?>><?php echo $subject_teachers->subjectTeacherID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subject_teachers->subjectID->Visible) { // subjectID ?>
	<tr<?php echo $subject_teachers->subjectID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subject_teachers->subjectID->FldCaption() ?></td>
		<td<?php echo $subject_teachers->subjectID->CellAttributes() ?>>
<div<?php echo $subject_teachers->subjectID->ViewAttributes() ?>><?php echo $subject_teachers->subjectID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subject_teachers->subjectTeacher->Visible) { // subjectTeacher ?>
	<tr<?php echo $subject_teachers->subjectTeacher->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subject_teachers->subjectTeacher->FldCaption() ?></td>
		<td<?php echo $subject_teachers->subjectTeacher->CellAttributes() ?>>
<div<?php echo $subject_teachers->subjectTeacher->ViewAttributes() ?>><?php echo $subject_teachers->subjectTeacher->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subject_teachers->classroomID->Visible) { // classroomID ?>
	<tr<?php echo $subject_teachers->classroomID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subject_teachers->classroomID->FldCaption() ?></td>
		<td<?php echo $subject_teachers->classroomID->CellAttributes() ?>>
<div<?php echo $subject_teachers->classroomID->ViewAttributes() ?>><?php echo $subject_teachers->classroomID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($subject_teachers->status->Visible) { // status ?>
	<tr<?php echo $subject_teachers->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subject_teachers->status->FldCaption() ?></td>
		<td<?php echo $subject_teachers->status->CellAttributes() ?>>
<div<?php echo $subject_teachers->status->ViewAttributes() ?>><?php echo $subject_teachers->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($subject_teachers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$subject_teachers_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csubject_teachers_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'subject_teachers';

	// Page object name
	var $PageObjName = 'subject_teachers_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subject_teachers;
		if ($subject_teachers->UseTokenInUrl) $PageUrl .= "t=" . $subject_teachers->TableVar . "&"; // Add page token
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
		global $objForm, $subject_teachers;
		if ($subject_teachers->UseTokenInUrl) {
			if ($objForm)
				return ($subject_teachers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subject_teachers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubject_teachers_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subject_teachers)
		$GLOBALS["subject_teachers"] = new csubject_teachers();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subject_teachers', TRUE);

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
		global $subject_teachers;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$subject_teachers->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$subject_teachers->Export = $_POST["exporttype"];
		} else {
			$subject_teachers->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $subject_teachers->Export; // Get export parameter, used in header
		$gsExportFile = $subject_teachers->TableVar; // Get export file, used in header
		if (@$_GET["subjectTeacherID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["subjectTeacherID"]);
		}
		if ($subject_teachers->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($subject_teachers->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($subject_teachers->Export == "csv") {
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
		global $Language, $subject_teachers;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["subjectTeacherID"] <> "") {
				$subject_teachers->subjectTeacherID->setQueryStringValue($_GET["subjectTeacherID"]);
				$this->arRecKey["subjectTeacherID"] = $subject_teachers->subjectTeacherID->QueryStringValue;
			} else {
				$sReturnUrl = "subject_teacherslist.php"; // Return to list
			}

			// Get action
			$subject_teachers->CurrentAction = "I"; // Display form
			switch ($subject_teachers->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "subject_teacherslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($subject_teachers->Export, array("html","word","excel","xml","csv","email"))) {
				if ($subject_teachers->Export == "email" && $subject_teachers->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$subject_teachers->setExportReturnUrl($subject_teachers->ViewUrl()); // Add key
				$this->ExportData();
				if ($subject_teachers->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "subject_teacherslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$subject_teachers->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subject_teachers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$subject_teachers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$subject_teachers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $subject_teachers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$subject_teachers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$subject_teachers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$subject_teachers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subject_teachers;

		// Call Recordset Selecting event
		$subject_teachers->Recordset_Selecting($subject_teachers->CurrentFilter);

		// Load List page SQL
		$sSql = $subject_teachers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subject_teachers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subject_teachers;
		$sFilter = $subject_teachers->KeyFilter();

		// Call Row Selecting event
		$subject_teachers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subject_teachers->CurrentFilter = $sFilter;
		$sSql = $subject_teachers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subject_teachers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subject_teachers;
		$subject_teachers->subjectTeacherID->setDbValue($rs->fields('subjectTeacherID'));
		$subject_teachers->subjectID->setDbValue($rs->fields('subjectID'));
		$subject_teachers->subjectTeacher->setDbValue($rs->fields('subjectTeacher'));
		$subject_teachers->classroomID->setDbValue($rs->fields('classroomID'));
		$subject_teachers->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subject_teachers;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "subjectTeacherID=" . urlencode($subject_teachers->subjectTeacherID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "subjectTeacherID=" . urlencode($subject_teachers->subjectTeacherID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "subjectTeacherID=" . urlencode($subject_teachers->subjectTeacherID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "subjectTeacherID=" . urlencode($subject_teachers->subjectTeacherID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "subjectTeacherID=" . urlencode($subject_teachers->subjectTeacherID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "subjectTeacherID=" . urlencode($subject_teachers->subjectTeacherID->CurrentValue);
		$this->AddUrl = $subject_teachers->AddUrl();
		$this->EditUrl = $subject_teachers->EditUrl();
		$this->CopyUrl = $subject_teachers->CopyUrl();
		$this->DeleteUrl = $subject_teachers->DeleteUrl();
		$this->ListUrl = $subject_teachers->ListUrl();

		// Call Row_Rendering event
		$subject_teachers->Row_Rendering();

		// Common render codes for all row types
		// subjectTeacherID

		$subject_teachers->subjectTeacherID->CellCssStyle = ""; $subject_teachers->subjectTeacherID->CellCssClass = "";
		$subject_teachers->subjectTeacherID->CellAttrs = array(); $subject_teachers->subjectTeacherID->ViewAttrs = array(); $subject_teachers->subjectTeacherID->EditAttrs = array();

		// subjectID
		$subject_teachers->subjectID->CellCssStyle = ""; $subject_teachers->subjectID->CellCssClass = "";
		$subject_teachers->subjectID->CellAttrs = array(); $subject_teachers->subjectID->ViewAttrs = array(); $subject_teachers->subjectID->EditAttrs = array();

		// subjectTeacher
		$subject_teachers->subjectTeacher->CellCssStyle = ""; $subject_teachers->subjectTeacher->CellCssClass = "";
		$subject_teachers->subjectTeacher->CellAttrs = array(); $subject_teachers->subjectTeacher->ViewAttrs = array(); $subject_teachers->subjectTeacher->EditAttrs = array();

		// classroomID
		$subject_teachers->classroomID->CellCssStyle = ""; $subject_teachers->classroomID->CellCssClass = "";
		$subject_teachers->classroomID->CellAttrs = array(); $subject_teachers->classroomID->ViewAttrs = array(); $subject_teachers->classroomID->EditAttrs = array();

		// status
		$subject_teachers->status->CellCssStyle = ""; $subject_teachers->status->CellCssClass = "";
		$subject_teachers->status->CellAttrs = array(); $subject_teachers->status->ViewAttrs = array(); $subject_teachers->status->EditAttrs = array();
		if ($subject_teachers->RowType == EW_ROWTYPE_VIEW) { // View row

			// subjectTeacherID
			$subject_teachers->subjectTeacherID->ViewValue = $subject_teachers->subjectTeacherID->CurrentValue;
			$subject_teachers->subjectTeacherID->CssStyle = "";
			$subject_teachers->subjectTeacherID->CssClass = "";
			$subject_teachers->subjectTeacherID->ViewCustomAttributes = "";

			// subjectID
			if (strval($subject_teachers->subjectID->CurrentValue) <> "") {
				$sFilterWrk = "`subjectID` = " . ew_AdjustSql($subject_teachers->subjectID->CurrentValue) . "";
			$sSqlWrk = "SELECT `subjectName`, `subjectDescription` FROM `subjects`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `subjectName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subject_teachers->subjectID->ViewValue = $rswrk->fields('subjectName');
					$subject_teachers->subjectID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('subjectDescription');
					$rswrk->Close();
				} else {
					$subject_teachers->subjectID->ViewValue = $subject_teachers->subjectID->CurrentValue;
				}
			} else {
				$subject_teachers->subjectID->ViewValue = NULL;
			}
			$subject_teachers->subjectID->CssStyle = "";
			$subject_teachers->subjectID->CssClass = "";
			$subject_teachers->subjectID->ViewCustomAttributes = "";

			// subjectTeacher
			if (strval($subject_teachers->subjectTeacher->CurrentValue) <> "") {
				$sFilterWrk = "`teacherID` = " . ew_AdjustSql($subject_teachers->subjectTeacher->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `teachers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subject_teachers->subjectTeacher->ViewValue = $rswrk->fields('firstname');
					$subject_teachers->subjectTeacher->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$subject_teachers->subjectTeacher->ViewValue = $subject_teachers->subjectTeacher->CurrentValue;
				}
			} else {
				$subject_teachers->subjectTeacher->ViewValue = NULL;
			}
			$subject_teachers->subjectTeacher->CssStyle = "";
			$subject_teachers->subjectTeacher->CssClass = "";
			$subject_teachers->subjectTeacher->ViewCustomAttributes = "";

			// classroomID
			if (strval($subject_teachers->classroomID->CurrentValue) <> "") {
				$sFilterWrk = "`classID` = " . ew_AdjustSql($subject_teachers->classroomID->CurrentValue) . "";
			$sSqlWrk = "SELECT `className`, `classTeacher` FROM `class_rooms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subject_teachers->classroomID->ViewValue = $rswrk->fields('className');
					$subject_teachers->classroomID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('classTeacher');
					$rswrk->Close();
				} else {
					$subject_teachers->classroomID->ViewValue = $subject_teachers->classroomID->CurrentValue;
				}
			} else {
				$subject_teachers->classroomID->ViewValue = NULL;
			}
			$subject_teachers->classroomID->CssStyle = "";
			$subject_teachers->classroomID->CssClass = "";
			$subject_teachers->classroomID->ViewCustomAttributes = "";

			// status
			if (strval($subject_teachers->status->CurrentValue) <> "") {
				switch ($subject_teachers->status->CurrentValue) {
					case "1":
						$subject_teachers->status->ViewValue = "Enabled";
						break;
					case "0":
						$subject_teachers->status->ViewValue = "Disabled";
						break;
					default:
						$subject_teachers->status->ViewValue = $subject_teachers->status->CurrentValue;
				}
			} else {
				$subject_teachers->status->ViewValue = NULL;
			}
			$subject_teachers->status->CssStyle = "";
			$subject_teachers->status->CssClass = "";
			$subject_teachers->status->ViewCustomAttributes = "";

			// subjectTeacherID
			$subject_teachers->subjectTeacherID->HrefValue = "";
			$subject_teachers->subjectTeacherID->TooltipValue = "";

			// subjectID
			$subject_teachers->subjectID->HrefValue = "";
			$subject_teachers->subjectID->TooltipValue = "";

			// subjectTeacher
			$subject_teachers->subjectTeacher->HrefValue = "";
			$subject_teachers->subjectTeacher->TooltipValue = "";

			// classroomID
			$subject_teachers->classroomID->HrefValue = "";
			$subject_teachers->classroomID->TooltipValue = "";

			// status
			$subject_teachers->status->HrefValue = "";
			$subject_teachers->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subject_teachers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subject_teachers->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $subject_teachers;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $subject_teachers->SelectRecordCount();
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
		if ($subject_teachers->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($subject_teachers, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($subject_teachers->subjectTeacherID);
				$ExportDoc->ExportCaption($subject_teachers->subjectID);
				$ExportDoc->ExportCaption($subject_teachers->subjectTeacher);
				$ExportDoc->ExportCaption($subject_teachers->classroomID);
				$ExportDoc->ExportCaption($subject_teachers->status);
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
				$subject_teachers->CssClass = "";
				$subject_teachers->CssStyle = "";
				$subject_teachers->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($subject_teachers->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('subjectTeacherID', $subject_teachers->subjectTeacherID->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
					$XmlDoc->AddField('subjectID', $subject_teachers->subjectID->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
					$XmlDoc->AddField('subjectTeacher', $subject_teachers->subjectTeacher->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
					$XmlDoc->AddField('classroomID', $subject_teachers->classroomID->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
					$XmlDoc->AddField('status', $subject_teachers->status->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($subject_teachers->subjectTeacherID);
					$ExportDoc->ExportField($subject_teachers->subjectID);
					$ExportDoc->ExportField($subject_teachers->subjectTeacher);
					$ExportDoc->ExportField($subject_teachers->classroomID);
					$ExportDoc->ExportField($subject_teachers->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($subject_teachers->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($subject_teachers->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($subject_teachers->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($subject_teachers->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($subject_teachers->ExportReturnUrl());
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
