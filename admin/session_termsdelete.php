<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "session_termsinfo.php" ?>
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
$session_terms_delete = new csession_terms_delete();
$Page =& $session_terms_delete;

// Page init
$session_terms_delete->Page_Init();

// Page main
$session_terms_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var session_terms_delete = new ew_Page("session_terms_delete");

// page properties
session_terms_delete.PageID = "delete"; // page ID
session_terms_delete.FormID = "fsession_termsdelete"; // form ID
var EW_PAGE_ID = session_terms_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
session_terms_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
session_terms_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
session_terms_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
session_terms_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $session_terms_delete->LoadRecordset())
	$session_terms_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($session_terms_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$session_terms_delete->Page_Terminate("session_termslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $session_terms->TableCaption() ?><br><br>
<a href="<?php echo $session_terms->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$session_terms_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="session_terms">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($session_terms_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $session_terms->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $session_terms->sessionTermID->FldCaption() ?></td>
		<td valign="top"><?php echo $session_terms->session->FldCaption() ?></td>
		<td valign="top"><?php echo $session_terms->termID->FldCaption() ?></td>
		<td valign="top"><?php echo $session_terms->termStart->FldCaption() ?></td>
		<td valign="top"><?php echo $session_terms->termEnd->FldCaption() ?></td>
		<td valign="top"><?php echo $session_terms->currentTerm->FldCaption() ?></td>
		<td valign="top"><?php echo $session_terms->showResults->FldCaption() ?></td>
		<td valign="top"><?php echo $session_terms->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$session_terms_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$session_terms_delete->lRecCnt++;

	// Set row properties
	$session_terms->CssClass = "";
	$session_terms->CssStyle = "";
	$session_terms->RowAttrs = array();
	$session_terms->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$session_terms_delete->LoadRowValues($rs);

	// Render row
	$session_terms_delete->RenderRow();
?>
	<tr<?php echo $session_terms->RowAttributes() ?>>
		<td<?php echo $session_terms->sessionTermID->CellAttributes() ?>>
<div<?php echo $session_terms->sessionTermID->ViewAttributes() ?>><?php echo $session_terms->sessionTermID->ListViewValue() ?></div></td>
		<td<?php echo $session_terms->session->CellAttributes() ?>>
<div<?php echo $session_terms->session->ViewAttributes() ?>><?php echo $session_terms->session->ListViewValue() ?></div></td>
		<td<?php echo $session_terms->termID->CellAttributes() ?>>
<div<?php echo $session_terms->termID->ViewAttributes() ?>><?php echo $session_terms->termID->ListViewValue() ?></div></td>
		<td<?php echo $session_terms->termStart->CellAttributes() ?>>
<div<?php echo $session_terms->termStart->ViewAttributes() ?>><?php echo $session_terms->termStart->ListViewValue() ?></div></td>
		<td<?php echo $session_terms->termEnd->CellAttributes() ?>>
<div<?php echo $session_terms->termEnd->ViewAttributes() ?>><?php echo $session_terms->termEnd->ListViewValue() ?></div></td>
		<td<?php echo $session_terms->currentTerm->CellAttributes() ?>>
<div<?php echo $session_terms->currentTerm->ViewAttributes() ?>><?php echo $session_terms->currentTerm->ListViewValue() ?></div></td>
		<td<?php echo $session_terms->showResults->CellAttributes() ?>>
<div<?php echo $session_terms->showResults->ViewAttributes() ?>><?php echo $session_terms->showResults->ListViewValue() ?></div></td>
		<td<?php echo $session_terms->status->CellAttributes() ?>>
<div<?php echo $session_terms->status->ViewAttributes() ?>><?php echo $session_terms->status->ListViewValue() ?></div></td>
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
$session_terms_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csession_terms_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'session_terms';

	// Page object name
	var $PageObjName = 'session_terms_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $session_terms;
		if ($session_terms->UseTokenInUrl) $PageUrl .= "t=" . $session_terms->TableVar . "&"; // Add page token
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
		global $objForm, $session_terms;
		if ($session_terms->UseTokenInUrl) {
			if ($objForm)
				return ($session_terms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($session_terms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csession_terms_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (session_terms)
		$GLOBALS["session_terms"] = new csession_terms();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'session_terms', TRUE);

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
		global $session_terms;

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
		global $Language, $session_terms;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["sessionTermID"] <> "") {
			$session_terms->sessionTermID->setQueryStringValue($_GET["sessionTermID"]);
			if (!is_numeric($session_terms->sessionTermID->QueryStringValue))
				$this->Page_Terminate("session_termslist.php"); // Prevent SQL injection, exit
			$sKey .= $session_terms->sessionTermID->QueryStringValue;
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
			$this->Page_Terminate("session_termslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("session_termslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`sessionTermID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in session_terms class, session_termsinfo.php

		$session_terms->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$session_terms->CurrentAction = $_POST["a_delete"];
		} else {
			$session_terms->CurrentAction = "I"; // Display record
		}
		switch ($session_terms->CurrentAction) {
			case "D": // Delete
				$session_terms->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($session_terms->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $session_terms;
		$DeleteRows = TRUE;
		$sWrkFilter = $session_terms->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in session_terms class, session_termsinfo.php

		$session_terms->CurrentFilter = $sWrkFilter;
		$sSql = $session_terms->SQL();
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
				$DeleteRows = $session_terms->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['sessionTermID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($session_terms->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($session_terms->CancelMessage <> "") {
				$this->setMessage($session_terms->CancelMessage);
				$session_terms->CancelMessage = "";
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
				$session_terms->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $session_terms;

		// Call Recordset Selecting event
		$session_terms->Recordset_Selecting($session_terms->CurrentFilter);

		// Load List page SQL
		$sSql = $session_terms->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$session_terms->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $session_terms;
		$sFilter = $session_terms->KeyFilter();

		// Call Row Selecting event
		$session_terms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$session_terms->CurrentFilter = $sFilter;
		$sSql = $session_terms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$session_terms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $session_terms;
		$session_terms->sessionTermID->setDbValue($rs->fields('sessionTermID'));
		$session_terms->session->setDbValue($rs->fields('session'));
		$session_terms->termID->setDbValue($rs->fields('termID'));
		$session_terms->termStart->setDbValue($rs->fields('termStart'));
		$session_terms->termEnd->setDbValue($rs->fields('termEnd'));
		$session_terms->currentTerm->setDbValue($rs->fields('currentTerm'));
		$session_terms->showResults->setDbValue($rs->fields('showResults'));
		$session_terms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $session_terms;

		// Initialize URLs
		// Call Row_Rendering event

		$session_terms->Row_Rendering();

		// Common render codes for all row types
		// sessionTermID

		$session_terms->sessionTermID->CellCssStyle = ""; $session_terms->sessionTermID->CellCssClass = "";
		$session_terms->sessionTermID->CellAttrs = array(); $session_terms->sessionTermID->ViewAttrs = array(); $session_terms->sessionTermID->EditAttrs = array();

		// session
		$session_terms->session->CellCssStyle = ""; $session_terms->session->CellCssClass = "";
		$session_terms->session->CellAttrs = array(); $session_terms->session->ViewAttrs = array(); $session_terms->session->EditAttrs = array();

		// termID
		$session_terms->termID->CellCssStyle = ""; $session_terms->termID->CellCssClass = "";
		$session_terms->termID->CellAttrs = array(); $session_terms->termID->ViewAttrs = array(); $session_terms->termID->EditAttrs = array();

		// termStart
		$session_terms->termStart->CellCssStyle = ""; $session_terms->termStart->CellCssClass = "";
		$session_terms->termStart->CellAttrs = array(); $session_terms->termStart->ViewAttrs = array(); $session_terms->termStart->EditAttrs = array();

		// termEnd
		$session_terms->termEnd->CellCssStyle = ""; $session_terms->termEnd->CellCssClass = "";
		$session_terms->termEnd->CellAttrs = array(); $session_terms->termEnd->ViewAttrs = array(); $session_terms->termEnd->EditAttrs = array();

		// currentTerm
		$session_terms->currentTerm->CellCssStyle = ""; $session_terms->currentTerm->CellCssClass = "";
		$session_terms->currentTerm->CellAttrs = array(); $session_terms->currentTerm->ViewAttrs = array(); $session_terms->currentTerm->EditAttrs = array();

		// showResults
		$session_terms->showResults->CellCssStyle = ""; $session_terms->showResults->CellCssClass = "";
		$session_terms->showResults->CellAttrs = array(); $session_terms->showResults->ViewAttrs = array(); $session_terms->showResults->EditAttrs = array();

		// status
		$session_terms->status->CellCssStyle = ""; $session_terms->status->CellCssClass = "";
		$session_terms->status->CellAttrs = array(); $session_terms->status->ViewAttrs = array(); $session_terms->status->EditAttrs = array();
		if ($session_terms->RowType == EW_ROWTYPE_VIEW) { // View row

			// sessionTermID
			$session_terms->sessionTermID->ViewValue = $session_terms->sessionTermID->CurrentValue;
			$session_terms->sessionTermID->CssStyle = "";
			$session_terms->sessionTermID->CssClass = "";
			$session_terms->sessionTermID->ViewCustomAttributes = "";

			// session
			if (strval($session_terms->session->CurrentValue) <> "") {
				$sFilterWrk = "`sessionID` = " . ew_AdjustSql($session_terms->session->CurrentValue) . "";
			$sSqlWrk = "SELECT `sessionName` FROM `academic_sessions`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$session_terms->session->ViewValue = $rswrk->fields('sessionName');
					$rswrk->Close();
				} else {
					$session_terms->session->ViewValue = $session_terms->session->CurrentValue;
				}
			} else {
				$session_terms->session->ViewValue = NULL;
			}
			$session_terms->session->CssStyle = "";
			$session_terms->session->CssClass = "";
			$session_terms->session->ViewCustomAttributes = "";

			// termID
			if (strval($session_terms->termID->CurrentValue) <> "") {
				$sFilterWrk = "`termID` = " . ew_AdjustSql($session_terms->termID->CurrentValue) . "";
			$sSqlWrk = "SELECT `termName` FROM `academic_terms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$session_terms->termID->ViewValue = $rswrk->fields('termName');
					$rswrk->Close();
				} else {
					$session_terms->termID->ViewValue = $session_terms->termID->CurrentValue;
				}
			} else {
				$session_terms->termID->ViewValue = NULL;
			}
			$session_terms->termID->CssStyle = "";
			$session_terms->termID->CssClass = "";
			$session_terms->termID->ViewCustomAttributes = "";

			// termStart
			$session_terms->termStart->ViewValue = $session_terms->termStart->CurrentValue;
			$session_terms->termStart->ViewValue = ew_FormatDateTime($session_terms->termStart->ViewValue, 5);
			$session_terms->termStart->CssStyle = "";
			$session_terms->termStart->CssClass = "";
			$session_terms->termStart->ViewCustomAttributes = "";

			// termEnd
			$session_terms->termEnd->ViewValue = $session_terms->termEnd->CurrentValue;
			$session_terms->termEnd->ViewValue = ew_FormatDateTime($session_terms->termEnd->ViewValue, 5);
			$session_terms->termEnd->CssStyle = "";
			$session_terms->termEnd->CssClass = "";
			$session_terms->termEnd->ViewCustomAttributes = "";

			// currentTerm
			if (strval($session_terms->currentTerm->CurrentValue) <> "") {
				switch ($session_terms->currentTerm->CurrentValue) {
					case "1":
						$session_terms->currentTerm->ViewValue = "Yes";
						break;
					case "0":
						$session_terms->currentTerm->ViewValue = "No";
						break;
					default:
						$session_terms->currentTerm->ViewValue = $session_terms->currentTerm->CurrentValue;
				}
			} else {
				$session_terms->currentTerm->ViewValue = NULL;
			}
			$session_terms->currentTerm->CssStyle = "";
			$session_terms->currentTerm->CssClass = "";
			$session_terms->currentTerm->ViewCustomAttributes = "";

			// showResults
			if (strval($session_terms->showResults->CurrentValue) <> "") {
				switch ($session_terms->showResults->CurrentValue) {
					case "1":
						$session_terms->showResults->ViewValue = "Yes";
						break;
					case "0":
						$session_terms->showResults->ViewValue = "No";
						break;
					default:
						$session_terms->showResults->ViewValue = $session_terms->showResults->CurrentValue;
				}
			} else {
				$session_terms->showResults->ViewValue = NULL;
			}
			$session_terms->showResults->CssStyle = "";
			$session_terms->showResults->CssClass = "";
			$session_terms->showResults->ViewCustomAttributes = "";

			// status
			if (strval($session_terms->status->CurrentValue) <> "") {
				switch ($session_terms->status->CurrentValue) {
					case "1":
						$session_terms->status->ViewValue = "Enabled";
						break;
					case "0":
						$session_terms->status->ViewValue = "Disabled";
						break;
					default:
						$session_terms->status->ViewValue = $session_terms->status->CurrentValue;
				}
			} else {
				$session_terms->status->ViewValue = NULL;
			}
			$session_terms->status->CssStyle = "";
			$session_terms->status->CssClass = "";
			$session_terms->status->ViewCustomAttributes = "";

			// sessionTermID
			$session_terms->sessionTermID->HrefValue = "";
			$session_terms->sessionTermID->TooltipValue = "";

			// session
			$session_terms->session->HrefValue = "";
			$session_terms->session->TooltipValue = "";

			// termID
			$session_terms->termID->HrefValue = "";
			$session_terms->termID->TooltipValue = "";

			// termStart
			$session_terms->termStart->HrefValue = "";
			$session_terms->termStart->TooltipValue = "";

			// termEnd
			$session_terms->termEnd->HrefValue = "";
			$session_terms->termEnd->TooltipValue = "";

			// currentTerm
			$session_terms->currentTerm->HrefValue = "";
			$session_terms->currentTerm->TooltipValue = "";

			// showResults
			$session_terms->showResults->HrefValue = "";
			$session_terms->showResults->TooltipValue = "";

			// status
			$session_terms->status->HrefValue = "";
			$session_terms->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($session_terms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$session_terms->Row_Rendered();
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
