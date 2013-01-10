<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "class_roomsinfo.php" ?>
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
$class_rooms_delete = new cclass_rooms_delete();
$Page =& $class_rooms_delete;

// Page init
$class_rooms_delete->Page_Init();

// Page main
$class_rooms_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var class_rooms_delete = new ew_Page("class_rooms_delete");

// page properties
class_rooms_delete.PageID = "delete"; // page ID
class_rooms_delete.FormID = "fclass_roomsdelete"; // form ID
var EW_PAGE_ID = class_rooms_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
class_rooms_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
class_rooms_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
class_rooms_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
class_rooms_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $class_rooms_delete->LoadRecordset())
	$class_rooms_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($class_rooms_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$class_rooms_delete->Page_Terminate("class_roomslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $class_rooms->TableCaption() ?><br><br>
<a href="<?php echo $class_rooms->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$class_rooms_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="class_rooms">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($class_rooms_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $class_rooms->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $class_rooms->classID->FldCaption() ?></td>
		<td valign="top"><?php echo $class_rooms->classLevelID->FldCaption() ?></td>
		<td valign="top"><?php echo $class_rooms->className->FldCaption() ?></td>
		<td valign="top"><?php echo $class_rooms->classTeacher->FldCaption() ?></td>
		<td valign="top"><?php echo $class_rooms->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$class_rooms_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$class_rooms_delete->lRecCnt++;

	// Set row properties
	$class_rooms->CssClass = "";
	$class_rooms->CssStyle = "";
	$class_rooms->RowAttrs = array();
	$class_rooms->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$class_rooms_delete->LoadRowValues($rs);

	// Render row
	$class_rooms_delete->RenderRow();
?>
	<tr<?php echo $class_rooms->RowAttributes() ?>>
		<td<?php echo $class_rooms->classID->CellAttributes() ?>>
<div<?php echo $class_rooms->classID->ViewAttributes() ?>><?php echo $class_rooms->classID->ListViewValue() ?></div></td>
		<td<?php echo $class_rooms->classLevelID->CellAttributes() ?>>
<div<?php echo $class_rooms->classLevelID->ViewAttributes() ?>><?php echo $class_rooms->classLevelID->ListViewValue() ?></div></td>
		<td<?php echo $class_rooms->className->CellAttributes() ?>>
<div<?php echo $class_rooms->className->ViewAttributes() ?>><?php echo $class_rooms->className->ListViewValue() ?></div></td>
		<td<?php echo $class_rooms->classTeacher->CellAttributes() ?>>
<div<?php echo $class_rooms->classTeacher->ViewAttributes() ?>><?php echo $class_rooms->classTeacher->ListViewValue() ?></div></td>
		<td<?php echo $class_rooms->status->CellAttributes() ?>>
<div<?php echo $class_rooms->status->ViewAttributes() ?>><?php echo $class_rooms->status->ListViewValue() ?></div></td>
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
$class_rooms_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cclass_rooms_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'class_rooms';

	// Page object name
	var $PageObjName = 'class_rooms_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $class_rooms;
		if ($class_rooms->UseTokenInUrl) $PageUrl .= "t=" . $class_rooms->TableVar . "&"; // Add page token
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
		global $objForm, $class_rooms;
		if ($class_rooms->UseTokenInUrl) {
			if ($objForm)
				return ($class_rooms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($class_rooms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cclass_rooms_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (class_rooms)
		$GLOBALS["class_rooms"] = new cclass_rooms();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'class_rooms', TRUE);

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
		global $class_rooms;

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
		global $Language, $class_rooms;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["classID"] <> "") {
			$class_rooms->classID->setQueryStringValue($_GET["classID"]);
			if (!is_numeric($class_rooms->classID->QueryStringValue))
				$this->Page_Terminate("class_roomslist.php"); // Prevent SQL injection, exit
			$sKey .= $class_rooms->classID->QueryStringValue;
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
			$this->Page_Terminate("class_roomslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("class_roomslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`classID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in class_rooms class, class_roomsinfo.php

		$class_rooms->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$class_rooms->CurrentAction = $_POST["a_delete"];
		} else {
			$class_rooms->CurrentAction = "I"; // Display record
		}
		switch ($class_rooms->CurrentAction) {
			case "D": // Delete
				$class_rooms->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($class_rooms->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $class_rooms;
		$DeleteRows = TRUE;
		$sWrkFilter = $class_rooms->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in class_rooms class, class_roomsinfo.php

		$class_rooms->CurrentFilter = $sWrkFilter;
		$sSql = $class_rooms->SQL();
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
				$DeleteRows = $class_rooms->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['classID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($class_rooms->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($class_rooms->CancelMessage <> "") {
				$this->setMessage($class_rooms->CancelMessage);
				$class_rooms->CancelMessage = "";
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
				$class_rooms->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $class_rooms;

		// Call Recordset Selecting event
		$class_rooms->Recordset_Selecting($class_rooms->CurrentFilter);

		// Load List page SQL
		$sSql = $class_rooms->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$class_rooms->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $class_rooms;
		$sFilter = $class_rooms->KeyFilter();

		// Call Row Selecting event
		$class_rooms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$class_rooms->CurrentFilter = $sFilter;
		$sSql = $class_rooms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$class_rooms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $class_rooms;
		$class_rooms->classID->setDbValue($rs->fields('classID'));
		$class_rooms->classLevelID->setDbValue($rs->fields('classLevelID'));
		$class_rooms->className->setDbValue($rs->fields('className'));
		$class_rooms->classTeacher->setDbValue($rs->fields('classTeacher'));
		$class_rooms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $class_rooms;

		// Initialize URLs
		// Call Row_Rendering event

		$class_rooms->Row_Rendering();

		// Common render codes for all row types
		// classID

		$class_rooms->classID->CellCssStyle = ""; $class_rooms->classID->CellCssClass = "";
		$class_rooms->classID->CellAttrs = array(); $class_rooms->classID->ViewAttrs = array(); $class_rooms->classID->EditAttrs = array();

		// classLevelID
		$class_rooms->classLevelID->CellCssStyle = ""; $class_rooms->classLevelID->CellCssClass = "";
		$class_rooms->classLevelID->CellAttrs = array(); $class_rooms->classLevelID->ViewAttrs = array(); $class_rooms->classLevelID->EditAttrs = array();

		// className
		$class_rooms->className->CellCssStyle = ""; $class_rooms->className->CellCssClass = "";
		$class_rooms->className->CellAttrs = array(); $class_rooms->className->ViewAttrs = array(); $class_rooms->className->EditAttrs = array();

		// classTeacher
		$class_rooms->classTeacher->CellCssStyle = ""; $class_rooms->classTeacher->CellCssClass = "";
		$class_rooms->classTeacher->CellAttrs = array(); $class_rooms->classTeacher->ViewAttrs = array(); $class_rooms->classTeacher->EditAttrs = array();

		// status
		$class_rooms->status->CellCssStyle = ""; $class_rooms->status->CellCssClass = "";
		$class_rooms->status->CellAttrs = array(); $class_rooms->status->ViewAttrs = array(); $class_rooms->status->EditAttrs = array();
		if ($class_rooms->RowType == EW_ROWTYPE_VIEW) { // View row

			// classID
			$class_rooms->classID->ViewValue = $class_rooms->classID->CurrentValue;
			$class_rooms->classID->CssStyle = "";
			$class_rooms->classID->CssClass = "";
			$class_rooms->classID->ViewCustomAttributes = "";

			// classLevelID
			if (strval($class_rooms->classLevelID->CurrentValue) <> "") {
				$sFilterWrk = "`classLevelID` = " . ew_AdjustSql($class_rooms->classLevelID->CurrentValue) . "";
			$sSqlWrk = "SELECT `classLevel` FROM `class_levels`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$class_rooms->classLevelID->ViewValue = $rswrk->fields('classLevel');
					$rswrk->Close();
				} else {
					$class_rooms->classLevelID->ViewValue = $class_rooms->classLevelID->CurrentValue;
				}
			} else {
				$class_rooms->classLevelID->ViewValue = NULL;
			}
			$class_rooms->classLevelID->CssStyle = "";
			$class_rooms->classLevelID->CssClass = "";
			$class_rooms->classLevelID->ViewCustomAttributes = "";

			// className
			$class_rooms->className->ViewValue = $class_rooms->className->CurrentValue;
			$class_rooms->className->CssStyle = "";
			$class_rooms->className->CssClass = "";
			$class_rooms->className->ViewCustomAttributes = "";

			// classTeacher
			if (strval($class_rooms->classTeacher->CurrentValue) <> "") {
				$sFilterWrk = "`teacherID` = " . ew_AdjustSql($class_rooms->classTeacher->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `teachers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `lastname` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$class_rooms->classTeacher->ViewValue = $rswrk->fields('firstname');
					$class_rooms->classTeacher->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$class_rooms->classTeacher->ViewValue = $class_rooms->classTeacher->CurrentValue;
				}
			} else {
				$class_rooms->classTeacher->ViewValue = NULL;
			}
			$class_rooms->classTeacher->CssStyle = "";
			$class_rooms->classTeacher->CssClass = "";
			$class_rooms->classTeacher->ViewCustomAttributes = "";

			// status
			if (strval($class_rooms->status->CurrentValue) <> "") {
				switch ($class_rooms->status->CurrentValue) {
					case "1":
						$class_rooms->status->ViewValue = "Enabled";
						break;
					case "0":
						$class_rooms->status->ViewValue = "Disabled";
						break;
					default:
						$class_rooms->status->ViewValue = $class_rooms->status->CurrentValue;
				}
			} else {
				$class_rooms->status->ViewValue = NULL;
			}
			$class_rooms->status->CssStyle = "";
			$class_rooms->status->CssClass = "";
			$class_rooms->status->ViewCustomAttributes = "";

			// classID
			$class_rooms->classID->HrefValue = "";
			$class_rooms->classID->TooltipValue = "";

			// classLevelID
			$class_rooms->classLevelID->HrefValue = "";
			$class_rooms->classLevelID->TooltipValue = "";

			// className
			$class_rooms->className->HrefValue = "";
			$class_rooms->className->TooltipValue = "";

			// classTeacher
			$class_rooms->classTeacher->HrefValue = "";
			$class_rooms->classTeacher->TooltipValue = "";

			// status
			$class_rooms->status->HrefValue = "";
			$class_rooms->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($class_rooms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$class_rooms->Row_Rendered();
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
