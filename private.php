<?php
kPrintHeader();


/* LOGIN */
if( isset($_POST['login_username']) && isset($_POST['login_password']) )
{
	kMemberLogIn($_POST['login_username'],$_POST['login_password']);
} elseif( isset($_GET['logout']) ) {
	kMemberLogOut();
}
	
if( kPrivateIsFile() && kPrivateFileIsDownloadable() )
{
	kPrivateForceDownload();
	die();
}

	
foreach($GLOBALS['private_rows'] as $row)
{
	loricaIncludeModules($row, 'private');
}


kPrintFooter();