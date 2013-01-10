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
$term_result_approval_delete = new cterm_result_approval_delete();
$Page =& $term_result_approval_delete;

// Page init
$term_result_approval_delete->Page_Init();

// Page main
$term_result_approval_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var term_result_approval_delete = new ew_Page("term_result_approval_delete");

// page properties
term_result_approval_delete.PageID = "delete"; // page ID
term_result_approval_delete.FormID = "fterm_result_approvaldelete"; // form ID
var EW_PAGE_ID = term_result_approval_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
term_result_approval_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
term_result_approval_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
term_result_approval_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
term_result_approval_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $term_result_approval_delete->LoadRecordset())
	$term_result_approval_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($term_result_approval_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$term_result_approval_delete->Page_Terminate("term_result_approvallist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $term_result_approval->TableCaption() ?><br><br>
<a href="<?php echo $term_result_approval->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$term_result_approval_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="term_result_approval">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($term_result_approval_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $term_result_approval->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $term_result_approval->approvalID->FldCaption() ?></td>
		<td valign="top"><?php echo $term_result_approval->sessionTermID->FldCaption() ?></td>
		<td valign="top"><?php echo $term_result_approval->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$term_result_approval_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$term_result_approval_delete->lRecCnt++;

	// Set row properties
	$term_result_approval->CssClass = "";
	$term_result_approval->CssStyle = "";
	$term_result_approval->RowAttrs = array();
	$term_result_approval->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$term_result_approval_delete->LoadRowValues($rs);

	// Render row
	$term_result_approval_delete->RenderRow();
?>
	<tr<?php echo $term_result_approval->RowAttributes() ?>>
		<td<?php echo $term_result_approval->approvalID->CellAttributes() ?>>
<div<?php echo $term_result_approval->approvalID->ViewAttributes() ?>><?php echo $term_result_approval->approvalID->ListViewValue() ?></div></td>
		<td<?php echo $term_result_approval->sessionTermID->CellAttributes() ?>>
<div<?php echo $term_result_approval->sessionTermID->ViewAttributes() ?>><?php echo $term_result_approval->sessionTermID->ListViewValue() ?></div></td>
		<td<?php echo $term_result_approval->status->CellAttributes() ?>>
<div<?php echo $term_result_approval->status->ViewAttributes() ?>><?php echo $term_result_approval->status->ListViewValue() ?></div></td>
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
$term_result_approval_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cterm_result_approval_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'term_result_approval';

	// Page object name
	var $PageObjName = 'term_result_approval_delete';

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
	function cterm_result_approval_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (term_result_approval)
		$GLOBALS["term_result_approval"] = new cterm_result_approval();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $term_result_approval;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["approvalID"] <> "") {
			$term_result_approval->approvalID->setQueryStringValue($_GET["approvalID"]);
			if (!is_numeric($term_result_approval->approvalID->QueryStringValue))
				$this->Page_Terminate("term_result_approvallist.php"); // Prevent SQL injection, exit
			$sKey .= $term_result_approval->approvalID->QueryStringValue;
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
			$this->Page_Terminate("term_result_approvallist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("term_result_approvallist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`approvalID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in term_result_approval class, term_result_approvalinfo.php

		$term_result_approval->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$term_result_approval->CurrentAction = $_POST["a_delete"];
		} else {
			$term_result_approval->CurrentAction = "I"; // Display record
		}
		switch ($term_result_approval->CurrentAction) {
			case "D": // Delete
				$term_result_approval->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($term_result_approval->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $term_result_approval;
		$DeleteRows = TRUE;
		$sWrkFilter = $term_result_approval->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in term_result_approval class, term_result_approvalinfo.php

		$term_result_approval->CurrentFilter = $sWrkFilter;
		$sSql = $term_result_approval->SQL();
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
				$DeleteRows = $term_result_approval->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['approvalID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($term_result_approval->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($term_result_approval->CancelMessage <> "") {
				$this->setMessage($term_result_approval->CancelMessage);
				$term_result_approval->CancelMessage = "";
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
				$term_result_approval->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $term_result_approval;

		// Call Recordset Selecting event
		$term_result_approval->Recordset_Selecting($term_result_approval->CurrentFilter);

		// Load List page SQL
		$sSql = $term_result_approval->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$term_result_approval->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		if ($term_result_approval->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$term_result_approval->Row_Rendered();
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
