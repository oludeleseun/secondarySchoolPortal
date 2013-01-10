<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_sessionsinfo.php" ?>
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
$academic_sessions_add = new cacademic_sessions_add();
$Page =& $academic_sessions_add;

// Page init
$academic_sessions_add->Page_Init();

// Page main
$academic_sessions_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var academic_sessions_add = new ew_Page("academic_sessions_add");

// page properties
academic_sessions_add.PageID = "add"; // page ID
academic_sessions_add.FormID = "facademic_sessionsadd"; // form ID
var EW_PAGE_ID = academic_sessions_add.PageID; // for backward compatibility

// extend page with ValidateForm function
academic_sessions_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_sessionStart"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($academic_sessions->sessionStart->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_sessionStart"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($academic_sessions->sessionStart->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_sessionEnd"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($academic_sessions->sessionEnd->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_sessionEnd"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($academic_sessions->sessionEnd->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_currentSession"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($academic_sessions->currentSession->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($academic_sessions->status->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
academic_sessions_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
academic_sessions_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_sessions_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_sessions_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_sessions->TableCaption() ?><br><br>
<a href="<?php echo $academic_sessions->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_sessions_add->ShowMessage();
?>
<form name="facademic_sessionsadd" id="facademic_sessionsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return academic_sessions_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="academic_sessions">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($academic_sessions->sessionName->Visible) { // sessionName ?>
	<tr<?php echo $academic_sessions->sessionName->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->sessionName->FldCaption() ?></td>
		<td<?php echo $academic_sessions->sessionName->CellAttributes() ?>><span id="el_sessionName">
<input type="text" name="x_sessionName" id="x_sessionName" title="<?php echo $academic_sessions->sessionName->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $academic_sessions->sessionName->EditValue ?>"<?php echo $academic_sessions->sessionName->EditAttributes() ?>>
</span><?php echo $academic_sessions->sessionName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($academic_sessions->sessionStart->Visible) { // sessionStart ?>
	<tr<?php echo $academic_sessions->sessionStart->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->sessionStart->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $academic_sessions->sessionStart->CellAttributes() ?>><span id="el_sessionStart">
<input type="text" name="x_sessionStart" id="x_sessionStart" title="<?php echo $academic_sessions->sessionStart->FldTitle() ?>" value="<?php echo $academic_sessions->sessionStart->EditValue ?>"<?php echo $academic_sessions->sessionStart->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_sessionStart" name="cal_x_sessionStart" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_sessionStart", // input field id
	ifFormat: "%Y/%m/%d", // date format
	button: "cal_x_sessionStart" // button id
});
</script>
</span><?php echo $academic_sessions->sessionStart->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($academic_sessions->sessionEnd->Visible) { // sessionEnd ?>
	<tr<?php echo $academic_sessions->sessionEnd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->sessionEnd->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $academic_sessions->sessionEnd->CellAttributes() ?>><span id="el_sessionEnd">
<input type="text" name="x_sessionEnd" id="x_sessionEnd" title="<?php echo $academic_sessions->sessionEnd->FldTitle() ?>" value="<?php echo $academic_sessions->sessionEnd->EditValue ?>"<?php echo $academic_sessions->sessionEnd->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_sessionEnd" name="cal_x_sessionEnd" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_sessionEnd", // input field id
	ifFormat: "%Y/%m/%d", // date format
	button: "cal_x_sessionEnd" // button id
});
</script>
</span><?php echo $academic_sessions->sessionEnd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($academic_sessions->currentSession->Visible) { // currentSession ?>
	<tr<?php echo $academic_sessions->currentSession->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->currentSession->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $academic_sessions->currentSession->CellAttributes() ?>><span id="el_currentSession">
<select id="x_currentSession" name="x_currentSession" title="<?php echo $academic_sessions->currentSession->FldTitle() ?>"<?php echo $academic_sessions->currentSession->EditAttributes() ?>>
<?php
if (is_array($academic_sessions->currentSession->EditValue)) {
	$arwrk = $academic_sessions->currentSession->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($academic_sessions->currentSession->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $academic_sessions->currentSession->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($academic_sessions->status->Visible) { // status ?>
	<tr<?php echo $academic_sessions->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $academic_sessions->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $academic_sessions->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $academic_sessions->status->FldTitle() ?>" value="{value}"<?php echo $academic_sessions->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $academic_sessions->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($academic_sessions->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $academic_sessions->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $academic_sessions->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $academic_sessions->status->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$academic_sessions_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_sessions_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'academic_sessions';

	// Page object name
	var $PageObjName = 'academic_sessions_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_sessions;
		if ($academic_sessions->UseTokenInUrl) $PageUrl .= "t=" . $academic_sessions->TableVar . "&"; // Add page token
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
		global $objForm, $academic_sessions;
		if ($academic_sessions->UseTokenInUrl) {
			if ($objForm)
				return ($academic_sessions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_sessions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_sessions_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_sessions)
		$GLOBALS["academic_sessions"] = new cacademic_sessions();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_sessions', TRUE);

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
		global $academic_sessions;

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $academic_sessions;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["sessionID"] != "") {
		  $academic_sessions->sessionID->setQueryStringValue($_GET["sessionID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $academic_sessions->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$academic_sessions->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $academic_sessions->CurrentAction = "C"; // Copy record
		  } else {
		    $academic_sessions->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($academic_sessions->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("academic_sessionslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$academic_sessions->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $academic_sessions->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$academic_sessions->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $academic_sessions;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $academic_sessions;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $academic_sessions;
		$academic_sessions->sessionName->setFormValue($objForm->GetValue("x_sessionName"));
		$academic_sessions->sessionStart->setFormValue($objForm->GetValue("x_sessionStart"));
		$academic_sessions->sessionStart->CurrentValue = ew_UnFormatDateTime($academic_sessions->sessionStart->CurrentValue, 5);
		$academic_sessions->sessionEnd->setFormValue($objForm->GetValue("x_sessionEnd"));
		$academic_sessions->sessionEnd->CurrentValue = ew_UnFormatDateTime($academic_sessions->sessionEnd->CurrentValue, 5);
		$academic_sessions->currentSession->setFormValue($objForm->GetValue("x_currentSession"));
		$academic_sessions->status->setFormValue($objForm->GetValue("x_status"));
		$academic_sessions->sessionID->setFormValue($objForm->GetValue("x_sessionID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $academic_sessions;
		$academic_sessions->sessionID->CurrentValue = $academic_sessions->sessionID->FormValue;
		$academic_sessions->sessionName->CurrentValue = $academic_sessions->sessionName->FormValue;
		$academic_sessions->sessionStart->CurrentValue = $academic_sessions->sessionStart->FormValue;
		$academic_sessions->sessionStart->CurrentValue = ew_UnFormatDateTime($academic_sessions->sessionStart->CurrentValue, 5);
		$academic_sessions->sessionEnd->CurrentValue = $academic_sessions->sessionEnd->FormValue;
		$academic_sessions->sessionEnd->CurrentValue = ew_UnFormatDateTime($academic_sessions->sessionEnd->CurrentValue, 5);
		$academic_sessions->currentSession->CurrentValue = $academic_sessions->currentSession->FormValue;
		$academic_sessions->status->CurrentValue = $academic_sessions->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_sessions;
		$sFilter = $academic_sessions->KeyFilter();

		// Call Row Selecting event
		$academic_sessions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_sessions->CurrentFilter = $sFilter;
		$sSql = $academic_sessions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_sessions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_sessions;
		$academic_sessions->sessionID->setDbValue($rs->fields('sessionID'));
		$academic_sessions->sessionName->setDbValue($rs->fields('sessionName'));
		$academic_sessions->sessionStart->setDbValue($rs->fields('sessionStart'));
		$academic_sessions->sessionEnd->setDbValue($rs->fields('sessionEnd'));
		$academic_sessions->currentSession->setDbValue($rs->fields('currentSession'));
		$academic_sessions->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_sessions;

		// Initialize URLs
		// Call Row_Rendering event

		$academic_sessions->Row_Rendering();

		// Common render codes for all row types
		// sessionName

		$academic_sessions->sessionName->CellCssStyle = ""; $academic_sessions->sessionName->CellCssClass = "";
		$academic_sessions->sessionName->CellAttrs = array(); $academic_sessions->sessionName->ViewAttrs = array(); $academic_sessions->sessionName->EditAttrs = array();

		// sessionStart
		$academic_sessions->sessionStart->CellCssStyle = ""; $academic_sessions->sessionStart->CellCssClass = "";
		$academic_sessions->sessionStart->CellAttrs = array(); $academic_sessions->sessionStart->ViewAttrs = array(); $academic_sessions->sessionStart->EditAttrs = array();

		// sessionEnd
		$academic_sessions->sessionEnd->CellCssStyle = ""; $academic_sessions->sessionEnd->CellCssClass = "";
		$academic_sessions->sessionEnd->CellAttrs = array(); $academic_sessions->sessionEnd->ViewAttrs = array(); $academic_sessions->sessionEnd->EditAttrs = array();

		// currentSession
		$academic_sessions->currentSession->CellCssStyle = ""; $academic_sessions->currentSession->CellCssClass = "";
		$academic_sessions->currentSession->CellAttrs = array(); $academic_sessions->currentSession->ViewAttrs = array(); $academic_sessions->currentSession->EditAttrs = array();

		// status
		$academic_sessions->status->CellCssStyle = ""; $academic_sessions->status->CellCssClass = "";
		$academic_sessions->status->CellAttrs = array(); $academic_sessions->status->ViewAttrs = array(); $academic_sessions->status->EditAttrs = array();
		if ($academic_sessions->RowType == EW_ROWTYPE_VIEW) { // View row

			// sessionID
			$academic_sessions->sessionID->ViewValue = $academic_sessions->sessionID->CurrentValue;
			$academic_sessions->sessionID->CssStyle = "";
			$academic_sessions->sessionID->CssClass = "";
			$academic_sessions->sessionID->ViewCustomAttributes = "";

			// sessionName
			$academic_sessions->sessionName->ViewValue = $academic_sessions->sessionName->CurrentValue;
			$academic_sessions->sessionName->CssStyle = "";
			$academic_sessions->sessionName->CssClass = "";
			$academic_sessions->sessionName->ViewCustomAttributes = "";

			// sessionStart
			$academic_sessions->sessionStart->ViewValue = $academic_sessions->sessionStart->CurrentValue;
			$academic_sessions->sessionStart->ViewValue = ew_FormatDateTime($academic_sessions->sessionStart->ViewValue, 5);
			$academic_sessions->sessionStart->CssStyle = "";
			$academic_sessions->sessionStart->CssClass = "";
			$academic_sessions->sessionStart->ViewCustomAttributes = "";

			// sessionEnd
			$academic_sessions->sessionEnd->ViewValue = $academic_sessions->sessionEnd->CurrentValue;
			$academic_sessions->sessionEnd->ViewValue = ew_FormatDateTime($academic_sessions->sessionEnd->ViewValue, 5);
			$academic_sessions->sessionEnd->CssStyle = "";
			$academic_sessions->sessionEnd->CssClass = "";
			$academic_sessions->sessionEnd->ViewCustomAttributes = "";

			// currentSession
			if (strval($academic_sessions->currentSession->CurrentValue) <> "") {
				switch ($academic_sessions->currentSession->CurrentValue) {
					case "Current Session":
						$academic_sessions->currentSession->ViewValue = "1";
						break;
					case "Not Current Session":
						$academic_sessions->currentSession->ViewValue = "0";
						break;
					default:
						$academic_sessions->currentSession->ViewValue = $academic_sessions->currentSession->CurrentValue;
				}
			} else {
				$academic_sessions->currentSession->ViewValue = NULL;
			}
			$academic_sessions->currentSession->CssStyle = "";
			$academic_sessions->currentSession->CssClass = "";
			$academic_sessions->currentSession->ViewCustomAttributes = "";

			// status
			if (strval($academic_sessions->status->CurrentValue) <> "") {
				switch ($academic_sessions->status->CurrentValue) {
					case "1":
						$academic_sessions->status->ViewValue = "Enabled";
						break;
					case "0":
						$academic_sessions->status->ViewValue = "Disabled";
						break;
					default:
						$academic_sessions->status->ViewValue = $academic_sessions->status->CurrentValue;
				}
			} else {
				$academic_sessions->status->ViewValue = NULL;
			}
			$academic_sessions->status->CssStyle = "";
			$academic_sessions->status->CssClass = "";
			$academic_sessions->status->ViewCustomAttributes = "";

			// sessionName
			$academic_sessions->sessionName->HrefValue = "";
			$academic_sessions->sessionName->TooltipValue = "";

			// sessionStart
			$academic_sessions->sessionStart->HrefValue = "";
			$academic_sessions->sessionStart->TooltipValue = "";

			// sessionEnd
			$academic_sessions->sessionEnd->HrefValue = "";
			$academic_sessions->sessionEnd->TooltipValue = "";

			// currentSession
			$academic_sessions->currentSession->HrefValue = "";
			$academic_sessions->currentSession->TooltipValue = "";

			// status
			$academic_sessions->status->HrefValue = "";
			$academic_sessions->status->TooltipValue = "";
		} elseif ($academic_sessions->RowType == EW_ROWTYPE_ADD) { // Add row

			// sessionName
			$academic_sessions->sessionName->EditCustomAttributes = "";
			$academic_sessions->sessionName->EditValue = ew_HtmlEncode($academic_sessions->sessionName->CurrentValue);

			// sessionStart
			$academic_sessions->sessionStart->EditCustomAttributes = "";
			$academic_sessions->sessionStart->EditValue = ew_HtmlEncode(ew_FormatDateTime($academic_sessions->sessionStart->CurrentValue, 5));

			// sessionEnd
			$academic_sessions->sessionEnd->EditCustomAttributes = "";
			$academic_sessions->sessionEnd->EditValue = ew_HtmlEncode(ew_FormatDateTime($academic_sessions->sessionEnd->CurrentValue, 5));

			// currentSession
			$academic_sessions->currentSession->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Current Session", "1");
			$arwrk[] = array("Not Current Session", "0");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$academic_sessions->currentSession->EditValue = $arwrk;

			// status
			$academic_sessions->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$academic_sessions->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($academic_sessions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_sessions->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $academic_sessions;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($academic_sessions->sessionStart->FormValue) && $academic_sessions->sessionStart->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $academic_sessions->sessionStart->FldCaption();
		}
		if (!ew_CheckDate($academic_sessions->sessionStart->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $academic_sessions->sessionStart->FldErrMsg();
		}
		if (!is_null($academic_sessions->sessionEnd->FormValue) && $academic_sessions->sessionEnd->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $academic_sessions->sessionEnd->FldCaption();
		}
		if (!ew_CheckDate($academic_sessions->sessionEnd->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $academic_sessions->sessionEnd->FldErrMsg();
		}
		if (!is_null($academic_sessions->currentSession->FormValue) && $academic_sessions->currentSession->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $academic_sessions->currentSession->FldCaption();
		}
		if ($academic_sessions->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $academic_sessions->status->FldCaption();
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $academic_sessions;
		$rsnew = array();

		// sessionName
		$academic_sessions->sessionName->SetDbValueDef($rsnew, $academic_sessions->sessionName->CurrentValue, NULL, FALSE);

		// sessionStart
		$academic_sessions->sessionStart->SetDbValueDef($rsnew, ew_UnFormatDateTime($academic_sessions->sessionStart->CurrentValue, 5, FALSE), NULL);

		// sessionEnd
		$academic_sessions->sessionEnd->SetDbValueDef($rsnew, ew_UnFormatDateTime($academic_sessions->sessionEnd->CurrentValue, 5, FALSE), NULL);

		// currentSession
		$academic_sessions->currentSession->SetDbValueDef($rsnew, $academic_sessions->currentSession->CurrentValue, NULL, FALSE);

		// status
		$academic_sessions->status->SetDbValueDef($rsnew, $academic_sessions->status->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $academic_sessions->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($academic_sessions->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($academic_sessions->CancelMessage <> "") {
				$this->setMessage($academic_sessions->CancelMessage);
				$academic_sessions->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$academic_sessions->sessionID->setDbValue($conn->Insert_ID());
			$rsnew['sessionID'] = $academic_sessions->sessionID->DbValue;

			// Call Row Inserted event
			$academic_sessions->Row_Inserted($rsnew);
		}
		return $AddRow;
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
