<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "class_levelsinfo.php" ?>
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
$class_levels_add = new cclass_levels_add();
$Page =& $class_levels_add;

// Page init
$class_levels_add->Page_Init();

// Page main
$class_levels_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var class_levels_add = new ew_Page("class_levels_add");

// page properties
class_levels_add.PageID = "add"; // page ID
class_levels_add.FormID = "fclass_levelsadd"; // form ID
var EW_PAGE_ID = class_levels_add.PageID; // for backward compatibility

// extend page with ValidateForm function
class_levels_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_classLevel"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($class_levels->classLevel->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_classOrder"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($class_levels->classOrder->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_classOrder"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($class_levels->classOrder->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_schoolFees"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($class_levels->schoolFees->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_schoolFees"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($class_levels->schoolFees->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($class_levels->status->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
class_levels_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
class_levels_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
class_levels_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
class_levels_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $class_levels->TableCaption() ?><br><br>
<a href="<?php echo $class_levels->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$class_levels_add->ShowMessage();
?>
<form name="fclass_levelsadd" id="fclass_levelsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return class_levels_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="class_levels">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($class_levels->classLevel->Visible) { // classLevel ?>
	<tr<?php echo $class_levels->classLevel->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_levels->classLevel->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $class_levels->classLevel->CellAttributes() ?>><span id="el_classLevel">
<input type="text" name="x_classLevel" id="x_classLevel" title="<?php echo $class_levels->classLevel->FldTitle() ?>" size="30" maxlength="30" value="<?php echo $class_levels->classLevel->EditValue ?>"<?php echo $class_levels->classLevel->EditAttributes() ?>>
</span><?php echo $class_levels->classLevel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($class_levels->classOrder->Visible) { // classOrder ?>
	<tr<?php echo $class_levels->classOrder->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_levels->classOrder->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $class_levels->classOrder->CellAttributes() ?>><span id="el_classOrder">
<input type="text" name="x_classOrder" id="x_classOrder" title="<?php echo $class_levels->classOrder->FldTitle() ?>" size="30" value="<?php echo $class_levels->classOrder->EditValue ?>"<?php echo $class_levels->classOrder->EditAttributes() ?>>
</span><?php echo $class_levels->classOrder->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($class_levels->schoolFees->Visible) { // schoolFees ?>
	<tr<?php echo $class_levels->schoolFees->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_levels->schoolFees->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $class_levels->schoolFees->CellAttributes() ?>><span id="el_schoolFees">
<input type="text" name="x_schoolFees" id="x_schoolFees" title="<?php echo $class_levels->schoolFees->FldTitle() ?>" size="30" value="<?php echo $class_levels->schoolFees->EditValue ?>"<?php echo $class_levels->schoolFees->EditAttributes() ?>>
</span><?php echo $class_levels->schoolFees->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($class_levels->status->Visible) { // status ?>
	<tr<?php echo $class_levels->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $class_levels->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $class_levels->status->CellAttributes() ?>><span id="el_status">
<div id="tp_x_status" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_status" id="x_status" title="<?php echo $class_levels->status->FldTitle() ?>" value="{value}"<?php echo $class_levels->status->EditAttributes() ?>></label></div>
<div id="dsl_x_status" repeatcolumn="5">
<?php
$arwrk = $class_levels->status->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($class_levels->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_status" id="x_status" title="<?php echo $class_levels->status->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $class_levels->status->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $class_levels->status->CustomMsg ?></td>
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
$class_levels_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cclass_levels_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'class_levels';

	// Page object name
	var $PageObjName = 'class_levels_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $class_levels;
		if ($class_levels->UseTokenInUrl) $PageUrl .= "t=" . $class_levels->TableVar . "&"; // Add page token
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
		global $objForm, $class_levels;
		if ($class_levels->UseTokenInUrl) {
			if ($objForm)
				return ($class_levels->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($class_levels->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclass_levels_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (class_levels)
		$GLOBALS["class_levels"] = new cclass_levels();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'class_levels', TRUE);

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
		global $class_levels;

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
		global $objForm, $Language, $gsFormError, $class_levels;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["classLevelID"] != "") {
		  $class_levels->classLevelID->setQueryStringValue($_GET["classLevelID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $class_levels->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$class_levels->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $class_levels->CurrentAction = "C"; // Copy record
		  } else {
		    $class_levels->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($class_levels->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("class_levelslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$class_levels->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $class_levels->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$class_levels->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $class_levels;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $class_levels;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $class_levels;
		$class_levels->classLevel->setFormValue($objForm->GetValue("x_classLevel"));
		$class_levels->classOrder->setFormValue($objForm->GetValue("x_classOrder"));
		$class_levels->schoolFees->setFormValue($objForm->GetValue("x_schoolFees"));
		$class_levels->status->setFormValue($objForm->GetValue("x_status"));
		$class_levels->classLevelID->setFormValue($objForm->GetValue("x_classLevelID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $class_levels;
		$class_levels->classLevelID->CurrentValue = $class_levels->classLevelID->FormValue;
		$class_levels->classLevel->CurrentValue = $class_levels->classLevel->FormValue;
		$class_levels->classOrder->CurrentValue = $class_levels->classOrder->FormValue;
		$class_levels->schoolFees->CurrentValue = $class_levels->schoolFees->FormValue;
		$class_levels->status->CurrentValue = $class_levels->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $class_levels;
		$sFilter = $class_levels->KeyFilter();

		// Call Row Selecting event
		$class_levels->Row_Selecting($sFilter);

		// Load SQL based on filter
		$class_levels->CurrentFilter = $sFilter;
		$sSql = $class_levels->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$class_levels->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $class_levels;
		$class_levels->classLevelID->setDbValue($rs->fields('classLevelID'));
		$class_levels->classLevel->setDbValue($rs->fields('classLevel'));
		$class_levels->classOrder->setDbValue($rs->fields('classOrder'));
		$class_levels->schoolFees->setDbValue($rs->fields('schoolFees'));
		$class_levels->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $class_levels;

		// Initialize URLs
		// Call Row_Rendering event

		$class_levels->Row_Rendering();

		// Common render codes for all row types
		// classLevel

		$class_levels->classLevel->CellCssStyle = ""; $class_levels->classLevel->CellCssClass = "";
		$class_levels->classLevel->CellAttrs = array(); $class_levels->classLevel->ViewAttrs = array(); $class_levels->classLevel->EditAttrs = array();

		// classOrder
		$class_levels->classOrder->CellCssStyle = ""; $class_levels->classOrder->CellCssClass = "";
		$class_levels->classOrder->CellAttrs = array(); $class_levels->classOrder->ViewAttrs = array(); $class_levels->classOrder->EditAttrs = array();

		// schoolFees
		$class_levels->schoolFees->CellCssStyle = ""; $class_levels->schoolFees->CellCssClass = "";
		$class_levels->schoolFees->CellAttrs = array(); $class_levels->schoolFees->ViewAttrs = array(); $class_levels->schoolFees->EditAttrs = array();

		// status
		$class_levels->status->CellCssStyle = ""; $class_levels->status->CellCssClass = "";
		$class_levels->status->CellAttrs = array(); $class_levels->status->ViewAttrs = array(); $class_levels->status->EditAttrs = array();
		if ($class_levels->RowType == EW_ROWTYPE_VIEW) { // View row

			// classLevelID
			$class_levels->classLevelID->ViewValue = $class_levels->classLevelID->CurrentValue;
			$class_levels->classLevelID->CssStyle = "";
			$class_levels->classLevelID->CssClass = "";
			$class_levels->classLevelID->ViewCustomAttributes = "";

			// classLevel
			$class_levels->classLevel->ViewValue = $class_levels->classLevel->CurrentValue;
			$class_levels->classLevel->CssStyle = "";
			$class_levels->classLevel->CssClass = "";
			$class_levels->classLevel->ViewCustomAttributes = "";

			// classOrder
			$class_levels->classOrder->ViewValue = $class_levels->classOrder->CurrentValue;
			$class_levels->classOrder->CssStyle = "";
			$class_levels->classOrder->CssClass = "";
			$class_levels->classOrder->ViewCustomAttributes = "";

			// schoolFees
			$class_levels->schoolFees->ViewValue = $class_levels->schoolFees->CurrentValue;
			$class_levels->schoolFees->CssStyle = "";
			$class_levels->schoolFees->CssClass = "";
			$class_levels->schoolFees->ViewCustomAttributes = "";

			// status
			if (strval($class_levels->status->CurrentValue) <> "") {
				switch ($class_levels->status->CurrentValue) {
					case "1":
						$class_levels->status->ViewValue = "Enabled";
						break;
					case "0":
						$class_levels->status->ViewValue = "Disabled";
						break;
					default:
						$class_levels->status->ViewValue = $class_levels->status->CurrentValue;
				}
			} else {
				$class_levels->status->ViewValue = NULL;
			}
			$class_levels->status->CssStyle = "";
			$class_levels->status->CssClass = "";
			$class_levels->status->ViewCustomAttributes = "";

			// classLevel
			$class_levels->classLevel->HrefValue = "";
			$class_levels->classLevel->TooltipValue = "";

			// classOrder
			$class_levels->classOrder->HrefValue = "";
			$class_levels->classOrder->TooltipValue = "";

			// schoolFees
			$class_levels->schoolFees->HrefValue = "";
			$class_levels->schoolFees->TooltipValue = "";

			// status
			$class_levels->status->HrefValue = "";
			$class_levels->status->TooltipValue = "";
		} elseif ($class_levels->RowType == EW_ROWTYPE_ADD) { // Add row

			// classLevel
			$class_levels->classLevel->EditCustomAttributes = "";
			$class_levels->classLevel->EditValue = ew_HtmlEncode($class_levels->classLevel->CurrentValue);

			// classOrder
			$class_levels->classOrder->EditCustomAttributes = "";
			$class_levels->classOrder->EditValue = ew_HtmlEncode($class_levels->classOrder->CurrentValue);

			// schoolFees
			$class_levels->schoolFees->EditCustomAttributes = "";
			$class_levels->schoolFees->EditValue = ew_HtmlEncode($class_levels->schoolFees->CurrentValue);

			// status
			$class_levels->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Enabled");
			$arwrk[] = array("0", "Disabled");
			$class_levels->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($class_levels->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$class_levels->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $class_levels;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($class_levels->classLevel->FormValue) && $class_levels->classLevel->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $class_levels->classLevel->FldCaption();
		}
		if (!is_null($class_levels->classOrder->FormValue) && $class_levels->classOrder->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $class_levels->classOrder->FldCaption();
		}
		if (!ew_CheckInteger($class_levels->classOrder->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $class_levels->classOrder->FldErrMsg();
		}
		if (!is_null($class_levels->schoolFees->FormValue) && $class_levels->schoolFees->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $class_levels->schoolFees->FldCaption();
		}
		if (!ew_CheckNumber($class_levels->schoolFees->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $class_levels->schoolFees->FldErrMsg();
		}
		if ($class_levels->status->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $class_levels->status->FldCaption();
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
		global $conn, $Language, $Security, $class_levels;
		if ($class_levels->classLevel->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(classLevel = '" . ew_AdjustSql($class_levels->classLevel->CurrentValue) . "')";
			$rsChk = $class_levels->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'classLevel', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $class_levels->classLevel->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		if ($class_levels->classOrder->CurrentValue <> "") { // Check field with unique index
			$sFilter = "(classOrder = " . ew_AdjustSql($class_levels->classOrder->CurrentValue) . ")";
			$rsChk = $class_levels->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'classOrder', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $class_levels->classOrder->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// classLevel
		$class_levels->classLevel->SetDbValueDef($rsnew, $class_levels->classLevel->CurrentValue, NULL, FALSE);

		// classOrder
		$class_levels->classOrder->SetDbValueDef($rsnew, $class_levels->classOrder->CurrentValue, NULL, FALSE);

		// schoolFees
		$class_levels->schoolFees->SetDbValueDef($rsnew, $class_levels->schoolFees->CurrentValue, NULL, FALSE);

		// status
		$class_levels->status->SetDbValueDef($rsnew, $class_levels->status->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $class_levels->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($class_levels->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($class_levels->CancelMessage <> "") {
				$this->setMessage($class_levels->CancelMessage);
				$class_levels->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$class_levels->classLevelID->setDbValue($conn->Insert_ID());
			$rsnew['classLevelID'] = $class_levels->classLevelID->DbValue;

			// Call Row Inserted event
			$class_levels->Row_Inserted($rsnew);
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
