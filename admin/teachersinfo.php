<?php

// Global variable for table object
$teachers = NULL;

//
// Table class for teachers
//
class cteachers {
	var $TableVar = 'teachers';
	var $TableName = 'teachers';
	var $TableType = 'TABLE';
	var $teacherID;
	var $firstname;
	var $middlename;
	var $lastname;
	var $qualification;
	var $stateOfOrigin;
	var $aboutTeacher;
	var $residentialAddress;
	var $zemail;
	var $username;
	var $portalPassword;
	var $status;
	var $teacherImage;
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
	function cteachers() {
		global $Language;

		// teacherID
		$this->teacherID = new cField('teachers', 'teachers', 'x_teacherID', 'teacherID', '`teacherID`', 3, -1, FALSE, '`teacherID`', FALSE);
		$this->teacherID->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['teacherID'] =& $this->teacherID;

		// firstname
		$this->firstname = new cField('teachers', 'teachers', 'x_firstname', 'firstname', '`firstname`', 200, -1, FALSE, '`firstname`', FALSE);
		$this->fields['firstname'] =& $this->firstname;

		// middlename
		$this->middlename = new cField('teachers', 'teachers', 'x_middlename', 'middlename', '`middlename`', 200, -1, FALSE, '`middlename`', FALSE);
		$this->fields['middlename'] =& $this->middlename;

		// lastname
		$this->lastname = new cField('teachers', 'teachers', 'x_lastname', 'lastname', '`lastname`', 200, -1, FALSE, '`lastname`', FALSE);
		$this->fields['lastname'] =& $this->lastname;

		// qualification
		$this->qualification = new cField('teachers', 'teachers', 'x_qualification', 'qualification', '`qualification`', 200, -1, FALSE, '`qualification`', FALSE);
		$this->fields['qualification'] =& $this->qualification;

		// stateOfOrigin
		$this->stateOfOrigin = new cField('teachers', 'teachers', 'x_stateOfOrigin', 'stateOfOrigin', '`stateOfOrigin`', 200, -1, FALSE, '`stateOfOrigin`', FALSE);
		$this->fields['stateOfOrigin'] =& $this->stateOfOrigin;

		// aboutTeacher
		$this->aboutTeacher = new cField('teachers', 'teachers', 'x_aboutTeacher', 'aboutTeacher', '`aboutTeacher`', 201, -1, FALSE, '`aboutTeacher`', FALSE);
		$this->fields['aboutTeacher'] =& $this->aboutTeacher;

		// residentialAddress
		$this->residentialAddress = new cField('teachers', 'teachers', 'x_residentialAddress', 'residentialAddress', '`residentialAddress`', 201, -1, FALSE, '`residentialAddress`', FALSE);
		$this->fields['residentialAddress'] =& $this->residentialAddress;

		// email
		$this->zemail = new cField('teachers', 'teachers', 'x_zemail', 'email', '`email`', 200, -1, FALSE, '`email`', FALSE);
		$this->zemail->FldDefaultErrMsg = $Language->Phrase("IncorrectEmail");
		$this->fields['email'] =& $this->zemail;

		// username
		$this->username = new cField('teachers', 'teachers', 'x_username', 'username', '`username`', 200, -1, FALSE, '`username`', FALSE);
		$this->fields['username'] =& $this->username;

		// portalPassword
		$this->portalPassword = new cField('teachers', 'teachers', 'x_portalPassword', 'portalPassword', '`portalPassword`', 201, -1, FALSE, '`portalPassword`', FALSE);
		$this->fields['portalPassword'] =& $this->portalPassword;

		// status
		$this->status = new cField('teachers', 'teachers', 'x_status', 'status', '`status`', 3, -1, FALSE, '`status`', FALSE);
		$this->status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status'] =& $this->status;

		// teacherImage
		$this->teacherImage = new cField('teachers', 'teachers', 'x_teacherImage', 'teacherImage', '`teacherImage`', 201, -1, TRUE, '`teacherImage`', FALSE);
		$this->teacherImage->UploadPath = EW_UPLOAD_DEST_PATH;
		$this->fields['teacherImage'] =& $this->teacherImage;
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
		return "teachers_Highlight";
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
		return "`teachers`";
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
		return "INSERT INTO `teachers` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `teachers` SET ";
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
		$SQL = "DELETE FROM `teachers` WHERE ";
		$SQL .= ew_QuotedName('teacherID') . '=' . ew_QuotedValue($rs['teacherID'], $this->teacherID->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`teacherID` = @teacherID@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->teacherID->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@teacherID@", ew_AdjustSql($this->teacherID->CurrentValue), $sKeyFilter); // Replace key value
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
			return "teacherslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "teacherslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("teachersview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "teachersadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("teachersedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("teachersadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("teachersdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->teacherID->CurrentValue)) {
			$sUrl .= "teacherID=" . urlencode($this->teacherID->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=teachers" : "";
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
		$this->teacherID->setDbValue($rs->fields('teacherID'));
		$this->firstname->setDbValue($rs->fields('firstname'));
		$this->middlename->setDbValue($rs->fields('middlename'));
		$this->lastname->setDbValue($rs->fields('lastname'));
		$this->qualification->setDbValue($rs->fields('qualification'));
		$this->stateOfOrigin->setDbValue($rs->fields('stateOfOrigin'));
		$this->aboutTeacher->setDbValue($rs->fields('aboutTeacher'));
		$this->residentialAddress->setDbValue($rs->fields('residentialAddress'));
		$this->zemail->setDbValue($rs->fields('email'));
		$this->username->setDbValue($rs->fields('username'));
		$this->portalPassword->setDbValue($rs->fields('portalPassword'));
		$this->status->setDbValue($rs->fields('status'));
		$this->teacherImage->Upload->DbValue = $rs->fields('teacherImage');
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// teacherID

		$this->teacherID->CellCssStyle = ""; $this->teacherID->CellCssClass = "";
		$this->teacherID->CellAttrs = array(); $this->teacherID->ViewAttrs = array(); $this->teacherID->EditAttrs = array();

		// firstname
		$this->firstname->CellCssStyle = ""; $this->firstname->CellCssClass = "";
		$this->firstname->CellAttrs = array(); $this->firstname->ViewAttrs = array(); $this->firstname->EditAttrs = array();

		// middlename
		$this->middlename->CellCssStyle = ""; $this->middlename->CellCssClass = "";
		$this->middlename->CellAttrs = array(); $this->middlename->ViewAttrs = array(); $this->middlename->EditAttrs = array();

		// lastname
		$this->lastname->CellCssStyle = ""; $this->lastname->CellCssClass = "";
		$this->lastname->CellAttrs = array(); $this->lastname->ViewAttrs = array(); $this->lastname->EditAttrs = array();

		// qualification
		$this->qualification->CellCssStyle = ""; $this->qualification->CellCssClass = "";
		$this->qualification->CellAttrs = array(); $this->qualification->ViewAttrs = array(); $this->qualification->EditAttrs = array();

		// stateOfOrigin
		$this->stateOfOrigin->CellCssStyle = ""; $this->stateOfOrigin->CellCssClass = "";
		$this->stateOfOrigin->CellAttrs = array(); $this->stateOfOrigin->ViewAttrs = array(); $this->stateOfOrigin->EditAttrs = array();

		// email
		$this->zemail->CellCssStyle = ""; $this->zemail->CellCssClass = "";
		$this->zemail->CellAttrs = array(); $this->zemail->ViewAttrs = array(); $this->zemail->EditAttrs = array();

		// username
		$this->username->CellCssStyle = ""; $this->username->CellCssClass = "";
		$this->username->CellAttrs = array(); $this->username->ViewAttrs = array(); $this->username->EditAttrs = array();

		// status
		$this->status->CellCssStyle = ""; $this->status->CellCssClass = "";
		$this->status->CellAttrs = array(); $this->status->ViewAttrs = array(); $this->status->EditAttrs = array();

		// teacherID
		$this->teacherID->ViewValue = $this->teacherID->CurrentValue;
		$this->teacherID->CssStyle = "";
		$this->teacherID->CssClass = "";
		$this->teacherID->ViewCustomAttributes = "";

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

		// qualification
		$this->qualification->ViewValue = $this->qualification->CurrentValue;
		$this->qualification->CssStyle = "";
		$this->qualification->CssClass = "";
		$this->qualification->ViewCustomAttributes = "";

		// stateOfOrigin
		$this->stateOfOrigin->ViewValue = $this->stateOfOrigin->CurrentValue;
		$this->stateOfOrigin->CssStyle = "";
		$this->stateOfOrigin->CssClass = "";
		$this->stateOfOrigin->ViewCustomAttributes = "";

		// email
		$this->zemail->ViewValue = $this->zemail->CurrentValue;
		$this->zemail->CssStyle = "";
		$this->zemail->CssClass = "";
		$this->zemail->ViewCustomAttributes = "";

		// username
		$this->username->ViewValue = $this->username->CurrentValue;
		$this->username->CssStyle = "";
		$this->username->CssClass = "";
		$this->username->ViewCustomAttributes = "";

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

		// teacherID
		$this->teacherID->HrefValue = "";
		$this->teacherID->TooltipValue = "";

		// firstname
		$this->firstname->HrefValue = "";
		$this->firstname->TooltipValue = "";

		// middlename
		$this->middlename->HrefValue = "";
		$this->middlename->TooltipValue = "";

		// lastname
		$this->lastname->HrefValue = "";
		$this->lastname->TooltipValue = "";

		// qualification
		$this->qualification->HrefValue = "";
		$this->qualification->TooltipValue = "";

		// stateOfOrigin
		$this->stateOfOrigin->HrefValue = "";
		$this->stateOfOrigin->TooltipValue = "";

		// email
		$this->zemail->HrefValue = "";
		$this->zemail->TooltipValue = "";

		// username
		$this->username->HrefValue = "";
		$this->username->TooltipValue = "";

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
