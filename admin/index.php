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
$default = new cdefault();
$Page =& $default;

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php
$default->Page_Terminate();
?>
<?php

//
// Page class
//
class cdefault {

	// Page ID
	var $PageID = 'default';

	// Page object name
	var $PageObjName = 'default';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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
		return TRUE;
	}

	//
	// Page class constructor
	//
	function cdefault() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// User table object (admin)
		$GLOBALS["admin"] = new cadmin;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

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
		global $admin;

		// Security
		$Security = new cAdvancedSecurity();

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

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn())
		$this->Page_Terminate("academic_sessionslist.php"); // Exit and go to default page
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("academic_termslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("adminlist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("class_levelslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("class_roomslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("etranzact_transactionslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("fees_invoicelist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("parentslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("session_termslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("student_subjectslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("studentslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("subject_teacherslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("subjectslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("teacherslist.php");
		if ($Security->IsLoggedIn())
			$this->Page_Terminate("term_result_approvallist.php");
		if ($Security->IsLoggedIn()) {
			echo $Language->Phrase("NoPermission");
			echo "<br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>";
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
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
		//$msg = "your new message"; g

	}
}
?>
