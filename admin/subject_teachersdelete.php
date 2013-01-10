<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "subject_teachersinfo.php" ?>
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
$subject_teachers_delete = new csubject_teachers_delete();
$Page =& $subject_teachers_delete;

// Page init
$subject_teachers_delete->Page_Init();

// Page main
$subject_teachers_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var subject_teachers_delete = new ew_Page("subject_teachers_delete");

// page properties
subject_teachers_delete.PageID = "delete"; // page ID
subject_teachers_delete.FormID = "fsubject_teachersdelete"; // form ID
var EW_PAGE_ID = subject_teachers_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subject_teachers_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subject_teachers_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subject_teachers_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subject_teachers_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $subject_teachers_delete->LoadRecordset())
	$subject_teachers_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($subject_teachers_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$subject_teachers_delete->Page_Terminate("subject_teacherslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subject_teachers->TableCaption() ?><br><br>
<a href="<?php echo $subject_teachers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subject_teachers_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="subject_teachers">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($subject_teachers_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $subject_teachers->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $subject_teachers->subjectTeacherID->FldCaption() ?></td>
		<td valign="top"><?php echo $subject_teachers->subjectID->FldCaption() ?></td>
		<td valign="top"><?php echo $subject_teachers->subjectTeacher->FldCaption() ?></td>
		<td valign="top"><?php echo $subject_teachers->classroomID->FldCaption() ?></td>
		<td valign="top"><?php echo $subject_teachers->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$subject_teachers_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$subject_teachers_delete->lRecCnt++;

	// Set row properties
	$subject_teachers->CssClass = "";
	$subject_teachers->CssStyle = "";
	$subject_teachers->RowAttrs = array();
	$subject_teachers->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$subject_teachers_delete->LoadRowValues($rs);

	// Render row
	$subject_teachers_delete->RenderRow();
?>
	<tr<?php echo $subject_teachers->RowAttributes() ?>>
		<td<?php echo $subject_teachers->subjectTeacherID->CellAttributes() ?>>
<div<?php echo $subject_teachers->subjectTeacherID->ViewAttributes() ?>><?php echo $subject_teachers->subjectTeacherID->ListViewValue() ?></div></td>
		<td<?php echo $subject_teachers->subjectID->CellAttributes() ?>>
<div<?php echo $subject_teachers->subjectID->ViewAttributes() ?>><?php echo $subject_teachers->subjectID->ListViewValue() ?></div></td>
		<td<?php echo $subject_teachers->subjectTeacher->CellAttributes() ?>>
<div<?php echo $subject_teachers->subjectTeacher->ViewAttributes() ?>><?php echo $subject_teachers->subjectTeacher->ListViewValue() ?></div></td>
		<td<?php echo $subject_teachers->classroomID->CellAttributes() ?>>
<div<?php echo $subject_teachers->classroomID->ViewAttributes() ?>><?php echo $subject_teachers->classroomID->ListViewValue() ?></div></td>
		<td<?php echo $subject_teachers->status->CellAttributes() ?>>
<div<?php echo $subject_teachers->status->ViewAttributes() ?>><?php echo $subject_teachers->status->ListViewValue() ?></div></td>
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
$subject_teachers_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class csubject_teachers_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'subject_teachers';

	// Page object name
	var $PageObjName = 'subject_teachers_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $subject_teachers;
		if ($subject_teachers->UseTokenInUrl) $PageUrl .= "t=" . $subject_teachers->TableVar . "&"; // Add page token
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
		global $objForm, $subject_teachers;
		if ($subject_teachers->UseTokenInUrl) {
			if ($objForm)
				return ($subject_teachers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($subject_teachers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csubject_teachers_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subject_teachers)
		$GLOBALS["subject_teachers"] = new csubject_teachers();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subject_teachers', TRUE);

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
		global $subject_teachers;

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
		global $Language, $subject_teachers;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["subjectTeacherID"] <> "") {
			$subject_teachers->subjectTeacherID->setQueryStringValue($_GET["subjectTeacherID"]);
			if (!is_numeric($subject_teachers->subjectTeacherID->QueryStringValue))
				$this->Page_Terminate("subject_teacherslist.php"); // Prevent SQL injection, exit
			$sKey .= $subject_teachers->subjectTeacherID->QueryStringValue;
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
			$this->Page_Terminate("subject_teacherslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("subject_teacherslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`subjectTeacherID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in subject_teachers class, subject_teachersinfo.php

		$subject_teachers->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$subject_teachers->CurrentAction = $_POST["a_delete"];
		} else {
			$subject_teachers->CurrentAction = "I"; // Display record
		}
		switch ($subject_teachers->CurrentAction) {
			case "D": // Delete
				$subject_teachers->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($subject_teachers->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $subject_teachers;
		$DeleteRows = TRUE;
		$sWrkFilter = $subject_teachers->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in subject_teachers class, subject_teachersinfo.php

		$subject_teachers->CurrentFilter = $sWrkFilter;
		$sSql = $subject_teachers->SQL();
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
				$DeleteRows = $subject_teachers->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['subjectTeacherID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($subject_teachers->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($subject_teachers->CancelMessage <> "") {
				$this->setMessage($subject_teachers->CancelMessage);
				$subject_teachers->CancelMessage = "";
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
				$subject_teachers->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $subject_teachers;

		// Call Recordset Selecting event
		$subject_teachers->Recordset_Selecting($subject_teachers->CurrentFilter);

		// Load List page SQL
		$sSql = $subject_teachers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$subject_teachers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $subject_teachers;
		$sFilter = $subject_teachers->KeyFilter();

		// Call Row Selecting event
		$subject_teachers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$subject_teachers->CurrentFilter = $sFilter;
		$sSql = $subject_teachers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$subject_teachers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $subject_teachers;
		$subject_teachers->subjectTeacherID->setDbValue($rs->fields('subjectTeacherID'));
		$subject_teachers->subjectID->setDbValue($rs->fields('subjectID'));
		$subject_teachers->subjectTeacher->setDbValue($rs->fields('subjectTeacher'));
		$subject_teachers->classroomID->setDbValue($rs->fields('classroomID'));
		$subject_teachers->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $subject_teachers;

		// Initialize URLs
		// Call Row_Rendering event

		$subject_teachers->Row_Rendering();

		// Common render codes for all row types
		// subjectTeacherID

		$subject_teachers->subjectTeacherID->CellCssStyle = ""; $subject_teachers->subjectTeacherID->CellCssClass = "";
		$subject_teachers->subjectTeacherID->CellAttrs = array(); $subject_teachers->subjectTeacherID->ViewAttrs = array(); $subject_teachers->subjectTeacherID->EditAttrs = array();

		// subjectID
		$subject_teachers->subjectID->CellCssStyle = ""; $subject_teachers->subjectID->CellCssClass = "";
		$subject_teachers->subjectID->CellAttrs = array(); $subject_teachers->subjectID->ViewAttrs = array(); $subject_teachers->subjectID->EditAttrs = array();

		// subjectTeacher
		$subject_teachers->subjectTeacher->CellCssStyle = ""; $subject_teachers->subjectTeacher->CellCssClass = "";
		$subject_teachers->subjectTeacher->CellAttrs = array(); $subject_teachers->subjectTeacher->ViewAttrs = array(); $subject_teachers->subjectTeacher->EditAttrs = array();

		// classroomID
		$subject_teachers->classroomID->CellCssStyle = ""; $subject_teachers->classroomID->CellCssClass = "";
		$subject_teachers->classroomID->CellAttrs = array(); $subject_teachers->classroomID->ViewAttrs = array(); $subject_teachers->classroomID->EditAttrs = array();

		// status
		$subject_teachers->status->CellCssStyle = ""; $subject_teachers->status->CellCssClass = "";
		$subject_teachers->status->CellAttrs = array(); $subject_teachers->status->ViewAttrs = array(); $subject_teachers->status->EditAttrs = array();
		if ($subject_teachers->RowType == EW_ROWTYPE_VIEW) { // View row

			// subjectTeacherID
			$subject_teachers->subjectTeacherID->ViewValue = $subject_teachers->subjectTeacherID->CurrentValue;
			$subject_teachers->subjectTeacherID->CssStyle = "";
			$subject_teachers->subjectTeacherID->CssClass = "";
			$subject_teachers->subjectTeacherID->ViewCustomAttributes = "";

			// subjectID
			if (strval($subject_teachers->subjectID->CurrentValue) <> "") {
				$sFilterWrk = "`subjectID` = " . ew_AdjustSql($subject_teachers->subjectID->CurrentValue) . "";
			$sSqlWrk = "SELECT `subjectName`, `subjectDescription` FROM `subjects`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `subjectName` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subject_teachers->subjectID->ViewValue = $rswrk->fields('subjectName');
					$subject_teachers->subjectID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('subjectDescription');
					$rswrk->Close();
				} else {
					$subject_teachers->subjectID->ViewValue = $subject_teachers->subjectID->CurrentValue;
				}
			} else {
				$subject_teachers->subjectID->ViewValue = NULL;
			}
			$subject_teachers->subjectID->CssStyle = "";
			$subject_teachers->subjectID->CssClass = "";
			$subject_teachers->subjectID->ViewCustomAttributes = "";

			// subjectTeacher
			if (strval($subject_teachers->subjectTeacher->CurrentValue) <> "") {
				$sFilterWrk = "`teacherID` = " . ew_AdjustSql($subject_teachers->subjectTeacher->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `teachers`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subject_teachers->subjectTeacher->ViewValue = $rswrk->fields('firstname');
					$subject_teachers->subjectTeacher->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$subject_teachers->subjectTeacher->ViewValue = $subject_teachers->subjectTeacher->CurrentValue;
				}
			} else {
				$subject_teachers->subjectTeacher->ViewValue = NULL;
			}
			$subject_teachers->subjectTeacher->CssStyle = "";
			$subject_teachers->subjectTeacher->CssClass = "";
			$subject_teachers->subjectTeacher->ViewCustomAttributes = "";

			// classroomID
			if (strval($subject_teachers->classroomID->CurrentValue) <> "") {
				$sFilterWrk = "`classID` = " . ew_AdjustSql($subject_teachers->classroomID->CurrentValue) . "";
			$sSqlWrk = "SELECT `className`, `classTeacher` FROM `class_rooms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$subject_teachers->classroomID->ViewValue = $rswrk->fields('className');
					$subject_teachers->classroomID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('classTeacher');
					$rswrk->Close();
				} else {
					$subject_teachers->classroomID->ViewValue = $subject_teachers->classroomID->CurrentValue;
				}
			} else {
				$subject_teachers->classroomID->ViewValue = NULL;
			}
			$subject_teachers->classroomID->CssStyle = "";
			$subject_teachers->classroomID->CssClass = "";
			$subject_teachers->classroomID->ViewCustomAttributes = "";

			// status
			if (strval($subject_teachers->status->CurrentValue) <> "") {
				switch ($subject_teachers->status->CurrentValue) {
					case "1":
						$subject_teachers->status->ViewValue = "Enabled";
						break;
					case "0":
						$subject_teachers->status->ViewValue = "Disabled";
						break;
					default:
						$subject_teachers->status->ViewValue = $subject_teachers->status->CurrentValue;
				}
			} else {
				$subject_teachers->status->ViewValue = NULL;
			}
			$subject_teachers->status->CssStyle = "";
			$subject_teachers->status->CssClass = "";
			$subject_teachers->status->ViewCustomAttributes = "";

			// subjectTeacherID
			$subject_teachers->subjectTeacherID->HrefValue = "";
			$subject_teachers->subjectTeacherID->TooltipValue = "";

			// subjectID
			$subject_teachers->subjectID->HrefValue = "";
			$subject_teachers->subjectID->TooltipValue = "";

			// subjectTeacher
			$subject_teachers->subjectTeacher->HrefValue = "";
			$subject_teachers->subjectTeacher->TooltipValue = "";

			// classroomID
			$subject_teachers->classroomID->HrefValue = "";
			$subject_teachers->classroomID->TooltipValue = "";

			// status
			$subject_teachers->status->HrefValue = "";
			$subject_teachers->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($subject_teachers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$subject_teachers->Row_Rendered();
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
