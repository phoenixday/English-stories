function unauth() {
	$.post('unauth.php');
	location.reload();
}

function auth() {
	login = $('input[name = login]').val();
	password = $('input[name = password]').val();
	$.post('authorization.php', {login:login, password:password}, function(str){
		if (str == 'Сначала зарегистрируйтесь.' || str == 'Неправильный пароль.') alert(str);
		else location.reload();
	});	
}

function reg() {
	location.href = 'registration.php';
}

function back() {
	location.href = "index.php";
}

function vote(yesno) {
	$.post('vote.php', {yesno:yesno}, function(str) {
		if (str != '0')
			$('ul').replaceWith(str);
	});
}

function send() {
	message = $('textarea[name = message]').val();
	if (message.length == 1) return;
	$.post('talking.php', {message: message});
	location.reload();
}	

function add() {
	location.href = "addarticle.php";
}

function addart() {
	header = $('textarea[name = header]').val();
	article = $('textarea[name = article]').val();
	if (header.length == 1 || article.length == 1) return;
	$.post('add.php', {header: header, article:article});
	alert("Добавлено в БД.");
	location.href = 'index.php';
}