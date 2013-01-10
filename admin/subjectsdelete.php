<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "subjectsinfo.php" ?>
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
$subjects_delete = new csubjects_delete();
$Page =& $subjects_delete;

// Page init
$subjects_delete->Page_Init();

// Page main
$subjects_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subjects_delete = new ew_Page("subjects_delete");

// page properties
subjects_delete.PageID = "delete"; // page ID
subjects_delete.FormID = "fsubjectsdelete"; // form ID
var EW_PAGE_ID = subjects_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subjects_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subjects_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subjects_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subjects_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $subjects_delete->LoadRecordset())
	$subjects_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($subjects_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$subjects_delete->Page_Terminate("subjectslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subjects->TableCaption() ?><br><br>
<a href="<?php echo $subjects->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subjects_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="subjects">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($subjects_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $subjects->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $subjects->subjectID->FldCaption() ?></td>
		<td valign="top"><?php echo $subjects->subjectName->FldCaption() ?></td>
		<td valign="top"><?php echo $subjects->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$subjects_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$subjects_delete->lRecCnt++;

	// Set row properties
	$subjects->CssClass = "";
	$subjects->CssStyle = "";
	$subjects->RowAttrs = array();
	$subjects->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$subjects_delete->LoadRowValues($rs);

	// Render row
	$subjects_delete->RenderRow();
?>
	<tr<?php echo $subjects->RowAttributes() ?>>
		<td<?php echo $subjects->subjectID->CellAttributes() ?>>
<div<?php echo $subjects->subjectID->ViewAttributes() ?>><?php echo $subjects->subjectID->ListViewValue() ?></div></td>
		<td<?php echo $subjects->subjectName->CellAttributes() ?>>
<div<?php echo $subjects->subjectName->ViewAttributes() ?>><?php echo $subjects->subjectName->ListViewValue() ?></div></td>
		<td<?php echo $subjects->status->CellAttributes() ?>>
<div<?php echo $subjects->status->ViewAttributes() ?>><?php echo $subjects->status->ListViewValue() ?></div></td>
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
$subjects_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csubjects_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'subjects';

	// Page object name
	var $PageObjName = 'subjects_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subjects;
		if ($subjects->UseTokenInUrl) $PageUrl .= "t=" . $subjects->TableVar . "&"; // Add page token
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
		global $objForm, $subjects;
		if ($subjects->UseTokenInUrl) {
			if ($objForm)
				return ($subjects->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subjects->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubjects_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subjects)
		$GLOBALS["subjects"] = new csubjects();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subjects', TRUE);

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
		global $subjects;

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
		global $Language, $subjects;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["subjectID"] <> "") {
			$subjects->subjectID->setQueryStringValue($_GET["subjectID"]);
			if (!is_numeric($subjects->subjectID->QueryStringValue))
				$this->Page_Terminate("subjectslist.php"); // Prevent SQL injection, exit
			$sKey .= $subjects->subjectID->QueryStringValue;
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
			$this->Page_Terminate("subjectslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("subjectslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`subjectID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in subjects class, subjectsinfo.php

		$subjects->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$subjects->CurrentAction = $_POST["a_delete"];
		} else {
			$subjects->CurrentAction = "I"; // Display record
		}
		switch ($subjects->CurrentAction) {
			case "D": // Delete
				$subjects->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($subjects->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $subjects;
		$DeleteRows = TRUE;
		$sWrkFilter = $subjects->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in subjects class, subjectsinfo.php

		$subjects->CurrentFilter = $sWrkFilter;
		$sSql = $subjects->SQL();
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
				$DeleteRows = $subjects->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['subjectID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($subjects->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($subjects->CancelMessage <> "") {
				$this->setMessage($subjects->CancelMessage);
				$subjects->CancelMessage = "";
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
				$subjects->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subjects;

		// Call Recordset Selecting event
		$subjects->Recordset_Selecting($subjects->CurrentFilter);

		// Load List page SQL
		$sSql = $subjects->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subjects->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subjects;
		$sFilter = $subjects->KeyFilter();

		// Call Row Selecting event
		$subjects->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subjects->CurrentFilter = $sFilter;
		$sSql = $subjects->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subjects->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subjects;
		$subjects->subjectID->setDbValue($rs->fields('subjectID'));
		$subjects->subjectName->setDbValue($rs->fields('subjectName'));
		$subjects->subjectDescription->setDbValue($rs->fields('subjectDescription'));
		$subjects->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subjects;

		// Initialize URLs
		// Call Row_Rendering event

		$subjects->Row_Rendering();

		// Common render codes for all row types
		// subjectID

		$subjects->subjectID->CellCssStyle = ""; $subjects->subjectID->CellCssClass = "";
		$subjects->subjectID->CellAttrs = array(); $subjects->subjectID->ViewAttrs = array(); $subjects->subjectID->EditAttrs = array();

		// subjectName
		$subjects->subjectName->CellCssStyle = ""; $subjects->subjectName->CellCssClass = "";
		$subjects->subjectName->CellAttrs = array(); $subjects->subjectName->ViewAttrs = array(); $subjects->subjectName->EditAttrs = array();

		// status
		$subjects->status->CellCssStyle = ""; $subjects->status->CellCssClass = "";
		$subjects->status->CellAttrs = array(); $subjects->status->ViewAttrs = array(); $subjects->status->EditAttrs = array();
		if ($subjects->RowType == EW_ROWTYPE_VIEW) { // View row

			// subjectID
			$subjects->subjectID->ViewValue = $subjects->subjectID->CurrentValue;
			$subjects->subjectID->CssStyle = "";
			$subjects->subjectID->CssClass = "";
			$subjects->subjectID->ViewCustomAttributes = "";

			// subjectName
			$subjects->subjectName->ViewValue = $subjects->subjectName->CurrentValue;
			$subjects->subjectName->CssStyle = "";
			$subjects->subjectName->CssClass = "";
			$subjects->subjectName->ViewCustomAttributes = "";

			// status
			if (strval($subjects->status->CurrentValue) <> "") {
				switch ($subjects->status->CurrentValue) {
					case "1":
						$subjects->status->ViewValue = "Enabled";
						break;
					case "0":
						$subjects->status->ViewValue = "Disabled";
						break;
					default:
						$subjects->status->ViewValue = $subjects->status->CurrentValue;
				}
			} else {
				$subjects->status->ViewValue = NULL;
			}
			$subjects->status->CssStyle = "";
			$subjects->status->CssClass = "";
			$subjects->status->ViewCustomAttributes = "";

			// subjectID
			$subjects->subjectID->HrefValue = "";
			$subjects->subjectID->TooltipValue = "";

			// subjectName
			$subjects->subjectName->HrefValue = "";
			$subjects->subjectName->TooltipValue = "";

			// status
			$subjects->status->HrefValue = "";
			$subjects->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subjects->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subjects->Row_Rendered();
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
