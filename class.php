<?
header("Content-Type: text/html; charset=utf-8");
class Site
{
	private $link;
	
	function __construct() {
		session_start();
		$this->link = mysql_connect('localhost', 'root', '1111');
		mysql_select_db('news');
	}
	
	function Authorize($login, $password) {
		$str = "select login, password
			from users
			where login like " . "'" . $login . "'" . ";
		";
		$result = mysql_query($str, $this->link) or die(mysql_error());
		if (mysql_num_rows($result) == 0) echo "Сначала зарегистрируйтесь.";
		else {
			$arr = mysql_fetch_row($result);
			if ($arr[1] != $password) echo "Неправильный пароль."; 
			else {
				$_SESSION['user'] = $login;
			}	
		}		
	}
	
	function Register($login, $password) {
		$str = "select login, password
				from users
				where login like " . "'" . $login . "' 
				or password like " . "'" . $password . "'" . ";
		";
		$result = mysql_query($str, $this->link) or die(mysql_error());
		if (mysql_num_rows($result) != 0) echo "Выберите другие логин и пароль.";
		else { 
			$str = "insert into users(login, password)
					values(" . "'" . $login . "'" . ", " . "'" . $password . "'" . ")";
			$result = mysql_query($str, $this->link) or die(mysql_error());
			echo "Вы зарегистрированы!";
			$_SESSION['user'] = $login;
		}
	}
	
	function OutputArticles() {
		$str1 = "select a.id_article, count(text)
		from article a natural join messages
		group by a.id_article
		order by a.id_article";
		$result1 = mysql_query($str1, $this->link) or die(mysql_error());
		$arr1 = mysql_fetch_row($result1);
		$str2 = "select id_article, header, left(article, 100)
				from article";
		$result2 = mysql_query($str2, $this->link) or die(mysql_error());
		while ($arr2 = mysql_fetch_row($result2)) {
			if ($arr1[0] == $arr2[0]) {
				$output = $output . "<div id = 'n" . $arr2[0] . "' class = 'frame'>
				<a onclick = 'see()'><b class = 'bsize'>" . $arr2[1] . "</b> | " . $arr1[1] ." сообщений</a><br>
				" . $arr2[2] . "...</div>";
				$arr1 = mysql_fetch_row($result1);
			} else {
				$output = $output . "<div id = 'n" . $arr2[0] . "' class = 'frame'>
				<a onclick = 'see()'><b class = 'bsize'>" . $arr2[1] . "</b> | 0 сообщений</a><br>
				" . $arr2[2] . "...</div>";
			}
		}	
		echo $output;
	}
	
	function OutputArticleById($id) {
		$str = "select *
		from article
		where id_article = " . $id;
		$result = mysql_query($str, $this->link) or die(mysql_error());
		$arr = mysql_fetch_row($result);
		$_SESSION['article-id'] = $arr[0];
		$_SESSION['article-name'] = $arr[1];
		$_SESSION['article'] = $arr[2];
	}

	function OutputArticlesByLogin($login) {
		$_SESSION['login'] = $login;
		$str = "select distinct id_article, header, left(article, 100)
				from article natural join messages natural join users
				where login like " . "'" . $login . "'";
		$result = mysql_query($str, $this->link) or die(mysql_error());
		$i = 0;
		if (isset($_SESSION['articles']))
			foreach ($_SESSION['articles'] as $value)
				unset($value);
		unset($_SESSION['articles']);
		while ($arr = mysql_fetch_row($result)) {
			$output = "<div id = 'n" . $arr[0] . "' class = 'frame'>
			<h3><a onclick = 'see()'>" . $arr[1] . "</a></h3>
			" . $arr[2] . "...</div>";
			$_SESSION['articles'][$i++] = $output;
		}	
	}
	
	function InsertArticleInDB($header, $article)
	{
		$str = "insert into article(header, article)
				values(" . "'" . $header . "'" . "," . "'" . $article . "'" . ");";
		$result = mysql_query($str, $this->link) or die(mysql_error());
	}
	
	private function GetUserID(){
		$str = "select id_user
				from users
				where login like " . "'" . $_SESSION['user'] . "'" . ";
			";
		$result = mysql_query($str, $this->link) or die(mysql_error());
		$arr = mysql_fetch_row($result);
		return (int)$arr[0];
	}
	
	function InsertVoteInDB($yesno) {
		$id_user = $this->GetUserID();
		$str = "insert into votes(id_article, yesno, id_user) 
				values(" . $_SESSION['article-id'] . ", " . $yesno . ", " . $id_user . ")";
		$result = mysql_query($str, $this->link) or die(mysql_error());
	}
	
	function OutputVotes($yesno) {
		$id_user = $this->GetUserID();
		$str = "select* 
		from votes
		where id_article = " . $_SESSION['article-id'] . " 
		and id_user = " . $id_user;
		$result = mysql_query($str, $this->link) or die(mysql_error());
		$output = "";
		if (mysql_num_rows($result) == 0) 
			$this->InsertVoteInDB($yesno);
		else $output = "<p>Вы уже голосовали.</p>";
		$str = "select a.*, b.* 
				from 
					(select count(yesno) 
					from votes 
					where id_article = " . $_SESSION['article-id'] . "
					and yesno = 1) a, 
					(select count(yesno) 
					from votes 
					where id_article = " . $_SESSION['article-id'] . "
					and yesno = 0) b";
		$result = mysql_query($str, $this->link) or die(mysql_error());
		$arr = mysql_fetch_row($result);
		$yes = $arr[0];
		$no  = $arr[1];
		$all = $yes + $no;
		$yes = 100 / $all * $yes;
		$no  = 100 / $all * $no;
		$output = $output . "<label>Да - " . (int)$yes ."%</label><div class='progress small-12 radius'><span class='meter success' style='width: " . $yes . "%'></span></div>";
		$output = $output . "<label>Нет - " . (int)$no . "%</label><div class='progress small-12 radius'><span class='meter alert' style='width: " . $no . "%'></span></div>";
		echo $output;
	}

	function InsertMessageInDB($message) {
		if ($message == "") return;
		$id_user = $this->GetUserID();
		$str = "insert into messages(id_article, pointer, text, id_user)
				values(" . $_SESSION['article-id'] . ", 0, " . "'" . $message . "'" . ", " . $id_user . ")";
		$result = mysql_query($str, $this->link) or die(mysql_error());
	}
	
	function OutputMessages($id) {
		$str = "select id_article, id_message, pointer, text, login, time
			from messages, users
			where messages.id_user = users.id_user
			and id_article = " .  $id . "
			order by time";
		$result = mysql_query($str, $this->link) or die(mysql_error());
		$i = 0;
		if (isset($_SESSION['messages']))
			foreach ($_SESSION['messages'] as $value)
				unset($value);
		unset($_SESSION['messages']);
		if (mysql_num_rows($result) == 0) return;
		$search = array(":)", ":(", ";)", ":D", ":p", "T.T", ":zzz:", ":kiss:", ":wall:");
		$replace = array("<img src = 'img/smiles/1.gif'",
						"<img src = 'img/smiles/2.gif'",
						"<img src = 'img/smiles/3.gif'",
						"<img src = 'img/smiles/4.gif'",
						"<img src = 'img/smiles/5.gif'",
						"<img src = 'img/smiles/6.gif'",
						"<img src = 'img/smiles/7.gif'",
						"<img src = 'img/smiles/8.gif'",
						"<img src = 'img/smiles/9.gif'");
		while ($arr = mysql_fetch_row($result)) {
			$arr[3] = str_replace($search, $replace, $arr[3]);
			$output =  
			"<div id = '" . $arr[1] . "' class = 'row'> 
			<div class = 'small-3 columns'>
			<b><a style = 'color: green' onclick = 'sel()' class = 'br'>" . $arr[4] . "</a></b>
			</div>
			<div class = 'small-9 columns'>
			<i>" . $arr[5] . "</i>
			<p> " . $arr[3] . " </p>
			</div>
			<!--<a style = 'float: right'>Комментировать</a>-->
			</div><hr>";
			$_SESSION['messages'][$i++] = $output;
		}
	}
	
	function __destruct() {
		mysql_close($this->link) or die(mysql_error());
	}
};
?>