<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "parentsinfo.php" ?>
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
$parents_view = new cparents_view();
$Page =& $parents_view;

// Page init
$parents_view->Page_Init();

// Page main
$parents_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($parents->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var parents_view = new ew_Page("parents_view");

// page properties
parents_view.PageID = "view"; // page ID
parents_view.FormID = "fparentsview"; // form ID
var EW_PAGE_ID = parents_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
parents_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
parents_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
parents_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
parents_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $parents->TableCaption() ?>
<?php if ($parents->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $parents_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $parents_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $parents_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $parents_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($parents->Export == "") { ?>
<a href="<?php echo $parents_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $parents_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $parents_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $parents_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $parents_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$parents_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($parents->parentID->Visible) { // parentID ?>
	<tr<?php echo $parents->parentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->parentID->FldCaption() ?></td>
		<td<?php echo $parents->parentID->CellAttributes() ?>>
<div<?php echo $parents->parentID->ViewAttributes() ?>><?php echo $parents->parentID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->firstname->Visible) { // firstname ?>
	<tr<?php echo $parents->firstname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->firstname->FldCaption() ?></td>
		<td<?php echo $parents->firstname->CellAttributes() ?>>
<div<?php echo $parents->firstname->ViewAttributes() ?>><?php echo $parents->firstname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->middlename->Visible) { // middlename ?>
	<tr<?php echo $parents->middlename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->middlename->FldCaption() ?></td>
		<td<?php echo $parents->middlename->CellAttributes() ?>>
<div<?php echo $parents->middlename->ViewAttributes() ?>><?php echo $parents->middlename->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->lastname->Visible) { // lastname ?>
	<tr<?php echo $parents->lastname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->lastname->FldCaption() ?></td>
		<td<?php echo $parents->lastname->CellAttributes() ?>>
<div<?php echo $parents->lastname->ViewAttributes() ?>><?php echo $parents->lastname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->occupation->Visible) { // occupation ?>
	<tr<?php echo $parents->occupation->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->occupation->FldCaption() ?></td>
		<td<?php echo $parents->occupation->CellAttributes() ?>>
<div<?php echo $parents->occupation->ViewAttributes() ?>><?php echo $parents->occupation->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->mailingAddress->Visible) { // mailingAddress ?>
	<tr<?php echo $parents->mailingAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->mailingAddress->FldCaption() ?></td>
		<td<?php echo $parents->mailingAddress->CellAttributes() ?>>
<div<?php echo $parents->mailingAddress->ViewAttributes() ?>><?php echo $parents->mailingAddress->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->residentialAddress->Visible) { // residentialAddress ?>
	<tr<?php echo $parents->residentialAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->residentialAddress->FldCaption() ?></td>
		<td<?php echo $parents->residentialAddress->CellAttributes() ?>>
<div<?php echo $parents->residentialAddress->ViewAttributes() ?>><?php echo $parents->residentialAddress->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->residentState->Visible) { // residentState ?>
	<tr<?php echo $parents->residentState->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->residentState->FldCaption() ?></td>
		<td<?php echo $parents->residentState->CellAttributes() ?>>
<div<?php echo $parents->residentState->ViewAttributes() ?>><?php echo $parents->residentState->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->stateOfOrigin->Visible) { // stateOfOrigin ?>
	<tr<?php echo $parents->stateOfOrigin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->stateOfOrigin->FldCaption() ?></td>
		<td<?php echo $parents->stateOfOrigin->CellAttributes() ?>>
<div<?php echo $parents->stateOfOrigin->ViewAttributes() ?>><?php echo $parents->stateOfOrigin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->emailAddress->Visible) { // emailAddress ?>
	<tr<?php echo $parents->emailAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->emailAddress->FldCaption() ?></td>
		<td<?php echo $parents->emailAddress->CellAttributes() ?>>
<div<?php echo $parents->emailAddress->ViewAttributes() ?>><?php echo $parents->emailAddress->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->portalUsername->Visible) { // portalUsername ?>
	<tr<?php echo $parents->portalUsername->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->portalUsername->FldCaption() ?></td>
		<td<?php echo $parents->portalUsername->CellAttributes() ?>>
<div<?php echo $parents->portalUsername->ViewAttributes() ?>><?php echo $parents->portalUsername->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->portalPassword->Visible) { // portalPassword ?>
	<tr<?php echo $parents->portalPassword->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->portalPassword->FldCaption() ?></td>
		<td<?php echo $parents->portalPassword->CellAttributes() ?>>
<div<?php echo $parents->portalPassword->ViewAttributes() ?>><?php echo $parents->portalPassword->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($parents->status->Visible) { // status ?>
	<tr<?php echo $parents->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->status->FldCaption() ?></td>
		<td<?php echo $parents->status->CellAttributes() ?>>
<div<?php echo $parents->status->ViewAttributes() ?>><?php echo $parents->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($parents->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$parents_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cparents_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'parents';

	// Page object name
	var $PageObjName = 'parents_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $parents;
		if ($parents->UseTokenInUrl) $PageUrl .= "t=" . $parents->TableVar . "&"; // Add page token
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
		global $objForm, $parents;
		if ($parents->UseTokenInUrl) {
			if ($objForm)
				return ($parents->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($parents->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cparents_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (parents)
		$GLOBALS["parents"] = new cparents();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'parents', TRUE);

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
		global $parents;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$parents->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$parents->Export = $_POST["exporttype"];
		} else {
			$parents->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $parents->Export; // Get export parameter, used in header
		$gsExportFile = $parents->TableVar; // Get export file, used in header
		if (@$_GET["parentID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["parentID"]);
		}
		if ($parents->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($parents->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($parents->Export == "csv") {
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
		global $Language, $parents;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["parentID"] <> "") {
				$parents->parentID->setQueryStringValue($_GET["parentID"]);
				$this->arRecKey["parentID"] = $parents->parentID->QueryStringValue;
			} else {
				$sReturnUrl = "parentslist.php"; // Return to list
			}

			// Get action
			$parents->CurrentAction = "I"; // Display form
			switch ($parents->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "parentslist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($parents->Export, array("html","word","excel","xml","csv","email"))) {
				if ($parents->Export == "email" && $parents->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$parents->setExportReturnUrl($parents->ViewUrl()); // Add key
				$this->ExportData();
				if ($parents->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "parentslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$parents->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $parents;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$parents->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$parents->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $parents->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$parents->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$parents->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$parents->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $parents;

		// Call Recordset Selecting event
		$parents->Recordset_Selecting($parents->CurrentFilter);

		// Load List page SQL
		$sSql = $parents->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$parents->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $parents;
		$sFilter = $parents->KeyFilter();

		// Call Row Selecting event
		$parents->Row_Selecting($sFilter);

		// Load SQL based on filter
		$parents->CurrentFilter = $sFilter;
		$sSql = $parents->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$parents->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $parents;
		$parents->parentID->setDbValue($rs->fields('parentID'));
		$parents->firstname->setDbValue($rs->fields('firstname'));
		$parents->middlename->setDbValue($rs->fields('middlename'));
		$parents->lastname->setDbValue($rs->fields('lastname'));
		$parents->occupation->setDbValue($rs->fields('occupation'));
		$parents->mailingAddress->setDbValue($rs->fields('mailingAddress'));
		$parents->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$parents->residentState->setDbValue($rs->fields('residentState'));
		$parents->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$parents->emailAddress->setDbValue($rs->fields('emailAddress'));
		$parents->portalUsername->setDbValue($rs->fields('portalUsername'));
		$parents->portalPassword->setDbValue($rs->fields('portalPassword'));
		$parents->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $parents;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "parentID=" . urlencode($parents->parentID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "parentID=" . urlencode($parents->parentID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "parentID=" . urlencode($parents->parentID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "parentID=" . urlencode($parents->parentID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "parentID=" . urlencode($parents->parentID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "parentID=" . urlencode($parents->parentID->CurrentValue);
		$this->AddUrl = $parents->AddUrl();
		$this->EditUrl = $parents->EditUrl();
		$this->CopyUrl = $parents->CopyUrl();
		$this->DeleteUrl = $parents->DeleteUrl();
		$this->ListUrl = $parents->ListUrl();

		// Call Row_Rendering event
		$parents->Row_Rendering();

		// Common render codes for all row types
		// parentID

		$parents->parentID->CellCssStyle = ""; $parents->parentID->CellCssClass = "";
		$parents->parentID->CellAttrs = array(); $parents->parentID->ViewAttrs = array(); $parents->parentID->EditAttrs = array();

		// firstname
		$parents->firstname->CellCssStyle = ""; $parents->firstname->CellCssClass = "";
		$parents->firstname->CellAttrs = array(); $parents->firstname->ViewAttrs = array(); $parents->firstname->EditAttrs = array();

		// middlename
		$parents->middlename->CellCssStyle = ""; $parents->middlename->CellCssClass = "";
		$parents->middlename->CellAttrs = array(); $parents->middlename->ViewAttrs = array(); $parents->middlename->EditAttrs = array();

		// lastname
		$parents->lastname->CellCssStyle = ""; $parents->lastname->CellCssClass = "";
		$parents->lastname->CellAttrs = array(); $parents->lastname->ViewAttrs = array(); $parents->lastname->EditAttrs = array();

		// occupation
		$parents->occupation->CellCssStyle = ""; $parents->occupation->CellCssClass = "";
		$parents->occupation->CellAttrs = array(); $parents->occupation->ViewAttrs = array(); $parents->occupation->EditAttrs = array();

		// mailingAddress
		$parents->mailingAddress->CellCssStyle = ""; $parents->mailingAddress->CellCssClass = "";
		$parents->mailingAddress->CellAttrs = array(); $parents->mailingAddress->ViewAttrs = array(); $parents->mailingAddress->EditAttrs = array();

		// residentialAddress
		$parents->residentialAddress->CellCssStyle = ""; $parents->residentialAddress->CellCssClass = "";
		$parents->residentialAddress->CellAttrs = array(); $parents->residentialAddress->ViewAttrs = array(); $parents->residentialAddress->EditAttrs = array();

		// residentState
		$parents->residentState->CellCssStyle = ""; $parents->residentState->CellCssClass = "";
		$parents->residentState->CellAttrs = array(); $parents->residentState->ViewAttrs = array(); $parents->residentState->EditAttrs = array();

		// stateOfOrigin
		$parents->stateOfOrigin->CellCssStyle = ""; $parents->stateOfOrigin->CellCssClass = "";
		$parents->stateOfOrigin->CellAttrs = array(); $parents->stateOfOrigin->ViewAttrs = array(); $parents->stateOfOrigin->EditAttrs = array();

		// emailAddress
		$parents->emailAddress->CellCssStyle = ""; $parents->emailAddress->CellCssClass = "";
		$parents->emailAddress->CellAttrs = array(); $parents->emailAddress->ViewAttrs = array(); $parents->emailAddress->EditAttrs = array();

		// portalUsername
		$parents->portalUsername->CellCssStyle = ""; $parents->portalUsername->CellCssClass = "";
		$parents->portalUsername->CellAttrs = array(); $parents->portalUsername->ViewAttrs = array(); $parents->portalUsername->EditAttrs = array();

		// portalPassword
		$parents->portalPassword->CellCssStyle = ""; $parents->portalPassword->CellCssClass = "";
		$parents->portalPassword->CellAttrs = array(); $parents->portalPassword->ViewAttrs = array(); $parents->portalPassword->EditAttrs = array();

		// status
		$parents->status->CellCssStyle = ""; $parents->status->CellCssClass = "";
		$parents->status->CellAttrs = array(); $parents->status->ViewAttrs = array(); $parents->status->EditAttrs = array();
		if ($parents->RowType == EW_ROWTYPE_VIEW) { // View row

			// parentID
			$parents->parentID->ViewValue = $parents->parentID->CurrentValue;
			$parents->parentID->CssStyle = "";
			$parents->parentID->CssClass = "";
			$parents->parentID->ViewCustomAttributes = "";

			// firstname
			$parents->firstname->ViewValue = $parents->firstname->CurrentValue;
			$parents->firstname->CssStyle = "";
			$parents->firstname->CssClass = "";
			$parents->firstname->ViewCustomAttributes = "";

			// middlename
			$parents->middlename->ViewValue = $parents->middlename->CurrentValue;
			$parents->middlename->CssStyle = "";
			$parents->middlename->CssClass = "";
			$parents->middlename->ViewCustomAttributes = "";

			// lastname
			$parents->lastname->ViewValue = $parents->lastname->CurrentValue;
			$parents->lastname->CssStyle = "";
			$parents->lastname->CssClass = "";
			$parents->lastname->ViewCustomAttributes = "";

			// occupation
			$parents->occupation->ViewValue = $parents->occupation->CurrentValue;
			$parents->occupation->CssStyle = "";
			$parents->occupation->CssClass = "";
			$parents->occupation->ViewCustomAttributes = "";

			// mailingAddress
			$parents->mailingAddress->ViewValue = $parents->mailingAddress->CurrentValue;
			$parents->mailingAddress->CssStyle = "";
			$parents->mailingAddress->CssClass = "";
			$parents->mailingAddress->ViewCustomAttributes = "";

			// residentialAddress
			$parents->residentialAddress->ViewValue = $parents->residentialAddress->CurrentValue;
			$parents->residentialAddress->CssStyle = "";
			$parents->residentialAddress->CssClass = "";
			$parents->residentialAddress->ViewCustomAttributes = "";

			// residentState
			$parents->residentState->ViewValue = $parents->residentState->CurrentValue;
			$parents->residentState->CssStyle = "";
			$parents->residentState->CssClass = "";
			$parents->residentState->ViewCustomAttributes = "";

			// stateOfOrigin
			$parents->stateOfOrigin->ViewValue = $parents->stateOfOrigin->CurrentValue;
			$parents->stateOfOrigin->CssStyle = "";
			$parents->stateOfOrigin->CssClass = "";
			$parents->stateOfOrigin->ViewCustomAttributes = "";

			// emailAddress
			$parents->emailAddress->ViewValue = $parents->emailAddress->CurrentValue;
			$parents->emailAddress->CssStyle = "";
			$parents->emailAddress->CssClass = "";
			$parents->emailAddress->ViewCustomAttributes = "";

			// portalUsername
			$parents->portalUsername->ViewValue = $parents->portalUsername->CurrentValue;
			$parents->portalUsername->CssStyle = "";
			$parents->portalUsername->CssClass = "";
			$parents->portalUsername->ViewCustomAttributes = "";

			// portalPassword
			$parents->portalPassword->ViewValue = "********";
			$parents->portalPassword->CssStyle = "";
			$parents->portalPassword->CssClass = "";
			$parents->portalPassword->ViewCustomAttributes = "";

			// status
			if (strval($parents->status->CurrentValue) <> "") {
				switch ($parents->status->CurrentValue) {
					case "1":
						$parents->status->ViewValue = "Enabled";
						break;
					case "0":
						$parents->status->ViewValue = "Disabled";
						break;
					default:
						$parents->status->ViewValue = $parents->status->CurrentValue;
				}
			} else {
				$parents->status->ViewValue = NULL;
			}
			$parents->status->CssStyle = "";
			$parents->status->CssClass = "";
			$parents->status->ViewCustomAttributes = "";

			// parentID
			$parents->parentID->HrefValue = "";
			$parents->parentID->TooltipValue = "";

			// firstname
			$parents->firstname->HrefValue = "";
			$parents->firstname->TooltipValue = "";

			// middlename
			$parents->middlename->HrefValue = "";
			$parents->middlename->TooltipValue = "";

			// lastname
			$parents->lastname->HrefValue = "";
			$parents->lastname->TooltipValue = "";

			// occupation
			$parents->occupation->HrefValue = "";
			$parents->occupation->TooltipValue = "";

			// mailingAddress
			$parents->mailingAddress->HrefValue = "";
			$parents->mailingAddress->TooltipValue = "";

			// residentialAddress
			$parents->residentialAddress->HrefValue = "";
			$parents->residentialAddress->TooltipValue = "";

			// residentState
			$parents->residentState->HrefValue = "";
			$parents->residentState->TooltipValue = "";

			// stateOfOrigin
			$parents->stateOfOrigin->HrefValue = "";
			$parents->stateOfOrigin->TooltipValue = "";

			// emailAddress
			$parents->emailAddress->HrefValue = "";
			$parents->emailAddress->TooltipValue = "";

			// portalUsername
			$parents->portalUsername->HrefValue = "";
			$parents->portalUsername->TooltipValue = "";

			// portalPassword
			$parents->portalPassword->HrefValue = "";
			$parents->portalPassword->TooltipValue = "";

			// status
			$parents->status->HrefValue = "";
			$parents->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($parents->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$parents->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $parents;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $parents->SelectRecordCount();
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
		if ($parents->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($parents, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($parents->parentID);
				$ExportDoc->ExportCaption($parents->firstname);
				$ExportDoc->ExportCaption($parents->middlename);
				$ExportDoc->ExportCaption($parents->lastname);
				$ExportDoc->ExportCaption($parents->occupation);
				$ExportDoc->ExportCaption($parents->residentState);
				$ExportDoc->ExportCaption($parents->stateOfOrigin);
				$ExportDoc->ExportCaption($parents->emailAddress);
				$ExportDoc->ExportCaption($parents->portalUsername);
				$ExportDoc->ExportCaption($parents->portalPassword);
				$ExportDoc->ExportCaption($parents->status);
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
				$parents->CssClass = "";
				$parents->CssStyle = "";
				$parents->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($parents->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('parentID', $parents->parentID->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('firstname', $parents->firstname->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('middlename', $parents->middlename->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('lastname', $parents->lastname->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('occupation', $parents->occupation->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('residentState', $parents->residentState->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('stateOfOrigin', $parents->stateOfOrigin->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('emailAddress', $parents->emailAddress->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('portalUsername', $parents->portalUsername->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('portalPassword', $parents->portalPassword->ExportValue($parents->Export, $parents->ExportOriginalValue));
					$XmlDoc->AddField('status', $parents->status->ExportValue($parents->Export, $parents->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($parents->parentID);
					$ExportDoc->ExportField($parents->firstname);
					$ExportDoc->ExportField($parents->middlename);
					$ExportDoc->ExportField($parents->lastname);
					$ExportDoc->ExportField($parents->occupation);
					$ExportDoc->ExportField($parents->residentState);
					$ExportDoc->ExportField($parents->stateOfOrigin);
					$ExportDoc->ExportField($parents->emailAddress);
					$ExportDoc->ExportField($parents->portalUsername);
					$ExportDoc->ExportField($parents->portalPassword);
					$ExportDoc->ExportField($parents->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($parents->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($parents->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($parents->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($parents->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($parents->ExportReturnUrl());
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
