<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "term_result_approvalinfo.php" ?>
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
$term_result_approval_edit = new cterm_result_approval_edit();
$Page =& $term_result_approval_edit;

// Page init
$term_result_approval_edit->Page_Init();

// Page main
$term_result_approval_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var term_result_approval_edit = new ew_Page("term_result_approval_edit");

// page properties
term_result_approval_edit.PageID = "edit"; // page ID
term_result_approval_edit.FormID = "fterm_result_approvaledit"; // form ID
var EW_PAGE_ID = term_result_approval_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
term_result_approval_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_sessionTermID"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($term_result_approval->sessionTermID->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_sessionTermID"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($term_result_approval->sessionTermID->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
term_result_approval_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
term_result_approval_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
term_result_approval_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
term_result_approval_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $term_result_approval->TableCaption() ?><br><br>
<a href="<?php echo $term_result_approval->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$term_result_approval_edit->ShowMessage();
?>
<form name="fterm_result_approvaledit" id="fterm_result_approvaledit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return term_result_approval_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="term_result_approval">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($term_result_approval->approvalID->Visible) { // approvalID ?>
	<tr<?php echo $term_result_approval->approvalID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $term_result_approval->approvalID->FldCaption() ?></td>
		<td<?php echo $term_result_approval->approvalID->CellAttributes() ?>><span id="el_approvalID">
<div<?php echo $term_result_approval->approvalID->ViewAttributes() ?>><?php echo $term_result_approval->approvalID->EditValue ?></div><input type="hidden" name="x_approvalID" id="x_approvalID" value="<?php echo ew_HtmlEncode($term_result_approval->approvalID->CurrentValue) ?>">
</span><?php echo $term_result_approval->approvalID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($term_result_approval->sessionTermID->Visible) { // sessionTermID ?>
	<tr<?php echo $term_result_approval->sessionTermID->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $term_result_approval->sessionTermID->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $term_result_approval->sessionTermID->CellAttributes() ?>><span id="el_sessionTermID">
<div id="as_x_sessionTermID" style="z-index: 8980">
	<input type="text" name="sv_x_sessionTermID" id="sv_x_sessionTermID" value="<?php echo $term_result_approval->sessionTermID->EditValue ?>" title="<?php echo $term_result_approval->sessionTermID->FldTitle() ?>" size="30"<?php echo $term_result_approval->sessionTermID->EditAttributes() ?>>&nbsp;<span id="em_x_sessionTermID" class="ewMessage" style="display: none"><?php echo $Language->Phrase("UnmatchedValue") ?></span>
	<div id="sc_x_sessionTermID"></div>
</div>
<input type="hidden" name="x_sessionTermID" id="x_sessionTermID" value="<?php echo $term_result_approval->sessionTermID->CurrentValue ?>">
<?php
$sSqlWrk = "SELECT `sessionTermID`, `termID` FROM `session_terms`";
$sWhereWrk = "`termID` = {query_value}";
if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
	$sSqlWrk = TEAencrypt($sSqlWrk, EW_RANDOM_KEY);
?>
<input type="hidden" name="s_x_sessionTermID" id="s_x_sessionTermID" value="<?php echo $sSqlWrk ?>">
<script type="text/javascript">
<!--
var oas_x_sessionTermID = new ew_AutoSuggest("sv_x_sessionTermID", "sc_x_sessionTermID", "s_x_sessionTermID", "em_x_sessionTermID", "x_sessionTermID", "", false);
oas_x_sessionTermID.formatResult = function(ar) {	
	var df1 = ar[1];
	return df1;
};
oas_x_sessionTermID.ac.typeAhead = false;

//-->
</script>
</span><?php echo $term_result_approval->sessionTermID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($term_result_approval->status->Visible) { // status ?>
	<tr<?php echo $term_result_approval->status->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $term_result_approval->status->FldCaption() ?></td>
		<td<?php echo $term_result_approval->status->CellAttributes() ?>><span id="el_status">
<select id="x_status" name="x_status" title="<?php echo $term_result_approval->status->FldTitle() ?>"<?php echo $term_result_approval->status->EditAttributes() ?>>
<?php
if (is_array($term_result_approval->status->EditValue)) {
	$arwrk = $term_result_approval->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($term_result_approval->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $term_result_approval->status->CustomMsg ?></td>
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
$term_result_approval_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cterm_result_approval_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'term_result_approval';

	// Page object name
	var $PageObjName = 'term_result_approval_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $term_result_approval;
		if ($term_result_approval->UseTokenInUrl) $PageUrl .= "t=" . $term_result_approval->TableVar . "&"; // Add page token
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
		global $objForm, $term_result_approval;
		if ($term_result_approval->UseTokenInUrl) {
			if ($objForm)
				return ($term_result_approval->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($term_result_approval->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cterm_result_approval_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (term_result_approval)
		$GLOBALS["term_result_approval"] = new cterm_result_approval();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'term_result_approval', TRUE);

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
		global $term_result_approval;

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
		global $objForm, $Language, $gsFormError, $term_result_approval;

		// Load key from QueryString
		if (@$_GET["approvalID"] <> "")
			$term_result_approval->approvalID->setQueryStringValue($_GET["approvalID"]);
		if (@$_POST["a_edit"] <> "") {
			$term_result_approval->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$term_result_approval->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$term_result_approval->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$term_result_approval->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($term_result_approval->approvalID->CurrentValue == "")
			$this->Page_Terminate("term_result_approvallist.php"); // Invalid key, return to list
		switch ($term_result_approval->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("term_result_approvallist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$term_result_approval->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $term_result_approval->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$term_result_approval->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$term_result_approval->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $term_result_approval;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $term_result_approval;
		$term_result_approval->approvalID->setFormValue($objForm->GetValue("x_approvalID"));
		$term_result_approval->sessionTermID->setFormValue($objForm->GetValue("x_sessionTermID"));
		$term_result_approval->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $term_result_approval;
		$this->LoadRow();
		$term_result_approval->approvalID->CurrentValue = $term_result_approval->approvalID->FormValue;
		$term_result_approval->sessionTermID->CurrentValue = $term_result_approval->sessionTermID->FormValue;
		$term_result_approval->status->CurrentValue = $term_result_approval->status->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $term_result_approval;
		$sFilter = $term_result_approval->KeyFilter();

		// Call Row Selecting event
		$term_result_approval->Row_Selecting($sFilter);

		// Load SQL based on filter
		$term_result_approval->CurrentFilter = $sFilter;
		$sSql = $term_result_approval->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$term_result_approval->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $term_result_approval;
		$term_result_approval->approvalID->setDbValue($rs->fields('approvalID'));
		$term_result_approval->sessionTermID->setDbValue($rs->fields('sessionTermID'));
		$term_result_approval->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $term_result_approval;

		// Initialize URLs
		// Call Row_Rendering event

		$term_result_approval->Row_Rendering();

		// Common render codes for all row types
		// approvalID

		$term_result_approval->approvalID->CellCssStyle = ""; $term_result_approval->approvalID->CellCssClass = "";
		$term_result_approval->approvalID->CellAttrs = array(); $term_result_approval->approvalID->ViewAttrs = array(); $term_result_approval->approvalID->EditAttrs = array();

		// sessionTermID
		$term_result_approval->sessionTermID->CellCssStyle = ""; $term_result_approval->sessionTermID->CellCssClass = "";
		$term_result_approval->sessionTermID->CellAttrs = array(); $term_result_approval->sessionTermID->ViewAttrs = array(); $term_result_approval->sessionTermID->EditAttrs = array();

		// status
		$term_result_approval->status->CellCssStyle = ""; $term_result_approval->status->CellCssClass = "";
		$term_result_approval->status->CellAttrs = array(); $term_result_approval->status->ViewAttrs = array(); $term_result_approval->status->EditAttrs = array();
		if ($term_result_approval->RowType == EW_ROWTYPE_VIEW) { // View row

			// approvalID
			$term_result_approval->approvalID->ViewValue = $term_result_approval->approvalID->CurrentValue;
			$term_result_approval->approvalID->CssStyle = "";
			$term_result_approval->approvalID->CssClass = "";
			$term_result_approval->approvalID->ViewCustomAttributes = "";

			// sessionTermID
			$term_result_approval->sessionTermID->ViewValue = $term_result_approval->sessionTermID->CurrentValue;
			if (strval($term_result_approval->sessionTermID->CurrentValue) <> "") {
				$sFilterWrk = "`sessionTermID` = " . ew_AdjustSql($term_result_approval->sessionTermID->CurrentValue) . "";
			$sSqlWrk = "SELECT `termID` FROM `session_terms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$term_result_approval->sessionTermID->ViewValue = $rswrk->fields('termID');
					$rswrk->Close();
				} else {
					$term_result_approval->sessionTermID->ViewValue = $term_result_approval->sessionTermID->CurrentValue;
				}
			} else {
				$term_result_approval->sessionTermID->ViewValue = NULL;
			}
			$term_result_approval->sessionTermID->CssStyle = "";
			$term_result_approval->sessionTermID->CssClass = "";
			$term_result_approval->sessionTermID->ViewCustomAttributes = "";

			// status
			if (strval($term_result_approval->status->CurrentValue) <> "") {
				switch ($term_result_approval->status->CurrentValue) {
					case "1":
						$term_result_approval->status->ViewValue = "Publish";
						break;
					case "0":
						$term_result_approval->status->ViewValue = "Don't Publish";
						break;
					default:
						$term_result_approval->status->ViewValue = $term_result_approval->status->CurrentValue;
				}
			} else {
				$term_result_approval->status->ViewValue = NULL;
			}
			$term_result_approval->status->CssStyle = "";
			$term_result_approval->status->CssClass = "";
			$term_result_approval->status->ViewCustomAttributes = "";

			// approvalID
			$term_result_approval->approvalID->HrefValue = "";
			$term_result_approval->approvalID->TooltipValue = "";

			// sessionTermID
			$term_result_approval->sessionTermID->HrefValue = "";
			$term_result_approval->sessionTermID->TooltipValue = "";

			// status
			$term_result_approval->status->HrefValue = "";
			$term_result_approval->status->TooltipValue = "";
		} elseif ($term_result_approval->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// approvalID
			$term_result_approval->approvalID->EditCustomAttributes = "";
			$term_result_approval->approvalID->EditValue = $term_result_approval->approvalID->CurrentValue;
			$term_result_approval->approvalID->CssStyle = "";
			$term_result_approval->approvalID->CssClass = "";
			$term_result_approval->approvalID->ViewCustomAttributes = "";

			// sessionTermID
			$term_result_approval->sessionTermID->EditCustomAttributes = "";
			$term_result_approval->sessionTermID->EditValue = ew_HtmlEncode($term_result_approval->sessionTermID->CurrentValue);
			if (strval($term_result_approval->sessionTermID->CurrentValue) <> "") {
				$sFilterWrk = "`sessionTermID` = " . ew_AdjustSql($term_result_approval->sessionTermID->CurrentValue) . "";
			$sSqlWrk = "SELECT `termID` FROM `session_terms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$term_result_approval->sessionTermID->EditValue = $rswrk->fields('termID');
					$rswrk->Close();
				} else {
					$term_result_approval->sessionTermID->EditValue = $term_result_approval->sessionTermID->CurrentValue;
				}
			} else {
				$term_result_approval->sessionTermID->EditValue = NULL;
			}

			// status
			$term_result_approval->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Publish");
			$arwrk[] = array("0", "Don't Publish");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$term_result_approval->status->EditValue = $arwrk;

			// Edit refer script
			// approvalID

			$term_result_approval->approvalID->HrefValue = "";

			// sessionTermID
			$term_result_approval->sessionTermID->HrefValue = "";

			// status
			$term_result_approval->status->HrefValue = "";
		}

		// Call Row Rendered event
		if ($term_result_approval->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$term_result_approval->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $term_result_approval;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($term_result_approval->sessionTermID->FormValue) && $term_result_approval->sessionTermID->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $term_result_approval->sessionTermID->FldCaption();
		}
		if (!ew_CheckInteger($term_result_approval->sessionTermID->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $term_result_approval->sessionTermID->FldErrMsg();
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
		global $conn, $Security, $Language, $term_result_approval;
		$sFilter = $term_result_approval->KeyFilter();
			if ($term_result_approval->sessionTermID->CurrentValue <> "") { // Check field with unique index
			$sFilterChk = "(`sessionTermID` = " . ew_AdjustSql($term_result_approval->sessionTermID->CurrentValue) . ")";
			$sFilterChk .= " AND NOT (" . $sFilter . ")";
			$term_result_approval->CurrentFilter = $sFilterChk;
			$sSqlChk = $term_result_approval->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rsChk = $conn->Execute($sSqlChk);
			$conn->raiseErrorFn = '';
			if ($rsChk === FALSE) {
				return FALSE;
			} elseif (!$rsChk->EOF) {
				$sIdxErrMsg = str_replace("%f", 'sessionTermID', $Language->Phrase("DupIndex"));
				$sIdxErrMsg = str_replace("%v", $term_result_approval->sessionTermID->CurrentValue, $sIdxErrMsg);
				$this->setMessage($sIdxErrMsg);				
				$rsChk->Close();
				return FALSE;
			}
			$rsChk->Close();
		}
		$term_result_approval->CurrentFilter = $sFilter;
		$sSql = $term_result_approval->SQL();
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

			// sessionTermID
			$term_result_approval->sessionTermID->SetDbValueDef($rsnew, $term_result_approval->sessionTermID->CurrentValue, NULL, FALSE);

			// status
			$term_result_approval->status->SetDbValueDef($rsnew, $term_result_approval->status->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $term_result_approval->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($term_result_approval->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($term_result_approval->CancelMessage <> "") {
					$this->setMessage($term_result_approval->CancelMessage);
					$term_result_approval->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$term_result_approval->Row_Updated($rsold, $rsnew);
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
