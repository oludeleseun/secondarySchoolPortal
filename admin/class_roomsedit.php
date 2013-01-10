<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "class_roomsinfo.php" ?>
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
$class_rooms_edit = new cclass_rooms_edit();
$Page =& $class_rooms_edit;

// Page init
$class_rooms_edit->Page_Init();

// Page main
$class_rooms_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var class_rooms_edit = new ew_Page("class_rooms_edit");

// page properties
class_rooms_edit.PageID = "edit"; // page ID
class_rooms_edit.FormID = "fclass_roomsedit"; // form ID
var EW_PAGE_ID = class_rooms_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
class_rooms_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_classLevelID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($class_rooms->classLevelID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_classTeacher"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($class_rooms->classTeacher->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($class_rooms->status->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
class_rooms_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
class_rooms_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
class_rooms_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
class_rooms_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $class_rooms->TableCaption() ?><br><br>
<a href="<?php echo $class_rooms->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$class_rooms_edit->ShowMessage();
?>
<form name="fclass_roomsedit" id="fclass_roomsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return class_rooms_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="class_rooms">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($class_rooms->classID->Visible) { // classID ?>
	<tr<?php echo $class_rooms->classID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->classID->FldCaption() ?></td>
		<td<?php echo $class_rooms->classID->CellAttributes() ?>><span id="el_classID">
<div<?php echo $class_rooms->classID->ViewAttributes() ?>><?php echo $class_rooms->classID->EditValue ?></div><input type="hidden" name="x_classID" id="x_classID" value="<?php echo ew_HtmlEncode($class_rooms->classID->CurrentValue) ?>">
</span><?php echo $class_rooms->classID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($class_rooms->classLevelID->Visible) { // classLevelID ?>
	<tr<?php echo $class_rooms->classLevelID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->classLevelID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $class_rooms->classLevelID->CellAttributes() ?>><span id="el_classLevelID">
<select id="x_classLevelID" name="x_classLevelID" title="<?php echo $class_rooms->classLevelID->FldTitle() ?>"<?php echo $class_rooms->classLevelID->EditAttributes() ?>>
<?php
if (is_array($class_rooms->classLevelID->EditValue)) {
	$arwrk = $class_rooms->classLevelID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($class_rooms->classLevelID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $class_rooms->classLevelID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($class_rooms->className->Visible) { // className ?>
	<tr<?php echo $class_rooms->className->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->className->FldCaption() ?></td>
		<td<?php echo $class_rooms->className->CellAttributes() ?>><span id="el_className">
<input type="text" name="x_className" id="x_className" title="<?php echo $class_rooms->className->FldTitle() ?>" size="30" maxlength="70" value="<?php echo $class_rooms->className->EditValue ?>"<?php echo $class_rooms->className->EditAttributes() ?>>
</span><?php echo $class_rooms->className->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($class_rooms->classTeacher->Visible) { // classTeacher ?>
	<tr<?php echo $class_rooms->classTeacher->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->classTeacher->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $class_rooms->classTeacher->CellAttributes() ?>><span id="el_classTeacher">
<select id="x_classTeacher" name="x_classTeacher" title="<?php echo $class_rooms->classTeacher->FldTitle() ?>"<?php echo $class_rooms->classTeacher->EditAttributes() ?>>
<?php
if (is_array($class_rooms->classTeacher->EditValue)) {
	$arwrk = $class_rooms->classTeacher->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($class_rooms->classTeacher->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $class_rooms->classTeacher->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($class_rooms->status->Visible) { // status ?>
	<tr<?php echo $class_rooms->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_rooms->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $class_rooms->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $class_rooms->status->FldTitle() ?>" value="{value}"<?php echo $class_rooms->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $class_rooms->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($class_rooms->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $class_rooms->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $class_rooms->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $class_rooms->status->CustomMsg ?></td>
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
$class_rooms_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cclass_rooms_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'class_rooms';

	// Page object name
	var $PageObjName = 'class_rooms_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $class_rooms;
		if ($class_rooms->UseTokenInUrl) $PageUrl .= "t=" . $class_rooms->TableVar . "&"; // Add page token
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
		global $objForm, $class_rooms;
		if ($class_rooms->UseTokenInUrl) {
			if ($objForm)
				return ($class_rooms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($class_rooms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclass_rooms_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (class_rooms)
		$GLOBALS["class_rooms"] = new cclass_rooms();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'class_rooms', TRUE);

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
		global $class_rooms;

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
		global $objForm, $Language, $gsFormError, $class_rooms;

		// Load key from QueryString
		if (@$_GET["classID"] <> "")
			$class_rooms->classID->setQueryStringValue($_GET["classID"]);
		if (@$_POST["a_edit"] <> "") {
			$class_rooms->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$class_rooms->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$class_rooms->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$class_rooms->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($class_rooms->classID->CurrentValue == "")
			$this->Page_Terminate("class_roomslist.php"); // Invalid key, return to list
		switch ($class_rooms->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("class_roomslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$class_rooms->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $class_rooms->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$class_rooms->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$class_rooms->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $class_rooms;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $class_rooms;
		$class_rooms->classID->setFormValue($objForm->GetValue("x_classID"));
		$class_rooms->classLevelID->setFormValue($objForm->GetValue("x_classLevelID"));
		$class_rooms->className->setFormValue($objForm->GetValue("x_className"));
		$class_rooms->classTeacher->setFormValue($objForm->GetValue("x_classTeacher"));
		$class_rooms->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $class_rooms;
		$this->LoadRow();
		$class_rooms->classID->CurrentValue = $class_rooms->classID->FormValue;
		$class_rooms->classLevelID->CurrentValue = $class_rooms->classLevelID->FormValue;
		$class_rooms->className->CurrentValue = $class_rooms->className->FormValue;
		$class_rooms->classTeacher->CurrentValue = $class_rooms->classTeacher->FormValue;
		$class_rooms->status->CurrentValue = $class_rooms->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $class_rooms;
		$sFilter = $class_rooms->KeyFilter();

		// Call Row Selecting event
		$class_rooms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$class_rooms->CurrentFilter = $sFilter;
		$sSql = $class_rooms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$class_rooms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $class_rooms;
		$class_rooms->classID->setDbValue($rs->fields('classID'));
		$class_rooms->classLevelID->setDbValue($rs->fields('classLevelID'));
		$class_rooms->className->setDbValue($rs->fields('className'));
		$class_rooms->classTeacher->setDbValue($rs->fields('classTeacher'));
		$class_rooms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $class_rooms;

		// Initialize URLs
		// Call Row_Rendering event

		$class_rooms->Row_Rendering();

		// Common render codes for all row types
		// classID

		$class_rooms->classID->CellCssStyle = ""; $class_rooms->classID->CellCssClass = "";
		$class_rooms->classID->CellAttrs = array(); $class_rooms->classID->ViewAttrs = array(); $class_rooms->classID->EditAttrs = array();

		// classLevelID
		$class_rooms->classLevelID->CellCssStyle = ""; $class_rooms->classLevelID->CellCssClass = "";
		$class_rooms->classLevelID->CellAttrs = array(); $class_rooms->classLevelID->ViewAttrs = array(); $class_rooms->classLevelID->EditAttrs = array();

		// className
		$class_rooms->className->CellCssStyle = ""; $class_rooms->className->CellCssClass = "";
		$class_rooms->className->CellAttrs = array(); $class_rooms->className->ViewAttrs = array(); $class_rooms->className->EditAttrs = array();

		// classTeacher
		$class_rooms->classTeacher->CellCssStyle = ""; $class_rooms->classTeacher->CellCssClass = "";
		$class_rooms->classTeacher->CellAttrs = array(); $class_rooms->classTeacher->ViewAttrs = array(); $class_rooms->classTeacher->EditAttrs = array();

		// status
		$class_rooms->status->CellCssStyle = ""; $class_rooms->status->CellCssClass = "";
		$class_rooms->status->CellAttrs = array(); $class_rooms->status->ViewAttrs = array(); $class_rooms->status->EditAttrs = array();
		if ($class_rooms->RowType == EW_ROWTYPE_VIEW) { // View row

			// classID
			$class_rooms->classID->ViewValue = $class_rooms->classID->CurrentValue;
			$class_rooms->classID->CssStyle = "";
			$class_rooms->classID->CssClass = "";
			$class_rooms->classID->ViewCustomAttributes = "";

			// classLevelID
			if (strval($class_rooms->classLevelID->CurrentValue) <> "") {
				$sFilterWrk = "`classLevelID` = " . ew_AdjustSql($class_rooms->classLevelID->CurrentValue) . "";
			$sSqlWrk = "SELECT `classLevel` FROM `class_levels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$class_rooms->classLevelID->ViewValue = $rswrk->fields('classLevel');
					$rswrk->Close();
				} else {
					$class_rooms->classLevelID->ViewValue = $class_rooms->classLevelID->CurrentValue;
				}
			} else {
				$class_rooms->classLevelID->ViewValue = NULL;
			}
			$class_rooms->classLevelID->CssStyle = "";
			$class_rooms->classLevelID->CssClass = "";
			$class_rooms->classLevelID->ViewCustomAttributes = "";

			// className
			$class_rooms->className->ViewValue = $class_rooms->className->CurrentValue;
			$class_rooms->className->CssStyle = "";
			$class_rooms->className->CssClass = "";
			$class_rooms->className->ViewCustomAttributes = "";

			// classTeacher
			if (strval($class_rooms->classTeacher->CurrentValue) <> "") {
				$sFilterWrk = "`teacherID` = " . ew_AdjustSql($class_rooms->classTeacher->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `teachers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `lastname` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$class_rooms->classTeacher->ViewValue = $rswrk->fields('firstname');
					$class_rooms->classTeacher->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$class_rooms->classTeacher->ViewValue = $class_rooms->classTeacher->CurrentValue;
				}
			} else {
				$class_rooms->classTeacher->ViewValue = NULL;
			}
			$class_rooms->classTeacher->CssStyle = "";
			$class_rooms->classTeacher->CssClass = "";
			$class_rooms->classTeacher->ViewCustomAttributes = "";

			// status
			if (strval($class_rooms->status->CurrentValue) <> "") {
				switch ($class_rooms->status->CurrentValue) {
					case "1":
						$class_rooms->status->ViewValue = "Enabled";
						break;
					case "0":
						$class_rooms->status->ViewValue = "Disabled";
						break;
					default:
						$class_rooms->status->ViewValue = $class_rooms->status->CurrentValue;
				}
			} else {
				$class_rooms->status->ViewValue = NULL;
			}
			$class_rooms->status->CssStyle = "";
			$class_rooms->status->CssClass = "";
			$class_rooms->status->ViewCustomAttributes = "";

			// classID
			$class_rooms->classID->HrefValue = "";
			$class_rooms->classID->TooltipValue = "";

			// classLevelID
			$class_rooms->classLevelID->HrefValue = "";
			$class_rooms->classLevelID->TooltipValue = "";

			// className
			$class_rooms->className->HrefValue = "";
			$class_rooms->className->TooltipValue = "";

			// classTeacher
			$class_rooms->classTeacher->HrefValue = "";
			$class_rooms->classTeacher->TooltipValue = "";

			// status
			$class_rooms->status->HrefValue = "";
			$class_rooms->status->TooltipValue = "";
		} elseif ($class_rooms->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// classID
			$class_rooms->classID->EditCustomAttributes = "";
			$class_rooms->classID->EditValue = $class_rooms->classID->CurrentValue;
			$class_rooms->classID->CssStyle = "";
			$class_rooms->classID->CssClass = "";
			$class_rooms->classID->ViewCustomAttributes = "";

			// classLevelID
			$class_rooms->classLevelID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `classLevelID`, `classLevel`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `class_levels`";
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
			$class_rooms->classLevelID->EditValue = $arwrk;

			// className
			$class_rooms->className->EditCustomAttributes = "";
			$class_rooms->className->EditValue = ew_HtmlEncode($class_rooms->className->CurrentValue);

			// classTeacher
			$class_rooms->classTeacher->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `teacherID`, `firstname`, `lastname`, '' AS SelectFilterFld FROM `teachers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `lastname` Asc";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect"), ""));
			$class_rooms->classTeacher->EditValue = $arwrk;

			// status
			$class_rooms->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$class_rooms->status->EditValue = $arwrk;

			// Edit refer script
			// classID

			$class_rooms->classID->HrefValue = "";

			// classLevelID
			$class_rooms->classLevelID->HrefValue = "";

			// className
			$class_rooms->className->HrefValue = "";

			// classTeacher
			$class_rooms->classTeacher->HrefValue = "";

			// status
			$class_rooms->status->HrefValue = "";
		}

		// Call Row Rendered event
		if ($class_rooms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$class_rooms->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $class_rooms;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($class_rooms->classLevelID->FormValue) && $class_rooms->classLevelID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $class_rooms->classLevelID->FldCaption();
		}
		if (!is_null($class_rooms->classTeacher->FormValue) && $class_rooms->classTeacher->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $class_rooms->classTeacher->FldCaption();
		}
		if ($class_rooms->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $class_rooms->status->FldCaption();
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
		global $conn, $Security, $Language, $class_rooms;
		$sFilter = $class_rooms->KeyFilter();
		$class_rooms->CurrentFilter = $sFilter;
		$sSql = $class_rooms->SQL();
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

			// classLevelID
			$class_rooms->classLevelID->SetDbValueDef($rsnew, $class_rooms->classLevelID->CurrentValue, NULL, FALSE);

			// className
			$class_rooms->className->SetDbValueDef($rsnew, $class_rooms->className->CurrentValue, NULL, FALSE);

			// classTeacher
			$class_rooms->classTeacher->SetDbValueDef($rsnew, $class_rooms->classTeacher->CurrentValue, NULL, FALSE);

			// status
			$class_rooms->status->SetDbValueDef($rsnew, $class_rooms->status->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $class_rooms->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($class_rooms->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($class_rooms->CancelMessage <> "") {
					$this->setMessage($class_rooms->CancelMessage);
					$class_rooms->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$class_rooms->Row_Updated($rsold, $rsnew);
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
