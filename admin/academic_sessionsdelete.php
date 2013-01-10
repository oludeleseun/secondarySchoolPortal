<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_sessionsinfo.php" ?>
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
$academic_sessions_delete = new cacademic_sessions_delete();
$Page =& $academic_sessions_delete;

// Page init
$academic_sessions_delete->Page_Init();

// Page main
$academic_sessions_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var academic_sessions_delete = new ew_Page("academic_sessions_delete");

// page properties
academic_sessions_delete.PageID = "delete"; // page ID
academic_sessions_delete.FormID = "facademic_sessionsdelete"; // form ID
var EW_PAGE_ID = academic_sessions_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
academic_sessions_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
academic_sessions_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_sessions_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_sessions_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $academic_sessions_delete->LoadRecordset())
	$academic_sessions_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($academic_sessions_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$academic_sessions_delete->Page_Terminate("academic_sessionslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_sessions->TableCaption() ?><br><br>
<a href="<?php echo $academic_sessions->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_sessions_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="academic_sessions">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($academic_sessions_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $academic_sessions->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $academic_sessions->sessionID->FldCaption() ?></td>
		<td valign="top"><?php echo $academic_sessions->sessionName->FldCaption() ?></td>
		<td valign="top"><?php echo $academic_sessions->sessionStart->FldCaption() ?></td>
		<td valign="top"><?php echo $academic_sessions->sessionEnd->FldCaption() ?></td>
		<td valign="top"><?php echo $academic_sessions->currentSession->FldCaption() ?></td>
		<td valign="top"><?php echo $academic_sessions->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$academic_sessions_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$academic_sessions_delete->lRecCnt++;

	// Set row properties
	$academic_sessions->CssClass = "";
	$academic_sessions->CssStyle = "";
	$academic_sessions->RowAttrs = array();
	$academic_sessions->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$academic_sessions_delete->LoadRowValues($rs);

	// Render row
	$academic_sessions_delete->RenderRow();
?>
	<tr<?php echo $academic_sessions->RowAttributes() ?>>
		<td<?php echo $academic_sessions->sessionID->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionID->ViewAttributes() ?>><?php echo $academic_sessions->sessionID->ListViewValue() ?></div></td>
		<td<?php echo $academic_sessions->sessionName->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionName->ViewAttributes() ?>><?php echo $academic_sessions->sessionName->ListViewValue() ?></div></td>
		<td<?php echo $academic_sessions->sessionStart->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionStart->ViewAttributes() ?>><?php echo $academic_sessions->sessionStart->ListViewValue() ?></div></td>
		<td<?php echo $academic_sessions->sessionEnd->CellAttributes() ?>>
<div<?php echo $academic_sessions->sessionEnd->ViewAttributes() ?>><?php echo $academic_sessions->sessionEnd->ListViewValue() ?></div></td>
		<td<?php echo $academic_sessions->currentSession->CellAttributes() ?>>
<div<?php echo $academic_sessions->currentSession->ViewAttributes() ?>><?php echo $academic_sessions->currentSession->ListViewValue() ?></div></td>
		<td<?php echo $academic_sessions->status->CellAttributes() ?>>
<div<?php echo $academic_sessions->status->ViewAttributes() ?>><?php echo $academic_sessions->status->ListViewValue() ?></div></td>
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
$academic_sessions_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_sessions_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'academic_sessions';

	// Page object name
	var $PageObjName = 'academic_sessions_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_sessions;
		if ($academic_sessions->UseTokenInUrl) $PageUrl .= "t=" . $academic_sessions->TableVar . "&"; // Add page token
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
		global $objForm, $academic_sessions;
		if ($academic_sessions->UseTokenInUrl) {
			if ($objForm)
				return ($academic_sessions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_sessions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_sessions_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_sessions)
		$GLOBALS["academic_sessions"] = new cacademic_sessions();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_sessions', TRUE);

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
		global $academic_sessions;

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
		global $Language, $academic_sessions;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["sessionID"] <> "") {
			$academic_sessions->sessionID->setQueryStringValue($_GET["sessionID"]);
			if (!is_numeric($academic_sessions->sessionID->QueryStringValue))
				$this->Page_Terminate("academic_sessionslist.php"); // Prevent SQL injection, exit
			$sKey .= $academic_sessions->sessionID->QueryStringValue;
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
			$this->Page_Terminate("academic_sessionslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("academic_sessionslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`sessionID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in academic_sessions class, academic_sessionsinfo.php

		$academic_sessions->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$academic_sessions->CurrentAction = $_POST["a_delete"];
		} else {
			$academic_sessions->CurrentAction = "I"; // Display record
		}
		switch ($academic_sessions->CurrentAction) {
			case "D": // Delete
				$academic_sessions->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($academic_sessions->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $academic_sessions;
		$DeleteRows = TRUE;
		$sWrkFilter = $academic_sessions->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in academic_sessions class, academic_sessionsinfo.php

		$academic_sessions->CurrentFilter = $sWrkFilter;
		$sSql = $academic_sessions->SQL();
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
				$DeleteRows = $academic_sessions->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['sessionID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($academic_sessions->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($academic_sessions->CancelMessage <> "") {
				$this->setMessage($academic_sessions->CancelMessage);
				$academic_sessions->CancelMessage = "";
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
				$academic_sessions->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $academic_sessions;

		// Call Recordset Selecting event
		$academic_sessions->Recordset_Selecting($academic_sessions->CurrentFilter);

		// Load List page SQL
		$sSql = $academic_sessions->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$academic_sessions->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_sessions;
		$sFilter = $academic_sessions->KeyFilter();

		// Call Row Selecting event
		$academic_sessions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_sessions->CurrentFilter = $sFilter;
		$sSql = $academic_sessions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_sessions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_sessions;
		$academic_sessions->sessionID->setDbValue($rs->fields('sessionID'));
		$academic_sessions->sessionName->setDbValue($rs->fields('sessionName'));
		$academic_sessions->sessionStart->setDbValue($rs->fields('sessionStart'));
		$academic_sessions->sessionEnd->setDbValue($rs->fields('sessionEnd'));
		$academic_sessions->currentSession->setDbValue($rs->fields('currentSession'));
		$academic_sessions->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_sessions;

		// Initialize URLs
		// Call Row_Rendering event

		$academic_sessions->Row_Rendering();

		// Common render codes for all row types
		// sessionID

		$academic_sessions->sessionID->CellCssStyle = ""; $academic_sessions->sessionID->CellCssClass = "";
		$academic_sessions->sessionID->CellAttrs = array(); $academic_sessions->sessionID->ViewAttrs = array(); $academic_sessions->sessionID->EditAttrs = array();

		// sessionName
		$academic_sessions->sessionName->CellCssStyle = ""; $academic_sessions->sessionName->CellCssClass = "";
		$academic_sessions->sessionName->CellAttrs = array(); $academic_sessions->sessionName->ViewAttrs = array(); $academic_sessions->sessionName->EditAttrs = array();

		// sessionStart
		$academic_sessions->sessionStart->CellCssStyle = ""; $academic_sessions->sessionStart->CellCssClass = "";
		$academic_sessions->sessionStart->CellAttrs = array(); $academic_sessions->sessionStart->ViewAttrs = array(); $academic_sessions->sessionStart->EditAttrs = array();

		// sessionEnd
		$academic_sessions->sessionEnd->CellCssStyle = ""; $academic_sessions->sessionEnd->CellCssClass = "";
		$academic_sessions->sessionEnd->CellAttrs = array(); $academic_sessions->sessionEnd->ViewAttrs = array(); $academic_sessions->sessionEnd->EditAttrs = array();

		// currentSession
		$academic_sessions->currentSession->CellCssStyle = ""; $academic_sessions->currentSession->CellCssClass = "";
		$academic_sessions->currentSession->CellAttrs = array(); $academic_sessions->currentSession->ViewAttrs = array(); $academic_sessions->currentSession->EditAttrs = array();

		// status
		$academic_sessions->status->CellCssStyle = ""; $academic_sessions->status->CellCssClass = "";
		$academic_sessions->status->CellAttrs = array(); $academic_sessions->status->ViewAttrs = array(); $academic_sessions->status->EditAttrs = array();
		if ($academic_sessions->RowType == EW_ROWTYPE_VIEW) { // View row

			// sessionID
			$academic_sessions->sessionID->ViewValue = $academic_sessions->sessionID->CurrentValue;
			$academic_sessions->sessionID->CssStyle = "";
			$academic_sessions->sessionID->CssClass = "";
			$academic_sessions->sessionID->ViewCustomAttributes = "";

			// sessionName
			$academic_sessions->sessionName->ViewValue = $academic_sessions->sessionName->CurrentValue;
			$academic_sessions->sessionName->CssStyle = "";
			$academic_sessions->sessionName->CssClass = "";
			$academic_sessions->sessionName->ViewCustomAttributes = "";

			// sessionStart
			$academic_sessions->sessionStart->ViewValue = $academic_sessions->sessionStart->CurrentValue;
			$academic_sessions->sessionStart->ViewValue = ew_FormatDateTime($academic_sessions->sessionStart->ViewValue, 5);
			$academic_sessions->sessionStart->CssStyle = "";
			$academic_sessions->sessionStart->CssClass = "";
			$academic_sessions->sessionStart->ViewCustomAttributes = "";

			// sessionEnd
			$academic_sessions->sessionEnd->ViewValue = $academic_sessions->sessionEnd->CurrentValue;
			$academic_sessions->sessionEnd->ViewValue = ew_FormatDateTime($academic_sessions->sessionEnd->ViewValue, 5);
			$academic_sessions->sessionEnd->CssStyle = "";
			$academic_sessions->sessionEnd->CssClass = "";
			$academic_sessions->sessionEnd->ViewCustomAttributes = "";

			// currentSession
			if (strval($academic_sessions->currentSession->CurrentValue) <> "") {
				switch ($academic_sessions->currentSession->CurrentValue) {
					case "Current Session":
						$academic_sessions->currentSession->ViewValue = "1";
						break;
					case "Not Current Session":
						$academic_sessions->currentSession->ViewValue = "0";
						break;
					default:
						$academic_sessions->currentSession->ViewValue = $academic_sessions->currentSession->CurrentValue;
				}
			} else {
				$academic_sessions->currentSession->ViewValue = NULL;
			}
			$academic_sessions->currentSession->CssStyle = "";
			$academic_sessions->currentSession->CssClass = "";
			$academic_sessions->currentSession->ViewCustomAttributes = "";

			// status
			if (strval($academic_sessions->status->CurrentValue) <> "") {
				switch ($academic_sessions->status->CurrentValue) {
					case "1":
						$academic_sessions->status->ViewValue = "Enabled";
						break;
					case "0":
						$academic_sessions->status->ViewValue = "Disabled";
						break;
					default:
						$academic_sessions->status->ViewValue = $academic_sessions->status->CurrentValue;
				}
			} else {
				$academic_sessions->status->ViewValue = NULL;
			}
			$academic_sessions->status->CssStyle = "";
			$academic_sessions->status->CssClass = "";
			$academic_sessions->status->ViewCustomAttributes = "";

			// sessionID
			$academic_sessions->sessionID->HrefValue = "";
			$academic_sessions->sessionID->TooltipValue = "";

			// sessionName
			$academic_sessions->sessionName->HrefValue = "";
			$academic_sessions->sessionName->TooltipValue = "";

			// sessionStart
			$academic_sessions->sessionStart->HrefValue = "";
			$academic_sessions->sessionStart->TooltipValue = "";

			// sessionEnd
			$academic_sessions->sessionEnd->HrefValue = "";
			$academic_sessions->sessionEnd->TooltipValue = "";

			// currentSession
			$academic_sessions->currentSession->HrefValue = "";
			$academic_sessions->currentSession->TooltipValue = "";

			// status
			$academic_sessions->status->HrefValue = "";
			$academic_sessions->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($academic_sessions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_sessions->Row_Rendered();
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
