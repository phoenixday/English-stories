<?
include 'class.php';
$site = new Site();
$site->Authorize($_POST["login"], $_POST["password"]);
?>