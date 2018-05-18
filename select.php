<?
include 'class.php';
$site = new Site();
$site->OutputArticlesByLogin($_POST["login"]);
?>