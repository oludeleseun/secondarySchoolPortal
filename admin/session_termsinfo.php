<?php

// Global variable for table object
$session_terms = NULL;

//
// Table class for session_terms
//
class csession_terms {
	var $TableVar = 'session_terms';
	var $TableName = 'session_terms';
	var $TableType = 'TABLE';
	var $sessionTermID;
	var $session;
	var $termID;
	var $termStart;
	var $termEnd;
	var $currentTerm;
	var $showResults;
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
	function csession_terms() {
		global $Language;

		// sessionTermID
		$this->sessionTermID = new cField('session_terms', 'session_terms', 'x_sessionTermID', 'sessionTermID', '`sessionTermID`', 3, -1, FALSE, '`sessionTermID`', FALSE);
		$this->sessionTermID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sessionTermID'] =& $this->sessionTermID;

		// session
		$this->session = new cField('session_terms', 'session_terms', 'x_session', 'session', '`session`', 3, -1, FALSE, '`session`', FALSE);
		$this->session->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['session'] =& $this->session;

		// termID
		$this->termID = new cField('session_terms', 'session_terms', 'x_termID', 'termID', '`termID`', 3, -1, FALSE, '`termID`', FALSE);
		$this->termID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['termID'] =& $this->termID;

		// termStart
		$this->termStart = new cField('session_terms', 'session_terms', 'x_termStart', 'termStart', '`termStart`', 133, 5, FALSE, '`termStart`', FALSE);
		$this->termStart->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['termStart'] =& $this->termStart;

		// termEnd
		$this->termEnd = new cField('session_terms', 'session_terms', 'x_termEnd', 'termEnd', '`termEnd`', 133, 5, FALSE, '`termEnd`', FALSE);
		$this->termEnd->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['termEnd'] =& $this->termEnd;

		// currentTerm
		$this->currentTerm = new cField('session_terms', 'session_terms', 'x_currentTerm', 'currentTerm', '`currentTerm`', 3, -1, FALSE, '`currentTerm`', FALSE);
		$this->currentTerm->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['currentTerm'] =& $this->currentTerm;

		// showResults
		$this->showResults = new cField('session_terms', 'session_terms', 'x_showResults', 'showResults', '`showResults`', 3, -1, FALSE, '`showResults`', FALSE);
		$this->showResults->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['showResults'] =& $this->showResults;

		// status
		$this->status = new cField('session_terms', 'session_terms', 'x_status', 'status', '`status`', 3, -1, FALSE, '`status`', FALSE);
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
		return "session_terms_Highlight";
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
		return "`session_terms`";
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
		return "INSERT INTO `session_terms` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `session_terms` SET ";
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
		$SQL = "DELETE FROM `session_terms` WHERE ";
		$SQL .= ew_QuotedName('sessionTermID') . '=' . ew_QuotedValue($rs['sessionTermID'], $this->sessionTermID->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`sessionTermID` = @sessionTermID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->sessionTermID->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@sessionTermID@", ew_AdjustSql($this->sessionTermID->CurrentValue), $sKeyFilter); // Replace key value
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
			return "session_termslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "session_termslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("session_termsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "session_termsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("session_termsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("session_termsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("session_termsdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->sessionTermID->CurrentValue)) {
			$sUrl .= "sessionTermID=" . urlencode($this->sessionTermID->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=session_terms" : "";
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
		$this->sessionTermID->setDbValue($rs->fields('sessionTermID'));
		$this->session->setDbValue($rs->fields('session'));
		$this->termID->setDbValue($rs->fields('termID'));
		$this->termStart->setDbValue($rs->fields('termStart'));
		$this->termEnd->setDbValue($rs->fields('termEnd'));
		$this->currentTerm->setDbValue($rs->fields('currentTerm'));
		$this->showResults->setDbValue($rs->fields('showResults'));
		$this->status->setDbValue($rs->fields('status'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// sessionTermID

		$this->sessionTermID->CellCssStyle = ""; $this->sessionTermID->CellCssClass = "";
		$this->sessionTermID->CellAttrs = array(); $this->sessionTermID->ViewAttrs = array(); $this->sessionTermID->EditAttrs = array();

		// session
		$this->session->CellCssStyle = ""; $this->session->CellCssClass = "";
		$this->session->CellAttrs = array(); $this->session->ViewAttrs = array(); $this->session->EditAttrs = array();

		// termID
		$this->termID->CellCssStyle = ""; $this->termID->CellCssClass = "";
		$this->termID->CellAttrs = array(); $this->termID->ViewAttrs = array(); $this->termID->EditAttrs = array();

		// termStart
		$this->termStart->CellCssStyle = ""; $this->termStart->CellCssClass = "";
		$this->termStart->CellAttrs = array(); $this->termStart->ViewAttrs = array(); $this->termStart->EditAttrs = array();

		// termEnd
		$this->termEnd->CellCssStyle = ""; $this->termEnd->CellCssClass = "";
		$this->termEnd->CellAttrs = array(); $this->termEnd->ViewAttrs = array(); $this->termEnd->EditAttrs = array();

		// currentTerm
		$this->currentTerm->CellCssStyle = ""; $this->currentTerm->CellCssClass = "";
		$this->currentTerm->CellAttrs = array(); $this->currentTerm->ViewAttrs = array(); $this->currentTerm->EditAttrs = array();

		// showResults
		$this->showResults->CellCssStyle = ""; $this->showResults->CellCssClass = "";
		$this->showResults->CellAttrs = array(); $this->showResults->ViewAttrs = array(); $this->showResults->EditAttrs = array();

		// status
		$this->status->CellCssStyle = ""; $this->status->CellCssClass = "";
		$this->status->CellAttrs = array(); $this->status->ViewAttrs = array(); $this->status->EditAttrs = array();

		// sessionTermID
		$this->sessionTermID->ViewValue = $this->sessionTermID->CurrentValue;
		$this->sessionTermID->CssStyle = "";
		$this->sessionTermID->CssClass = "";
		$this->sessionTermID->ViewCustomAttributes = "";

		// session
		if (strval($this->session->CurrentValue) <> "") {
			$sFilterWrk = "`sessionID` = " . ew_AdjustSql($this->session->CurrentValue) . "";
		$sSqlWrk = "SELECT `sessionName` FROM `academic_sessions`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->session->ViewValue = $rswrk->fields('sessionName');
				$rswrk->Close();
			} else {
				$this->session->ViewValue = $this->session->CurrentValue;
			}
		} else {
			$this->session->ViewValue = NULL;
		}
		$this->session->CssStyle = "";
		$this->session->CssClass = "";
		$this->session->ViewCustomAttributes = "";

		// termID
		if (strval($this->termID->CurrentValue) <> "") {
			$sFilterWrk = "`termID` = " . ew_AdjustSql($this->termID->CurrentValue) . "";
		$sSqlWrk = "SELECT `termName` FROM `academic_terms`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->termID->ViewValue = $rswrk->fields('termName');
				$rswrk->Close();
			} else {
				$this->termID->ViewValue = $this->termID->CurrentValue;
			}
		} else {
			$this->termID->ViewValue = NULL;
		}
		$this->termID->CssStyle = "";
		$this->termID->CssClass = "";
		$this->termID->ViewCustomAttributes = "";

		// termStart
		$this->termStart->ViewValue = $this->termStart->CurrentValue;
		$this->termStart->ViewValue = ew_FormatDateTime($this->termStart->ViewValue, 5);
		$this->termStart->CssStyle = "";
		$this->termStart->CssClass = "";
		$this->termStart->ViewCustomAttributes = "";

		// termEnd
		$this->termEnd->ViewValue = $this->termEnd->CurrentValue;
		$this->termEnd->ViewValue = ew_FormatDateTime($this->termEnd->ViewValue, 5);
		$this->termEnd->CssStyle = "";
		$this->termEnd->CssClass = "";
		$this->termEnd->ViewCustomAttributes = "";

		// currentTerm
		if (strval($this->currentTerm->CurrentValue) <> "") {
			switch ($this->currentTerm->CurrentValue) {
				case "1":
					$this->currentTerm->ViewValue = "Yes";
					break;
				case "0":
					$this->currentTerm->ViewValue = "No";
					break;
				default:
					$this->currentTerm->ViewValue = $this->currentTerm->CurrentValue;
			}
		} else {
			$this->currentTerm->ViewValue = NULL;
		}
		$this->currentTerm->CssStyle = "";
		$this->currentTerm->CssClass = "";
		$this->currentTerm->ViewCustomAttributes = "";

		// showResults
		if (strval($this->showResults->CurrentValue) <> "") {
			switch ($this->showResults->CurrentValue) {
				case "1":
					$this->showResults->ViewValue = "Yes";
					break;
				case "0":
					$this->showResults->ViewValue = "No";
					break;
				default:
					$this->showResults->ViewValue = $this->showResults->CurrentValue;
			}
		} else {
			$this->showResults->ViewValue = NULL;
		}
		$this->showResults->CssStyle = "";
		$this->showResults->CssClass = "";
		$this->showResults->ViewCustomAttributes = "";

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

		// sessionTermID
		$this->sessionTermID->HrefValue = "";
		$this->sessionTermID->TooltipValue = "";

		// session
		$this->session->HrefValue = "";
		$this->session->TooltipValue = "";

		// termID
		$this->termID->HrefValue = "";
		$this->termID->TooltipValue = "";

		// termStart
		$this->termStart->HrefValue = "";
		$this->termStart->TooltipValue = "";

		// termEnd
		$this->termEnd->HrefValue = "";
		$this->termEnd->TooltipValue = "";

		// currentTerm
		$this->currentTerm->HrefValue = "";
		$this->currentTerm->TooltipValue = "";

		// showResults
		$this->showResults->HrefValue = "";
		$this->showResults->TooltipValue = "";

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
