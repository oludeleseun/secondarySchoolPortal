<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "teachersinfo.php" ?>
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
$teachers_view = new cteachers_view();
$Page =& $teachers_view;

// Page init
$teachers_view->Page_Init();

// Page main
$teachers_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($teachers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var teachers_view = new ew_Page("teachers_view");

// page properties
teachers_view.PageID = "view"; // page ID
teachers_view.FormID = "fteachersview"; // form ID
var EW_PAGE_ID = teachers_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
teachers_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
teachers_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
teachers_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
teachers_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $teachers->TableCaption() ?>
<?php if ($teachers->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $teachers_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $teachers_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $teachers_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $teachers_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($teachers->Export == "") { ?>
<a href="<?php echo $teachers_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $teachers_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $teachers_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $teachers_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $teachers_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$teachers_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($teachers->teacherID->Visible) { // teacherID ?>
	<tr<?php echo $teachers->teacherID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->teacherID->FldCaption() ?></td>
		<td<?php echo $teachers->teacherID->CellAttributes() ?>>
<div<?php echo $teachers->teacherID->ViewAttributes() ?>><?php echo $teachers->teacherID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->firstname->Visible) { // firstname ?>
	<tr<?php echo $teachers->firstname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->firstname->FldCaption() ?></td>
		<td<?php echo $teachers->firstname->CellAttributes() ?>>
<div<?php echo $teachers->firstname->ViewAttributes() ?>><?php echo $teachers->firstname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->middlename->Visible) { // middlename ?>
	<tr<?php echo $teachers->middlename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->middlename->FldCaption() ?></td>
		<td<?php echo $teachers->middlename->CellAttributes() ?>>
<div<?php echo $teachers->middlename->ViewAttributes() ?>><?php echo $teachers->middlename->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->lastname->Visible) { // lastname ?>
	<tr<?php echo $teachers->lastname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->lastname->FldCaption() ?></td>
		<td<?php echo $teachers->lastname->CellAttributes() ?>>
<div<?php echo $teachers->lastname->ViewAttributes() ?>><?php echo $teachers->lastname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->qualification->Visible) { // qualification ?>
	<tr<?php echo $teachers->qualification->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->qualification->FldCaption() ?></td>
		<td<?php echo $teachers->qualification->CellAttributes() ?>>
<div<?php echo $teachers->qualification->ViewAttributes() ?>><?php echo $teachers->qualification->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->stateOfOrigin->Visible) { // stateOfOrigin ?>
	<tr<?php echo $teachers->stateOfOrigin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->stateOfOrigin->FldCaption() ?></td>
		<td<?php echo $teachers->stateOfOrigin->CellAttributes() ?>>
<div<?php echo $teachers->stateOfOrigin->ViewAttributes() ?>><?php echo $teachers->stateOfOrigin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->aboutTeacher->Visible) { // aboutTeacher ?>
	<tr<?php echo $teachers->aboutTeacher->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->aboutTeacher->FldCaption() ?></td>
		<td<?php echo $teachers->aboutTeacher->CellAttributes() ?>>
<div<?php echo $teachers->aboutTeacher->ViewAttributes() ?>><?php echo $teachers->aboutTeacher->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->residentialAddress->Visible) { // residentialAddress ?>
	<tr<?php echo $teachers->residentialAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->residentialAddress->FldCaption() ?></td>
		<td<?php echo $teachers->residentialAddress->CellAttributes() ?>>
<div<?php echo $teachers->residentialAddress->ViewAttributes() ?>><?php echo $teachers->residentialAddress->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->zemail->Visible) { // email ?>
	<tr<?php echo $teachers->zemail->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->zemail->FldCaption() ?></td>
		<td<?php echo $teachers->zemail->CellAttributes() ?>>
<div<?php echo $teachers->zemail->ViewAttributes() ?>><?php echo $teachers->zemail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->username->Visible) { // username ?>
	<tr<?php echo $teachers->username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->username->FldCaption() ?></td>
		<td<?php echo $teachers->username->CellAttributes() ?>>
<div<?php echo $teachers->username->ViewAttributes() ?>><?php echo $teachers->username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->portalPassword->Visible) { // portalPassword ?>
	<tr<?php echo $teachers->portalPassword->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->portalPassword->FldCaption() ?></td>
		<td<?php echo $teachers->portalPassword->CellAttributes() ?>>
<div<?php echo $teachers->portalPassword->ViewAttributes() ?>><?php echo $teachers->portalPassword->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->status->Visible) { // status ?>
	<tr<?php echo $teachers->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->status->FldCaption() ?></td>
		<td<?php echo $teachers->status->CellAttributes() ?>>
<div<?php echo $teachers->status->ViewAttributes() ?>><?php echo $teachers->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($teachers->teacherImage->Visible) { // teacherImage ?>
	<tr<?php echo $teachers->teacherImage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->teacherImage->FldCaption() ?></td>
		<td<?php echo $teachers->teacherImage->CellAttributes() ?>>
<?php if ($teachers->teacherImage->HrefValue <> "" || $teachers->teacherImage->TooltipValue <> "") { ?>
<?php if (!empty($teachers->teacherImage->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $teachers->teacherImage->UploadPath) . $teachers->teacherImage->Upload->DbValue ?>" border=0<?php echo $teachers->teacherImage->ViewAttributes() ?>>
<?php } elseif (!in_array($teachers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($teachers->teacherImage->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $teachers->teacherImage->UploadPath) . $teachers->teacherImage->Upload->DbValue ?>" border=0<?php echo $teachers->teacherImage->ViewAttributes() ?>>
<?php } elseif (!in_array($teachers->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($teachers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$teachers_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cteachers_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'teachers';

	// Page object name
	var $PageObjName = 'teachers_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $teachers;
		if ($teachers->UseTokenInUrl) $PageUrl .= "t=" . $teachers->TableVar . "&"; // Add page token
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
		global $objForm, $teachers;
		if ($teachers->UseTokenInUrl) {
			if ($objForm)
				return ($teachers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($teachers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cteachers_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (teachers)
		$GLOBALS["teachers"] = new cteachers();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'teachers', TRUE);

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
		global $teachers;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$teachers->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$teachers->Export = $_POST["exporttype"];
		} else {
			$teachers->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $teachers->Export; // Get export parameter, used in header
		$gsExportFile = $teachers->TableVar; // Get export file, used in header
		if (@$_GET["teacherID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["teacherID"]);
		}
		if ($teachers->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($teachers->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($teachers->Export == "csv") {
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
		global $Language, $teachers;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["teacherID"] <> "") {
				$teachers->teacherID->setQueryStringValue($_GET["teacherID"]);
				$this->arRecKey["teacherID"] = $teachers->teacherID->QueryStringValue;
			} else {
				$sReturnUrl = "teacherslist.php"; // Return to list
			}

			// Get action
			$teachers->CurrentAction = "I"; // Display form
			switch ($teachers->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "teacherslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($teachers->Export, array("html","word","excel","xml","csv","email"))) {
				if ($teachers->Export == "email" && $teachers->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$teachers->setExportReturnUrl($teachers->ViewUrl()); // Add key
				$this->ExportData();
				if ($teachers->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "teacherslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$teachers->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $teachers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$teachers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$teachers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $teachers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$teachers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$teachers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$teachers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $teachers;

		// Call Recordset Selecting event
		$teachers->Recordset_Selecting($teachers->CurrentFilter);

		// Load List page SQL
		$sSql = $teachers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$teachers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $teachers;
		$sFilter = $teachers->KeyFilter();

		// Call Row Selecting event
		$teachers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$teachers->CurrentFilter = $sFilter;
		$sSql = $teachers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$teachers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $teachers;
		$teachers->teacherID->setDbValue($rs->fields('teacherID'));
		$teachers->firstname->setDbValue($rs->fields('firstname'));
		$teachers->middlename->setDbValue($rs->fields('middlename'));
		$teachers->lastname->setDbValue($rs->fields('lastname'));
		$teachers->qualification->setDbValue($rs->fields('qualification'));
		$teachers->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$teachers->aboutTeacher->setDbValue($rs->fields('aboutTeacher'));
		$teachers->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$teachers->zemail->setDbValue($rs->fields('email'));
		$teachers->username->setDbValue($rs->fields('username'));
		$teachers->portalPassword->setDbValue($rs->fields('portalPassword'));
		$teachers->status->setDbValue($rs->fields('status'));
		$teachers->teacherImage->Upload->DbValue = $rs->fields('teacherImage');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $teachers;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "teacherID=" . urlencode($teachers->teacherID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "teacherID=" . urlencode($teachers->teacherID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "teacherID=" . urlencode($teachers->teacherID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "teacherID=" . urlencode($teachers->teacherID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "teacherID=" . urlencode($teachers->teacherID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "teacherID=" . urlencode($teachers->teacherID->CurrentValue);
		$this->AddUrl = $teachers->AddUrl();
		$this->EditUrl = $teachers->EditUrl();
		$this->CopyUrl = $teachers->CopyUrl();
		$this->DeleteUrl = $teachers->DeleteUrl();
		$this->ListUrl = $teachers->ListUrl();

		// Call Row_Rendering event
		$teachers->Row_Rendering();

		// Common render codes for all row types
		// teacherID

		$teachers->teacherID->CellCssStyle = ""; $teachers->teacherID->CellCssClass = "";
		$teachers->teacherID->CellAttrs = array(); $teachers->teacherID->ViewAttrs = array(); $teachers->teacherID->EditAttrs = array();

		// firstname
		$teachers->firstname->CellCssStyle = ""; $teachers->firstname->CellCssClass = "";
		$teachers->firstname->CellAttrs = array(); $teachers->firstname->ViewAttrs = array(); $teachers->firstname->EditAttrs = array();

		// middlename
		$teachers->middlename->CellCssStyle = ""; $teachers->middlename->CellCssClass = "";
		$teachers->middlename->CellAttrs = array(); $teachers->middlename->ViewAttrs = array(); $teachers->middlename->EditAttrs = array();

		// lastname
		$teachers->lastname->CellCssStyle = ""; $teachers->lastname->CellCssClass = "";
		$teachers->lastname->CellAttrs = array(); $teachers->lastname->ViewAttrs = array(); $teachers->lastname->EditAttrs = array();

		// qualification
		$teachers->qualification->CellCssStyle = ""; $teachers->qualification->CellCssClass = "";
		$teachers->qualification->CellAttrs = array(); $teachers->qualification->ViewAttrs = array(); $teachers->qualification->EditAttrs = array();

		// stateOfOrigin
		$teachers->stateOfOrigin->CellCssStyle = ""; $teachers->stateOfOrigin->CellCssClass = "";
		$teachers->stateOfOrigin->CellAttrs = array(); $teachers->stateOfOrigin->ViewAttrs = array(); $teachers->stateOfOrigin->EditAttrs = array();

		// aboutTeacher
		$teachers->aboutTeacher->CellCssStyle = ""; $teachers->aboutTeacher->CellCssClass = "";
		$teachers->aboutTeacher->CellAttrs = array(); $teachers->aboutTeacher->ViewAttrs = array(); $teachers->aboutTeacher->EditAttrs = array();

		// residentialAddress
		$teachers->residentialAddress->CellCssStyle = ""; $teachers->residentialAddress->CellCssClass = "";
		$teachers->residentialAddress->CellAttrs = array(); $teachers->residentialAddress->ViewAttrs = array(); $teachers->residentialAddress->EditAttrs = array();

		// email
		$teachers->zemail->CellCssStyle = ""; $teachers->zemail->CellCssClass = "";
		$teachers->zemail->CellAttrs = array(); $teachers->zemail->ViewAttrs = array(); $teachers->zemail->EditAttrs = array();

		// username
		$teachers->username->CellCssStyle = ""; $teachers->username->CellCssClass = "";
		$teachers->username->CellAttrs = array(); $teachers->username->ViewAttrs = array(); $teachers->username->EditAttrs = array();

		// portalPassword
		$teachers->portalPassword->CellCssStyle = ""; $teachers->portalPassword->CellCssClass = "";
		$teachers->portalPassword->CellAttrs = array(); $teachers->portalPassword->ViewAttrs = array(); $teachers->portalPassword->EditAttrs = array();

		// status
		$teachers->status->CellCssStyle = ""; $teachers->status->CellCssClass = "";
		$teachers->status->CellAttrs = array(); $teachers->status->ViewAttrs = array(); $teachers->status->EditAttrs = array();

		// teacherImage
		$teachers->teacherImage->CellCssStyle = ""; $teachers->teacherImage->CellCssClass = "";
		$teachers->teacherImage->CellAttrs = array(); $teachers->teacherImage->ViewAttrs = array(); $teachers->teacherImage->EditAttrs = array();
		if ($teachers->RowType == EW_ROWTYPE_VIEW) { // View row

			// teacherID
			$teachers->teacherID->ViewValue = $teachers->teacherID->CurrentValue;
			$teachers->teacherID->CssStyle = "";
			$teachers->teacherID->CssClass = "";
			$teachers->teacherID->ViewCustomAttributes = "";

			// firstname
			$teachers->firstname->ViewValue = $teachers->firstname->CurrentValue;
			$teachers->firstname->CssStyle = "";
			$teachers->firstname->CssClass = "";
			$teachers->firstname->ViewCustomAttributes = "";

			// middlename
			$teachers->middlename->ViewValue = $teachers->middlename->CurrentValue;
			$teachers->middlename->CssStyle = "";
			$teachers->middlename->CssClass = "";
			$teachers->middlename->ViewCustomAttributes = "";

			// lastname
			$teachers->lastname->ViewValue = $teachers->lastname->CurrentValue;
			$teachers->lastname->CssStyle = "";
			$teachers->lastname->CssClass = "";
			$teachers->lastname->ViewCustomAttributes = "";

			// qualification
			$teachers->qualification->ViewValue = $teachers->qualification->CurrentValue;
			$teachers->qualification->CssStyle = "";
			$teachers->qualification->CssClass = "";
			$teachers->qualification->ViewCustomAttributes = "";

			// stateOfOrigin
			$teachers->stateOfOrigin->ViewValue = $teachers->stateOfOrigin->CurrentValue;
			$teachers->stateOfOrigin->CssStyle = "";
			$teachers->stateOfOrigin->CssClass = "";
			$teachers->stateOfOrigin->ViewCustomAttributes = "";

			// aboutTeacher
			$teachers->aboutTeacher->ViewValue = $teachers->aboutTeacher->CurrentValue;
			$teachers->aboutTeacher->CssStyle = "";
			$teachers->aboutTeacher->CssClass = "";
			$teachers->aboutTeacher->ViewCustomAttributes = "";

			// residentialAddress
			$teachers->residentialAddress->ViewValue = $teachers->residentialAddress->CurrentValue;
			$teachers->residentialAddress->CssStyle = "";
			$teachers->residentialAddress->CssClass = "";
			$teachers->residentialAddress->ViewCustomAttributes = "";

			// email
			$teachers->zemail->ViewValue = $teachers->zemail->CurrentValue;
			$teachers->zemail->CssStyle = "";
			$teachers->zemail->CssClass = "";
			$teachers->zemail->ViewCustomAttributes = "";

			// username
			$teachers->username->ViewValue = $teachers->username->CurrentValue;
			$teachers->username->CssStyle = "";
			$teachers->username->CssClass = "";
			$teachers->username->ViewCustomAttributes = "";

			// portalPassword
			$teachers->portalPassword->ViewValue = "********";
			$teachers->portalPassword->CssStyle = "";
			$teachers->portalPassword->CssClass = "";
			$teachers->portalPassword->ViewCustomAttributes = "";

			// status
			if (strval($teachers->status->CurrentValue) <> "") {
				switch ($teachers->status->CurrentValue) {
					case "1":
						$teachers->status->ViewValue = "Enabled";
						break;
					case "0":
						$teachers->status->ViewValue = "Disabled";
						break;
					default:
						$teachers->status->ViewValue = $teachers->status->CurrentValue;
				}
			} else {
				$teachers->status->ViewValue = NULL;
			}
			$teachers->status->CssStyle = "";
			$teachers->status->CssClass = "";
			$teachers->status->ViewCustomAttributes = "";

			// teacherImage
			if (!ew_Empty($teachers->teacherImage->Upload->DbValue)) {
				$teachers->teacherImage->ViewValue = $teachers->teacherImage->Upload->DbValue;
				$teachers->teacherImage->ImageAlt = $teachers->teacherImage->FldAlt();
			} else {
				$teachers->teacherImage->ViewValue = "";
			}
			$teachers->teacherImage->CssStyle = "";
			$teachers->teacherImage->CssClass = "";
			$teachers->teacherImage->ViewCustomAttributes = "";

			// teacherID
			$teachers->teacherID->HrefValue = "";
			$teachers->teacherID->TooltipValue = "";

			// firstname
			$teachers->firstname->HrefValue = "";
			$teachers->firstname->TooltipValue = "";

			// middlename
			$teachers->middlename->HrefValue = "";
			$teachers->middlename->TooltipValue = "";

			// lastname
			$teachers->lastname->HrefValue = "";
			$teachers->lastname->TooltipValue = "";

			// qualification
			$teachers->qualification->HrefValue = "";
			$teachers->qualification->TooltipValue = "";

			// stateOfOrigin
			$teachers->stateOfOrigin->HrefValue = "";
			$teachers->stateOfOrigin->TooltipValue = "";

			// aboutTeacher
			$teachers->aboutTeacher->HrefValue = "";
			$teachers->aboutTeacher->TooltipValue = "";

			// residentialAddress
			$teachers->residentialAddress->HrefValue = "";
			$teachers->residentialAddress->TooltipValue = "";

			// email
			$teachers->zemail->HrefValue = "";
			$teachers->zemail->TooltipValue = "";

			// username
			$teachers->username->HrefValue = "";
			$teachers->username->TooltipValue = "";

			// portalPassword
			$teachers->portalPassword->HrefValue = "";
			$teachers->portalPassword->TooltipValue = "";

			// status
			$teachers->status->HrefValue = "";
			$teachers->status->TooltipValue = "";

			// teacherImage
			$teachers->teacherImage->HrefValue = "";
			$teachers->teacherImage->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($teachers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$teachers->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $teachers;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $teachers->SelectRecordCount();
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
		if ($teachers->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($teachers, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($teachers->teacherID);
				$ExportDoc->ExportCaption($teachers->firstname);
				$ExportDoc->ExportCaption($teachers->middlename);
				$ExportDoc->ExportCaption($teachers->lastname);
				$ExportDoc->ExportCaption($teachers->qualification);
				$ExportDoc->ExportCaption($teachers->stateOfOrigin);
				$ExportDoc->ExportCaption($teachers->zemail);
				$ExportDoc->ExportCaption($teachers->username);
				$ExportDoc->ExportCaption($teachers->status);
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
				$teachers->CssClass = "";
				$teachers->CssStyle = "";
				$teachers->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($teachers->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('teacherID', $teachers->teacherID->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('firstname', $teachers->firstname->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('middlename', $teachers->middlename->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('lastname', $teachers->lastname->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('qualification', $teachers->qualification->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('stateOfOrigin', $teachers->stateOfOrigin->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('zemail', $teachers->zemail->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('username', $teachers->username->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
					$XmlDoc->AddField('status', $teachers->status->ExportValue($teachers->Export, $teachers->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($teachers->teacherID);
					$ExportDoc->ExportField($teachers->firstname);
					$ExportDoc->ExportField($teachers->middlename);
					$ExportDoc->ExportField($teachers->lastname);
					$ExportDoc->ExportField($teachers->qualification);
					$ExportDoc->ExportField($teachers->stateOfOrigin);
					$ExportDoc->ExportField($teachers->zemail);
					$ExportDoc->ExportField($teachers->username);
					$ExportDoc->ExportField($teachers->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($teachers->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($teachers->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($teachers->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($teachers->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($teachers->ExportReturnUrl());
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
