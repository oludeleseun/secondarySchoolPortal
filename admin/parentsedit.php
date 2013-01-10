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
$parents_edit = new cparents_edit();
$Page =& $parents_edit;

// Page init
$parents_edit->Page_Init();

// Page main
$parents_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var parents_edit = new ew_Page("parents_edit");

// page properties
parents_edit.PageID = "edit"; // page ID
parents_edit.FormID = "fparentsedit"; // form ID
var EW_PAGE_ID = parents_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
parents_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_firstname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->firstname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_middlename"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->middlename->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lastname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->lastname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_occupation"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->occupation->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_mailingAddress"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->mailingAddress->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_residentialAddress"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->residentialAddress->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_residentState"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->residentState->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stateOfOrigin"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->stateOfOrigin->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_emailAddress"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->emailAddress->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_emailAddress"];
		if (elm && !ew_CheckEmail(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($parents->emailAddress->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_portalUsername"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($parents->portalUsername->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
parents_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
parents_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
parents_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
parents_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $parents->TableCaption() ?><br><br>
<a href="<?php echo $parents->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$parents_edit->ShowMessage();
?>
<form name="fparentsedit" id="fparentsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return parents_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="parents">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($parents->parentID->Visible) { // parentID ?>
	<tr<?php echo $parents->parentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->parentID->FldCaption() ?></td>
		<td<?php echo $parents->parentID->CellAttributes() ?>><span id="el_parentID">
<div<?php echo $parents->parentID->ViewAttributes() ?>><?php echo $parents->parentID->EditValue ?></div><input type="hidden" name="x_parentID" id="x_parentID" value="<?php echo ew_HtmlEncode($parents->parentID->CurrentValue) ?>">
</span><?php echo $parents->parentID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->firstname->Visible) { // firstname ?>
	<tr<?php echo $parents->firstname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->firstname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->firstname->CellAttributes() ?>><span id="el_firstname">
<input type="text" name="x_firstname" id="x_firstname" title="<?php echo $parents->firstname->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $parents->firstname->EditValue ?>"<?php echo $parents->firstname->EditAttributes() ?>>
</span><?php echo $parents->firstname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->middlename->Visible) { // middlename ?>
	<tr<?php echo $parents->middlename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->middlename->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->middlename->CellAttributes() ?>><span id="el_middlename">
<input type="text" name="x_middlename" id="x_middlename" title="<?php echo $parents->middlename->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $parents->middlename->EditValue ?>"<?php echo $parents->middlename->EditAttributes() ?>>
</span><?php echo $parents->middlename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->lastname->Visible) { // lastname ?>
	<tr<?php echo $parents->lastname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->lastname->CellAttributes() ?>><span id="el_lastname">
<input type="text" name="x_lastname" id="x_lastname" title="<?php echo $parents->lastname->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $parents->lastname->EditValue ?>"<?php echo $parents->lastname->EditAttributes() ?>>
</span><?php echo $parents->lastname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->occupation->Visible) { // occupation ?>
	<tr<?php echo $parents->occupation->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->occupation->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->occupation->CellAttributes() ?>><span id="el_occupation">
<input type="text" name="x_occupation" id="x_occupation" title="<?php echo $parents->occupation->FldTitle() ?>" size="30" maxlength="70" value="<?php echo $parents->occupation->EditValue ?>"<?php echo $parents->occupation->EditAttributes() ?>>
</span><?php echo $parents->occupation->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->mailingAddress->Visible) { // mailingAddress ?>
	<tr<?php echo $parents->mailingAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->mailingAddress->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->mailingAddress->CellAttributes() ?>><span id="el_mailingAddress">
<textarea name="x_mailingAddress" id="x_mailingAddress" title="<?php echo $parents->mailingAddress->FldTitle() ?>" cols="35" rows="4"<?php echo $parents->mailingAddress->EditAttributes() ?>><?php echo $parents->mailingAddress->EditValue ?></textarea>
</span><?php echo $parents->mailingAddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->residentialAddress->Visible) { // residentialAddress ?>
	<tr<?php echo $parents->residentialAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->residentialAddress->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->residentialAddress->CellAttributes() ?>><span id="el_residentialAddress">
<textarea name="x_residentialAddress" id="x_residentialAddress" title="<?php echo $parents->residentialAddress->FldTitle() ?>" cols="35" rows="4"<?php echo $parents->residentialAddress->EditAttributes() ?>><?php echo $parents->residentialAddress->EditValue ?></textarea>
</span><?php echo $parents->residentialAddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->residentState->Visible) { // residentState ?>
	<tr<?php echo $parents->residentState->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->residentState->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->residentState->CellAttributes() ?>><span id="el_residentState">
<input type="text" name="x_residentState" id="x_residentState" title="<?php echo $parents->residentState->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $parents->residentState->EditValue ?>"<?php echo $parents->residentState->EditAttributes() ?>>
</span><?php echo $parents->residentState->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->stateOfOrigin->Visible) { // stateOfOrigin ?>
	<tr<?php echo $parents->stateOfOrigin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->stateOfOrigin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->stateOfOrigin->CellAttributes() ?>><span id="el_stateOfOrigin">
<input type="text" name="x_stateOfOrigin" id="x_stateOfOrigin" title="<?php echo $parents->stateOfOrigin->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $parents->stateOfOrigin->EditValue ?>"<?php echo $parents->stateOfOrigin->EditAttributes() ?>>
</span><?php echo $parents->stateOfOrigin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->emailAddress->Visible) { // emailAddress ?>
	<tr<?php echo $parents->emailAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->emailAddress->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->emailAddress->CellAttributes() ?>><span id="el_emailAddress">
<input type="text" name="x_emailAddress" id="x_emailAddress" title="<?php echo $parents->emailAddress->FldTitle() ?>" size="30" maxlength="70" value="<?php echo $parents->emailAddress->EditValue ?>"<?php echo $parents->emailAddress->EditAttributes() ?>>
</span><?php echo $parents->emailAddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->portalUsername->Visible) { // portalUsername ?>
	<tr<?php echo $parents->portalUsername->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->portalUsername->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $parents->portalUsername->CellAttributes() ?>><span id="el_portalUsername">
<input type="text" name="x_portalUsername" id="x_portalUsername" title="<?php echo $parents->portalUsername->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $parents->portalUsername->EditValue ?>"<?php echo $parents->portalUsername->EditAttributes() ?>>
</span><?php echo $parents->portalUsername->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->portalPassword->Visible) { // portalPassword ?>
	<tr<?php echo $parents->portalPassword->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->portalPassword->FldCaption() ?></td>
		<td<?php echo $parents->portalPassword->CellAttributes() ?>><span id="el_portalPassword">
<input type="password" name="x_portalPassword" id="x_portalPassword" title="<?php echo $parents->portalPassword->FldTitle() ?>" value="<?php echo $parents->portalPassword->EditValue ?>" size="20" maxlength="20"<?php echo $parents->portalPassword->EditAttributes() ?>>
</span><?php echo $parents->portalPassword->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($parents->status->Visible) { // status ?>
	<tr<?php echo $parents->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $parents->status->FldCaption() ?></td>
		<td<?php echo $parents->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $parents->status->FldTitle() ?>" value="{value}"<?php echo $parents->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $parents->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($parents->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $parents->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $parents->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $parents->status->CustomMsg ?></td>
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
$parents_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cparents_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'parents';

	// Page object name
	var $PageObjName = 'parents_edit';

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
	function cparents_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (parents)
		$GLOBALS["parents"] = new cparents();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $parents;

		// Load key from QueryString
		if (@$_GET["parentID"] <> "")
			$parents->parentID->setQueryStringValue($_GET["parentID"]);
		if (@$_POST["a_edit"] <> "") {
			$parents->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$parents->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$parents->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$parents->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($parents->parentID->CurrentValue == "")
			$this->Page_Terminate("parentslist.php"); // Invalid key, return to list
		switch ($parents->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("parentslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$parents->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $parents->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$parents->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$parents->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $parents;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $parents;
		$parents->parentID->setFormValue($objForm->GetValue("x_parentID"));
		$parents->firstname->setFormValue($objForm->GetValue("x_firstname"));
		$parents->middlename->setFormValue($objForm->GetValue("x_middlename"));
		$parents->lastname->setFormValue($objForm->GetValue("x_lastname"));
		$parents->occupation->setFormValue($objForm->GetValue("x_occupation"));
		$parents->mailingAddress->setFormValue($objForm->GetValue("x_mailingAddress"));
		$parents->residentialAddress->setFormValue($objForm->GetValue("x_residentialAddress"));
		$parents->residentState->setFormValue($objForm->GetValue("x_residentState"));
		$parents->stateOfOrigin->setFormValue($objForm->GetValue("x_stateOfOrigin"));
		$parents->emailAddress->setFormValue($objForm->GetValue("x_emailAddress"));
		$parents->portalUsername->setFormValue($objForm->GetValue("x_portalUsername"));
		$parents->portalPassword->setFormValue($objForm->GetValue("x_portalPassword"));
		$parents->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $parents;
		$this->LoadRow();
		$parents->parentID->CurrentValue = $parents->parentID->FormValue;
		$parents->firstname->CurrentValue = $parents->firstname->FormValue;
		$parents->middlename->CurrentValue = $parents->middlename->FormValue;
		$parents->lastname->CurrentValue = $parents->lastname->FormValue;
		$parents->occupation->CurrentValue = $parents->occupation->FormValue;
		$parents->mailingAddress->CurrentValue = $parents->mailingAddress->FormValue;
		$parents->residentialAddress->CurrentValue = $parents->residentialAddress->FormValue;
		$parents->residentState->CurrentValue = $parents->residentState->FormValue;
		$parents->stateOfOrigin->CurrentValue = $parents->stateOfOrigin->FormValue;
		$parents->emailAddress->CurrentValue = $parents->emailAddress->FormValue;
		$parents->portalUsername->CurrentValue = $parents->portalUsername->FormValue;
		$parents->portalPassword->CurrentValue = $parents->portalPassword->FormValue;
		$parents->status->CurrentValue = $parents->status->FormValue;
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
		} elseif ($parents->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// parentID
			$parents->parentID->EditCustomAttributes = "";
			$parents->parentID->EditValue = $parents->parentID->CurrentValue;
			$parents->parentID->CssStyle = "";
			$parents->parentID->CssClass = "";
			$parents->parentID->ViewCustomAttributes = "";

			// firstname
			$parents->firstname->EditCustomAttributes = "";
			$parents->firstname->EditValue = ew_HtmlEncode($parents->firstname->CurrentValue);

			// middlename
			$parents->middlename->EditCustomAttributes = "";
			$parents->middlename->EditValue = ew_HtmlEncode($parents->middlename->CurrentValue);

			// lastname
			$parents->lastname->EditCustomAttributes = "";
			$parents->lastname->EditValue = ew_HtmlEncode($parents->lastname->CurrentValue);

			// occupation
			$parents->occupation->EditCustomAttributes = "";
			$parents->occupation->EditValue = ew_HtmlEncode($parents->occupation->CurrentValue);

			// mailingAddress
			$parents->mailingAddress->EditCustomAttributes = "";
			$parents->mailingAddress->EditValue = ew_HtmlEncode($parents->mailingAddress->CurrentValue);

			// residentialAddress
			$parents->residentialAddress->EditCustomAttributes = "";
			$parents->residentialAddress->EditValue = ew_HtmlEncode($parents->residentialAddress->CurrentValue);

			// residentState
			$parents->residentState->EditCustomAttributes = "";
			$parents->residentState->EditValue = ew_HtmlEncode($parents->residentState->CurrentValue);

			// stateOfOrigin
			$parents->stateOfOrigin->EditCustomAttributes = "";
			$parents->stateOfOrigin->EditValue = ew_HtmlEncode($parents->stateOfOrigin->CurrentValue);

			// emailAddress
			$parents->emailAddress->EditCustomAttributes = "";
			$parents->emailAddress->EditValue = ew_HtmlEncode($parents->emailAddress->CurrentValue);

			// portalUsername
			$parents->portalUsername->EditCustomAttributes = "";
			$parents->portalUsername->EditValue = ew_HtmlEncode($parents->portalUsername->CurrentValue);

			// portalPassword
			$parents->portalPassword->EditCustomAttributes = "";
			$parents->portalPassword->EditValue = ew_HtmlEncode($parents->portalPassword->CurrentValue);

			// status
			$parents->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$parents->status->EditValue = $arwrk;

			// Edit refer script
			// parentID

			$parents->parentID->HrefValue = "";

			// firstname
			$parents->firstname->HrefValue = "";

			// middlename
			$parents->middlename->HrefValue = "";

			// lastname
			$parents->lastname->HrefValue = "";

			// occupation
			$parents->occupation->HrefValue = "";

			// mailingAddress
			$parents->mailingAddress->HrefValue = "";

			// residentialAddress
			$parents->residentialAddress->HrefValue = "";

			// residentState
			$parents->residentState->HrefValue = "";

			// stateOfOrigin
			$parents->stateOfOrigin->HrefValue = "";

			// emailAddress
			$parents->emailAddress->HrefValue = "";

			// portalUsername
			$parents->portalUsername->HrefValue = "";

			// portalPassword
			$parents->portalPassword->HrefValue = "";

			// status
			$parents->status->HrefValue = "";
		}

		// Call Row Rendered event
		if ($parents->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$parents->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $parents;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($parents->firstname->FormValue) && $parents->firstname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->firstname->FldCaption();
		}
		if (!is_null($parents->middlename->FormValue) && $parents->middlename->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->middlename->FldCaption();
		}
		if (!is_null($parents->lastname->FormValue) && $parents->lastname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->lastname->FldCaption();
		}
		if (!is_null($parents->occupation->FormValue) && $parents->occupation->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->occupation->FldCaption();
		}
		if (!is_null($parents->mailingAddress->FormValue) && $parents->mailingAddress->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->mailingAddress->FldCaption();
		}
		if (!is_null($parents->residentialAddress->FormValue) && $parents->residentialAddress->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->residentialAddress->FldCaption();
		}
		if (!is_null($parents->residentState->FormValue) && $parents->residentState->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->residentState->FldCaption();
		}
		if (!is_null($parents->stateOfOrigin->FormValue) && $parents->stateOfOrigin->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->stateOfOrigin->FldCaption();
		}
		if (!is_null($parents->emailAddress->FormValue) && $parents->emailAddress->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->emailAddress->FldCaption();
		}
		if (!ew_CheckEmail($parents->emailAddress->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $parents->emailAddress->FldErrMsg();
		}
		if (!is_null($parents->portalUsername->FormValue) && $parents->portalUsername->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $parents->portalUsername->FldCaption();
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
		global $conn, $Security, $Language, $parents;
		$sFilter = $parents->KeyFilter();
			if ($parents->portalUsername->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`portalUsername` = '" . ew_AdjustSql($parents->portalUsername->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$parents->CurrentFilter = $sFilterChk;
			$sSqlChk = $parents->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'portalUsername', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $parents->portalUsername->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$parents->CurrentFilter = $sFilter;
		$sSql = $parents->SQL();
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

			// firstname
			$parents->firstname->SetDbValueDef($rsnew, $parents->firstname->CurrentValue, NULL, FALSE);

			// middlename
			$parents->middlename->SetDbValueDef($rsnew, $parents->middlename->CurrentValue, NULL, FALSE);

			// lastname
			$parents->lastname->SetDbValueDef($rsnew, $parents->lastname->CurrentValue, NULL, FALSE);

			// occupation
			$parents->occupation->SetDbValueDef($rsnew, $parents->occupation->CurrentValue, NULL, FALSE);

			// mailingAddress
			$parents->mailingAddress->SetDbValueDef($rsnew, $parents->mailingAddress->CurrentValue, NULL, FALSE);

			// residentialAddress
			$parents->residentialAddress->SetDbValueDef($rsnew, $parents->residentialAddress->CurrentValue, NULL, FALSE);

			// residentState
			$parents->residentState->SetDbValueDef($rsnew, $parents->residentState->CurrentValue, NULL, FALSE);

			// stateOfOrigin
			$parents->stateOfOrigin->SetDbValueDef($rsnew, $parents->stateOfOrigin->CurrentValue, NULL, FALSE);

			// emailAddress
			$parents->emailAddress->SetDbValueDef($rsnew, $parents->emailAddress->CurrentValue, NULL, FALSE);

			// portalUsername
			$parents->portalUsername->SetDbValueDef($rsnew, $parents->portalUsername->CurrentValue, NULL, FALSE);

			// portalPassword
			$parents->portalPassword->SetDbValueDef($rsnew, $parents->portalPassword->CurrentValue, NULL, FALSE);

			// status
			$parents->status->SetDbValueDef($rsnew, $parents->status->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $parents->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($parents->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($parents->CancelMessage <> "") {
					$this->setMessage($parents->CancelMessage);
					$parents->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$parents->Row_Updated($rsold, $rsnew);
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
