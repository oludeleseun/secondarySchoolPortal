<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "fees_invoiceinfo.php" ?>
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
$fees_invoice_add = new cfees_invoice_add();
$Page =& $fees_invoice_add;

// Page init
$fees_invoice_add->Page_Init();

// Page main
$fees_invoice_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var fees_invoice_add = new ew_Page("fees_invoice_add");

// page properties
fees_invoice_add.PageID = "add"; // page ID
fees_invoice_add.FormID = "ffees_invoiceadd"; // form ID
var EW_PAGE_ID = fees_invoice_add.PageID; // for backward compatibility

// extend page with ValidateForm function
fees_invoice_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
fees_invoice_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
fees_invoice_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
fees_invoice_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
fees_invoice_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $fees_invoice->TableCaption() ?><br><br>
<a href="<?php echo $fees_invoice->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$fees_invoice_add->ShowMessage();
?>
<form name="ffees_invoiceadd" id="ffees_invoiceadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return fees_invoice_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="fees_invoice">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
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
$fees_invoice_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cfees_invoice_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'fees_invoice';

	// Page object name
	var $PageObjName = 'fees_invoice_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $fees_invoice;
		if ($fees_invoice->UseTokenInUrl) $PageUrl .= "t=" . $fees_invoice->TableVar . "&"; // Add page token
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
		global $objForm, $fees_invoice;
		if ($fees_invoice->UseTokenInUrl) {
			if ($objForm)
				return ($fees_invoice->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($fees_invoice->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cfees_invoice_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (fees_invoice)
		$GLOBALS["fees_invoice"] = new cfees_invoice();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'fees_invoice', TRUE);

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
		global $fees_invoice;

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
		global $objForm, $Language, $gsFormError, $fees_invoice;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["invoiceID"] != "") {
		  $fees_invoice->invoiceID->setQueryStringValue($_GET["invoiceID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $fees_invoice->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$fees_invoice->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $fees_invoice->CurrentAction = "C"; // Copy record
		  } else {
		    $fees_invoice->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($fees_invoice->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("fees_invoicelist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$fees_invoice->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $fees_invoice->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$fees_invoice->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $fees_invoice;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $fees_invoice;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $fees_invoice;
		$fees_invoice->invoiceID->setFormValue($objForm->GetValue("x_invoiceID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $fees_invoice;
		$fees_invoice->invoiceID->CurrentValue = $fees_invoice->invoiceID->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $fees_invoice;
		$sFilter = $fees_invoice->KeyFilter();

		// Call Row Selecting event
		$fees_invoice->Row_Selecting($sFilter);

		// Load SQL based on filter
		$fees_invoice->CurrentFilter = $sFilter;
		$sSql = $fees_invoice->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$fees_invoice->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $fees_invoice;
		$fees_invoice->invoiceID->setDbValue($rs->fields('invoiceID'));
		$fees_invoice->sessionID->setDbValue($rs->fields('sessionID'));
		$fees_invoice->amount->setDbValue($rs->fields('amount'));
		$fees_invoice->studentID->setDbValue($rs->fields('studentID'));
		$fees_invoice->dateGenerated->setDbValue($rs->fields('dateGenerated'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $fees_invoice;

		// Initialize URLs
		// Call Row_Rendering event

		$fees_invoice->Row_Rendering();

		// Common render codes for all row types
		if ($fees_invoice->RowType == EW_ROWTYPE_VIEW) { // View row

			// invoiceID
			$fees_invoice->invoiceID->ViewValue = $fees_invoice->invoiceID->CurrentValue;
			$fees_invoice->invoiceID->CssStyle = "";
			$fees_invoice->invoiceID->CssClass = "";
			$fees_invoice->invoiceID->ViewCustomAttributes = "";

			// sessionID
			if (strval($fees_invoice->sessionID->CurrentValue) <> "") {
				$sFilterWrk = "`sessionID` = " . ew_AdjustSql($fees_invoice->sessionID->CurrentValue) . "";
			$sSqlWrk = "SELECT `sessionName` FROM `academic_sessions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `sessionName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$fees_invoice->sessionID->ViewValue = $rswrk->fields('sessionName');
					$rswrk->Close();
				} else {
					$fees_invoice->sessionID->ViewValue = $fees_invoice->sessionID->CurrentValue;
				}
			} else {
				$fees_invoice->sessionID->ViewValue = NULL;
			}
			$fees_invoice->sessionID->CssStyle = "";
			$fees_invoice->sessionID->CssClass = "";
			$fees_invoice->sessionID->ViewCustomAttributes = "";

			// amount
			$fees_invoice->amount->ViewValue = $fees_invoice->amount->CurrentValue;
			$fees_invoice->amount->CssStyle = "";
			$fees_invoice->amount->CssClass = "";
			$fees_invoice->amount->ViewCustomAttributes = "";

			// studentID
			if (strval($fees_invoice->studentID->CurrentValue) <> "") {
				$sFilterWrk = "`studentID` = " . ew_AdjustSql($fees_invoice->studentID->CurrentValue) . "";
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
					$fees_invoice->studentID->ViewValue = $rswrk->fields('firstname');
					$fees_invoice->studentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$fees_invoice->studentID->ViewValue = $fees_invoice->studentID->CurrentValue;
				}
			} else {
				$fees_invoice->studentID->ViewValue = NULL;
			}
			$fees_invoice->studentID->CssStyle = "";
			$fees_invoice->studentID->CssClass = "";
			$fees_invoice->studentID->ViewCustomAttributes = "";

			// dateGenerated
			$fees_invoice->dateGenerated->ViewValue = $fees_invoice->dateGenerated->CurrentValue;
			$fees_invoice->dateGenerated->ViewValue = ew_FormatDateTime($fees_invoice->dateGenerated->ViewValue, 5);
			$fees_invoice->dateGenerated->CssStyle = "";
			$fees_invoice->dateGenerated->CssClass = "";
			$fees_invoice->dateGenerated->ViewCustomAttributes = "";
		} elseif ($fees_invoice->RowType == EW_ROWTYPE_ADD) { // Add row
		}

		// Call Row Rendered event
		if ($fees_invoice->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$fees_invoice->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $fees_invoice;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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
		global $conn, $Language, $Security, $fees_invoice;
		$rsnew = array();

		// Call Row Inserting event
		$bInsertRow = $fees_invoice->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($fees_invoice->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($fees_invoice->CancelMessage <> "") {
				$this->setMessage($fees_invoice->CancelMessage);
				$fees_invoice->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$fees_invoice->invoiceID->setDbValue($conn->Insert_ID());
			$rsnew['invoiceID'] = $fees_invoice->invoiceID->DbValue;

			// Call Row Inserted event
			$fees_invoice->Row_Inserted($rsnew);
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
