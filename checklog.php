<?php
function check_login()
{
if(strlen($_SESSION['AccountId'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="index.php";
		$_SESSION["AccountId"]="";
		header("Location: http://$host$uri/$extra");
	}
}
?>
