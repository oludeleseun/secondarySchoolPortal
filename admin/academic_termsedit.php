<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_termsinfo.php" ?>
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
$academic_terms_edit = new cacademic_terms_edit();
$Page =& $academic_terms_edit;

// Page init
$academic_terms_edit->Page_Init();

// Page main
$academic_terms_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var academic_terms_edit = new ew_Page("academic_terms_edit");

// page properties
academic_terms_edit.PageID = "edit"; // page ID
academic_terms_edit.FormID = "facademic_termsedit"; // form ID
var EW_PAGE_ID = academic_terms_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
academic_terms_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($academic_terms->status->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
academic_terms_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
academic_terms_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_terms_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_terms_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_terms->TableCaption() ?><br><br>
<a href="<?php echo $academic_terms->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_terms_edit->ShowMessage();
?>
<form name="facademic_termsedit" id="facademic_termsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return academic_terms_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="academic_terms">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($academic_terms->termID->Visible) { // termID ?>
	<tr<?php echo $academic_terms->termID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_terms->termID->FldCaption() ?></td>
		<td<?php echo $academic_terms->termID->CellAttributes() ?>><span id="el_termID">
<div<?php echo $academic_terms->termID->ViewAttributes() ?>><?php echo $academic_terms->termID->EditValue ?></div><input type="hidden" name="x_termID" id="x_termID" value="<?php echo ew_HtmlEncode($academic_terms->termID->CurrentValue) ?>">
</span><?php echo $academic_terms->termID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($academic_terms->termName->Visible) { // termName ?>
	<tr<?php echo $academic_terms->termName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_terms->termName->FldCaption() ?></td>
		<td<?php echo $academic_terms->termName->CellAttributes() ?>><span id="el_termName">
<input type="text" name="x_termName" id="x_termName" title="<?php echo $academic_terms->termName->FldTitle() ?>" size="30" maxlength="30" value="<?php echo $academic_terms->termName->EditValue ?>"<?php echo $academic_terms->termName->EditAttributes() ?>>
</span><?php echo $academic_terms->termName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($academic_terms->status->Visible) { // status ?>
	<tr<?php echo $academic_terms->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_terms->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $academic_terms->status->CellAttributes() ?>><span id="el_status">
<select id="x_status" name="x_status" title="<?php echo $academic_terms->status->FldTitle() ?>"<?php echo $academic_terms->status->EditAttributes() ?>>
<?php
if (is_array($academic_terms->status->EditValue)) {
	$arwrk = $academic_terms->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($academic_terms->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $academic_terms->status->CustomMsg ?></td>
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
$academic_terms_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_terms_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'academic_terms';

	// Page object name
	var $PageObjName = 'academic_terms_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_terms;
		if ($academic_terms->UseTokenInUrl) $PageUrl .= "t=" . $academic_terms->TableVar . "&"; // Add page token
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
		global $objForm, $academic_terms;
		if ($academic_terms->UseTokenInUrl) {
			if ($objForm)
				return ($academic_terms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_terms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_terms_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_terms)
		$GLOBALS["academic_terms"] = new cacademic_terms();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_terms', TRUE);

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
		global $academic_terms;

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
		global $objForm, $Language, $gsFormError, $academic_terms;

		// Load key from QueryString
		if (@$_GET["termID"] <> "")
			$academic_terms->termID->setQueryStringValue($_GET["termID"]);
		if (@$_POST["a_edit"] <> "") {
			$academic_terms->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$academic_terms->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$academic_terms->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$academic_terms->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($academic_terms->termID->CurrentValue == "")
			$this->Page_Terminate("academic_termslist.php"); // Invalid key, return to list
		switch ($academic_terms->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("academic_termslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$academic_terms->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $academic_terms->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$academic_terms->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$academic_terms->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $academic_terms;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $academic_terms;
		$academic_terms->termID->setFormValue($objForm->GetValue("x_termID"));
		$academic_terms->termName->setFormValue($objForm->GetValue("x_termName"));
		$academic_terms->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $academic_terms;
		$this->LoadRow();
		$academic_terms->termID->CurrentValue = $academic_terms->termID->FormValue;
		$academic_terms->termName->CurrentValue = $academic_terms->termName->FormValue;
		$academic_terms->status->CurrentValue = $academic_terms->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_terms;
		$sFilter = $academic_terms->KeyFilter();

		// Call Row Selecting event
		$academic_terms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_terms->CurrentFilter = $sFilter;
		$sSql = $academic_terms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_terms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_terms;
		$academic_terms->termID->setDbValue($rs->fields('termID'));
		$academic_terms->termName->setDbValue($rs->fields('termName'));
		$academic_terms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_terms;

		// Initialize URLs
		// Call Row_Rendering event

		$academic_terms->Row_Rendering();

		// Common render codes for all row types
		// termID

		$academic_terms->termID->CellCssStyle = ""; $academic_terms->termID->CellCssClass = "";
		$academic_terms->termID->CellAttrs = array(); $academic_terms->termID->ViewAttrs = array(); $academic_terms->termID->EditAttrs = array();

		// termName
		$academic_terms->termName->CellCssStyle = ""; $academic_terms->termName->CellCssClass = "";
		$academic_terms->termName->CellAttrs = array(); $academic_terms->termName->ViewAttrs = array(); $academic_terms->termName->EditAttrs = array();

		// status
		$academic_terms->status->CellCssStyle = ""; $academic_terms->status->CellCssClass = "";
		$academic_terms->status->CellAttrs = array(); $academic_terms->status->ViewAttrs = array(); $academic_terms->status->EditAttrs = array();
		if ($academic_terms->RowType == EW_ROWTYPE_VIEW) { // View row

			// termID
			$academic_terms->termID->ViewValue = $academic_terms->termID->CurrentValue;
			$academic_terms->termID->CssStyle = "";
			$academic_terms->termID->CssClass = "";
			$academic_terms->termID->ViewCustomAttributes = "";

			// termName
			$academic_terms->termName->ViewValue = $academic_terms->termName->CurrentValue;
			$academic_terms->termName->CssStyle = "";
			$academic_terms->termName->CssClass = "";
			$academic_terms->termName->ViewCustomAttributes = "";

			// status
			if (strval($academic_terms->status->CurrentValue) <> "") {
				switch ($academic_terms->status->CurrentValue) {
					case "1":
						$academic_terms->status->ViewValue = "Enabled";
						break;
					case "0":
						$academic_terms->status->ViewValue = "Disabled";
						break;
					default:
						$academic_terms->status->ViewValue = $academic_terms->status->CurrentValue;
				}
			} else {
				$academic_terms->status->ViewValue = NULL;
			}
			$academic_terms->status->CssStyle = "";
			$academic_terms->status->CssClass = "";
			$academic_terms->status->ViewCustomAttributes = "";

			// termID
			$academic_terms->termID->HrefValue = "";
			$academic_terms->termID->TooltipValue = "";

			// termName
			$academic_terms->termName->HrefValue = "";
			$academic_terms->termName->TooltipValue = "";

			// status
			$academic_terms->status->HrefValue = "";
			$academic_terms->status->TooltipValue = "";
		} elseif ($academic_terms->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// termID
			$academic_terms->termID->EditCustomAttributes = "";
			$academic_terms->termID->EditValue = $academic_terms->termID->CurrentValue;
			$academic_terms->termID->CssStyle = "";
			$academic_terms->termID->CssClass = "";
			$academic_terms->termID->ViewCustomAttributes = "";

			// termName
			$academic_terms->termName->EditCustomAttributes = "";
			$academic_terms->termName->EditValue = ew_HtmlEncode($academic_terms->termName->CurrentValue);

			// status
			$academic_terms->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$academic_terms->status->EditValue = $arwrk;

			// Edit refer script
			// termID

			$academic_terms->termID->HrefValue = "";

			// termName
			$academic_terms->termName->HrefValue = "";

			// status
			$academic_terms->status->HrefValue = "";
		}

		// Call Row Rendered event
		if ($academic_terms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_terms->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $academic_terms;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($academic_terms->status->FormValue) && $academic_terms->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $academic_terms->status->FldCaption();
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
		global $conn, $Security, $Language, $academic_terms;
		$sFilter = $academic_terms->KeyFilter();
		$academic_terms->CurrentFilter = $sFilter;
		$sSql = $academic_terms->SQL();
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

			// termName
			$academic_terms->termName->SetDbValueDef($rsnew, $academic_terms->termName->CurrentValue, NULL, FALSE);

			// status
			$academic_terms->status->SetDbValueDef($rsnew, $academic_terms->status->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $academic_terms->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($academic_terms->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($academic_terms->CancelMessage <> "") {
					$this->setMessage($academic_terms->CancelMessage);
					$academic_terms->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$academic_terms->Row_Updated($rsold, $rsnew);
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
