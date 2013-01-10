<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "subject_teachersinfo.php" ?>
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
$subject_teachers_add = new csubject_teachers_add();
$Page =& $subject_teachers_add;

// Page init
$subject_teachers_add->Page_Init();

// Page main
$subject_teachers_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subject_teachers_add = new ew_Page("subject_teachers_add");

// page properties
subject_teachers_add.PageID = "add"; // page ID
subject_teachers_add.FormID = "fsubject_teachersadd"; // form ID
var EW_PAGE_ID = subject_teachers_add.PageID; // for backward compatibility

// extend page with ValidateForm function
subject_teachers_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_subjectID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subject_teachers->subjectID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_subjectTeacher"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subject_teachers->subjectTeacher->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_classroomID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subject_teachers->classroomID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($subject_teachers->status->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
subject_teachers_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subject_teachers_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subject_teachers_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subject_teachers_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subject_teachers->TableCaption() ?><br><br>
<a href="<?php echo $subject_teachers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subject_teachers_add->ShowMessage();
?>
<form name="fsubject_teachersadd" id="fsubject_teachersadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return subject_teachers_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="subject_teachers">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($subject_teachers->subjectID->Visible) { // subjectID ?>
	<tr<?php echo $subject_teachers->subjectID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subject_teachers->subjectID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subject_teachers->subjectID->CellAttributes() ?>><span id="el_subjectID">
<select id="x_subjectID" name="x_subjectID" title="<?php echo $subject_teachers->subjectID->FldTitle() ?>"<?php echo $subject_teachers->subjectID->EditAttributes() ?>>
<?php
if (is_array($subject_teachers->subjectID->EditValue)) {
	$arwrk = $subject_teachers->subjectID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subject_teachers->subjectID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $subject_teachers->subjectID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subject_teachers->subjectTeacher->Visible) { // subjectTeacher ?>
	<tr<?php echo $subject_teachers->subjectTeacher->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subject_teachers->subjectTeacher->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subject_teachers->subjectTeacher->CellAttributes() ?>><span id="el_subjectTeacher">
<select id="x_subjectTeacher" name="x_subjectTeacher" title="<?php echo $subject_teachers->subjectTeacher->FldTitle() ?>"<?php echo $subject_teachers->subjectTeacher->EditAttributes() ?>>
<?php
if (is_array($subject_teachers->subjectTeacher->EditValue)) {
	$arwrk = $subject_teachers->subjectTeacher->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subject_teachers->subjectTeacher->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $subject_teachers->subjectTeacher->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subject_teachers->classroomID->Visible) { // classroomID ?>
	<tr<?php echo $subject_teachers->classroomID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subject_teachers->classroomID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subject_teachers->classroomID->CellAttributes() ?>><span id="el_classroomID">
<select id="x_classroomID" name="x_classroomID" title="<?php echo $subject_teachers->classroomID->FldTitle() ?>"<?php echo $subject_teachers->classroomID->EditAttributes() ?>>
<?php
if (is_array($subject_teachers->classroomID->EditValue)) {
	$arwrk = $subject_teachers->classroomID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subject_teachers->classroomID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $subject_teachers->classroomID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($subject_teachers->status->Visible) { // status ?>
	<tr<?php echo $subject_teachers->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $subject_teachers->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $subject_teachers->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $subject_teachers->status->FldTitle() ?>" value="{value}"<?php echo $subject_teachers->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $subject_teachers->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($subject_teachers->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $subject_teachers->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $subject_teachers->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $subject_teachers->status->CustomMsg ?></td>
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
$subject_teachers_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csubject_teachers_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'subject_teachers';

	// Page object name
	var $PageObjName = 'subject_teachers_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subject_teachers;
		if ($subject_teachers->UseTokenInUrl) $PageUrl .= "t=" . $subject_teachers->TableVar . "&"; // Add page token
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
		global $objForm, $subject_teachers;
		if ($subject_teachers->UseTokenInUrl) {
			if ($objForm)
				return ($subject_teachers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subject_teachers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubject_teachers_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subject_teachers)
		$GLOBALS["subject_teachers"] = new csubject_teachers();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subject_teachers', TRUE);

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
		global $subject_teachers;

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
		global $objForm, $Language, $gsFormError, $subject_teachers;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["subjectTeacherID"] != "") {
		  $subject_teachers->subjectTeacherID->setQueryStringValue($_GET["subjectTeacherID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $subject_teachers->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$subject_teachers->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $subject_teachers->CurrentAction = "C"; // Copy record
		  } else {
		    $subject_teachers->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($subject_teachers->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("subject_teacherslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$subject_teachers->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $subject_teachers->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$subject_teachers->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $subject_teachers;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $subject_teachers;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $subject_teachers;
		$subject_teachers->subjectID->setFormValue($objForm->GetValue("x_subjectID"));
		$subject_teachers->subjectTeacher->setFormValue($objForm->GetValue("x_subjectTeacher"));
		$subject_teachers->classroomID->setFormValue($objForm->GetValue("x_classroomID"));
		$subject_teachers->status->setFormValue($objForm->GetValue("x_status"));
		$subject_teachers->subjectTeacherID->setFormValue($objForm->GetValue("x_subjectTeacherID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $subject_teachers;
		$subject_teachers->subjectTeacherID->CurrentValue = $subject_teachers->subjectTeacherID->FormValue;
		$subject_teachers->subjectID->CurrentValue = $subject_teachers->subjectID->FormValue;
		$subject_teachers->subjectTeacher->CurrentValue = $subject_teachers->subjectTeacher->FormValue;
		$subject_teachers->classroomID->CurrentValue = $subject_teachers->classroomID->FormValue;
		$subject_teachers->status->CurrentValue = $subject_teachers->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subject_teachers;
		$sFilter = $subject_teachers->KeyFilter();

		// Call Row Selecting event
		$subject_teachers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subject_teachers->CurrentFilter = $sFilter;
		$sSql = $subject_teachers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subject_teachers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subject_teachers;
		$subject_teachers->subjectTeacherID->setDbValue($rs->fields('subjectTeacherID'));
		$subject_teachers->subjectID->setDbValue($rs->fields('subjectID'));
		$subject_teachers->subjectTeacher->setDbValue($rs->fields('subjectTeacher'));
		$subject_teachers->classroomID->setDbValue($rs->fields('classroomID'));
		$subject_teachers->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subject_teachers;

		// Initialize URLs
		// Call Row_Rendering event

		$subject_teachers->Row_Rendering();

		// Common render codes for all row types
		// subjectID

		$subject_teachers->subjectID->CellCssStyle = ""; $subject_teachers->subjectID->CellCssClass = "";
		$subject_teachers->subjectID->CellAttrs = array(); $subject_teachers->subjectID->ViewAttrs = array(); $subject_teachers->subjectID->EditAttrs = array();

		// subjectTeacher
		$subject_teachers->subjectTeacher->CellCssStyle = ""; $subject_teachers->subjectTeacher->CellCssClass = "";
		$subject_teachers->subjectTeacher->CellAttrs = array(); $subject_teachers->subjectTeacher->ViewAttrs = array(); $subject_teachers->subjectTeacher->EditAttrs = array();

		// classroomID
		$subject_teachers->classroomID->CellCssStyle = ""; $subject_teachers->classroomID->CellCssClass = "";
		$subject_teachers->classroomID->CellAttrs = array(); $subject_teachers->classroomID->ViewAttrs = array(); $subject_teachers->classroomID->EditAttrs = array();

		// status
		$subject_teachers->status->CellCssStyle = ""; $subject_teachers->status->CellCssClass = "";
		$subject_teachers->status->CellAttrs = array(); $subject_teachers->status->ViewAttrs = array(); $subject_teachers->status->EditAttrs = array();
		if ($subject_teachers->RowType == EW_ROWTYPE_VIEW) { // View row

			// subjectTeacherID
			$subject_teachers->subjectTeacherID->ViewValue = $subject_teachers->subjectTeacherID->CurrentValue;
			$subject_teachers->subjectTeacherID->CssStyle = "";
			$subject_teachers->subjectTeacherID->CssClass = "";
			$subject_teachers->subjectTeacherID->ViewCustomAttributes = "";

			// subjectID
			if (strval($subject_teachers->subjectID->CurrentValue) <> "") {
				$sFilterWrk = "`subjectID` = " . ew_AdjustSql($subject_teachers->subjectID->CurrentValue) . "";
			$sSqlWrk = "SELECT `subjectName`, `subjectDescription` FROM `subjects`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `subjectName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subject_teachers->subjectID->ViewValue = $rswrk->fields('subjectName');
					$subject_teachers->subjectID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('subjectDescription');
					$rswrk->Close();
				} else {
					$subject_teachers->subjectID->ViewValue = $subject_teachers->subjectID->CurrentValue;
				}
			} else {
				$subject_teachers->subjectID->ViewValue = NULL;
			}
			$subject_teachers->subjectID->CssStyle = "";
			$subject_teachers->subjectID->CssClass = "";
			$subject_teachers->subjectID->ViewCustomAttributes = "";

			// subjectTeacher
			if (strval($subject_teachers->subjectTeacher->CurrentValue) <> "") {
				$sFilterWrk = "`teacherID` = " . ew_AdjustSql($subject_teachers->subjectTeacher->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `teachers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subject_teachers->subjectTeacher->ViewValue = $rswrk->fields('firstname');
					$subject_teachers->subjectTeacher->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$subject_teachers->subjectTeacher->ViewValue = $subject_teachers->subjectTeacher->CurrentValue;
				}
			} else {
				$subject_teachers->subjectTeacher->ViewValue = NULL;
			}
			$subject_teachers->subjectTeacher->CssStyle = "";
			$subject_teachers->subjectTeacher->CssClass = "";
			$subject_teachers->subjectTeacher->ViewCustomAttributes = "";

			// classroomID
			if (strval($subject_teachers->classroomID->CurrentValue) <> "") {
				$sFilterWrk = "`classID` = " . ew_AdjustSql($subject_teachers->classroomID->CurrentValue) . "";
			$sSqlWrk = "SELECT `className`, `classTeacher` FROM `class_rooms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subject_teachers->classroomID->ViewValue = $rswrk->fields('className');
					$subject_teachers->classroomID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('classTeacher');
					$rswrk->Close();
				} else {
					$subject_teachers->classroomID->ViewValue = $subject_teachers->classroomID->CurrentValue;
				}
			} else {
				$subject_teachers->classroomID->ViewValue = NULL;
			}
			$subject_teachers->classroomID->CssStyle = "";
			$subject_teachers->classroomID->CssClass = "";
			$subject_teachers->classroomID->ViewCustomAttributes = "";

			// status
			if (strval($subject_teachers->status->CurrentValue) <> "") {
				switch ($subject_teachers->status->CurrentValue) {
					case "1":
						$subject_teachers->status->ViewValue = "Enabled";
						break;
					case "0":
						$subject_teachers->status->ViewValue = "Disabled";
						break;
					default:
						$subject_teachers->status->ViewValue = $subject_teachers->status->CurrentValue;
				}
			} else {
				$subject_teachers->status->ViewValue = NULL;
			}
			$subject_teachers->status->CssStyle = "";
			$subject_teachers->status->CssClass = "";
			$subject_teachers->status->ViewCustomAttributes = "";

			// subjectID
			$subject_teachers->subjectID->HrefValue = "";
			$subject_teachers->subjectID->TooltipValue = "";

			// subjectTeacher
			$subject_teachers->subjectTeacher->HrefValue = "";
			$subject_teachers->subjectTeacher->TooltipValue = "";

			// classroomID
			$subject_teachers->classroomID->HrefValue = "";
			$subject_teachers->classroomID->TooltipValue = "";

			// status
			$subject_teachers->status->HrefValue = "";
			$subject_teachers->status->TooltipValue = "";
		} elseif ($subject_teachers->RowType == EW_ROWTYPE_ADD) { // Add row

			// subjectID
			$subject_teachers->subjectID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `subjectID`, `subjectName`, `subjectDescription`, '' AS SelectFilterFld FROM `subjects`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `subjectName` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$subject_teachers->subjectID->EditValue = $arwrk;

			// subjectTeacher
			$subject_teachers->subjectTeacher->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `teacherID`, `firstname`, `lastname`, '' AS SelectFilterFld FROM `teachers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$subject_teachers->subjectTeacher->EditValue = $arwrk;

			// classroomID
			$subject_teachers->classroomID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `classID`, `className`, `classTeacher`, '' AS SelectFilterFld FROM `class_rooms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$subject_teachers->classroomID->EditValue = $arwrk;

			// status
			$subject_teachers->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$subject_teachers->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($subject_teachers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subject_teachers->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $subject_teachers;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($subject_teachers->subjectID->FormValue) && $subject_teachers->subjectID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subject_teachers->subjectID->FldCaption();
		}
		if (!is_null($subject_teachers->subjectTeacher->FormValue) && $subject_teachers->subjectTeacher->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subject_teachers->subjectTeacher->FldCaption();
		}
		if (!is_null($subject_teachers->classroomID->FormValue) && $subject_teachers->classroomID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subject_teachers->classroomID->FldCaption();
		}
		if ($subject_teachers->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $subject_teachers->status->FldCaption();
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
		global $conn, $Language, $Security, $subject_teachers;
		$rsnew = array();

		// subjectID
		$subject_teachers->subjectID->SetDbValueDef($rsnew, $subject_teachers->subjectID->CurrentValue, NULL, FALSE);

		// subjectTeacher
		$subject_teachers->subjectTeacher->SetDbValueDef($rsnew, $subject_teachers->subjectTeacher->CurrentValue, NULL, FALSE);

		// classroomID
		$subject_teachers->classroomID->SetDbValueDef($rsnew, $subject_teachers->classroomID->CurrentValue, NULL, FALSE);

		// status
		$subject_teachers->status->SetDbValueDef($rsnew, $subject_teachers->status->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $subject_teachers->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($subject_teachers->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($subject_teachers->CancelMessage <> "") {
				$this->setMessage($subject_teachers->CancelMessage);
				$subject_teachers->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$subject_teachers->subjectTeacherID->setDbValue($conn->Insert_ID());
			$rsnew['subjectTeacherID'] = $subject_teachers->subjectTeacherID->DbValue;

			// Call Row Inserted event
			$subject_teachers->Row_Inserted($rsnew);
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
