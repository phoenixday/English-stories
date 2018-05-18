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
  <title><?echo $_SESSION['article-name'];?></title>
  
  <!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">

  <!-- If you are using the gem version, you need this only
  <link rel="stylesheet" href="css/app.css">-->
  
  <!-- mine -->
  <link rel = 'stylesheet' href = 'css/mycss.css'>

  <script src="js/vendor/modernizr.js"></script>
  <script src = "js/myjs.js"></script>
  
</head>
<body style = 'background-image: url(img/background.jpg); background-size: 100%; background-attachment: fixed'>
<div class = 'row' id = 'header'>
<h1 align = 'center'> Истории</h1>
<h2 align = 'center'> на английском языке</h2>
<br>
</div>
<div class = 'row'>
<div class = 'small-9 columns'>
<form method = 'post'>
<div class = 'frame' id = 'article'>
<h3><?echo $_SESSION['article-name'];?></h3>
<p><?echo $_SESSION['article'];?></p> 
<input type = 'button' value = 'На Главную' class = 'button small' onclick = 'back()'></input>
</div>
</form>
<form method = 'post'>
<div class = 'frame' id = 'voting'> 
<b>Просто?</b>
<br>
<?if (!isset($_SESSION['user'])) {?>
<label>Войдите, чтобы проголосовать.</label>
<?} else {?> <br> <?}?>
<ul class = 'button-group round'>
<li class = 'button success small' onclick = 'vote(1)'> Да </li>
<li class = 'button alert small' onclick = 'vote(0)'> Нет </li>
</ul>
</div>
</form>
<form method = 'post' class = 'frame'>
<div id = 'forum'>
<b>Обсуждение</b><hr>
<p><?if (isset($_SESSION['messages']))foreach($_SESSION['messages'] as $value) {echo $value;}?></p>
</div>
<?if (isset($_SESSION['user'])) {?>
<textarea cols = '100' rows = '3' maxlength = '250' name = 'message'> </textarea>
<input type = 'button' class = 'button small success' value = 'Отправить' onclick = 'send()'>
<img onclick = "smile(':)')" src = "img/smiles/1.gif">
<img onclick = "smile(':(')" src = "img/smiles/2.gif">
<img onclick = "smile(';)')" src = "img/smiles/3.gif">
<img onclick = "smile(':D')" src = "img/smiles/4.gif">
<img onclick = "smile(':p')" src = "img/smiles/5.gif">
<img onclick = "smile('T.T')" src = "img/smiles/6.gif">
<img onclick = "smile(':zzz:')" src = "img/smiles/7.gif">
<img onclick = "smile(':kiss:')" src = "img/smiles/8.gif">
<img onclick = "smile(':wall:')" src = "img/smiles/9.gif">
<?} else {?>
<label>Войдите, чтобы написать сообщение.</label>
<?}?>	
</form>
</div>
<div class = 'small-3 columns'>
<form method = 'post' id = "info">
<?if (!isset($_SESSION['user'])) {?>
<label> Логин: </label> <input type = 'text' name = 'login'>
<label> Пароль: </label> <input type = 'password' name = 'password'>
<input type = 'button' value = 'Войти' class = 'button success round tiny' onclick = 'auth()'></input>
<input type = 'button' value = 'Регистрация' class = 'button success round tiny' onclick = 'reg()'></input>
<?} else {?>
<b>Привет, <?echo $_SESSION['user'];?></b><br>
<input type = 'button' value = 'Выйти' class = 'button success round tiny' onclick = 'unauth()'></input>
<?}?>
</form>
</div>
</div>

<script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
  
<script>
function sel() {
	$(".br").click(function (){
		login = $(this).html();
		$.post('select.php', {login:login});
		document.location.href = "articlessel.php";
	});
}

function smile(str) {
	text = $('textarea').val() + str;
	$('textarea').val(text);
}
</script>
</body>
</html>