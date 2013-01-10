<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "session_termsinfo.php" ?>
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
$session_terms_edit = new csession_terms_edit();
$Page =& $session_terms_edit;

// Page init
$session_terms_edit->Page_Init();

// Page main
$session_terms_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var session_terms_edit = new ew_Page("session_terms_edit");

// page properties
session_terms_edit.PageID = "edit"; // page ID
session_terms_edit.FormID = "fsession_termsedit"; // form ID
var EW_PAGE_ID = session_terms_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
session_terms_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_session"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($session_terms->session->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_termID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($session_terms->termID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_termStart"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($session_terms->termStart->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_termStart"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($session_terms->termStart->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_termEnd"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($session_terms->termEnd->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_termEnd"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($session_terms->termEnd->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_currentTerm"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($session_terms->currentTerm->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_showResults"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($session_terms->showResults->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($session_terms->status->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
session_terms_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
session_terms_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
session_terms_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
session_terms_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $session_terms->TableCaption() ?><br><br>
<a href="<?php echo $session_terms->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$session_terms_edit->ShowMessage();
?>
<form name="fsession_termsedit" id="fsession_termsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return session_terms_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="session_terms">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($session_terms->sessionTermID->Visible) { // sessionTermID ?>
	<tr<?php echo $session_terms->sessionTermID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->sessionTermID->FldCaption() ?></td>
		<td<?php echo $session_terms->sessionTermID->CellAttributes() ?>><span id="el_sessionTermID">
<div<?php echo $session_terms->sessionTermID->ViewAttributes() ?>><?php echo $session_terms->sessionTermID->EditValue ?></div><input type="hidden" name="x_sessionTermID" id="x_sessionTermID" value="<?php echo ew_HtmlEncode($session_terms->sessionTermID->CurrentValue) ?>">
</span><?php echo $session_terms->sessionTermID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($session_terms->session->Visible) { // session ?>
	<tr<?php echo $session_terms->session->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->session->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $session_terms->session->CellAttributes() ?>><span id="el_session">
<select id="x_session" name="x_session" title="<?php echo $session_terms->session->FldTitle() ?>"<?php echo $session_terms->session->EditAttributes() ?>>
<?php
if (is_array($session_terms->session->EditValue)) {
	$arwrk = $session_terms->session->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($session_terms->session->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $session_terms->session->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($session_terms->termID->Visible) { // termID ?>
	<tr<?php echo $session_terms->termID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->termID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $session_terms->termID->CellAttributes() ?>><span id="el_termID">
<select id="x_termID" name="x_termID" title="<?php echo $session_terms->termID->FldTitle() ?>"<?php echo $session_terms->termID->EditAttributes() ?>>
<?php
if (is_array($session_terms->termID->EditValue)) {
	$arwrk = $session_terms->termID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($session_terms->termID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $session_terms->termID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($session_terms->termStart->Visible) { // termStart ?>
	<tr<?php echo $session_terms->termStart->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->termStart->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $session_terms->termStart->CellAttributes() ?>><span id="el_termStart">
<input type="text" name="x_termStart" id="x_termStart" title="<?php echo $session_terms->termStart->FldTitle() ?>" value="<?php echo $session_terms->termStart->EditValue ?>"<?php echo $session_terms->termStart->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_termStart" name="cal_x_termStart" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_termStart", // input field id
	ifFormat: "%Y/%m/%d", // date format
	button: "cal_x_termStart" // button id
});
</script>
</span><?php echo $session_terms->termStart->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($session_terms->termEnd->Visible) { // termEnd ?>
	<tr<?php echo $session_terms->termEnd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->termEnd->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $session_terms->termEnd->CellAttributes() ?>><span id="el_termEnd">
<input type="text" name="x_termEnd" id="x_termEnd" title="<?php echo $session_terms->termEnd->FldTitle() ?>" value="<?php echo $session_terms->termEnd->EditValue ?>"<?php echo $session_terms->termEnd->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_termEnd" name="cal_x_termEnd" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_termEnd", // input field id
	ifFormat: "%Y/%m/%d", // date format
	button: "cal_x_termEnd" // button id
});
</script>
</span><?php echo $session_terms->termEnd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($session_terms->currentTerm->Visible) { // currentTerm ?>
	<tr<?php echo $session_terms->currentTerm->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->currentTerm->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $session_terms->currentTerm->CellAttributes() ?>><span id="el_currentTerm">
<div id="tp_x_currentTerm" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_currentTerm" id="x_currentTerm" title="<?php echo $session_terms->currentTerm->FldTitle() ?>" value="{value}"<?php echo $session_terms->currentTerm->EditAttributes() ?>></label></div>
<div id="dsl_x_currentTerm" repeatcolumn="5">
<?php
$arwrk = $session_terms->currentTerm->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($session_terms->currentTerm->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_currentTerm" id="x_currentTerm" title="<?php echo $session_terms->currentTerm->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $session_terms->currentTerm->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $session_terms->currentTerm->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($session_terms->showResults->Visible) { // showResults ?>
	<tr<?php echo $session_terms->showResults->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->showResults->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $session_terms->showResults->CellAttributes() ?>><span id="el_showResults">
<div id="tp_x_showResults" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_showResults" id="x_showResults" title="<?php echo $session_terms->showResults->FldTitle() ?>" value="{value}"<?php echo $session_terms->showResults->EditAttributes() ?>></label></div>
<div id="dsl_x_showResults" repeatcolumn="5">
<?php
$arwrk = $session_terms->showResults->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($session_terms->showResults->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_showResults" id="x_showResults" title="<?php echo $session_terms->showResults->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $session_terms->showResults->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $session_terms->showResults->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($session_terms->status->Visible) { // status ?>
	<tr<?php echo $session_terms->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $session_terms->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $session_terms->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $session_terms->status->FldTitle() ?>" value="{value}"<?php echo $session_terms->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $session_terms->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($session_terms->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $session_terms->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $session_terms->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $session_terms->status->CustomMsg ?></td>
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
$session_terms_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class csession_terms_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'session_terms';

	// Page object name
	var $PageObjName = 'session_terms_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $session_terms;
		if ($session_terms->UseTokenInUrl) $PageUrl .= "t=" . $session_terms->TableVar . "&"; // Add page token
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
		global $objForm, $session_terms;
		if ($session_terms->UseTokenInUrl) {
			if ($objForm)
				return ($session_terms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($session_terms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csession_terms_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (session_terms)
		$GLOBALS["session_terms"] = new csession_terms();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'session_terms', TRUE);

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
		global $session_terms;

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
		global $objForm, $Language, $gsFormError, $session_terms;

		// Load key from QueryString
		if (@$_GET["sessionTermID"] <> "")
			$session_terms->sessionTermID->setQueryStringValue($_GET["sessionTermID"]);
		if (@$_POST["a_edit"] <> "") {
			$session_terms->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$session_terms->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$session_terms->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$session_terms->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($session_terms->sessionTermID->CurrentValue == "")
			$this->Page_Terminate("session_termslist.php"); // Invalid key, return to list
		switch ($session_terms->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("session_termslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$session_terms->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $session_terms->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$session_terms->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$session_terms->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $session_terms;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $session_terms;
		$session_terms->sessionTermID->setFormValue($objForm->GetValue("x_sessionTermID"));
		$session_terms->session->setFormValue($objForm->GetValue("x_session"));
		$session_terms->termID->setFormValue($objForm->GetValue("x_termID"));
		$session_terms->termStart->setFormValue($objForm->GetValue("x_termStart"));
		$session_terms->termStart->CurrentValue = ew_UnFormatDateTime($session_terms->termStart->CurrentValue, 5);
		$session_terms->termEnd->setFormValue($objForm->GetValue("x_termEnd"));
		$session_terms->termEnd->CurrentValue = ew_UnFormatDateTime($session_terms->termEnd->CurrentValue, 5);
		$session_terms->currentTerm->setFormValue($objForm->GetValue("x_currentTerm"));
		$session_terms->showResults->setFormValue($objForm->GetValue("x_showResults"));
		$session_terms->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $session_terms;
		$this->LoadRow();
		$session_terms->sessionTermID->CurrentValue = $session_terms->sessionTermID->FormValue;
		$session_terms->session->CurrentValue = $session_terms->session->FormValue;
		$session_terms->termID->CurrentValue = $session_terms->termID->FormValue;
		$session_terms->termStart->CurrentValue = $session_terms->termStart->FormValue;
		$session_terms->termStart->CurrentValue = ew_UnFormatDateTime($session_terms->termStart->CurrentValue, 5);
		$session_terms->termEnd->CurrentValue = $session_terms->termEnd->FormValue;
		$session_terms->termEnd->CurrentValue = ew_UnFormatDateTime($session_terms->termEnd->CurrentValue, 5);
		$session_terms->currentTerm->CurrentValue = $session_terms->currentTerm->FormValue;
		$session_terms->showResults->CurrentValue = $session_terms->showResults->FormValue;
		$session_terms->status->CurrentValue = $session_terms->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $session_terms;
		$sFilter = $session_terms->KeyFilter();

		// Call Row Selecting event
		$session_terms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$session_terms->CurrentFilter = $sFilter;
		$sSql = $session_terms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$session_terms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $session_terms;
		$session_terms->sessionTermID->setDbValue($rs->fields('sessionTermID'));
		$session_terms->session->setDbValue($rs->fields('session'));
		$session_terms->termID->setDbValue($rs->fields('termID'));
		$session_terms->termStart->setDbValue($rs->fields('termStart'));
		$session_terms->termEnd->setDbValue($rs->fields('termEnd'));
		$session_terms->currentTerm->setDbValue($rs->fields('currentTerm'));
		$session_terms->showResults->setDbValue($rs->fields('showResults'));
		$session_terms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $session_terms;

		// Initialize URLs
		// Call Row_Rendering event

		$session_terms->Row_Rendering();

		// Common render codes for all row types
		// sessionTermID

		$session_terms->sessionTermID->CellCssStyle = ""; $session_terms->sessionTermID->CellCssClass = "";
		$session_terms->sessionTermID->CellAttrs = array(); $session_terms->sessionTermID->ViewAttrs = array(); $session_terms->sessionTermID->EditAttrs = array();

		// session
		$session_terms->session->CellCssStyle = ""; $session_terms->session->CellCssClass = "";
		$session_terms->session->CellAttrs = array(); $session_terms->session->ViewAttrs = array(); $session_terms->session->EditAttrs = array();

		// termID
		$session_terms->termID->CellCssStyle = ""; $session_terms->termID->CellCssClass = "";
		$session_terms->termID->CellAttrs = array(); $session_terms->termID->ViewAttrs = array(); $session_terms->termID->EditAttrs = array();

		// termStart
		$session_terms->termStart->CellCssStyle = ""; $session_terms->termStart->CellCssClass = "";
		$session_terms->termStart->CellAttrs = array(); $session_terms->termStart->ViewAttrs = array(); $session_terms->termStart->EditAttrs = array();

		// termEnd
		$session_terms->termEnd->CellCssStyle = ""; $session_terms->termEnd->CellCssClass = "";
		$session_terms->termEnd->CellAttrs = array(); $session_terms->termEnd->ViewAttrs = array(); $session_terms->termEnd->EditAttrs = array();

		// currentTerm
		$session_terms->currentTerm->CellCssStyle = ""; $session_terms->currentTerm->CellCssClass = "";
		$session_terms->currentTerm->CellAttrs = array(); $session_terms->currentTerm->ViewAttrs = array(); $session_terms->currentTerm->EditAttrs = array();

		// showResults
		$session_terms->showResults->CellCssStyle = ""; $session_terms->showResults->CellCssClass = "";
		$session_terms->showResults->CellAttrs = array(); $session_terms->showResults->ViewAttrs = array(); $session_terms->showResults->EditAttrs = array();

		// status
		$session_terms->status->CellCssStyle = ""; $session_terms->status->CellCssClass = "";
		$session_terms->status->CellAttrs = array(); $session_terms->status->ViewAttrs = array(); $session_terms->status->EditAttrs = array();
		if ($session_terms->RowType == EW_ROWTYPE_VIEW) { // View row

			// sessionTermID
			$session_terms->sessionTermID->ViewValue = $session_terms->sessionTermID->CurrentValue;
			$session_terms->sessionTermID->CssStyle = "";
			$session_terms->sessionTermID->CssClass = "";
			$session_terms->sessionTermID->ViewCustomAttributes = "";

			// session
			if (strval($session_terms->session->CurrentValue) <> "") {
				$sFilterWrk = "`sessionID` = " . ew_AdjustSql($session_terms->session->CurrentValue) . "";
			$sSqlWrk = "SELECT `sessionName` FROM `academic_sessions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$session_terms->session->ViewValue = $rswrk->fields('sessionName');
					$rswrk->Close();
				} else {
					$session_terms->session->ViewValue = $session_terms->session->CurrentValue;
				}
			} else {
				$session_terms->session->ViewValue = NULL;
			}
			$session_terms->session->CssStyle = "";
			$session_terms->session->CssClass = "";
			$session_terms->session->ViewCustomAttributes = "";

			// termID
			if (strval($session_terms->termID->CurrentValue) <> "") {
				$sFilterWrk = "`termID` = " . ew_AdjustSql($session_terms->termID->CurrentValue) . "";
			$sSqlWrk = "SELECT `termName` FROM `academic_terms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$session_terms->termID->ViewValue = $rswrk->fields('termName');
					$rswrk->Close();
				} else {
					$session_terms->termID->ViewValue = $session_terms->termID->CurrentValue;
				}
			} else {
				$session_terms->termID->ViewValue = NULL;
			}
			$session_terms->termID->CssStyle = "";
			$session_terms->termID->CssClass = "";
			$session_terms->termID->ViewCustomAttributes = "";

			// termStart
			$session_terms->termStart->ViewValue = $session_terms->termStart->CurrentValue;
			$session_terms->termStart->ViewValue = ew_FormatDateTime($session_terms->termStart->ViewValue, 5);
			$session_terms->termStart->CssStyle = "";
			$session_terms->termStart->CssClass = "";
			$session_terms->termStart->ViewCustomAttributes = "";

			// termEnd
			$session_terms->termEnd->ViewValue = $session_terms->termEnd->CurrentValue;
			$session_terms->termEnd->ViewValue = ew_FormatDateTime($session_terms->termEnd->ViewValue, 5);
			$session_terms->termEnd->CssStyle = "";
			$session_terms->termEnd->CssClass = "";
			$session_terms->termEnd->ViewCustomAttributes = "";

			// currentTerm
			if (strval($session_terms->currentTerm->CurrentValue) <> "") {
				switch ($session_terms->currentTerm->CurrentValue) {
					case "1":
						$session_terms->currentTerm->ViewValue = "Yes";
						break;
					case "0":
						$session_terms->currentTerm->ViewValue = "No";
						break;
					default:
						$session_terms->currentTerm->ViewValue = $session_terms->currentTerm->CurrentValue;
				}
			} else {
				$session_terms->currentTerm->ViewValue = NULL;
			}
			$session_terms->currentTerm->CssStyle = "";
			$session_terms->currentTerm->CssClass = "";
			$session_terms->currentTerm->ViewCustomAttributes = "";

			// showResults
			if (strval($session_terms->showResults->CurrentValue) <> "") {
				switch ($session_terms->showResults->CurrentValue) {
					case "1":
						$session_terms->showResults->ViewValue = "Yes";
						break;
					case "0":
						$session_terms->showResults->ViewValue = "No";
						break;
					default:
						$session_terms->showResults->ViewValue = $session_terms->showResults->CurrentValue;
				}
			} else {
				$session_terms->showResults->ViewValue = NULL;
			}
			$session_terms->showResults->CssStyle = "";
			$session_terms->showResults->CssClass = "";
			$session_terms->showResults->ViewCustomAttributes = "";

			// status
			if (strval($session_terms->status->CurrentValue) <> "") {
				switch ($session_terms->status->CurrentValue) {
					case "1":
						$session_terms->status->ViewValue = "Enabled";
						break;
					case "0":
						$session_terms->status->ViewValue = "Disabled";
						break;
					default:
						$session_terms->status->ViewValue = $session_terms->status->CurrentValue;
				}
			} else {
				$session_terms->status->ViewValue = NULL;
			}
			$session_terms->status->CssStyle = "";
			$session_terms->status->CssClass = "";
			$session_terms->status->ViewCustomAttributes = "";

			// sessionTermID
			$session_terms->sessionTermID->HrefValue = "";
			$session_terms->sessionTermID->TooltipValue = "";

			// session
			$session_terms->session->HrefValue = "";
			$session_terms->session->TooltipValue = "";

			// termID
			$session_terms->termID->HrefValue = "";
			$session_terms->termID->TooltipValue = "";

			// termStart
			$session_terms->termStart->HrefValue = "";
			$session_terms->termStart->TooltipValue = "";

			// termEnd
			$session_terms->termEnd->HrefValue = "";
			$session_terms->termEnd->TooltipValue = "";

			// currentTerm
			$session_terms->currentTerm->HrefValue = "";
			$session_terms->currentTerm->TooltipValue = "";

			// showResults
			$session_terms->showResults->HrefValue = "";
			$session_terms->showResults->TooltipValue = "";

			// status
			$session_terms->status->HrefValue = "";
			$session_terms->status->TooltipValue = "";
		} elseif ($session_terms->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// sessionTermID
			$session_terms->sessionTermID->EditCustomAttributes = "";
			$session_terms->sessionTermID->EditValue = $session_terms->sessionTermID->CurrentValue;
			$session_terms->sessionTermID->CssStyle = "";
			$session_terms->sessionTermID->CssClass = "";
			$session_terms->sessionTermID->ViewCustomAttributes = "";

			// session
			$session_terms->session->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `sessionID`, `sessionName`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `academic_sessions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$session_terms->session->EditValue = $arwrk;

			// termID
			$session_terms->termID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `termID`, `termName`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `academic_terms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$session_terms->termID->EditValue = $arwrk;

			// termStart
			$session_terms->termStart->EditCustomAttributes = "";
			$session_terms->termStart->EditValue = ew_HtmlEncode(ew_FormatDateTime($session_terms->termStart->CurrentValue, 5));

			// termEnd
			$session_terms->termEnd->EditCustomAttributes = "";
			$session_terms->termEnd->EditValue = ew_HtmlEncode(ew_FormatDateTime($session_terms->termEnd->CurrentValue, 5));

			// currentTerm
			$session_terms->currentTerm->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Yes");
			$arwrk[] = array("0", "No");
			$session_terms->currentTerm->EditValue = $arwrk;

			// showResults
			$session_terms->showResults->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Yes");
			$arwrk[] = array("0", "No");
			$session_terms->showResults->EditValue = $arwrk;

			// status
			$session_terms->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$session_terms->status->EditValue = $arwrk;

			// Edit refer script
			// sessionTermID

			$session_terms->sessionTermID->HrefValue = "";

			// session
			$session_terms->session->HrefValue = "";

			// termID
			$session_terms->termID->HrefValue = "";

			// termStart
			$session_terms->termStart->HrefValue = "";

			// termEnd
			$session_terms->termEnd->HrefValue = "";

			// currentTerm
			$session_terms->currentTerm->HrefValue = "";

			// showResults
			$session_terms->showResults->HrefValue = "";

			// status
			$session_terms->status->HrefValue = "";
		}

		// Call Row Rendered event
		if ($session_terms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$session_terms->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $session_terms;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($session_terms->session->FormValue) && $session_terms->session->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $session_terms->session->FldCaption();
		}
		if (!is_null($session_terms->termID->FormValue) && $session_terms->termID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $session_terms->termID->FldCaption();
		}
		if (!is_null($session_terms->termStart->FormValue) && $session_terms->termStart->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $session_terms->termStart->FldCaption();
		}
		if (!ew_CheckDate($session_terms->termStart->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $session_terms->termStart->FldErrMsg();
		}
		if (!is_null($session_terms->termEnd->FormValue) && $session_terms->termEnd->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $session_terms->termEnd->FldCaption();
		}
		if (!ew_CheckDate($session_terms->termEnd->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $session_terms->termEnd->FldErrMsg();
		}
		if ($session_terms->currentTerm->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $session_terms->currentTerm->FldCaption();
		}
		if ($session_terms->showResults->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $session_terms->showResults->FldCaption();
		}
		if ($session_terms->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $session_terms->status->FldCaption();
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
		global $conn, $Security, $Language, $session_terms;
		$sFilter = $session_terms->KeyFilter();
		$session_terms->CurrentFilter = $sFilter;
		$sSql = $session_terms->SQL();
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

			// session
			$session_terms->session->SetDbValueDef($rsnew, $session_terms->session->CurrentValue, NULL, FALSE);

			// termID
			$session_terms->termID->SetDbValueDef($rsnew, $session_terms->termID->CurrentValue, NULL, FALSE);

			// termStart
			$session_terms->termStart->SetDbValueDef($rsnew, ew_UnFormatDateTime($session_terms->termStart->CurrentValue, 5, FALSE), NULL);

			// termEnd
			$session_terms->termEnd->SetDbValueDef($rsnew, ew_UnFormatDateTime($session_terms->termEnd->CurrentValue, 5, FALSE), NULL);

			// currentTerm
			$session_terms->currentTerm->SetDbValueDef($rsnew, $session_terms->currentTerm->CurrentValue, NULL, FALSE);

			// showResults
			$session_terms->showResults->SetDbValueDef($rsnew, $session_terms->showResults->CurrentValue, NULL, FALSE);

			// status
			$session_terms->status->SetDbValueDef($rsnew, $session_terms->status->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $session_terms->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($session_terms->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($session_terms->CancelMessage <> "") {
					$this->setMessage($session_terms->CancelMessage);
					$session_terms->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$session_terms->Row_Updated($rsold, $rsnew);
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
