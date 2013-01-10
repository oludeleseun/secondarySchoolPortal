<?php

// Global variable for table object
$parents = NULL;

//
// Table class for parents
//
class cparents {
	var $TableVar = 'parents';
	var $TableName = 'parents';
	var $TableType = 'TABLE';
	var $parentID;
	var $firstname;
	var $middlename;
	var $lastname;
	var $occupation;
	var $mailingAddress;
	var $residentialAddress;
	var $residentState;
	var $stateOfOrigin;
	var $emailAddress;
	var $portalUsername;
	var $portalPassword;
	var $status;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = FALSE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function cparents() {
		global $Language;

		// parentID
		$this->parentID = new cField('parents', 'parents', 'x_parentID', 'parentID', '`parentID`', 3, -1, FALSE, '`parentID`', FALSE);
		$this->parentID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['parentID'] =& $this->parentID;

		// firstname
		$this->firstname = new cField('parents', 'parents', 'x_firstname', 'firstname', '`firstname`', 200, -1, FALSE, '`firstname`', FALSE);
		$this->fields['firstname'] =& $this->firstname;

		// middlename
		$this->middlename = new cField('parents', 'parents', 'x_middlename', 'middlename', '`middlename`', 200, -1, FALSE, '`middlename`', FALSE);
		$this->fields['middlename'] =& $this->middlename;

		// lastname
		$this->lastname = new cField('parents', 'parents', 'x_lastname', 'lastname', '`lastname`', 200, -1, FALSE, '`lastname`', FALSE);
		$this->fields['lastname'] =& $this->lastname;

		// occupation
		$this->occupation = new cField('parents', 'parents', 'x_occupation', 'occupation', '`occupation`', 200, -1, FALSE, '`occupation`', FALSE);
		$this->fields['occupation'] =& $this->occupation;

		// mailingAddress
		$this->mailingAddress = new cField('parents', 'parents', 'x_mailingAddress', 'mailingAddress', '`mailingAddress`', 201, -1, FALSE, '`mailingAddress`', FALSE);
		$this->fields['mailingAddress'] =& $this->mailingAddress;

		// residentialAddress
		$this->residentialAddress = new cField('parents', 'parents', 'x_residentialAddress', 'residentialAddress', '`residentialAddress`', 201, -1, FALSE, '`residentialAddress`', FALSE);
		$this->fields['residentialAddress'] =& $this->residentialAddress;

		// residentState
		$this->residentState = new cField('parents', 'parents', 'x_residentState', 'residentState', '`residentState`', 200, -1, FALSE, '`residentState`', FALSE);
		$this->fields['residentState'] =& $this->residentState;

		// stateOfOrigin
		$this->stateOfOrigin = new cField('parents', 'parents', 'x_stateOfOrigin', 'stateOfOrigin', '`stateOfOrigin`', 200, -1, FALSE, '`stateOfOrigin`', FALSE);
		$this->fields['stateOfOrigin'] =& $this->stateOfOrigin;

		// emailAddress
		$this->emailAddress = new cField('parents', 'parents', 'x_emailAddress', 'emailAddress', '`emailAddress`', 200, -1, FALSE, '`emailAddress`', FALSE);
		$this->emailAddress->FldDefaultErrMsg = $Language->Phrase("IncorrectEmail");
		$this->fields['emailAddress'] =& $this->emailAddress;

		// portalUsername
		$this->portalUsername = new cField('parents', 'parents', 'x_portalUsername', 'portalUsername', '`portalUsername`', 200, -1, FALSE, '`portalUsername`', FALSE);
		$this->fields['portalUsername'] =& $this->portalUsername;

		// portalPassword
		$this->portalPassword = new cField('parents', 'parents', 'x_portalPassword', 'portalPassword', '`portalPassword`', 200, -1, FALSE, '`portalPassword`', FALSE);
		$this->fields['portalPassword'] =& $this->portalPassword;

		// status
		$this->status = new cField('parents', 'parents', 'x_status', 'status', '`status`', 3, -1, FALSE, '`status`', FALSE);
		$this->status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status'] =& $this->status;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "parents_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`parents`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere .= "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `parents` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `parents` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `parents` WHERE ";
		$SQL .= ew_QuotedName('parentID') . '=' . ew_QuotedValue($rs['parentID'], $this->parentID->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`parentID` = @parentID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->parentID->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@parentID@", ew_AdjustSql($this->parentID->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "parentslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "parentslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("parentsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "parentsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("parentsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("parentsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("parentsdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->parentID->CurrentValue)) {
			$sUrl .= "parentID=" . urlencode($this->parentID->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=parents" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->parentID->setDbValue($rs->fields('parentID'));
		$this->firstname->setDbValue($rs->fields('firstname'));
		$this->middlename->setDbValue($rs->fields('middlename'));
		$this->lastname->setDbValue($rs->fields('lastname'));
		$this->occupation->setDbValue($rs->fields('occupation'));
		$this->mailingAddress->setDbValue($rs->fields('mailingAddress'));
		$this->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$this->residentState->setDbValue($rs->fields('residentState'));
		$this->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$this->emailAddress->setDbValue($rs->fields('emailAddress'));
		$this->portalUsername->setDbValue($rs->fields('portalUsername'));
		$this->portalPassword->setDbValue($rs->fields('portalPassword'));
		$this->status->setDbValue($rs->fields('status'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// parentID

		$this->parentID->CellCssStyle = ""; $this->parentID->CellCssClass = "";
		$this->parentID->CellAttrs = array(); $this->parentID->ViewAttrs = array(); $this->parentID->EditAttrs = array();

		// firstname
		$this->firstname->CellCssStyle = ""; $this->firstname->CellCssClass = "";
		$this->firstname->CellAttrs = array(); $this->firstname->ViewAttrs = array(); $this->firstname->EditAttrs = array();

		// middlename
		$this->middlename->CellCssStyle = ""; $this->middlename->CellCssClass = "";
		$this->middlename->CellAttrs = array(); $this->middlename->ViewAttrs = array(); $this->middlename->EditAttrs = array();

		// lastname
		$this->lastname->CellCssStyle = ""; $this->lastname->CellCssClass = "";
		$this->lastname->CellAttrs = array(); $this->lastname->ViewAttrs = array(); $this->lastname->EditAttrs = array();

		// occupation
		$this->occupation->CellCssStyle = ""; $this->occupation->CellCssClass = "";
		$this->occupation->CellAttrs = array(); $this->occupation->ViewAttrs = array(); $this->occupation->EditAttrs = array();

		// residentState
		$this->residentState->CellCssStyle = ""; $this->residentState->CellCssClass = "";
		$this->residentState->CellAttrs = array(); $this->residentState->ViewAttrs = array(); $this->residentState->EditAttrs = array();

		// stateOfOrigin
		$this->stateOfOrigin->CellCssStyle = ""; $this->stateOfOrigin->CellCssClass = "";
		$this->stateOfOrigin->CellAttrs = array(); $this->stateOfOrigin->ViewAttrs = array(); $this->stateOfOrigin->EditAttrs = array();

		// emailAddress
		$this->emailAddress->CellCssStyle = ""; $this->emailAddress->CellCssClass = "";
		$this->emailAddress->CellAttrs = array(); $this->emailAddress->ViewAttrs = array(); $this->emailAddress->EditAttrs = array();

		// portalUsername
		$this->portalUsername->CellCssStyle = ""; $this->portalUsername->CellCssClass = "";
		$this->portalUsername->CellAttrs = array(); $this->portalUsername->ViewAttrs = array(); $this->portalUsername->EditAttrs = array();

		// portalPassword
		$this->portalPassword->CellCssStyle = ""; $this->portalPassword->CellCssClass = "";
		$this->portalPassword->CellAttrs = array(); $this->portalPassword->ViewAttrs = array(); $this->portalPassword->EditAttrs = array();

		// status
		$this->status->CellCssStyle = ""; $this->status->CellCssClass = "";
		$this->status->CellAttrs = array(); $this->status->ViewAttrs = array(); $this->status->EditAttrs = array();

		// parentID
		$this->parentID->ViewValue = $this->parentID->CurrentValue;
		$this->parentID->CssStyle = "";
		$this->parentID->CssClass = "";
		$this->parentID->ViewCustomAttributes = "";

		// firstname
		$this->firstname->ViewValue = $this->firstname->CurrentValue;
		$this->firstname->CssStyle = "";
		$this->firstname->CssClass = "";
		$this->firstname->ViewCustomAttributes = "";

		// middlename
		$this->middlename->ViewValue = $this->middlename->CurrentValue;
		$this->middlename->CssStyle = "";
		$this->middlename->CssClass = "";
		$this->middlename->ViewCustomAttributes = "";

		// lastname
		$this->lastname->ViewValue = $this->lastname->CurrentValue;
		$this->lastname->CssStyle = "";
		$this->lastname->CssClass = "";
		$this->lastname->ViewCustomAttributes = "";

		// occupation
		$this->occupation->ViewValue = $this->occupation->CurrentValue;
		$this->occupation->CssStyle = "";
		$this->occupation->CssClass = "";
		$this->occupation->ViewCustomAttributes = "";

		// residentState
		$this->residentState->ViewValue = $this->residentState->CurrentValue;
		$this->residentState->CssStyle = "";
		$this->residentState->CssClass = "";
		$this->residentState->ViewCustomAttributes = "";

		// stateOfOrigin
		$this->stateOfOrigin->ViewValue = $this->stateOfOrigin->CurrentValue;
		$this->stateOfOrigin->CssStyle = "";
		$this->stateOfOrigin->CssClass = "";
		$this->stateOfOrigin->ViewCustomAttributes = "";

		// emailAddress
		$this->emailAddress->ViewValue = $this->emailAddress->CurrentValue;
		$this->emailAddress->CssStyle = "";
		$this->emailAddress->CssClass = "";
		$this->emailAddress->ViewCustomAttributes = "";

		// portalUsername
		$this->portalUsername->ViewValue = $this->portalUsername->CurrentValue;
		$this->portalUsername->CssStyle = "";
		$this->portalUsername->CssClass = "";
		$this->portalUsername->ViewCustomAttributes = "";

		// portalPassword
		$this->portalPassword->ViewValue = "********";
		$this->portalPassword->CssStyle = "";
		$this->portalPassword->CssClass = "";
		$this->portalPassword->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) <> "") {
			switch ($this->status->CurrentValue) {
				case "1":
					$this->status->ViewValue = "Enabled";
					break;
				case "0":
					$this->status->ViewValue = "Disabled";
					break;
				default:
					$this->status->ViewValue = $this->status->CurrentValue;
			}
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->CssStyle = "";
		$this->status->CssClass = "";
		$this->status->ViewCustomAttributes = "";

		// parentID
		$this->parentID->HrefValue = "";
		$this->parentID->TooltipValue = "";

		// firstname
		$this->firstname->HrefValue = "";
		$this->firstname->TooltipValue = "";

		// middlename
		$this->middlename->HrefValue = "";
		$this->middlename->TooltipValue = "";

		// lastname
		$this->lastname->HrefValue = "";
		$this->lastname->TooltipValue = "";

		// occupation
		$this->occupation->HrefValue = "";
		$this->occupation->TooltipValue = "";

		// residentState
		$this->residentState->HrefValue = "";
		$this->residentState->TooltipValue = "";

		// stateOfOrigin
		$this->stateOfOrigin->HrefValue = "";
		$this->stateOfOrigin->TooltipValue = "";

		// emailAddress
		$this->emailAddress->HrefValue = "";
		$this->emailAddress->TooltipValue = "";

		// portalUsername
		$this->portalUsername->HrefValue = "";
		$this->portalUsername->TooltipValue = "";

		// portalPassword
		$this->portalPassword->HrefValue = "";
		$this->portalPassword->TooltipValue = "";

		// status
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//global $MyTable;
		//$MyTable->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
