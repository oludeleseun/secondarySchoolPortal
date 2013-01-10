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
$class_levels_list = new cclass_levels_list();
$Page =& $class_levels_list;

// Page init
$class_levels_list->Page_Init();

// Page main
$class_levels_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($class_levels->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var class_levels_list = new ew_Page("class_levels_list");

// page properties
class_levels_list.PageID = "list"; // page ID
class_levels_list.FormID = "fclass_levelslist"; // form ID
var EW_PAGE_ID = class_levels_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
class_levels_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
class_levels_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
class_levels_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
class_levels_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($class_levels->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$class_levels_list->lTotalRecs = $class_levels->SelectRecordCount();
	} else {
		if ($rs = $class_levels_list->LoadRecordset())
			$class_levels_list->lTotalRecs = $rs->RecordCount();
	}
	$class_levels_list->lStartRec = 1;
	if ($class_levels_list->lDisplayRecs <= 0 || ($class_levels->Export <> "" && $class_levels->ExportAll)) // Display all records
		$class_levels_list->lDisplayRecs = $class_levels_list->lTotalRecs;
	if (!($class_levels->Export <> "" && $class_levels->ExportAll))
		$class_levels_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $class_levels_list->LoadRecordset($class_levels_list->lStartRec-1, $class_levels_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $class_levels->TableCaption() ?>
<?php if ($class_levels->Export == "" && $class_levels->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fclass_levelslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fclass_levelslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fclass_levelslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fclass_levelslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($class_levels->Export == "" && $class_levels->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(class_levels_list);" style="text-decoration: none;"><img id="class_levels_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="class_levels_list_SearchPanel">
<form name="fclass_levelslistsrch" id="fclass_levelslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="class_levels">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($class_levels->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $class_levels_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($class_levels->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($class_levels->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($class_levels->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$class_levels_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fclass_levelslist" id="fclass_levelslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_class_levels" class="ewGridMiddlePanel">
<?php if ($class_levels_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $class_levels->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$class_levels_list->RenderListOptions();

// Render list options (header, left)
$class_levels_list->ListOptions->Render("header", "left");
?>
<?php if ($class_levels->classLevelID->Visible) { // classLevelID ?>
	<?php if ($class_levels->SortUrl($class_levels->classLevelID) == "") { ?>
		<td><?php echo $class_levels->classLevelID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_levels->SortUrl($class_levels->classLevelID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_levels->classLevelID->FldCaption() ?></td><td style="width: 10px;"><?php if ($class_levels->classLevelID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_levels->classLevelID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($class_levels->classLevel->Visible) { // classLevel ?>
	<?php if ($class_levels->SortUrl($class_levels->classLevel) == "") { ?>
		<td><?php echo $class_levels->classLevel->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_levels->SortUrl($class_levels->classLevel) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_levels->classLevel->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($class_levels->classLevel->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_levels->classLevel->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($class_levels->classOrder->Visible) { // classOrder ?>
	<?php if ($class_levels->SortUrl($class_levels->classOrder) == "") { ?>
		<td><?php echo $class_levels->classOrder->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_levels->SortUrl($class_levels->classOrder) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_levels->classOrder->FldCaption() ?></td><td style="width: 10px;"><?php if ($class_levels->classOrder->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_levels->classOrder->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($class_levels->schoolFees->Visible) { // schoolFees ?>
	<?php if ($class_levels->SortUrl($class_levels->schoolFees) == "") { ?>
		<td><?php echo $class_levels->schoolFees->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_levels->SortUrl($class_levels->schoolFees) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_levels->schoolFees->FldCaption() ?></td><td style="width: 10px;"><?php if ($class_levels->schoolFees->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_levels->schoolFees->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($class_levels->status->Visible) { // status ?>
	<?php if ($class_levels->SortUrl($class_levels->status) == "") { ?>
		<td><?php echo $class_levels->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $class_levels->SortUrl($class_levels->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $class_levels->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($class_levels->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($class_levels->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$class_levels_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($class_levels->ExportAll && $class_levels->Export <> "") {
	$class_levels_list->lStopRec = $class_levels_list->lTotalRecs;
} else {
	$class_levels_list->lStopRec = $class_levels_list->lStartRec + $class_levels_list->lDisplayRecs - 1; // Set the last record to display
}
$class_levels_list->lRecCount = $class_levels_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $class_levels_list->lStartRec > 1)
		$rs->Move($class_levels_list->lStartRec - 1);
}

// Initialize aggregate
$class_levels->RowType = EW_ROWTYPE_AGGREGATEINIT;
$class_levels_list->RenderRow();
$class_levels_list->lRowCnt = 0;
while (($class_levels->CurrentAction == "gridadd" || !$rs->EOF) &&
	$class_levels_list->lRecCount < $class_levels_list->lStopRec) {
	$class_levels_list->lRecCount++;
	if (intval($class_levels_list->lRecCount) >= intval($class_levels_list->lStartRec)) {
		$class_levels_list->lRowCnt++;

	// Init row class and style
	$class_levels->CssClass = "";
	$class_levels->CssStyle = "";
	$class_levels->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($class_levels->CurrentAction == "gridadd") {
		$class_levels_list->LoadDefaultValues(); // Load default values
	} else {
		$class_levels_list->LoadRowValues($rs); // Load row values
	}
	$class_levels->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$class_levels_list->RenderRow();

	// Render list options
	$class_levels_list->RenderListOptions();
?>
	<tr<?php echo $class_levels->RowAttributes() ?>>
<?php

// Render list options (body, left)
$class_levels_list->ListOptions->Render("body", "left");
?>
	<?php if ($class_levels->classLevelID->Visible) { // classLevelID ?>
		<td<?php echo $class_levels->classLevelID->CellAttributes() ?>>
<div<?php echo $class_levels->classLevelID->ViewAttributes() ?>><?php echo $class_levels->classLevelID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($class_levels->classLevel->Visible) { // classLevel ?>
		<td<?php echo $class_levels->classLevel->CellAttributes() ?>>
<div<?php echo $class_levels->classLevel->ViewAttributes() ?>><?php echo $class_levels->classLevel->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($class_levels->classOrder->Visible) { // classOrder ?>
		<td<?php echo $class_levels->classOrder->CellAttributes() ?>>
<div<?php echo $class_levels->classOrder->ViewAttributes() ?>><?php echo $class_levels->classOrder->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($class_levels->schoolFees->Visible) { // schoolFees ?>
		<td<?php echo $class_levels->schoolFees->CellAttributes() ?>>
<div<?php echo $class_levels->schoolFees->ViewAttributes() ?>><?php echo $class_levels->schoolFees->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($class_levels->status->Visible) { // status ?>
		<td<?php echo $class_levels->status->CellAttributes() ?>>
<div<?php echo $class_levels->status->ViewAttributes() ?>><?php echo $class_levels->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$class_levels_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($class_levels->CurrentAction <> "gridadd")
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
<?php if ($class_levels->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($class_levels->CurrentAction <> "gridadd" && $class_levels->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($class_levels_list->Pager)) $class_levels_list->Pager = new cPrevNextPager($class_levels_list->lStartRec, $class_levels_list->lDisplayRecs, $class_levels_list->lTotalRecs) ?>
<?php if ($class_levels_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($class_levels_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $class_levels_list->PageUrl() ?>start=<?php echo $class_levels_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($class_levels_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $class_levels_list->PageUrl() ?>start=<?php echo $class_levels_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $class_levels_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($class_levels_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $class_levels_list->PageUrl() ?>start=<?php echo $class_levels_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($class_levels_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $class_levels_list->PageUrl() ?>start=<?php echo $class_levels_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $class_levels_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $class_levels_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $class_levels_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $class_levels_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($class_levels_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($class_levels_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $class_levels_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($class_levels->Export == "" && $class_levels->CurrentAction == "") { ?>
<?php } ?>
<?php if ($class_levels->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$class_levels_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cclass_levels_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'class_levels';

	// Page object name
	var $PageObjName = 'class_levels_list';

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
	function cclass_levels_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (class_levels)
		$GLOBALS["class_levels"] = new cclass_levels();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["class_levels"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "class_levelsdelete.php";
		$this->MultiUpdateUrl = "class_levelsupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'class_levels', TRUE);

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
		global $class_levels;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$class_levels->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$class_levels->Export = $_POST["exporttype"];
		} else {
			$class_levels->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $class_levels->Export; // Get export parameter, used in header
		$gsExportFile = $class_levels->TableVar; // Get export file, used in header
		if ($class_levels->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($class_levels->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($class_levels->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $class_levels;

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
			$class_levels->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($class_levels->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $class_levels->getRecordsPerPage(); // Restore from Session
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
		$class_levels->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$class_levels->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$class_levels->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $class_levels->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$class_levels->setSessionWhere($sFilter);
		$class_levels->CurrentFilter = "";

		// Export selected records
		if ($class_levels->Export <> "")
			$class_levels->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($class_levels->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($class_levels->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $class_levels;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $class_levels->classLevel, $Keyword);
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
		global $Security, $class_levels;
		$sSearchStr = "";
		$sSearchKeyword = $class_levels->BasicSearchKeyword;
		$sSearchType = $class_levels->BasicSearchType;
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
			$class_levels->setSessionBasicSearchKeyword($sSearchKeyword);
			$class_levels->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $class_levels;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$class_levels->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $class_levels;
		$class_levels->setSessionBasicSearchKeyword("");
		$class_levels->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $class_levels;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$class_levels->BasicSearchKeyword = $class_levels->getSessionBasicSearchKeyword();
			$class_levels->BasicSearchType = $class_levels->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $class_levels;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$class_levels->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$class_levels->CurrentOrderType = @$_GET["ordertype"];
			$class_levels->UpdateSort($class_levels->classLevelID); // classLevelID
			$class_levels->UpdateSort($class_levels->classLevel); // classLevel
			$class_levels->UpdateSort($class_levels->classOrder); // classOrder
			$class_levels->UpdateSort($class_levels->schoolFees); // schoolFees
			$class_levels->UpdateSort($class_levels->status); // status
			$class_levels->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $class_levels;
		$sOrderBy = $class_levels->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($class_levels->SqlOrderBy() <> "") {
				$sOrderBy = $class_levels->SqlOrderBy();
				$class_levels->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $class_levels;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$class_levels->setSessionOrderBy($sOrderBy);
				$class_levels->classLevelID->setSort("");
				$class_levels->classLevel->setSort("");
				$class_levels->classOrder->setSort("");
				$class_levels->schoolFees->setSort("");
				$class_levels->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$class_levels->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $class_levels;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"class_levels_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($class_levels->Export <> "" ||
			$class_levels->CurrentAction == "gridadd" ||
			$class_levels->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $class_levels;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($class_levels->classLevelID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $class_levels;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $class_levels;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$class_levels->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$class_levels->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $class_levels->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$class_levels->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$class_levels->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$class_levels->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $class_levels;
		$class_levels->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$class_levels->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		$this->ViewUrl = $class_levels->ViewUrl();
		$this->EditUrl = $class_levels->EditUrl();
		$this->InlineEditUrl = $class_levels->InlineEditUrl();
		$this->CopyUrl = $class_levels->CopyUrl();
		$this->InlineCopyUrl = $class_levels->InlineCopyUrl();
		$this->DeleteUrl = $class_levels->DeleteUrl();

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

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $class_levels;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($class_levels->Export <> "") {
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
				$class_levels->classLevelID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $class_levels->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $class_levels;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $class_levels->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($class_levels->ExportAll) {
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
		if ($class_levels->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($class_levels, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($class_levels->classLevelID);
				$ExportDoc->ExportCaption($class_levels->classLevel);
				$ExportDoc->ExportCaption($class_levels->classOrder);
				$ExportDoc->ExportCaption($class_levels->schoolFees);
				$ExportDoc->ExportCaption($class_levels->status);
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
				$class_levels->CssClass = "";
				$class_levels->CssStyle = "";
				$class_levels->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($class_levels->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('classLevelID', $class_levels->classLevelID->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
					$XmlDoc->AddField('classLevel', $class_levels->classLevel->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
					$XmlDoc->AddField('classOrder', $class_levels->classOrder->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
					$XmlDoc->AddField('schoolFees', $class_levels->schoolFees->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
					$XmlDoc->AddField('status', $class_levels->status->ExportValue($class_levels->Export, $class_levels->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($class_levels->classLevelID);
					$ExportDoc->ExportField($class_levels->classLevel);
					$ExportDoc->ExportField($class_levels->classOrder);
					$ExportDoc->ExportField($class_levels->schoolFees);
					$ExportDoc->ExportField($class_levels->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($class_levels->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($class_levels->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($class_levels->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($class_levels->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($class_levels->ExportReturnUrl());
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
