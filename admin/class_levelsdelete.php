<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "class_levelsinfo.php" ?>
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
$class_levels_delete = new cclass_levels_delete();
$Page =& $class_levels_delete;

// Page init
$class_levels_delete->Page_Init();

// Page main
$class_levels_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var class_levels_delete = new ew_Page("class_levels_delete");

// page properties
class_levels_delete.PageID = "delete"; // page ID
class_levels_delete.FormID = "fclass_levelsdelete"; // form ID
var EW_PAGE_ID = class_levels_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
class_levels_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
class_levels_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
class_levels_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
class_levels_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $class_levels_delete->LoadRecordset())
	$class_levels_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($class_levels_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$class_levels_delete->Page_Terminate("class_levelslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $class_levels->TableCaption() ?><br><br>
<a href="<?php echo $class_levels->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$class_levels_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="class_levels">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($class_levels_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $class_levels->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $class_levels->classLevelID->FldCaption() ?></td>
		<td valign="top"><?php echo $class_levels->classLevel->FldCaption() ?></td>
		<td valign="top"><?php echo $class_levels->classOrder->FldCaption() ?></td>
		<td valign="top"><?php echo $class_levels->schoolFees->FldCaption() ?></td>
		<td valign="top"><?php echo $class_levels->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$class_levels_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$class_levels_delete->lRecCnt++;

	// Set row properties
	$class_levels->CssClass = "";
	$class_levels->CssStyle = "";
	$class_levels->RowAttrs = array();
	$class_levels->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$class_levels_delete->LoadRowValues($rs);

	// Render row
	$class_levels_delete->RenderRow();
?>
	<tr<?php echo $class_levels->RowAttributes() ?>>
		<td<?php echo $class_levels->classLevelID->CellAttributes() ?>>
<div<?php echo $class_levels->classLevelID->ViewAttributes() ?>><?php echo $class_levels->classLevelID->ListViewValue() ?></div></td>
		<td<?php echo $class_levels->classLevel->CellAttributes() ?>>
<div<?php echo $class_levels->classLevel->ViewAttributes() ?>><?php echo $class_levels->classLevel->ListViewValue() ?></div></td>
		<td<?php echo $class_levels->classOrder->CellAttributes() ?>>
<div<?php echo $class_levels->classOrder->ViewAttributes() ?>><?php echo $class_levels->classOrder->ListViewValue() ?></div></td>
		<td<?php echo $class_levels->schoolFees->CellAttributes() ?>>
<div<?php echo $class_levels->schoolFees->ViewAttributes() ?>><?php echo $class_levels->schoolFees->ListViewValue() ?></div></td>
		<td<?php echo $class_levels->status->CellAttributes() ?>>
<div<?php echo $class_levels->status->ViewAttributes() ?>><?php echo $class_levels->status->ListViewValue() ?></div></td>
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
$class_levels_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cclass_levels_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'class_levels';

	// Page object name
	var $PageObjName = 'class_levels_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $class_levels;
		if ($class_levels->UseTokenInUrl) $PageUrl .= "t=" . $class_levels->TableVar . "&"; // Add page token
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
		global $objForm, $class_levels;
		if ($class_levels->UseTokenInUrl) {
			if ($objForm)
				return ($class_levels->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($class_levels->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclass_levels_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (class_levels)
		$GLOBALS["class_levels"] = new cclass_levels();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'class_levels', TRUE);

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
		global $class_levels;

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
		global $Language, $class_levels;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["classLevelID"] <> "") {
			$class_levels->classLevelID->setQueryStringValue($_GET["classLevelID"]);
			if (!is_numeric($class_levels->classLevelID->QueryStringValue))
				$this->Page_Terminate("class_levelslist.php"); // Prevent SQL injection, exit
			$sKey .= $class_levels->classLevelID->QueryStringValue;
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
			$this->Page_Terminate("class_levelslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("class_levelslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`classLevelID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in class_levels class, class_levelsinfo.php

		$class_levels->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$class_levels->CurrentAction = $_POST["a_delete"];
		} else {
			$class_levels->CurrentAction = "I"; // Display record
		}
		switch ($class_levels->CurrentAction) {
			case "D": // Delete
				$class_levels->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($class_levels->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $class_levels;
		$DeleteRows = TRUE;
		$sWrkFilter = $class_levels->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in class_levels class, class_levelsinfo.php

		$class_levels->CurrentFilter = $sWrkFilter;
		$sSql = $class_levels->SQL();
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
				$DeleteRows = $class_levels->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['classLevelID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($class_levels->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($class_levels->CancelMessage <> "") {
				$this->setMessage($class_levels->CancelMessage);
				$class_levels->CancelMessage = "";
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
				$class_levels->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $class_levels;

		// Call Recordset Selecting event
		$class_levels->Recordset_Selecting($class_levels->CurrentFilter);

		// Load List page SQL
		$sSql = $class_levels->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$class_levels->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $class_levels;
		$sFilter = $class_levels->KeyFilter();

		// Call Row Selecting event
		$class_levels->Row_Selecting($sFilter);

		// Load SQL based on filter
		$class_levels->CurrentFilter = $sFilter;
		$sSql = $class_levels->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$class_levels->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $class_levels;
		$class_levels->classLevelID->setDbValue($rs->fields('classLevelID'));
		$class_levels->classLevel->setDbValue($rs->fields('classLevel'));
		$class_levels->classOrder->setDbValue($rs->fields('classOrder'));
		$class_levels->schoolFees->setDbValue($rs->fields('schoolFees'));
		$class_levels->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $class_levels;

		// Initialize URLs
		// Call Row_Rendering event

		$class_levels->Row_Rendering();

		// Common render codes for all row types
		// classLevelID

		$class_levels->classLevelID->CellCssStyle = ""; $class_levels->classLevelID->CellCssClass = "";
		$class_levels->classLevelID->CellAttrs = array(); $class_levels->classLevelID->ViewAttrs = array(); $class_levels->classLevelID->EditAttrs = array();

		// classLevel
		$class_levels->classLevel->CellCssStyle = ""; $class_levels->classLevel->CellCssClass = "";
		$class_levels->classLevel->CellAttrs = array(); $class_levels->classLevel->ViewAttrs = array(); $class_levels->classLevel->EditAttrs = array();

		// classOrder
		$class_levels->classOrder->CellCssStyle = ""; $class_levels->classOrder->CellCssClass = "";
		$class_levels->classOrder->CellAttrs = array(); $class_levels->classOrder->ViewAttrs = array(); $class_levels->classOrder->EditAttrs = array();

		// schoolFees
		$class_levels->schoolFees->CellCssStyle = ""; $class_levels->schoolFees->CellCssClass = "";
		$class_levels->schoolFees->CellAttrs = array(); $class_levels->schoolFees->ViewAttrs = array(); $class_levels->schoolFees->EditAttrs = array();

		// status
		$class_levels->status->CellCssStyle = ""; $class_levels->status->CellCssClass = "";
		$class_levels->status->CellAttrs = array(); $class_levels->status->ViewAttrs = array(); $class_levels->status->EditAttrs = array();
		if ($class_levels->RowType == EW_ROWTYPE_VIEW) { // View row

			// classLevelID
			$class_levels->classLevelID->ViewValue = $class_levels->classLevelID->CurrentValue;
			$class_levels->classLevelID->CssStyle = "";
			$class_levels->classLevelID->CssClass = "";
			$class_levels->classLevelID->ViewCustomAttributes = "";

			// classLevel
			$class_levels->classLevel->ViewValue = $class_levels->classLevel->CurrentValue;
			$class_levels->classLevel->CssStyle = "";
			$class_levels->classLevel->CssClass = "";
			$class_levels->classLevel->ViewCustomAttributes = "";

			// classOrder
			$class_levels->classOrder->ViewValue = $class_levels->classOrder->CurrentValue;
			$class_levels->classOrder->CssStyle = "";
			$class_levels->classOrder->CssClass = "";
			$class_levels->classOrder->ViewCustomAttributes = "";

			// schoolFees
			$class_levels->schoolFees->ViewValue = $class_levels->schoolFees->CurrentValue;
			$class_levels->schoolFees->CssStyle = "";
			$class_levels->schoolFees->CssClass = "";
			$class_levels->schoolFees->ViewCustomAttributes = "";

			// status
			if (strval($class_levels->status->CurrentValue) <> "") {
				switch ($class_levels->status->CurrentValue) {
					case "1":
						$class_levels->status->ViewValue = "Enabled";
						break;
					case "0":
						$class_levels->status->ViewValue = "Disabled";
						break;
					default:
						$class_levels->status->ViewValue = $class_levels->status->CurrentValue;
				}
			} else {
				$class_levels->status->ViewValue = NULL;
			}
			$class_levels->status->CssStyle = "";
			$class_levels->status->CssClass = "";
			$class_levels->status->ViewCustomAttributes = "";

			// classLevelID
			$class_levels->classLevelID->HrefValue = "";
			$class_levels->classLevelID->TooltipValue = "";

			// classLevel
			$class_levels->classLevel->HrefValue = "";
			$class_levels->classLevel->TooltipValue = "";

			// classOrder
			$class_levels->classOrder->HrefValue = "";
			$class_levels->classOrder->TooltipValue = "";

			// schoolFees
			$class_levels->schoolFees->HrefValue = "";
			$class_levels->schoolFees->TooltipValue = "";

			// status
			$class_levels->status->HrefValue = "";
			$class_levels->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($class_levels->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$class_levels->Row_Rendered();
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
