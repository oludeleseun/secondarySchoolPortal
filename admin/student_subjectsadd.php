<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "student_subjectsinfo.php" ?>
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
$student_subjects_add = new cstudent_subjects_add();
$Page =& $student_subjects_add;

// Page init
$student_subjects_add->Page_Init();

// Page main
$student_subjects_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var student_subjects_add = new ew_Page("student_subjects_add");

// page properties
student_subjects_add.PageID = "add"; // page ID
student_subjects_add.FormID = "fstudent_subjectsadd"; // form ID
var EW_PAGE_ID = student_subjects_add.PageID; // for backward compatibility

// extend page with ValidateForm function
student_subjects_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_studentID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($student_subjects->studentID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_termID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_subjects->termID->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_vClassID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_subjects->vClassID->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_caScore"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_subjects->caScore->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_examScore"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($student_subjects->examScore->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($student_subjects->status->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
student_subjects_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
student_subjects_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
student_subjects_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
student_subjects_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $student_subjects->TableCaption() ?><br><br>
<a href="<?php echo $student_subjects->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$student_subjects_add->ShowMessage();
?>
<form name="fstudent_subjectsadd" id="fstudent_subjectsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return student_subjects_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="student_subjects">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($student_subjects->studentID->Visible) { // studentID ?>
	<tr<?php echo $student_subjects->studentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->studentID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_subjects->studentID->CellAttributes() ?>><span id="el_studentID">
<select id="x_studentID" name="x_studentID" title="<?php echo $student_subjects->studentID->FldTitle() ?>"<?php echo $student_subjects->studentID->EditAttributes() ?>>
<?php
if (is_array($student_subjects->studentID->EditValue)) {
	$arwrk = $student_subjects->studentID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_subjects->studentID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $student_subjects->studentID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->termID->Visible) { // termID ?>
	<tr<?php echo $student_subjects->termID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->termID->FldCaption() ?></td>
		<td<?php echo $student_subjects->termID->CellAttributes() ?>><span id="el_termID">
<input type="text" name="x_termID" id="x_termID" title="<?php echo $student_subjects->termID->FldTitle() ?>" size="30" value="<?php echo $student_subjects->termID->EditValue ?>"<?php echo $student_subjects->termID->EditAttributes() ?>>
</span><?php echo $student_subjects->termID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->vClassID->Visible) { // vClassID ?>
	<tr<?php echo $student_subjects->vClassID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->vClassID->FldCaption() ?></td>
		<td<?php echo $student_subjects->vClassID->CellAttributes() ?>><span id="el_vClassID">
<input type="text" name="x_vClassID" id="x_vClassID" title="<?php echo $student_subjects->vClassID->FldTitle() ?>" size="30" value="<?php echo $student_subjects->vClassID->EditValue ?>"<?php echo $student_subjects->vClassID->EditAttributes() ?>>
</span><?php echo $student_subjects->vClassID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->caScore->Visible) { // caScore ?>
	<tr<?php echo $student_subjects->caScore->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->caScore->FldCaption() ?></td>
		<td<?php echo $student_subjects->caScore->CellAttributes() ?>><span id="el_caScore">
<input type="text" name="x_caScore" id="x_caScore" title="<?php echo $student_subjects->caScore->FldTitle() ?>" size="30" value="<?php echo $student_subjects->caScore->EditValue ?>"<?php echo $student_subjects->caScore->EditAttributes() ?>>
</span><?php echo $student_subjects->caScore->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->examScore->Visible) { // examScore ?>
	<tr<?php echo $student_subjects->examScore->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->examScore->FldCaption() ?></td>
		<td<?php echo $student_subjects->examScore->CellAttributes() ?>><span id="el_examScore">
<input type="text" name="x_examScore" id="x_examScore" title="<?php echo $student_subjects->examScore->FldTitle() ?>" size="30" value="<?php echo $student_subjects->examScore->EditValue ?>"<?php echo $student_subjects->examScore->EditAttributes() ?>>
</span><?php echo $student_subjects->examScore->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->grade->Visible) { // grade ?>
	<tr<?php echo $student_subjects->grade->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->grade->FldCaption() ?></td>
		<td<?php echo $student_subjects->grade->CellAttributes() ?>><span id="el_grade">
<input type="text" name="x_grade" id="x_grade" title="<?php echo $student_subjects->grade->FldTitle() ?>" size="30" maxlength="1" value="<?php echo $student_subjects->grade->EditValue ?>"<?php echo $student_subjects->grade->EditAttributes() ?>>
</span><?php echo $student_subjects->grade->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->comments->Visible) { // comments ?>
	<tr<?php echo $student_subjects->comments->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->comments->FldCaption() ?></td>
		<td<?php echo $student_subjects->comments->CellAttributes() ?>><span id="el_comments">
<input type="text" name="x_comments" id="x_comments" title="<?php echo $student_subjects->comments->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $student_subjects->comments->EditValue ?>"<?php echo $student_subjects->comments->EditAttributes() ?>>
</span><?php echo $student_subjects->comments->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($student_subjects->status->Visible) { // status ?>
	<tr<?php echo $student_subjects->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $student_subjects->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $student_subjects->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $student_subjects->status->FldTitle() ?>" value="{value}"<?php echo $student_subjects->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $student_subjects->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($student_subjects->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $student_subjects->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $student_subjects->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $student_subjects->status->CustomMsg ?></td>
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
$student_subjects_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudent_subjects_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'student_subjects';

	// Page object name
	var $PageObjName = 'student_subjects_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $student_subjects;
		if ($student_subjects->UseTokenInUrl) $PageUrl .= "t=" . $student_subjects->TableVar . "&"; // Add page token
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
		global $objForm, $student_subjects;
		if ($student_subjects->UseTokenInUrl) {
			if ($objForm)
				return ($student_subjects->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($student_subjects->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudent_subjects_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (student_subjects)
		$GLOBALS["student_subjects"] = new cstudent_subjects();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'student_subjects', TRUE);

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
		global $student_subjects;

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
		global $objForm, $Language, $gsFormError, $student_subjects;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["studentSubjectID"] != "") {
		  $student_subjects->studentSubjectID->setQueryStringValue($_GET["studentSubjectID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $student_subjects->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$student_subjects->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $student_subjects->CurrentAction = "C"; // Copy record
		  } else {
		    $student_subjects->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($student_subjects->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("student_subjectslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$student_subjects->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $student_subjects->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$student_subjects->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $student_subjects;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $student_subjects;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $student_subjects;
		$student_subjects->studentID->setFormValue($objForm->GetValue("x_studentID"));
		$student_subjects->termID->setFormValue($objForm->GetValue("x_termID"));
		$student_subjects->vClassID->setFormValue($objForm->GetValue("x_vClassID"));
		$student_subjects->caScore->setFormValue($objForm->GetValue("x_caScore"));
		$student_subjects->examScore->setFormValue($objForm->GetValue("x_examScore"));
		$student_subjects->grade->setFormValue($objForm->GetValue("x_grade"));
		$student_subjects->comments->setFormValue($objForm->GetValue("x_comments"));
		$student_subjects->status->setFormValue($objForm->GetValue("x_status"));
		$student_subjects->studentSubjectID->setFormValue($objForm->GetValue("x_studentSubjectID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $student_subjects;
		$student_subjects->studentSubjectID->CurrentValue = $student_subjects->studentSubjectID->FormValue;
		$student_subjects->studentID->CurrentValue = $student_subjects->studentID->FormValue;
		$student_subjects->termID->CurrentValue = $student_subjects->termID->FormValue;
		$student_subjects->vClassID->CurrentValue = $student_subjects->vClassID->FormValue;
		$student_subjects->caScore->CurrentValue = $student_subjects->caScore->FormValue;
		$student_subjects->examScore->CurrentValue = $student_subjects->examScore->FormValue;
		$student_subjects->grade->CurrentValue = $student_subjects->grade->FormValue;
		$student_subjects->comments->CurrentValue = $student_subjects->comments->FormValue;
		$student_subjects->status->CurrentValue = $student_subjects->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $student_subjects;
		$sFilter = $student_subjects->KeyFilter();

		// Call Row Selecting event
		$student_subjects->Row_Selecting($sFilter);

		// Load SQL based on filter
		$student_subjects->CurrentFilter = $sFilter;
		$sSql = $student_subjects->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$student_subjects->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $student_subjects;
		$student_subjects->studentSubjectID->setDbValue($rs->fields('studentSubjectID'));
		$student_subjects->studentID->setDbValue($rs->fields('studentID'));
		$student_subjects->subjectTeacherID->setDbValue($rs->fields('subjectTeacherID'));
		$student_subjects->termID->setDbValue($rs->fields('termID'));
		$student_subjects->vClassID->setDbValue($rs->fields('vClassID'));
		$student_subjects->caScore->setDbValue($rs->fields('caScore'));
		$student_subjects->examScore->setDbValue($rs->fields('examScore'));
		$student_subjects->grade->setDbValue($rs->fields('grade'));
		$student_subjects->comments->setDbValue($rs->fields('comments'));
		$student_subjects->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $student_subjects;

		// Initialize URLs
		// Call Row_Rendering event

		$student_subjects->Row_Rendering();

		// Common render codes for all row types
		// studentID

		$student_subjects->studentID->CellCssStyle = ""; $student_subjects->studentID->CellCssClass = "";
		$student_subjects->studentID->CellAttrs = array(); $student_subjects->studentID->ViewAttrs = array(); $student_subjects->studentID->EditAttrs = array();

		// termID
		$student_subjects->termID->CellCssStyle = ""; $student_subjects->termID->CellCssClass = "";
		$student_subjects->termID->CellAttrs = array(); $student_subjects->termID->ViewAttrs = array(); $student_subjects->termID->EditAttrs = array();

		// vClassID
		$student_subjects->vClassID->CellCssStyle = ""; $student_subjects->vClassID->CellCssClass = "";
		$student_subjects->vClassID->CellAttrs = array(); $student_subjects->vClassID->ViewAttrs = array(); $student_subjects->vClassID->EditAttrs = array();

		// caScore
		$student_subjects->caScore->CellCssStyle = ""; $student_subjects->caScore->CellCssClass = "";
		$student_subjects->caScore->CellAttrs = array(); $student_subjects->caScore->ViewAttrs = array(); $student_subjects->caScore->EditAttrs = array();

		// examScore
		$student_subjects->examScore->CellCssStyle = ""; $student_subjects->examScore->CellCssClass = "";
		$student_subjects->examScore->CellAttrs = array(); $student_subjects->examScore->ViewAttrs = array(); $student_subjects->examScore->EditAttrs = array();

		// grade
		$student_subjects->grade->CellCssStyle = ""; $student_subjects->grade->CellCssClass = "";
		$student_subjects->grade->CellAttrs = array(); $student_subjects->grade->ViewAttrs = array(); $student_subjects->grade->EditAttrs = array();

		// comments
		$student_subjects->comments->CellCssStyle = ""; $student_subjects->comments->CellCssClass = "";
		$student_subjects->comments->CellAttrs = array(); $student_subjects->comments->ViewAttrs = array(); $student_subjects->comments->EditAttrs = array();

		// status
		$student_subjects->status->CellCssStyle = ""; $student_subjects->status->CellCssClass = "";
		$student_subjects->status->CellAttrs = array(); $student_subjects->status->ViewAttrs = array(); $student_subjects->status->EditAttrs = array();
		if ($student_subjects->RowType == EW_ROWTYPE_VIEW) { // View row

			// studentSubjectID
			$student_subjects->studentSubjectID->ViewValue = $student_subjects->studentSubjectID->CurrentValue;
			$student_subjects->studentSubjectID->CssStyle = "";
			$student_subjects->studentSubjectID->CssClass = "";
			$student_subjects->studentSubjectID->ViewCustomAttributes = "";

			// studentID
			if (strval($student_subjects->studentID->CurrentValue) <> "") {
				$sFilterWrk = "`studentID` = " . ew_AdjustSql($student_subjects->studentID->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `students`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `firstname` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$student_subjects->studentID->ViewValue = $rswrk->fields('firstname');
					$student_subjects->studentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$student_subjects->studentID->ViewValue = $student_subjects->studentID->CurrentValue;
				}
			} else {
				$student_subjects->studentID->ViewValue = NULL;
			}
			$student_subjects->studentID->CssStyle = "";
			$student_subjects->studentID->CssClass = "";
			$student_subjects->studentID->ViewCustomAttributes = "";

			// subjectTeacherID
			$student_subjects->subjectTeacherID->CssStyle = "";
			$student_subjects->subjectTeacherID->CssClass = "";
			$student_subjects->subjectTeacherID->ViewCustomAttributes = "";

			// termID
			$student_subjects->termID->ViewValue = $student_subjects->termID->CurrentValue;
			$student_subjects->termID->CssStyle = "";
			$student_subjects->termID->CssClass = "";
			$student_subjects->termID->ViewCustomAttributes = "";

			// vClassID
			$student_subjects->vClassID->ViewValue = $student_subjects->vClassID->CurrentValue;
			$student_subjects->vClassID->CssStyle = "";
			$student_subjects->vClassID->CssClass = "";
			$student_subjects->vClassID->ViewCustomAttributes = "";

			// caScore
			$student_subjects->caScore->ViewValue = $student_subjects->caScore->CurrentValue;
			$student_subjects->caScore->CssStyle = "";
			$student_subjects->caScore->CssClass = "";
			$student_subjects->caScore->ViewCustomAttributes = "";

			// examScore
			$student_subjects->examScore->ViewValue = $student_subjects->examScore->CurrentValue;
			$student_subjects->examScore->CssStyle = "";
			$student_subjects->examScore->CssClass = "";
			$student_subjects->examScore->ViewCustomAttributes = "";

			// grade
			$student_subjects->grade->ViewValue = $student_subjects->grade->CurrentValue;
			$student_subjects->grade->CssStyle = "";
			$student_subjects->grade->CssClass = "";
			$student_subjects->grade->ViewCustomAttributes = "";

			// comments
			$student_subjects->comments->ViewValue = $student_subjects->comments->CurrentValue;
			$student_subjects->comments->CssStyle = "";
			$student_subjects->comments->CssClass = "";
			$student_subjects->comments->ViewCustomAttributes = "";

			// status
			if (strval($student_subjects->status->CurrentValue) <> "") {
				switch ($student_subjects->status->CurrentValue) {
					case "1":
						$student_subjects->status->ViewValue = "Enabled";
						break;
					case "0":
						$student_subjects->status->ViewValue = "Disabled";
						break;
					default:
						$student_subjects->status->ViewValue = $student_subjects->status->CurrentValue;
				}
			} else {
				$student_subjects->status->ViewValue = NULL;
			}
			$student_subjects->status->CssStyle = "";
			$student_subjects->status->CssClass = "";
			$student_subjects->status->ViewCustomAttributes = "";

			// studentID
			$student_subjects->studentID->HrefValue = "";
			$student_subjects->studentID->TooltipValue = "";

			// termID
			$student_subjects->termID->HrefValue = "";
			$student_subjects->termID->TooltipValue = "";

			// vClassID
			$student_subjects->vClassID->HrefValue = "";
			$student_subjects->vClassID->TooltipValue = "";

			// caScore
			$student_subjects->caScore->HrefValue = "";
			$student_subjects->caScore->TooltipValue = "";

			// examScore
			$student_subjects->examScore->HrefValue = "";
			$student_subjects->examScore->TooltipValue = "";

			// grade
			$student_subjects->grade->HrefValue = "";
			$student_subjects->grade->TooltipValue = "";

			// comments
			$student_subjects->comments->HrefValue = "";
			$student_subjects->comments->TooltipValue = "";

			// status
			$student_subjects->status->HrefValue = "";
			$student_subjects->status->TooltipValue = "";
		} elseif ($student_subjects->RowType == EW_ROWTYPE_ADD) { // Add row

			// studentID
			$student_subjects->studentID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `studentID`, `firstname`, `lastname`, '' AS SelectFilterFld FROM `students`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `firstname` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$student_subjects->studentID->EditValue = $arwrk;

			// termID
			$student_subjects->termID->EditCustomAttributes = "";
			$student_subjects->termID->EditValue = ew_HtmlEncode($student_subjects->termID->CurrentValue);

			// vClassID
			$student_subjects->vClassID->EditCustomAttributes = "";
			$student_subjects->vClassID->EditValue = ew_HtmlEncode($student_subjects->vClassID->CurrentValue);

			// caScore
			$student_subjects->caScore->EditCustomAttributes = "";
			$student_subjects->caScore->EditValue = ew_HtmlEncode($student_subjects->caScore->CurrentValue);

			// examScore
			$student_subjects->examScore->EditCustomAttributes = "";
			$student_subjects->examScore->EditValue = ew_HtmlEncode($student_subjects->examScore->CurrentValue);

			// grade
			$student_subjects->grade->EditCustomAttributes = "";
			$student_subjects->grade->EditValue = ew_HtmlEncode($student_subjects->grade->CurrentValue);

			// comments
			$student_subjects->comments->EditCustomAttributes = "";
			$student_subjects->comments->EditValue = ew_HtmlEncode($student_subjects->comments->CurrentValue);

			// status
			$student_subjects->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$student_subjects->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($student_subjects->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$student_subjects->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $student_subjects;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($student_subjects->studentID->FormValue) && $student_subjects->studentID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $student_subjects->studentID->FldCaption();
		}
		if (!ew_CheckInteger($student_subjects->termID->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $student_subjects->termID->FldErrMsg();
		}
		if (!ew_CheckInteger($student_subjects->vClassID->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $student_subjects->vClassID->FldErrMsg();
		}
		if (!ew_CheckNumber($student_subjects->caScore->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $student_subjects->caScore->FldErrMsg();
		}
		if (!ew_CheckNumber($student_subjects->examScore->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $student_subjects->examScore->FldErrMsg();
		}
		if ($student_subjects->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $student_subjects->status->FldCaption();
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
		global $conn, $Language, $Security, $student_subjects;
		$rsnew = array();

		// studentID
		$student_subjects->studentID->SetDbValueDef($rsnew, $student_subjects->studentID->CurrentValue, NULL, FALSE);

		// termID
		$student_subjects->termID->SetDbValueDef($rsnew, $student_subjects->termID->CurrentValue, NULL, FALSE);

		// vClassID
		$student_subjects->vClassID->SetDbValueDef($rsnew, $student_subjects->vClassID->CurrentValue, NULL, FALSE);

		// caScore
		$student_subjects->caScore->SetDbValueDef($rsnew, $student_subjects->caScore->CurrentValue, NULL, FALSE);

		// examScore
		$student_subjects->examScore->SetDbValueDef($rsnew, $student_subjects->examScore->CurrentValue, NULL, FALSE);

		// grade
		$student_subjects->grade->SetDbValueDef($rsnew, $student_subjects->grade->CurrentValue, NULL, FALSE);

		// comments
		$student_subjects->comments->SetDbValueDef($rsnew, $student_subjects->comments->CurrentValue, NULL, FALSE);

		// status
		$student_subjects->status->SetDbValueDef($rsnew, $student_subjects->status->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $student_subjects->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($student_subjects->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($student_subjects->CancelMessage <> "") {
				$this->setMessage($student_subjects->CancelMessage);
				$student_subjects->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$student_subjects->studentSubjectID->setDbValue($conn->Insert_ID());
			$rsnew['studentSubjectID'] = $student_subjects->studentSubjectID->DbValue;

			// Call Row Inserted event
			$student_subjects->Row_Inserted($rsnew);
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
