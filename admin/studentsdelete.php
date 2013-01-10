<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "studentsinfo.php" ?>
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
$students_delete = new cstudents_delete();
$Page =& $students_delete;

// Page init
$students_delete->Page_Init();

// Page main
$students_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var students_delete = new ew_Page("students_delete");

// page properties
students_delete.PageID = "delete"; // page ID
students_delete.FormID = "fstudentsdelete"; // form ID
var EW_PAGE_ID = students_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
students_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
students_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
students_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
students_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $students_delete->LoadRecordset())
	$students_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($students_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$students_delete->Page_Terminate("studentslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $students->TableCaption() ?><br><br>
<a href="<?php echo $students->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$students_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="students">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($students_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $students->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $students->studentID->FldCaption() ?></td>
		<td valign="top"><?php echo $students->admissionNumber->FldCaption() ?></td>
		<td valign="top"><?php echo $students->firstname->FldCaption() ?></td>
		<td valign="top"><?php echo $students->middlename->FldCaption() ?></td>
		<td valign="top"><?php echo $students->lastname->FldCaption() ?></td>
		<td valign="top"><?php echo $students->gender->FldCaption() ?></td>
		<td valign="top"><?php echo $students->dob->FldCaption() ?></td>
		<td valign="top"><?php echo $students->residentState->FldCaption() ?></td>
		<td valign="top"><?php echo $students->stateOfOrigin->FldCaption() ?></td>
		<td valign="top"><?php echo $students->currentClass->FldCaption() ?></td>
		<td valign="top"><?php echo $students->parentID->FldCaption() ?></td>
		<td valign="top"><?php echo $students->feesCreditBalance->FldCaption() ?></td>
		<td valign="top"><?php echo $students->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$students_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$students_delete->lRecCnt++;

	// Set row properties
	$students->CssClass = "";
	$students->CssStyle = "";
	$students->RowAttrs = array();
	$students->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$students_delete->LoadRowValues($rs);

	// Render row
	$students_delete->RenderRow();
?>
	<tr<?php echo $students->RowAttributes() ?>>
		<td<?php echo $students->studentID->CellAttributes() ?>>
<div<?php echo $students->studentID->ViewAttributes() ?>><?php echo $students->studentID->ListViewValue() ?></div></td>
		<td<?php echo $students->admissionNumber->CellAttributes() ?>>
<div<?php echo $students->admissionNumber->ViewAttributes() ?>><?php echo $students->admissionNumber->ListViewValue() ?></div></td>
		<td<?php echo $students->firstname->CellAttributes() ?>>
<div<?php echo $students->firstname->ViewAttributes() ?>><?php echo $students->firstname->ListViewValue() ?></div></td>
		<td<?php echo $students->middlename->CellAttributes() ?>>
<div<?php echo $students->middlename->ViewAttributes() ?>><?php echo $students->middlename->ListViewValue() ?></div></td>
		<td<?php echo $students->lastname->CellAttributes() ?>>
<div<?php echo $students->lastname->ViewAttributes() ?>><?php echo $students->lastname->ListViewValue() ?></div></td>
		<td<?php echo $students->gender->CellAttributes() ?>>
<div<?php echo $students->gender->ViewAttributes() ?>><?php echo $students->gender->ListViewValue() ?></div></td>
		<td<?php echo $students->dob->CellAttributes() ?>>
<div<?php echo $students->dob->ViewAttributes() ?>><?php echo $students->dob->ListViewValue() ?></div></td>
		<td<?php echo $students->residentState->CellAttributes() ?>>
<div<?php echo $students->residentState->ViewAttributes() ?>><?php echo $students->residentState->ListViewValue() ?></div></td>
		<td<?php echo $students->stateOfOrigin->CellAttributes() ?>>
<div<?php echo $students->stateOfOrigin->ViewAttributes() ?>><?php echo $students->stateOfOrigin->ListViewValue() ?></div></td>
		<td<?php echo $students->currentClass->CellAttributes() ?>>
<div<?php echo $students->currentClass->ViewAttributes() ?>><?php echo $students->currentClass->ListViewValue() ?></div></td>
		<td<?php echo $students->parentID->CellAttributes() ?>>
<div<?php echo $students->parentID->ViewAttributes() ?>><?php echo $students->parentID->ListViewValue() ?></div></td>
		<td<?php echo $students->feesCreditBalance->CellAttributes() ?>>
<div<?php echo $students->feesCreditBalance->ViewAttributes() ?>><?php echo $students->feesCreditBalance->ListViewValue() ?></div></td>
		<td<?php echo $students->status->CellAttributes() ?>>
<div<?php echo $students->status->ViewAttributes() ?>><?php echo $students->status->ListViewValue() ?></div></td>
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
$students_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cstudents_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'students';

	// Page object name
	var $PageObjName = 'students_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $students;
		if ($students->UseTokenInUrl) $PageUrl .= "t=" . $students->TableVar . "&"; // Add page token
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
		global $objForm, $students;
		if ($students->UseTokenInUrl) {
			if ($objForm)
				return ($students->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($students->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstudents_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (students)
		$GLOBALS["students"] = new cstudents();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'students', TRUE);

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
		global $students;

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
		global $Language, $students;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["studentID"] <> "") {
			$students->studentID->setQueryStringValue($_GET["studentID"]);
			if (!is_numeric($students->studentID->QueryStringValue))
				$this->Page_Terminate("studentslist.php"); // Prevent SQL injection, exit
			$sKey .= $students->studentID->QueryStringValue;
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
			$this->Page_Terminate("studentslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("studentslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`studentID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in students class, studentsinfo.php

		$students->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$students->CurrentAction = $_POST["a_delete"];
		} else {
			$students->CurrentAction = "I"; // Display record
		}
		switch ($students->CurrentAction) {
			case "D": // Delete
				$students->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($students->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $students;
		$DeleteRows = TRUE;
		$sWrkFilter = $students->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in students class, studentsinfo.php

		$students->CurrentFilter = $sWrkFilter;
		$sSql = $students->SQL();
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
				$DeleteRows = $students->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['studentID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($students->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($students->CancelMessage <> "") {
				$this->setMessage($students->CancelMessage);
				$students->CancelMessage = "";
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
				$students->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $students;

		// Call Recordset Selecting event
		$students->Recordset_Selecting($students->CurrentFilter);

		// Load List page SQL
		$sSql = $students->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$students->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $students;
		$sFilter = $students->KeyFilter();

		// Call Row Selecting event
		$students->Row_Selecting($sFilter);

		// Load SQL based on filter
		$students->CurrentFilter = $sFilter;
		$sSql = $students->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$students->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $students;
		$students->studentID->setDbValue($rs->fields('studentID'));
		$students->admissionNumber->setDbValue($rs->fields('admissionNumber'));
		$students->firstname->setDbValue($rs->fields('firstname'));
		$students->middlename->setDbValue($rs->fields('middlename'));
		$students->lastname->setDbValue($rs->fields('lastname'));
		$students->gender->setDbValue($rs->fields('gender'));
		$students->dob->setDbValue($rs->fields('dob'));
		$students->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$students->residentState->setDbValue($rs->fields('residentState'));
		$students->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$students->currentClass->setDbValue($rs->fields('currentClass'));
		$students->portalUsername->setDbValue($rs->fields('portalUsername'));
		$students->portalPassword->setDbValue($rs->fields('portalPassword'));
		$students->parentID->setDbValue($rs->fields('parentID'));
		$students->studentImage->Upload->DbValue = $rs->fields('studentImage');
		$students->feesCreditBalance->setDbValue($rs->fields('feesCreditBalance'));
		$students->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $students;

		// Initialize URLs
		// Call Row_Rendering event

		$students->Row_Rendering();

		// Common render codes for all row types
		// studentID

		$students->studentID->CellCssStyle = ""; $students->studentID->CellCssClass = "";
		$students->studentID->CellAttrs = array(); $students->studentID->ViewAttrs = array(); $students->studentID->EditAttrs = array();

		// admissionNumber
		$students->admissionNumber->CellCssStyle = ""; $students->admissionNumber->CellCssClass = "";
		$students->admissionNumber->CellAttrs = array(); $students->admissionNumber->ViewAttrs = array(); $students->admissionNumber->EditAttrs = array();

		// firstname
		$students->firstname->CellCssStyle = ""; $students->firstname->CellCssClass = "";
		$students->firstname->CellAttrs = array(); $students->firstname->ViewAttrs = array(); $students->firstname->EditAttrs = array();

		// middlename
		$students->middlename->CellCssStyle = ""; $students->middlename->CellCssClass = "";
		$students->middlename->CellAttrs = array(); $students->middlename->ViewAttrs = array(); $students->middlename->EditAttrs = array();

		// lastname
		$students->lastname->CellCssStyle = ""; $students->lastname->CellCssClass = "";
		$students->lastname->CellAttrs = array(); $students->lastname->ViewAttrs = array(); $students->lastname->EditAttrs = array();

		// gender
		$students->gender->CellCssStyle = ""; $students->gender->CellCssClass = "";
		$students->gender->CellAttrs = array(); $students->gender->ViewAttrs = array(); $students->gender->EditAttrs = array();

		// dob
		$students->dob->CellCssStyle = ""; $students->dob->CellCssClass = "";
		$students->dob->CellAttrs = array(); $students->dob->ViewAttrs = array(); $students->dob->EditAttrs = array();

		// residentState
		$students->residentState->CellCssStyle = ""; $students->residentState->CellCssClass = "";
		$students->residentState->CellAttrs = array(); $students->residentState->ViewAttrs = array(); $students->residentState->EditAttrs = array();

		// stateOfOrigin
		$students->stateOfOrigin->CellCssStyle = ""; $students->stateOfOrigin->CellCssClass = "";
		$students->stateOfOrigin->CellAttrs = array(); $students->stateOfOrigin->ViewAttrs = array(); $students->stateOfOrigin->EditAttrs = array();

		// currentClass
		$students->currentClass->CellCssStyle = ""; $students->currentClass->CellCssClass = "";
		$students->currentClass->CellAttrs = array(); $students->currentClass->ViewAttrs = array(); $students->currentClass->EditAttrs = array();

		// parentID
		$students->parentID->CellCssStyle = ""; $students->parentID->CellCssClass = "";
		$students->parentID->CellAttrs = array(); $students->parentID->ViewAttrs = array(); $students->parentID->EditAttrs = array();

		// feesCreditBalance
		$students->feesCreditBalance->CellCssStyle = ""; $students->feesCreditBalance->CellCssClass = "";
		$students->feesCreditBalance->CellAttrs = array(); $students->feesCreditBalance->ViewAttrs = array(); $students->feesCreditBalance->EditAttrs = array();

		// status
		$students->status->CellCssStyle = ""; $students->status->CellCssClass = "";
		$students->status->CellAttrs = array(); $students->status->ViewAttrs = array(); $students->status->EditAttrs = array();
		if ($students->RowType == EW_ROWTYPE_VIEW) { // View row

			// studentID
			$students->studentID->ViewValue = $students->studentID->CurrentValue;
			$students->studentID->CssStyle = "";
			$students->studentID->CssClass = "";
			$students->studentID->ViewCustomAttributes = "";

			// admissionNumber
			$students->admissionNumber->ViewValue = $students->admissionNumber->CurrentValue;
			$students->admissionNumber->CssStyle = "";
			$students->admissionNumber->CssClass = "";
			$students->admissionNumber->ViewCustomAttributes = "";

			// firstname
			$students->firstname->ViewValue = $students->firstname->CurrentValue;
			$students->firstname->CssStyle = "";
			$students->firstname->CssClass = "";
			$students->firstname->ViewCustomAttributes = "";

			// middlename
			$students->middlename->ViewValue = $students->middlename->CurrentValue;
			$students->middlename->CssStyle = "";
			$students->middlename->CssClass = "";
			$students->middlename->ViewCustomAttributes = "";

			// lastname
			$students->lastname->ViewValue = $students->lastname->CurrentValue;
			$students->lastname->CssStyle = "";
			$students->lastname->CssClass = "";
			$students->lastname->ViewCustomAttributes = "";

			// gender
			if (strval($students->gender->CurrentValue) <> "") {
				switch ($students->gender->CurrentValue) {
					case "Male":
						$students->gender->ViewValue = "Male";
						break;
					case "Female":
						$students->gender->ViewValue = "Female";
						break;
					default:
						$students->gender->ViewValue = $students->gender->CurrentValue;
				}
			} else {
				$students->gender->ViewValue = NULL;
			}
			$students->gender->CssStyle = "";
			$students->gender->CssClass = "";
			$students->gender->ViewCustomAttributes = "";

			// dob
			$students->dob->ViewValue = $students->dob->CurrentValue;
			$students->dob->ViewValue = ew_FormatDateTime($students->dob->ViewValue, 5);
			$students->dob->CssStyle = "";
			$students->dob->CssClass = "";
			$students->dob->ViewCustomAttributes = "";

			// residentState
			$students->residentState->ViewValue = $students->residentState->CurrentValue;
			$students->residentState->CssStyle = "";
			$students->residentState->CssClass = "";
			$students->residentState->ViewCustomAttributes = "";

			// stateOfOrigin
			$students->stateOfOrigin->ViewValue = $students->stateOfOrigin->CurrentValue;
			$students->stateOfOrigin->CssStyle = "";
			$students->stateOfOrigin->CssClass = "";
			$students->stateOfOrigin->ViewCustomAttributes = "";

			// currentClass
			if (strval($students->currentClass->CurrentValue) <> "") {
				$sFilterWrk = "`classID` = " . ew_AdjustSql($students->currentClass->CurrentValue) . "";
			$sSqlWrk = "SELECT `className`, `classTeacher` FROM `class_rooms`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$students->currentClass->ViewValue = $rswrk->fields('className');
					$students->currentClass->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('classTeacher');
					$rswrk->Close();
				} else {
					$students->currentClass->ViewValue = $students->currentClass->CurrentValue;
				}
			} else {
				$students->currentClass->ViewValue = NULL;
			}
			$students->currentClass->CssStyle = "";
			$students->currentClass->CssClass = "";
			$students->currentClass->ViewCustomAttributes = "";

			// parentID
			if (strval($students->parentID->CurrentValue) <> "") {
				$sFilterWrk = "`parentID` = " . ew_AdjustSql($students->parentID->CurrentValue) . "";
			$sSqlWrk = "SELECT `firstname`, `lastname` FROM `parents`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$students->parentID->ViewValue = $rswrk->fields('firstname');
					$students->parentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
					$rswrk->Close();
				} else {
					$students->parentID->ViewValue = $students->parentID->CurrentValue;
				}
			} else {
				$students->parentID->ViewValue = NULL;
			}
			$students->parentID->CssStyle = "";
			$students->parentID->CssClass = "";
			$students->parentID->ViewCustomAttributes = "";

			// feesCreditBalance
			$students->feesCreditBalance->ViewValue = $students->feesCreditBalance->CurrentValue;
			$students->feesCreditBalance->CssStyle = "";
			$students->feesCreditBalance->CssClass = "";
			$students->feesCreditBalance->ViewCustomAttributes = "";

			// status
			if (strval($students->status->CurrentValue) <> "") {
				switch ($students->status->CurrentValue) {
					case "1":
						$students->status->ViewValue = "Enabled";
						break;
					case "0":
						$students->status->ViewValue = "Disabled";
						break;
					default:
						$students->status->ViewValue = $students->status->CurrentValue;
				}
			} else {
				$students->status->ViewValue = NULL;
			}
			$students->status->CssStyle = "";
			$students->status->CssClass = "";
			$students->status->ViewCustomAttributes = "";

			// studentID
			$students->studentID->HrefValue = "";
			$students->studentID->TooltipValue = "";

			// admissionNumber
			$students->admissionNumber->HrefValue = "";
			$students->admissionNumber->TooltipValue = "";

			// firstname
			$students->firstname->HrefValue = "";
			$students->firstname->TooltipValue = "";

			// middlename
			$students->middlename->HrefValue = "";
			$students->middlename->TooltipValue = "";

			// lastname
			$students->lastname->HrefValue = "";
			$students->lastname->TooltipValue = "";

			// gender
			$students->gender->HrefValue = "";
			$students->gender->TooltipValue = "";

			// dob
			$students->dob->HrefValue = "";
			$students->dob->TooltipValue = "";

			// residentState
			$students->residentState->HrefValue = "";
			$students->residentState->TooltipValue = "";

			// stateOfOrigin
			$students->stateOfOrigin->HrefValue = "";
			$students->stateOfOrigin->TooltipValue = "";

			// currentClass
			$students->currentClass->HrefValue = "";
			$students->currentClass->TooltipValue = "";

			// parentID
			$students->parentID->HrefValue = "";
			$students->parentID->TooltipValue = "";

			// feesCreditBalance
			$students->feesCreditBalance->HrefValue = "";
			$students->feesCreditBalance->TooltipValue = "";

			// status
			$students->status->HrefValue = "";
			$students->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($students->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$students->Row_Rendered();
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
