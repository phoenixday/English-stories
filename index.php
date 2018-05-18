<?
session_start();
header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
  <meta charset="utf-8">
  <!-- If you delete this meta tag World War Z will become a reality -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Главная</title>
  
  <!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">

  <!-- If you are using the gem version, you need this only
  <link rel="stylesheet" href="css/app.css">-->
  
  <!-- mine -->
  <link rel = 'stylesheet' href = 'css/mycss.css'>

  <script src="js/vendor/modernizr.js"></script>
  
</head>
<body style = 'background-image: url(img/background.jpg); background-size: 100%; background-attachment: fixed'>
<div class = 'row'>
<div class = 'small-12 columns' id = 'header'>
<h1> Истории</h1>
<h2> на английском языке</h2>
<br>
</div>
</div>
<div class = 'row'>
<div class = 'small-9 columns'>
<form method = 'post'>
<div id = 'articles'> </div>
</form>
</div>
<div class = 'small-3 columns'>
<form method = 'post' id = "info">
<?if (!isset($_SESSION['user'])) {?>
<label> Логин: </label> <input type = 'text' name = 'login'>
<label> Пароль: </label> <input type = 'password' name = 'password'>
<input type = 'button' value = 'Войти' class = 'button success round tiny' onclick = 'auth()'></input>
<input type = 'button' value = 'Регистрация' class = 'button success round tiny' onclick = 'reg()'></input>
<?} if (isset($_SESSION['user'])) {?>
<b>Привет, <?echo $_SESSION['user'];?></b><br>
<input type = 'button' value = 'Выйти' class = 'button success round tiny' onclick = 'unauth()'></input>
<?} if ($_SESSION['user'] == 'admin') {?>
<input type = 'button' value = 'Добавить новую тему' class = 'button success tiny' onclick = 'add()'></input>
<?}?>
</form>
</div>
</div>

<script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
  
<script src = "js/myjs.js"></script>  
<script>
id_article = 0;
$.post('load.php', function(str) { $('#articles').append(str); });

function see() {
	$(".frame").click(function (){
		id_article = $(this).attr('id');
		id_article = id_article.substr(1,1);
		$.post('show.php', {id:id_article});
		document.location.href = "article.php";
	});
}
</script>
  
</body>
</html>