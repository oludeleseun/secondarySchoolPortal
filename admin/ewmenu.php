<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "", TRUE);
?>
<?php

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "academic_termslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(2, $Language->MenuPhrase("2", "MenuText"), "academic_sessionslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "adminlist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(4, $Language->MenuPhrase("4", "MenuText"), "class_levelslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(5, $Language->MenuPhrase("5", "MenuText"), "class_roomslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "etranzact_transactionslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "fees_invoicelist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(8, $Language->MenuPhrase("8", "MenuText"), "parentslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(10, $Language->MenuPhrase("10", "MenuText"), "session_termslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(11, $Language->MenuPhrase("11", "MenuText"), "student_subjectslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(12, $Language->MenuPhrase("12", "MenuText"), "studentslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(13, $Language->MenuPhrase("13", "MenuText"), "subject_teacherslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(14, $Language->MenuPhrase("14", "MenuText"), "subjectslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(15, $Language->MenuPhrase("15", "MenuText"), "teacherslist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(16, $Language->MenuPhrase("16", "MenuText"), "term_result_approvallist.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-2, $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
