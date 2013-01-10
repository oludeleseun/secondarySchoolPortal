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
$teachers_add = new cteachers_add();
$Page =& $teachers_add;

// Page init
$teachers_add->Page_Init();

// Page main
$teachers_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var teachers_add = new ew_Page("teachers_add");

// page properties
teachers_add.PageID = "add"; // page ID
teachers_add.FormID = "fteachersadd"; // form ID
var EW_PAGE_ID = teachers_add.PageID; // for backward compatibility

// extend page with ValidateForm function
teachers_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($teachers->firstname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_middlename"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($teachers->middlename->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lastname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($teachers->lastname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_qualification"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($teachers->qualification->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stateOfOrigin"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($teachers->stateOfOrigin->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_residentialAddress"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($teachers->residentialAddress->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($teachers->zemail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_CheckEmail(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($teachers->zemail->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($teachers->username->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_teacherImage"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
teachers_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
teachers_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
teachers_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
teachers_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $teachers->TableCaption() ?><br><br>
<a href="<?php echo $teachers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$teachers_add->ShowMessage();
?>
<form name="fteachersadd" id="fteachersadd" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return teachers_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="teachers">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($teachers->firstname->Visible) { // firstname ?>
	<tr<?php echo $teachers->firstname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->firstname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $teachers->firstname->CellAttributes() ?>><span id="el_firstname">
<input type="text" name="x_firstname" id="x_firstname" title="<?php echo $teachers->firstname->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $teachers->firstname->EditValue ?>"<?php echo $teachers->firstname->EditAttributes() ?>>
</span><?php echo $teachers->firstname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->middlename->Visible) { // middlename ?>
	<tr<?php echo $teachers->middlename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->middlename->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $teachers->middlename->CellAttributes() ?>><span id="el_middlename">
<input type="text" name="x_middlename" id="x_middlename" title="<?php echo $teachers->middlename->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $teachers->middlename->EditValue ?>"<?php echo $teachers->middlename->EditAttributes() ?>>
</span><?php echo $teachers->middlename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->lastname->Visible) { // lastname ?>
	<tr<?php echo $teachers->lastname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $teachers->lastname->CellAttributes() ?>><span id="el_lastname">
<input type="text" name="x_lastname" id="x_lastname" title="<?php echo $teachers->lastname->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $teachers->lastname->EditValue ?>"<?php echo $teachers->lastname->EditAttributes() ?>>
</span><?php echo $teachers->lastname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->qualification->Visible) { // qualification ?>
	<tr<?php echo $teachers->qualification->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->qualification->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $teachers->qualification->CellAttributes() ?>><span id="el_qualification">
<input type="text" name="x_qualification" id="x_qualification" title="<?php echo $teachers->qualification->FldTitle() ?>" size="30" maxlength="100" value="<?php echo $teachers->qualification->EditValue ?>"<?php echo $teachers->qualification->EditAttributes() ?>>
</span><?php echo $teachers->qualification->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->stateOfOrigin->Visible) { // stateOfOrigin ?>
	<tr<?php echo $teachers->stateOfOrigin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->stateOfOrigin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $teachers->stateOfOrigin->CellAttributes() ?>><span id="el_stateOfOrigin">
<input type="text" name="x_stateOfOrigin" id="x_stateOfOrigin" title="<?php echo $teachers->stateOfOrigin->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $teachers->stateOfOrigin->EditValue ?>"<?php echo $teachers->stateOfOrigin->EditAttributes() ?>>
</span><?php echo $teachers->stateOfOrigin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->aboutTeacher->Visible) { // aboutTeacher ?>
	<tr<?php echo $teachers->aboutTeacher->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->aboutTeacher->FldCaption() ?></td>
		<td<?php echo $teachers->aboutTeacher->CellAttributes() ?>><span id="el_aboutTeacher">
<textarea name="x_aboutTeacher" id="x_aboutTeacher" title="<?php echo $teachers->aboutTeacher->FldTitle() ?>" cols="35" rows="4"<?php echo $teachers->aboutTeacher->EditAttributes() ?>><?php echo $teachers->aboutTeacher->EditValue ?></textarea>
</span><?php echo $teachers->aboutTeacher->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->residentialAddress->Visible) { // residentialAddress ?>
	<tr<?php echo $teachers->residentialAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->residentialAddress->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $teachers->residentialAddress->CellAttributes() ?>><span id="el_residentialAddress">
<textarea name="x_residentialAddress" id="x_residentialAddress" title="<?php echo $teachers->residentialAddress->FldTitle() ?>" cols="35" rows="4"<?php echo $teachers->residentialAddress->EditAttributes() ?>><?php echo $teachers->residentialAddress->EditValue ?></textarea>
</span><?php echo $teachers->residentialAddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->zemail->Visible) { // email ?>
	<tr<?php echo $teachers->zemail->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->zemail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $teachers->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" title="<?php echo $teachers->zemail->FldTitle() ?>" size="30" maxlength="70" value="<?php echo $teachers->zemail->EditValue ?>"<?php echo $teachers->zemail->EditAttributes() ?>>
</span><?php echo $teachers->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->username->Visible) { // username ?>
	<tr<?php echo $teachers->username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $teachers->username->CellAttributes() ?>><span id="el_username">
<input type="text" name="x_username" id="x_username" title="<?php echo $teachers->username->FldTitle() ?>" size="20" maxlength="20" value="<?php echo $teachers->username->EditValue ?>"<?php echo $teachers->username->EditAttributes() ?>>
</span><?php echo $teachers->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->portalPassword->Visible) { // portalPassword ?>
	<tr<?php echo $teachers->portalPassword->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->portalPassword->FldCaption() ?></td>
		<td<?php echo $teachers->portalPassword->CellAttributes() ?>><span id="el_portalPassword">
<input type="password" name="x_portalPassword" id="x_portalPassword" title="<?php echo $teachers->portalPassword->FldTitle() ?>" size="20" maxlength="20"<?php echo $teachers->portalPassword->EditAttributes() ?>>
</span><?php echo $teachers->portalPassword->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->status->Visible) { // status ?>
	<tr<?php echo $teachers->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->status->FldCaption() ?></td>
		<td<?php echo $teachers->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $teachers->status->FldTitle() ?>" value="{value}"<?php echo $teachers->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $teachers->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($teachers->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $teachers->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $teachers->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $teachers->status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($teachers->teacherImage->Visible) { // teacherImage ?>
	<tr<?php echo $teachers->teacherImage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $teachers->teacherImage->FldCaption() ?></td>
		<td<?php echo $teachers->teacherImage->CellAttributes() ?>><span id="el_teacherImage">
<input type="file" name="x_teacherImage" id="x_teacherImage" title="<?php echo $teachers->teacherImage->FldTitle() ?>"<?php echo $teachers->teacherImage->EditAttributes() ?>>
</div>
</span><?php echo $teachers->teacherImage->CustomMsg ?></td>
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
$teachers_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cteachers_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'teachers';

	// Page object name
	var $PageObjName = 'teachers_add';

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
	function cteachers_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (teachers)
		$GLOBALS["teachers"] = new cteachers();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		global $objForm, $Language, $gsFormError, $teachers;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["teacherID"] != "") {
		  $teachers->teacherID->setQueryStringValue($_GET["teacherID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $teachers->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->GetUploadFiles(); // Get upload files
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$teachers->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $teachers->CurrentAction = "C"; // Copy record
		  } else {
		    $teachers->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($teachers->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("teacherslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$teachers->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $teachers->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$teachers->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $teachers;

		// Get upload data
			if ($teachers->teacherImage->Upload->UploadFile()) {

				// No action required
			} else {
				echo $teachers->teacherImage->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load default values
	function LoadDefaultValues() {
		global $teachers;
		$teachers->teacherImage->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $teachers;
		$teachers->firstname->setFormValue($objForm->GetValue("x_firstname"));
		$teachers->middlename->setFormValue($objForm->GetValue("x_middlename"));
		$teachers->lastname->setFormValue($objForm->GetValue("x_lastname"));
		$teachers->qualification->setFormValue($objForm->GetValue("x_qualification"));
		$teachers->stateOfOrigin->setFormValue($objForm->GetValue("x_stateOfOrigin"));
		$teachers->aboutTeacher->setFormValue($objForm->GetValue("x_aboutTeacher"));
		$teachers->residentialAddress->setFormValue($objForm->GetValue("x_residentialAddress"));
		$teachers->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$teachers->username->setFormValue($objForm->GetValue("x_username"));
		$teachers->portalPassword->setFormValue($objForm->GetValue("x_portalPassword"));
		$teachers->status->setFormValue($objForm->GetValue("x_status"));
		$teachers->teacherID->setFormValue($objForm->GetValue("x_teacherID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $teachers;
		$teachers->teacherID->CurrentValue = $teachers->teacherID->FormValue;
		$teachers->firstname->CurrentValue = $teachers->firstname->FormValue;
		$teachers->middlename->CurrentValue = $teachers->middlename->FormValue;
		$teachers->lastname->CurrentValue = $teachers->lastname->FormValue;
		$teachers->qualification->CurrentValue = $teachers->qualification->FormValue;
		$teachers->stateOfOrigin->CurrentValue = $teachers->stateOfOrigin->FormValue;
		$teachers->aboutTeacher->CurrentValue = $teachers->aboutTeacher->FormValue;
		$teachers->residentialAddress->CurrentValue = $teachers->residentialAddress->FormValue;
		$teachers->zemail->CurrentValue = $teachers->zemail->FormValue;
		$teachers->username->CurrentValue = $teachers->username->FormValue;
		$teachers->portalPassword->CurrentValue = $teachers->portalPassword->FormValue;
		$teachers->status->CurrentValue = $teachers->status->FormValue;
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
		// Call Row_Rendering event

		$teachers->Row_Rendering();

		// Common render codes for all row types
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
		} elseif ($teachers->RowType == EW_ROWTYPE_ADD) { // Add row

			// firstname
			$teachers->firstname->EditCustomAttributes = "";
			$teachers->firstname->EditValue = ew_HtmlEncode($teachers->firstname->CurrentValue);

			// middlename
			$teachers->middlename->EditCustomAttributes = "";
			$teachers->middlename->EditValue = ew_HtmlEncode($teachers->middlename->CurrentValue);

			// lastname
			$teachers->lastname->EditCustomAttributes = "";
			$teachers->lastname->EditValue = ew_HtmlEncode($teachers->lastname->CurrentValue);

			// qualification
			$teachers->qualification->EditCustomAttributes = "";
			$teachers->qualification->EditValue = ew_HtmlEncode($teachers->qualification->CurrentValue);

			// stateOfOrigin
			$teachers->stateOfOrigin->EditCustomAttributes = "";
			$teachers->stateOfOrigin->EditValue = ew_HtmlEncode($teachers->stateOfOrigin->CurrentValue);

			// aboutTeacher
			$teachers->aboutTeacher->EditCustomAttributes = "";
			$teachers->aboutTeacher->EditValue = ew_HtmlEncode($teachers->aboutTeacher->CurrentValue);

			// residentialAddress
			$teachers->residentialAddress->EditCustomAttributes = "";
			$teachers->residentialAddress->EditValue = ew_HtmlEncode($teachers->residentialAddress->CurrentValue);

			// email
			$teachers->zemail->EditCustomAttributes = "";
			$teachers->zemail->EditValue = ew_HtmlEncode($teachers->zemail->CurrentValue);

			// username
			$teachers->username->EditCustomAttributes = "";
			$teachers->username->EditValue = ew_HtmlEncode($teachers->username->CurrentValue);

			// portalPassword
			$teachers->portalPassword->EditCustomAttributes = "";
			$teachers->portalPassword->EditValue = ew_HtmlEncode($teachers->portalPassword->CurrentValue);

			// status
			$teachers->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$teachers->status->EditValue = $arwrk;

			// teacherImage
			$teachers->teacherImage->EditCustomAttributes = "";
			if (!ew_Empty($teachers->teacherImage->Upload->DbValue)) {
				$teachers->teacherImage->EditValue = $teachers->teacherImage->Upload->DbValue;
				$teachers->teacherImage->ImageAlt = $teachers->teacherImage->FldAlt();
			} else {
				$teachers->teacherImage->EditValue = "";
			}
		}

		// Call Row Rendered event
		if ($teachers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$teachers->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $teachers;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($teachers->teacherImage->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($teachers->teacherImage->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $teachers->teacherImage->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($teachers->teacherImage->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $teachers->teacherImage->Upload->Error);
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($teachers->firstname->FormValue) && $teachers->firstname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $teachers->firstname->FldCaption();
		}
		if (!is_null($teachers->middlename->FormValue) && $teachers->middlename->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $teachers->middlename->FldCaption();
		}
		if (!is_null($teachers->lastname->FormValue) && $teachers->lastname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $teachers->lastname->FldCaption();
		}
		if (!is_null($teachers->qualification->FormValue) && $teachers->qualification->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $teachers->qualification->FldCaption();
		}
		if (!is_null($teachers->stateOfOrigin->FormValue) && $teachers->stateOfOrigin->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $teachers->stateOfOrigin->FldCaption();
		}
		if (!is_null($teachers->residentialAddress->FormValue) && $teachers->residentialAddress->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $teachers->residentialAddress->FldCaption();
		}
		if (!is_null($teachers->zemail->FormValue) && $teachers->zemail->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $teachers->zemail->FldCaption();
		}
		if (!ew_CheckEmail($teachers->zemail->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $teachers->zemail->FldErrMsg();
		}
		if (!is_null($teachers->username->FormValue) && $teachers->username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $teachers->username->FldCaption();
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
		global $conn, $Language, $Security, $teachers;
		if ($teachers->username->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(username = '" . ew_AdjustSql($teachers->username->CurrentValue) . "')";
			$rsChk = $teachers->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'username', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $teachers->username->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// firstname
		$teachers->firstname->SetDbValueDef($rsnew, $teachers->firstname->CurrentValue, NULL, FALSE);

		// middlename
		$teachers->middlename->SetDbValueDef($rsnew, $teachers->middlename->CurrentValue, NULL, FALSE);

		// lastname
		$teachers->lastname->SetDbValueDef($rsnew, $teachers->lastname->CurrentValue, NULL, FALSE);

		// qualification
		$teachers->qualification->SetDbValueDef($rsnew, $teachers->qualification->CurrentValue, NULL, FALSE);

		// stateOfOrigin
		$teachers->stateOfOrigin->SetDbValueDef($rsnew, $teachers->stateOfOrigin->CurrentValue, NULL, FALSE);

		// aboutTeacher
		$teachers->aboutTeacher->SetDbValueDef($rsnew, $teachers->aboutTeacher->CurrentValue, NULL, FALSE);

		// residentialAddress
		$teachers->residentialAddress->SetDbValueDef($rsnew, $teachers->residentialAddress->CurrentValue, NULL, FALSE);

		// email
		$teachers->zemail->SetDbValueDef($rsnew, $teachers->zemail->CurrentValue, NULL, FALSE);

		// username
		$teachers->username->SetDbValueDef($rsnew, $teachers->username->CurrentValue, NULL, FALSE);

		// portalPassword
		$teachers->portalPassword->SetDbValueDef($rsnew, $teachers->portalPassword->CurrentValue, NULL, FALSE);

		// status
		$teachers->status->SetDbValueDef($rsnew, $teachers->status->CurrentValue, NULL, FALSE);

		// teacherImage
		$teachers->teacherImage->Upload->SaveToSession(); // Save file value to Session
		if (is_null($teachers->teacherImage->Upload->Value)) {
			$rsnew['teacherImage'] = NULL;
		} else {
			$rsnew['teacherImage'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $teachers->teacherImage->UploadPath), $teachers->teacherImage->Upload->FileName);
		}

		// Call Row Inserting event
		$bInsertRow = $teachers->Row_Inserting($rsnew);
		if ($bInsertRow) {
			if (!ew_Empty($teachers->teacherImage->Upload->Value)) {
				$teachers->teacherImage->Upload->SaveToFile($teachers->teacherImage->UploadPath, $rsnew['teacherImage'], FALSE);
			}
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($teachers->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($teachers->CancelMessage <> "") {
				$this->setMessage($teachers->CancelMessage);
				$teachers->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$teachers->teacherID->setDbValue($conn->Insert_ID());
			$rsnew['teacherID'] = $teachers->teacherID->DbValue;

			// Call Row Inserted event
			$teachers->Row_Inserted($rsnew);
		}

		// teacherImage
		$teachers->teacherImage->Upload->RemoveFromSession(); // Remove file value from Session
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
