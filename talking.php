<?
include 'class.php';
$site = new Site();
$site->InsertMessageInDB($_POST["message"]);
$site->OutputMessages();
?>