<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "studentsinfo.php" ?>
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
$students_view = new cstudents_view();
$Page =& $students_view;

// Page init
$students_view->Page_Init();

// Page main
$students_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($students->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var students_view = new ew_Page("students_view");

// page properties
students_view.PageID = "view"; // page ID
students_view.FormID = "fstudentsview"; // form ID
var EW_PAGE_ID = students_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
students_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
students_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
students_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
students_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $students->TableCaption() ?>
<?php if ($students->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $students_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $students_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $students_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $students_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($students->Export == "") { ?>
<a href="<?php echo $students_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $students_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $students_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $students_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $students_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$students_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($students->studentID->Visible) { // studentID ?>
	<tr<?php echo $students->studentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->studentID->FldCaption() ?></td>
		<td<?php echo $students->studentID->CellAttributes() ?>>
<div<?php echo $students->studentID->ViewAttributes() ?>><?php echo $students->studentID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->admissionNumber->Visible) { // admissionNumber ?>
	<tr<?php echo $students->admissionNumber->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->admissionNumber->FldCaption() ?></td>
		<td<?php echo $students->admissionNumber->CellAttributes() ?>>
<div<?php echo $students->admissionNumber->ViewAttributes() ?>><?php echo $students->admissionNumber->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->firstname->Visible) { // firstname ?>
	<tr<?php echo $students->firstname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->firstname->FldCaption() ?></td>
		<td<?php echo $students->firstname->CellAttributes() ?>>
<div<?php echo $students->firstname->ViewAttributes() ?>><?php echo $students->firstname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->middlename->Visible) { // middlename ?>
	<tr<?php echo $students->middlename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->middlename->FldCaption() ?></td>
		<td<?php echo $students->middlename->CellAttributes() ?>>
<div<?php echo $students->middlename->ViewAttributes() ?>><?php echo $students->middlename->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->lastname->Visible) { // lastname ?>
	<tr<?php echo $students->lastname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->lastname->FldCaption() ?></td>
		<td<?php echo $students->lastname->CellAttributes() ?>>
<div<?php echo $students->lastname->ViewAttributes() ?>><?php echo $students->lastname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->gender->Visible) { // gender ?>
	<tr<?php echo $students->gender->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->gender->FldCaption() ?></td>
		<td<?php echo $students->gender->CellAttributes() ?>>
<div<?php echo $students->gender->ViewAttributes() ?>><?php echo $students->gender->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->dob->Visible) { // dob ?>
	<tr<?php echo $students->dob->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->dob->FldCaption() ?></td>
		<td<?php echo $students->dob->CellAttributes() ?>>
<div<?php echo $students->dob->ViewAttributes() ?>><?php echo $students->dob->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->residentialAddress->Visible) { // residentialAddress ?>
	<tr<?php echo $students->residentialAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->residentialAddress->FldCaption() ?></td>
		<td<?php echo $students->residentialAddress->CellAttributes() ?>>
<div<?php echo $students->residentialAddress->ViewAttributes() ?>><?php echo $students->residentialAddress->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->residentState->Visible) { // residentState ?>
	<tr<?php echo $students->residentState->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->residentState->FldCaption() ?></td>
		<td<?php echo $students->residentState->CellAttributes() ?>>
<div<?php echo $students->residentState->ViewAttributes() ?>><?php echo $students->residentState->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->stateOfOrigin->Visible) { // stateOfOrigin ?>
	<tr<?php echo $students->stateOfOrigin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->stateOfOrigin->FldCaption() ?></td>
		<td<?php echo $students->stateOfOrigin->CellAttributes() ?>>
<div<?php echo $students->stateOfOrigin->ViewAttributes() ?>><?php echo $students->stateOfOrigin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->currentClass->Visible) { // currentClass ?>
	<tr<?php echo $students->currentClass->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->currentClass->FldCaption() ?></td>
		<td<?php echo $students->currentClass->CellAttributes() ?>>
<div<?php echo $students->currentClass->ViewAttributes() ?>><?php echo $students->currentClass->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->parentID->Visible) { // parentID ?>
	<tr<?php echo $students->parentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->parentID->FldCaption() ?></td>
		<td<?php echo $students->parentID->CellAttributes() ?>>
<div<?php echo $students->parentID->ViewAttributes() ?>><?php echo $students->parentID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->studentImage->Visible) { // studentImage ?>
	<tr<?php echo $students->studentImage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->studentImage->FldCaption() ?></td>
		<td<?php echo $students->studentImage->CellAttributes() ?>>
<?php if ($students->studentImage->HrefValue <> "" || $students->studentImage->TooltipValue <> "") { ?>
<?php if (!empty($students->studentImage->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $students->studentImage->UploadPath) . $students->studentImage->Upload->DbValue ?>" border=0<?php echo $students->studentImage->ViewAttributes() ?>>
<?php } elseif (!in_array($students->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($students->studentImage->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $students->studentImage->UploadPath) . $students->studentImage->Upload->DbValue ?>" border=0<?php echo $students->studentImage->ViewAttributes() ?>>
<?php } elseif (!in_array($students->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php if ($students->feesCreditBalance->Visible) { // feesCreditBalance ?>
	<tr<?php echo $students->feesCreditBalance->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->feesCreditBalance->FldCaption() ?></td>
		<td<?php echo $students->feesCreditBalance->CellAttributes() ?>>
<div<?php echo $students->feesCreditBalance->ViewAttributes() ?>><?php echo $students->feesCreditBalance->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($students->status->Visible) { // status ?>
	<tr<?php echo $students->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->status->FldCaption() ?></td>
		<td<?php echo $students->status->CellAttributes() ?>>
<div<?php echo $students->status->ViewAttributes() ?>><?php echo $students->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($students->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$students_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudents_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'students';

	// Page object name
	var $PageObjName = 'students_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $students;
		if ($students->UseTokenInUrl) $PageUrl .= "t=" . $students->TableVar . "&"; // Add page token
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
		global $objForm, $students;
		if ($students->UseTokenInUrl) {
			if ($objForm)
				return ($students->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($students->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudents_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (students)
		$GLOBALS["students"] = new cstudents();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'students', TRUE);

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
		global $students;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$students->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$students->Export = $_POST["exporttype"];
		} else {
			$students->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $students->Export; // Get export parameter, used in header
		$gsExportFile = $students->TableVar; // Get export file, used in header
		if (@$_GET["studentID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["studentID"]);
		}
		if ($students->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($students->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($students->Export == "csv") {
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
		global $Language, $students;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["studentID"] <> "") {
				$students->studentID->setQueryStringValue($_GET["studentID"]);
				$this->arRecKey["studentID"] = $students->studentID->QueryStringValue;
			} else {
				$sReturnUrl = "studentslist.php"; // Return to list
			}

			// Get action
			$students->CurrentAction = "I"; // Display form
			switch ($students->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "studentslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($students->Export, array("html","word","excel","xml","csv","email"))) {
				if ($students->Export == "email" && $students->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$students->setExportReturnUrl($students->ViewUrl()); // Add key
				$this->ExportData();
				if ($students->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "studentslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$students->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $students;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$students->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$students->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $students->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$students->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$students->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$students->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $students;

		// Call Recordset Selecting event
		$students->Recordset_Selecting($students->CurrentFilter);

		// Load List page SQL
		$sSql = $students->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$students->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $students;
		$sFilter = $students->KeyFilter();

		// Call Row Selecting event
		$students->Row_Selecting($sFilter);

		// Load SQL based on filter
		$students->CurrentFilter = $sFilter;
		$sSql = $students->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$students->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $students;
		$students->studentID->setDbValue($rs->fields('studentID'));
		$students->admissionNumber->setDbValue($rs->fields('admissionNumber'));
		$students->firstname->setDbValue($rs->fields('firstname'));
		$students->middlename->setDbValue($rs->fields('middlename'));
		$students->lastname->setDbValue($rs->fields('lastname'));
		$students->gender->setDbValue($rs->fields('gender'));
		$students->dob->setDbValue($rs->fields('dob'));
		$students->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$students->residentState->setDbValue($rs->fields('residentState'));
		$students->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$students->currentClass->setDbValue($rs->fields('currentClass'));
		$students->portalUsername->setDbValue($rs->fields('portalUsername'));
		$students->portalPassword->setDbValue($rs->fields('portalPassword'));
		$students->parentID->setDbValue($rs->fields('parentID'));
		$students->studentImage->Upload->DbValue = $rs->fields('studentImage');
		$students->feesCreditBalance->setDbValue($rs->fields('feesCreditBalance'));
		$students->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $students;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "studentID=" . urlencode($students->studentID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "studentID=" . urlencode($students->studentID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "studentID=" . urlencode($students->studentID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "studentID=" . urlencode($students->studentID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "studentID=" . urlencode($students->studentID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "studentID=" . urlencode($students->studentID->CurrentValue);
		$this->AddUrl = $students->AddUrl();
		$this->EditUrl = $students->EditUrl();
		$this->CopyUrl = $students->CopyUrl();
		$this->DeleteUrl = $students->DeleteUrl();
		$this->ListUrl = $students->ListUrl();

		// Call Row_Rendering event
		$students->Row_Rendering();

		// Common render codes for all row types
		// studentID

		$students->studentID->CellCssStyle = ""; $students->studentID->CellCssClass = "";
		$students->studentID->CellAttrs = array(); $students->studentID->ViewAttrs = array(); $students->studentID->EditAttrs = array();

		// admissionNumber
		$students->admissionNumber->CellCssStyle = ""; $students->admissionNumber->CellCssClass = "";
		$students->admissionNumber->CellAttrs = array(); $students->admissionNumber->ViewAttrs = array(); $students->admissionNumber->EditAttrs = array();

		// firstname
		$students->firstname->CellCssStyle = ""; $students->firstname->CellCssClass = "";
		$students->firstname->CellAttrs = array(); $students->firstname->ViewAttrs = array(); $students->firstname->EditAttrs = array();

		// middlename
		$students->middlename->CellCssStyle = ""; $students->middlename->CellCssClass = "";
		$students->middlename->CellAttrs = array(); $students->middlename->ViewAttrs = array(); $students->middlename->EditAttrs = array();

		// lastname
		$students->lastname->CellCssStyle = ""; $students->lastname->CellCssClass = "";
		$students->lastname->CellAttrs = array(); $students->lastname->ViewAttrs = array(); $students->lastname->EditAttrs = array();

		// gender
		$students->gender->CellCssStyle = ""; $students->gender->CellCssClass = "";
		$students->gender->CellAttrs = array(); $students->gender->ViewAttrs = array(); $students->gender->EditAttrs = array();

		// dob
		$students->dob->CellCssStyle = ""; $students->dob->CellCssClass = "";
		$students->dob->CellAttrs = array(); $students->dob->ViewAttrs = array(); $students->dob->EditAttrs = array();

		// residentialAddress
		$students->residentialAddress->CellCssStyle = ""; $students->residentialAddress->CellCssClass = "";
		$students->residentialAddress->CellAttrs = array(); $students->residentialAddress->ViewAttrs = array(); $students->residentialAddress->EditAttrs = array();

		// residentState
		$students->residentState->CellCssStyle = ""; $students->residentState->CellCssClass = "";
		$students->residentState->CellAttrs = array(); $students->residentState->ViewAttrs = array(); $students->residentState->EditAttrs = array();

		// stateOfOrigin
		$students->stateOfOrigin->CellCssStyle = ""; $students->stateOfOrigin->CellCssClass = "";
		$students->stateOfOrigin->CellAttrs = array(); $students->stateOfOrigin->ViewAttrs = array(); $students->stateOfOrigin->EditAttrs = array();

		// currentClass
		$students->currentClass->CellCssStyle = ""; $students->currentClass->CellCssClass = "";
		$students->currentClass->CellAttrs = array(); $students->currentClass->ViewAttrs = array(); $students->currentClass->EditAttrs = array();

		// parentID
		$students->parentID->CellCssStyle = ""; $students->parentID->CellCssClass = "";
		$students->parentID->CellAttrs = array(); $students->parentID->ViewAttrs = array(); $students->parentID->EditAttrs = array();

		// studentImage
		$students->studentImage->CellCssStyle = ""; $students->studentImage->CellCssClass = "";
		$students->studentImage->CellAttrs = array(); $students->studentImage->ViewAttrs = array(); $students->studentImage->EditAttrs = array();

		// feesCreditBalance
		$students->feesCreditBalance->CellCssStyle = ""; $students->feesCreditBalance->CellCssClass = "";
		$students->feesCreditBalance->CellAttrs = array(); $students->feesCreditBalance->ViewAttrs = array(); $students->feesCreditBalance->EditAttrs = array();

		// status
		$students->status->CellCssStyle = ""; $students->status->CellCssClass = "";
		$students->status->CellAttrs = array(); $students->status->ViewAttrs = array(); $students->status->EditAttrs = array();
		if ($students->RowType == EW_ROWTYPE_VIEW) { // View row

			// studentID
			$students->studentID->ViewValue = $students->studentID->CurrentValue;
			$students->studentID->CssStyle = "";
			$students->studentID->CssClass = "";
			$students->studentID->ViewCustomAttributes = "";

			// admissionNumber
			$students->admissionNumber->ViewValue = $students->admissionNumber->CurrentValue;
			$students->admissionNumber->CssStyle = "";
			$students->admissionNumber->CssClass = "";
			$students->admissionNumber->ViewCustomAttributes = "";

			// firstname
			$students->firstname->ViewValue = $students->firstname->CurrentValue;
			$students->firstname->CssStyle = "";
			$students->firstname->CssClass = "";
			$students->firstname->ViewCustomAttributes = "";

			// middlename
			$students->middlename->ViewValue = $students->middlename->CurrentValue;
			$students->middlename->CssStyle = "";
			$students->middlename->CssClass = "";
			$students->middlename->ViewCustomAttributes = "";

			// lastname
			$students->lastname->ViewValue = $students->lastname->CurrentValue;
			$students->lastname->CssStyle = "";
			$students->lastname->CssClass = "";
			$students->lastname->ViewCustomAttributes = "";

			// gender
			if (strval($students->gender->CurrentValue) <> "") {
				switch ($students->gender->CurrentValue) {
					case "Male":
						$students->gender->ViewValue = "Male";
						break;
					case "Female":
						$students->gender->ViewValue = "Female";
						break;
					default:
						$students->gender->ViewValue = $students->gender->CurrentValue;
				}
			} else {
				$students->gender->ViewValue = NULL;
			}
			$students->gender->CssStyle = "";
			$students->gender->CssClass = "";
			$students->gender->ViewCustomAttributes = "";

			// dob
			$students->dob->ViewValue = $students->dob->CurrentValue;
			$students->dob->ViewValue = ew_FormatDateTime($students->dob->ViewValue, 5);
			$students->dob->CssStyle = "";
			$students->dob->CssClass = "";
			$students->dob->ViewCustomAttributes = "";

			// residentialAddress
			$students->residentialAddress->ViewValue = $students->residentialAddress->CurrentValue;
			$students->residentialAddress->CssStyle = "";
			$students->residentialAddress->CssClass = "";
			$students->residentialAddress->ViewCustomAttributes = "";

			// residentState
			$students->residentState->ViewValue = $students->residentState->CurrentValue;
			$students->residentState->CssStyle = "";
			$students->residentState->CssClass = "";
			$students->residentState->ViewCustomAttributes = "";

			// stateOfOrigin
			$students->stateOfOrigin->ViewValue = $students->stateOfOrigin->CurrentValue;
			$students->stateOfOrigin->CssStyle = "";
			$students->stateOfOrigin->CssClass = "";
			$students->stateOfOrigin->ViewCustomAttributes = "";

			// currentClass
			if (strval($students->currentClass->CurrentValue) <> "") {
				$sFilterWrk = "`classID` = " . ew_AdjustSql($students->currentClass->CurrentValue) . "";
			$sSqlWrk = "SELECT `className`, `classTeacher` FROM `class_rooms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$students->currentClass->ViewValue = $rswrk->fields('className');
					$students->currentClass->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('classTeacher');
					$rswrk->Close();
				} else {
					$students->currentClass->ViewValue = $students->currentClass->CurrentValue;
				}
			} else {
				$students->currentClass->ViewValue = NULL;
			}
			$students->currentClass->CssStyle = "";
			$students->currentClass->CssClass = "";
			$students->currentClass->ViewCustomAttributes = "";

			// parentID
			if (strval($students->parentID->CurrentValue) <> "") {
				$sFilterWrk = "`parentID` = " . ew_AdjustSql($students->parentID->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `parents`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$students->parentID->ViewValue = $rswrk->fields('firstname');
					$students->parentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$students->parentID->ViewValue = $students->parentID->CurrentValue;
				}
			} else {
				$students->parentID->ViewValue = NULL;
			}
			$students->parentID->CssStyle = "";
			$students->parentID->CssClass = "";
			$students->parentID->ViewCustomAttributes = "";

			// studentImage
			if (!ew_Empty($students->studentImage->Upload->DbValue)) {
				$students->studentImage->ViewValue = $students->studentImage->Upload->DbValue;
				$students->studentImage->ImageAlt = $students->studentImage->FldAlt();
			} else {
				$students->studentImage->ViewValue = "";
			}
			$students->studentImage->CssStyle = "";
			$students->studentImage->CssClass = "";
			$students->studentImage->ViewCustomAttributes = "";

			// feesCreditBalance
			$students->feesCreditBalance->ViewValue = $students->feesCreditBalance->CurrentValue;
			$students->feesCreditBalance->CssStyle = "";
			$students->feesCreditBalance->CssClass = "";
			$students->feesCreditBalance->ViewCustomAttributes = "";

			// status
			if (strval($students->status->CurrentValue) <> "") {
				switch ($students->status->CurrentValue) {
					case "1":
						$students->status->ViewValue = "Enabled";
						break;
					case "0":
						$students->status->ViewValue = "Disabled";
						break;
					default:
						$students->status->ViewValue = $students->status->CurrentValue;
				}
			} else {
				$students->status->ViewValue = NULL;
			}
			$students->status->CssStyle = "";
			$students->status->CssClass = "";
			$students->status->ViewCustomAttributes = "";

			// studentID
			$students->studentID->HrefValue = "";
			$students->studentID->TooltipValue = "";

			// admissionNumber
			$students->admissionNumber->HrefValue = "";
			$students->admissionNumber->TooltipValue = "";

			// firstname
			$students->firstname->HrefValue = "";
			$students->firstname->TooltipValue = "";

			// middlename
			$students->middlename->HrefValue = "";
			$students->middlename->TooltipValue = "";

			// lastname
			$students->lastname->HrefValue = "";
			$students->lastname->TooltipValue = "";

			// gender
			$students->gender->HrefValue = "";
			$students->gender->TooltipValue = "";

			// dob
			$students->dob->HrefValue = "";
			$students->dob->TooltipValue = "";

			// residentialAddress
			$students->residentialAddress->HrefValue = "";
			$students->residentialAddress->TooltipValue = "";

			// residentState
			$students->residentState->HrefValue = "";
			$students->residentState->TooltipValue = "";

			// stateOfOrigin
			$students->stateOfOrigin->HrefValue = "";
			$students->stateOfOrigin->TooltipValue = "";

			// currentClass
			$students->currentClass->HrefValue = "";
			$students->currentClass->TooltipValue = "";

			// parentID
			$students->parentID->HrefValue = "";
			$students->parentID->TooltipValue = "";

			// studentImage
			$students->studentImage->HrefValue = "";
			$students->studentImage->TooltipValue = "";

			// feesCreditBalance
			$students->feesCreditBalance->HrefValue = "";
			$students->feesCreditBalance->TooltipValue = "";

			// status
			$students->status->HrefValue = "";
			$students->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($students->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$students->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $students;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $students->SelectRecordCount();
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
		if ($students->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($students, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($students->studentID);
				$ExportDoc->ExportCaption($students->admissionNumber);
				$ExportDoc->ExportCaption($students->firstname);
				$ExportDoc->ExportCaption($students->middlename);
				$ExportDoc->ExportCaption($students->lastname);
				$ExportDoc->ExportCaption($students->gender);
				$ExportDoc->ExportCaption($students->dob);
				$ExportDoc->ExportCaption($students->residentState);
				$ExportDoc->ExportCaption($students->stateOfOrigin);
				$ExportDoc->ExportCaption($students->currentClass);
				$ExportDoc->ExportCaption($students->parentID);
				$ExportDoc->ExportCaption($students->feesCreditBalance);
				$ExportDoc->ExportCaption($students->status);
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
				$students->CssClass = "";
				$students->CssStyle = "";
				$students->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($students->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('studentID', $students->studentID->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('admissionNumber', $students->admissionNumber->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('firstname', $students->firstname->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('middlename', $students->middlename->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('lastname', $students->lastname->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('gender', $students->gender->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('dob', $students->dob->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('residentState', $students->residentState->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('stateOfOrigin', $students->stateOfOrigin->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('currentClass', $students->currentClass->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('parentID', $students->parentID->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('feesCreditBalance', $students->feesCreditBalance->ExportValue($students->Export, $students->ExportOriginalValue));
					$XmlDoc->AddField('status', $students->status->ExportValue($students->Export, $students->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($students->studentID);
					$ExportDoc->ExportField($students->admissionNumber);
					$ExportDoc->ExportField($students->firstname);
					$ExportDoc->ExportField($students->middlename);
					$ExportDoc->ExportField($students->lastname);
					$ExportDoc->ExportField($students->gender);
					$ExportDoc->ExportField($students->dob);
					$ExportDoc->ExportField($students->residentState);
					$ExportDoc->ExportField($students->stateOfOrigin);
					$ExportDoc->ExportField($students->currentClass);
					$ExportDoc->ExportField($students->parentID);
					$ExportDoc->ExportField($students->feesCreditBalance);
					$ExportDoc->ExportField($students->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($students->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($students->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($students->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($students->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($students->ExportReturnUrl());
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
