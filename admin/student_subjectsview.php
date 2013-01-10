<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "student_subjectsinfo.php" ?>
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
$student_subjects_view = new cstudent_subjects_view();
$Page =& $student_subjects_view;

// Page init
$student_subjects_view->Page_Init();

// Page main
$student_subjects_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($student_subjects->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var student_subjects_view = new ew_Page("student_subjects_view");

// page properties
student_subjects_view.PageID = "view"; // page ID
student_subjects_view.FormID = "fstudent_subjectsview"; // form ID
var EW_PAGE_ID = student_subjects_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
student_subjects_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
student_subjects_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
student_subjects_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
student_subjects_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $student_subjects->TableCaption() ?>
<?php if ($student_subjects->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $student_subjects_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $student_subjects_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $student_subjects_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $student_subjects_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($student_subjects->Export == "") { ?>
<a href="<?php echo $student_subjects_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $student_subjects_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $student_subjects_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $student_subjects_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $student_subjects_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$student_subjects_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($student_subjects->studentSubjectID->Visible) { // studentSubjectID ?>
	<tr<?php echo $student_subjects->studentSubjectID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->studentSubjectID->FldCaption() ?></td>
		<td<?php echo $student_subjects->studentSubjectID->CellAttributes() ?>>
<div<?php echo $student_subjects->studentSubjectID->ViewAttributes() ?>><?php echo $student_subjects->studentSubjectID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->studentID->Visible) { // studentID ?>
	<tr<?php echo $student_subjects->studentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->studentID->FldCaption() ?></td>
		<td<?php echo $student_subjects->studentID->CellAttributes() ?>>
<div<?php echo $student_subjects->studentID->ViewAttributes() ?>><?php echo $student_subjects->studentID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->subjectTeacherID->Visible) { // subjectTeacherID ?>
	<tr<?php echo $student_subjects->subjectTeacherID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->subjectTeacherID->FldCaption() ?></td>
		<td<?php echo $student_subjects->subjectTeacherID->CellAttributes() ?>>
</td>
	</tr>
<?php } ?>
<?php if ($student_subjects->termID->Visible) { // termID ?>
	<tr<?php echo $student_subjects->termID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->termID->FldCaption() ?></td>
		<td<?php echo $student_subjects->termID->CellAttributes() ?>>
<div<?php echo $student_subjects->termID->ViewAttributes() ?>><?php echo $student_subjects->termID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->vClassID->Visible) { // vClassID ?>
	<tr<?php echo $student_subjects->vClassID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->vClassID->FldCaption() ?></td>
		<td<?php echo $student_subjects->vClassID->CellAttributes() ?>>
<div<?php echo $student_subjects->vClassID->ViewAttributes() ?>><?php echo $student_subjects->vClassID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->caScore->Visible) { // caScore ?>
	<tr<?php echo $student_subjects->caScore->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->caScore->FldCaption() ?></td>
		<td<?php echo $student_subjects->caScore->CellAttributes() ?>>
<div<?php echo $student_subjects->caScore->ViewAttributes() ?>><?php echo $student_subjects->caScore->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->examScore->Visible) { // examScore ?>
	<tr<?php echo $student_subjects->examScore->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->examScore->FldCaption() ?></td>
		<td<?php echo $student_subjects->examScore->CellAttributes() ?>>
<div<?php echo $student_subjects->examScore->ViewAttributes() ?>><?php echo $student_subjects->examScore->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->grade->Visible) { // grade ?>
	<tr<?php echo $student_subjects->grade->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->grade->FldCaption() ?></td>
		<td<?php echo $student_subjects->grade->CellAttributes() ?>>
<div<?php echo $student_subjects->grade->ViewAttributes() ?>><?php echo $student_subjects->grade->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->comments->Visible) { // comments ?>
	<tr<?php echo $student_subjects->comments->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->comments->FldCaption() ?></td>
		<td<?php echo $student_subjects->comments->CellAttributes() ?>>
<div<?php echo $student_subjects->comments->ViewAttributes() ?>><?php echo $student_subjects->comments->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->status->Visible) { // status ?>
	<tr<?php echo $student_subjects->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->status->FldCaption() ?></td>
		<td<?php echo $student_subjects->status->CellAttributes() ?>>
<div<?php echo $student_subjects->status->ViewAttributes() ?>><?php echo $student_subjects->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($student_subjects->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$student_subjects_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudent_subjects_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'student_subjects';

	// Page object name
	var $PageObjName = 'student_subjects_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $student_subjects;
		if ($student_subjects->UseTokenInUrl) $PageUrl .= "t=" . $student_subjects->TableVar . "&"; // Add page token
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
		global $objForm, $student_subjects;
		if ($student_subjects->UseTokenInUrl) {
			if ($objForm)
				return ($student_subjects->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($student_subjects->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudent_subjects_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (student_subjects)
		$GLOBALS["student_subjects"] = new cstudent_subjects();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'student_subjects', TRUE);

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
		global $student_subjects;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$student_subjects->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$student_subjects->Export = $_POST["exporttype"];
		} else {
			$student_subjects->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $student_subjects->Export; // Get export parameter, used in header
		$gsExportFile = $student_subjects->TableVar; // Get export file, used in header
		if (@$_GET["studentSubjectID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["studentSubjectID"]);
		}
		if ($student_subjects->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($student_subjects->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($student_subjects->Export == "csv") {
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
		global $Language, $student_subjects;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["studentSubjectID"] <> "") {
				$student_subjects->studentSubjectID->setQueryStringValue($_GET["studentSubjectID"]);
				$this->arRecKey["studentSubjectID"] = $student_subjects->studentSubjectID->QueryStringValue;
			} else {
				$sReturnUrl = "student_subjectslist.php"; // Return to list
			}

			// Get action
			$student_subjects->CurrentAction = "I"; // Display form
			switch ($student_subjects->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "student_subjectslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($student_subjects->Export, array("html","word","excel","xml","csv","email"))) {
				if ($student_subjects->Export == "email" && $student_subjects->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$student_subjects->setExportReturnUrl($student_subjects->ViewUrl()); // Add key
				$this->ExportData();
				if ($student_subjects->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "student_subjectslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$student_subjects->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $student_subjects;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$student_subjects->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$student_subjects->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $student_subjects->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$student_subjects->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$student_subjects->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$student_subjects->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $student_subjects;

		// Call Recordset Selecting event
		$student_subjects->Recordset_Selecting($student_subjects->CurrentFilter);

		// Load List page SQL
		$sSql = $student_subjects->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$student_subjects->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $student_subjects;
		$sFilter = $student_subjects->KeyFilter();

		// Call Row Selecting event
		$student_subjects->Row_Selecting($sFilter);

		// Load SQL based on filter
		$student_subjects->CurrentFilter = $sFilter;
		$sSql = $student_subjects->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$student_subjects->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $student_subjects;
		$student_subjects->studentSubjectID->setDbValue($rs->fields('studentSubjectID'));
		$student_subjects->studentID->setDbValue($rs->fields('studentID'));
		$student_subjects->subjectTeacherID->setDbValue($rs->fields('subjectTeacherID'));
		$student_subjects->termID->setDbValue($rs->fields('termID'));
		$student_subjects->vClassID->setDbValue($rs->fields('vClassID'));
		$student_subjects->caScore->setDbValue($rs->fields('caScore'));
		$student_subjects->examScore->setDbValue($rs->fields('examScore'));
		$student_subjects->grade->setDbValue($rs->fields('grade'));
		$student_subjects->comments->setDbValue($rs->fields('comments'));
		$student_subjects->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $student_subjects;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "studentSubjectID=" . urlencode($student_subjects->studentSubjectID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "studentSubjectID=" . urlencode($student_subjects->studentSubjectID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "studentSubjectID=" . urlencode($student_subjects->studentSubjectID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "studentSubjectID=" . urlencode($student_subjects->studentSubjectID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "studentSubjectID=" . urlencode($student_subjects->studentSubjectID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "studentSubjectID=" . urlencode($student_subjects->studentSubjectID->CurrentValue);
		$this->AddUrl = $student_subjects->AddUrl();
		$this->EditUrl = $student_subjects->EditUrl();
		$this->CopyUrl = $student_subjects->CopyUrl();
		$this->DeleteUrl = $student_subjects->DeleteUrl();
		$this->ListUrl = $student_subjects->ListUrl();

		// Call Row_Rendering event
		$student_subjects->Row_Rendering();

		// Common render codes for all row types
		// studentSubjectID

		$student_subjects->studentSubjectID->CellCssStyle = ""; $student_subjects->studentSubjectID->CellCssClass = "";
		$student_subjects->studentSubjectID->CellAttrs = array(); $student_subjects->studentSubjectID->ViewAttrs = array(); $student_subjects->studentSubjectID->EditAttrs = array();

		// studentID
		$student_subjects->studentID->CellCssStyle = ""; $student_subjects->studentID->CellCssClass = "";
		$student_subjects->studentID->CellAttrs = array(); $student_subjects->studentID->ViewAttrs = array(); $student_subjects->studentID->EditAttrs = array();

		// subjectTeacherID
		$student_subjects->subjectTeacherID->CellCssStyle = ""; $student_subjects->subjectTeacherID->CellCssClass = "";
		$student_subjects->subjectTeacherID->CellAttrs = array(); $student_subjects->subjectTeacherID->ViewAttrs = array(); $student_subjects->subjectTeacherID->EditAttrs = array();

		// termID
		$student_subjects->termID->CellCssStyle = ""; $student_subjects->termID->CellCssClass = "";
		$student_subjects->termID->CellAttrs = array(); $student_subjects->termID->ViewAttrs = array(); $student_subjects->termID->EditAttrs = array();

		// vClassID
		$student_subjects->vClassID->CellCssStyle = ""; $student_subjects->vClassID->CellCssClass = "";
		$student_subjects->vClassID->CellAttrs = array(); $student_subjects->vClassID->ViewAttrs = array(); $student_subjects->vClassID->EditAttrs = array();

		// caScore
		$student_subjects->caScore->CellCssStyle = ""; $student_subjects->caScore->CellCssClass = "";
		$student_subjects->caScore->CellAttrs = array(); $student_subjects->caScore->ViewAttrs = array(); $student_subjects->caScore->EditAttrs = array();

		// examScore
		$student_subjects->examScore->CellCssStyle = ""; $student_subjects->examScore->CellCssClass = "";
		$student_subjects->examScore->CellAttrs = array(); $student_subjects->examScore->ViewAttrs = array(); $student_subjects->examScore->EditAttrs = array();

		// grade
		$student_subjects->grade->CellCssStyle = ""; $student_subjects->grade->CellCssClass = "";
		$student_subjects->grade->CellAttrs = array(); $student_subjects->grade->ViewAttrs = array(); $student_subjects->grade->EditAttrs = array();

		// comments
		$student_subjects->comments->CellCssStyle = ""; $student_subjects->comments->CellCssClass = "";
		$student_subjects->comments->CellAttrs = array(); $student_subjects->comments->ViewAttrs = array(); $student_subjects->comments->EditAttrs = array();

		// status
		$student_subjects->status->CellCssStyle = ""; $student_subjects->status->CellCssClass = "";
		$student_subjects->status->CellAttrs = array(); $student_subjects->status->ViewAttrs = array(); $student_subjects->status->EditAttrs = array();
		if ($student_subjects->RowType == EW_ROWTYPE_VIEW) { // View row

			// studentSubjectID
			$student_subjects->studentSubjectID->ViewValue = $student_subjects->studentSubjectID->CurrentValue;
			$student_subjects->studentSubjectID->CssStyle = "";
			$student_subjects->studentSubjectID->CssClass = "";
			$student_subjects->studentSubjectID->ViewCustomAttributes = "";

			// studentID
			if (strval($student_subjects->studentID->CurrentValue) <> "") {
				$sFilterWrk = "`studentID` = " . ew_AdjustSql($student_subjects->studentID->CurrentValue) . "";
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
					$student_subjects->studentID->ViewValue = $rswrk->fields('firstname');
					$student_subjects->studentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$student_subjects->studentID->ViewValue = $student_subjects->studentID->CurrentValue;
				}
			} else {
				$student_subjects->studentID->ViewValue = NULL;
			}
			$student_subjects->studentID->CssStyle = "";
			$student_subjects->studentID->CssClass = "";
			$student_subjects->studentID->ViewCustomAttributes = "";

			// subjectTeacherID
			$student_subjects->subjectTeacherID->CssStyle = "";
			$student_subjects->subjectTeacherID->CssClass = "";
			$student_subjects->subjectTeacherID->ViewCustomAttributes = "";

			// termID
			$student_subjects->termID->ViewValue = $student_subjects->termID->CurrentValue;
			$student_subjects->termID->CssStyle = "";
			$student_subjects->termID->CssClass = "";
			$student_subjects->termID->ViewCustomAttributes = "";

			// vClassID
			$student_subjects->vClassID->ViewValue = $student_subjects->vClassID->CurrentValue;
			$student_subjects->vClassID->CssStyle = "";
			$student_subjects->vClassID->CssClass = "";
			$student_subjects->vClassID->ViewCustomAttributes = "";

			// caScore
			$student_subjects->caScore->ViewValue = $student_subjects->caScore->CurrentValue;
			$student_subjects->caScore->CssStyle = "";
			$student_subjects->caScore->CssClass = "";
			$student_subjects->caScore->ViewCustomAttributes = "";

			// examScore
			$student_subjects->examScore->ViewValue = $student_subjects->examScore->CurrentValue;
			$student_subjects->examScore->CssStyle = "";
			$student_subjects->examScore->CssClass = "";
			$student_subjects->examScore->ViewCustomAttributes = "";

			// grade
			$student_subjects->grade->ViewValue = $student_subjects->grade->CurrentValue;
			$student_subjects->grade->CssStyle = "";
			$student_subjects->grade->CssClass = "";
			$student_subjects->grade->ViewCustomAttributes = "";

			// comments
			$student_subjects->comments->ViewValue = $student_subjects->comments->CurrentValue;
			$student_subjects->comments->CssStyle = "";
			$student_subjects->comments->CssClass = "";
			$student_subjects->comments->ViewCustomAttributes = "";

			// status
			if (strval($student_subjects->status->CurrentValue) <> "") {
				switch ($student_subjects->status->CurrentValue) {
					case "1":
						$student_subjects->status->ViewValue = "Enabled";
						break;
					case "0":
						$student_subjects->status->ViewValue = "Disabled";
						break;
					default:
						$student_subjects->status->ViewValue = $student_subjects->status->CurrentValue;
				}
			} else {
				$student_subjects->status->ViewValue = NULL;
			}
			$student_subjects->status->CssStyle = "";
			$student_subjects->status->CssClass = "";
			$student_subjects->status->ViewCustomAttributes = "";

			// studentSubjectID
			$student_subjects->studentSubjectID->HrefValue = "";
			$student_subjects->studentSubjectID->TooltipValue = "";

			// studentID
			$student_subjects->studentID->HrefValue = "";
			$student_subjects->studentID->TooltipValue = "";

			// subjectTeacherID
			$student_subjects->subjectTeacherID->HrefValue = "";
			$student_subjects->subjectTeacherID->TooltipValue = "";

			// termID
			$student_subjects->termID->HrefValue = "";
			$student_subjects->termID->TooltipValue = "";

			// vClassID
			$student_subjects->vClassID->HrefValue = "";
			$student_subjects->vClassID->TooltipValue = "";

			// caScore
			$student_subjects->caScore->HrefValue = "";
			$student_subjects->caScore->TooltipValue = "";

			// examScore
			$student_subjects->examScore->HrefValue = "";
			$student_subjects->examScore->TooltipValue = "";

			// grade
			$student_subjects->grade->HrefValue = "";
			$student_subjects->grade->TooltipValue = "";

			// comments
			$student_subjects->comments->HrefValue = "";
			$student_subjects->comments->TooltipValue = "";

			// status
			$student_subjects->status->HrefValue = "";
			$student_subjects->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($student_subjects->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$student_subjects->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $student_subjects;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $student_subjects->SelectRecordCount();
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
		if ($student_subjects->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($student_subjects, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($student_subjects->studentSubjectID);
				$ExportDoc->ExportCaption($student_subjects->studentID);
				$ExportDoc->ExportCaption($student_subjects->subjectTeacherID);
				$ExportDoc->ExportCaption($student_subjects->termID);
				$ExportDoc->ExportCaption($student_subjects->vClassID);
				$ExportDoc->ExportCaption($student_subjects->caScore);
				$ExportDoc->ExportCaption($student_subjects->examScore);
				$ExportDoc->ExportCaption($student_subjects->grade);
				$ExportDoc->ExportCaption($student_subjects->comments);
				$ExportDoc->ExportCaption($student_subjects->status);
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
				$student_subjects->CssClass = "";
				$student_subjects->CssStyle = "";
				$student_subjects->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($student_subjects->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('studentSubjectID', $student_subjects->studentSubjectID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('studentID', $student_subjects->studentID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('subjectTeacherID', $student_subjects->subjectTeacherID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('termID', $student_subjects->termID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('vClassID', $student_subjects->vClassID->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('caScore', $student_subjects->caScore->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('examScore', $student_subjects->examScore->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('grade', $student_subjects->grade->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('comments', $student_subjects->comments->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
					$XmlDoc->AddField('status', $student_subjects->status->ExportValue($student_subjects->Export, $student_subjects->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($student_subjects->studentSubjectID);
					$ExportDoc->ExportField($student_subjects->studentID);
					$ExportDoc->ExportField($student_subjects->subjectTeacherID);
					$ExportDoc->ExportField($student_subjects->termID);
					$ExportDoc->ExportField($student_subjects->vClassID);
					$ExportDoc->ExportField($student_subjects->caScore);
					$ExportDoc->ExportField($student_subjects->examScore);
					$ExportDoc->ExportField($student_subjects->grade);
					$ExportDoc->ExportField($student_subjects->comments);
					$ExportDoc->ExportField($student_subjects->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($student_subjects->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($student_subjects->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($student_subjects->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($student_subjects->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($student_subjects->ExportReturnUrl());
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
