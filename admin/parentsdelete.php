<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "parentsinfo.php" ?>
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
$parents_delete = new cparents_delete();
$Page =& $parents_delete;

// Page init
$parents_delete->Page_Init();

// Page main
$parents_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var parents_delete = new ew_Page("parents_delete");

// page properties
parents_delete.PageID = "delete"; // page ID
parents_delete.FormID = "fparentsdelete"; // form ID
var EW_PAGE_ID = parents_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
parents_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
parents_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
parents_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
parents_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $parents_delete->LoadRecordset())
	$parents_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($parents_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$parents_delete->Page_Terminate("parentslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $parents->TableCaption() ?><br><br>
<a href="<?php echo $parents->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$parents_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="parents">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($parents_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $parents->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $parents->parentID->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->firstname->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->middlename->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->lastname->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->occupation->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->residentState->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->stateOfOrigin->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->emailAddress->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->portalUsername->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->portalPassword->FldCaption() ?></td>
		<td valign="top"><?php echo $parents->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$parents_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$parents_delete->lRecCnt++;

	// Set row properties
	$parents->CssClass = "";
	$parents->CssStyle = "";
	$parents->RowAttrs = array();
	$parents->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$parents_delete->LoadRowValues($rs);

	// Render row
	$parents_delete->RenderRow();
?>
	<tr<?php echo $parents->RowAttributes() ?>>
		<td<?php echo $parents->parentID->CellAttributes() ?>>
<div<?php echo $parents->parentID->ViewAttributes() ?>><?php echo $parents->parentID->ListViewValue() ?></div></td>
		<td<?php echo $parents->firstname->CellAttributes() ?>>
<div<?php echo $parents->firstname->ViewAttributes() ?>><?php echo $parents->firstname->ListViewValue() ?></div></td>
		<td<?php echo $parents->middlename->CellAttributes() ?>>
<div<?php echo $parents->middlename->ViewAttributes() ?>><?php echo $parents->middlename->ListViewValue() ?></div></td>
		<td<?php echo $parents->lastname->CellAttributes() ?>>
<div<?php echo $parents->lastname->ViewAttributes() ?>><?php echo $parents->lastname->ListViewValue() ?></div></td>
		<td<?php echo $parents->occupation->CellAttributes() ?>>
<div<?php echo $parents->occupation->ViewAttributes() ?>><?php echo $parents->occupation->ListViewValue() ?></div></td>
		<td<?php echo $parents->residentState->CellAttributes() ?>>
<div<?php echo $parents->residentState->ViewAttributes() ?>><?php echo $parents->residentState->ListViewValue() ?></div></td>
		<td<?php echo $parents->stateOfOrigin->CellAttributes() ?>>
<div<?php echo $parents->stateOfOrigin->ViewAttributes() ?>><?php echo $parents->stateOfOrigin->ListViewValue() ?></div></td>
		<td<?php echo $parents->emailAddress->CellAttributes() ?>>
<div<?php echo $parents->emailAddress->ViewAttributes() ?>><?php echo $parents->emailAddress->ListViewValue() ?></div></td>
		<td<?php echo $parents->portalUsername->CellAttributes() ?>>
<div<?php echo $parents->portalUsername->ViewAttributes() ?>><?php echo $parents->portalUsername->ListViewValue() ?></div></td>
		<td<?php echo $parents->portalPassword->CellAttributes() ?>>
<div<?php echo $parents->portalPassword->ViewAttributes() ?>><?php echo $parents->portalPassword->ListViewValue() ?></div></td>
		<td<?php echo $parents->status->CellAttributes() ?>>
<div<?php echo $parents->status->ViewAttributes() ?>><?php echo $parents->status->ListViewValue() ?></div></td>
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
$parents_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cparents_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'parents';

	// Page object name
	var $PageObjName = 'parents_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $parents;
		if ($parents->UseTokenInUrl) $PageUrl .= "t=" . $parents->TableVar . "&"; // Add page token
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
		global $objForm, $parents;
		if ($parents->UseTokenInUrl) {
			if ($objForm)
				return ($parents->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($parents->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cparents_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (parents)
		$GLOBALS["parents"] = new cparents();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'parents', TRUE);

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
		global $parents;

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
		global $Language, $parents;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["parentID"] <> "") {
			$parents->parentID->setQueryStringValue($_GET["parentID"]);
			if (!is_numeric($parents->parentID->QueryStringValue))
				$this->Page_Terminate("parentslist.php"); // Prevent SQL injection, exit
			$sKey .= $parents->parentID->QueryStringValue;
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
			$this->Page_Terminate("parentslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("parentslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`parentID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in parents class, parentsinfo.php

		$parents->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$parents->CurrentAction = $_POST["a_delete"];
		} else {
			$parents->CurrentAction = "I"; // Display record
		}
		switch ($parents->CurrentAction) {
			case "D": // Delete
				$parents->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($parents->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $parents;
		$DeleteRows = TRUE;
		$sWrkFilter = $parents->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in parents class, parentsinfo.php

		$parents->CurrentFilter = $sWrkFilter;
		$sSql = $parents->SQL();
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
				$DeleteRows = $parents->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['parentID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($parents->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($parents->CancelMessage <> "") {
				$this->setMessage($parents->CancelMessage);
				$parents->CancelMessage = "";
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
				$parents->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $parents;

		// Call Recordset Selecting event
		$parents->Recordset_Selecting($parents->CurrentFilter);

		// Load List page SQL
		$sSql = $parents->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$parents->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $parents;
		$sFilter = $parents->KeyFilter();

		// Call Row Selecting event
		$parents->Row_Selecting($sFilter);

		// Load SQL based on filter
		$parents->CurrentFilter = $sFilter;
		$sSql = $parents->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$parents->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $parents;
		$parents->parentID->setDbValue($rs->fields('parentID'));
		$parents->firstname->setDbValue($rs->fields('firstname'));
		$parents->middlename->setDbValue($rs->fields('middlename'));
		$parents->lastname->setDbValue($rs->fields('lastname'));
		$parents->occupation->setDbValue($rs->fields('occupation'));
		$parents->mailingAddress->setDbValue($rs->fields('mailingAddress'));
		$parents->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$parents->residentState->setDbValue($rs->fields('residentState'));
		$parents->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$parents->emailAddress->setDbValue($rs->fields('emailAddress'));
		$parents->portalUsername->setDbValue($rs->fields('portalUsername'));
		$parents->portalPassword->setDbValue($rs->fields('portalPassword'));
		$parents->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $parents;

		// Initialize URLs
		// Call Row_Rendering event

		$parents->Row_Rendering();

		// Common render codes for all row types
		// parentID

		$parents->parentID->CellCssStyle = ""; $parents->parentID->CellCssClass = "";
		$parents->parentID->CellAttrs = array(); $parents->parentID->ViewAttrs = array(); $parents->parentID->EditAttrs = array();

		// firstname
		$parents->firstname->CellCssStyle = ""; $parents->firstname->CellCssClass = "";
		$parents->firstname->CellAttrs = array(); $parents->firstname->ViewAttrs = array(); $parents->firstname->EditAttrs = array();

		// middlename
		$parents->middlename->CellCssStyle = ""; $parents->middlename->CellCssClass = "";
		$parents->middlename->CellAttrs = array(); $parents->middlename->ViewAttrs = array(); $parents->middlename->EditAttrs = array();

		// lastname
		$parents->lastname->CellCssStyle = ""; $parents->lastname->CellCssClass = "";
		$parents->lastname->CellAttrs = array(); $parents->lastname->ViewAttrs = array(); $parents->lastname->EditAttrs = array();

		// occupation
		$parents->occupation->CellCssStyle = ""; $parents->occupation->CellCssClass = "";
		$parents->occupation->CellAttrs = array(); $parents->occupation->ViewAttrs = array(); $parents->occupation->EditAttrs = array();

		// residentState
		$parents->residentState->CellCssStyle = ""; $parents->residentState->CellCssClass = "";
		$parents->residentState->CellAttrs = array(); $parents->residentState->ViewAttrs = array(); $parents->residentState->EditAttrs = array();

		// stateOfOrigin
		$parents->stateOfOrigin->CellCssStyle = ""; $parents->stateOfOrigin->CellCssClass = "";
		$parents->stateOfOrigin->CellAttrs = array(); $parents->stateOfOrigin->ViewAttrs = array(); $parents->stateOfOrigin->EditAttrs = array();

		// emailAddress
		$parents->emailAddress->CellCssStyle = ""; $parents->emailAddress->CellCssClass = "";
		$parents->emailAddress->CellAttrs = array(); $parents->emailAddress->ViewAttrs = array(); $parents->emailAddress->EditAttrs = array();

		// portalUsername
		$parents->portalUsername->CellCssStyle = ""; $parents->portalUsername->CellCssClass = "";
		$parents->portalUsername->CellAttrs = array(); $parents->portalUsername->ViewAttrs = array(); $parents->portalUsername->EditAttrs = array();

		// portalPassword
		$parents->portalPassword->CellCssStyle = ""; $parents->portalPassword->CellCssClass = "";
		$parents->portalPassword->CellAttrs = array(); $parents->portalPassword->ViewAttrs = array(); $parents->portalPassword->EditAttrs = array();

		// status
		$parents->status->CellCssStyle = ""; $parents->status->CellCssClass = "";
		$parents->status->CellAttrs = array(); $parents->status->ViewAttrs = array(); $parents->status->EditAttrs = array();
		if ($parents->RowType == EW_ROWTYPE_VIEW) { // View row

			// parentID
			$parents->parentID->ViewValue = $parents->parentID->CurrentValue;
			$parents->parentID->CssStyle = "";
			$parents->parentID->CssClass = "";
			$parents->parentID->ViewCustomAttributes = "";

			// firstname
			$parents->firstname->ViewValue = $parents->firstname->CurrentValue;
			$parents->firstname->CssStyle = "";
			$parents->firstname->CssClass = "";
			$parents->firstname->ViewCustomAttributes = "";

			// middlename
			$parents->middlename->ViewValue = $parents->middlename->CurrentValue;
			$parents->middlename->CssStyle = "";
			$parents->middlename->CssClass = "";
			$parents->middlename->ViewCustomAttributes = "";

			// lastname
			$parents->lastname->ViewValue = $parents->lastname->CurrentValue;
			$parents->lastname->CssStyle = "";
			$parents->lastname->CssClass = "";
			$parents->lastname->ViewCustomAttributes = "";

			// occupation
			$parents->occupation->ViewValue = $parents->occupation->CurrentValue;
			$parents->occupation->CssStyle = "";
			$parents->occupation->CssClass = "";
			$parents->occupation->ViewCustomAttributes = "";

			// residentState
			$parents->residentState->ViewValue = $parents->residentState->CurrentValue;
			$parents->residentState->CssStyle = "";
			$parents->residentState->CssClass = "";
			$parents->residentState->ViewCustomAttributes = "";

			// stateOfOrigin
			$parents->stateOfOrigin->ViewValue = $parents->stateOfOrigin->CurrentValue;
			$parents->stateOfOrigin->CssStyle = "";
			$parents->stateOfOrigin->CssClass = "";
			$parents->stateOfOrigin->ViewCustomAttributes = "";

			// emailAddress
			$parents->emailAddress->ViewValue = $parents->emailAddress->CurrentValue;
			$parents->emailAddress->CssStyle = "";
			$parents->emailAddress->CssClass = "";
			$parents->emailAddress->ViewCustomAttributes = "";

			// portalUsername
			$parents->portalUsername->ViewValue = $parents->portalUsername->CurrentValue;
			$parents->portalUsername->CssStyle = "";
			$parents->portalUsername->CssClass = "";
			$parents->portalUsername->ViewCustomAttributes = "";

			// portalPassword
			$parents->portalPassword->ViewValue = "********";
			$parents->portalPassword->CssStyle = "";
			$parents->portalPassword->CssClass = "";
			$parents->portalPassword->ViewCustomAttributes = "";

			// status
			if (strval($parents->status->CurrentValue) <> "") {
				switch ($parents->status->CurrentValue) {
					case "1":
						$parents->status->ViewValue = "Enabled";
						break;
					case "0":
						$parents->status->ViewValue = "Disabled";
						break;
					default:
						$parents->status->ViewValue = $parents->status->CurrentValue;
				}
			} else {
				$parents->status->ViewValue = NULL;
			}
			$parents->status->CssStyle = "";
			$parents->status->CssClass = "";
			$parents->status->ViewCustomAttributes = "";

			// parentID
			$parents->parentID->HrefValue = "";
			$parents->parentID->TooltipValue = "";

			// firstname
			$parents->firstname->HrefValue = "";
			$parents->firstname->TooltipValue = "";

			// middlename
			$parents->middlename->HrefValue = "";
			$parents->middlename->TooltipValue = "";

			// lastname
			$parents->lastname->HrefValue = "";
			$parents->lastname->TooltipValue = "";

			// occupation
			$parents->occupation->HrefValue = "";
			$parents->occupation->TooltipValue = "";

			// residentState
			$parents->residentState->HrefValue = "";
			$parents->residentState->TooltipValue = "";

			// stateOfOrigin
			$parents->stateOfOrigin->HrefValue = "";
			$parents->stateOfOrigin->TooltipValue = "";

			// emailAddress
			$parents->emailAddress->HrefValue = "";
			$parents->emailAddress->TooltipValue = "";

			// portalUsername
			$parents->portalUsername->HrefValue = "";
			$parents->portalUsername->TooltipValue = "";

			// portalPassword
			$parents->portalPassword->HrefValue = "";
			$parents->portalPassword->TooltipValue = "";

			// status
			$parents->status->HrefValue = "";
			$parents->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($parents->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$parents->Row_Rendered();
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
