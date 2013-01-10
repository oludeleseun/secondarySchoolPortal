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
$subject_teachers_list = new csubject_teachers_list();
$Page =& $subject_teachers_list;

// Page init
$subject_teachers_list->Page_Init();

// Page main
$subject_teachers_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($subject_teachers->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var subject_teachers_list = new ew_Page("subject_teachers_list");

// page properties
subject_teachers_list.PageID = "list"; // page ID
subject_teachers_list.FormID = "fsubject_teacherslist"; // form ID
var EW_PAGE_ID = subject_teachers_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
subject_teachers_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
subject_teachers_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
subject_teachers_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
subject_teachers_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($subject_teachers->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$subject_teachers_list->lTotalRecs = $subject_teachers->SelectRecordCount();
	} else {
		if ($rs = $subject_teachers_list->LoadRecordset())
			$subject_teachers_list->lTotalRecs = $rs->RecordCount();
	}
	$subject_teachers_list->lStartRec = 1;
	if ($subject_teachers_list->lDisplayRecs <= 0 || ($subject_teachers->Export <> "" && $subject_teachers->ExportAll)) // Display all records
		$subject_teachers_list->lDisplayRecs = $subject_teachers_list->lTotalRecs;
	if (!($subject_teachers->Export <> "" && $subject_teachers->ExportAll))
		$subject_teachers_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $subject_teachers_list->LoadRecordset($subject_teachers_list->lStartRec-1, $subject_teachers_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $subject_teachers->TableCaption() ?>
<?php if ($subject_teachers->Export == "" && $subject_teachers->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fsubject_teacherslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fsubject_teacherslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fsubject_teacherslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fsubject_teacherslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$subject_teachers_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fsubject_teacherslist" id="fsubject_teacherslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_subject_teachers" class="ewGridMiddlePanel">
<?php if ($subject_teachers_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $subject_teachers->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$subject_teachers_list->RenderListOptions();

// Render list options (header, left)
$subject_teachers_list->ListOptions->Render("header", "left");
?>
<?php if ($subject_teachers->subjectTeacherID->Visible) { // subjectTeacherID ?>
	<?php if ($subject_teachers->SortUrl($subject_teachers->subjectTeacherID) == "") { ?>
		<td><?php echo $subject_teachers->subjectTeacherID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subject_teachers->SortUrl($subject_teachers->subjectTeacherID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subject_teachers->subjectTeacherID->FldCaption() ?></td><td style="width: 10px;"><?php if ($subject_teachers->subjectTeacherID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subject_teachers->subjectTeacherID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subject_teachers->subjectID->Visible) { // subjectID ?>
	<?php if ($subject_teachers->SortUrl($subject_teachers->subjectID) == "") { ?>
		<td><?php echo $subject_teachers->subjectID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subject_teachers->SortUrl($subject_teachers->subjectID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subject_teachers->subjectID->FldCaption() ?></td><td style="width: 10px;"><?php if ($subject_teachers->subjectID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subject_teachers->subjectID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subject_teachers->subjectTeacher->Visible) { // subjectTeacher ?>
	<?php if ($subject_teachers->SortUrl($subject_teachers->subjectTeacher) == "") { ?>
		<td><?php echo $subject_teachers->subjectTeacher->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subject_teachers->SortUrl($subject_teachers->subjectTeacher) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subject_teachers->subjectTeacher->FldCaption() ?></td><td style="width: 10px;"><?php if ($subject_teachers->subjectTeacher->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subject_teachers->subjectTeacher->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subject_teachers->classroomID->Visible) { // classroomID ?>
	<?php if ($subject_teachers->SortUrl($subject_teachers->classroomID) == "") { ?>
		<td><?php echo $subject_teachers->classroomID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subject_teachers->SortUrl($subject_teachers->classroomID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subject_teachers->classroomID->FldCaption() ?></td><td style="width: 10px;"><?php if ($subject_teachers->classroomID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subject_teachers->classroomID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($subject_teachers->status->Visible) { // status ?>
	<?php if ($subject_teachers->SortUrl($subject_teachers->status) == "") { ?>
		<td><?php echo $subject_teachers->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $subject_teachers->SortUrl($subject_teachers->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $subject_teachers->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($subject_teachers->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($subject_teachers->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$subject_teachers_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($subject_teachers->ExportAll && $subject_teachers->Export <> "") {
	$subject_teachers_list->lStopRec = $subject_teachers_list->lTotalRecs;
} else {
	$subject_teachers_list->lStopRec = $subject_teachers_list->lStartRec + $subject_teachers_list->lDisplayRecs - 1; // Set the last record to display
}
$subject_teachers_list->lRecCount = $subject_teachers_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $subject_teachers_list->lStartRec > 1)
		$rs->Move($subject_teachers_list->lStartRec - 1);
}

// Initialize aggregate
$subject_teachers->RowType = EW_ROWTYPE_AGGREGATEINIT;
$subject_teachers_list->RenderRow();
$subject_teachers_list->lRowCnt = 0;
while (($subject_teachers->CurrentAction == "gridadd" || !$rs->EOF) &&
	$subject_teachers_list->lRecCount < $subject_teachers_list->lStopRec) {
	$subject_teachers_list->lRecCount++;
	if (intval($subject_teachers_list->lRecCount) >= intval($subject_teachers_list->lStartRec)) {
		$subject_teachers_list->lRowCnt++;

	// Init row class and style
	$subject_teachers->CssClass = "";
	$subject_teachers->CssStyle = "";
	$subject_teachers->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($subject_teachers->CurrentAction == "gridadd") {
		$subject_teachers_list->LoadDefaultValues(); // Load default values
	} else {
		$subject_teachers_list->LoadRowValues($rs); // Load row values
	}
	$subject_teachers->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$subject_teachers_list->RenderRow();

	// Render list options
	$subject_teachers_list->RenderListOptions();
?>
	<tr<?php echo $subject_teachers->RowAttributes() ?>>
<?php

// Render list options (body, left)
$subject_teachers_list->ListOptions->Render("body", "left");
?>
	<?php if ($subject_teachers->subjectTeacherID->Visible) { // subjectTeacherID ?>
		<td<?php echo $subject_teachers->subjectTeacherID->CellAttributes() ?>>
<div<?php echo $subject_teachers->subjectTeacherID->ViewAttributes() ?>><?php echo $subject_teachers->subjectTeacherID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subject_teachers->subjectID->Visible) { // subjectID ?>
		<td<?php echo $subject_teachers->subjectID->CellAttributes() ?>>
<div<?php echo $subject_teachers->subjectID->ViewAttributes() ?>><?php echo $subject_teachers->subjectID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subject_teachers->subjectTeacher->Visible) { // subjectTeacher ?>
		<td<?php echo $subject_teachers->subjectTeacher->CellAttributes() ?>>
<div<?php echo $subject_teachers->subjectTeacher->ViewAttributes() ?>><?php echo $subject_teachers->subjectTeacher->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subject_teachers->classroomID->Visible) { // classroomID ?>
		<td<?php echo $subject_teachers->classroomID->CellAttributes() ?>>
<div<?php echo $subject_teachers->classroomID->ViewAttributes() ?>><?php echo $subject_teachers->classroomID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($subject_teachers->status->Visible) { // status ?>
		<td<?php echo $subject_teachers->status->CellAttributes() ?>>
<div<?php echo $subject_teachers->status->ViewAttributes() ?>><?php echo $subject_teachers->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subject_teachers_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($subject_teachers->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($subject_teachers->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($subject_teachers->CurrentAction <> "gridadd" && $subject_teachers->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($subject_teachers_list->Pager)) $subject_teachers_list->Pager = new cPrevNextPager($subject_teachers_list->lStartRec, $subject_teachers_list->lDisplayRecs, $subject_teachers_list->lTotalRecs) ?>
<?php if ($subject_teachers_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($subject_teachers_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $subject_teachers_list->PageUrl() ?>start=<?php echo $subject_teachers_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($subject_teachers_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $subject_teachers_list->PageUrl() ?>start=<?php echo $subject_teachers_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $subject_teachers_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($subject_teachers_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $subject_teachers_list->PageUrl() ?>start=<?php echo $subject_teachers_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($subject_teachers_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $subject_teachers_list->PageUrl() ?>start=<?php echo $subject_teachers_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $subject_teachers_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $subject_teachers_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $subject_teachers_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $subject_teachers_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($subject_teachers_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($subject_teachers_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $subject_teachers_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($subject_teachers->Export == "" && $subject_teachers->CurrentAction == "") { ?>
<?php } ?>
<?php if ($subject_teachers->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$subject_teachers_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csubject_teachers_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'subject_teachers';

	// Page object name
	var $PageObjName = 'subject_teachers_list';

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
	function csubject_teachers_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (subject_teachers)
		$GLOBALS["subject_teachers"] = new csubject_teachers();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["subject_teachers"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "subject_teachersdelete.php";
		$this->MultiUpdateUrl = "subject_teachersupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'subject_teachers', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
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

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$subject_teachers->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$subject_teachers->Export = $_POST["exporttype"];
		} else {
			$subject_teachers->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $subject_teachers->Export; // Get export parameter, used in header
		$gsExportFile = $subject_teachers->TableVar; // Get export file, used in header
		if ($subject_teachers->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($subject_teachers->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($subject_teachers->Export == "csv") {
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
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

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $subject_teachers;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($subject_teachers->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $subject_teachers->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$subject_teachers->setSessionWhere($sFilter);
		$subject_teachers->CurrentFilter = "";

		// Export selected records
		if ($subject_teachers->Export <> "")
			$subject_teachers->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($subject_teachers->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($subject_teachers->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $subject_teachers;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$subject_teachers->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$subject_teachers->CurrentOrderType = @$_GET["ordertype"];
			$subject_teachers->UpdateSort($subject_teachers->subjectTeacherID); // subjectTeacherID
			$subject_teachers->UpdateSort($subject_teachers->subjectID); // subjectID
			$subject_teachers->UpdateSort($subject_teachers->subjectTeacher); // subjectTeacher
			$subject_teachers->UpdateSort($subject_teachers->classroomID); // classroomID
			$subject_teachers->UpdateSort($subject_teachers->status); // status
			$subject_teachers->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $subject_teachers;
		$sOrderBy = $subject_teachers->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($subject_teachers->SqlOrderBy() <> "") {
				$sOrderBy = $subject_teachers->SqlOrderBy();
				$subject_teachers->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $subject_teachers;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$subject_teachers->setSessionOrderBy($sOrderBy);
				$subject_teachers->subjectTeacherID->setSort("");
				$subject_teachers->subjectID->setSort("");
				$subject_teachers->subjectTeacher->setSort("");
				$subject_teachers->classroomID->setSort("");
				$subject_teachers->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$subject_teachers->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $subject_teachers;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"subject_teachers_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($subject_teachers->Export <> "" ||
			$subject_teachers->CurrentAction == "gridadd" ||
			$subject_teachers->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $subject_teachers;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($subject_teachers->subjectTeacherID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $subject_teachers;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $subject_teachers;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$subject_teachers->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$subject_teachers->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $subject_teachers->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$subject_teachers->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$subject_teachers->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$subject_teachers->setStartRecordNumber($this->lStartRec);
		}
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
		$this->ViewUrl = $subject_teachers->ViewUrl();
		$this->EditUrl = $subject_teachers->EditUrl();
		$this->InlineEditUrl = $subject_teachers->InlineEditUrl();
		$this->CopyUrl = $subject_teachers->CopyUrl();
		$this->InlineCopyUrl = $subject_teachers->InlineCopyUrl();
		$this->DeleteUrl = $subject_teachers->DeleteUrl();

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

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $subject_teachers;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($subject_teachers->Export <> "") {
			if (ew_IsHttpPost()) {
				if (isset($_POST["key_m"])) {
					$this->nKeySelected = count($_POST["key_m"]);
					$this->arKeys = ew_StripSlashes($_POST["key_m"]);
				}
			} elseif (isset($_GET["key_m"])) {
				$this->nKeySelected = count($_GET["key_m"]);
				$this->arKeys = ew_StripSlashes($_GET["key_m"]);
			}
			foreach ($this->arKeys as $sKey) {
				$sKeyFld = $sKey;
				if (!is_numeric($sKeyFld))
				 	return "";
				$subject_teachers->subjectTeacherID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $subject_teachers->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $subject_teachers;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $subject_teachers->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($subject_teachers->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($subject_teachers->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($subject_teachers, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($subject_teachers->subjectTeacherID);
				$ExportDoc->ExportCaption($subject_teachers->subjectID);
				$ExportDoc->ExportCaption($subject_teachers->subjectTeacher);
				$ExportDoc->ExportCaption($subject_teachers->classroomID);
				$ExportDoc->ExportCaption($subject_teachers->status);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$subject_teachers->CssClass = "";
				$subject_teachers->CssStyle = "";
				$subject_teachers->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($subject_teachers->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('subjectTeacherID', $subject_teachers->subjectTeacherID->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
					$XmlDoc->AddField('subjectID', $subject_teachers->subjectID->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
					$XmlDoc->AddField('subjectTeacher', $subject_teachers->subjectTeacher->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
					$XmlDoc->AddField('classroomID', $subject_teachers->classroomID->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
					$XmlDoc->AddField('status', $subject_teachers->status->ExportValue($subject_teachers->Export, $subject_teachers->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($subject_teachers->subjectTeacherID);
					$ExportDoc->ExportField($subject_teachers->subjectID);
					$ExportDoc->ExportField($subject_teachers->subjectTeacher);
					$ExportDoc->ExportField($subject_teachers->classroomID);
					$ExportDoc->ExportField($subject_teachers->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($subject_teachers->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($subject_teachers->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($subject_teachers->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($subject_teachers->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($subject_teachers->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
