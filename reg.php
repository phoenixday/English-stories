<?
include 'class.php';
$site = new Site();
$site->Register($_POST["login"], $_POST["password"]);
?>