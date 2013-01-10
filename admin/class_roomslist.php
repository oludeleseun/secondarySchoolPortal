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
$class_rooms_list = new cclass_rooms_list();
$Page =& $class_rooms_list;

// Page init
$class_rooms_list->Page_Init();

// Page main
$class_rooms_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($class_rooms->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var class_rooms_list = new ew_Page("class_rooms_list");

// page properties
class_rooms_list.PageID = "list"; // page ID
class_rooms_list.FormID = "fclass_roomslist"; // form ID
var EW_PAGE_ID = class_rooms_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
class_rooms_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
class_rooms_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
class_rooms_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
class_rooms_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($class_rooms->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$class_rooms_list->lTotalRecs = $class_rooms->SelectRecordCount();
	} else {
		if ($rs = $class_rooms_list->LoadRecordset())
			$class_rooms_list->lTotalRecs = $rs->RecordCount();
	}
	$class_rooms_list->lStartRec = 1;
	if ($class_rooms_list->lDisplayRecs <= 0 || ($class_rooms->Export <> "" && $class_rooms->ExportAll)) // Display all records
		$class_rooms_list->lDisplayRecs = $class_rooms_list->lTotalRecs;
	if (!($class_rooms->Export <> "" && $class_rooms->ExportAll))
		$class_rooms_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $class_rooms_list->LoadRecordset($class_rooms_list->lStartRec-1, $class_rooms_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $class_rooms->TableCaption() ?>
<?php if ($class_rooms->Export == "" && $class_rooms->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fclass_roomslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fclass_roomslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fclass_roomslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fclass_roomslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($class_rooms->Export == "" && $class_rooms->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(class_rooms_list);" style="text-decoration: none;"><img id="class_rooms_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="class_rooms_list_SearchPanel">
<form name="fclass_roomslistsrch" id="fclass_roomslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="class_rooms">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($class_rooms->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $class_rooms_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($class_rooms->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($class_rooms->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($class_rooms->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$class_rooms_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fclass_roomslist" id="fclass_roomslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_class_rooms" class="ewGridMiddlePanel">
<?php if ($class_rooms_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $class_rooms->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$class_rooms_list->RenderListOptions();

// Render list options (header, left)
$class_rooms_list->ListOptions->Render("header", "left");
?>
<?php if ($class_rooms->classID->Visible) { // classID ?>
	<?php if ($class_rooms->SortUrl($class_rooms->classID) == "") { ?>
		<td><?php echo $class_rooms->classID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_rooms->SortUrl($class_rooms->classID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_rooms->classID->FldCaption() ?></td><td style="width: 10px;"><?php if ($class_rooms->classID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_rooms->classID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($class_rooms->classLevelID->Visible) { // classLevelID ?>
	<?php if ($class_rooms->SortUrl($class_rooms->classLevelID) == "") { ?>
		<td><?php echo $class_rooms->classLevelID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_rooms->SortUrl($class_rooms->classLevelID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_rooms->classLevelID->FldCaption() ?></td><td style="width: 10px;"><?php if ($class_rooms->classLevelID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_rooms->classLevelID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($class_rooms->className->Visible) { // className ?>
	<?php if ($class_rooms->SortUrl($class_rooms->className) == "") { ?>
		<td><?php echo $class_rooms->className->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_rooms->SortUrl($class_rooms->className) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_rooms->className->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($class_rooms->className->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_rooms->className->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($class_rooms->classTeacher->Visible) { // classTeacher ?>
	<?php if ($class_rooms->SortUrl($class_rooms->classTeacher) == "") { ?>
		<td><?php echo $class_rooms->classTeacher->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_rooms->SortUrl($class_rooms->classTeacher) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_rooms->classTeacher->FldCaption() ?></td><td style="width: 10px;"><?php if ($class_rooms->classTeacher->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_rooms->classTeacher->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($class_rooms->status->Visible) { // status ?>
	<?php if ($class_rooms->SortUrl($class_rooms->status) == "") { ?>
		<td><?php echo $class_rooms->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_rooms->SortUrl($class_rooms->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_rooms->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($class_rooms->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_rooms->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$class_rooms_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($class_rooms->ExportAll && $class_rooms->Export <> "") {
	$class_rooms_list->lStopRec = $class_rooms_list->lTotalRecs;
} else {
	$class_rooms_list->lStopRec = $class_rooms_list->lStartRec + $class_rooms_list->lDisplayRecs - 1; // Set the last record to display
}
$class_rooms_list->lRecCount = $class_rooms_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $class_rooms_list->lStartRec > 1)
		$rs->Move($class_rooms_list->lStartRec - 1);
}

// Initialize aggregate
$class_rooms->RowType = EW_ROWTYPE_AGGREGATEINIT;
$class_rooms_list->RenderRow();
$class_rooms_list->lRowCnt = 0;
while (($class_rooms->CurrentAction == "gridadd" || !$rs->EOF) &&
	$class_rooms_list->lRecCount < $class_rooms_list->lStopRec) {
	$class_rooms_list->lRecCount++;
	if (intval($class_rooms_list->lRecCount) >= intval($class_rooms_list->lStartRec)) {
		$class_rooms_list->lRowCnt++;

	// Init row class and style
	$class_rooms->CssClass = "";
	$class_rooms->CssStyle = "";
	$class_rooms->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($class_rooms->CurrentAction == "gridadd") {
		$class_rooms_list->LoadDefaultValues(); // Load default values
	} else {
		$class_rooms_list->LoadRowValues($rs); // Load row values
	}
	$class_rooms->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$class_rooms_list->RenderRow();

	// Render list options
	$class_rooms_list->RenderListOptions();
?>
	<tr<?php echo $class_rooms->RowAttributes() ?>>
<?php

// Render list options (body, left)
$class_rooms_list->ListOptions->Render("body", "left");
?>
	<?php if ($class_rooms->classID->Visible) { // classID ?>
		<td<?php echo $class_rooms->classID->CellAttributes() ?>>
<div<?php echo $class_rooms->classID->ViewAttributes() ?>><?php echo $class_rooms->classID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($class_rooms->classLevelID->Visible) { // classLevelID ?>
		<td<?php echo $class_rooms->classLevelID->CellAttributes() ?>>
<div<?php echo $class_rooms->classLevelID->ViewAttributes() ?>><?php echo $class_rooms->classLevelID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($class_rooms->className->Visible) { // className ?>
		<td<?php echo $class_rooms->className->CellAttributes() ?>>
<div<?php echo $class_rooms->className->ViewAttributes() ?>><?php echo $class_rooms->className->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($class_rooms->classTeacher->Visible) { // classTeacher ?>
		<td<?php echo $class_rooms->classTeacher->CellAttributes() ?>>
<div<?php echo $class_rooms->classTeacher->ViewAttributes() ?>><?php echo $class_rooms->classTeacher->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($class_rooms->status->Visible) { // status ?>
		<td<?php echo $class_rooms->status->CellAttributes() ?>>
<div<?php echo $class_rooms->status->ViewAttributes() ?>><?php echo $class_rooms->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$class_rooms_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($class_rooms->CurrentAction <> "gridadd")
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
<?php if ($class_rooms->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($class_rooms->CurrentAction <> "gridadd" && $class_rooms->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($class_rooms_list->Pager)) $class_rooms_list->Pager = new cPrevNextPager($class_rooms_list->lStartRec, $class_rooms_list->lDisplayRecs, $class_rooms_list->lTotalRecs) ?>
<?php if ($class_rooms_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($class_rooms_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $class_rooms_list->PageUrl() ?>start=<?php echo $class_rooms_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($class_rooms_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $class_rooms_list->PageUrl() ?>start=<?php echo $class_rooms_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $class_rooms_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($class_rooms_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $class_rooms_list->PageUrl() ?>start=<?php echo $class_rooms_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($class_rooms_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $class_rooms_list->PageUrl() ?>start=<?php echo $class_rooms_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $class_rooms_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $class_rooms_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $class_rooms_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $class_rooms_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($class_rooms_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($class_rooms_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_rooms_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($class_rooms->Export == "" && $class_rooms->CurrentAction == "") { ?>
<?php } ?>
<?php if ($class_rooms->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$class_rooms_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cclass_rooms_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'class_rooms';

	// Page object name
	var $PageObjName = 'class_rooms_list';

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
	function cclass_rooms_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (class_rooms)
		$GLOBALS["class_rooms"] = new cclass_rooms();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["class_rooms"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "class_roomsdelete.php";
		$this->MultiUpdateUrl = "class_roomsupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'class_rooms', TRUE);

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
		global $class_rooms;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$class_rooms->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$class_rooms->Export = $_POST["exporttype"];
		} else {
			$class_rooms->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $class_rooms->Export; // Get export parameter, used in header
		$gsExportFile = $class_rooms->TableVar; // Get export file, used in header
		if ($class_rooms->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($class_rooms->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($class_rooms->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $class_rooms;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$class_rooms->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($class_rooms->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $class_rooms->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$class_rooms->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$class_rooms->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$class_rooms->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $class_rooms->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$class_rooms->setSessionWhere($sFilter);
		$class_rooms->CurrentFilter = "";

		// Export selected records
		if ($class_rooms->Export <> "")
			$class_rooms->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($class_rooms->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($class_rooms->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $class_rooms;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $class_rooms->className, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $class_rooms;
		$sSearchStr = "";
		$sSearchKeyword = $class_rooms->BasicSearchKeyword;
		$sSearchType = $class_rooms->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$class_rooms->setSessionBasicSearchKeyword($sSearchKeyword);
			$class_rooms->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $class_rooms;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$class_rooms->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $class_rooms;
		$class_rooms->setSessionBasicSearchKeyword("");
		$class_rooms->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $class_rooms;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$class_rooms->BasicSearchKeyword = $class_rooms->getSessionBasicSearchKeyword();
			$class_rooms->BasicSearchType = $class_rooms->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $class_rooms;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$class_rooms->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$class_rooms->CurrentOrderType = @$_GET["ordertype"];
			$class_rooms->UpdateSort($class_rooms->classID); // classID
			$class_rooms->UpdateSort($class_rooms->classLevelID); // classLevelID
			$class_rooms->UpdateSort($class_rooms->className); // className
			$class_rooms->UpdateSort($class_rooms->classTeacher); // classTeacher
			$class_rooms->UpdateSort($class_rooms->status); // status
			$class_rooms->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $class_rooms;
		$sOrderBy = $class_rooms->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($class_rooms->SqlOrderBy() <> "") {
				$sOrderBy = $class_rooms->SqlOrderBy();
				$class_rooms->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $class_rooms;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$class_rooms->setSessionOrderBy($sOrderBy);
				$class_rooms->classID->setSort("");
				$class_rooms->classLevelID->setSort("");
				$class_rooms->className->setSort("");
				$class_rooms->classTeacher->setSort("");
				$class_rooms->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$class_rooms->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $class_rooms;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"class_rooms_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($class_rooms->Export <> "" ||
			$class_rooms->CurrentAction == "gridadd" ||
			$class_rooms->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $class_rooms;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($class_rooms->classID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $class_rooms;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $class_rooms;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$class_rooms->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$class_rooms->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $class_rooms->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$class_rooms->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$class_rooms->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$class_rooms->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $class_rooms;
		$class_rooms->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$class_rooms->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		$this->ViewUrl = $class_rooms->ViewUrl();
		$this->EditUrl = $class_rooms->EditUrl();
		$this->InlineEditUrl = $class_rooms->InlineEditUrl();
		$this->CopyUrl = $class_rooms->CopyUrl();
		$this->InlineCopyUrl = $class_rooms->InlineCopyUrl();
		$this->DeleteUrl = $class_rooms->DeleteUrl();

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

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $class_rooms;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($class_rooms->Export <> "") {
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
				$class_rooms->classID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $class_rooms->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $class_rooms;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $class_rooms->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($class_rooms->ExportAll) {
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
		if ($class_rooms->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($class_rooms, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($class_rooms->classID);
				$ExportDoc->ExportCaption($class_rooms->classLevelID);
				$ExportDoc->ExportCaption($class_rooms->className);
				$ExportDoc->ExportCaption($class_rooms->classTeacher);
				$ExportDoc->ExportCaption($class_rooms->status);
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
				$class_rooms->CssClass = "";
				$class_rooms->CssStyle = "";
				$class_rooms->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($class_rooms->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('classID', $class_rooms->classID->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
					$XmlDoc->AddField('classLevelID', $class_rooms->classLevelID->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
					$XmlDoc->AddField('className', $class_rooms->className->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
					$XmlDoc->AddField('classTeacher', $class_rooms->classTeacher->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
					$XmlDoc->AddField('status', $class_rooms->status->ExportValue($class_rooms->Export, $class_rooms->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($class_rooms->classID);
					$ExportDoc->ExportField($class_rooms->classLevelID);
					$ExportDoc->ExportField($class_rooms->className);
					$ExportDoc->ExportField($class_rooms->classTeacher);
					$ExportDoc->ExportField($class_rooms->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($class_rooms->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($class_rooms->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($class_rooms->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($class_rooms->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($class_rooms->ExportReturnUrl());
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
