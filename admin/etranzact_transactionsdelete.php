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
$etranzact_transactions_delete = new cetranzact_transactions_delete();
$Page =& $etranzact_transactions_delete;

// Page init
$etranzact_transactions_delete->Page_Init();

// Page main
$etranzact_transactions_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var etranzact_transactions_delete = new ew_Page("etranzact_transactions_delete");

// page properties
etranzact_transactions_delete.PageID = "delete"; // page ID
etranzact_transactions_delete.FormID = "fetranzact_transactionsdelete"; // form ID
var EW_PAGE_ID = etranzact_transactions_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
etranzact_transactions_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
etranzact_transactions_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
etranzact_transactions_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
etranzact_transactions_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php

// Load records for display
if ($rs = $etranzact_transactions_delete->LoadRecordset())
	$etranzact_transactions_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($etranzact_transactions_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$etranzact_transactions_delete->Page_Terminate("etranzact_transactionslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $etranzact_transactions->TableCaption() ?><br><br>
<a href="<?php echo $etranzact_transactions->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$etranzact_transactions_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="etranzact_transactions">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($etranzact_transactions_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $etranzact_transactions->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $etranzact_transactions->transactionID->FldCaption() ?></td>
		<td valign="top"><?php echo $etranzact_transactions->studentID->FldCaption() ?></td>
		<td valign="top"><?php echo $etranzact_transactions->transactionAmount->FldCaption() ?></td>
		<td valign="top"><?php echo $etranzact_transactions->confirmationNumber->FldCaption() ?></td>
		<td valign="top"><?php echo $etranzact_transactions->receiptNumber->FldCaption() ?></td>
		<td valign="top"><?php echo $etranzact_transactions->transactionNumber->FldCaption() ?></td>
		<td valign="top"><?php echo $etranzact_transactions->transactionDate->FldCaption() ?></td>
		<td valign="top"><?php echo $etranzact_transactions->dateLogged->FldCaption() ?></td>
		<td valign="top"><?php echo $etranzact_transactions->transactionReference->FldCaption() ?></td>
		<td valign="top"><?php echo $etranzact_transactions->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$etranzact_transactions_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$etranzact_transactions_delete->lRecCnt++;

	// Set row properties
	$etranzact_transactions->CssClass = "";
	$etranzact_transactions->CssStyle = "";
	$etranzact_transactions->RowAttrs = array();
	$etranzact_transactions->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$etranzact_transactions_delete->LoadRowValues($rs);

	// Render row
	$etranzact_transactions_delete->RenderRow();
?>
	<tr<?php echo $etranzact_transactions->RowAttributes() ?>>
		<td<?php echo $etranzact_transactions->transactionID->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionID->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionID->ListViewValue() ?></div></td>
		<td<?php echo $etranzact_transactions->studentID->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->studentID->ViewAttributes() ?>><?php echo $etranzact_transactions->studentID->ListViewValue() ?></div></td>
		<td<?php echo $etranzact_transactions->transactionAmount->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionAmount->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionAmount->ListViewValue() ?></div></td>
		<td<?php echo $etranzact_transactions->confirmationNumber->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->confirmationNumber->ViewAttributes() ?>><?php echo $etranzact_transactions->confirmationNumber->ListViewValue() ?></div></td>
		<td<?php echo $etranzact_transactions->receiptNumber->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->receiptNumber->ViewAttributes() ?>><?php echo $etranzact_transactions->receiptNumber->ListViewValue() ?></div></td>
		<td<?php echo $etranzact_transactions->transactionNumber->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionNumber->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionNumber->ListViewValue() ?></div></td>
		<td<?php echo $etranzact_transactions->transactionDate->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionDate->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionDate->ListViewValue() ?></div></td>
		<td<?php echo $etranzact_transactions->dateLogged->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->dateLogged->ViewAttributes() ?>><?php echo $etranzact_transactions->dateLogged->ListViewValue() ?></div></td>
		<td<?php echo $etranzact_transactions->transactionReference->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->transactionReference->ViewAttributes() ?>><?php echo $etranzact_transactions->transactionReference->ListViewValue() ?></div></td>
		<td<?php echo $etranzact_transactions->status->CellAttributes() ?>>
<div<?php echo $etranzact_transactions->status->ViewAttributes() ?>><?php echo $etranzact_transactions->status->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$etranzact_transactions_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cetranzact_transactions_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'etranzact_transactions';

	// Page object name
	var $PageObjName = 'etranzact_transactions_delete';

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
	function cetranzact_transactions_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (etranzact_transactions)
		$GLOBALS["etranzact_transactions"] = new cetranzact_transactions();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $etranzact_transactions;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["transactionID"] <> "") {
			$etranzact_transactions->transactionID->setQueryStringValue($_GET["transactionID"]);
			if (!is_numeric($etranzact_transactions->transactionID->QueryStringValue))
				$this->Page_Terminate("etranzact_transactionslist.php"); // Prevent SQL injection, exit
			$sKey .= $etranzact_transactions->transactionID->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("etranzact_transactionslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("etranzact_transactionslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`transactionID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in etranzact_transactions class, etranzact_transactionsinfo.php

		$etranzact_transactions->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$etranzact_transactions->CurrentAction = $_POST["a_delete"];
		} else {
			$etranzact_transactions->CurrentAction = "I"; // Display record
		}
		switch ($etranzact_transactions->CurrentAction) {
			case "D": // Delete
				$etranzact_transactions->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($etranzact_transactions->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $etranzact_transactions;
		$DeleteRows = TRUE;
		$sWrkFilter = $etranzact_transactions->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in etranzact_transactions class, etranzact_transactionsinfo.php

		$etranzact_transactions->CurrentFilter = $sWrkFilter;
		$sSql = $etranzact_transactions->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $etranzact_transactions->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['transactionID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($etranzact_transactions->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($etranzact_transactions->CancelMessage <> "") {
				$this->setMessage($etranzact_transactions->CancelMessage);
				$etranzact_transactions->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$etranzact_transactions->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $etranzact_transactions;

		// Call Recordset Selecting event
		$etranzact_transactions->Recordset_Selecting($etranzact_transactions->CurrentFilter);

		// Load List page SQL
		$sSql = $etranzact_transactions->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$etranzact_transactions->Recordset_Selected($rs);
		return $rs;
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
		// transactionID

		$etranzact_transactions->transactionID->CellCssStyle = ""; $etranzact_transactions->transactionID->CellCssClass = "";
		$etranzact_transactions->transactionID->CellAttrs = array(); $etranzact_transactions->transactionID->ViewAttrs = array(); $etranzact_transactions->transactionID->EditAttrs = array();

		// studentID
		$etranzact_transactions->studentID->CellCssStyle = ""; $etranzact_transactions->studentID->CellCssClass = "";
		$etranzact_transactions->studentID->CellAttrs = array(); $etranzact_transactions->studentID->ViewAttrs = array(); $etranzact_transactions->studentID->EditAttrs = array();

		// transactionAmount
		$etranzact_transactions->transactionAmount->CellCssStyle = ""; $etranzact_transactions->transactionAmount->CellCssClass = "";
		$etranzact_transactions->transactionAmount->CellAttrs = array(); $etranzact_transactions->transactionAmount->ViewAttrs = array(); $etranzact_transactions->transactionAmount->EditAttrs = array();

		// confirmationNumber
		$etranzact_transactions->confirmationNumber->CellCssStyle = ""; $etranzact_transactions->confirmationNumber->CellCssClass = "";
		$etranzact_transactions->confirmationNumber->CellAttrs = array(); $etranzact_transactions->confirmationNumber->ViewAttrs = array(); $etranzact_transactions->confirmationNumber->EditAttrs = array();

		// receiptNumber
		$etranzact_transactions->receiptNumber->CellCssStyle = ""; $etranzact_transactions->receiptNumber->CellCssClass = "";
		$etranzact_transactions->receiptNumber->CellAttrs = array(); $etranzact_transactions->receiptNumber->ViewAttrs = array(); $etranzact_transactions->receiptNumber->EditAttrs = array();

		// transactionNumber
		$etranzact_transactions->transactionNumber->CellCssStyle = ""; $etranzact_transactions->transactionNumber->CellCssClass = "";
		$etranzact_transactions->transactionNumber->CellAttrs = array(); $etranzact_transactions->transactionNumber->ViewAttrs = array(); $etranzact_transactions->transactionNumber->EditAttrs = array();

		// transactionDate
		$etranzact_transactions->transactionDate->CellCssStyle = ""; $etranzact_transactions->transactionDate->CellCssClass = "";
		$etranzact_transactions->transactionDate->CellAttrs = array(); $etranzact_transactions->transactionDate->ViewAttrs = array(); $etranzact_transactions->transactionDate->EditAttrs = array();

		// dateLogged
		$etranzact_transactions->dateLogged->CellCssStyle = ""; $etranzact_transactions->dateLogged->CellCssClass = "";
		$etranzact_transactions->dateLogged->CellAttrs = array(); $etranzact_transactions->dateLogged->ViewAttrs = array(); $etranzact_transactions->dateLogged->EditAttrs = array();

		// transactionReference
		$etranzact_transactions->transactionReference->CellCssStyle = ""; $etranzact_transactions->transactionReference->CellCssClass = "";
		$etranzact_transactions->transactionReference->CellAttrs = array(); $etranzact_transactions->transactionReference->ViewAttrs = array(); $etranzact_transactions->transactionReference->EditAttrs = array();

		// status
		$etranzact_transactions->status->CellCssStyle = ""; $etranzact_transactions->status->CellCssClass = "";
		$etranzact_transactions->status->CellAttrs = array(); $etranzact_transactions->status->ViewAttrs = array(); $etranzact_transactions->status->EditAttrs = array();
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

			// transactionID
			$etranzact_transactions->transactionID->HrefValue = "";
			$etranzact_transactions->transactionID->TooltipValue = "";

			// studentID
			$etranzact_transactions->studentID->HrefValue = "";
			$etranzact_transactions->studentID->TooltipValue = "";

			// transactionAmount
			$etranzact_transactions->transactionAmount->HrefValue = "";
			$etranzact_transactions->transactionAmount->TooltipValue = "";

			// confirmationNumber
			$etranzact_transactions->confirmationNumber->HrefValue = "";
			$etranzact_transactions->confirmationNumber->TooltipValue = "";

			// receiptNumber
			$etranzact_transactions->receiptNumber->HrefValue = "";
			$etranzact_transactions->receiptNumber->TooltipValue = "";

			// transactionNumber
			$etranzact_transactions->transactionNumber->HrefValue = "";
			$etranzact_transactions->transactionNumber->TooltipValue = "";

			// transactionDate
			$etranzact_transactions->transactionDate->HrefValue = "";
			$etranzact_transactions->transactionDate->TooltipValue = "";

			// dateLogged
			$etranzact_transactions->dateLogged->HrefValue = "";
			$etranzact_transactions->dateLogged->TooltipValue = "";

			// transactionReference
			$etranzact_transactions->transactionReference->HrefValue = "";
			$etranzact_transactions->transactionReference->TooltipValue = "";

			// status
			$etranzact_transactions->status->HrefValue = "";
			$etranzact_transactions->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($etranzact_transactions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$etranzact_transactions->Row_Rendered();
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
}
?>
