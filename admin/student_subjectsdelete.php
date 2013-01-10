<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "student_subjectsinfo.php" ?>
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
$student_subjects_delete = new cstudent_subjects_delete();
$Page =& $student_subjects_delete;

// Page init
$student_subjects_delete->Page_Init();

// Page main
$student_subjects_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var student_subjects_delete = new ew_Page("student_subjects_delete");

// page properties
student_subjects_delete.PageID = "delete"; // page ID
student_subjects_delete.FormID = "fstudent_subjectsdelete"; // form ID
var EW_PAGE_ID = student_subjects_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
student_subjects_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
student_subjects_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
student_subjects_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
student_subjects_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $student_subjects_delete->LoadRecordset())
	$student_subjects_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($student_subjects_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$student_subjects_delete->Page_Terminate("student_subjectslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $student_subjects->TableCaption() ?><br><br>
<a href="<?php echo $student_subjects->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$student_subjects_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="student_subjects">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($student_subjects_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $student_subjects->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $student_subjects->studentSubjectID->FldCaption() ?></td>
		<td valign="top"><?php echo $student_subjects->studentID->FldCaption() ?></td>
		<td valign="top"><?php echo $student_subjects->subjectTeacherID->FldCaption() ?></td>
		<td valign="top"><?php echo $student_subjects->termID->FldCaption() ?></td>
		<td valign="top"><?php echo $student_subjects->vClassID->FldCaption() ?></td>
		<td valign="top"><?php echo $student_subjects->caScore->FldCaption() ?></td>
		<td valign="top"><?php echo $student_subjects->examScore->FldCaption() ?></td>
		<td valign="top"><?php echo $student_subjects->grade->FldCaption() ?></td>
		<td valign="top"><?php echo $student_subjects->comments->FldCaption() ?></td>
		<td valign="top"><?php echo $student_subjects->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$student_subjects_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$student_subjects_delete->lRecCnt++;

	// Set row properties
	$student_subjects->CssClass = "";
	$student_subjects->CssStyle = "";
	$student_subjects->RowAttrs = array();
	$student_subjects->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$student_subjects_delete->LoadRowValues($rs);

	// Render row
	$student_subjects_delete->RenderRow();
?>
	<tr<?php echo $student_subjects->RowAttributes() ?>>
		<td<?php echo $student_subjects->studentSubjectID->CellAttributes() ?>>
<div<?php echo $student_subjects->studentSubjectID->ViewAttributes() ?>><?php echo $student_subjects->studentSubjectID->ListViewValue() ?></div></td>
		<td<?php echo $student_subjects->studentID->CellAttributes() ?>>
<div<?php echo $student_subjects->studentID->ViewAttributes() ?>><?php echo $student_subjects->studentID->ListViewValue() ?></div></td>
		<td<?php echo $student_subjects->subjectTeacherID->CellAttributes() ?>>
</td>
		<td<?php echo $student_subjects->termID->CellAttributes() ?>>
<div<?php echo $student_subjects->termID->ViewAttributes() ?>><?php echo $student_subjects->termID->ListViewValue() ?></div></td>
		<td<?php echo $student_subjects->vClassID->CellAttributes() ?>>
<div<?php echo $student_subjects->vClassID->ViewAttributes() ?>><?php echo $student_subjects->vClassID->ListViewValue() ?></div></td>
		<td<?php echo $student_subjects->caScore->CellAttributes() ?>>
<div<?php echo $student_subjects->caScore->ViewAttributes() ?>><?php echo $student_subjects->caScore->ListViewValue() ?></div></td>
		<td<?php echo $student_subjects->examScore->CellAttributes() ?>>
<div<?php echo $student_subjects->examScore->ViewAttributes() ?>><?php echo $student_subjects->examScore->ListViewValue() ?></div></td>
		<td<?php echo $student_subjects->grade->CellAttributes() ?>>
<div<?php echo $student_subjects->grade->ViewAttributes() ?>><?php echo $student_subjects->grade->ListViewValue() ?></div></td>
		<td<?php echo $student_subjects->comments->CellAttributes() ?>>
<div<?php echo $student_subjects->comments->ViewAttributes() ?>><?php echo $student_subjects->comments->ListViewValue() ?></div></td>
		<td<?php echo $student_subjects->status->CellAttributes() ?>>
<div<?php echo $student_subjects->status->ViewAttributes() ?>><?php echo $student_subjects->status->ListViewValue() ?></div></td>
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
$student_subjects_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudent_subjects_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'student_subjects';

	// Page object name
	var $PageObjName = 'student_subjects_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $student_subjects;
		if ($student_subjects->UseTokenInUrl) $PageUrl .= "t=" . $student_subjects->TableVar . "&"; // Add page token
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
		global $objForm, $student_subjects;
		if ($student_subjects->UseTokenInUrl) {
			if ($objForm)
				return ($student_subjects->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($student_subjects->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudent_subjects_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (student_subjects)
		$GLOBALS["student_subjects"] = new cstudent_subjects();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'student_subjects', TRUE);

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
		global $student_subjects;

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
		global $Language, $student_subjects;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["studentSubjectID"] <> "") {
			$student_subjects->studentSubjectID->setQueryStringValue($_GET["studentSubjectID"]);
			if (!is_numeric($student_subjects->studentSubjectID->QueryStringValue))
				$this->Page_Terminate("student_subjectslist.php"); // Prevent SQL injection, exit
			$sKey .= $student_subjects->studentSubjectID->QueryStringValue;
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
			$this->Page_Terminate("student_subjectslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("student_subjectslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`studentSubjectID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in student_subjects class, student_subjectsinfo.php

		$student_subjects->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$student_subjects->CurrentAction = $_POST["a_delete"];
		} else {
			$student_subjects->CurrentAction = "I"; // Display record
		}
		switch ($student_subjects->CurrentAction) {
			case "D": // Delete
				$student_subjects->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($student_subjects->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $student_subjects;
		$DeleteRows = TRUE;
		$sWrkFilter = $student_subjects->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in student_subjects class, student_subjectsinfo.php

		$student_subjects->CurrentFilter = $sWrkFilter;
		$sSql = $student_subjects->SQL();
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
				$DeleteRows = $student_subjects->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['studentSubjectID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($student_subjects->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($student_subjects->CancelMessage <> "") {
				$this->setMessage($student_subjects->CancelMessage);
				$student_subjects->CancelMessage = "";
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
				$student_subjects->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $student_subjects;

		// Call Recordset Selecting event
		$student_subjects->Recordset_Selecting($student_subjects->CurrentFilter);

		// Load List page SQL
		$sSql = $student_subjects->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$student_subjects->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $student_subjects;
		$sFilter = $student_subjects->KeyFilter();

		// Call Row Selecting event
		$student_subjects->Row_Selecting($sFilter);

		// Load SQL based on filter
		$student_subjects->CurrentFilter = $sFilter;
		$sSql = $student_subjects->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$student_subjects->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $student_subjects;
		$student_subjects->studentSubjectID->setDbValue($rs->fields('studentSubjectID'));
		$student_subjects->studentID->setDbValue($rs->fields('studentID'));
		$student_subjects->subjectTeacherID->setDbValue($rs->fields('subjectTeacherID'));
		$student_subjects->termID->setDbValue($rs->fields('termID'));
		$student_subjects->vClassID->setDbValue($rs->fields('vClassID'));
		$student_subjects->caScore->setDbValue($rs->fields('caScore'));
		$student_subjects->examScore->setDbValue($rs->fields('examScore'));
		$student_subjects->grade->setDbValue($rs->fields('grade'));
		$student_subjects->comments->setDbValue($rs->fields('comments'));
		$student_subjects->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $student_subjects;

		// Initialize URLs
		// Call Row_Rendering event

		$student_subjects->Row_Rendering();

		// Common render codes for all row types
		// studentSubjectID

		$student_subjects->studentSubjectID->CellCssStyle = ""; $student_subjects->studentSubjectID->CellCssClass = "";
		$student_subjects->studentSubjectID->CellAttrs = array(); $student_subjects->studentSubjectID->ViewAttrs = array(); $student_subjects->studentSubjectID->EditAttrs = array();

		// studentID
		$student_subjects->studentID->CellCssStyle = ""; $student_subjects->studentID->CellCssClass = "";
		$student_subjects->studentID->CellAttrs = array(); $student_subjects->studentID->ViewAttrs = array(); $student_subjects->studentID->EditAttrs = array();

		// subjectTeacherID
		$student_subjects->subjectTeacherID->CellCssStyle = ""; $student_subjects->subjectTeacherID->CellCssClass = "";
		$student_subjects->subjectTeacherID->CellAttrs = array(); $student_subjects->subjectTeacherID->ViewAttrs = array(); $student_subjects->subjectTeacherID->EditAttrs = array();

		// termID
		$student_subjects->termID->CellCssStyle = ""; $student_subjects->termID->CellCssClass = "";
		$student_subjects->termID->CellAttrs = array(); $student_subjects->termID->ViewAttrs = array(); $student_subjects->termID->EditAttrs = array();

		// vClassID
		$student_subjects->vClassID->CellCssStyle = ""; $student_subjects->vClassID->CellCssClass = "";
		$student_subjects->vClassID->CellAttrs = array(); $student_subjects->vClassID->ViewAttrs = array(); $student_subjects->vClassID->EditAttrs = array();

		// caScore
		$student_subjects->caScore->CellCssStyle = ""; $student_subjects->caScore->CellCssClass = "";
		$student_subjects->caScore->CellAttrs = array(); $student_subjects->caScore->ViewAttrs = array(); $student_subjects->caScore->EditAttrs = array();

		// examScore
		$student_subjects->examScore->CellCssStyle = ""; $student_subjects->examScore->CellCssClass = "";
		$student_subjects->examScore->CellAttrs = array(); $student_subjects->examScore->ViewAttrs = array(); $student_subjects->examScore->EditAttrs = array();

		// grade
		$student_subjects->grade->CellCssStyle = ""; $student_subjects->grade->CellCssClass = "";
		$student_subjects->grade->CellAttrs = array(); $student_subjects->grade->ViewAttrs = array(); $student_subjects->grade->EditAttrs = array();

		// comments
		$student_subjects->comments->CellCssStyle = ""; $student_subjects->comments->CellCssClass = "";
		$student_subjects->comments->CellAttrs = array(); $student_subjects->comments->ViewAttrs = array(); $student_subjects->comments->EditAttrs = array();

		// status
		$student_subjects->status->CellCssStyle = ""; $student_subjects->status->CellCssClass = "";
		$student_subjects->status->CellAttrs = array(); $student_subjects->status->ViewAttrs = array(); $student_subjects->status->EditAttrs = array();
		if ($student_subjects->RowType == EW_ROWTYPE_VIEW) { // View row

			// studentSubjectID
			$student_subjects->studentSubjectID->ViewValue = $student_subjects->studentSubjectID->CurrentValue;
			$student_subjects->studentSubjectID->CssStyle = "";
			$student_subjects->studentSubjectID->CssClass = "";
			$student_subjects->studentSubjectID->ViewCustomAttributes = "";

			// studentID
			if (strval($student_subjects->studentID->CurrentValue) <> "") {
				$sFilterWrk = "`studentID` = " . ew_AdjustSql($student_subjects->studentID->CurrentValue) . "";
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
					$student_subjects->studentID->ViewValue = $rswrk->fields('firstname');
					$student_subjects->studentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$student_subjects->studentID->ViewValue = $student_subjects->studentID->CurrentValue;
				}
			} else {
				$student_subjects->studentID->ViewValue = NULL;
			}
			$student_subjects->studentID->CssStyle = "";
			$student_subjects->studentID->CssClass = "";
			$student_subjects->studentID->ViewCustomAttributes = "";

			// subjectTeacherID
			$student_subjects->subjectTeacherID->CssStyle = "";
			$student_subjects->subjectTeacherID->CssClass = "";
			$student_subjects->subjectTeacherID->ViewCustomAttributes = "";

			// termID
			$student_subjects->termID->ViewValue = $student_subjects->termID->CurrentValue;
			$student_subjects->termID->CssStyle = "";
			$student_subjects->termID->CssClass = "";
			$student_subjects->termID->ViewCustomAttributes = "";

			// vClassID
			$student_subjects->vClassID->ViewValue = $student_subjects->vClassID->CurrentValue;
			$student_subjects->vClassID->CssStyle = "";
			$student_subjects->vClassID->CssClass = "";
			$student_subjects->vClassID->ViewCustomAttributes = "";

			// caScore
			$student_subjects->caScore->ViewValue = $student_subjects->caScore->CurrentValue;
			$student_subjects->caScore->CssStyle = "";
			$student_subjects->caScore->CssClass = "";
			$student_subjects->caScore->ViewCustomAttributes = "";

			// examScore
			$student_subjects->examScore->ViewValue = $student_subjects->examScore->CurrentValue;
			$student_subjects->examScore->CssStyle = "";
			$student_subjects->examScore->CssClass = "";
			$student_subjects->examScore->ViewCustomAttributes = "";

			// grade
			$student_subjects->grade->ViewValue = $student_subjects->grade->CurrentValue;
			$student_subjects->grade->CssStyle = "";
			$student_subjects->grade->CssClass = "";
			$student_subjects->grade->ViewCustomAttributes = "";

			// comments
			$student_subjects->comments->ViewValue = $student_subjects->comments->CurrentValue;
			$student_subjects->comments->CssStyle = "";
			$student_subjects->comments->CssClass = "";
			$student_subjects->comments->ViewCustomAttributes = "";

			// status
			if (strval($student_subjects->status->CurrentValue) <> "") {
				switch ($student_subjects->status->CurrentValue) {
					case "1":
						$student_subjects->status->ViewValue = "Enabled";
						break;
					case "0":
						$student_subjects->status->ViewValue = "Disabled";
						break;
					default:
						$student_subjects->status->ViewValue = $student_subjects->status->CurrentValue;
				}
			} else {
				$student_subjects->status->ViewValue = NULL;
			}
			$student_subjects->status->CssStyle = "";
			$student_subjects->status->CssClass = "";
			$student_subjects->status->ViewCustomAttributes = "";

			// studentSubjectID
			$student_subjects->studentSubjectID->HrefValue = "";
			$student_subjects->studentSubjectID->TooltipValue = "";

			// studentID
			$student_subjects->studentID->HrefValue = "";
			$student_subjects->studentID->TooltipValue = "";

			// subjectTeacherID
			$student_subjects->subjectTeacherID->HrefValue = "";
			$student_subjects->subjectTeacherID->TooltipValue = "";

			// termID
			$student_subjects->termID->HrefValue = "";
			$student_subjects->termID->TooltipValue = "";

			// vClassID
			$student_subjects->vClassID->HrefValue = "";
			$student_subjects->vClassID->TooltipValue = "";

			// caScore
			$student_subjects->caScore->HrefValue = "";
			$student_subjects->caScore->TooltipValue = "";

			// examScore
			$student_subjects->examScore->HrefValue = "";
			$student_subjects->examScore->TooltipValue = "";

			// grade
			$student_subjects->grade->HrefValue = "";
			$student_subjects->grade->TooltipValue = "";

			// comments
			$student_subjects->comments->HrefValue = "";
			$student_subjects->comments->TooltipValue = "";

			// status
			$student_subjects->status->HrefValue = "";
			$student_subjects->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($student_subjects->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$student_subjects->Row_Rendered();
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
