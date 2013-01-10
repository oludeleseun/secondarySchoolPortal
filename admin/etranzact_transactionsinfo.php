<?php

// Global variable for table object
$etranzact_transactions = NULL;

//
// Table class for etranzact_transactions
//
class cetranzact_transactions {
	var $TableVar = 'etranzact_transactions';
	var $TableName = 'etranzact_transactions';
	var $TableType = 'TABLE';
	var $transactionID;
	var $studentID;
	var $transactionAmount;
	var $confirmationNumber;
	var $receiptNumber;
	var $transactionNumber;
	var $transactionDate;
	var $dateLogged;
	var $transactionReference;
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
	function cetranzact_transactions() {
		global $Language;

		// transactionID
		$this->transactionID = new cField('etranzact_transactions', 'etranzact_transactions', 'x_transactionID', 'transactionID', '`transactionID`', 3, -1, FALSE, '`transactionID`', FALSE);
		$this->transactionID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['transactionID'] =& $this->transactionID;

		// studentID
		$this->studentID = new cField('etranzact_transactions', 'etranzact_transactions', 'x_studentID', 'studentID', '`studentID`', 3, -1, FALSE, '`studentID`', FALSE);
		$this->studentID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['studentID'] =& $this->studentID;

		// transactionAmount
		$this->transactionAmount = new cField('etranzact_transactions', 'etranzact_transactions', 'x_transactionAmount', 'transactionAmount', '`transactionAmount`', 4, -1, FALSE, '`transactionAmount`', FALSE);
		$this->transactionAmount->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['transactionAmount'] =& $this->transactionAmount;

		// confirmationNumber
		$this->confirmationNumber = new cField('etranzact_transactions', 'etranzact_transactions', 'x_confirmationNumber', 'confirmationNumber', '`confirmationNumber`', 200, -1, FALSE, '`confirmationNumber`', FALSE);
		$this->fields['confirmationNumber'] =& $this->confirmationNumber;

		// receiptNumber
		$this->receiptNumber = new cField('etranzact_transactions', 'etranzact_transactions', 'x_receiptNumber', 'receiptNumber', '`receiptNumber`', 200, -1, FALSE, '`receiptNumber`', FALSE);
		$this->fields['receiptNumber'] =& $this->receiptNumber;

		// transactionNumber
		$this->transactionNumber = new cField('etranzact_transactions', 'etranzact_transactions', 'x_transactionNumber', 'transactionNumber', '`transactionNumber`', 200, -1, FALSE, '`transactionNumber`', FALSE);
		$this->fields['transactionNumber'] =& $this->transactionNumber;

		// transactionDate
		$this->transactionDate = new cField('etranzact_transactions', 'etranzact_transactions', 'x_transactionDate', 'transactionDate', '`transactionDate`', 135, 5, FALSE, '`transactionDate`', FALSE);
		$this->transactionDate->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['transactionDate'] =& $this->transactionDate;

		// dateLogged
		$this->dateLogged = new cField('etranzact_transactions', 'etranzact_transactions', 'x_dateLogged', 'dateLogged', '`dateLogged`', 135, 5, FALSE, '`dateLogged`', FALSE);
		$this->dateLogged->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['dateLogged'] =& $this->dateLogged;

		// transactionReference
		$this->transactionReference = new cField('etranzact_transactions', 'etranzact_transactions', 'x_transactionReference', 'transactionReference', '`transactionReference`', 200, -1, FALSE, '`transactionReference`', FALSE);
		$this->fields['transactionReference'] =& $this->transactionReference;

		// status
		$this->status = new cField('etranzact_transactions', 'etranzact_transactions', 'x_status', 'status', '`status`', 3, -1, FALSE, '`status`', FALSE);
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
		return "etranzact_transactions_Highlight";
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
		return "`etranzact_transactions`";
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
		return "INSERT INTO `etranzact_transactions` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `etranzact_transactions` SET ";
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
		$SQL = "DELETE FROM `etranzact_transactions` WHERE ";
		$SQL .= ew_QuotedName('transactionID') . '=' . ew_QuotedValue($rs['transactionID'], $this->transactionID->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`transactionID` = @transactionID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->transactionID->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@transactionID@", ew_AdjustSql($this->transactionID->CurrentValue), $sKeyFilter); // Replace key value
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
			return "etranzact_transactionslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "etranzact_transactionslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("etranzact_transactionsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "etranzact_transactionsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("etranzact_transactionsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("etranzact_transactionsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("etranzact_transactionsdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->transactionID->CurrentValue)) {
			$sUrl .= "transactionID=" . urlencode($this->transactionID->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=etranzact_transactions" : "";
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
		$this->transactionID->setDbValue($rs->fields('transactionID'));
		$this->studentID->setDbValue($rs->fields('studentID'));
		$this->transactionAmount->setDbValue($rs->fields('transactionAmount'));
		$this->confirmationNumber->setDbValue($rs->fields('confirmationNumber'));
		$this->receiptNumber->setDbValue($rs->fields('receiptNumber'));
		$this->transactionNumber->setDbValue($rs->fields('transactionNumber'));
		$this->transactionDate->setDbValue($rs->fields('transactionDate'));
		$this->dateLogged->setDbValue($rs->fields('dateLogged'));
		$this->transactionReference->setDbValue($rs->fields('transactionReference'));
		$this->status->setDbValue($rs->fields('status'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// transactionID

		$this->transactionID->CellCssStyle = ""; $this->transactionID->CellCssClass = "";
		$this->transactionID->CellAttrs = array(); $this->transactionID->ViewAttrs = array(); $this->transactionID->EditAttrs = array();

		// studentID
		$this->studentID->CellCssStyle = ""; $this->studentID->CellCssClass = "";
		$this->studentID->CellAttrs = array(); $this->studentID->ViewAttrs = array(); $this->studentID->EditAttrs = array();

		// transactionAmount
		$this->transactionAmount->CellCssStyle = ""; $this->transactionAmount->CellCssClass = "";
		$this->transactionAmount->CellAttrs = array(); $this->transactionAmount->ViewAttrs = array(); $this->transactionAmount->EditAttrs = array();

		// confirmationNumber
		$this->confirmationNumber->CellCssStyle = ""; $this->confirmationNumber->CellCssClass = "";
		$this->confirmationNumber->CellAttrs = array(); $this->confirmationNumber->ViewAttrs = array(); $this->confirmationNumber->EditAttrs = array();

		// receiptNumber
		$this->receiptNumber->CellCssStyle = ""; $this->receiptNumber->CellCssClass = "";
		$this->receiptNumber->CellAttrs = array(); $this->receiptNumber->ViewAttrs = array(); $this->receiptNumber->EditAttrs = array();

		// transactionNumber
		$this->transactionNumber->CellCssStyle = ""; $this->transactionNumber->CellCssClass = "";
		$this->transactionNumber->CellAttrs = array(); $this->transactionNumber->ViewAttrs = array(); $this->transactionNumber->EditAttrs = array();

		// transactionDate
		$this->transactionDate->CellCssStyle = ""; $this->transactionDate->CellCssClass = "";
		$this->transactionDate->CellAttrs = array(); $this->transactionDate->ViewAttrs = array(); $this->transactionDate->EditAttrs = array();

		// dateLogged
		$this->dateLogged->CellCssStyle = ""; $this->dateLogged->CellCssClass = "";
		$this->dateLogged->CellAttrs = array(); $this->dateLogged->ViewAttrs = array(); $this->dateLogged->EditAttrs = array();

		// transactionReference
		$this->transactionReference->CellCssStyle = ""; $this->transactionReference->CellCssClass = "";
		$this->transactionReference->CellAttrs = array(); $this->transactionReference->ViewAttrs = array(); $this->transactionReference->EditAttrs = array();

		// status
		$this->status->CellCssStyle = ""; $this->status->CellCssClass = "";
		$this->status->CellAttrs = array(); $this->status->ViewAttrs = array(); $this->status->EditAttrs = array();

		// transactionID
		$this->transactionID->ViewValue = $this->transactionID->CurrentValue;
		$this->transactionID->CssStyle = "";
		$this->transactionID->CssClass = "";
		$this->transactionID->ViewCustomAttributes = "";

		// studentID
		if (strval($this->studentID->CurrentValue) <> "") {
			$sFilterWrk = "`studentID` = " . ew_AdjustSql($this->studentID->CurrentValue) . "";
		$sSqlWrk = "SELECT `firstname`, `lastname` FROM `students`";
		$sWhereWrk = "";
		if ($sFilterWrk <> "") {
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . $sFilterWrk . ")";
		}
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->studentID->ViewValue = $rswrk->fields('firstname');
				$this->studentID->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('lastname');
				$rswrk->Close();
			} else {
				$this->studentID->ViewValue = $this->studentID->CurrentValue;
			}
		} else {
			$this->studentID->ViewValue = NULL;
		}
		$this->studentID->CssStyle = "";
		$this->studentID->CssClass = "";
		$this->studentID->ViewCustomAttributes = "";

		// transactionAmount
		$this->transactionAmount->ViewValue = $this->transactionAmount->CurrentValue;
		$this->transactionAmount->CssStyle = "";
		$this->transactionAmount->CssClass = "";
		$this->transactionAmount->ViewCustomAttributes = "";

		// confirmationNumber
		$this->confirmationNumber->ViewValue = $this->confirmationNumber->CurrentValue;
		$this->confirmationNumber->CssStyle = "";
		$this->confirmationNumber->CssClass = "";
		$this->confirmationNumber->ViewCustomAttributes = "";

		// receiptNumber
		$this->receiptNumber->ViewValue = $this->receiptNumber->CurrentValue;
		$this->receiptNumber->CssStyle = "";
		$this->receiptNumber->CssClass = "";
		$this->receiptNumber->ViewCustomAttributes = "";

		// transactionNumber
		$this->transactionNumber->ViewValue = $this->transactionNumber->CurrentValue;
		$this->transactionNumber->CssStyle = "";
		$this->transactionNumber->CssClass = "";
		$this->transactionNumber->ViewCustomAttributes = "";

		// transactionDate
		$this->transactionDate->ViewValue = $this->transactionDate->CurrentValue;
		$this->transactionDate->ViewValue = ew_FormatDateTime($this->transactionDate->ViewValue, 5);
		$this->transactionDate->CssStyle = "";
		$this->transactionDate->CssClass = "";
		$this->transactionDate->ViewCustomAttributes = "";

		// dateLogged
		$this->dateLogged->ViewValue = $this->dateLogged->CurrentValue;
		$this->dateLogged->ViewValue = ew_FormatDateTime($this->dateLogged->ViewValue, 5);
		$this->dateLogged->CssStyle = "";
		$this->dateLogged->CssClass = "";
		$this->dateLogged->ViewCustomAttributes = "";

		// transactionReference
		$this->transactionReference->ViewValue = $this->transactionReference->CurrentValue;
		$this->transactionReference->CssStyle = "";
		$this->transactionReference->CssClass = "";
		$this->transactionReference->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->CssStyle = "";
		$this->status->CssClass = "";
		$this->status->ViewCustomAttributes = "";

		// transactionID
		$this->transactionID->HrefValue = "";
		$this->transactionID->TooltipValue = "";

		// studentID
		$this->studentID->HrefValue = "";
		$this->studentID->TooltipValue = "";

		// transactionAmount
		$this->transactionAmount->HrefValue = "";
		$this->transactionAmount->TooltipValue = "";

		// confirmationNumber
		$this->confirmationNumber->HrefValue = "";
		$this->confirmationNumber->TooltipValue = "";

		// receiptNumber
		$this->receiptNumber->HrefValue = "";
		$this->receiptNumber->TooltipValue = "";

		// transactionNumber
		$this->transactionNumber->HrefValue = "";
		$this->transactionNumber->TooltipValue = "";

		// transactionDate
		$this->transactionDate->HrefValue = "";
		$this->transactionDate->TooltipValue = "";

		// dateLogged
		$this->dateLogged->HrefValue = "";
		$this->dateLogged->TooltipValue = "";

		// transactionReference
		$this->transactionReference->HrefValue = "";
		$this->transactionReference->TooltipValue = "";

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
