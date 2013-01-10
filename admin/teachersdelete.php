<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "teachersinfo.php" ?>
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
$teachers_delete = new cteachers_delete();
$Page =& $teachers_delete;

// Page init
$teachers_delete->Page_Init();

// Page main
$teachers_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var teachers_delete = new ew_Page("teachers_delete");

// page properties
teachers_delete.PageID = "delete"; // page ID
teachers_delete.FormID = "fteachersdelete"; // form ID
var EW_PAGE_ID = teachers_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
teachers_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
teachers_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
teachers_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
teachers_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $teachers_delete->LoadRecordset())
	$teachers_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($teachers_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$teachers_delete->Page_Terminate("teacherslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $teachers->TableCaption() ?><br><br>
<a href="<?php echo $teachers->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$teachers_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="teachers">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($teachers_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $teachers->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $teachers->teacherID->FldCaption() ?></td>
		<td valign="top"><?php echo $teachers->firstname->FldCaption() ?></td>
		<td valign="top"><?php echo $teachers->middlename->FldCaption() ?></td>
		<td valign="top"><?php echo $teachers->lastname->FldCaption() ?></td>
		<td valign="top"><?php echo $teachers->qualification->FldCaption() ?></td>
		<td valign="top"><?php echo $teachers->stateOfOrigin->FldCaption() ?></td>
		<td valign="top"><?php echo $teachers->zemail->FldCaption() ?></td>
		<td valign="top"><?php echo $teachers->username->FldCaption() ?></td>
		<td valign="top"><?php echo $teachers->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$teachers_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$teachers_delete->lRecCnt++;

	// Set row properties
	$teachers->CssClass = "";
	$teachers->CssStyle = "";
	$teachers->RowAttrs = array();
	$teachers->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$teachers_delete->LoadRowValues($rs);

	// Render row
	$teachers_delete->RenderRow();
?>
	<tr<?php echo $teachers->RowAttributes() ?>>
		<td<?php echo $teachers->teacherID->CellAttributes() ?>>
<div<?php echo $teachers->teacherID->ViewAttributes() ?>><?php echo $teachers->teacherID->ListViewValue() ?></div></td>
		<td<?php echo $teachers->firstname->CellAttributes() ?>>
<div<?php echo $teachers->firstname->ViewAttributes() ?>><?php echo $teachers->firstname->ListViewValue() ?></div></td>
		<td<?php echo $teachers->middlename->CellAttributes() ?>>
<div<?php echo $teachers->middlename->ViewAttributes() ?>><?php echo $teachers->middlename->ListViewValue() ?></div></td>
		<td<?php echo $teachers->lastname->CellAttributes() ?>>
<div<?php echo $teachers->lastname->ViewAttributes() ?>><?php echo $teachers->lastname->ListViewValue() ?></div></td>
		<td<?php echo $teachers->qualification->CellAttributes() ?>>
<div<?php echo $teachers->qualification->ViewAttributes() ?>><?php echo $teachers->qualification->ListViewValue() ?></div></td>
		<td<?php echo $teachers->stateOfOrigin->CellAttributes() ?>>
<div<?php echo $teachers->stateOfOrigin->ViewAttributes() ?>><?php echo $teachers->stateOfOrigin->ListViewValue() ?></div></td>
		<td<?php echo $teachers->zemail->CellAttributes() ?>>
<div<?php echo $teachers->zemail->ViewAttributes() ?>><?php echo $teachers->zemail->ListViewValue() ?></div></td>
		<td<?php echo $teachers->username->CellAttributes() ?>>
<div<?php echo $teachers->username->ViewAttributes() ?>><?php echo $teachers->username->ListViewValue() ?></div></td>
		<td<?php echo $teachers->status->CellAttributes() ?>>
<div<?php echo $teachers->status->ViewAttributes() ?>><?php echo $teachers->status->ListViewValue() ?></div></td>
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
$teachers_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cteachers_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'teachers';

	// Page object name
	var $PageObjName = 'teachers_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $teachers;
		if ($teachers->UseTokenInUrl) $PageUrl .= "t=" . $teachers->TableVar . "&"; // Add page token
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
		global $objForm, $teachers;
		if ($teachers->UseTokenInUrl) {
			if ($objForm)
				return ($teachers->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($teachers->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cteachers_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (teachers)
		$GLOBALS["teachers"] = new cteachers();

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'teachers', TRUE);

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
		global $teachers;

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
		global $Language, $teachers;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["teacherID"] <> "") {
			$teachers->teacherID->setQueryStringValue($_GET["teacherID"]);
			if (!is_numeric($teachers->teacherID->QueryStringValue))
				$this->Page_Terminate("teacherslist.php"); // Prevent SQL injection, exit
			$sKey .= $teachers->teacherID->QueryStringValue;
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
			$this->Page_Terminate("teacherslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("teacherslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`teacherID`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in teachers class, teachersinfo.php

		$teachers->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$teachers->CurrentAction = $_POST["a_delete"];
		} else {
			$teachers->CurrentAction = "I"; // Display record
		}
		switch ($teachers->CurrentAction) {
			case "D": // Delete
				$teachers->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($teachers->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $teachers;
		$DeleteRows = TRUE;
		$sWrkFilter = $teachers->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in teachers class, teachersinfo.php

		$teachers->CurrentFilter = $sWrkFilter;
		$sSql = $teachers->SQL();
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
				$DeleteRows = $teachers->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['teacherID'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($teachers->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($teachers->CancelMessage <> "") {
				$this->setMessage($teachers->CancelMessage);
				$teachers->CancelMessage = "";
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
				$teachers->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $teachers;

		// Call Recordset Selecting event
		$teachers->Recordset_Selecting($teachers->CurrentFilter);

		// Load List page SQL
		$sSql = $teachers->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$teachers->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $teachers;
		$sFilter = $teachers->KeyFilter();

		// Call Row Selecting event
		$teachers->Row_Selecting($sFilter);

		// Load SQL based on filter
		$teachers->CurrentFilter = $sFilter;
		$sSql = $teachers->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$teachers->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $teachers;
		$teachers->teacherID->setDbValue($rs->fields('teacherID'));
		$teachers->firstname->setDbValue($rs->fields('firstname'));
		$teachers->middlename->setDbValue($rs->fields('middlename'));
		$teachers->lastname->setDbValue($rs->fields('lastname'));
		$teachers->qualification->setDbValue($rs->fields('qualification'));
		$teachers->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$teachers->aboutTeacher->setDbValue($rs->fields('aboutTeacher'));
		$teachers->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$teachers->zemail->setDbValue($rs->fields('email'));
		$teachers->username->setDbValue($rs->fields('username'));
		$teachers->portalPassword->setDbValue($rs->fields('portalPassword'));
		$teachers->status->setDbValue($rs->fields('status'));
		$teachers->teacherImage->Upload->DbValue = $rs->fields('teacherImage');
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $teachers;

		// Initialize URLs
		// Call Row_Rendering event

		$teachers->Row_Rendering();

		// Common render codes for all row types
		// teacherID

		$teachers->teacherID->CellCssStyle = ""; $teachers->teacherID->CellCssClass = "";
		$teachers->teacherID->CellAttrs = array(); $teachers->teacherID->ViewAttrs = array(); $teachers->teacherID->EditAttrs = array();

		// firstname
		$teachers->firstname->CellCssStyle = ""; $teachers->firstname->CellCssClass = "";
		$teachers->firstname->CellAttrs = array(); $teachers->firstname->ViewAttrs = array(); $teachers->firstname->EditAttrs = array();

		// middlename
		$teachers->middlename->CellCssStyle = ""; $teachers->middlename->CellCssClass = "";
		$teachers->middlename->CellAttrs = array(); $teachers->middlename->ViewAttrs = array(); $teachers->middlename->EditAttrs = array();

		// lastname
		$teachers->lastname->CellCssStyle = ""; $teachers->lastname->CellCssClass = "";
		$teachers->lastname->CellAttrs = array(); $teachers->lastname->ViewAttrs = array(); $teachers->lastname->EditAttrs = array();

		// qualification
		$teachers->qualification->CellCssStyle = ""; $teachers->qualification->CellCssClass = "";
		$teachers->qualification->CellAttrs = array(); $teachers->qualification->ViewAttrs = array(); $teachers->qualification->EditAttrs = array();

		// stateOfOrigin
		$teachers->stateOfOrigin->CellCssStyle = ""; $teachers->stateOfOrigin->CellCssClass = "";
		$teachers->stateOfOrigin->CellAttrs = array(); $teachers->stateOfOrigin->ViewAttrs = array(); $teachers->stateOfOrigin->EditAttrs = array();

		// email
		$teachers->zemail->CellCssStyle = ""; $teachers->zemail->CellCssClass = "";
		$teachers->zemail->CellAttrs = array(); $teachers->zemail->ViewAttrs = array(); $teachers->zemail->EditAttrs = array();

		// username
		$teachers->username->CellCssStyle = ""; $teachers->username->CellCssClass = "";
		$teachers->username->CellAttrs = array(); $teachers->username->ViewAttrs = array(); $teachers->username->EditAttrs = array();

		// status
		$teachers->status->CellCssStyle = ""; $teachers->status->CellCssClass = "";
		$teachers->status->CellAttrs = array(); $teachers->status->ViewAttrs = array(); $teachers->status->EditAttrs = array();
		if ($teachers->RowType == EW_ROWTYPE_VIEW) { // View row

			// teacherID
			$teachers->teacherID->ViewValue = $teachers->teacherID->CurrentValue;
			$teachers->teacherID->CssStyle = "";
			$teachers->teacherID->CssClass = "";
			$teachers->teacherID->ViewCustomAttributes = "";

			// firstname
			$teachers->firstname->ViewValue = $teachers->firstname->CurrentValue;
			$teachers->firstname->CssStyle = "";
			$teachers->firstname->CssClass = "";
			$teachers->firstname->ViewCustomAttributes = "";

			// middlename
			$teachers->middlename->ViewValue = $teachers->middlename->CurrentValue;
			$teachers->middlename->CssStyle = "";
			$teachers->middlename->CssClass = "";
			$teachers->middlename->ViewCustomAttributes = "";

			// lastname
			$teachers->lastname->ViewValue = $teachers->lastname->CurrentValue;
			$teachers->lastname->CssStyle = "";
			$teachers->lastname->CssClass = "";
			$teachers->lastname->ViewCustomAttributes = "";

			// qualification
			$teachers->qualification->ViewValue = $teachers->qualification->CurrentValue;
			$teachers->qualification->CssStyle = "";
			$teachers->qualification->CssClass = "";
			$teachers->qualification->ViewCustomAttributes = "";

			// stateOfOrigin
			$teachers->stateOfOrigin->ViewValue = $teachers->stateOfOrigin->CurrentValue;
			$teachers->stateOfOrigin->CssStyle = "";
			$teachers->stateOfOrigin->CssClass = "";
			$teachers->stateOfOrigin->ViewCustomAttributes = "";

			// email
			$teachers->zemail->ViewValue = $teachers->zemail->CurrentValue;
			$teachers->zemail->CssStyle = "";
			$teachers->zemail->CssClass = "";
			$teachers->zemail->ViewCustomAttributes = "";

			// username
			$teachers->username->ViewValue = $teachers->username->CurrentValue;
			$teachers->username->CssStyle = "";
			$teachers->username->CssClass = "";
			$teachers->username->ViewCustomAttributes = "";

			// status
			if (strval($teachers->status->CurrentValue) <> "") {
				switch ($teachers->status->CurrentValue) {
					case "1":
						$teachers->status->ViewValue = "Enabled";
						break;
					case "0":
						$teachers->status->ViewValue = "Disabled";
						break;
					default:
						$teachers->status->ViewValue = $teachers->status->CurrentValue;
				}
			} else {
				$teachers->status->ViewValue = NULL;
			}
			$teachers->status->CssStyle = "";
			$teachers->status->CssClass = "";
			$teachers->status->ViewCustomAttributes = "";

			// teacherID
			$teachers->teacherID->HrefValue = "";
			$teachers->teacherID->TooltipValue = "";

			// firstname
			$teachers->firstname->HrefValue = "";
			$teachers->firstname->TooltipValue = "";

			// middlename
			$teachers->middlename->HrefValue = "";
			$teachers->middlename->TooltipValue = "";

			// lastname
			$teachers->lastname->HrefValue = "";
			$teachers->lastname->TooltipValue = "";

			// qualification
			$teachers->qualification->HrefValue = "";
			$teachers->qualification->TooltipValue = "";

			// stateOfOrigin
			$teachers->stateOfOrigin->HrefValue = "";
			$teachers->stateOfOrigin->TooltipValue = "";

			// email
			$teachers->zemail->HrefValue = "";
			$teachers->zemail->TooltipValue = "";

			// username
			$teachers->username->HrefValue = "";
			$teachers->username->TooltipValue = "";

			// status
			$teachers->status->HrefValue = "";
			$teachers->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($teachers->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$teachers->Row_Rendered();
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
