<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "etranzact_transactionsinfo.php" ?>
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
$etranzact_transactions_add = new cetranzact_transactions_add();
$Page =& $etranzact_transactions_add;

// Page init
$etranzact_transactions_add->Page_Init();

// Page main
$etranzact_transactions_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var etranzact_transactions_add = new ew_Page("etranzact_transactions_add");

// page properties
etranzact_transactions_add.PageID = "add"; // page ID
etranzact_transactions_add.FormID = "fetranzact_transactionsadd"; // form ID
var EW_PAGE_ID = etranzact_transactions_add.PageID; // for backward compatibility

// extend page with ValidateForm function
etranzact_transactions_add.ValidateForm = function(fobj) {
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
etranzact_transactions_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
etranzact_transactions_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
etranzact_transactions_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
etranzact_transactions_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $etranzact_transactions->TableCaption() ?><br><br>
<a href="<?php echo $etranzact_transactions->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$etranzact_transactions_add->ShowMessage();
?>
<form name="fetranzact_transactionsadd" id="fetranzact_transactionsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return etranzact_transactions_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="etranzact_transactions">
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
$etranzact_transactions_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cetranzact_transactions_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'etranzact_transactions';

	// Page object name
	var $PageObjName = 'etranzact_transactions_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $etranzact_transactions;
		if ($etranzact_transactions->UseTokenInUrl) $PageUrl .= "t=" . $etranzact_transactions->TableVar . "&"; // Add page token
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
		global $objForm, $etranzact_transactions;
		if ($etranzact_transactions->UseTokenInUrl) {
			if ($objForm)
				return ($etranzact_transactions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($etranzact_transactions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cetranzact_transactions_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (etranzact_transactions)
		$GLOBALS["etranzact_transactions"] = new cetranzact_transactions();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'etranzact_transactions', TRUE);

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
		global $etranzact_transactions;

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
		global $objForm, $Language, $gsFormError, $etranzact_transactions;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["transactionID"] != "") {
		  $etranzact_transactions->transactionID->setQueryStringValue($_GET["transactionID"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $etranzact_transactions->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$etranzact_transactions->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $etranzact_transactions->CurrentAction = "C"; // Copy record
		  } else {
		    $etranzact_transactions->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($etranzact_transactions->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("etranzact_transactionslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$etranzact_transactions->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $etranzact_transactions->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$etranzact_transactions->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $etranzact_transactions;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $etranzact_transactions;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $etranzact_transactions;
		$etranzact_transactions->transactionID->setFormValue($objForm->GetValue("x_transactionID"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $etranzact_transactions;
		$etranzact_transactions->transactionID->CurrentValue = $etranzact_transactions->transactionID->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $etranzact_transactions;
		$sFilter = $etranzact_transactions->KeyFilter();

		// Call Row Selecting event
		$etranzact_transactions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$etranzact_transactions->CurrentFilter = $sFilter;
		$sSql = $etranzact_transactions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$etranzact_transactions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $etranzact_transactions;
		$etranzact_transactions->transactionID->setDbValue($rs->fields('transactionID'));
		$etranzact_transactions->studentID->setDbValue($rs->fields('studentID'));
		$etranzact_transactions->transactionAmount->setDbValue($rs->fields('transactionAmount'));
		$etranzact_transactions->confirmationNumber->setDbValue($rs->fields('confirmationNumber'));
		$etranzact_transactions->receiptNumber->setDbValue($rs->fields('receiptNumber'));
		$etranzact_transactions->transactionNumber->setDbValue($rs->fields('transactionNumber'));
		$etranzact_transactions->transactionDate->setDbValue($rs->fields('transactionDate'));
		$etranzact_transactions->dateLogged->setDbValue($rs->fields('dateLogged'));
		$etranzact_transactions->transactionReference->setDbValue($rs->fields('transactionReference'));
		$etranzact_transactions->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $etranzact_transactions;

		// Initialize URLs
		// Call Row_Rendering event

		$etranzact_transactions->Row_Rendering();

		// Common render codes for all row types
		if ($etranzact_transactions->RowType == EW_ROWTYPE_VIEW) { // View row

			// transactionID
			$etranzact_transactions->transactionID->ViewValue = $etranzact_transactions->transactionID->CurrentValue;
			$etranzact_transactions->transactionID->CssStyle = "";
			$etranzact_transactions->transactionID->CssClass = "";
			$etranzact_transactions->transactionID->ViewCustomAttributes = "";

			// studentID
			if (strval($etranzact_transactions->studentID->CurrentValue) <> "") {
				$sFilterWrk = "`studentID` = " . ew_AdjustSql($etranzact_transactions->studentID->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `students`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$etranzact_transactions->studentID->ViewValue = $rswrk->fields('firstname');
					$etranzact_transactions->studentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$etranzact_transactions->studentID->ViewValue = $etranzact_transactions->studentID->CurrentValue;
				}
			} else {
				$etranzact_transactions->studentID->ViewValue = NULL;
			}
			$etranzact_transactions->studentID->CssStyle = "";
			$etranzact_transactions->studentID->CssClass = "";
			$etranzact_transactions->studentID->ViewCustomAttributes = "";

			// transactionAmount
			$etranzact_transactions->transactionAmount->ViewValue = $etranzact_transactions->transactionAmount->CurrentValue;
			$etranzact_transactions->transactionAmount->CssStyle = "";
			$etranzact_transactions->transactionAmount->CssClass = "";
			$etranzact_transactions->transactionAmount->ViewCustomAttributes = "";

			// confirmationNumber
			$etranzact_transactions->confirmationNumber->ViewValue = $etranzact_transactions->confirmationNumber->CurrentValue;
			$etranzact_transactions->confirmationNumber->CssStyle = "";
			$etranzact_transactions->confirmationNumber->CssClass = "";
			$etranzact_transactions->confirmationNumber->ViewCustomAttributes = "";

			// receiptNumber
			$etranzact_transactions->receiptNumber->ViewValue = $etranzact_transactions->receiptNumber->CurrentValue;
			$etranzact_transactions->receiptNumber->CssStyle = "";
			$etranzact_transactions->receiptNumber->CssClass = "";
			$etranzact_transactions->receiptNumber->ViewCustomAttributes = "";

			// transactionNumber
			$etranzact_transactions->transactionNumber->ViewValue = $etranzact_transactions->transactionNumber->CurrentValue;
			$etranzact_transactions->transactionNumber->CssStyle = "";
			$etranzact_transactions->transactionNumber->CssClass = "";
			$etranzact_transactions->transactionNumber->ViewCustomAttributes = "";

			// transactionDate
			$etranzact_transactions->transactionDate->ViewValue = $etranzact_transactions->transactionDate->CurrentValue;
			$etranzact_transactions->transactionDate->ViewValue = ew_FormatDateTime($etranzact_transactions->transactionDate->ViewValue, 5);
			$etranzact_transactions->transactionDate->CssStyle = "";
			$etranzact_transactions->transactionDate->CssClass = "";
			$etranzact_transactions->transactionDate->ViewCustomAttributes = "";

			// dateLogged
			$etranzact_transactions->dateLogged->ViewValue = $etranzact_transactions->dateLogged->CurrentValue;
			$etranzact_transactions->dateLogged->ViewValue = ew_FormatDateTime($etranzact_transactions->dateLogged->ViewValue, 5);
			$etranzact_transactions->dateLogged->CssStyle = "";
			$etranzact_transactions->dateLogged->CssClass = "";
			$etranzact_transactions->dateLogged->ViewCustomAttributes = "";

			// transactionReference
			$etranzact_transactions->transactionReference->ViewValue = $etranzact_transactions->transactionReference->CurrentValue;
			$etranzact_transactions->transactionReference->CssStyle = "";
			$etranzact_transactions->transactionReference->CssClass = "";
			$etranzact_transactions->transactionReference->ViewCustomAttributes = "";

			// status
			$etranzact_transactions->status->ViewValue = $etranzact_transactions->status->CurrentValue;
			$etranzact_transactions->status->CssStyle = "";
			$etranzact_transactions->status->CssClass = "";
			$etranzact_transactions->status->ViewCustomAttributes = "";
		} elseif ($etranzact_transactions->RowType == EW_ROWTYPE_ADD) { // Add row
		}

		// Call Row Rendered event
		if ($etranzact_transactions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$etranzact_transactions->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $etranzact_transactions;

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
		global $conn, $Language, $Security, $etranzact_transactions;
		$rsnew = array();

		// Call Row Inserting event
		$bInsertRow = $etranzact_transactions->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($etranzact_transactions->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($etranzact_transactions->CancelMessage <> "") {
				$this->setMessage($etranzact_transactions->CancelMessage);
				$etranzact_transactions->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$etranzact_transactions->transactionID->setDbValue($conn->Insert_ID());
			$rsnew['transactionID'] = $etranzact_transactions->transactionID->DbValue;

			// Call Row Inserted event
			$etranzact_transactions->Row_Inserted($rsnew);
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
