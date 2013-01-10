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
$fees_invoice_delete = new cfees_invoice_delete();
$Page =& $fees_invoice_delete;

// Page init
$fees_invoice_delete->Page_Init();

// Page main
$fees_invoice_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var fees_invoice_delete = new ew_Page("fees_invoice_delete");

// page properties
fees_invoice_delete.PageID = "delete"; // page ID
fees_invoice_delete.FormID = "ffees_invoicedelete"; // form ID
var EW_PAGE_ID = fees_invoice_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
fees_invoice_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
fees_invoice_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
fees_invoice_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
fees_invoice_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $fees_invoice_delete->LoadRecordset())
	$fees_invoice_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($fees_invoice_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$fees_invoice_delete->Page_Terminate("fees_invoicelist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $fees_invoice->TableCaption() ?><br><br>
<a href="<?php echo $fees_invoice->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$fees_invoice_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="fees_invoice">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($fees_invoice_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $fees_invoice->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $fees_invoice->invoiceID->FldCaption() ?></td>
		<td valign="top"><?php echo $fees_invoice->sessionID->FldCaption() ?></td>
		<td valign="top"><?php echo $fees_invoice->amount->FldCaption() ?></td>
		<td valign="top"><?php echo $fees_invoice->studentID->FldCaption() ?></td>
		<td valign="top"><?php echo $fees_invoice->dateGenerated->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$fees_invoice_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$fees_invoice_delete->lRecCnt++;

	// Set row properties
	$fees_invoice->CssClass = "";
	$fees_invoice->CssStyle = "";
	$fees_invoice->RowAttrs = array();
	$fees_invoice->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$fees_invoice_delete->LoadRowValues($rs);

	// Render row
	$fees_invoice_delete->RenderRow();
?>
	<tr<?php echo $fees_invoice->RowAttributes() ?>>
		<td<?php echo $fees_invoice->invoiceID->CellAttributes() ?>>
<div<?php echo $fees_invoice->invoiceID->ViewAttributes() ?>><?php echo $fees_invoice->invoiceID->ListViewValue() ?></div></td>
		<td<?php echo $fees_invoice->sessionID->CellAttributes() ?>>
<div<?php echo $fees_invoice->sessionID->ViewAttributes() ?>><?php echo $fees_invoice->sessionID->ListViewValue() ?></div></td>
		<td<?php echo $fees_invoice->amount->CellAttributes() ?>>
<div<?php echo $fees_invoice->amount->ViewAttributes() ?>><?php echo $fees_invoice->amount->ListViewValue() ?></div></td>
		<td<?php echo $fees_invoice->studentID->CellAttributes() ?>>
<div<?php echo $fees_invoice->studentID->ViewAttributes() ?>><?php echo $fees_invoice->studentID->ListViewValue() ?></div></td>
		<td<?php echo $fees_invoice->dateGenerated->CellAttributes() ?>>
<div<?php echo $fees_invoice->dateGenerated->ViewAttributes() ?>><?php echo $fees_invoice->dateGenerated->ListViewValue() ?></div></td>
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
$fees_invoice_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cfees_invoice_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'fees_invoice';

	// Page object name
	var $PageObjName = 'fees_invoice_delete';

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
	function cfees_invoice_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (fees_invoice)
		$GLOBALS["fees_invoice"] = new cfees_invoice();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $fees_invoice;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["invoiceID"] <> "") {
			$fees_invoice->invoiceID->setQueryStringValue($_GET["invoiceID"]);
			if (!is_numeric($fees_invoice->invoiceID->QueryStringValue))
				$this->Page_Terminate("fees_invoicelist.php"); // Prevent SQL injection, exit
			$sKey .= $fees_invoice->invoiceID->QueryStringValue;
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
			$this->Page_Terminate("fees_invoicelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("fees_invoicelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`invoiceID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in fees_invoice class, fees_invoiceinfo.php

		$fees_invoice->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$fees_invoice->CurrentAction = $_POST["a_delete"];
		} else {
			$fees_invoice->CurrentAction = "I"; // Display record
		}
		switch ($fees_invoice->CurrentAction) {
			case "D": // Delete
				$fees_invoice->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($fees_invoice->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $fees_invoice;
		$DeleteRows = TRUE;
		$sWrkFilter = $fees_invoice->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in fees_invoice class, fees_invoiceinfo.php

		$fees_invoice->CurrentFilter = $sWrkFilter;
		$sSql = $fees_invoice->SQL();
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
				$DeleteRows = $fees_invoice->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['invoiceID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($fees_invoice->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($fees_invoice->CancelMessage <> "") {
				$this->setMessage($fees_invoice->CancelMessage);
				$fees_invoice->CancelMessage = "";
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
				$fees_invoice->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $fees_invoice;

		// Call Recordset Selecting event
		$fees_invoice->Recordset_Selecting($fees_invoice->CurrentFilter);

		// Load List page SQL
		$sSql = $fees_invoice->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$fees_invoice->Recordset_Selected($rs);
		return $rs;
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
		// invoiceID

		$fees_invoice->invoiceID->CellCssStyle = ""; $fees_invoice->invoiceID->CellCssClass = "";
		$fees_invoice->invoiceID->CellAttrs = array(); $fees_invoice->invoiceID->ViewAttrs = array(); $fees_invoice->invoiceID->EditAttrs = array();

		// sessionID
		$fees_invoice->sessionID->CellCssStyle = ""; $fees_invoice->sessionID->CellCssClass = "";
		$fees_invoice->sessionID->CellAttrs = array(); $fees_invoice->sessionID->ViewAttrs = array(); $fees_invoice->sessionID->EditAttrs = array();

		// amount
		$fees_invoice->amount->CellCssStyle = ""; $fees_invoice->amount->CellCssClass = "";
		$fees_invoice->amount->CellAttrs = array(); $fees_invoice->amount->ViewAttrs = array(); $fees_invoice->amount->EditAttrs = array();

		// studentID
		$fees_invoice->studentID->CellCssStyle = ""; $fees_invoice->studentID->CellCssClass = "";
		$fees_invoice->studentID->CellAttrs = array(); $fees_invoice->studentID->ViewAttrs = array(); $fees_invoice->studentID->EditAttrs = array();

		// dateGenerated
		$fees_invoice->dateGenerated->CellCssStyle = ""; $fees_invoice->dateGenerated->CellCssClass = "";
		$fees_invoice->dateGenerated->CellAttrs = array(); $fees_invoice->dateGenerated->ViewAttrs = array(); $fees_invoice->dateGenerated->EditAttrs = array();
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

			// invoiceID
			$fees_invoice->invoiceID->HrefValue = "";
			$fees_invoice->invoiceID->TooltipValue = "";

			// sessionID
			$fees_invoice->sessionID->HrefValue = "";
			$fees_invoice->sessionID->TooltipValue = "";

			// amount
			$fees_invoice->amount->HrefValue = "";
			$fees_invoice->amount->TooltipValue = "";

			// studentID
			$fees_invoice->studentID->HrefValue = "";
			$fees_invoice->studentID->TooltipValue = "";

			// dateGenerated
			$fees_invoice->dateGenerated->HrefValue = "";
			$fees_invoice->dateGenerated->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($fees_invoice->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$fees_invoice->Row_Rendered();
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
