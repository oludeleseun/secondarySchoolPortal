<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$admin_view = new cadmin_view();
$Page =& $admin_view;

// Page init
$admin_view->Page_Init();

// Page main
$admin_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($admin->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var admin_view = new ew_Page("admin_view");

// page properties
admin_view.PageID = "view"; // page ID
admin_view.FormID = "fadminview"; // form ID
var EW_PAGE_ID = admin_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
admin_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
admin_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
admin_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
admin_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $admin->TableCaption() ?>
<?php if ($admin->Export == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $admin_view->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $admin_view->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $admin_view->ExportXmlUrl ?>"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="<?php echo $admin_view->ExportCsvUrl ?>"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
<br><br>
<?php if ($admin->Export == "") { ?>
<a href="<?php echo $admin_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $admin_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $admin_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $admin_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $admin_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$admin_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($admin->adminID->Visible) { // adminID ?>
	<tr<?php echo $admin->adminID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->adminID->FldCaption() ?></td>
		<td<?php echo $admin->adminID->CellAttributes() ?>>
<div<?php echo $admin->adminID->ViewAttributes() ?>><?php echo $admin->adminID->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->adminUsername->Visible) { // adminUsername ?>
	<tr<?php echo $admin->adminUsername->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->adminUsername->FldCaption() ?></td>
		<td<?php echo $admin->adminUsername->CellAttributes() ?>>
<div<?php echo $admin->adminUsername->ViewAttributes() ?>><?php echo $admin->adminUsername->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->adminPassword->Visible) { // adminPassword ?>
	<tr<?php echo $admin->adminPassword->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->adminPassword->FldCaption() ?></td>
		<td<?php echo $admin->adminPassword->CellAttributes() ?>>
<div<?php echo $admin->adminPassword->ViewAttributes() ?>><?php echo $admin->adminPassword->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->surname->Visible) { // surname ?>
	<tr<?php echo $admin->surname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->surname->FldCaption() ?></td>
		<td<?php echo $admin->surname->CellAttributes() ?>>
<div<?php echo $admin->surname->ViewAttributes() ?>><?php echo $admin->surname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->othernames->Visible) { // othernames ?>
	<tr<?php echo $admin->othernames->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->othernames->FldCaption() ?></td>
		<td<?php echo $admin->othernames->CellAttributes() ?>>
<div<?php echo $admin->othernames->ViewAttributes() ?>><?php echo $admin->othernames->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->lastLogin->Visible) { // lastLogin ?>
	<tr<?php echo $admin->lastLogin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->lastLogin->FldCaption() ?></td>
		<td<?php echo $admin->lastLogin->CellAttributes() ?>>
<div<?php echo $admin->lastLogin->ViewAttributes() ?>><?php echo $admin->lastLogin->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->status->Visible) { // status ?>
	<tr<?php echo $admin->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->status->FldCaption() ?></td>
		<td<?php echo $admin->status->CellAttributes() ?>>
<div<?php echo $admin->status->ViewAttributes() ?>><?php echo $admin->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($admin->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$admin_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cadmin_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'admin';

	// Page object name
	var $PageObjName = 'admin_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $admin;
		if ($admin->UseTokenInUrl) $PageUrl .= "t=" . $admin->TableVar . "&"; // Add page token
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
		global $objForm, $admin;
		if ($admin->UseTokenInUrl) {
			if ($objForm)
				return ($admin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($admin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cadmin_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (admin)
		$GLOBALS["admin"] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'admin', TRUE);

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
		global $admin;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$admin->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$admin->Export = $_POST["exporttype"];
		} else {
			$admin->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $admin->Export; // Get export parameter, used in header
		$gsExportFile = $admin->TableVar; // Get export file, used in header
		if (@$_GET["adminID"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["adminID"]);
		}
		if ($admin->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($admin->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($admin->Export == "csv") {
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
		global $Language, $admin;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["adminID"] <> "") {
				$admin->adminID->setQueryStringValue($_GET["adminID"]);
				$this->arRecKey["adminID"] = $admin->adminID->QueryStringValue;
			} else {
				$sReturnUrl = "adminlist.php"; // Return to list
			}

			// Get action
			$admin->CurrentAction = "I"; // Display form
			switch ($admin->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "adminlist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if (in_array($admin->Export, array("html","word","excel","xml","csv","email"))) {
				if ($admin->Export == "email" && $admin->ExportReturnUrl() == ew_CurrentPage()) // Default return page
					$admin->setExportReturnUrl($admin->ViewUrl()); // Add key
				$this->ExportData();
				if ($admin->Export <> "email")
					$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "adminlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$admin->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $admin;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$admin->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$admin->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $admin->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$admin->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$admin->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$admin->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $admin;

		// Call Recordset Selecting event
		$admin->Recordset_Selecting($admin->CurrentFilter);

		// Load List page SQL
		$sSql = $admin->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$admin->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $admin;
		$sFilter = $admin->KeyFilter();

		// Call Row Selecting event
		$admin->Row_Selecting($sFilter);

		// Load SQL based on filter
		$admin->CurrentFilter = $sFilter;
		$sSql = $admin->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$admin->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $admin;
		$admin->adminID->setDbValue($rs->fields('adminID'));
		$admin->adminUsername->setDbValue($rs->fields('adminUsername'));
		$admin->adminPassword->setDbValue($rs->fields('adminPassword'));
		$admin->surname->setDbValue($rs->fields('surname'));
		$admin->othernames->setDbValue($rs->fields('othernames'));
		$admin->lastLogin->setDbValue($rs->fields('lastLogin'));
		$admin->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $admin;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "adminID=" . urlencode($admin->adminID->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "adminID=" . urlencode($admin->adminID->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "adminID=" . urlencode($admin->adminID->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "adminID=" . urlencode($admin->adminID->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "adminID=" . urlencode($admin->adminID->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "adminID=" . urlencode($admin->adminID->CurrentValue);
		$this->AddUrl = $admin->AddUrl();
		$this->EditUrl = $admin->EditUrl();
		$this->CopyUrl = $admin->CopyUrl();
		$this->DeleteUrl = $admin->DeleteUrl();
		$this->ListUrl = $admin->ListUrl();

		// Call Row_Rendering event
		$admin->Row_Rendering();

		// Common render codes for all row types
		// adminID

		$admin->adminID->CellCssStyle = ""; $admin->adminID->CellCssClass = "";
		$admin->adminID->CellAttrs = array(); $admin->adminID->ViewAttrs = array(); $admin->adminID->EditAttrs = array();

		// adminUsername
		$admin->adminUsername->CellCssStyle = ""; $admin->adminUsername->CellCssClass = "";
		$admin->adminUsername->CellAttrs = array(); $admin->adminUsername->ViewAttrs = array(); $admin->adminUsername->EditAttrs = array();

		// adminPassword
		$admin->adminPassword->CellCssStyle = ""; $admin->adminPassword->CellCssClass = "";
		$admin->adminPassword->CellAttrs = array(); $admin->adminPassword->ViewAttrs = array(); $admin->adminPassword->EditAttrs = array();

		// surname
		$admin->surname->CellCssStyle = ""; $admin->surname->CellCssClass = "";
		$admin->surname->CellAttrs = array(); $admin->surname->ViewAttrs = array(); $admin->surname->EditAttrs = array();

		// othernames
		$admin->othernames->CellCssStyle = ""; $admin->othernames->CellCssClass = "";
		$admin->othernames->CellAttrs = array(); $admin->othernames->ViewAttrs = array(); $admin->othernames->EditAttrs = array();

		// lastLogin
		$admin->lastLogin->CellCssStyle = ""; $admin->lastLogin->CellCssClass = "";
		$admin->lastLogin->CellAttrs = array(); $admin->lastLogin->ViewAttrs = array(); $admin->lastLogin->EditAttrs = array();

		// status
		$admin->status->CellCssStyle = ""; $admin->status->CellCssClass = "";
		$admin->status->CellAttrs = array(); $admin->status->ViewAttrs = array(); $admin->status->EditAttrs = array();
		if ($admin->RowType == EW_ROWTYPE_VIEW) { // View row

			// adminID
			$admin->adminID->ViewValue = $admin->adminID->CurrentValue;
			$admin->adminID->CssStyle = "";
			$admin->adminID->CssClass = "";
			$admin->adminID->ViewCustomAttributes = "";

			// adminUsername
			$admin->adminUsername->ViewValue = $admin->adminUsername->CurrentValue;
			$admin->adminUsername->CssStyle = "";
			$admin->adminUsername->CssClass = "";
			$admin->adminUsername->ViewCustomAttributes = "";

			// adminPassword
			$admin->adminPassword->ViewValue = "********";
			$admin->adminPassword->CssStyle = "";
			$admin->adminPassword->CssClass = "";
			$admin->adminPassword->ViewCustomAttributes = "";

			// surname
			$admin->surname->ViewValue = $admin->surname->CurrentValue;
			$admin->surname->CssStyle = "";
			$admin->surname->CssClass = "";
			$admin->surname->ViewCustomAttributes = "";

			// othernames
			$admin->othernames->ViewValue = $admin->othernames->CurrentValue;
			$admin->othernames->CssStyle = "";
			$admin->othernames->CssClass = "";
			$admin->othernames->ViewCustomAttributes = "";

			// lastLogin
			$admin->lastLogin->ViewValue = $admin->lastLogin->CurrentValue;
			$admin->lastLogin->ViewValue = ew_FormatDateTime($admin->lastLogin->ViewValue, 5);
			$admin->lastLogin->CssStyle = "";
			$admin->lastLogin->CssClass = "";
			$admin->lastLogin->ViewCustomAttributes = "";

			// status
			if (strval($admin->status->CurrentValue) <> "") {
				switch ($admin->status->CurrentValue) {
					case "1":
						$admin->status->ViewValue = "Enabled";
						break;
					case "0":
						$admin->status->ViewValue = "Disabled";
						break;
					default:
						$admin->status->ViewValue = $admin->status->CurrentValue;
				}
			} else {
				$admin->status->ViewValue = NULL;
			}
			$admin->status->CssStyle = "";
			$admin->status->CssClass = "";
			$admin->status->ViewCustomAttributes = "";

			// adminID
			$admin->adminID->HrefValue = "";
			$admin->adminID->TooltipValue = "";

			// adminUsername
			$admin->adminUsername->HrefValue = "";
			$admin->adminUsername->TooltipValue = "";

			// adminPassword
			$admin->adminPassword->HrefValue = "";
			$admin->adminPassword->TooltipValue = "";

			// surname
			$admin->surname->HrefValue = "";
			$admin->surname->TooltipValue = "";

			// othernames
			$admin->othernames->HrefValue = "";
			$admin->othernames->TooltipValue = "";

			// lastLogin
			$admin->lastLogin->HrefValue = "";
			$admin->lastLogin->TooltipValue = "";

			// status
			$admin->status->HrefValue = "";
			$admin->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($admin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$admin->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $admin;
		$utf8 = FALSE;
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $admin->SelectRecordCount();
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
		if ($admin->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($admin, "v");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($admin->adminID);
				$ExportDoc->ExportCaption($admin->adminUsername);
				$ExportDoc->ExportCaption($admin->surname);
				$ExportDoc->ExportCaption($admin->othernames);
				$ExportDoc->ExportCaption($admin->lastLogin);
				$ExportDoc->ExportCaption($admin->status);
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
				$admin->CssClass = "";
				$admin->CssStyle = "";
				$admin->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($admin->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('adminID', $admin->adminID->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('adminUsername', $admin->adminUsername->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('surname', $admin->surname->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('othernames', $admin->othernames->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('lastLogin', $admin->lastLogin->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('status', $admin->status->ExportValue($admin->Export, $admin->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($admin->adminID);
					$ExportDoc->ExportField($admin->adminUsername);
					$ExportDoc->ExportField($admin->surname);
					$ExportDoc->ExportField($admin->othernames);
					$ExportDoc->ExportField($admin->lastLogin);
					$ExportDoc->ExportField($admin->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($admin->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($admin->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($admin->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($admin->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($admin->ExportReturnUrl());
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
