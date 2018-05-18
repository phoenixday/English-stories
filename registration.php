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
  <title>Регистрация</title>
  
  <!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/foundation.css">

  <!-- If you are using the gem version, you need this only
  <link rel="stylesheet" href="css/app.css">-->
  
  <!-- mine -->
  <link rel = 'stylesheet' href = 'css/mycss.css'>

  <script src="js/vendor/modernizr.js"></script>

</head>
<body style = 'background-image: url(img/background.jpg); background-size: 100%'>
<div class = 'frame' id = 'center'>
<form method = 'post' action = 'authorization.php' id = "info">
<b> Логин: </b><input type = 'text' name = 'login'>
<b> Пароль: </b><input type = 'password' name = 'password'>
<input type = 'button' value = 'Зарегистрироваться' class = 'button success' onclick = 'reg()'></input>
</form>
</div>

<script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
  
<script>
function reg(){
	login = $('input[name = login]').val();
	password = $('input[name = password]').val();
	$.post('reg.php', {login:login, password:password}, function(str){
		alert(str);
		if (str == 'Вы зарегистрированы!') {
			location.href = 'index.php';
		}
	});
}
</script>

</body>
</html>