<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_termsinfo.php" ?>
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
$academic_terms_delete = new cacademic_terms_delete();
$Page =& $academic_terms_delete;

// Page init
$academic_terms_delete->Page_Init();

// Page main
$academic_terms_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var academic_terms_delete = new ew_Page("academic_terms_delete");

// page properties
academic_terms_delete.PageID = "delete"; // page ID
academic_terms_delete.FormID = "facademic_termsdelete"; // form ID
var EW_PAGE_ID = academic_terms_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
academic_terms_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
academic_terms_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_terms_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_terms_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $academic_terms_delete->LoadRecordset())
	$academic_terms_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($academic_terms_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$academic_terms_delete->Page_Terminate("academic_termslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_terms->TableCaption() ?><br><br>
<a href="<?php echo $academic_terms->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_terms_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="academic_terms">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($academic_terms_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $academic_terms->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $academic_terms->termID->FldCaption() ?></td>
		<td valign="top"><?php echo $academic_terms->termName->FldCaption() ?></td>
		<td valign="top"><?php echo $academic_terms->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$academic_terms_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$academic_terms_delete->lRecCnt++;

	// Set row properties
	$academic_terms->CssClass = "";
	$academic_terms->CssStyle = "";
	$academic_terms->RowAttrs = array();
	$academic_terms->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$academic_terms_delete->LoadRowValues($rs);

	// Render row
	$academic_terms_delete->RenderRow();
?>
	<tr<?php echo $academic_terms->RowAttributes() ?>>
		<td<?php echo $academic_terms->termID->CellAttributes() ?>>
<div<?php echo $academic_terms->termID->ViewAttributes() ?>><?php echo $academic_terms->termID->ListViewValue() ?></div></td>
		<td<?php echo $academic_terms->termName->CellAttributes() ?>>
<div<?php echo $academic_terms->termName->ViewAttributes() ?>><?php echo $academic_terms->termName->ListViewValue() ?></div></td>
		<td<?php echo $academic_terms->status->CellAttributes() ?>>
<div<?php echo $academic_terms->status->ViewAttributes() ?>><?php echo $academic_terms->status->ListViewValue() ?></div></td>
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
$academic_terms_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_terms_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'academic_terms';

	// Page object name
	var $PageObjName = 'academic_terms_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_terms;
		if ($academic_terms->UseTokenInUrl) $PageUrl .= "t=" . $academic_terms->TableVar . "&"; // Add page token
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
		global $objForm, $academic_terms;
		if ($academic_terms->UseTokenInUrl) {
			if ($objForm)
				return ($academic_terms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_terms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_terms_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_terms)
		$GLOBALS["academic_terms"] = new cacademic_terms();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_terms', TRUE);

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
		global $academic_terms;

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
		global $Language, $academic_terms;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["termID"] <> "") {
			$academic_terms->termID->setQueryStringValue($_GET["termID"]);
			if (!is_numeric($academic_terms->termID->QueryStringValue))
				$this->Page_Terminate("academic_termslist.php"); // Prevent SQL injection, exit
			$sKey .= $academic_terms->termID->QueryStringValue;
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
			$this->Page_Terminate("academic_termslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("academic_termslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`termID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in academic_terms class, academic_termsinfo.php

		$academic_terms->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$academic_terms->CurrentAction = $_POST["a_delete"];
		} else {
			$academic_terms->CurrentAction = "I"; // Display record
		}
		switch ($academic_terms->CurrentAction) {
			case "D": // Delete
				$academic_terms->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($academic_terms->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $academic_terms;
		$DeleteRows = TRUE;
		$sWrkFilter = $academic_terms->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in academic_terms class, academic_termsinfo.php

		$academic_terms->CurrentFilter = $sWrkFilter;
		$sSql = $academic_terms->SQL();
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
				$DeleteRows = $academic_terms->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['termID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($academic_terms->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($academic_terms->CancelMessage <> "") {
				$this->setMessage($academic_terms->CancelMessage);
				$academic_terms->CancelMessage = "";
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
				$academic_terms->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $academic_terms;

		// Call Recordset Selecting event
		$academic_terms->Recordset_Selecting($academic_terms->CurrentFilter);

		// Load List page SQL
		$sSql = $academic_terms->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$academic_terms->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_terms;
		$sFilter = $academic_terms->KeyFilter();

		// Call Row Selecting event
		$academic_terms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_terms->CurrentFilter = $sFilter;
		$sSql = $academic_terms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_terms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_terms;
		$academic_terms->termID->setDbValue($rs->fields('termID'));
		$academic_terms->termName->setDbValue($rs->fields('termName'));
		$academic_terms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_terms;

		// Initialize URLs
		// Call Row_Rendering event

		$academic_terms->Row_Rendering();

		// Common render codes for all row types
		// termID

		$academic_terms->termID->CellCssStyle = ""; $academic_terms->termID->CellCssClass = "";
		$academic_terms->termID->CellAttrs = array(); $academic_terms->termID->ViewAttrs = array(); $academic_terms->termID->EditAttrs = array();

		// termName
		$academic_terms->termName->CellCssStyle = ""; $academic_terms->termName->CellCssClass = "";
		$academic_terms->termName->CellAttrs = array(); $academic_terms->termName->ViewAttrs = array(); $academic_terms->termName->EditAttrs = array();

		// status
		$academic_terms->status->CellCssStyle = ""; $academic_terms->status->CellCssClass = "";
		$academic_terms->status->CellAttrs = array(); $academic_terms->status->ViewAttrs = array(); $academic_terms->status->EditAttrs = array();
		if ($academic_terms->RowType == EW_ROWTYPE_VIEW) { // View row

			// termID
			$academic_terms->termID->ViewValue = $academic_terms->termID->CurrentValue;
			$academic_terms->termID->CssStyle = "";
			$academic_terms->termID->CssClass = "";
			$academic_terms->termID->ViewCustomAttributes = "";

			// termName
			$academic_terms->termName->ViewValue = $academic_terms->termName->CurrentValue;
			$academic_terms->termName->CssStyle = "";
			$academic_terms->termName->CssClass = "";
			$academic_terms->termName->ViewCustomAttributes = "";

			// status
			if (strval($academic_terms->status->CurrentValue) <> "") {
				switch ($academic_terms->status->CurrentValue) {
					case "1":
						$academic_terms->status->ViewValue = "Enabled";
						break;
					case "0":
						$academic_terms->status->ViewValue = "Disabled";
						break;
					default:
						$academic_terms->status->ViewValue = $academic_terms->status->CurrentValue;
				}
			} else {
				$academic_terms->status->ViewValue = NULL;
			}
			$academic_terms->status->CssStyle = "";
			$academic_terms->status->CssClass = "";
			$academic_terms->status->ViewCustomAttributes = "";

			// termID
			$academic_terms->termID->HrefValue = "";
			$academic_terms->termID->TooltipValue = "";

			// termName
			$academic_terms->termName->HrefValue = "";
			$academic_terms->termName->TooltipValue = "";

			// status
			$academic_terms->status->HrefValue = "";
			$academic_terms->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($academic_terms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_terms->Row_Rendered();
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
