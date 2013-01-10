<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "academic_termsinfo.php" ?>
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
$academic_terms_list = new cacademic_terms_list();
$Page =& $academic_terms_list;

// Page init
$academic_terms_list->Page_Init();

// Page main
$academic_terms_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($academic_terms->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var academic_terms_list = new ew_Page("academic_terms_list");

// page properties
academic_terms_list.PageID = "list"; // page ID
academic_terms_list.FormID = "facademic_termslist"; // form ID
var EW_PAGE_ID = academic_terms_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
academic_terms_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
academic_terms_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
academic_terms_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
academic_terms_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($academic_terms->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$academic_terms_list->lTotalRecs = $academic_terms->SelectRecordCount();
	} else {
		if ($rs = $academic_terms_list->LoadRecordset())
			$academic_terms_list->lTotalRecs = $rs->RecordCount();
	}
	$academic_terms_list->lStartRec = 1;
	if ($academic_terms_list->lDisplayRecs <= 0 || ($academic_terms->Export <> "" && $academic_terms->ExportAll)) // Display all records
		$academic_terms_list->lDisplayRecs = $academic_terms_list->lTotalRecs;
	if (!($academic_terms->Export <> "" && $academic_terms->ExportAll))
		$academic_terms_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $academic_terms_list->LoadRecordset($academic_terms_list->lStartRec-1, $academic_terms_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $academic_terms->TableCaption() ?>
<?php if ($academic_terms->Export == "" && $academic_terms->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.facademic_termslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','print');"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.facademic_termslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','excel');"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.facademic_termslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','xml');"><?php echo $Language->Phrase("ExportToXml") ?></a>
&nbsp;&nbsp;<a href="javascript:void(0);" onclick="var f=document.facademic_termslist;ew_SubmitSelectedExport(f,'<?php echo ew_CurrentPage() ?>','csv');"><?php echo $Language->Phrase("ExportToCsv") ?></a>
<?php } ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($academic_terms->Export == "" && $academic_terms->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(academic_terms_list);" style="text-decoration: none;"><img id="academic_terms_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="academic_terms_list_SearchPanel">
<form name="facademic_termslistsrch" id="facademic_termslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="academic_terms">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($academic_terms->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $academic_terms_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($academic_terms->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($academic_terms->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($academic_terms->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$academic_terms_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="facademic_termslist" id="facademic_termslist" class="ewForm" action="" method="post">
<input type="hidden" name="exporttype" id="exporttype" value="">
<div id="gmp_academic_terms" class="ewGridMiddlePanel">
<?php if ($academic_terms_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $academic_terms->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$academic_terms_list->RenderListOptions();

// Render list options (header, left)
$academic_terms_list->ListOptions->Render("header", "left");
?>
<?php if ($academic_terms->termID->Visible) { // termID ?>
	<?php if ($academic_terms->SortUrl($academic_terms->termID) == "") { ?>
		<td><?php echo $academic_terms->termID->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $academic_terms->SortUrl($academic_terms->termID) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $academic_terms->termID->FldCaption() ?></td><td style="width: 10px;"><?php if ($academic_terms->termID->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($academic_terms->termID->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($academic_terms->termName->Visible) { // termName ?>
	<?php if ($academic_terms->SortUrl($academic_terms->termName) == "") { ?>
		<td><?php echo $academic_terms->termName->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $academic_terms->SortUrl($academic_terms->termName) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $academic_terms->termName->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($academic_terms->termName->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($academic_terms->termName->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($academic_terms->status->Visible) { // status ?>
	<?php if ($academic_terms->SortUrl($academic_terms->status) == "") { ?>
		<td><?php echo $academic_terms->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $academic_terms->SortUrl($academic_terms->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $academic_terms->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($academic_terms->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($academic_terms->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$academic_terms_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($academic_terms->ExportAll && $academic_terms->Export <> "") {
	$academic_terms_list->lStopRec = $academic_terms_list->lTotalRecs;
} else {
	$academic_terms_list->lStopRec = $academic_terms_list->lStartRec + $academic_terms_list->lDisplayRecs - 1; // Set the last record to display
}
$academic_terms_list->lRecCount = $academic_terms_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $academic_terms_list->lStartRec > 1)
		$rs->Move($academic_terms_list->lStartRec - 1);
}

// Initialize aggregate
$academic_terms->RowType = EW_ROWTYPE_AGGREGATEINIT;
$academic_terms_list->RenderRow();
$academic_terms_list->lRowCnt = 0;
while (($academic_terms->CurrentAction == "gridadd" || !$rs->EOF) &&
	$academic_terms_list->lRecCount < $academic_terms_list->lStopRec) {
	$academic_terms_list->lRecCount++;
	if (intval($academic_terms_list->lRecCount) >= intval($academic_terms_list->lStartRec)) {
		$academic_terms_list->lRowCnt++;

	// Init row class and style
	$academic_terms->CssClass = "";
	$academic_terms->CssStyle = "";
	$academic_terms->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($academic_terms->CurrentAction == "gridadd") {
		$academic_terms_list->LoadDefaultValues(); // Load default values
	} else {
		$academic_terms_list->LoadRowValues($rs); // Load row values
	}
	$academic_terms->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$academic_terms_list->RenderRow();

	// Render list options
	$academic_terms_list->RenderListOptions();
?>
	<tr<?php echo $academic_terms->RowAttributes() ?>>
<?php

// Render list options (body, left)
$academic_terms_list->ListOptions->Render("body", "left");
?>
	<?php if ($academic_terms->termID->Visible) { // termID ?>
		<td<?php echo $academic_terms->termID->CellAttributes() ?>>
<div<?php echo $academic_terms->termID->ViewAttributes() ?>><?php echo $academic_terms->termID->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($academic_terms->termName->Visible) { // termName ?>
		<td<?php echo $academic_terms->termName->CellAttributes() ?>>
<div<?php echo $academic_terms->termName->ViewAttributes() ?>><?php echo $academic_terms->termName->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($academic_terms->status->Visible) { // status ?>
		<td<?php echo $academic_terms->status->CellAttributes() ?>>
<div<?php echo $academic_terms->status->ViewAttributes() ?>><?php echo $academic_terms->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$academic_terms_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($academic_terms->CurrentAction <> "gridadd")
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
<?php if ($academic_terms->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($academic_terms->CurrentAction <> "gridadd" && $academic_terms->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($academic_terms_list->Pager)) $academic_terms_list->Pager = new cPrevNextPager($academic_terms_list->lStartRec, $academic_terms_list->lDisplayRecs, $academic_terms_list->lTotalRecs) ?>
<?php if ($academic_terms_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($academic_terms_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $academic_terms_list->PageUrl() ?>start=<?php echo $academic_terms_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($academic_terms_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $academic_terms_list->PageUrl() ?>start=<?php echo $academic_terms_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $academic_terms_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($academic_terms_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $academic_terms_list->PageUrl() ?>start=<?php echo $academic_terms_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($academic_terms_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $academic_terms_list->PageUrl() ?>start=<?php echo $academic_terms_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $academic_terms_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $academic_terms_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $academic_terms_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $academic_terms_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($academic_terms_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($academic_terms_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $academic_terms_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($academic_terms->Export == "" && $academic_terms->CurrentAction == "") { ?>
<?php } ?>
<?php if ($academic_terms->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$academic_terms_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cacademic_terms_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'academic_terms';

	// Page object name
	var $PageObjName = 'academic_terms_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $academic_terms;
		if ($academic_terms->UseTokenInUrl) $PageUrl .= "t=" . $academic_terms->TableVar . "&"; // Add page token
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
		global $objForm, $academic_terms;
		if ($academic_terms->UseTokenInUrl) {
			if ($objForm)
				return ($academic_terms->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($academic_terms->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cacademic_terms_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (academic_terms)
		$GLOBALS["academic_terms"] = new cacademic_terms();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["academic_terms"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "academic_termsdelete.php";
		$this->MultiUpdateUrl = "academic_termsupdate.php";

		// Table object (admin)
		$GLOBALS['admin'] = new cadmin();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'academic_terms', TRUE);

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
		global $academic_terms;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$academic_terms->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$academic_terms->Export = $_POST["exporttype"];
		} else {
			$academic_terms->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $academic_terms->Export; // Get export parameter, used in header
		$gsExportFile = $academic_terms->TableVar; // Get export file, used in header
		if ($academic_terms->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($academic_terms->Export == "xml") {
			header('Content-Type: text/xml');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
		}
		if ($academic_terms->Export == "csv") {
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
		global $objForm, $Language, $gsSearchError, $Security, $academic_terms;

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
			$academic_terms->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($academic_terms->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $academic_terms->getRecordsPerPage(); // Restore from Session
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
		$academic_terms->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$academic_terms->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$academic_terms->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $academic_terms->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$academic_terms->setSessionWhere($sFilter);
		$academic_terms->CurrentFilter = "";

		// Export selected records
		if ($academic_terms->Export <> "")
			$academic_terms->CurrentFilter = $this->BuildExportSelectedFilter();

		// Export data only
		if (in_array($academic_terms->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($academic_terms->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $academic_terms;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $academic_terms->termName, $Keyword);
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
		global $Security, $academic_terms;
		$sSearchStr = "";
		$sSearchKeyword = $academic_terms->BasicSearchKeyword;
		$sSearchType = $academic_terms->BasicSearchType;
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
			$academic_terms->setSessionBasicSearchKeyword($sSearchKeyword);
			$academic_terms->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $academic_terms;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$academic_terms->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $academic_terms;
		$academic_terms->setSessionBasicSearchKeyword("");
		$academic_terms->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $academic_terms;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$academic_terms->BasicSearchKeyword = $academic_terms->getSessionBasicSearchKeyword();
			$academic_terms->BasicSearchType = $academic_terms->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $academic_terms;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$academic_terms->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$academic_terms->CurrentOrderType = @$_GET["ordertype"];
			$academic_terms->UpdateSort($academic_terms->termID); // termID
			$academic_terms->UpdateSort($academic_terms->termName); // termName
			$academic_terms->UpdateSort($academic_terms->status); // status
			$academic_terms->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $academic_terms;
		$sOrderBy = $academic_terms->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($academic_terms->SqlOrderBy() <> "") {
				$sOrderBy = $academic_terms->SqlOrderBy();
				$academic_terms->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $academic_terms;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$academic_terms->setSessionOrderBy($sOrderBy);
				$academic_terms->termID->setSort("");
				$academic_terms->termName->setSort("");
				$academic_terms->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$academic_terms->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $academic_terms;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"academic_terms_list.SelectAllKey(this);\">";

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($academic_terms->Export <> "" ||
			$academic_terms->CurrentAction == "gridadd" ||
			$academic_terms->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $academic_terms;
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($academic_terms->termID->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $academic_terms;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $academic_terms;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$academic_terms->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$academic_terms->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $academic_terms->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$academic_terms->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$academic_terms->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$academic_terms->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $academic_terms;
		$academic_terms->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$academic_terms->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $academic_terms;

		// Call Recordset Selecting event
		$academic_terms->Recordset_Selecting($academic_terms->CurrentFilter);

		// Load List page SQL
		$sSql = $academic_terms->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$academic_terms->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $academic_terms;
		$sFilter = $academic_terms->KeyFilter();

		// Call Row Selecting event
		$academic_terms->Row_Selecting($sFilter);

		// Load SQL based on filter
		$academic_terms->CurrentFilter = $sFilter;
		$sSql = $academic_terms->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$academic_terms->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $academic_terms;
		$academic_terms->termID->setDbValue($rs->fields('termID'));
		$academic_terms->termName->setDbValue($rs->fields('termName'));
		$academic_terms->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $academic_terms;

		// Initialize URLs
		$this->ViewUrl = $academic_terms->ViewUrl();
		$this->EditUrl = $academic_terms->EditUrl();
		$this->InlineEditUrl = $academic_terms->InlineEditUrl();
		$this->CopyUrl = $academic_terms->CopyUrl();
		$this->InlineCopyUrl = $academic_terms->InlineCopyUrl();
		$this->DeleteUrl = $academic_terms->DeleteUrl();

		// Call Row_Rendering event
		$academic_terms->Row_Rendering();

		// Common render codes for all row types
		// termID

		$academic_terms->termID->CellCssStyle = ""; $academic_terms->termID->CellCssClass = "";
		$academic_terms->termID->CellAttrs = array(); $academic_terms->termID->ViewAttrs = array(); $academic_terms->termID->EditAttrs = array();

		// termName
		$academic_terms->termName->CellCssStyle = ""; $academic_terms->termName->CellCssClass = "";
		$academic_terms->termName->CellAttrs = array(); $academic_terms->termName->ViewAttrs = array(); $academic_terms->termName->EditAttrs = array();

		// status
		$academic_terms->status->CellCssStyle = ""; $academic_terms->status->CellCssClass = "";
		$academic_terms->status->CellAttrs = array(); $academic_terms->status->ViewAttrs = array(); $academic_terms->status->EditAttrs = array();
		if ($academic_terms->RowType == EW_ROWTYPE_VIEW) { // View row

			// termID
			$academic_terms->termID->ViewValue = $academic_terms->termID->CurrentValue;
			$academic_terms->termID->CssStyle = "";
			$academic_terms->termID->CssClass = "";
			$academic_terms->termID->ViewCustomAttributes = "";

			// termName
			$academic_terms->termName->ViewValue = $academic_terms->termName->CurrentValue;
			$academic_terms->termName->CssStyle = "";
			$academic_terms->termName->CssClass = "";
			$academic_terms->termName->ViewCustomAttributes = "";

			// status
			if (strval($academic_terms->status->CurrentValue) <> "") {
				switch ($academic_terms->status->CurrentValue) {
					case "1":
						$academic_terms->status->ViewValue = "Enabled";
						break;
					case "0":
						$academic_terms->status->ViewValue = "Disabled";
						break;
					default:
						$academic_terms->status->ViewValue = $academic_terms->status->CurrentValue;
				}
			} else {
				$academic_terms->status->ViewValue = NULL;
			}
			$academic_terms->status->CssStyle = "";
			$academic_terms->status->CssClass = "";
			$academic_terms->status->ViewCustomAttributes = "";

			// termID
			$academic_terms->termID->HrefValue = "";
			$academic_terms->termID->TooltipValue = "";

			// termName
			$academic_terms->termName->HrefValue = "";
			$academic_terms->termName->TooltipValue = "";

			// status
			$academic_terms->status->HrefValue = "";
			$academic_terms->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($academic_terms->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$academic_terms->Row_Rendered();
	}

	//  Build export filter for selected records
	function BuildExportSelectedFilter() {
		global $Language, $academic_terms;
		$nKeySelected = 0;
		$sWrkFilter = "";
		if ($academic_terms->Export <> "") {
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
				$academic_terms->termID->CurrentValue = $sKeyFld;
				$sWrkFilter .= $academic_terms->KeyFilter() . " OR ";
			}
			if ($sWrkFilter <> "")
				$sWrkFilter = "(" . substr($sWrkFilter, 0, strlen($sWrkFilter)-4) . ")";
		}
		return $sWrkFilter;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $academic_terms;
		$utf8 = FALSE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $academic_terms->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($academic_terms->ExportAll) {
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
		if ($academic_terms->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($academic_terms, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($academic_terms->termID);
				$ExportDoc->ExportCaption($academic_terms->termName);
				$ExportDoc->ExportCaption($academic_terms->status);
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
				$academic_terms->CssClass = "";
				$academic_terms->CssStyle = "";
				$academic_terms->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($academic_terms->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('termID', $academic_terms->termID->ExportValue($academic_terms->Export, $academic_terms->ExportOriginalValue));
					$XmlDoc->AddField('termName', $academic_terms->termName->ExportValue($academic_terms->Export, $academic_terms->ExportOriginalValue));
					$XmlDoc->AddField('status', $academic_terms->status->ExportValue($academic_terms->Export, $academic_terms->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($academic_terms->termID);
					$ExportDoc->ExportField($academic_terms->termName);
					$ExportDoc->ExportField($academic_terms->status);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($academic_terms->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($academic_terms->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($academic_terms->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($academic_terms->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($academic_terms->ExportReturnUrl());
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
