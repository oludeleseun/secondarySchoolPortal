<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "studentsinfo.php" ?>
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
$students_edit = new cstudents_edit();
$Page =& $students_edit;

// Page init
$students_edit->Page_Init();

// Page main
$students_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var students_edit = new ew_Page("students_edit");

// page properties
students_edit.PageID = "edit"; // page ID
students_edit.FormID = "fstudentsedit"; // form ID
var EW_PAGE_ID = students_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
students_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_admissionNumber"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->admissionNumber->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_firstname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->firstname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lastname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->lastname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_gender"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->gender->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_dob"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->dob->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_dob"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($students->dob->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_residentialAddress"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->residentialAddress->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_residentState"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->residentState->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stateOfOrigin"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->stateOfOrigin->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_currentClass"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->currentClass->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_parentID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->parentID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_studentImage"];
		if (elm && !ew_CheckFileType(elm.value))
			return ew_OnError(this, elm, ewLanguage.Phrase("WrongFileType"));
		elm = fobj.elements["x" + infix + "_feesCreditBalance"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($students->feesCreditBalance->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_feesCreditBalance"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($students->feesCreditBalance->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
students_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
students_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
students_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
students_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $students->TableCaption() ?><br><br>
<a href="<?php echo $students->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$students_edit->ShowMessage();
?>
<form name="fstudentsedit" id="fstudentsedit" action="<?php echo ew_CurrentPage() ?>" method="post" enctype="multipart/form-data" onsubmit="return students_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="students">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($students->studentID->Visible) { // studentID ?>
	<tr<?php echo $students->studentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->studentID->FldCaption() ?></td>
		<td<?php echo $students->studentID->CellAttributes() ?>><span id="el_studentID">
<div<?php echo $students->studentID->ViewAttributes() ?>><?php echo $students->studentID->EditValue ?></div><input type="hidden" name="x_studentID" id="x_studentID" value="<?php echo ew_HtmlEncode($students->studentID->CurrentValue) ?>">
</span><?php echo $students->studentID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->admissionNumber->Visible) { // admissionNumber ?>
	<tr<?php echo $students->admissionNumber->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->admissionNumber->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->admissionNumber->CellAttributes() ?>><span id="el_admissionNumber">
<input type="text" name="x_admissionNumber" id="x_admissionNumber" title="<?php echo $students->admissionNumber->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $students->admissionNumber->EditValue ?>"<?php echo $students->admissionNumber->EditAttributes() ?>>
</span><?php echo $students->admissionNumber->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->firstname->Visible) { // firstname ?>
	<tr<?php echo $students->firstname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->firstname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->firstname->CellAttributes() ?>><span id="el_firstname">
<input type="text" name="x_firstname" id="x_firstname" title="<?php echo $students->firstname->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $students->firstname->EditValue ?>"<?php echo $students->firstname->EditAttributes() ?>>
</span><?php echo $students->firstname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->middlename->Visible) { // middlename ?>
	<tr<?php echo $students->middlename->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->middlename->FldCaption() ?></td>
		<td<?php echo $students->middlename->CellAttributes() ?>><span id="el_middlename">
<input type="text" name="x_middlename" id="x_middlename" title="<?php echo $students->middlename->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $students->middlename->EditValue ?>"<?php echo $students->middlename->EditAttributes() ?>>
</span><?php echo $students->middlename->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->lastname->Visible) { // lastname ?>
	<tr<?php echo $students->lastname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->lastname->CellAttributes() ?>><span id="el_lastname">
<input type="text" name="x_lastname" id="x_lastname" title="<?php echo $students->lastname->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $students->lastname->EditValue ?>"<?php echo $students->lastname->EditAttributes() ?>>
</span><?php echo $students->lastname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->gender->Visible) { // gender ?>
	<tr<?php echo $students->gender->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->gender->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->gender->CellAttributes() ?>><span id="el_gender">
<div id="tp_x_gender" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_gender" id="x_gender" title="<?php echo $students->gender->FldTitle() ?>" value="{value}"<?php echo $students->gender->EditAttributes() ?>></label></div>
<div id="dsl_x_gender" repeatcolumn="5">
<?php
$arwrk = $students->gender->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($students->gender->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_gender" id="x_gender" title="<?php echo $students->gender->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $students->gender->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $students->gender->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->dob->Visible) { // dob ?>
	<tr<?php echo $students->dob->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->dob->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->dob->CellAttributes() ?>><span id="el_dob">
<input type="text" name="x_dob" id="x_dob" title="<?php echo $students->dob->FldTitle() ?>" value="<?php echo $students->dob->EditValue ?>"<?php echo $students->dob->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_dob" name="cal_x_dob" alt="<?php echo $Language->Phrase("PickDate") ?>" title="<?php echo $Language->Phrase("PickDate") ?>" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField: "x_dob", // input field id
	ifFormat: "%Y/%m/%d", // date format
	button: "cal_x_dob" // button id
});
</script>
</span><?php echo $students->dob->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->residentialAddress->Visible) { // residentialAddress ?>
	<tr<?php echo $students->residentialAddress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->residentialAddress->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->residentialAddress->CellAttributes() ?>><span id="el_residentialAddress">
<textarea name="x_residentialAddress" id="x_residentialAddress" title="<?php echo $students->residentialAddress->FldTitle() ?>" cols="35" rows="4"<?php echo $students->residentialAddress->EditAttributes() ?>><?php echo $students->residentialAddress->EditValue ?></textarea>
</span><?php echo $students->residentialAddress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->residentState->Visible) { // residentState ?>
	<tr<?php echo $students->residentState->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->residentState->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->residentState->CellAttributes() ?>><span id="el_residentState">
<input type="text" name="x_residentState" id="x_residentState" title="<?php echo $students->residentState->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $students->residentState->EditValue ?>"<?php echo $students->residentState->EditAttributes() ?>>
</span><?php echo $students->residentState->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->stateOfOrigin->Visible) { // stateOfOrigin ?>
	<tr<?php echo $students->stateOfOrigin->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->stateOfOrigin->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->stateOfOrigin->CellAttributes() ?>><span id="el_stateOfOrigin">
<input type="text" name="x_stateOfOrigin" id="x_stateOfOrigin" title="<?php echo $students->stateOfOrigin->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $students->stateOfOrigin->EditValue ?>"<?php echo $students->stateOfOrigin->EditAttributes() ?>>
</span><?php echo $students->stateOfOrigin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->currentClass->Visible) { // currentClass ?>
	<tr<?php echo $students->currentClass->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->currentClass->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->currentClass->CellAttributes() ?>><span id="el_currentClass">
<select id="x_currentClass" name="x_currentClass" title="<?php echo $students->currentClass->FldTitle() ?>"<?php echo $students->currentClass->EditAttributes() ?>>
<?php
if (is_array($students->currentClass->EditValue)) {
	$arwrk = $students->currentClass->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($students->currentClass->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $students->currentClass->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->parentID->Visible) { // parentID ?>
	<tr<?php echo $students->parentID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->parentID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->parentID->CellAttributes() ?>><span id="el_parentID">
<select id="x_parentID" name="x_parentID" title="<?php echo $students->parentID->FldTitle() ?>"<?php echo $students->parentID->EditAttributes() ?>>
<?php
if (is_array($students->parentID->EditValue)) {
	$arwrk = $students->parentID->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($students->parentID->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $students->parentID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->studentImage->Visible) { // studentImage ?>
	<tr<?php echo $students->studentImage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->studentImage->FldCaption() ?></td>
		<td<?php echo $students->studentImage->CellAttributes() ?>><span id="el_studentImage">
<div id="old_x_studentImage">
<?php if ($students->studentImage->HrefValue <> "" || $students->studentImage->TooltipValue <> "") { ?>
<?php if (!empty($students->studentImage->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $students->studentImage->UploadPath) . $students->studentImage->Upload->DbValue ?>" border=0<?php echo $students->studentImage->ViewAttributes() ?>>
<?php } elseif (!in_array($students->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } else { ?>
<?php if (!empty($students->studentImage->Upload->DbValue)) { ?>
<img src="<?php echo ew_UploadPathEx(FALSE, $students->studentImage->UploadPath) . $students->studentImage->Upload->DbValue ?>" border=0<?php echo $students->studentImage->ViewAttributes() ?>>
<?php } elseif (!in_array($students->CurrentAction, array("I", "edit", "gridedit"))) { ?>	
&nbsp;
<?php } ?>
<?php } ?>
</div>
<div id="new_x_studentImage">
<?php if (!empty($students->studentImage->Upload->DbValue)) { ?>
<label><input type="radio" name="a_studentImage" id="a_studentImage" value="1" checked="checked"><?php echo $Language->Phrase("Keep") ?></label>&nbsp;
<label><input type="radio" name="a_studentImage" id="a_studentImage" value="2"><?php echo $Language->Phrase("Remove") ?></label>&nbsp;
<label><input type="radio" name="a_studentImage" id="a_studentImage" value="3"><?php echo $Language->Phrase("Replace") ?><br></label>
<?php $students->studentImage->EditAttrs["onchange"] = "this.form.a_studentImage[2].checked=true;" . @$students->studentImage->EditAttrs["onchange"]; ?>
<?php } else { ?>
<input type="hidden" name="a_studentImage" id="a_studentImage" value="3">
<?php } ?>
<input type="file" name="x_studentImage" id="x_studentImage" title="<?php echo $students->studentImage->FldTitle() ?>"<?php echo $students->studentImage->EditAttributes() ?>>
</div>
</span><?php echo $students->studentImage->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->feesCreditBalance->Visible) { // feesCreditBalance ?>
	<tr<?php echo $students->feesCreditBalance->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->feesCreditBalance->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $students->feesCreditBalance->CellAttributes() ?>><span id="el_feesCreditBalance">
<input type="text" name="x_feesCreditBalance" id="x_feesCreditBalance" title="<?php echo $students->feesCreditBalance->FldTitle() ?>" size="30" value="<?php echo $students->feesCreditBalance->EditValue ?>"<?php echo $students->feesCreditBalance->EditAttributes() ?>>
</span><?php echo $students->feesCreditBalance->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($students->status->Visible) { // status ?>
	<tr<?php echo $students->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $students->status->FldCaption() ?></td>
		<td<?php echo $students->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $students->status->FldTitle() ?>" value="{value}"<?php echo $students->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $students->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($students->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $students->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $students->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $students->status->CustomMsg ?></td>
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
$students_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudents_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'students';

	// Page object name
	var $PageObjName = 'students_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $students;
		if ($students->UseTokenInUrl) $PageUrl .= "t=" . $students->TableVar . "&"; // Add page token
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
		global $objForm, $students;
		if ($students->UseTokenInUrl) {
			if ($objForm)
				return ($students->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($students->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudents_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (students)
		$GLOBALS["students"] = new cstudents();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'students', TRUE);

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
		global $students;

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
		global $objForm, $Language, $gsFormError, $students;

		// Load key from QueryString
		if (@$_GET["studentID"] <> "")
			$students->studentID->setQueryStringValue($_GET["studentID"]);
		if (@$_POST["a_edit"] <> "") {
			$students->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->GetUploadFiles(); // Get upload files
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$students->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$students->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$students->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($students->studentID->CurrentValue == "")
			$this->Page_Terminate("studentslist.php"); // Invalid key, return to list
		switch ($students->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("studentslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$students->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $students->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$students->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$students->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $students;

		// Get upload data
			if ($students->studentImage->Upload->UploadFile()) {

				// No action required
			} else {
				echo $students->studentImage->Upload->Message;
				$this->Page_Terminate();
				exit();
			}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $students;
		$students->studentID->setFormValue($objForm->GetValue("x_studentID"));
		$students->admissionNumber->setFormValue($objForm->GetValue("x_admissionNumber"));
		$students->firstname->setFormValue($objForm->GetValue("x_firstname"));
		$students->middlename->setFormValue($objForm->GetValue("x_middlename"));
		$students->lastname->setFormValue($objForm->GetValue("x_lastname"));
		$students->gender->setFormValue($objForm->GetValue("x_gender"));
		$students->dob->setFormValue($objForm->GetValue("x_dob"));
		$students->dob->CurrentValue = ew_UnFormatDateTime($students->dob->CurrentValue, 5);
		$students->residentialAddress->setFormValue($objForm->GetValue("x_residentialAddress"));
		$students->residentState->setFormValue($objForm->GetValue("x_residentState"));
		$students->stateOfOrigin->setFormValue($objForm->GetValue("x_stateOfOrigin"));
		$students->currentClass->setFormValue($objForm->GetValue("x_currentClass"));
		$students->parentID->setFormValue($objForm->GetValue("x_parentID"));
		$students->feesCreditBalance->setFormValue($objForm->GetValue("x_feesCreditBalance"));
		$students->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $students;
		$this->LoadRow();
		$students->studentID->CurrentValue = $students->studentID->FormValue;
		$students->admissionNumber->CurrentValue = $students->admissionNumber->FormValue;
		$students->firstname->CurrentValue = $students->firstname->FormValue;
		$students->middlename->CurrentValue = $students->middlename->FormValue;
		$students->lastname->CurrentValue = $students->lastname->FormValue;
		$students->gender->CurrentValue = $students->gender->FormValue;
		$students->dob->CurrentValue = $students->dob->FormValue;
		$students->dob->CurrentValue = ew_UnFormatDateTime($students->dob->CurrentValue, 5);
		$students->residentialAddress->CurrentValue = $students->residentialAddress->FormValue;
		$students->residentState->CurrentValue = $students->residentState->FormValue;
		$students->stateOfOrigin->CurrentValue = $students->stateOfOrigin->FormValue;
		$students->currentClass->CurrentValue = $students->currentClass->FormValue;
		$students->parentID->CurrentValue = $students->parentID->FormValue;
		$students->feesCreditBalance->CurrentValue = $students->feesCreditBalance->FormValue;
		$students->status->CurrentValue = $students->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $students;
		$sFilter = $students->KeyFilter();

		// Call Row Selecting event
		$students->Row_Selecting($sFilter);

		// Load SQL based on filter
		$students->CurrentFilter = $sFilter;
		$sSql = $students->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$students->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $students;
		$students->studentID->setDbValue($rs->fields('studentID'));
		$students->admissionNumber->setDbValue($rs->fields('admissionNumber'));
		$students->firstname->setDbValue($rs->fields('firstname'));
		$students->middlename->setDbValue($rs->fields('middlename'));
		$students->lastname->setDbValue($rs->fields('lastname'));
		$students->gender->setDbValue($rs->fields('gender'));
		$students->dob->setDbValue($rs->fields('dob'));
		$students->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$students->residentState->setDbValue($rs->fields('residentState'));
		$students->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$students->currentClass->setDbValue($rs->fields('currentClass'));
		$students->portalUsername->setDbValue($rs->fields('portalUsername'));
		$students->portalPassword->setDbValue($rs->fields('portalPassword'));
		$students->parentID->setDbValue($rs->fields('parentID'));
		$students->studentImage->Upload->DbValue = $rs->fields('studentImage');
		$students->feesCreditBalance->setDbValue($rs->fields('feesCreditBalance'));
		$students->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $students;

		// Initialize URLs
		// Call Row_Rendering event

		$students->Row_Rendering();

		// Common render codes for all row types
		// studentID

		$students->studentID->CellCssStyle = ""; $students->studentID->CellCssClass = "";
		$students->studentID->CellAttrs = array(); $students->studentID->ViewAttrs = array(); $students->studentID->EditAttrs = array();

		// admissionNumber
		$students->admissionNumber->CellCssStyle = ""; $students->admissionNumber->CellCssClass = "";
		$students->admissionNumber->CellAttrs = array(); $students->admissionNumber->ViewAttrs = array(); $students->admissionNumber->EditAttrs = array();

		// firstname
		$students->firstname->CellCssStyle = ""; $students->firstname->CellCssClass = "";
		$students->firstname->CellAttrs = array(); $students->firstname->ViewAttrs = array(); $students->firstname->EditAttrs = array();

		// middlename
		$students->middlename->CellCssStyle = ""; $students->middlename->CellCssClass = "";
		$students->middlename->CellAttrs = array(); $students->middlename->ViewAttrs = array(); $students->middlename->EditAttrs = array();

		// lastname
		$students->lastname->CellCssStyle = ""; $students->lastname->CellCssClass = "";
		$students->lastname->CellAttrs = array(); $students->lastname->ViewAttrs = array(); $students->lastname->EditAttrs = array();

		// gender
		$students->gender->CellCssStyle = ""; $students->gender->CellCssClass = "";
		$students->gender->CellAttrs = array(); $students->gender->ViewAttrs = array(); $students->gender->EditAttrs = array();

		// dob
		$students->dob->CellCssStyle = ""; $students->dob->CellCssClass = "";
		$students->dob->CellAttrs = array(); $students->dob->ViewAttrs = array(); $students->dob->EditAttrs = array();

		// residentialAddress
		$students->residentialAddress->CellCssStyle = ""; $students->residentialAddress->CellCssClass = "";
		$students->residentialAddress->CellAttrs = array(); $students->residentialAddress->ViewAttrs = array(); $students->residentialAddress->EditAttrs = array();

		// residentState
		$students->residentState->CellCssStyle = ""; $students->residentState->CellCssClass = "";
		$students->residentState->CellAttrs = array(); $students->residentState->ViewAttrs = array(); $students->residentState->EditAttrs = array();

		// stateOfOrigin
		$students->stateOfOrigin->CellCssStyle = ""; $students->stateOfOrigin->CellCssClass = "";
		$students->stateOfOrigin->CellAttrs = array(); $students->stateOfOrigin->ViewAttrs = array(); $students->stateOfOrigin->EditAttrs = array();

		// currentClass
		$students->currentClass->CellCssStyle = ""; $students->currentClass->CellCssClass = "";
		$students->currentClass->CellAttrs = array(); $students->currentClass->ViewAttrs = array(); $students->currentClass->EditAttrs = array();

		// parentID
		$students->parentID->CellCssStyle = ""; $students->parentID->CellCssClass = "";
		$students->parentID->CellAttrs = array(); $students->parentID->ViewAttrs = array(); $students->parentID->EditAttrs = array();

		// studentImage
		$students->studentImage->CellCssStyle = ""; $students->studentImage->CellCssClass = "";
		$students->studentImage->CellAttrs = array(); $students->studentImage->ViewAttrs = array(); $students->studentImage->EditAttrs = array();

		// feesCreditBalance
		$students->feesCreditBalance->CellCssStyle = ""; $students->feesCreditBalance->CellCssClass = "";
		$students->feesCreditBalance->CellAttrs = array(); $students->feesCreditBalance->ViewAttrs = array(); $students->feesCreditBalance->EditAttrs = array();

		// status
		$students->status->CellCssStyle = ""; $students->status->CellCssClass = "";
		$students->status->CellAttrs = array(); $students->status->ViewAttrs = array(); $students->status->EditAttrs = array();
		if ($students->RowType == EW_ROWTYPE_VIEW) { // View row

			// studentID
			$students->studentID->ViewValue = $students->studentID->CurrentValue;
			$students->studentID->CssStyle = "";
			$students->studentID->CssClass = "";
			$students->studentID->ViewCustomAttributes = "";

			// admissionNumber
			$students->admissionNumber->ViewValue = $students->admissionNumber->CurrentValue;
			$students->admissionNumber->CssStyle = "";
			$students->admissionNumber->CssClass = "";
			$students->admissionNumber->ViewCustomAttributes = "";

			// firstname
			$students->firstname->ViewValue = $students->firstname->CurrentValue;
			$students->firstname->CssStyle = "";
			$students->firstname->CssClass = "";
			$students->firstname->ViewCustomAttributes = "";

			// middlename
			$students->middlename->ViewValue = $students->middlename->CurrentValue;
			$students->middlename->CssStyle = "";
			$students->middlename->CssClass = "";
			$students->middlename->ViewCustomAttributes = "";

			// lastname
			$students->lastname->ViewValue = $students->lastname->CurrentValue;
			$students->lastname->CssStyle = "";
			$students->lastname->CssClass = "";
			$students->lastname->ViewCustomAttributes = "";

			// gender
			if (strval($students->gender->CurrentValue) <> "") {
				switch ($students->gender->CurrentValue) {
					case "Male":
						$students->gender->ViewValue = "Male";
						break;
					case "Female":
						$students->gender->ViewValue = "Female";
						break;
					default:
						$students->gender->ViewValue = $students->gender->CurrentValue;
				}
			} else {
				$students->gender->ViewValue = NULL;
			}
			$students->gender->CssStyle = "";
			$students->gender->CssClass = "";
			$students->gender->ViewCustomAttributes = "";

			// dob
			$students->dob->ViewValue = $students->dob->CurrentValue;
			$students->dob->ViewValue = ew_FormatDateTime($students->dob->ViewValue, 5);
			$students->dob->CssStyle = "";
			$students->dob->CssClass = "";
			$students->dob->ViewCustomAttributes = "";

			// residentialAddress
			$students->residentialAddress->ViewValue = $students->residentialAddress->CurrentValue;
			$students->residentialAddress->CssStyle = "";
			$students->residentialAddress->CssClass = "";
			$students->residentialAddress->ViewCustomAttributes = "";

			// residentState
			$students->residentState->ViewValue = $students->residentState->CurrentValue;
			$students->residentState->CssStyle = "";
			$students->residentState->CssClass = "";
			$students->residentState->ViewCustomAttributes = "";

			// stateOfOrigin
			$students->stateOfOrigin->ViewValue = $students->stateOfOrigin->CurrentValue;
			$students->stateOfOrigin->CssStyle = "";
			$students->stateOfOrigin->CssClass = "";
			$students->stateOfOrigin->ViewCustomAttributes = "";

			// currentClass
			if (strval($students->currentClass->CurrentValue) <> "") {
				$sFilterWrk = "`classID` = " . ew_AdjustSql($students->currentClass->CurrentValue) . "";
			$sSqlWrk = "SELECT `className`, `classTeacher` FROM `class_rooms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$students->currentClass->ViewValue = $rswrk->fields('className');
					$students->currentClass->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('classTeacher');
					$rswrk->Close();
				} else {
					$students->currentClass->ViewValue = $students->currentClass->CurrentValue;
				}
			} else {
				$students->currentClass->ViewValue = NULL;
			}
			$students->currentClass->CssStyle = "";
			$students->currentClass->CssClass = "";
			$students->currentClass->ViewCustomAttributes = "";

			// parentID
			if (strval($students->parentID->CurrentValue) <> "") {
				$sFilterWrk = "`parentID` = " . ew_AdjustSql($students->parentID->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `parents`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$students->parentID->ViewValue = $rswrk->fields('firstname');
					$students->parentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$students->parentID->ViewValue = $students->parentID->CurrentValue;
				}
			} else {
				$students->parentID->ViewValue = NULL;
			}
			$students->parentID->CssStyle = "";
			$students->parentID->CssClass = "";
			$students->parentID->ViewCustomAttributes = "";

			// studentImage
			if (!ew_Empty($students->studentImage->Upload->DbValue)) {
				$students->studentImage->ViewValue = $students->studentImage->Upload->DbValue;
				$students->studentImage->ImageAlt = $students->studentImage->FldAlt();
			} else {
				$students->studentImage->ViewValue = "";
			}
			$students->studentImage->CssStyle = "";
			$students->studentImage->CssClass = "";
			$students->studentImage->ViewCustomAttributes = "";

			// feesCreditBalance
			$students->feesCreditBalance->ViewValue = $students->feesCreditBalance->CurrentValue;
			$students->feesCreditBalance->CssStyle = "";
			$students->feesCreditBalance->CssClass = "";
			$students->feesCreditBalance->ViewCustomAttributes = "";

			// status
			if (strval($students->status->CurrentValue) <> "") {
				switch ($students->status->CurrentValue) {
					case "1":
						$students->status->ViewValue = "Enabled";
						break;
					case "0":
						$students->status->ViewValue = "Disabled";
						break;
					default:
						$students->status->ViewValue = $students->status->CurrentValue;
				}
			} else {
				$students->status->ViewValue = NULL;
			}
			$students->status->CssStyle = "";
			$students->status->CssClass = "";
			$students->status->ViewCustomAttributes = "";

			// studentID
			$students->studentID->HrefValue = "";
			$students->studentID->TooltipValue = "";

			// admissionNumber
			$students->admissionNumber->HrefValue = "";
			$students->admissionNumber->TooltipValue = "";

			// firstname
			$students->firstname->HrefValue = "";
			$students->firstname->TooltipValue = "";

			// middlename
			$students->middlename->HrefValue = "";
			$students->middlename->TooltipValue = "";

			// lastname
			$students->lastname->HrefValue = "";
			$students->lastname->TooltipValue = "";

			// gender
			$students->gender->HrefValue = "";
			$students->gender->TooltipValue = "";

			// dob
			$students->dob->HrefValue = "";
			$students->dob->TooltipValue = "";

			// residentialAddress
			$students->residentialAddress->HrefValue = "";
			$students->residentialAddress->TooltipValue = "";

			// residentState
			$students->residentState->HrefValue = "";
			$students->residentState->TooltipValue = "";

			// stateOfOrigin
			$students->stateOfOrigin->HrefValue = "";
			$students->stateOfOrigin->TooltipValue = "";

			// currentClass
			$students->currentClass->HrefValue = "";
			$students->currentClass->TooltipValue = "";

			// parentID
			$students->parentID->HrefValue = "";
			$students->parentID->TooltipValue = "";

			// studentImage
			$students->studentImage->HrefValue = "";
			$students->studentImage->TooltipValue = "";

			// feesCreditBalance
			$students->feesCreditBalance->HrefValue = "";
			$students->feesCreditBalance->TooltipValue = "";

			// status
			$students->status->HrefValue = "";
			$students->status->TooltipValue = "";
		} elseif ($students->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// studentID
			$students->studentID->EditCustomAttributes = "";
			$students->studentID->EditValue = $students->studentID->CurrentValue;
			$students->studentID->CssStyle = "";
			$students->studentID->CssClass = "";
			$students->studentID->ViewCustomAttributes = "";

			// admissionNumber
			$students->admissionNumber->EditCustomAttributes = "";
			$students->admissionNumber->EditValue = ew_HtmlEncode($students->admissionNumber->CurrentValue);

			// firstname
			$students->firstname->EditCustomAttributes = "";
			$students->firstname->EditValue = ew_HtmlEncode($students->firstname->CurrentValue);

			// middlename
			$students->middlename->EditCustomAttributes = "";
			$students->middlename->EditValue = ew_HtmlEncode($students->middlename->CurrentValue);

			// lastname
			$students->lastname->EditCustomAttributes = "";
			$students->lastname->EditValue = ew_HtmlEncode($students->lastname->CurrentValue);

			// gender
			$students->gender->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Male", "Male");
			$arwrk[] = array("Female", "Female");
			$students->gender->EditValue = $arwrk;

			// dob
			$students->dob->EditCustomAttributes = "";
			$students->dob->EditValue = ew_HtmlEncode(ew_FormatDateTime($students->dob->CurrentValue, 5));

			// residentialAddress
			$students->residentialAddress->EditCustomAttributes = "";
			$students->residentialAddress->EditValue = ew_HtmlEncode($students->residentialAddress->CurrentValue);

			// residentState
			$students->residentState->EditCustomAttributes = "";
			$students->residentState->EditValue = ew_HtmlEncode($students->residentState->CurrentValue);

			// stateOfOrigin
			$students->stateOfOrigin->EditCustomAttributes = "";
			$students->stateOfOrigin->EditValue = ew_HtmlEncode($students->stateOfOrigin->CurrentValue);

			// currentClass
			$students->currentClass->EditCustomAttributes = "";
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
			$students->currentClass->EditValue = $arwrk;

			// parentID
			$students->parentID->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `parentID`, `firstname`, `lastname`, '' AS SelectFilterFld FROM `parents`";
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
			$students->parentID->EditValue = $arwrk;

			// studentImage
			$students->studentImage->EditCustomAttributes = "";
			if (!ew_Empty($students->studentImage->Upload->DbValue)) {
				$students->studentImage->EditValue = $students->studentImage->Upload->DbValue;
				$students->studentImage->ImageAlt = $students->studentImage->FldAlt();
			} else {
				$students->studentImage->EditValue = "";
			}

			// feesCreditBalance
			$students->feesCreditBalance->EditCustomAttributes = "";
			$students->feesCreditBalance->EditValue = ew_HtmlEncode($students->feesCreditBalance->CurrentValue);

			// status
			$students->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$students->status->EditValue = $arwrk;

			// Edit refer script
			// studentID

			$students->studentID->HrefValue = "";

			// admissionNumber
			$students->admissionNumber->HrefValue = "";

			// firstname
			$students->firstname->HrefValue = "";

			// middlename
			$students->middlename->HrefValue = "";

			// lastname
			$students->lastname->HrefValue = "";

			// gender
			$students->gender->HrefValue = "";

			// dob
			$students->dob->HrefValue = "";

			// residentialAddress
			$students->residentialAddress->HrefValue = "";

			// residentState
			$students->residentState->HrefValue = "";

			// stateOfOrigin
			$students->stateOfOrigin->HrefValue = "";

			// currentClass
			$students->currentClass->HrefValue = "";

			// parentID
			$students->parentID->HrefValue = "";

			// studentImage
			$students->studentImage->HrefValue = "";

			// feesCreditBalance
			$students->feesCreditBalance->HrefValue = "";

			// status
			$students->status->HrefValue = "";
		}

		// Call Row Rendered event
		if ($students->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$students->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $students;

		// Initialize form error message
		$gsFormError = "";
		if (!ew_CheckFileType($students->studentImage->Upload->FileName)) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("WrongFileType");
		}
		if ($students->studentImage->Upload->FileSize > 0 && EW_MAX_FILE_SIZE > 0 && $students->studentImage->Upload->FileSize > EW_MAX_FILE_SIZE) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= str_replace("%s", EW_MAX_FILE_SIZE, $Language->Phrase("MaxFileSize"));
		}
		if (in_array($students->studentImage->Upload->Error, array(1, 2, 3, 6, 7, 8))) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("PhpUploadErr" . $students->studentImage->Upload->Error);
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($students->admissionNumber->FormValue) && $students->admissionNumber->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->admissionNumber->FldCaption();
		}
		if (!is_null($students->firstname->FormValue) && $students->firstname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->firstname->FldCaption();
		}
		if (!is_null($students->lastname->FormValue) && $students->lastname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->lastname->FldCaption();
		}
		if ($students->gender->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->gender->FldCaption();
		}
		if (!is_null($students->dob->FormValue) && $students->dob->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->dob->FldCaption();
		}
		if (!ew_CheckDate($students->dob->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $students->dob->FldErrMsg();
		}
		if (!is_null($students->residentialAddress->FormValue) && $students->residentialAddress->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->residentialAddress->FldCaption();
		}
		if (!is_null($students->residentState->FormValue) && $students->residentState->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->residentState->FldCaption();
		}
		if (!is_null($students->stateOfOrigin->FormValue) && $students->stateOfOrigin->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->stateOfOrigin->FldCaption();
		}
		if (!is_null($students->currentClass->FormValue) && $students->currentClass->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->currentClass->FldCaption();
		}
		if (!is_null($students->parentID->FormValue) && $students->parentID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->parentID->FldCaption();
		}
		if (!is_null($students->feesCreditBalance->FormValue) && $students->feesCreditBalance->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $students->feesCreditBalance->FldCaption();
		}
		if (!ew_CheckNumber($students->feesCreditBalance->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $students->feesCreditBalance->FldErrMsg();
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
		global $conn, $Security, $Language, $students;
		$sFilter = $students->KeyFilter();
			if ($students->portalUsername->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`portalUsername` = '" . ew_AdjustSql($students->portalUsername->CurrentValue) . "')";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$students->CurrentFilter = $sFilterChk;
			$sSqlChk = $students->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'portalUsername', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $students->portalUsername->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$students->CurrentFilter = $sFilter;
		$sSql = $students->SQL();
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

			// admissionNumber
			$students->admissionNumber->SetDbValueDef($rsnew, $students->admissionNumber->CurrentValue, NULL, FALSE);

			// firstname
			$students->firstname->SetDbValueDef($rsnew, $students->firstname->CurrentValue, NULL, FALSE);

			// middlename
			$students->middlename->SetDbValueDef($rsnew, $students->middlename->CurrentValue, NULL, FALSE);

			// lastname
			$students->lastname->SetDbValueDef($rsnew, $students->lastname->CurrentValue, NULL, FALSE);

			// gender
			$students->gender->SetDbValueDef($rsnew, $students->gender->CurrentValue, NULL, FALSE);

			// dob
			$students->dob->SetDbValueDef($rsnew, ew_UnFormatDateTime($students->dob->CurrentValue, 5, FALSE), NULL);

			// residentialAddress
			$students->residentialAddress->SetDbValueDef($rsnew, $students->residentialAddress->CurrentValue, NULL, FALSE);

			// residentState
			$students->residentState->SetDbValueDef($rsnew, $students->residentState->CurrentValue, NULL, FALSE);

			// stateOfOrigin
			$students->stateOfOrigin->SetDbValueDef($rsnew, $students->stateOfOrigin->CurrentValue, NULL, FALSE);

			// currentClass
			$students->currentClass->SetDbValueDef($rsnew, $students->currentClass->CurrentValue, NULL, FALSE);

			// parentID
			$students->parentID->SetDbValueDef($rsnew, $students->parentID->CurrentValue, NULL, FALSE);

			// studentImage
			$students->studentImage->Upload->SaveToSession(); // Save file value to Session
						if ($students->studentImage->Upload->Action == "2" || $students->studentImage->Upload->Action == "3") { // Update/Remove
			$students->studentImage->Upload->DbValue = $rs->fields('studentImage'); // Get original value
			if (is_null($students->studentImage->Upload->Value)) {
				$rsnew['studentImage'] = NULL;
			} else {
				$rsnew['studentImage'] = ew_UploadFileNameEx(ew_UploadPathEx(TRUE, $students->studentImage->UploadPath), $students->studentImage->Upload->FileName);
			}
			}

			// feesCreditBalance
			$students->feesCreditBalance->SetDbValueDef($rsnew, $students->feesCreditBalance->CurrentValue, NULL, FALSE);

			// status
			$students->status->SetDbValueDef($rsnew, $students->status->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $students->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
			if (!ew_Empty($students->studentImage->Upload->Value)) {
				$students->studentImage->Upload->SaveToFile($students->studentImage->UploadPath, $rsnew['studentImage'], FALSE);
			}
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($students->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($students->CancelMessage <> "") {
					$this->setMessage($students->CancelMessage);
					$students->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$students->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// studentImage
		$students->studentImage->Upload->RemoveFromSession(); // Remove file value from Session
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
