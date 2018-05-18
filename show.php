<?
include 'class.php';
$site = new Site();
$site->OutputArticleById($_POST["id"]);
$site->OutputMessages($_POST["id"]);
?>