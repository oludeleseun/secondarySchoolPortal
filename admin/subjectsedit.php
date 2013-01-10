<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "subjectsinfo.php" ?>
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
$subjects_edit = new csubjects_edit();
$Page =& $subjects_edit;

// Page init
$subjects_edit->Page_Init();

// Page main
$subjects_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subjects_edit = new ew_Page("subjects_edit");

// page properties
subjects_edit.PageID = "edit"; // page ID
subjects_edit.FormID = "fsubjectsedit"; // form ID
var EW_PAGE_ID = subjects_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
subjects_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_subjectDescription"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subjects->subjectDescription->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subjects->status->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
subjects_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subjects_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subjects_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subjects_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subjects->TableCaption() ?><br><br>
<a href="<?php echo $subjects->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subjects_edit->ShowMessage();
?>
<form name="fsubjectsedit" id="fsubjectsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subjects_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="subjects">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subjects->subjectID->Visible) { // subjectID ?>
	<tr<?php echo $subjects->subjectID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subjects->subjectID->FldCaption() ?></td>
		<td<?php echo $subjects->subjectID->CellAttributes() ?>><span id="el_subjectID">
<div<?php echo $subjects->subjectID->ViewAttributes() ?>><?php echo $subjects->subjectID->EditValue ?></div><input type="hidden" name="x_subjectID" id="x_subjectID" value="<?php echo ew_HtmlEncode($subjects->subjectID->CurrentValue) ?>">
</span><?php echo $subjects->subjectID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subjects->subjectName->Visible) { // subjectName ?>
	<tr<?php echo $subjects->subjectName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subjects->subjectName->FldCaption() ?></td>
		<td<?php echo $subjects->subjectName->CellAttributes() ?>><span id="el_subjectName">
<input type="text" name="x_subjectName" id="x_subjectName" title="<?php echo $subjects->subjectName->FldTitle() ?>" size="30" maxlength="30" value="<?php echo $subjects->subjectName->EditValue ?>"<?php echo $subjects->subjectName->EditAttributes() ?>>
</span><?php echo $subjects->subjectName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subjects->subjectDescription->Visible) { // subjectDescription ?>
	<tr<?php echo $subjects->subjectDescription->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subjects->subjectDescription->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subjects->subjectDescription->CellAttributes() ?>><span id="el_subjectDescription">
<textarea name="x_subjectDescription" id="x_subjectDescription" title="<?php echo $subjects->subjectDescription->FldTitle() ?>" cols="35" rows="4"<?php echo $subjects->subjectDescription->EditAttributes() ?>><?php echo $subjects->subjectDescription->EditValue ?></textarea>
</span><?php echo $subjects->subjectDescription->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subjects->status->Visible) { // status ?>
	<tr<?php echo $subjects->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subjects->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subjects->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $subjects->status->FldTitle() ?>" value="{value}"<?php echo $subjects->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $subjects->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subjects->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $subjects->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $subjects->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $subjects->status->CustomMsg ?></td>
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
$subjects_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class csubjects_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'subjects';

	// Page object name
	var $PageObjName = 'subjects_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subjects;
		if ($subjects->UseTokenInUrl) $PageUrl .= "t=" . $subjects->TableVar . "&"; // Add page token
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
		global $objForm, $subjects;
		if ($subjects->UseTokenInUrl) {
			if ($objForm)
				return ($subjects->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subjects->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubjects_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subjects)
		$GLOBALS["subjects"] = new csubjects();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subjects', TRUE);

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
		global $subjects;

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
		global $objForm, $Language, $gsFormError, $subjects;

		// Load key from QueryString
		if (@$_GET["subjectID"] <> "")
			$subjects->subjectID->setQueryStringValue($_GET["subjectID"]);
		if (@$_POST["a_edit"] <> "") {
			$subjects->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subjects->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$subjects->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$subjects->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($subjects->subjectID->CurrentValue == "")
			$this->Page_Terminate("subjectslist.php"); // Invalid key, return to list
		switch ($subjects->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("subjectslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$subjects->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $subjects->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$subjects->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$subjects->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subjects;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subjects;
		$subjects->subjectID->setFormValue($objForm->GetValue("x_subjectID"));
		$subjects->subjectName->setFormValue($objForm->GetValue("x_subjectName"));
		$subjects->subjectDescription->setFormValue($objForm->GetValue("x_subjectDescription"));
		$subjects->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subjects;
		$this->LoadRow();
		$subjects->subjectID->CurrentValue = $subjects->subjectID->FormValue;
		$subjects->subjectName->CurrentValue = $subjects->subjectName->FormValue;
		$subjects->subjectDescription->CurrentValue = $subjects->subjectDescription->FormValue;
		$subjects->status->CurrentValue = $subjects->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subjects;
		$sFilter = $subjects->KeyFilter();

		// Call Row Selecting event
		$subjects->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subjects->CurrentFilter = $sFilter;
		$sSql = $subjects->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subjects->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subjects;
		$subjects->subjectID->setDbValue($rs->fields('subjectID'));
		$subjects->subjectName->setDbValue($rs->fields('subjectName'));
		$subjects->subjectDescription->setDbValue($rs->fields('subjectDescription'));
		$subjects->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subjects;

		// Initialize URLs
		// Call Row_Rendering event

		$subjects->Row_Rendering();

		// Common render codes for all row types
		// subjectID

		$subjects->subjectID->CellCssStyle = ""; $subjects->subjectID->CellCssClass = "";
		$subjects->subjectID->CellAttrs = array(); $subjects->subjectID->ViewAttrs = array(); $subjects->subjectID->EditAttrs = array();

		// subjectName
		$subjects->subjectName->CellCssStyle = ""; $subjects->subjectName->CellCssClass = "";
		$subjects->subjectName->CellAttrs = array(); $subjects->subjectName->ViewAttrs = array(); $subjects->subjectName->EditAttrs = array();

		// subjectDescription
		$subjects->subjectDescription->CellCssStyle = ""; $subjects->subjectDescription->CellCssClass = "";
		$subjects->subjectDescription->CellAttrs = array(); $subjects->subjectDescription->ViewAttrs = array(); $subjects->subjectDescription->EditAttrs = array();

		// status
		$subjects->status->CellCssStyle = ""; $subjects->status->CellCssClass = "";
		$subjects->status->CellAttrs = array(); $subjects->status->ViewAttrs = array(); $subjects->status->EditAttrs = array();
		if ($subjects->RowType == EW_ROWTYPE_VIEW) { // View row

			// subjectID
			$subjects->subjectID->ViewValue = $subjects->subjectID->CurrentValue;
			$subjects->subjectID->CssStyle = "";
			$subjects->subjectID->CssClass = "";
			$subjects->subjectID->ViewCustomAttributes = "";

			// subjectName
			$subjects->subjectName->ViewValue = $subjects->subjectName->CurrentValue;
			$subjects->subjectName->CssStyle = "";
			$subjects->subjectName->CssClass = "";
			$subjects->subjectName->ViewCustomAttributes = "";

			// subjectDescription
			$subjects->subjectDescription->ViewValue = $subjects->subjectDescription->CurrentValue;
			$subjects->subjectDescription->CssStyle = "";
			$subjects->subjectDescription->CssClass = "";
			$subjects->subjectDescription->ViewCustomAttributes = "";

			// status
			if (strval($subjects->status->CurrentValue) <> "") {
				switch ($subjects->status->CurrentValue) {
					case "1":
						$subjects->status->ViewValue = "Enabled";
						break;
					case "0":
						$subjects->status->ViewValue = "Disabled";
						break;
					default:
						$subjects->status->ViewValue = $subjects->status->CurrentValue;
				}
			} else {
				$subjects->status->ViewValue = NULL;
			}
			$subjects->status->CssStyle = "";
			$subjects->status->CssClass = "";
			$subjects->status->ViewCustomAttributes = "";

			// subjectID
			$subjects->subjectID->HrefValue = "";
			$subjects->subjectID->TooltipValue = "";

			// subjectName
			$subjects->subjectName->HrefValue = "";
			$subjects->subjectName->TooltipValue = "";

			// subjectDescription
			$subjects->subjectDescription->HrefValue = "";
			$subjects->subjectDescription->TooltipValue = "";

			// status
			$subjects->status->HrefValue = "";
			$subjects->status->TooltipValue = "";
		} elseif ($subjects->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// subjectID
			$subjects->subjectID->EditCustomAttributes = "";
			$subjects->subjectID->EditValue = $subjects->subjectID->CurrentValue;
			$subjects->subjectID->CssStyle = "";
			$subjects->subjectID->CssClass = "";
			$subjects->subjectID->ViewCustomAttributes = "";

			// subjectName
			$subjects->subjectName->EditCustomAttributes = "";
			$subjects->subjectName->EditValue = ew_HtmlEncode($subjects->subjectName->CurrentValue);

			// subjectDescription
			$subjects->subjectDescription->EditCustomAttributes = "";
			$subjects->subjectDescription->EditValue = ew_HtmlEncode($subjects->subjectDescription->CurrentValue);

			// status
			$subjects->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$subjects->status->EditValue = $arwrk;

			// Edit refer script
			// subjectID

			$subjects->subjectID->HrefValue = "";

			// subjectName
			$subjects->subjectName->HrefValue = "";

			// subjectDescription
			$subjects->subjectDescription->HrefValue = "";

			// status
			$subjects->status->HrefValue = "";
		}

		// Call Row Rendered event
		if ($subjects->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subjects->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subjects;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($subjects->subjectDescription->FormValue) && $subjects->subjectDescription->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subjects->subjectDescription->FldCaption();
		}
		if ($subjects->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subjects->status->FldCaption();
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
		global $conn, $Security, $Language, $subjects;
		$sFilter = $subjects->KeyFilter();
			if ($subjects->subjectName->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`subjectName` = '" . ew_AdjustSql($subjects->subjectName->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$subjects->CurrentFilter = $sFilterChk;
			$sSqlChk = $subjects->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'subjectName', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $subjects->subjectName->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$subjects->CurrentFilter = $sFilter;
		$sSql = $subjects->SQL();
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

			// subjectName
			$subjects->subjectName->SetDbValueDef($rsnew, $subjects->subjectName->CurrentValue, NULL, FALSE);

			// subjectDescription
			$subjects->subjectDescription->SetDbValueDef($rsnew, $subjects->subjectDescription->CurrentValue, NULL, FALSE);

			// status
			$subjects->status->SetDbValueDef($rsnew, $subjects->status->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $subjects->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($subjects->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($subjects->CancelMessage <> "") {
					$this->setMessage($subjects->CancelMessage);
					$subjects->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$subjects->Row_Updated($rsold, $rsnew);
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
