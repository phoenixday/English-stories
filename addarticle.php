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
  <title>Новая статья</title>
  
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
<div class = 'frame'>
<form method = 'post' action = 'add.php'>
<b>Наименование темы:</b><br>
<textarea cols = '100' rows = '1' maxlength = '250' name = 'header'> </textarea>
<b>Описание:</b><br>
<textarea cols = '100' rows = '20' maxlength = '10000' name = 'article'> </textarea>
<?if ($_SESSION['user'] == 'admin') {?>
<input type = 'button' value = 'Добавить' class = 'button success small' onclick = 'addart()'></input>
<?}?>
</form>
</div>
</div>
<div class = 'small-3 columns'>
<div id = 'info'>
<b>Привет, <?echo $_SESSION['user'];?></b><br>
<input type = 'button' value = 'Назад' class = 'button success tiny' onclick = 'back()'></input>
</div>
</div>
</div>

<script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
<script>
</script>
  
</body>
</html>