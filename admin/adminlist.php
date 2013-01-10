<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$admin_list = new cadmin_list();
$Page =& $admin_list;

// Page init
$admin_list->Page_Init();

// Page main
$admin_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($admin->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var admin_list = new ew_Page("admin_list");

// page properties
admin_list.PageID = "list"; // page ID
admin_list.FormID = "fadminlist"; // form ID
var EW_PAGE_ID = admin_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
admin_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
admin_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
admin_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
admin_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-cold-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($admin->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$admin_list->lTotalRecs = $admin->SelectRecordCount();
	} else {
		if ($rs = $admin_list->LoadRecordset())
			$admin_list->lTotalRecs = $rs->RecordCount();
	}
	$admin_list->lStartRec = 1;
	if ($admin_list->lDisplayRecs <= 0 || ($admin->Export <> "" && $admin->ExportAll)) // Display all records
		$admin_list->lDisplayRecs = $admin_list->lTotalRecs;
	if (!($admin->Export <> "" && $admin->ExportAll))
		$admin_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $admin_list->LoadRecordset($admin_list->lStartRec-1, $admin_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $admin->TableCaption() ?>
<?php if ($admin->Export == "" && $admin->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fadminlist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fadminlist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fadminlist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.fadminlist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($admin->Export == "" && $admin->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(admin_list);" style="text-decoration: none;"><img id="admin_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="admin_list_SearchPanel">
<form name="fadminlistsrch" id="fadminlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="admin">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($admin->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $admin_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($admin->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($admin->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($admin->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$admin_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fadminlist" id="fadminlist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_admin" class="ewGridMiddlePanel">
<?php if ($admin_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $admin->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$admin_list->RenderListOptions();

// Render list options (header, left)
$admin_list->ListOptions->Render("header", "left");
?>
<?php if ($admin->adminID->Visible) { // adminID ?>
	<?php if ($admin->SortUrl($admin->adminID) == "") { ?>
		<td><?php echo $admin->adminID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $admin->SortUrl($admin->adminID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $admin->adminID->FldCaption() ?></td><td style="width: 10px;"><?php if ($admin->adminID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($admin->adminID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($admin->adminUsername->Visible) { // adminUsername ?>
	<?php if ($admin->SortUrl($admin->adminUsername) == "") { ?>
		<td><?php echo $admin->adminUsername->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $admin->SortUrl($admin->adminUsername) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $admin->adminUsername->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($admin->adminUsername->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($admin->adminUsername->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($admin->surname->Visible) { // surname ?>
	<?php if ($admin->SortUrl($admin->surname) == "") { ?>
		<td><?php echo $admin->surname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $admin->SortUrl($admin->surname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $admin->surname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($admin->surname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($admin->surname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($admin->othernames->Visible) { // othernames ?>
	<?php if ($admin->SortUrl($admin->othernames) == "") { ?>
		<td><?php echo $admin->othernames->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $admin->SortUrl($admin->othernames) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $admin->othernames->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($admin->othernames->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($admin->othernames->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($admin->lastLogin->Visible) { // lastLogin ?>
	<?php if ($admin->SortUrl($admin->lastLogin) == "") { ?>
		<td><?php echo $admin->lastLogin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $admin->SortUrl($admin->lastLogin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $admin->lastLogin->FldCaption() ?></td><td style="width: 10px;"><?php if ($admin->lastLogin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($admin->lastLogin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($admin->status->Visible) { // status ?>
	<?php if ($admin->SortUrl($admin->status) == "") { ?>
		<td><?php echo $admin->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $admin->SortUrl($admin->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $admin->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($admin->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($admin->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$admin_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($admin->ExportAll && $admin->Export <> "") {
	$admin_list->lStopRec = $admin_list->lTotalRecs;
} else {
	$admin_list->lStopRec = $admin_list->lStartRec + $admin_list->lDisplayRecs - 1; // Set the last record to display
}
$admin_list->lRecCount = $admin_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $admin_list->lStartRec > 1)
		$rs->Move($admin_list->lStartRec - 1);
}

// Initialize aggregate
$admin->RowType = EW_ROWTYPE_AGGREGATEINIT;
$admin_list->RenderRow();
$admin_list->lRowCnt = 0;
while (($admin->CurrentAction == "gridadd" || !$rs->EOF) &&
	$admin_list->lRecCount < $admin_list->lStopRec) {
	$admin_list->lRecCount++;
	if (intval($admin_list->lRecCount) >= intval($admin_list->lStartRec)) {
		$admin_list->lRowCnt++;

	// Init row class and style
	$admin->CssClass = "";
	$admin->CssStyle = "";
	$admin->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($admin->CurrentAction == "gridadd") {
		$admin_list->LoadDefaultValues(); // Load default values
	} else {
		$admin_list->LoadRowValues($rs); // Load row values
	}
	$admin->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$admin_list->RenderRow();

	// Render list options
	$admin_list->RenderListOptions();
?>
	<tr<?php echo $admin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$admin_list->ListOptions->Render("body", "left");
?>
	<?php if ($admin->adminID->Visible) { // adminID ?>
		<td<?php echo $admin->adminID->CellAttributes() ?>>
<div<?php echo $admin->adminID->ViewAttributes() ?>><?php echo $admin->adminID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($admin->adminUsername->Visible) { // adminUsername ?>
		<td<?php echo $admin->adminUsername->CellAttributes() ?>>
<div<?php echo $admin->adminUsername->ViewAttributes() ?>><?php echo $admin->adminUsername->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($admin->surname->Visible) { // surname ?>
		<td<?php echo $admin->surname->CellAttributes() ?>>
<div<?php echo $admin->surname->ViewAttributes() ?>><?php echo $admin->surname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($admin->othernames->Visible) { // othernames ?>
		<td<?php echo $admin->othernames->CellAttributes() ?>>
<div<?php echo $admin->othernames->ViewAttributes() ?>><?php echo $admin->othernames->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($admin->lastLogin->Visible) { // lastLogin ?>
		<td<?php echo $admin->lastLogin->CellAttributes() ?>>
<div<?php echo $admin->lastLogin->ViewAttributes() ?>><?php echo $admin->lastLogin->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($admin->status->Visible) { // status ?>
		<td<?php echo $admin->status->CellAttributes() ?>>
<div<?php echo $admin->status->ViewAttributes() ?>><?php echo $admin->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$admin_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($admin->CurrentAction <> "gridadd")
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
<?php if ($admin->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($admin->CurrentAction <> "gridadd" && $admin->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($admin_list->Pager)) $admin_list->Pager = new cPrevNextPager($admin_list->lStartRec, $admin_list->lDisplayRecs, $admin_list->lTotalRecs) ?>
<?php if ($admin_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($admin_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $admin_list->PageUrl() ?>start=<?php echo $admin_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($admin_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $admin_list->PageUrl() ?>start=<?php echo $admin_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $admin_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($admin_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $admin_list->PageUrl() ?>start=<?php echo $admin_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($admin_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $admin_list->PageUrl() ?>start=<?php echo $admin_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $admin_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $admin_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $admin_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $admin_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($admin_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($admin_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $admin_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($admin->Export == "" && $admin->CurrentAction == "") { ?>
<?php } ?>
<?php if ($admin->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$admin_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cadmin_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'admin';

	// Page object name
	var $PageObjName = 'admin_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $admin;
		if ($admin->UseTokenInUrl) $PageUrl .= "t=" . $admin->TableVar . "&"; // Add page token
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
		global $objForm, $admin;
		if ($admin->UseTokenInUrl) {
			if ($objForm)
				return ($admin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($admin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cadmin_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (admin)
		$GLOBALS["admin"] = new cadmin();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["admin"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "admindelete.php";
		$this->MultiUpdateUrl = "adminupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'admin', TRUE);

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
		global $admin;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$admin->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$admin->Export = $_POST["exporttype"];
		} else {
			$admin->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $admin->Export; // Get export parameter, used in header
		$gsExportFile = $admin->TableVar; // Get export file, used in header
		if ($admin->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($admin->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($admin->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $admin;

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
			$admin->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($admin->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $admin->getRecordsPerPage(); // Restore from Session
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
		$admin->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$admin->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$admin->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $admin->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$admin->setSessionWhere($sFilter);
		$admin->CurrentFilter = "";

		// Export selected records
		if ($admin->Export <> "")
			$admin->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($admin->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($admin->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $admin;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $admin->adminUsername, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $admin->adminPassword, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $admin->surname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $admin->othernames, $Keyword);
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
		global $Security, $admin;
		$sSearchStr = "";
		$sSearchKeyword = $admin->BasicSearchKeyword;
		$sSearchType = $admin->BasicSearchType;
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
			$admin->setSessionBasicSearchKeyword($sSearchKeyword);
			$admin->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $admin;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$admin->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $admin;
		$admin->setSessionBasicSearchKeyword("");
		$admin->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $admin;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$admin->BasicSearchKeyword = $admin->getSessionBasicSearchKeyword();
			$admin->BasicSearchType = $admin->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $admin;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$admin->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$admin->CurrentOrderType = @$_GET["ordertype"];
			$admin->UpdateSort($admin->adminID); // adminID
			$admin->UpdateSort($admin->adminUsername); // adminUsername
			$admin->UpdateSort($admin->surname); // surname
			$admin->UpdateSort($admin->othernames); // othernames
			$admin->UpdateSort($admin->lastLogin); // lastLogin
			$admin->UpdateSort($admin->status); // status
			$admin->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $admin;
		$sOrderBy = $admin->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($admin->SqlOrderBy() <> "") {
				$sOrderBy = $admin->SqlOrderBy();
				$admin->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $admin;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$admin->setSessionOrderBy($sOrderBy);
				$admin->adminID->setSort("");
				$admin->adminUsername->setSort("");
				$admin->surname->setSort("");
				$admin->othernames->setSort("");
				$admin->lastLogin->setSort("");
				$admin->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$admin->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $admin;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"admin_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($admin->Export <> "" ||
			$admin->CurrentAction == "gridadd" ||
			$admin->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $admin;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($admin->adminID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $admin;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $admin;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$admin->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$admin->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $admin->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$admin->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$admin->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$admin->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $admin;
		$admin->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$admin->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $admin;

		// Call Recordset Selecting event
		$admin->Recordset_Selecting($admin->CurrentFilter);

		// Load List page SQL
		$sSql = $admin->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$admin->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $admin;
		$sFilter = $admin->KeyFilter();

		// Call Row Selecting event
		$admin->Row_Selecting($sFilter);

		// Load SQL based on filter
		$admin->CurrentFilter = $sFilter;
		$sSql = $admin->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$admin->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $admin;
		$admin->adminID->setDbValue($rs->fields('adminID'));
		$admin->adminUsername->setDbValue($rs->fields('adminUsername'));
		$admin->adminPassword->setDbValue($rs->fields('adminPassword'));
		$admin->surname->setDbValue($rs->fields('surname'));
		$admin->othernames->setDbValue($rs->fields('othernames'));
		$admin->lastLogin->setDbValue($rs->fields('lastLogin'));
		$admin->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $admin;

		// Initialize URLs
		$this->ViewUrl = $admin->ViewUrl();
		$this->EditUrl = $admin->EditUrl();
		$this->InlineEditUrl = $admin->InlineEditUrl();
		$this->CopyUrl = $admin->CopyUrl();
		$this->InlineCopyUrl = $admin->InlineCopyUrl();
		$this->DeleteUrl = $admin->DeleteUrl();

		// Call Row_Rendering event
		$admin->Row_Rendering();

		// Common render codes for all row types
		// adminID

		$admin->adminID->CellCssStyle = ""; $admin->adminID->CellCssClass = "";
		$admin->adminID->CellAttrs = array(); $admin->adminID->ViewAttrs = array(); $admin->adminID->EditAttrs = array();

		// adminUsername
		$admin->adminUsername->CellCssStyle = ""; $admin->adminUsername->CellCssClass = "";
		$admin->adminUsername->CellAttrs = array(); $admin->adminUsername->ViewAttrs = array(); $admin->adminUsername->EditAttrs = array();

		// surname
		$admin->surname->CellCssStyle = ""; $admin->surname->CellCssClass = "";
		$admin->surname->CellAttrs = array(); $admin->surname->ViewAttrs = array(); $admin->surname->EditAttrs = array();

		// othernames
		$admin->othernames->CellCssStyle = ""; $admin->othernames->CellCssClass = "";
		$admin->othernames->CellAttrs = array(); $admin->othernames->ViewAttrs = array(); $admin->othernames->EditAttrs = array();

		// lastLogin
		$admin->lastLogin->CellCssStyle = ""; $admin->lastLogin->CellCssClass = "";
		$admin->lastLogin->CellAttrs = array(); $admin->lastLogin->ViewAttrs = array(); $admin->lastLogin->EditAttrs = array();

		// status
		$admin->status->CellCssStyle = ""; $admin->status->CellCssClass = "";
		$admin->status->CellAttrs = array(); $admin->status->ViewAttrs = array(); $admin->status->EditAttrs = array();
		if ($admin->RowType == EW_ROWTYPE_VIEW) { // View row

			// adminID
			$admin->adminID->ViewValue = $admin->adminID->CurrentValue;
			$admin->adminID->CssStyle = "";
			$admin->adminID->CssClass = "";
			$admin->adminID->ViewCustomAttributes = "";

			// adminUsername
			$admin->adminUsername->ViewValue = $admin->adminUsername->CurrentValue;
			$admin->adminUsername->CssStyle = "";
			$admin->adminUsername->CssClass = "";
			$admin->adminUsername->ViewCustomAttributes = "";

			// surname
			$admin->surname->ViewValue = $admin->surname->CurrentValue;
			$admin->surname->CssStyle = "";
			$admin->surname->CssClass = "";
			$admin->surname->ViewCustomAttributes = "";

			// othernames
			$admin->othernames->ViewValue = $admin->othernames->CurrentValue;
			$admin->othernames->CssStyle = "";
			$admin->othernames->CssClass = "";
			$admin->othernames->ViewCustomAttributes = "";

			// lastLogin
			$admin->lastLogin->ViewValue = $admin->lastLogin->CurrentValue;
			$admin->lastLogin->ViewValue = ew_FormatDateTime($admin->lastLogin->ViewValue, 5);
			$admin->lastLogin->CssStyle = "";
			$admin->lastLogin->CssClass = "";
			$admin->lastLogin->ViewCustomAttributes = "";

			// status
			if (strval($admin->status->CurrentValue) <> "") {
				switch ($admin->status->CurrentValue) {
					case "1":
						$admin->status->ViewValue = "Enabled";
						break;
					case "0":
						$admin->status->ViewValue = "Disabled";
						break;
					default:
						$admin->status->ViewValue = $admin->status->CurrentValue;
				}
			} else {
				$admin->status->ViewValue = NULL;
			}
			$admin->status->CssStyle = "";
			$admin->status->CssClass = "";
			$admin->status->ViewCustomAttributes = "";

			// adminID
			$admin->adminID->HrefValue = "";
			$admin->adminID->TooltipValue = "";

			// adminUsername
			$admin->adminUsername->HrefValue = "";
			$admin->adminUsername->TooltipValue = "";

			// surname
			$admin->surname->HrefValue = "";
			$admin->surname->TooltipValue = "";

			// othernames
			$admin->othernames->HrefValue = "";
			$admin->othernames->TooltipValue = "";

			// lastLogin
			$admin->lastLogin->HrefValue = "";
			$admin->lastLogin->TooltipValue = "";

			// status
			$admin->status->HrefValue = "";
			$admin->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($admin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$admin->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $admin;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($admin->Export <> "") {
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
				$admin->adminID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $admin->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $admin;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $admin->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($admin->ExportAll) {
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
		if ($admin->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($admin, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($admin->adminID);
				$ExportDoc->ExportCaption($admin->adminUsername);
				$ExportDoc->ExportCaption($admin->surname);
				$ExportDoc->ExportCaption($admin->othernames);
				$ExportDoc->ExportCaption($admin->lastLogin);
				$ExportDoc->ExportCaption($admin->status);
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
				$admin->CssClass = "";
				$admin->CssStyle = "";
				$admin->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($admin->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('adminID', $admin->adminID->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('adminUsername', $admin->adminUsername->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('surname', $admin->surname->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('othernames', $admin->othernames->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('lastLogin', $admin->lastLogin->ExportValue($admin->Export, $admin->ExportOriginalValue));
					$XmlDoc->AddField('status', $admin->status->ExportValue($admin->Export, $admin->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($admin->adminID);
					$ExportDoc->ExportField($admin->adminUsername);
					$ExportDoc->ExportField($admin->surname);
					$ExportDoc->ExportField($admin->othernames);
					$ExportDoc->ExportField($admin->lastLogin);
					$ExportDoc->ExportField($admin->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($admin->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($admin->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($admin->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($admin->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($admin->ExportReturnUrl());
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
