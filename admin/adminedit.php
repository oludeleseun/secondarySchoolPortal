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
$admin_edit = new cadmin_edit();
$Page =& $admin_edit;

// Page init
$admin_edit->Page_Init();

// Page main
$admin_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var admin_edit = new ew_Page("admin_edit");

// page properties
admin_edit.PageID = "edit"; // page ID
admin_edit.FormID = "fadminedit"; // form ID
var EW_PAGE_ID = admin_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
admin_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_adminUsername"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($admin->adminUsername->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_adminPassword"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($admin->adminPassword->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_surname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($admin->surname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_othernames"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($admin->othernames->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lastLogin"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($admin->lastLogin->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($admin->status->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
admin_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
admin_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
admin_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
admin_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $admin->TableCaption() ?><br><br>
<a href="<?php echo $admin->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$admin_edit->ShowMessage();
?>
<form name="fadminedit" id="fadminedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return admin_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="admin">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($admin->adminID->Visible) { // adminID ?>
	<tr<?php echo $admin->adminID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->adminID->FldCaption() ?></td>
		<td<?php echo $admin->adminID->CellAttributes() ?>><span id="el_adminID">
<div<?php echo $admin->adminID->ViewAttributes() ?>><?php echo $admin->adminID->EditValue ?></div><input type="hidden" name="x_adminID" id="x_adminID" value="<?php echo ew_HtmlEncode($admin->adminID->CurrentValue) ?>">
</span><?php echo $admin->adminID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->adminUsername->Visible) { // adminUsername ?>
	<tr<?php echo $admin->adminUsername->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->adminUsername->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $admin->adminUsername->CellAttributes() ?>><span id="el_adminUsername">
<input type="text" name="x_adminUsername" id="x_adminUsername" title="<?php echo $admin->adminUsername->FldTitle() ?>" size="20" maxlength="20" value="<?php echo $admin->adminUsername->EditValue ?>"<?php echo $admin->adminUsername->EditAttributes() ?>>
</span><?php echo $admin->adminUsername->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->adminPassword->Visible) { // adminPassword ?>
	<tr<?php echo $admin->adminPassword->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->adminPassword->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $admin->adminPassword->CellAttributes() ?>><span id="el_adminPassword">
<input type="password" name="x_adminPassword" id="x_adminPassword" title="<?php echo $admin->adminPassword->FldTitle() ?>" value="<?php echo $admin->adminPassword->EditValue ?>" size="20" maxlength="20"<?php echo $admin->adminPassword->EditAttributes() ?>>
</span><?php echo $admin->adminPassword->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->surname->Visible) { // surname ?>
	<tr<?php echo $admin->surname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->surname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $admin->surname->CellAttributes() ?>><span id="el_surname">
<input type="text" name="x_surname" id="x_surname" title="<?php echo $admin->surname->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $admin->surname->EditValue ?>"<?php echo $admin->surname->EditAttributes() ?>>
</span><?php echo $admin->surname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->othernames->Visible) { // othernames ?>
	<tr<?php echo $admin->othernames->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->othernames->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $admin->othernames->CellAttributes() ?>><span id="el_othernames">
<input type="text" name="x_othernames" id="x_othernames" title="<?php echo $admin->othernames->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $admin->othernames->EditValue ?>"<?php echo $admin->othernames->EditAttributes() ?>>
</span><?php echo $admin->othernames->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->lastLogin->Visible) { // lastLogin ?>
	<tr<?php echo $admin->lastLogin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->lastLogin->FldCaption() ?></td>
		<td<?php echo $admin->lastLogin->CellAttributes() ?>><span id="el_lastLogin">
<input type="text" name="x_lastLogin" id="x_lastLogin" title="<?php echo $admin->lastLogin->FldTitle() ?>" value="<?php echo $admin->lastLogin->EditValue ?>"<?php echo $admin->lastLogin->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_lastLogin" name="cal_x_lastLogin" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_lastLogin", // input field id
	ifFormat: "%Y/%m/%d", // date format
	button: "cal_x_lastLogin" // button id
});
</script>
</span><?php echo $admin->lastLogin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->status->Visible) { // status ?>
	<tr<?php echo $admin->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $admin->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $admin->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $admin->status->FldTitle() ?>" value="{value}"<?php echo $admin->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $admin->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($admin->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $admin->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $admin->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $admin->status->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$admin_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cadmin_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'admin';

	// Page object name
	var $PageObjName = 'admin_edit';

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
	function cadmin_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (admin)
		$GLOBALS["admin"] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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

		// Create form object
		$objForm = new cFormObj();

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $admin;

		// Load key from QueryString
		if (@$_GET["adminID"] <> "")
			$admin->adminID->setQueryStringValue($_GET["adminID"]);
		if (@$_POST["a_edit"] <> "") {
			$admin->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$admin->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$admin->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$admin->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($admin->adminID->CurrentValue == "")
			$this->Page_Terminate("adminlist.php"); // Invalid key, return to list
		switch ($admin->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("adminlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$admin->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $admin->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$admin->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$admin->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $admin;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $admin;
		$admin->adminID->setFormValue($objForm->GetValue("x_adminID"));
		$admin->adminUsername->setFormValue($objForm->GetValue("x_adminUsername"));
		$admin->adminPassword->setFormValue($objForm->GetValue("x_adminPassword"));
		$admin->surname->setFormValue($objForm->GetValue("x_surname"));
		$admin->othernames->setFormValue($objForm->GetValue("x_othernames"));
		$admin->lastLogin->setFormValue($objForm->GetValue("x_lastLogin"));
		$admin->lastLogin->CurrentValue = ew_UnFormatDateTime($admin->lastLogin->CurrentValue, 5);
		$admin->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $admin;
		$this->LoadRow();
		$admin->adminID->CurrentValue = $admin->adminID->FormValue;
		$admin->adminUsername->CurrentValue = $admin->adminUsername->FormValue;
		$admin->adminPassword->CurrentValue = $admin->adminPassword->FormValue;
		$admin->surname->CurrentValue = $admin->surname->FormValue;
		$admin->othernames->CurrentValue = $admin->othernames->FormValue;
		$admin->lastLogin->CurrentValue = $admin->lastLogin->FormValue;
		$admin->lastLogin->CurrentValue = ew_UnFormatDateTime($admin->lastLogin->CurrentValue, 5);
		$admin->status->CurrentValue = $admin->status->FormValue;
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
		} elseif ($admin->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// adminID
			$admin->adminID->EditCustomAttributes = "";
			$admin->adminID->EditValue = $admin->adminID->CurrentValue;
			$admin->adminID->CssStyle = "";
			$admin->adminID->CssClass = "";
			$admin->adminID->ViewCustomAttributes = "";

			// adminUsername
			$admin->adminUsername->EditCustomAttributes = "";
			$admin->adminUsername->EditValue = ew_HtmlEncode($admin->adminUsername->CurrentValue);

			// adminPassword
			$admin->adminPassword->EditCustomAttributes = "";
			$admin->adminPassword->EditValue = ew_HtmlEncode($admin->adminPassword->CurrentValue);

			// surname
			$admin->surname->EditCustomAttributes = "";
			$admin->surname->EditValue = ew_HtmlEncode($admin->surname->CurrentValue);

			// othernames
			$admin->othernames->EditCustomAttributes = "";
			$admin->othernames->EditValue = ew_HtmlEncode($admin->othernames->CurrentValue);

			// lastLogin
			$admin->lastLogin->EditCustomAttributes = "";
			$admin->lastLogin->EditValue = ew_HtmlEncode(ew_FormatDateTime($admin->lastLogin->CurrentValue, 5));

			// status
			$admin->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$admin->status->EditValue = $arwrk;

			// Edit refer script
			// adminID

			$admin->adminID->HrefValue = "";

			// adminUsername
			$admin->adminUsername->HrefValue = "";

			// adminPassword
			$admin->adminPassword->HrefValue = "";

			// surname
			$admin->surname->HrefValue = "";

			// othernames
			$admin->othernames->HrefValue = "";

			// lastLogin
			$admin->lastLogin->HrefValue = "";

			// status
			$admin->status->HrefValue = "";
		}

		// Call Row Rendered event
		if ($admin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$admin->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $admin;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($admin->adminUsername->FormValue) && $admin->adminUsername->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $admin->adminUsername->FldCaption();
		}
		if (!is_null($admin->adminPassword->FormValue) && $admin->adminPassword->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $admin->adminPassword->FldCaption();
		}
		if (!is_null($admin->surname->FormValue) && $admin->surname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $admin->surname->FldCaption();
		}
		if (!is_null($admin->othernames->FormValue) && $admin->othernames->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $admin->othernames->FldCaption();
		}
		if (!ew_CheckDate($admin->lastLogin->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $admin->lastLogin->FldErrMsg();
		}
		if ($admin->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $admin->status->FldCaption();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $admin;
		$sFilter = $admin->KeyFilter();
			if ($admin->adminUsername->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`adminUsername` = '" . ew_AdjustSql($admin->adminUsername->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$admin->CurrentFilter = $sFilterChk;
			$sSqlChk = $admin->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'adminUsername', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $admin->adminUsername->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$admin->CurrentFilter = $sFilter;
		$sSql = $admin->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// adminUsername
			$admin->adminUsername->SetDbValueDef($rsnew, $admin->adminUsername->CurrentValue, NULL, FALSE);

			// adminPassword
			$admin->adminPassword->SetDbValueDef($rsnew, $admin->adminPassword->CurrentValue, NULL, FALSE);

			// surname
			$admin->surname->SetDbValueDef($rsnew, $admin->surname->CurrentValue, NULL, FALSE);

			// othernames
			$admin->othernames->SetDbValueDef($rsnew, $admin->othernames->CurrentValue, NULL, FALSE);

			// lastLogin
			$admin->lastLogin->SetDbValueDef($rsnew, ew_UnFormatDateTime($admin->lastLogin->CurrentValue, 5, FALSE), NULL);

			// status
			$admin->status->SetDbValueDef($rsnew, $admin->status->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $admin->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($admin->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($admin->CancelMessage <> "") {
					$this->setMessage($admin->CancelMessage);
					$admin->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$admin->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
