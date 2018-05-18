<?
session_start();
include 'class.php';
if (!isset($_SESSION["user"])) 
	echo 0;
else {
	$site = new Site();
	$site->OutputVotes($_POST["yesno"]);
}
?>