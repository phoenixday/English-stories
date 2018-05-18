<?
include 'class.php';
$site = new Site();
$site->InsertArticleInDB($_POST["header"], $_POST["article"]);
?>